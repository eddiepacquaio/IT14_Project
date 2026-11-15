<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product | Track&Tally</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root {
            --navy: #172B4D;
            --navy-light: #29456F;
            --navy-dark: #10213D;
            --gold: #D9A928;
            --gold-light: #F0C75E;
            --gold-soft: #FBF5E5;
            --cream: #F5F3ED;
            --white: #FFFFFF;
            --text: #27364B;
            --muted: #8993A3;
            --border: #E8E9EC;
            --green: #218653;
            --green-soft: #EAF6EF;
            --red: #D94B45;
            --red-soft: #FDEDEC;
            --shadow: 0 8px 30px rgba(23,43,77,.06);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Inter, sans-serif;
            background: var(--cream);
            color: var(--text);
            min-height: 100vh;
        }

        button, input, select {
            font-family: inherit;
        }

        /* MAIN CONTENT */

        .main {
            width: 100%;
            max-width: 1600px;
            margin: 0 auto;
            padding: 35px 45px 50px;
        }

        /* BREADCRUMB */

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--muted);
            font-size: 11px;
            font-weight: 600;
            margin-bottom: 27px;
        }

        .breadcrumb a {
            color: var(--muted);
            text-decoration: none;
            transition: .2s;
        }

        .breadcrumb a:hover {
            color: var(--gold);
        }

        .breadcrumb i {
            font-size: 9px;
        }

        .breadcrumb .current {
            color: var(--navy);
            font-weight: 800;
        }

        /* HEADER */

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 27px;
        }

        .title-area {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .title-icon {
            width: 60px;
            height: 60px;
            border-radius: 18px;
            background: linear-gradient(145deg, var(--navy), var(--navy-light));
            color: var(--gold-light);
            display: grid;
            place-items: center;
            font-size: 24px;
            box-shadow: 0 8px 18px rgba(23,43,77,.18);
        }

        .page-title {
            color: var(--navy);
            font-size: 28px;
            font-weight: 900;
            letter-spacing: -.8px;
        }

        .page-subtitle {
            color: var(--muted);
            font-size: 12px;
            margin-top: 7px;
        }

        /* BACK BUTTON */

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 11px;
            padding: 12px 18px 12px 12px;
            border-radius: 13px;
            background: white;
            border: 1px solid var(--border);
            color: var(--navy);
            text-decoration: none;
            font-size: 11px;
            font-weight: 800;
            box-shadow: 0 4px 12px rgba(23,43,77,.04);
            transition: all .25s ease;
        }

        .back-button .button-icon {
            width: 31px;
            height: 31px;
            border-radius: 9px;
            background: var(--gold-soft);
            color: var(--navy);
            display: grid;
            place-items: center;
            transition: .25s;
        }

        .back-button:hover {
            background: var(--navy);
            color: white;
            border-color: var(--navy);
            transform: translateY(-3px);
            box-shadow: 0 8px 18px rgba(23,43,77,.16);
        }

        .back-button:hover .button-icon {
            background: var(--gold);
            color: var(--navy);
            transform: translateX(-3px);
        }

        /* PRODUCT SUMMARY */

        .summary-card {
            background: linear-gradient(120deg, #172B4D, #29456F);
            color: white;
            border-radius: 20px;
            padding: 25px 28px;
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 28px rgba(23,43,77,.14);
        }

        .summary-card::after {
            content: "";
            position: absolute;
            width: 240px;
            height: 240px;
            border: 38px solid rgba(255,255,255,.045);
            border-radius: 50%;
            right: 80px;
            top: -140px;
        }

        .summary-left,
        .summary-right {
            position: relative;
            z-index: 1;
        }

        .summary-label {
            color: #B9C7DA;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.3px;
            text-transform: uppercase;
            margin-bottom: 9px;
        }

        .summary-name {
            font-size: 22px;
            font-weight: 900;
            margin-bottom: 10px;
        }

        .summary-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            color: #D5DFEB;
            font-size: 11px;
        }

        .summary-meta span {
            display: inline-flex;
            align-items: center;
            gap: 7px;
        }

        .summary-meta i {
            color: var(--gold-light);
        }

        .stock-status {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 11px 16px;
            border-radius: 30px;
            font-size: 10px;
            font-weight: 900;
            background: rgba(255,255,255,.13);
            color: white;
            white-space: nowrap;
            border: 1px solid rgba(255,255,255,.12);
        }

        .stock-status.low {
            background: rgba(217,75,69,.2);
            color: #FFD2CF;
        }

        .stock-status.good {
            background: rgba(33,134,83,.22);
            color: #B8F0CE;
        }

        /* ALERTS */

        .alert {
            padding: 15px 18px;
            border-radius: 13px;
            margin-bottom: 18px;
            font-size: 12px;
            display: flex;
            align-items: flex-start;
            gap: 11px;
        }

        .alert-success {
            background: var(--green-soft);
            color: var(--green);
            border: 1px solid #CBE9D7;
        }

        .alert-danger {
            background: var(--red-soft);
            color: var(--red);
            border: 1px solid #F5D1CF;
        }

        .alert ul {
            margin: 7px 0 0 18px;
            line-height: 1.8;
        }

        /* FORM LAYOUT */

        .content-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 300px;
            gap: 24px;
            align-items: start;
        }

        .form-card,
        .side-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 19px;
            box-shadow: var(--shadow);
        }

        .form-card {
            padding: 30px;
        }

        .card-heading {
            display: flex;
            align-items: center;
            gap: 14px;
            padding-bottom: 22px;
            border-bottom: 1px solid var(--border);
            margin-bottom: 25px;
        }

        .heading-icon {
            width: 49px;
            height: 49px;
            border-radius: 15px;
            background: var(--gold-soft);
            color: var(--navy);
            display: grid;
            place-items: center;
            font-size: 20px;
        }

        .card-heading h2 {
            color: var(--navy);
            font-size: 15px;
            font-weight: 900;
        }

        .card-heading p {
            color: var(--muted);
            font-size: 11px;
            margin-top: 5px;
        }

        .section-label {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--navy);
            font-size: 11px;
            font-weight: 900;
            letter-spacing: .7px;
            text-transform: uppercase;
            margin: 25px 0 17px;
        }

        .section-label i {
            color: var(--gold);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 19px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        label {
            color: var(--navy);
            font-size: 11px;
            font-weight: 800;
        }

        .required {
            color: var(--red);
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9AA4B2;
            font-size: 12px;
            pointer-events: none;
        }

        input,
        select {
            width: 100%;
            min-height: 47px;
            padding: 12px 14px;
            border: 1px solid var(--border);
            border-radius: 11px;
            background: #FCFCFA;
            color: var(--text);
            outline: none;
            font-size: 12px;
            transition: .2s;
        }

        .input-wrap input {
            padding-left: 39px;
        }

        input:focus,
        select:focus {
            border-color: var(--gold);
            background: white;
            box-shadow: 0 0 0 4px rgba(217,169,40,.12);
        }

        .hint {
            color: var(--muted);
            font-size: 10px;
            line-height: 1.6;
        }

        .error {
            color: var(--red);
            font-size: 10px;
            font-weight: 600;
        }

        .divider {
            height: 1px;
            background: var(--border);
            margin: 26px 0;
        }

        /* SIDE INFORMATION */

        .side-column {
            display: flex;
            flex-direction: column;
            gap: 17px;
        }

        .side-card {
            padding: 22px;
        }

        .side-title {
            color: var(--navy);
            font-size: 12px;
            font-weight: 900;
            display: flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 17px;
        }

        .side-title i {
            color: var(--gold);
        }

        .stat-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            padding: 13px 0;
            border-bottom: 1px solid #F0F1F3;
        }

        .stat-item:last-child {
            border-bottom: 0;
            padding-bottom: 0;
        }

        .stat-label {
            color: var(--muted);
            font-size: 10px;
            font-weight: 600;
        }

        .stat-value {
            color: var(--navy);
            font-size: 12px;
            font-weight: 900;
            text-align: right;
        }

        .tip-box {
            background: var(--gold-soft);
            border: 1px solid #F1E4BE;
            border-radius: 13px;
            padding: 15px;
        }

        .tip-box i {
            color: var(--gold);
            margin-right: 5px;
        }

        .tip-box strong {
            font-size: 11px;
        }

        .tip-box p {
            font-size: 10px;
            line-height: 1.7;
            color: #657086;
            margin-top: 7px;
        }

        /* ACTION BUTTONS */

        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            border-top: 1px solid var(--border);
            margin-top: 30px;
            padding-top: 23px;
        }

        .right-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .button {
            position: relative;
            overflow: hidden;
            border: 0;
            border-radius: 12px;
            min-height: 48px;
            padding: 10px 19px;
            font-size: 11px;
            font-weight: 900;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all .25s ease;
        }

        .button i {
            font-size: 13px;
            transition: transform .25s ease;
        }

        /* SAVE BUTTON */

        .button-primary {
            color: var(--navy-dark);
            background: linear-gradient(135deg, #F4D77F, #D9A928);
            border: 1px solid #D5A323;
            box-shadow: 0 5px 13px rgba(217,169,40,.25);
            min-width: 155px;
        }

        .button-primary:hover {
            background: linear-gradient(135deg, #FFE69D, #E0B13A);
            box-shadow: 0 9px 20px rgba(217,169,40,.35);
            transform: translateY(-3px);
        }

        .button-primary:hover i {
            transform: translateY(-2px);
        }

        .button-primary:active {
            transform: translateY(0) scale(.98);
        }

        /* CANCEL BUTTON */

        .button-secondary {
            color: #657086;
            background: #F5F6F8;
            border: 1px solid #E6E9EE;
            min-width: 115px;
        }

        .button-secondary:hover {
            color: var(--navy);
            background: #E9EDF3;
            border-color: #D3DAE4;
            transform: translateY(-3px);
            box-shadow: 0 6px 13px rgba(23,43,77,.07);
        }

        .button-secondary:hover i {
            transform: translateX(-3px);
        }

        /* DELETE BUTTON */

        .button-danger {
            color: white;
            background: linear-gradient(135deg, #E76A64, #C83F3A);
            border: 1px solid #C83F3A;
            box-shadow: 0 5px 13px rgba(217,75,69,.18);
            min-width: 150px;
        }

        .button-danger:hover {
            background: linear-gradient(135deg, #ED7771, #B9322D);
            box-shadow: 0 9px 20px rgba(217,75,69,.27);
            transform: translateY(-3px);
        }

        .button-danger:hover i {
            transform: rotate(-10deg) scale(1.1);
        }

        .button-danger:active {
            transform: translateY(0) scale(.98);
        }

        /* BUTTON FOCUS */

        .button:focus-visible,
        .back-button:focus-visible {
            outline: 3px solid rgba(217,169,40,.4);
            outline-offset: 4px;
        }

        /* RESPONSIVE */

        @media(max-width: 1100px) {
            .content-layout {
                grid-template-columns: 1fr;
            }

            .side-column {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media(max-width: 760px) {
            .main {
                padding: 22px 15px 35px;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .page-title {
                font-size: 23px;
            }

            .summary-card {
                align-items: flex-start;
                flex-direction: column;
            }

            .form-card {
                padding: 19px;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .form-group.full {
                grid-column: auto;
            }

            .side-column {
                grid-template-columns: 1fr;
            }

            .form-actions {
                align-items: stretch;
                flex-direction: column;
            }

            .right-actions {
                display: grid;
                grid-template-columns: 1fr 1fr;
            }

            .button {
                width: 100%;
                min-width: 0;
            }

            .button-danger {
                width: 100%;
            }
        }

        @media(max-width: 420px) {
            .title-icon {
                width: 49px;
                height: 49px;
            }

            .title-area {
                gap: 11px;
            }

            .form-card {
                padding: 15px;
            }

            .right-actions {
                grid-template-columns: 1fr;
            }

            .summary-meta {
                gap: 9px;
            }
        }
    </style>
</head>

<body>

@php
    $currentStock = (float) ($product->stock_quantity ?? 0);
    $stockLimit = (float) ($product->low_stock_threshold ?? 5);
    $isLowStock = $currentStock <= $stockLimit;
@endphp

<main class="main">

    {{-- BREADCRUMB --}}

    <div class="breadcrumb">
        <a href="{{ url('/dashboard') }}">Home</a>
        <i class="fa-solid fa-chevron-right"></i>
        <a href="{{ url('/inventory') }}">Inventory</a>
        <i class="fa-solid fa-chevron-right"></i>
        <span class="current">Edit Product</span>
    </div>

    {{-- HEADER --}}

    <header class="topbar">

        <div class="title-area">
            <div class="title-icon">
                <i class="fa-solid fa-pen-to-square"></i>
            </div>

            <div>
                <h1 class="page-title">Edit Product</h1>
                <p class="page-subtitle">
                    Manage your product details, pricing, and stock information.
                </p>
            </div>
        </div>

        <a href="{{ url('/inventory') }}" class="back-button">
            <span class="button-icon">
                <i class="fa-solid fa-arrow-left"></i>
            </span>
            Back to Inventory
        </a>

    </header>

    {{-- PRODUCT SUMMARY --}}

    <section class="summary-card">

        <div class="summary-left">
            <div class="summary-label">Currently editing</div>

            <div class="summary-name">
                {{ $product->name }}
            </div>

            <div class="summary-meta">
                <span>
                    <i class="fa-solid fa-tag"></i>
                    {{ $product->category ?: 'Uncategorized' }}
                </span>

                <span>
                    <i class="fa-solid fa-box"></i>
                    {{ ucfirst($product->unit ?? 'piece') }}
                </span>

                <span>
                    <i class="fa-solid fa-hashtag"></i>
                    Product ID: {{ $product->id }}
                </span>
            </div>
        </div>

        <div class="summary-right">
            <div class="stock-status {{ $isLowStock ? 'low' : 'good' }}">
                <i class="fa-solid {{ $isLowStock ? 'fa-triangle-exclamation' : 'fa-circle-check' }}"></i>
                {{ $isLowStock ? 'Low Stock' : 'Stock Available' }}
            </div>
        </div>

    </section>

    {{-- SUCCESS MESSAGE --}}

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fa-solid fa-circle-check"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    {{-- VALIDATION ERRORS --}}

    @if($errors->any())
        <div class="alert alert-danger">
            <i class="fa-solid fa-circle-exclamation"></i>

            <div>
                <strong>Please check the following:</strong>

                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="content-layout">

        {{-- EDIT FORM --}}

        <section class="form-card">

            <div class="card-heading">
                <div class="heading-icon">
                    <i class="fa-solid fa-box-open"></i>
                </div>

                <div>
                    <h2>Product Information</h2>
                    <p>Update the information below and save your changes.</p>
                </div>
            </div>

            <form method="POST" action="{{ url('/inventory/' . $product->id) }}">

                @csrf
                @method('PUT')

                {{-- BASIC INFORMATION --}}

                <div class="section-label">
                    <i class="fa-solid fa-circle-info"></i>
                    Basic Information
                </div>

                <div class="form-grid">

                    <div class="form-group full">
                        <label for="name">
                            Product Name <span class="required">*</span>
                        </label>

                        <div class="input-wrap">
                            <i class="fa-solid fa-box"></i>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name', $product->name) }}"
                                placeholder="Enter product name"
                                required
                            >
                        </div>

                        @error('name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="category">Category</label>

                        <div class="input-wrap">
                            <i class="fa-solid fa-layer-group"></i>

                            <input
                                type="text"
                                id="category"
                                name="category"
                                value="{{ old('category', $product->category) }}"
                                placeholder="e.g. Grocery, Beverage"
                            >
                        </div>

                        @error('category')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="unit">Unit</label>

                        <select id="unit" name="unit">
                            @foreach(['piece', 'pack', 'box', 'bottle', 'kg', 'g', 'L', 'mL', 'bundle'] as $unit)
                                <option
                                    value="{{ $unit }}"
                                    {{ old('unit', $product->unit ?? 'piece') == $unit ? 'selected' : '' }}
                                >
                                    {{ ucfirst($unit) }}
                                </option>
                            @endforeach
                        </select>

                        @error('unit')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group full">
                        <label for="measurement_value">
                            Items per Package / Measurement
                        </label>

                        <div class="input-wrap">
                            <i class="fa-solid fa-cubes"></i>

                            <input
                                type="number"
                                id="measurement_value"
                                name="measurement_value"
                                min="0.01"
                                step="0.01"
                                value="{{ old('measurement_value', $product->measurement_value) }}"
                                placeholder="e.g. 12"
                            >
                        </div>

                        <span class="hint">
                            Example: Enter 12 if one package contains 12 individual pieces.
                        </span>

                        @error('measurement_value')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div class="divider"></div>

                {{-- PRODUCT PRICING --}}

                <div class="section-label">
                    <i class="fa-solid fa-peso-sign"></i>
                    Product Pricing
                </div>

                <div class="form-grid">

                    <div class="form-group">
                        <label for="item_price">
                            Single Item Selling Price (₱) <span class="required">*</span>
                        </label>

                        <div class="input-wrap">
                            <i class="fa-solid fa-coins"></i>

                            <input
                                type="number"
                                id="item_price"
                                name="item_price"
                                min="0"
                                step="0.01"
                                value="{{ old('item_price', $product->item_price ?? 0) }}"
                                placeholder="0.00"
                                required
                            >
                        </div>

                        <span class="hint">
                            Price for selling one individual item.
                        </span>

                        @error('item_price')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="unit_price">
                            Package Selling Price (₱)
                        </label>

                        <div class="input-wrap">
                            <i class="fa-solid fa-boxes-stacked"></i>

                            <input
                                type="number"
                                id="unit_price"
                                name="unit_price"
                                min="0"
                                step="0.01"
                                value="{{ old('unit_price', $product->unit_price ?? 0) }}"
                                placeholder="0.00"
                            >
                        </div>

                        <span class="hint">
                            Price when selling the entire package.
                        </span>

                        @error('unit_price')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div class="divider"></div>

                {{-- INVENTORY MANAGEMENT --}}

                <div class="section-label">
                    <i class="fa-solid fa-warehouse"></i>
                    Inventory Management
                </div>

                <div class="form-grid">

                    <div class="form-group">
                        <label for="stock_quantity">
                            Stock Quantity <span class="required">*</span>
                        </label>

                        <div class="input-wrap">
                            <i class="fa-solid fa-boxes-packing"></i>

                            <input
                                type="number"
                                id="stock_quantity"
                                name="stock_quantity"
                                min="0"
                                step="0.01"
                                value="{{ old('stock_quantity', $product->stock_quantity ?? 0) }}"
                                placeholder="Enter stock quantity"
                                required
                            >
                        </div>

                        <span class="hint">
                            Current available product stock.
                        </span>

                        @error('stock_quantity')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="low_stock_threshold">
                            Low Stock Alert Level
                        </label>

                        <div class="input-wrap">
                            <i class="fa-solid fa-bell"></i>

                            <input
                                type="number"
                                id="low_stock_threshold"
                                name="low_stock_threshold"
                                min="0"
                                step="1"
                                value="{{ old('low_stock_threshold', $product->low_stock_threshold ?? 5) }}"
                                placeholder="5"
                            >
                        </div>

                        <span class="hint">
                            A warning appears when stock reaches this quantity.
                        </span>

                        @error('low_stock_threshold')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                {{-- FORM BUTTONS --}}

                <div class="form-actions">

                    <button
                        type="button"
                        class="button button-danger"
                        onclick="confirmDelete()"
                    >
                        <i class="fa-solid fa-trash-can"></i>
                        Delete Product
                    </button>

                    <div class="right-actions">

                        <a href="{{ url('/inventory') }}" class="button button-secondary">
                            <i class="fa-solid fa-xmark"></i>
                            Cancel
                        </a>

                        <button type="submit" class="button button-primary">
                            <i class="fa-solid fa-floppy-disk"></i>
                            Save Changes
                        </button>

                    </div>

                </div>

            </form>

            {{-- DELETE FORM --}}

            <form
                id="deleteProductForm"
                method="POST"
                action="{{ url('/inventory/' . $product->id) }}"
                style="display:none;"
            >
                @csrf
                @method('DELETE')
            </form>

        </section>

        {{-- RIGHT INFORMATION PANEL --}}

        <aside class="side-column">

            <section class="side-card">

                <h3 class="side-title">
                    <i class="fa-solid fa-chart-simple"></i>
                    Current Product Overview
                </h3>

                <div class="stat-item">
                    <span class="stat-label">Available Stock</span>
                    <span class="stat-value">
                        {{ number_format($currentStock, 2) }}
                    </span>
                </div>

                <div class="stat-item">
                    <span class="stat-label">Low Stock Limit</span>
                    <span class="stat-value">
                        {{ number_format($stockLimit, 0) }}
                    </span>
                </div>

                <div class="stat-item">
                    <span class="stat-label">Item Price</span>
                    <span class="stat-value">
                        ₱{{ number_format((float) ($product->item_price ?? 0), 2) }}
                    </span>
                </div>

                <div class="stat-item">
                    <span class="stat-label">Package Price</span>
                    <span class="stat-value">
                        ₱{{ number_format((float) ($product->unit_price ?? 0), 2) }}
                    </span>
                </div>

            </section>

            <section class="side-card">

                <h3 class="side-title">
                    <i class="fa-solid fa-lightbulb"></i>
                    Helpful Tips
                </h3>

                <div class="tip-box">
                    <strong>
                        <i class="fa-solid fa-circle-info"></i>
                        Keep your inventory accurate
                    </strong>

                    <p>
                        Update the stock quantity whenever you receive new products
                        or make inventory adjustments.
                    </p>
                </div>

                <div class="tip-box" style="margin-top:12px;">
                    <strong>
                        <i class="fa-solid fa-tags"></i>
                        Check your pricing
                    </strong>

                    <p>
                        Make sure your single-item and package prices are correct
                        before saving your changes.
                    </p>
                </div>

            </section>

            <section class="side-card">

                <h3 class="side-title">
                    <i class="fa-solid fa-shield-halved"></i>
                    Product Safety
                </h3>

                <p style="font-size:10px; color:var(--muted); line-height:1.8;">
                    Your product changes will be saved to your inventory.
                    Deleting a product is a separate action and cannot be
                    undone through this page.
                </p>

            </section>

        </aside>

    </div>

</main>

<script>
    function confirmDelete() {
        const confirmed = confirm(
            'Are you sure you want to delete this product? This action cannot be undone.'
        );

        if (confirmed) {
            document.getElementById('deleteProductForm').submit();
        }
    }
</script>

</body>
</html>
