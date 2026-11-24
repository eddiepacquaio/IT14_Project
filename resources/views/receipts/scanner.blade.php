
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Receipt Scanner | Track&Tally</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --navy: #19365e;
            --navy-dark: #102947;
            --gold: #d9a928;
            --cream: #f8f7f2;
            --white: #ffffff;
            --text: #19365e;
            --muted: #8290a5;
            --border: #e3e9f1;
            --danger: #e64b4b;
            --success: #198754;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--cream);
            color: var(--text);
            min-height: 100vh;
        }

        .page {
            width: min(1450px, 95%);
            margin: 35px auto;
            padding-bottom: 50px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }

        .page-header h1 {
            font-size: 27px;
            font-weight: 800;
            color: var(--navy);
        }

        .page-header p {
            font-size: 13px;
            color: var(--muted);
            margin-top: 7px;
        }

        .back-button {
            text-decoration: none;
            padding: 11px 17px;
            border: 1px solid var(--border);
            background: white;
            color: var(--navy);
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
        }

        .back-button:hover {
            background: #f0f3f8;
        }

        .panel {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 28px;
            margin-bottom: 24px;
            box-shadow: 0 8px 25px rgba(25, 54, 94, 0.04);
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 17px;
            font-weight: 800;
            color: var(--navy);
        }

        .section-title i {
            color: var(--gold);
            font-size: 19px;
        }

        .section-description {
            color: var(--muted);
            font-size: 13px;
            margin-top: 12px;
            margin-bottom: 23px;
            line-height: 1.6;
        }

        .alert {
            padding: 14px 17px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 13px;
            line-height: 1.5;
        }

        .alert-success {
            color: #146c43;
            background: #d1e7dd;
            border: 1px solid #badbcc;
        }

        .alert-danger {
            color: #842029;
            background: #f8d7da;
            border: 1px solid #f5c2c7;
        }

        .upload-area {
            border: 2px dashed #cbd7e7;
            background: #fafbfe;
            border-radius: 15px;
            padding: 35px 20px;
            text-align: center;
            transition: 0.2s;
        }

        .upload-area:hover {
            border-color: var(--gold);
            background: #fffdf7;
        }

        .upload-icon {
            font-size: 37px;
            color: var(--gold);
            margin-bottom: 15px;
        }

        .upload-area h3 {
            font-size: 16px;
            color: var(--navy);
            margin-bottom: 8px;
        }

        .upload-area p {
            color: var(--muted);
            font-size: 12px;
            margin-bottom: 20px;
        }

        .file-input {
            display: block;
            width: min(450px, 100%);
            margin: 0 auto 18px;
            padding: 11px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 9px;
            font-family: inherit;
            font-size: 12px;
        }

        .primary-button {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 9px;
            background: var(--navy);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 14px 20px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s;
        }

        .primary-button:hover {
            background: var(--navy-dark);
            transform: translateY(-1px);
        }

        .secondary-button {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            background: white;
            color: var(--navy);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 13px 18px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
        }

        .secondary-button:hover {
            background: #f5f7fa;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
            border: 1px solid var(--border);
            border-radius: 13px;
        }

        .product-table {
            width: 100%;
            min-width: 1500px;
            border-collapse: collapse;
            background: white;
        }

        .product-table thead {
            background: #f4f6f9;
        }

        .product-table th {
            padding: 16px 12px;
            color: #64748b;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            text-align: left;
            white-space: nowrap;
        }

        .product-table td {
            padding: 12px;
            border-top: 1px solid var(--border);
            vertical-align: middle;
        }

        .product-table tbody tr:hover {
            background: #fcfdff;
        }

        .table-input,
        .table-select {
            width: 100%;
            min-width: 100px;
            height: 40px;
            border: 1px solid var(--border);
            border-radius: 9px;
            padding: 0 10px;
            color: var(--navy);
            background: white;
            font-family: inherit;
            font-size: 12px;
            outline: none;
        }

        .table-input:focus,
        .table-select:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(217, 169, 40, 0.12);
        }

        .name-input {
            min-width: 190px;
        }

        .category-input {
            min-width: 140px;
        }

        .unit-select {
            min-width: 140px;
        }

        .price-input {
            min-width: 115px;
        }

        .quantity-input {
            min-width: 95px;
        }

        .delete-button {
            width: 38px;
            height: 38px;
            border: 1px solid #ffd5d5;
            border-radius: 9px;
            background: #fff1f1;
            color: var(--danger);
            cursor: pointer;
            transition: 0.2s;
        }

        .delete-button:hover {
            background: var(--danger);
            color: white;
        }

        .table-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .detected-count {
            color: var(--muted);
            font-size: 12px;
        }

        .count-number {
            display: inline-block;
            background: #f0f3f8;
            color: var(--navy);
            padding: 8px 13px;
            border-radius: 9px;
            font-size: 14px;
            font-weight: 800;
            margin-left: 8px;
        }

        .table-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
            flex-wrap: wrap;
        }

        .add-row-button {
            background: #fffaf0;
            border: 1px solid #f0dca6;
            color: #9b7415;
            padding: 11px 16px;
            border-radius: 9px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
        }

        .add-row-button:hover {
            background: #fff2d1;
        }

        .ocr-box {
            margin-top: 20px;
        }

        .ocr-box summary {
            color: var(--navy);
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
        }

        .ocr-box pre {
            white-space: pre-wrap;
            word-break: break-word;
            background: #f5f7fa;
            padding: 15px;
            border-radius: 9px;
            margin-top: 12px;
            font-size: 12px;
            color: #52647b;
            line-height: 1.6;
        }

        .empty-message {
            padding: 35px;
            text-align: center;
            color: var(--muted);
            font-size: 13px;
        }

        @media (max-width: 700px) {
            .page {
                width: 94%;
                margin-top: 20px;
            }

            .panel {
                padding: 18px;
            }

            .page-header h1 {
                font-size: 22px;
            }

            .table-actions {
                flex-direction: column;
            }

            .table-actions button,
            .table-actions a {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<div class="page">

    <!-- PAGE HEADER -->
    <div class="page-header">
        <div>
            <h1><i class="fas fa-receipt"></i> Receipt Scanner</h1>
            <p>Scan your purchase receipts and add products to your inventory.</p>
        </div>

        <a href="{{ route('inventory.index') }}" class="back-button">
            <i class="fas fa-arrow-left"></i> Back to Inventory
        </a>
    </div>

    <!-- SUCCESS MESSAGE -->
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    <!-- ERROR MESSAGE -->
    @if(session('error'))
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle"></i>
            {{ session('error') }}
        </div>
    @endif

    <!-- VALIDATION ERRORS -->
    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Please check the following:</strong>
            <ul style="margin: 10px 0 0 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- RECEIPT UPLOAD PANEL -->
    <section class="panel">

        <h2 class="section-title">
            <i class="fas fa-cloud-upload-alt"></i>
            Upload Receipt
        </h2>

        <p class="section-description">
            Upload a clear image of your purchase receipt. The OCR scanner will
            automatically detect product names, quantities, and prices.
        </p>

        <form action="{{ route('receipt.scan') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="upload-area">

                <div class="upload-icon">
                    <i class="fas fa-file-invoice"></i>
                </div>

                <h3>Select Your Receipt Image</h3>

                <p>Supported formats: JPG, JPEG, PNG, WEBP. Maximum size: 5MB.</p>

                <input
                    type="file"
                    name="receipt"
                    class="file-input"
                    accept=".jpg,.jpeg,.png,.webp,image/*"
                    required
                >

                <button type="submit" class="primary-button">
                    <i class="fas fa-search"></i>
                    Scan Receipt
                </button>

                <p style="margin-top: 17px; margin-bottom: 0;">
                    <i class="fas fa-shield-alt"></i>
                    Your receipt will be processed for product detection.
                </p>

            </div>
        </form>
    </section>

    <!-- REVIEW PRODUCTS PANEL -->
    @if(count($products ?? []) > 0)

    <section class="panel">

        <h2 class="section-title">
            <i class="fas fa-boxes-stacked"></i>
            Review Detected Products
        </h2>

        <p class="section-description">
            Review and correct the detected information before importing it into your inventory.
            You can edit product details, add products manually, or remove unwanted rows.
        </p>

        <!-- IMPORT FORM -->
        <form action="{{ route('receipt.import') }}"
              method="POST"
              id="importForm">

            @csrf

            <div class="table-wrapper">

                <table class="product-table">

                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Numerical Value</th>
                            <th>Unit</th>
                            <th>Selling Price</th>
                            <th>Package Price</th>
                            <th>Quantity</th>
                            <th>Low Stock Alert</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody id="productTableBody">

                        @foreach($products as $index => $product)

                        <tr class="product-row">

                            <!-- PRODUCT NAME -->
                            <td>
                                <input
                                    type="text"
                                    name="products[{{ $index }}][name]"
                                    class="table-input name-input"
                                    value="{{ old("products.$index.name", $product['name'] ?? '') }}"
                                    placeholder="Product name"
                                    maxlength="255"
                                    required
                                >
                            </td>

                            <!-- CATEGORY -->
                            <td>
                                <input
                                    type="text"
                                    name="products[{{ $index }}][category]"
                                    class="table-input category-input"
                                    value="{{ old("products.$index.category", $product['category'] ?? 'Uncategorized') }}"
                                    placeholder="Category"
                                >
                            </td>

                            <!-- MEASUREMENT VALUE -->
                            <td>
                                <input
                                    type="number"
                                    name="products[{{ $index }}][measurement_value]"
                                    class="table-input quantity-input"
                                    value="{{ old("products.$index.measurement_value", $product['measurement_value'] ?? '') }}"
                                    placeholder="e.g. 500"
                                    min="0"
                                    step="any"
                                >
                            </td>

                            <!-- UNIT -->
                            <td>
                                <select
                                    name="products[{{ $index }}][unit]"
                                    class="table-select unit-select"
                                    required
                                >
                                    @php
                                        $selectedUnit = old(
                                            "products.$index.unit",
                                            $product['unit'] ?? 'Piece'
                                        );
                                    @endphp

                                    @foreach([
                                        'Piece',
                                        'Kilogram (kg)',
                                        'Gram (g)',
                                        'Liter (L)',
                                        'Milliliter (ml)',
                                        'Pack',
                                        'Box',
                                        'Bottle'
                                    ] as $unit)
                                        <option value="{{ $unit }}"
                                            {{ $selectedUnit === $unit ? 'selected' : '' }}>
                                            {{ $unit }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>

                            <!-- SELLING PRICE -->
                            <td>
                                <input
                                    type="number"
                                    name="products[{{ $index }}][selling_price]"
                                    class="table-input price-input"
                                    value="{{ old("products.$index.selling_price", $product['selling_price'] ?? $product['price'] ?? '') }}"
                                    placeholder="0.00"
                                    min="0"
                                    step="0.01"
                                    required
                                >
                            </td>

                            <!-- PACKAGE PRICE -->
                            <td>
                                <input
                                    type="number"
                                    name="products[{{ $index }}][package_price]"
                                    class="table-input price-input"
                                    value="{{ old("products.$index.package_price", $product['package_price'] ?? '') }}"
                                    placeholder="Same as selling"
                                    min="0"
                                    step="0.01"
                                >
                            </td>

                            <!-- QUANTITY -->
                            <td>
                                <input
                                    type="number"
                                    name="products[{{ $index }}][quantity]"
                                    class="table-input quantity-input"
                                    value="{{ old("products.$index.quantity", $product['quantity'] ?? 1) }}"
                                    placeholder="0"
                                    min="0"
                                    step="any"
                                    required
                                >
                            </td>

                            <!-- LOW STOCK ALERT -->
                            <td>
                                <input
                                    type="number"
                                    name="products[{{ $index }}][low_stock_threshold]"
                                    class="table-input quantity-input"
                                    value="{{ old("products.$index.low_stock_threshold", $product['low_stock_threshold'] ?? 5) }}"
                                    placeholder="5"
                                    min="0"
                                    step="1"
                                    required
                                >
                            </td>

                            <!-- DELETE -->
                            <td>
                                <button
                                    type="button"
                                    class="delete-button"
                                    onclick="removeProductRow(this)"
                                    title="Remove product"
                                >
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            <!-- TABLE FOOTER -->
            <div class="table-footer">

                <button
                    type="button"
                    class="add-row-button"
                    onclick="addProductRow()"
                >
                    <i class="fas fa-plus"></i>
                    Add Product
                </button>

                <div class="detected-count">
                    Detected Products
                    <span class="count-number" id="productCount">
                        {{ count($products) }}
                    </span>
                </div>

            </div>

            <!-- FORM ACTIONS -->
            <div class="table-actions">

                <a href="{{ route('inventory.index') }}"
                   class="secondary-button">

                    <i class="fas fa-times"></i>
                    Cancel

                </a>

                <button type="submit" class="primary-button">

                    <i class="fas fa-file-import"></i>
                    Import Products to Inventory

                </button>

            </div>

        </form>

        <!-- OCR TEXT -->
        @if(!empty($ocrText))

            <details class="ocr-box">

                <summary>
                    <i class="fas fa-file-alt"></i>
                    View Original OCR Text
                </summary>

                <pre>{{ $ocrText }}</pre>

            </details>

        @endif

    </section>

    @else

        <!-- EMPTY STATE -->
        <section class="panel">

            <h2 class="section-title">
                <i class="fas fa-boxes-stacked"></i>
                Review Detected Products
            </h2>

            <div class="empty-message">

                <i class="fas fa-receipt"
                   style="font-size: 38px; color: #d9a928; margin-bottom: 15px;">
                </i>

                <p>No scanned products yet.</p>

                <p style="margin-top: 8px;">
                    Upload a receipt image above to detect your products.
                </p>

            </div>

        </section>

    @endif

</div>

<script>
    let productIndex = {{ count($products ?? []) }};

    const tableBody = document.getElementById('productTableBody');

    function updateProductCount() {
        const count = tableBody
            ? tableBody.querySelectorAll('.product-row').length
            : 0;

        document.getElementById('productCount').textContent = count;
    }

    function removeProductRow(button) {
        const row = button.closest('tr');

        if (!row) return;

        row.remove();

        updateProductCount();
    }

    function addProductRow() {

        if (!tableBody) return;

        const index = productIndex++;

        const row = document.createElement('tr');

        row.className = 'product-row';

        row.innerHTML = `
            <td>
                <input
                    type="text"
                    name="products[${index}][name]"
                    class="table-input name-input"
                    placeholder="Product name"
                    maxlength="255"
                    required
                >
            </td>

            <td>
                <input
                    type="text"
                    name="products[${index}][category]"
                    class="table-input category-input"
                    placeholder="Category"
                    value="Uncategorized"
                >
            </td>

            <td>
                <input
                    type="number"
                    name="products[${index}][measurement_value]"
                    class="table-input quantity-input"
                    placeholder="e.g. 500"
                    min="0"
                    step="any"
                >
            </td>

            <td>
                <select
                    name="products[${index}][unit]"
                    class="table-select unit-select"
                    required
                >
                    <option value="Piece">Piece</option>
                    <option value="Kilogram (kg)">Kilogram (kg)</option>
                    <option value="Gram (g)">Gram (g)</option>
                    <option value="Liter (L)">Liter (L)</option>
                    <option value="Milliliter (ml)">Milliliter (ml)</option>
                    <option value="Pack">Pack</option>
                    <option value="Box">Box</option>
                    <option value="Bottle">Bottle</option>
                </select>
            </td>

            <td>
                <input
                    type="number"
                    name="products[${index}][selling_price]"
                    class="table-input price-input"
                    placeholder="0.00"
                    min="0"
                    step="0.01"
                    required
                >
            </td>

            <td>
                <input
                    type="number"
                    name="products[${index}][package_price]"
                    class="table-input price-input"
                    placeholder="Same as selling"
                    min="0"
                    step="0.01"
                >
            </td>

            <td>
                <input
                    type="number"
                    name="products[${index}][quantity]"
                    class="table-input quantity-input"
                    value="1"
                    min="0"
                    step="any"
                    required
                >
            </td>

            <td>
                <input
                    type="number"
                    name="products[${index}][low_stock_threshold]"
                    class="table-input quantity-input"
                    value="5"
                    min="0"
                    step="1"
                    required
                >
            </td>

            <td>
                <button
                    type="button"
                    class="delete-button"
                    onclick="removeProductRow(this)"
                    title="Remove product"
                >
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        `;

        tableBody.appendChild(row);

        updateProductCount();
    }

    // Prevent importing an empty table.
    document.getElementById('importForm')?.addEventListener('submit', function(event) {

        const rows = tableBody.querySelectorAll('.product-row');

        if (rows.length === 0) {
            event.preventDefault();
            alert('Please add at least one product before importing.');
        }

    });

    updateProductCount();
</script>

</body>
</html>
