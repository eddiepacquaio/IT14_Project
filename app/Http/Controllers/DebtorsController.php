<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;


class DebtorsController extends Controller
{
    // ==========================================
    // DISPLAY DEBTORS
    // ==========================================
    public function index(Request $request)
    {
        $userId = Auth::id() ?? session('user_id');

        if (!$userId) {
            return redirect('/login');
        }

        $search = trim($request->query('search', ''));
        $sort = $request->query('sort', 'desc');

        if (!in_array($sort, ['asc', 'desc'], true)) {
            $sort = 'desc';
        }

        $debtors = DB::table('debtors')
            ->select('debtors.*')
            ->selectSub(function ($query) use ($userId) {
                $query->from('transactions')
                    ->selectRaw("
                        COALESCE(
                            SUM(
                                CASE
                                    WHEN type = 'credit' THEN amount
                                    WHEN type = 'payment' THEN -amount
                                    ELSE 0
                                END
                            ), 0
                        )
                    ")
                    ->whereColumn('transactions.debtor_id', 'debtors.id')
                    ->where('transactions.user_id', $userId);
            }, 'balance')
            ->where('debtors.user_id', $userId)
            ->whereNull('debtors.deleted_at')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where(
                        'debtors.full_name',
                        'LIKE',
                        "%{$search}%"
                    )->orWhere(
                        'debtors.contact_number',
                        'LIKE',
                        "%{$search}%"
                    );
                });
            })
            ->get();

        $debtors = $debtors->map(function ($debtor) {
            $debtor->balance = (float) $debtor->balance;
            return $debtor;
        });

        $debtors = $sort === 'asc'
            ? $debtors->sortBy('balance')
            : $debtors->sortByDesc('balance');

        $debtors = $debtors->values();

        $totalOwed = $debtors->sum(function ($debtor) {
            return max($debtor->balance, 0);
        });

        $activeDebtorsCount = $debtors->filter(function ($debtor) {
            return $debtor->balance > 0;
        })->count();

        return view('debtors.index', compact(
            'debtors',
            'search',
            'sort',
            'totalOwed',
            'activeDebtorsCount'
        ));
    }

    // ==========================================
    // SHOW ADD DEBTOR FORM
    // ==========================================
    public function create()
    {
        $userId = Auth::id() ?? session('user_id');

        if (!$userId) {
            return redirect('/login');
        }

        return view('debtors.create');
    }

    // ==========================================
    // SAVE NEW DEBTOR
    // ==========================================
    public function store(Request $request)
    {
        $userId = Auth::id() ?? session('user_id');

        if (!$userId) {
            return redirect('/login');
        }

        // Validate form fields.
        // These fields match the columns in your SQLite table.
        $validated = $request->validate([
            'full_name' => [
                'required',
                'string',
                'max:255',
            ],

            'contact_number' => [
                'nullable',
                'string',
                'max:30',
            ],

            'address' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'notes' => [
                'nullable',
                'string',
                'max:2000',
            ],

            'credit_limit' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'profile_photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],

            'id_photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],
        ]);

        $profilePhotoPath = null;
        $idPhotoPath = null;

        try {
            // ======================================
            // CREATE PHOTO DIRECTORIES
            // ======================================

            $profileDirectory = public_path('private/profiles');
            $idDirectory = public_path('private/ids');

            if (!is_dir($profileDirectory)) {
                if (!mkdir($profileDirectory, 0755, true) && !is_dir($profileDirectory)) {
                    throw new \RuntimeException(
                        'Unable to create the profile photo directory.'
                    );
                }
            }

            if (!is_dir($idDirectory)) {
                if (!mkdir($idDirectory, 0755, true) && !is_dir($idDirectory)) {
                    throw new \RuntimeException(
                        'Unable to create the ID photo directory.'
                    );
                }
            }

            // ======================================
            // SAVE PROFILE PHOTO
            // ======================================

            if ($request->hasFile('profile_photo')) {
                $file = $request->file('profile_photo');

                if (!$file->isValid()) {
                    throw new \RuntimeException(
                        'The uploaded profile photo is invalid.'
                    );
                }

                $extension = strtolower(
                    $file->getClientOriginalExtension()
                );

                $filename = 'profile_' .
                    bin2hex(random_bytes(16)) .
                    '.' . $extension;

                $file->move($profileDirectory, $filename);

                $profilePhotoPath = 'private/profiles/' . $filename;
            }

            // ======================================
            // SAVE ID PHOTO
            // ======================================

            if ($request->hasFile('id_photo')) {
                $file = $request->file('id_photo');

                if (!$file->isValid()) {
                    throw new \RuntimeException(
                        'The uploaded ID photo is invalid.'
                    );
                }

                $extension = strtolower(
                    $file->getClientOriginalExtension()
                );

                $filename = 'id_' .
                    bin2hex(random_bytes(16)) .
                    '.' . $extension;

                $file->move($idDirectory, $filename);

                $idPhotoPath = 'private/ids/' . $filename;
            }

            // ======================================
            // INSERT INTO SQLITE
            // ======================================

            DB::table('debtors')->insert([
                'user_id' => $userId,

                'full_name' => trim($validated['full_name']),

                'contact_number' =>
                    $validated['contact_number'] ?? null,

                'address' =>
                    $validated['address'] ?? null,

                'notes' =>
                    $validated['notes'] ?? null,

                'credit_limit' =>
                    $validated['credit_limit'] ?? 0,

                // Store the relative photo paths in SQLite.
                'profile_photo_uri' => $profilePhotoPath,

                'id_photo_uri' => $idPhotoPath,

                // Your screenshot shows created_at,
                // but does not show updated_at.
                'created_at' => now(),
            ]);

            return redirect()
                ->route('debtors.index')
                ->with('success', 'Debtor profile created successfully!');

        } catch (\Throwable $error) {

            // ======================================
            // DELETE PHOTOS IF INSERT FAILS
            // ======================================

            if (
                $profilePhotoPath &&
                file_exists(public_path($profilePhotoPath))
            ) {
                @unlink(public_path($profilePhotoPath));
            }

            if (
                $idPhotoPath &&
                file_exists(public_path($idPhotoPath))
            ) {
                @unlink(public_path($idPhotoPath));
            }

            // Save the actual error in Laravel's log.
            Log::error('FAILED TO CREATE DEBTOR', [
                'user_id' => $userId,
                'message' => $error->getMessage(),
                'file' => $error->getFile(),
                'line' => $error->getLine(),
            ]);

            // Show detailed error only in local development.
            $message = app()->isLocal()
                ? 'Unable to save debtor: ' . $error->getMessage()
                : 'Unable to create debtor. Please try again.';

            return back()
                ->withInput()
                ->with('error', $message);
        }
    }

        // ==========================================
    // SHOW EDIT DEBTOR FORM
    // ==========================================
    public function edit($id)
    {
        $userId = Auth::id() ?? session('user_id');

        if (!$userId) {
            return redirect('/login');
        }

        // Find customer belonging to logged-in user.
        $query = DB::table('debtors')
            ->where('id', $id)
            ->where('user_id', $userId);

        if (Schema::hasColumn('debtors', 'deleted_at')) {
            $query->whereNull('deleted_at');
        }

        $debtor = $query->first();

        if (!$debtor) {
            abort(404, 'Customer not found.');
        }

        return view('debtors.edit', compact('debtor'));
    }


    // ==========================================
    // UPDATE EXISTING DEBTOR
    // ==========================================
    public function update(Request $request, $id)
    {
        $userId = Auth::id() ?? session('user_id');

        if (!$userId) {
            return redirect('/login');
        }

        // Verify customer ownership.
        $query = DB::table('debtors')
            ->where('id', $id)
            ->where('user_id', $userId);

        if (Schema::hasColumn('debtors', 'deleted_at')) {
            $query->whereNull('deleted_at');
        }

        $debtor = $query->first();

        if (!$debtor) {
            abort(404, 'Customer not found.');
        }

        // VALIDATE FORM
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'contact_number' => 'nullable|string|max:30',
            'id_number' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:1000',
            'notes' => 'nullable|string|max:2000',
            'credit_limit' => 'nullable|numeric|min:0',

            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'id_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',

            'remove_profile_photo' => 'nullable|boolean',
            'remove_id_photo' => 'nullable|boolean',
        ]);

        $profilePhotoPath = $debtor->profile_photo_uri ?? null;
        $idPhotoPath = $debtor->id_photo_uri ?? null;

        $oldPhotos = [];
        $newPhotos = [];

        try {

            // ======================================
            // REMOVE PROFILE PHOTO
            // ======================================
            if ($request->boolean('remove_profile_photo')) {
                if ($profilePhotoPath) {
                    $oldPhotos[] = $profilePhotoPath;
                }

                $profilePhotoPath = null;
            }

            // ======================================
            // UPLOAD NEW PROFILE PHOTO
            // ======================================
            if ($request->hasFile('profile_photo')) {

                if ($profilePhotoPath) {
                    $oldPhotos[] = $profilePhotoPath;
                }

                $directory = public_path('private/profiles');

                if (!is_dir($directory)) {
                    mkdir($directory, 0755, true);
                }

                $file = $request->file('profile_photo');

                if (!$file->isValid()) {
                    throw new \RuntimeException(
                        'Invalid profile photo upload.'
                    );
                }

                $extension = strtolower(
                    $file->getClientOriginalExtension()
                );

                $filename = 'profile_' .
                    bin2hex(random_bytes(16)) .
                    '.' . $extension;

                $file->move($directory, $filename);

                $profilePhotoPath =
                    'private/profiles/' . $filename;

                $newPhotos[] = $profilePhotoPath;
            }

            // ======================================
            // REMOVE ID PHOTO
            // ======================================
            if ($request->boolean('remove_id_photo')) {
                if ($idPhotoPath) {
                    $oldPhotos[] = $idPhotoPath;
                }

                $idPhotoPath = null;
            }

            // ======================================
            // UPLOAD NEW ID PHOTO
            // ======================================
            if ($request->hasFile('id_photo')) {

                if ($idPhotoPath) {
                    $oldPhotos[] = $idPhotoPath;
                }

                $directory = public_path('private/ids');

                if (!is_dir($directory)) {
                    mkdir($directory, 0755, true);
                }

                $file = $request->file('id_photo');

                if (!$file->isValid()) {
                    throw new \RuntimeException(
                        'Invalid ID photo upload.'
                    );
                }

                $extension = strtolower(
                    $file->getClientOriginalExtension()
                );

                $filename = 'id_' .
                    bin2hex(random_bytes(16)) .
                    '.' . $extension;

                $file->move($directory, $filename);

                $idPhotoPath = 'private/ids/' . $filename;

                $newPhotos[] = $idPhotoPath;
            }

            // ======================================
            // PREPARE CUSTOMER DATA
            // ======================================
            $updateData = [
                'full_name' => trim($validated['full_name']),
                'contact_number' => $validated['contact_number'] ?? null,
                'address' => $validated['address'] ?? null,
                'notes' => $validated['notes'] ?? null,
                'credit_limit' => $validated['credit_limit'] ?? 0,
            ];

            // Update optional columns only if they exist.
            if (Schema::hasColumn('debtors', 'id_number')) {
                $updateData['id_number'] =
                    $validated['id_number'] ?? null;
            }

            if (Schema::hasColumn('debtors', 'profile_photo_uri')) {
                $updateData['profile_photo_uri'] = $profilePhotoPath;
            }

            if (Schema::hasColumn('debtors', 'id_photo_uri')) {
                $updateData['id_photo_uri'] = $idPhotoPath;
            }

            if (Schema::hasColumn('debtors', 'updated_at')) {
                $updateData['updated_at'] = now();
            }

            // ======================================
            // UPDATE DATABASE
            // ======================================
            DB::table('debtors')
                ->where('id', $id)
                ->where('user_id', $userId)
                ->update($updateData);

            // ======================================
            // DELETE REPLACED OR REMOVED OLD PHOTOS
            // ======================================
            foreach ($oldPhotos as $oldPhoto) {
                $oldPath = public_path($oldPhoto);

                if (is_file($oldPath)) {
                    @unlink($oldPath);
                }
            }

            return redirect()
                ->route('debtors.show', $id)
                ->with(
                    'success',
                    'Customer information updated successfully!'
                );

        } catch (\Throwable $error) {

            // Remove newly uploaded photos if saving fails.
            foreach ($newPhotos as $newPhoto) {
                $newPath = public_path($newPhoto);

                if (is_file($newPath)) {
                    @unlink($newPath);
                }
            }

            Log::error('FAILED TO UPDATE DEBTOR', [
                'debtor_id' => $id,
                'user_id' => $userId,
                'message' => $error->getMessage(),
                'file' => $error->getFile(),
                'line' => $error->getLine(),
            ]);

            $message = app()->isLocal()
                ? 'Unable to update debtor: ' . $error->getMessage()
                : 'Unable to update customer. Please try again.';

            return back()
                ->withInput()
                ->with('error', $message);
        }
    }
}