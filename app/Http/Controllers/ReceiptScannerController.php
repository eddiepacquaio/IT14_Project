<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use thiagoalessio\TesseractOCR\TesseractOCR;

class ReceiptScannerController extends Controller
{
    /**
     * Get logged-in user's ID.
     */
    private function getUserId()
    {
        return session('user_id');
    }

    /**
     * Display receipt scanner page.
     */
    public function index()
    {
        if (!$this->getUserId()) {
            return redirect('/login');
        }

        return view('receipts.scanner', [
            'products' => session('receipt_products', []),
            'ocrText' => session('receipt_ocr_text', '')
        ]);
    }

    /**
     * Scan uploaded receipt.
     */
    public function scan(Request $request)
    {
        if (!$this->getUserId()) {
            return redirect('/login');
        }

        $request->validate([
            'receipt' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120'
        ]);

        try {
            $file = $request->file('receipt');

            $path = $file->store('receipts', 'local');

            $fullPath = Storage::disk('local')->path($path);

            $ocr = new TesseractOCR($fullPath);

            $ocr->executable(
                'C:\Program Files\Tesseract-OCR\tesseract.exe'
            );

            $ocr->lang('eng');

            $text = $ocr->run();

            if (trim($text) === '') {
                return redirect()
                    ->route('receipt.index')
                    ->with('error', 'No readable text was found. Please upload a clearer receipt.');
            }

            $rows = $this->extractProducts($text);

            if (empty($rows)) {
                return redirect()
                    ->route('receipt.index')
                    ->with('error', 'No products could be detected. Please enter products manually.')
                    ->with('receipt_ocr_text', $text);
            }

            session([
                'receipt_products' => $rows,
                'receipt_ocr_text' => $text
            ]);

            return redirect()
                ->route('receipt.index')
                ->with('success', 'Receipt scanned successfully! Review the detected products before importing.');

        } catch (\Throwable $e) {
            return redirect()
                ->route('receipt.index')
                ->with('error', 'Receipt scanning failed: ' . $e->getMessage());
        }
    }

    /**
     * Extract product information from OCR text.
     */
    private function extractProducts($text)
    {
        $rows = [];

        $lines = preg_split('/\r\n|\r|\n/', $text);

        foreach ($lines as $line) {
            $line = trim($line);

            if ($line === '' || strlen($line) < 3) {
                continue;
            }

            // Skip receipt summary information.
            if (preg_match(
                '/bill\s*(no|number)|invoice|receipt|date\s*:|time\s*:|cashier|customer|subtotal|grand\s*total|total\s*amount|cash|change|vat|tax|discount|tendered|balance|thank\s*you/i',
                $line
            )) {
                continue;
            }

            // Skip date-only lines.
            if (preg_match(
                '/^\d{1,4}[-\/]\d{1,2}[-\/]\d{1,4}$/',
                $line
            )) {
                continue;
            }

            $name = '';
            $quantity = 1;
            $price = 0;

            /*
             * Pattern 1:
             * Product Name 2 100.00
             * Product Name 2 x 100.00
             */
            $pattern = '/^(.+?)\s+(\d+(?:\.\d+)?)\s*(?:x|×)?\s*[₱P]?\s*([\d,]+(?:\.\d{1,2})?)$/iu';

            if (preg_match($pattern, $line, $matches)) {
                $name = trim($matches[1]);
                $quantity = (float) $matches[2];

                $price = (float) str_replace(
                    ',',
                    '',
                    $matches[3]
                );

            } else {
                /*
                 * Pattern 2:
                 * Product Name 100.00
                 * Default quantity is 1.
                 */
                $fallback = '/^(.+?)\s+[₱P]?\s*([\d,]+\.\d{2})$/iu';

                if (!preg_match($fallback, $line, $matches)) {
                    continue;
                }

                $name = trim($matches[1]);
                $quantity = 1;

                $price = (float) str_replace(
                    ',',
                    '',
                    $matches[2]
                );
            }

            $name = preg_replace('/\s+/', ' ', $name);
            $name = trim($name, " \t\n\r\0\x0B-:");

            // Reject invalid product names.
            if (
                strlen($name) < 2 ||
                $quantity <= 0 ||
                $price < 0 ||
                preg_match(
                    '/^(bill|date|time|invoice|receipt|total|subtotal|cash|change|vat|tax|discount|amount|qty|quantity)\b/i',
                    $name
                )
            ) {
                continue;
            }

            $rows[] = [
                'name' => $name,
                'quantity' => $quantity,
                'price' => $price,
                'selling_price' => $price,
                'package_price' => '',
                'category' => 'Uncategorized',
                'measurement_value' => null,
                'unit' => 'Piece',
                'low_stock_threshold' => 5
            ];
        }

        return $rows;
    }

