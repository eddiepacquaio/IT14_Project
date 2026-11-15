
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Credit Sale | Track&Tally</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --navy: #1c3049;
            --navy-dark: #14263c;
            --navy-soft: #304e6b;
            --gold: #c49a45;
            --gold-light: #f8f0df;
            --cream: #f5f4ef;
            --white: #ffffff;
            --text: #26364a;
            --muted: #87919d;
            --border: #e8e8e2;
            --green: #2e7d32;
            --red: #c84b4b;
            --shadow: 0 12px 35px rgba(28, 48, 73, .07);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: var(--cream);
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
        }

        button, input, textarea, select { font: inherit; }
        button { cursor: pointer; }

        .topbar {
            height: 72px;
            background: rgba(255,255,255,.96);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 5%;
            position: sticky;
            top: 0;
            z-index: 20;
            backdrop-filter: blur(12px);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 11px;
            color: var(--navy);
            text-decoration: none;
            font-family: 'Manrope', sans-serif;
            font-weight: 800;
            font-size: 19px;
        }

        .brand-mark {
            width: 39px;
            height: 39px;
            display: grid;
            place-items: center;
            border-radius: 13px;
            color: var(--navy);
            background: linear-gradient(145deg, #f7e7bd, var(--gold));
            box-shadow: 0 5px 12px rgba(196,154,69,.2);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 9px;
            color: var(--muted);
            font-size: 12px;
            font-weight: 700;
        }

        .secure-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #43a66a;
        }

        .page {
            width: min(1160px, 92%);
            margin: 34px auto 60px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            color: var(--navy-soft);
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            margin-bottom: 22px;
        }

        .back-link:hover { color: var(--gold); }

        .page-heading {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 20px;
            margin-bottom: 25px;
        }

        .eyebrow {
            color: var(--gold);
            font-size: 10px;
            letter-spacing: 1.7px;
            font-weight: 800;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        h1 {
            margin: 0;
            color: var(--navy);
            font-family: 'Manrope', sans-serif;
            font-size: clamp(25px, 4vw, 34px);
            letter-spacing: -1.2px;
        }

        .heading-subtitle {
            color: var(--muted);
            font-size: 13px;
            margin: 8px 0 0;
        }

        .debtor-chip {
            display: flex;
            align-items: center;
            gap: 11px;
            background: var(--white);
            border: 1px solid var(--border);
            padding: 10px 15px;
            border-radius: 15px;
            box-shadow: 0 4px 14px rgba(28,48,73,.04);
        }

        .debtor-avatar {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            background: var(--gold-light);
            color: var(--gold);
        }

        .debtor-chip small {
            display: block;
            color: var(--muted);
            font-size: 10px;
            font-weight: 700;
            margin-bottom: 3px;
        }

        .debtor-chip strong {
            display: block;
            color: var(--navy);
            font-size: 13px;
        }

        .alert {
            padding: 13px 16px;
            border-radius: 13px;
            margin-bottom: 18px;
            font-size: 13px;
            line-height: 1.5;
        }

        .alert-success {
            color: #23683a;
            background: #eaf6ed;
            border: 1px solid #cce8d2;
        }

        .alert-error {
            color: #9e3535;
            background: #fff0ef;
            border: 1px solid #f3d0ce;
        }

        .alert ul { margin: 7px 0 0; padding-left: 18px; }

        .hero {
            background:
                radial-gradient(circle at 90% 15%, rgba(255,255,255,.12), transparent 28%),
                linear-gradient(120deg, var(--navy-dark), var(--navy-soft));
            color: white;
            border-radius: 23px;
            padding: 25px 28px;
            display: flex;
            align-items: center;
            gap: 17px;
            margin-bottom: 22px;
            box-shadow: 0 12px 25px rgba(20,38,60,.14);
        }

        .hero-icon {
            width: 55px;
            height: 55px;
            flex: 0 0 55px;
            border-radius: 17px;
            display: grid;
            place-items: center;
            color: #f2d38d;
            background: rgba(255,255,255,.1);
            border: 1px solid rgba(255,255,255,.14);
            font-size: 22px;
        }

        .hero h2 {
            margin: 0 0 5px;
            font-family: 'Manrope', sans-serif;
            font-size: 18px;
        }

        .hero p {
            margin: 0;
            color: rgba(255,255,255,.7);
            font-size: 12px;
            line-height: 1.6;
        }

        .layout {
            display: grid;
            grid-template-columns: minmax(0, 1.55fr) minmax(300px, .85fr);
            gap: 22px;
            align-items: start;
        }

        .main-column, .side-column {
            display: grid;
            gap: 20px;
            min-width: 0;
        }

        .card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 21px;
            box-shadow: var(--shadow);
        }

        .card-heading {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 19px;
        }

        .card-icon {
            width: 41px;
            height: 41px;
            border-radius: 13px;
            display: grid;
            place-items: center;
            background: var(--gold-light);
            color: var(--navy);
            font-size: 17px;
        }

        .card-heading h3 {
            margin: 0 0 3px;
            font-size: 15px;
            font-weight: 800;
            color: var(--navy);
        }

        .card-heading p {
            margin: 0;
            color: var(--muted);
            font-size: 11px;
        }

        .count-pill {
            margin-left: auto;
            padding: 7px 11px;
            border-radius: 30px;
            color: white;
            background: var(--navy);
            font-size: 10px;
            font-weight: 800;
            white-space: nowrap;
        }

        .search-box {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #fafaf8;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 0 13px;
            height: 48px;
            margin-bottom: 13px;
            color: var(--muted);
        }

        .search-box input {
            width: 100%;
            border: 0;
            outline: 0;
            background: transparent;
            color: var(--text);
            font-size: 13px;
        }

        .product-list {
            display: grid;
            gap: 9px;
            max-height: 490px;
            overflow-y: auto;
            padding-right: 3px;
        }

        .product {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            border: 1px solid var(--border);
            border-radius: 14px;
            transition: .2s ease;
        }

        .product:hover { border-color: #d7bd82; background: #fffdf8; }
        .product.selected { border-color: var(--gold); background: #fffdf7; }

        .product-icon {
            width: 43px;
            height: 43px;
            flex: 0 0 43px;
            display: grid;
            place-items: center;
            background: #f4f2eb;
            color: var(--navy);
            border-radius: 13px;
        }

        .product-info { flex: 1; min-width: 0; }

        .product-name {
            font-size: 13px;
            color: var(--navy);
            font-weight: 800;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .product-meta {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 6px;
        }

        .product-price { color: var(--navy-soft); font-size: 11px; font-weight: 800; }

        .stock {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            border-radius: 20px;
            padding: 4px 7px;
            font-size: 9px;
            font-weight: 800;
        }

        .stock.good { background: #edf7ee; color: var(--green); }
        .stock.low { background: #fff5dc; color: #96701e; }
        .stock.empty { background: #f0f0f0; color: #888; }

        .product-actions { display: flex; align-items: center; gap: 7px; }

        .mode-select {
            max-width: 115px;
            padding: 7px 5px;
            border: 1px solid var(--border);
            border-radius: 9px;
            color: var(--navy);
            background: white;
            font-size: 10px;
            outline: none;
        }

        .add-btn, .qty-btn {
            border: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            font-weight: 800;
        }

        .add-btn {
            gap: 6px;
            min-width: 69px;
            height: 35px;
            padding: 0 11px;
            color: white;
            background: var(--navy);
            font-size: 11px;
        }

        .add-btn:disabled { background: #aeb4bb; cursor: not-allowed; }

        .qty-control {
            display: flex;
            align-items: center;
            gap: 7px;
            background: var(--cream);
            padding: 3px;
            border-radius: 30px;
        }

        .qty-btn {
            width: 28px;
            height: 28px;
            background: white;
            color: var(--navy);
            border: 1px solid var(--border);
        }

        .qty-value {
            min-width: 17px;
            text-align: center;
            color: var(--navy);
            font-size: 12px;
            font-weight: 900;
        }

        .empty-products {
            text-align: center;
            padding: 35px 15px;
            color: var(--muted);
            font-size: 12px;
        }

        .empty-products i {
            display: block;
            font-size: 25px;
            margin-bottom: 10px;
            color: #c5c9c9;
        }

        .amount-card {
            overflow: hidden;
            color: white;
            background:
                radial-gradient(circle at 95% 0%, rgba(255,255,255,.12), transparent 30%),
                linear-gradient(145deg, var(--navy), var(--navy-dark));
            border-radius: 21px;
            padding: 22px;
            box-shadow: 0 12px 25px rgba(20,38,60,.16);
        }

        .amount-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .amount-eyebrow {
            color: #e5c77f;
            font-size: 9px;
            font-weight: 900;
            letter-spacing: 1.5px;
        }

        .amount-title {
            margin-top: 5px;
            font-family: 'Manrope', sans-serif;
            font-size: 16px;
            font-weight: 800;
        }

        .amount-icon {
            width: 42px;
            height: 42px;
            display: grid;
            place-items: center;
            border-radius: 13px;
            background: rgba(255,255,255,.1);
            color: #f3d58e;
            font-size: 20px;
        }

        .amount-input-wrap {
            display: flex;
            align-items: center;
            gap: 9px;
            margin-top: 21px;
        }

        .peso {
            color: #f3d58e;
            font-size: 30px;
            font-weight: 800;
        }

        .amount-input {
            width: 100%;
            min-width: 0;
            color: white;
            font-family: 'Manrope', sans-serif;
            font-size: 30px;
            font-weight: 800;
            background: transparent;
            border: 0;
            outline: 0;
        }

        .amount-input::placeholder { color: rgba(255,255,255,.35); }
        .amount-input:disabled { opacity: .9; }

        .amount-divider {
            height: 1px;
            background: rgba(255,255,255,.13);
            margin: 17px 0 13px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
        }

        .total-row span:first-child { color: rgba(255,255,255,.65); font-size: 11px; }
        .total-row strong { color: #f3d58e; font-size: 15px; }

        .limit-card {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            padding: 15px;
            border: 1px solid var(--border);
            border-radius: 15px;
            background: #fbfbf8;
        }

        .limit-item small {
            display: block;
            color: var(--muted);
            font-size: 9px;
            font-weight: 800;
            letter-spacing: .5px;
            margin-bottom: 5px;
        }

        .limit-item strong { color: var(--navy); font-size: 14px; }
        .limit-item.remaining strong { color: var(--green); }

        .field-label {
            display: block;
            margin-bottom: 8px;
            color: var(--navy);
            font-size: 11px;
            font-weight: 800;
        }

        .description {
            width: 100%;
            min-height: 112px;
            resize: vertical;
            border: 1px solid var(--border);
            border-radius: 13px;
            background: #fafaf8;
            padding: 13px;
            color: var(--text);
            font-size: 13px;
            outline: none;
            transition: .2s;
        }

        .description:focus, .search-box:focus-within {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(196,154,69,.1);
        }

        .save-card {
            padding: 19px;
            border-radius: 19px;
            border: 1px solid #eadfca;
            background: linear-gradient(135deg, #fffdf8, #f8f2e6);
        }

        .save-note {
            display: flex;
            gap: 9px;
            color: #7c7d78;
            font-size: 11px;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .save-note i { color: var(--gold); margin-top: 2px; }

        .save-btn {
            width: 100%;
            min-height: 49px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            border: 0;
            border-radius: 13px;
            color: white;
            background: linear-gradient(110deg, var(--navy), #263f5d);
            font-size: 13px;
            font-weight: 800;
            box-shadow: 0 7px 15px rgba(28,48,73,.18);
            transition: .2s;
        }

        .save-btn:hover { transform: translateY(-2px); box-shadow: 0 10px 19px rgba(28,48,73,.23); }
        .save-btn:disabled { opacity: .65; cursor: wait; transform: none; }

        .cancel-link {
            display: block;
            text-align: center;
            margin-top: 13px;
            color: var(--muted);
            text-decoration: none;
            font-size: 11px;
            font-weight: 700;
        }

        .cancel-link:hover { color: var(--navy); }

        .footer {
            margin-top: 35px;
            padding: 20px 0;
            border-top: 1px solid #e3e2db;
            display: flex;
            justify-content: space-between;
            gap: 15px;
            color: #969b9e;
            font-size: 10px;
        }

        .footer strong { color: var(--navy-soft); }

        /* Credit limit modal */
        .modal-overlay {
            position: fixed;
            inset: 0;
            z-index: 100;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 18px;
            background: rgba(10,25,47,.72);
            backdrop-filter: blur(5px);
        }

        .modal-overlay.show { display: flex; }

        .credit-modal {
            width: min(440px, 100%);
            max-height: 90vh;
            overflow-y: auto;
            padding: 25px;
            background: white;
            border-radius: 25px;
            box-shadow: 0 25px 70px rgba(0,0,0,.25);
            animation: modalIn .22s ease-out;
        }

        @keyframes modalIn {
            from { opacity: 0; transform: translateY(12px) scale(.98); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .warning-icon {
            width: 67px;
            height: 67px;
            display: grid;
            place-items: center;
            margin: 0 auto 13px;
            border-radius: 22px;
            background: #fff3cc;
            color: #a77a1e;
            font-size: 27px;
        }

        .credit-modal h2 {
            margin: 0;
            text-align: center;
            color: var(--navy);
            font-family: 'Manrope', sans-serif;
            font-size: 23px;
        }

        .modal-subtitle {
            margin: 8px 0 18px;
            text-align: center;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.65;
        }

        .current-balance {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 13px;
            border: 1px solid #f0dc9a;
            border-radius: 15px;
            background: #fff9e7;
            margin-bottom: 12px;
        }

        .current-balance small, .requested small {
            display: block;
            color: #98752b;
            font-size: 9px;
            font-weight: 900;
            letter-spacing: .7px;
            margin-bottom: 4px;
        }

        .current-balance strong, .requested strong {
            color: var(--navy);
            font-size: 18px;
        }

        .unpaid {
            color: #9b7625;
            background: #ffefbd;
            border-radius: 30px;
            padding: 6px 8px;
            font-size: 8px;
            font-weight: 900;
        }

        .modal-summary {
            border: 1px solid var(--border);
            border-radius: 15px;
            padding: 6px 13px;
            background: #fbfbf8;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid var(--border);
            font-size: 11px;
        }

        .summary-row:last-child { border-bottom: 0; }
        .summary-row span { color: var(--muted); }
        .summary-row strong { color: var(--navy); }
        .summary-row .green { color: var(--green); }

        .requested {
            padding: 13px;
            border: 1px solid #f0dc9a;
            border-radius: 14px;
            background: #fff9e9;
            margin-top: 12px;
        }

        .modal-warning {
            display: flex;
            gap: 9px;
            padding: 12px;
            margin: 12px 0 15px;
            border-radius: 13px;
            background: #f7f6f0;
            color: #74766f;
            font-size: 11px;
            line-height: 1.55;
        }

        .modal-warning i { color: var(--gold); margin-top: 2px; }

        .modal-close {
            width: 100%;
            min-height: 48px;
            border: 0;
            border-radius: 13px;
            background: var(--navy);
            color: white;
            font-size: 12px;
            font-weight: 800;
        }

        @media (max-width: 850px) {
            .layout { grid-template-columns: 1fr; }
            .side-column { grid-template-columns: 1fr 1fr; align-items: start; }
        }

        @media (max-width: 600px) {
            .topbar { height: 63px; padding: 0 4%; }
            .brand { font-size: 16px; }
            .topbar-right { font-size: 10px; }
            .page { width: 92%; margin-top: 23px; }
            .page-heading { align-items: flex-start; flex-direction: column; }
            .debtor-chip { width: 100%; }
            .hero { padding: 19px; border-radius: 18px; }
            .hero-icon { width: 47px; height: 47px; flex-basis: 47px; }
            .card { padding: 16px; border-radius: 17px; }
            .side-column { grid-template-columns: 1fr; }
            .product { gap: 8px; padding: 10px; }
            .product-icon { width: 37px; height: 37px; flex-basis: 37px; }
            .product-actions { gap: 4px; }
            .mode-select { max-width: 93px; font-size: 9px; }
            .add-btn { min-width: 55px; padding: 0 8px; }
            .footer { flex-direction: column; }
        }
    </style>
</head>

<body>

<header class="topbar">
    <a href="{{ route('dashboard') }}" class="brand">
        <span class="brand-mark"><i class="fa-solid fa-chart-simple"></i></span>
        <span>Track<span style="color:var(--gold)">&</span>Tally</span>
    </a>

    <div class="topbar-right">
        <span class="secure-dot"></span>
        SECURE TRANSACTION
    </div>
</header>

<main class="page">

    <a href="{{ route('debtors.show', $debtorRecord->id) }}" class="back-link">
        <i class="fa-solid fa-arrow-left"></i>
        Back to debtor details
    </a>

    <div class="page-heading">
        <div>
            <div class="eyebrow">Debtor management / New transaction</div>
            <h1>Log credit sale</h1>
            <p class="heading-subtitle">Record products or an amount to add to the customer's outstanding balance.</p>
        </div>

        <div class="debtor-chip">
            <div class="debtor-avatar"><i class="fa-solid fa-user"></i></div>
            <div>
                <small>CREDIT ACCOUNT FOR</small>
                <strong>{{ $debtorRecord->full_name }}</strong>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            <i class="fa-solid fa-circle-exclamation"></i>
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-error">
            <strong><i class="fa-solid fa-circle-exclamation"></i> Please check the following:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="hero">
        <div class="hero-icon"><i class="fa-solid fa-receipt"></i></div>
        <div>
            <h2>New credit sale</h2>
            <p>Select inventory products or enter a manual amount. The transaction will be added to this debtor's balance after saving.</p>
        </div>
    </section>

    <form id="creditForm" method="POST" action="{{ route('debtors.credit.store', $debtorRecord->id) }}">
        @csrf

        <div class="layout">

            <div class="main-column">

                <section class="card">
                    <div class="card-heading">
                        <div class="card-icon"><i class="fa-solid fa-boxes-stacked"></i></div>
                        <div>
                            <h3>Products</h3>
                            <p>Choose inventory items for this credit sale</p>
                        </div>
                        <span class="count-pill" id="selectedCount">0 selected</span>
                    </div>

                    <div class="search-box">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" id="productSearch" placeholder="Search products by name...">
                    </div>

                    <div class="product-list" id="productList">
                        @forelse($products as $product)
                            @php
                                $stock = (float) $product->stock_quantity;
                                $itemAvailable = (float) ($product->item_price ?? 0) > 0
                                    && (float) ($product->measurement_value ?? 0) > 0;
                            @endphp

                            <div class="product"
                                data-id="{{ $product->id }}"
                                data-name="{{ strtolower($product->name) }}"
                                data-stock="{{ $stock }}"
                                data-package-price="{{ $product->unit_price }}"
                                data-item-price="{{ $product->item_price ?? 0 }}"
                                data-measurement="{{ max(1, (int) ($product->measurement_value ?? 1)) }}"
                                data-item-available="{{ $itemAvailable ? '1' : '0' }}">

                                <div class="product-icon"><i class="fa-solid fa-cube"></i></div>

                                <div class="product-info">
                                    <div class="product-name">{{ $product->name }}</div>
                                    <div class="product-meta">
                                        <span class="product-price">
                                            ₱{{ number_format((float) $product->unit_price, 2) }} / package
                                        </span>

                                        @if($stock <= 0)
                                            <span class="stock empty">No stock</span>
                                        @elseif($stock <= 5)
                                            <span class="stock low">{{ number_format($stock, 2) }} {{ $product->unit }} left</span>
                                        @else
                                            <span class="stock good">{{ number_format($stock, 2) }} {{ $product->unit }} in stock</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="product-actions">
                                    @if($itemAvailable)
                                        <select class="mode-select" aria-label="Sale type">
                                            <option value="package">Package</option>
                                            <option value="item">Single item</option>
                                        </select>
                                    @endif

                                    <button type="button" class="add-btn" onclick="addProduct(this)" {{ $stock <= 0 ? 'disabled' : '' }}>
                                        <i class="fa-solid fa-plus"></i> Add
                                    </button>
                                </div>
                            </div>
                        @empty
                            <div class="empty-products">
                                <i class="fa-solid fa-box-open"></i>
                                No inventory products available yet.
                            </div>
                        @endforelse
                    </div>
                </section>

                <section class="card">
                    <div class="card-heading">
                        <div class="card-icon"><i class="fa-solid fa-file-lines"></i></div>
                        <div>
                            <h3>Description</h3>
                            <p>Add a note about this credit transaction</p>
                        </div>
                    </div>

                    <label class="field-label" for="description">Transaction description</label>
                    <textarea
                        class="description"
                        id="description"
                        name="description"
                        maxlength="1000"
                        placeholder="Example: Rice, canned goods, groceries, or other details..."
                    >{{ old('description') }}</textarea>
                </section>

            </div>

            <aside class="side-column">

                <section class="amount-card">
                    <div class="amount-top">
                        <div>
                            <div class="amount-eyebrow">CREDIT AMOUNT</div>
                            <div class="amount-title" id="amountTitle">Amount to add</div>
                        </div>
                        <div class="amount-icon"><i class="fa-solid fa-wallet"></i></div>
                    </div>

                    <div class="amount-input-wrap">
                        <span class="peso">₱</span>
                        <input
                            class="amount-input"
                            type="number"
                            id="manualAmount"
                            name="amount"
                            min="0.01"
                            step="0.01"
                            placeholder="0.00"
                            value="{{ old('amount') }}"
                        >
                    </div>

                    <div class="amount-divider"></div>

                    <div class="total-row">
                        <span id="amountCaption">Outstanding credit</span>
                        <strong id="totalAmount">₱0.00</strong>
                    </div>
                </section>

                <section class="card">
                    <div class="card-heading">
                        <div class="card-icon"><i class="fa-solid fa-shield-halved"></i></div>
                        <div>
                            <h3>Credit overview</h3>
                            <p>Current account limit</p>
                        </div>
                    </div>

                    <div class="limit-card">
                        <div class="limit-item">
                            <small>CREDIT LIMIT</small>
                            <strong>₱{{ number_format((float) ($debtorRecord->credit_limit ?? 0), 2) }}</strong>
                        </div>
                        <div class="limit-item">
                            <small>CURRENT UTANG</small>
                            <strong>₱{{ number_format($currentBalance, 2) }}</strong>
                        </div>
                        <div class="limit-item remaining" style="grid-column:1/-1">
                            <small>REMAINING CREDIT</small>
                            <strong>
                                @if((float) ($debtorRecord->credit_limit ?? 0) > 0)
                                    ₱{{ number_format(max(0, (float) $debtorRecord->credit_limit - $currentBalance), 2) }}
                                @else
                                    No limit set
                                @endif
                            </strong>
                        </div>
                    </div>

                    @if((float) ($debtorRecord->credit_limit ?? 0) <= 0)
                        <p style="font-size:10px;color:var(--muted);line-height:1.6;margin:12px 0 0">
                            <i class="fa-solid fa-circle-info"></i>
                            This debtor has no credit limit set.
                        </p>
                    @endif
                </section>

                <section class="save-card">
                    <div class="save-note">
                        <i class="fa-solid fa-circle-info"></i>
                        <span>This credit sale will be added to the debtor's outstanding balance. Selected inventory items will also be deducted from stock.</span>
                    </div>

                    <button type="submit" class="save-btn" id="saveButton">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Save credit sale
                    </button>

                    <a href="{{ route('debtors.show', $debtorRecord->id) }}" class="cancel-link">
                        Cancel and go back
                    </a>
                </section>

            </aside>
        </div>

        <div id="hiddenItems"></div>
    </form>

    <footer class="footer">
        <div><strong>Track&Tally</strong> &nbsp; Simple and organized store management.</div>
        <div><i class="fa-solid fa-lock"></i> Your transaction is securely recorded.</div>
    </footer>

</main>

<!-- CREDIT LIMIT WARNING MODAL -->
<div class="modal-overlay" id="creditModal">
    <div class="credit-modal">
        <div class="warning-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
        <h2>May Utang Pa</h2>
        <p class="modal-subtitle">
            {{ $debtorRecord->full_name }} still has an outstanding balance.
            This new credit would exceed the allowed credit limit.
        </p>

        <div class="current-balance">
            <div>
                <small>CURRENT UTANG</small>
                <strong id="modalCurrent">₱0.00</strong>
            </div>
            <span class="unpaid"><i class="fa-solid fa-circle-exclamation"></i> UNPAID</span>
        </div>

        <div class="modal-summary">
            <div class="summary-row">
                <span>Credit limit</span>
                <strong id="modalLimit">₱0.00</strong>
            </div>
            <div class="summary-row">
                <span>Current balance</span>
                <strong id="modalBalance">₱0.00</strong>
            </div>
            <div class="summary-row">
                <span>Remaining credit</span>
                <strong class="green" id="modalRemaining">₱0.00</strong>
            </div>
        </div>

        <div class="requested">
            <small>NEW CREDIT REQUESTED</small>
            <strong id="modalRequested">₱0.00</strong>
        </div>

        <div class="modal-warning">
            <i class="fa-solid fa-circle-info"></i>
            <span>Please reduce the purchase amount or ask the customer to make a payment first.</span>
        </div>

        <button type="button" class="modal-close" onclick="closeCreditModal()">
            Okay, Got It &nbsp; <i class="fa-solid fa-check"></i>
        </button>
    </div>
</div>

<script>
    const creditLimit = Number(@json((float) ($debtorRecord->credit_limit ?? 0)));
    const currentBalance = Number(@json((float) $currentBalance));
    const products = [...document.querySelectorAll('.product')];

    const cart = {};

    const money = value => new Intl.NumberFormat('en-PH', {
        style: 'currency',
        currency: 'PHP'
    }).format(Number(value) || 0);

    function getProductPrice(product, mode) {
        return mode === 'item'
            ? Number(product.dataset.itemPrice || 0)
            : Number(product.dataset.packagePrice || 0);
    }

    function getStockPerSale(product, mode) {
        return mode === 'item'
            ? 1
            : Math.max(1, Number(product.dataset.measurement || 1));
    }

    function getCartTotal() {
        return Object.values(cart).reduce((total, item) => {
            return total + item.quantity * getProductPrice(item.element, item.mode);
        }, 0);
    }

    function getCartCount() {
        return Object.values(cart).reduce((total, item) => total + item.quantity, 0);
    }

    function updateTotals() {
        const hasProducts = getCartCount() > 0;
        const total = hasProducts
            ? getCartTotal()
            : Number(document.getElementById('manualAmount').value || 0);

        document.getElementById('manualAmount').disabled = hasProducts;
        document.getElementById('amountTitle').textContent = hasProducts
            ? 'Total of selected products'
            : 'Amount to add';

        document.getElementById('amountCaption').textContent = hasProducts
            ? 'Products credit total'
            : 'Outstanding credit';

        document.getElementById('totalAmount').textContent = money(total);
        document.getElementById('selectedCount').textContent =
            getCartCount() + ' selected';

        renderHiddenInputs();
    }

    function renderHiddenInputs() {
        const container = document.getElementById('hiddenItems');
        container.innerHTML = '';

        Object.values(cart).forEach((item, index) => {
            const fields = {
                [`items[${index}][product_id]`]: item.id,
                [`items[${index}][quantity]`]: item.quantity,
                [`items[${index}][sale_mode]`]: item.mode
            };

            Object.entries(fields).forEach(([name, value]) => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = name;
                input.value = value;
                container.appendChild(input);
            });
        });
    }

    function addProduct(button) {
        const element = button.closest('.product');
        const id = element.dataset.id;
        const modeSelect = element.querySelector('.mode-select');
        const mode = modeSelect ? modeSelect.value : 'package';

        const existing = cart[id];
        const nextQuantity = (existing?.quantity || 0) + 1;
        const stockNeeded = nextQuantity * getStockPerSale(element, mode);
        const availableStock = Number(element.dataset.stock);

        if (stockNeeded > availableStock) {
            alert('Not enough stock available for ' +
                element.querySelector('.product-name').textContent + '.');
            return;
        }

        const newItemAmount = getProductPrice(element, mode);
        const requestedTotal = getCartTotal() + newItemAmount;

        if (creditLimit > 0 &&
            currentBalance + requestedTotal > creditLimit) {
            showCreditModal(requestedTotal);
            return;
        }

        cart[id] = {
            id: id,
            element: element,
            quantity: nextQuantity,
            mode: mode
        };

        renderProduct(element);
        updateTotals();
    }

    function changeQuantity(id, change) {
        const item = cart[id];
        if (!item) return;

        const nextQuantity = item.quantity + change;

        if (nextQuantity <= 0) {
            delete cart[id];
            renderProduct(item.element);
            updateTotals();
            return;
        }

        const stockNeeded = nextQuantity * getStockPerSale(item.element, item.mode);

        if (stockNeeded > Number(item.element.dataset.stock)) {
            alert('Not enough stock available.');
            return;
        }

        const proposedTotal = getCartTotal() +
            change * getProductPrice(item.element, item.mode);

        if (creditLimit > 0 &&
            currentBalance + proposedTotal > creditLimit) {
            showCreditModal(proposedTotal);
            return;
        }

        item.quantity = nextQuantity;
        renderProduct(item.element);
        updateTotals();
    }

    function renderProduct(element) {
        const id = element.dataset.id;
        const item = cart[id];
        const actions = element.querySelector('.product-actions');

        element.classList.toggle('selected', Boolean(item));

        if (item) {
            actions.innerHTML = `
                <div class="qty-control">
                    <button type="button" class="qty-btn"
                        onclick="changeQuantity('${id}', -1)">
                        <i class="fa-solid fa-minus"></i>
                    </button>
                    <span class="qty-value">${item.quantity}</span>
                    <button type="button" class="qty-btn"
                        onclick="changeQuantity('${id}', 1)">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>
            `;
        } else {
            const canChooseItem = element.dataset.itemAvailable === '1';

            actions.innerHTML = `
                ${canChooseItem ? `
                    <select class="mode-select" aria-label="Sale type">
                        <option value="package">Package</option>
                        <option value="item">Single item</option>
                    </select>
                ` : ''}
                <button type="button" class="add-btn" onclick="addProduct(this)">
                    <i class="fa-solid fa-plus"></i> Add
                </button>
            `;
        }
    }

    function showCreditModal(requested) {
        const remaining = Math.max(0, creditLimit - currentBalance);

        document.getElementById('modalCurrent').textContent = money(currentBalance);
        document.getElementById('modalLimit').textContent = money(creditLimit);
        document.getElementById('modalBalance').textContent = money(currentBalance);
        document.getElementById('modalRemaining').textContent = money(remaining);
        document.getElementById('modalRequested').textContent = money(requested);

        document.getElementById('creditModal').classList.add('show');
    }

    function closeCreditModal() {
        document.getElementById('creditModal').classList.remove('show');
    }

    document.getElementById('manualAmount').addEventListener('input', function () {
        updateTotals();
    });

    document.getElementById('productSearch').addEventListener('input', function () {
        const search = this.value.toLowerCase().trim();

        products.forEach(product => {
            const name = product.dataset.name || '';
            product.style.display = name.includes(search) ? 'flex' : 'none';
        });
    });

    document.getElementById('creditModal').addEventListener('click', function (event) {
        if (event.target === this) closeCreditModal();
    });

    document.getElementById('creditForm').addEventListener('submit', function (event) {
        const count = getCartCount();
        const amount = count > 0
            ? getCartTotal()
            : Number(document.getElementById('manualAmount').value || 0);

        if (amount <= 0) {
            event.preventDefault();
            alert('Select products or enter an amount greater than zero.');
            return;
        }

        if (creditLimit > 0 && currentBalance + amount > creditLimit) {
            event.preventDefault();
            showCreditModal(amount);
            return;
        }

        const button = document.getElementById('saveButton');
        button.disabled = true;
        button.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Saving credit sale...';
    });

    updateTotals();
</script>

</body>
</html>