    /**
     * Import scanned products into inventory.
     */
    public function import(Request $request)
    {
        $userId = $this->getUserId();

        if (!$userId) {
            return redirect('/login');
        }

        $products = session('receipt_products', []);

        if (empty($products)) {
            return redirect()
                ->route('receipt.index')
                ->with('error', 'There are no scanned products to import.');
        }

        // Validate submitted product details.
        $validator = Validator::make($request->all(), [
            'products' => 'required|array|min:1',

            'products.*.name' => 'required|string|max:255',

            'products.*.category' => 'nullable|string|max:100',

            'products.*.measurement_value' => 'nullable|numeric|min:0',

            'products.*.unit' => 'required|string|max:50',

            'products.*.selling_price' => 'required|numeric|min:0',

            'products.*.package_price' => 'nullable|numeric|min:0',

            'products.*.quantity' => 'required|numeric|min:0',

            'products.*.low_stock_threshold' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('receipt.index')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $imported = 0;
            $updated = 0;

            DB::transaction(function () use (
                $request,
                $userId,
                &$imported,
                &$updated
            ) {
                foreach ($request->input('products') as $item) {

                    $name = trim($item['name']);

                    $quantity = (float) $item['quantity'];

                    $sellingPrice = (float) $item['selling_price'];

                    // Use selling price if package price is blank.
                    $packagePrice = isset($item['package_price'])
                        && $item['package_price'] !== ''
                            ? (float) $item['package_price']
                            : $sellingPrice;

                    $category = !empty($item['category'])
                        ? trim($item['category'])
                        : 'Uncategorized';

                    $unit = $item['unit'] ?? 'Piece';

                    $measurementValue =
                        isset($item['measurement_value'])
                        && $item['measurement_value'] !== ''
                            ? (float) $item['measurement_value']
                            : null;

                    $lowStockThreshold = (int) $item['low_stock_threshold'];

                    // Find existing product owned by this user.
                    $product = DB::table('products')
                        ->where('user_id', $userId)
                        ->whereRaw('LOWER(name) = ?', [
                            mb_strtolower($name)
                        ])
                        ->first();

                    if ($product) {

                        // Add the newly scanned quantity to existing stock.
                        DB::table('products')
                            ->where('id', $product->id)
                            ->where('user_id', $userId)
                            ->update([
                                'category' => $category,
                                'unit' => $unit,
                                'measurement_value' => $measurementValue,
                                'unit_price' => $sellingPrice,
                                'item_price' => $packagePrice,
                                'stock_quantity' => (float) $product->stock_quantity + $quantity,
                                'low_stock_threshold' => $lowStockThreshold
                            ]);

                        $updated++;

                    } else {

                        // Add a new product.
                        DB::table('products')->insert([
                            'user_id' => $userId,
                            'name' => $name,
                            'category' => $category,
                            'unit' => $unit,
                            'measurement_value' => $measurementValue,
                            'unit_price' => $sellingPrice,
                            'item_price' => $packagePrice,
                            'stock_quantity' => $quantity,
                            'low_stock_threshold' => $lowStockThreshold,
                            'created_at' => now()
                        ]);

                        $imported++;
                    }
                }
            });

            // Clear scanned receipt data after successful import.
            session()->forget([
                'receipt_products',
                'receipt_ocr_text'
            ]);

            return redirect()
                ->route('inventory.index')
                ->with(
                    'success',
                    "Receipt imported successfully! {$imported} new product(s) added and {$updated} existing product(s) updated."
                );

        } catch (\Throwable $e) {
            return redirect()
                ->route('receipt.index')
                ->with(
                    'error',
                    'Import failed: ' . $e->getMessage()
                );
        }
    }
}
