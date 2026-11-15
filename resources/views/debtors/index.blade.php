
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Debtors | Track&Tally</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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

        /* SIDEBAR */

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 245px;
            height: 100vh;
            padding: 25px 14px;
            background: var(--navy);
            color: white;
            display: flex;
            flex-direction: column;
            z-index: 1000;
            overflow-y: auto;
            transition: transform .3s ease;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 12px 34px;
        }

        .brand img {
            width: 43px;
            height: 43px;
            object-fit: contain;
            border-radius: 10px;
            background: white;
            padding: 3px;
        }

        .brand-name {
            font-size: 19px;
            font-weight: 900;
            letter-spacing: -.7px;
        }

        .brand-name span {
            color: var(--gold-light);
        }

        .menu-label {
            color: #9AABC2;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.5px;
            padding: 0 14px;
            margin: 8px 0 13px;
        }

        .nav-menu {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 14px;
            min-height: 47px;
            padding: 12px 14px;
            color: #D3DCE9;
            text-decoration: none;
            border-radius: 11px;
            border-left: 3px solid transparent;
            font-size: 12px;
            font-weight: 600;
            transition: .2s ease;
        }

        .nav-link i {
            width: 19px;
            text-align: center;
            font-size: 14px;
        }

        .nav-link:hover {
            background: rgba(255,255,255,.08);
            color: white;
        }

        .nav-link.active {
            background: #344A69;
            border-left-color: var(--gold);
            color: white;
            font-weight: 800;
        }

        .nav-link.active i {
            color: var(--gold-light);
        }

        .sidebar-bottom {
            margin-top: auto;
        }

        .sidebar-profile {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 23px 10px 17px;
            border-top: 1px solid rgba(255,255,255,.1);
        }

        .profile-avatar {
            width: 38px;
            height: 38px;
            min-width: 38px;
            display: grid;
            place-items: center;
            border-radius: 11px;
            background: var(--gold);
            color: var(--navy);
            font-size: 15px;
            font-weight: 900;
        }

        .profile-info {
            min-width: 0;
        }

        .profile-info strong {
            display: block;
            color: white;
            font-size: 11px;
            font-weight: 800;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .profile-info small {
            display: block;
            color: #A9B8CC;
            font-size: 10px;
            margin-top: 4px;
        }

        .logout-button {
            width: 100%;
            min-height: 42px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            border: 0;
            border-radius: 11px;
            background: #2B4161;
            color: white;
            font-size: 11px;
            font-weight: 800;
            cursor: pointer;
            transition: .2s;
        }

        .logout-button:hover {
            background: #405779;
        }

        /* MOBILE SIDEBAR */

        .mobile-menu-button {
            display: none;
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1100;
            width: 43px;
            height: 43px;
            border: 0;
            border-radius: 11px;
            background: var(--navy);
            color: white;
            font-size: 17px;
            cursor: pointer;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(10,20,35,.5);
            z-index: 900;
        }

        .sidebar-overlay.show {
            display: block;
        }

        /* MAIN */

        .main {
            width: calc(100% - 245px);
            max-width: 1600px;
            margin-left: 245px;
            padding: 34px 40px 55px;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--muted);
            font-size: 10px;
            font-weight: 600;
            margin-bottom: 25px;
        }

        .breadcrumb a {
            color: var(--muted);
            text-decoration: none;
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
            gap: 15px;
        }

        .title-icon {
            width: 57px;
            height: 57px;
            border-radius: 17px;
            display: grid;
            place-items: center;
            background: linear-gradient(145deg, var(--navy), var(--navy-light));
            color: var(--gold-light);
            font-size: 23px;
            box-shadow: 0 8px 18px rgba(23,43,77,.15);
        }

        .page-title {
            color: var(--navy);
            font-size: 27px;
            font-weight: 900;
            letter-spacing: -.8px;
        }

        .page-subtitle {
            color: var(--muted);
            font-size: 11px;
            margin-top: 6px;
        }

        .add-button {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            min-height: 46px;
            padding: 0 19px;
            border: 1px solid #D5A323;
            border-radius: 12px;
            background: linear-gradient(135deg, #F4D77F, #D9A928);
            color: var(--navy-dark);
            text-decoration: none;
            font-size: 11px;
            font-weight: 900;
            box-shadow: 0 5px 13px rgba(217,169,40,.2);
            transition: .25s;
        }

        .add-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 9px 20px rgba(217,169,40,.3);
        }

        /* SUMMARY BANNER */

        .summary-banner {
            position: relative;
            overflow: hidden;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            padding: 27px 30px;
            margin-bottom: 23px;
            border-radius: 19px;
            background: linear-gradient(115deg, #142640, #29456F);
            color: white;
            box-shadow: 0 10px 25px rgba(23,43,77,.12);
        }

        .summary-banner::after {
            content: "";
            position: absolute;
            width: 250px;
            height: 250px;
            right: 10%;
            top: -160px;
            border: 35px solid rgba(255,255,255,.045);
            border-radius: 50%;
        }

        .summary-content {
            position: relative;
            z-index: 1;
        }

        .summary-label {
            color: #C4D0E0;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .summary-amount {
            margin-top: 9px;
            color: var(--gold-light);
            font-size: 30px;
            font-weight: 900;
            letter-spacing: -.7px;
        }

        .summary-description {
            margin-top: 7px;
            color: #D0D9E5;
            font-size: 10px;
        }

        .summary-icon {
            position: relative;
            z-index: 1;
            width: 65px;
            height: 65px;
            display: grid;
            place-items: center;
            border-radius: 18px;
            border: 1px solid rgba(240,199,94,.3);
            background: rgba(217,169,40,.14);
            color: var(--gold-light);
            font-size: 27px;
        }

        /* ALERTS */

        .alert {
            display: flex;
            align-items: flex-start;
            gap: 11px;
            padding: 14px 17px;
            margin-bottom: 17px;
            border-radius: 12px;
            font-size: 11px;
        }

        .alert-success {
            background: var(--green-soft);
            border: 1px solid #CBE9D7;
            color: var(--green);
        }

        .alert-danger {
            background: var(--red-soft);
            border: 1px solid #F5D1CF;
            color: var(--red);
        }

        /* STATISTICS */

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 27px;
        }

        .stat-card {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 20px;
            min-height: 103px;
            border: 1px solid var(--border);
            border-radius: 16px;
            background: white;
            box-shadow: var(--shadow);
            transition: .2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            border-color: rgba(217,169,40,.5);
        }

        .stat-icon {
            width: 45px;
            height: 45px;
            min-width: 45px;
            display: grid;
            place-items: center;
            border-radius: 13px;
            font-size: 18px;
        }

        .stat-icon.gold {
            background: var(--gold-soft);
            color: #A98231;
        }

        .stat-icon.blue {
            background: #EAF2FC;
            color: #3476C5;
        }

        .stat-icon.green {
            background: var(--green-soft);
            color: var(--green);
        }

        .stat-label {
            color: var(--muted);
            font-size: 10px;
            font-weight: 700;
        }

        .stat-value {
            margin-top: 6px;
            color: var(--navy);
            font-size: 21px;
            font-weight: 900;
        }

        /* TABLE CARD */

        .table-card {
            overflow: hidden;
            border: 1px solid var(--border);
            border-radius: 18px;
            background: white;
            box-shadow: var(--shadow);
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 17px;
            flex-wrap: wrap;
            padding: 22px 23px;
            border-bottom: 1px solid var(--border);
        }

        .table-heading h2 {
            color: var(--navy);
            font-size: 15px;
            font-weight: 900;
        }

        .table-heading p {
            color: var(--muted);
            font-size: 10px;
            margin-top: 5px;
        }

        .table-tools {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .search-box {
            position: relative;
            width: 235px;
        }

        .search-box i {
            position: absolute;
            top: 50%;
            left: 13px;
            transform: translateY(-50%);
            color: #9AA4B2;
            font-size: 11px;
        }

        .search-box input {
            width: 100%;
            height: 40px;
            padding: 0 12px 0 35px;
            border: 1px solid var(--border);
            border-radius: 10px;
            outline: none;
            background: #FCFCFA;
            color: var(--text);
            font-size: 10px;
            transition: .2s;
        }

        .search-box input:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(217,169,40,.1);
        }

        .sort-select {
            height: 40px;
            padding: 0 11px;
            border: 1px solid var(--border);
            border-radius: 10px;
            outline: none;
            background: white;
            color: var(--navy);
            font-size: 10px;
            font-weight: 700;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 850px;
            border-collapse: collapse;
        }

        thead {
            background: #F8F9FB;
        }

        th {
            padding: 14px 17px;
            color: #8290A2;
            text-align: left;
            font-size: 9px;
            font-weight: 900;
            letter-spacing: .6px;
            text-transform: uppercase;
            white-space: nowrap;
        }

        td {
            padding: 15px 17px;
            border-bottom: 1px solid #F0F1F3;
            color: var(--text);
            font-size: 10px;
            vertical-align: middle;
        }

        tbody tr {
            transition: .2s;
        }

        tbody tr:hover {
            background: #FCFBF7;
        }

        tbody tr:last-child td {
            border-bottom: 0;
        }

        .debtor-name {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 160px;
        }

        .debtor-avatar {
            width: 36px;
            height: 36px;
            min-width: 36px;
            display: grid;
            place-items: center;
            border-radius: 11px;
            background: var(--gold-soft);
            color: var(--navy);
            font-size: 12px;
            font-weight: 900;
        }

        .debtor-info strong {
            display: block;
            color: var(--navy);
            font-size: 10px;
            font-weight: 900;
        }

        .debtor-info small {
            display: block;
            color: var(--muted);
            font-size: 9px;
            margin-top: 4px;
        }

        .balance {
            color: var(--red);
            font-weight: 900;
            white-space: nowrap;
        }

        .no-balance {
            color: var(--green);
            font-weight: 900;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 10px;
            border-radius: 30px;
            font-size: 9px;
            font-weight: 900;
            white-space: nowrap;
        }

        .status.unpaid {
            color: #B43D39;
            background: #FDEDEC;
        }

        .status.paid {
            color: var(--green);
            background: var(--green-soft);
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        .action-btn {
            width: 31px;
            height: 31px;
            display: inline-grid;
            place-items: center;
            border: 1px solid transparent;
            border-radius: 9px;
            text-decoration: none;
            cursor: pointer;
            font-size: 11px;
            transition: .2s;
        }

        .action-view {
            color: #3476C5;
            background: #EAF2FC;
        }

        .action-edit {
            color: #A98231;
            background: var(--gold-soft);
        }

        .action-delete {
            color: var(--red);
            background: var(--red-soft);
        }

        .action-btn:hover {
            transform: translateY(-2px);
            filter: brightness(.96);
        }

        .delete-form {
            display: inline;
        }

        /* EMPTY STATE */

        .empty-state {
            padding: 60px 20px;
            text-align: center;
        }

        .empty-icon {
            width: 67px;
            height: 67px;
            margin: 0 auto 17px;
            display: grid;
            place-items: center;
            border-radius: 20px;
            background: var(--gold-soft);
            color: var(--gold);
            font-size: 25px;
        }

        .empty-state h3 {
            color: var(--navy);
            font-size: 15px;
            font-weight: 900;
        }

        .empty-state p {
            margin-top: 7px;
            color: var(--muted);
            font-size: 10px;
        }

        .empty-state a {
            display: inline-flex;
            margin-top: 17px;
            padding: 11px 17px;
            border-radius: 10px;
            background: var(--navy);
            color: white;
            text-decoration: none;
            font-size: 10px;
            font-weight: 800;
        }

        .no-results {
            display: none;
            padding: 35px 15px;
            color: var(--muted);
            text-align: center;
            font-size: 11px;
        }

        /* FOOTER */

        .table-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            padding: 15px 22px;
            border-top: 1px solid var(--border);
            color: var(--muted);
            font-size: 10px;
        }

        /* RESPONSIVE */

        @media(max-width: 1100px) {
            .main {
                padding: 28px 24px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width: 760px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .mobile-menu-button {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .main {
                width: 100%;
                margin-left: 0;
                padding: 75px 15px 35px;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .page-title {
                font-size: 23px;
            }

            .add-button {
                width: 100%;
            }

            .summary-banner {
                padding: 22px;
            }

            .summary-amount {
                font-size: 25px;
            }

            .table-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .table-tools {
                width: 100%;
            }

            .search-box {
                width: 100%;
                flex: 1;
            }

            .sort-select {
                max-width: 125px;
            }

            .stats-grid {
                gap: 10px;
            }

            .stat-card {
                padding: 14px;
            }

            .stat-value {
                font-size: 18px;
            }
        }

        @media(max-width: 430px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .summary-icon {
                display: none;
            }

            .title-icon {
                width: 48px;
                height: 48px;
            }

            .title-area {
                gap: 11px;
            }
        }

        @media print {
            .sidebar,
            .mobile-menu-button,
            .sidebar-overlay,
            .add-button,
            .table-tools,
            .actions,
            .breadcrumb {
                display: none !important;
            }

            .main {
                width: 100%;
                margin: 0;
                padding: 15px;
            }

            body {
                background: white;
            }

            .table-card,
            .stat-card,
            .summary-banner {
                box-shadow: none;
            }
        }
    </style>
</head>

<body>

@php
    /*
    |--------------------------------------------------------------------------
    | SAFE DEBTOR DATA
    |--------------------------------------------------------------------------
    | Supports a Laravel paginator, collection, or plain array.
    */

    $debtorRecords = $debtors ?? collect();

    $debtorCollection = $debtorRecords instanceof \Illuminate\Contracts\Pagination\Paginator
        || $debtorRecords instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator
        ? collect($debtorRecords->items())
        : collect($debtorRecords);

    $totalDebtors = method_exists($debtorRecords, 'total')
        ? $debtorRecords->total()
        : $debtorCollection->count();

    $totalOutstanding = $debtorCollection->sum(function ($debtor) {
        return max(0, (float) ($debtor->balance ?? $debtor->total_balance ?? 0));
    });

    $unpaidDebtors = $debtorCollection->filter(function ($debtor) {
        return (float) ($debtor->balance ?? $debtor->total_balance ?? 0) > 0;
    })->count();

    $paidDebtors = $debtorCollection->filter(function ($debtor) {
        return (float) ($debtor->balance ?? $debtor->total_balance ?? 0) <= 0;
    })->count();

    $userName = session('full_name') ?? 'Susan Mae';
    $storeName = session('store_name') ?? 'Susan Store';
@endphp

<button class="mobile-menu-button" id="mobileMenuButton" type="button" aria-label="Open navigation">
    <i class="fa-solid fa-bars"></i>
</button>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

{{-- SIDEBAR --}}

<aside class="sidebar" id="sidebar">

    <div class="brand">
        <img src="{{ asset('icon.png') }}" alt="Track&Tally Logo">
        <div class="brand-name">Track<span>&</span>Tally</div>
    </div>

    <div class="menu-label">MAIN MENU</div>

    <nav class="nav-menu">

        <a href="{{ url('/dashboard') }}" class="nav-link">
            <i class="fa-solid fa-house"></i>
            <span>Home</span>
        </a>

        <a href="{{ route('debtors.index') }}" class="nav-link active">
            <i class="fa-solid fa-users"></i>
            <span>Debtors</span>
        </a>

        <a href="{{ url('/sell') }}" class="nav-link">
            <i class="fa-solid fa-cart-shopping"></i>
            <span>Sell</span>
        </a>

        <a href="{{ route('inventory.index') }}" class="nav-link">
            <i class="fa-solid fa-boxes-stacked"></i>
            <span>Inventory</span>
        </a>

        {{-- FUNCTIONAL REPORTS LINK --}}
        <a href="{{ route('reports.index') }}" class="nav-link">
            <i class="fa-solid fa-chart-column"></i>
            <span>Reports</span>
        </a>

    </nav>

    <div class="sidebar-bottom">

        <div class="sidebar-profile">
            <div class="profile-avatar">
                {{ strtoupper(substr($userName, 0, 1)) }}
            </div>

            <div class="profile-info">
                <strong>{{ $userName }}</strong>
                <small>{{ $storeName }}</small>
            </div>
        </div>

        <form method="POST" action="{{ url('/logout') }}">
            @csrf
            <button type="submit" class="logout-button">
                <i class="fa-solid fa-right-from-bracket"></i>
                Log Out
            </button>
        </form>

    </div>

</aside>

{{-- MAIN CONTENT --}}

<main class="main">

    <div class="breadcrumb">
        <a href="{{ url('/dashboard') }}">Home</a>
        <i class="fa-solid fa-chevron-right"></i>
        <span class="current">Debtors</span>
    </div>

    {{-- HEADER --}}

    <header class="topbar">

        <div class="title-area">
            <div class="title-icon">
                <i class="fa-solid fa-users"></i>
            </div>

            <div>
                <h1 class="page-title">Debtors Management</h1>
                <p class="page-subtitle">
                    Manage customer credit records and monitor outstanding balances.
                </p>
            </div>
        </div>

        <a href="{{ route('debtors.create') }}" class="add-button">
            <i class="fa-solid fa-plus"></i>
            Add New Debtor
        </a>

    </header>

    {{-- SUMMARY --}}

    <section class="summary-banner">

        <div class="summary-content">
            <div class="summary-label">Total Outstanding Balance</div>

            <div class="summary-amount">
                ₱{{ number_format($totalOutstanding, 2) }}
            </div>

            <div class="summary-description">
                Combined unpaid balance of the debtors displayed on this page.
            </div>
        </div>

        <div class="summary-icon">
            <i class="fa-solid fa-wallet"></i>
        </div>

    </section>

    {{-- ALERTS --}}

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            <i class="fa-solid fa-circle-exclamation"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <i class="fa-solid fa-circle-exclamation"></i>
            <div>
                <strong>Please check the following:</strong>
                <ul style="margin:7px 0 0 17px;line-height:1.8;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    {{-- STATISTICS --}}

    <section class="stats-grid">

        <div class="stat-card">
            <div class="stat-icon blue">
                <i class="fa-solid fa-users"></i>
            </div>

            <div>
                <div class="stat-label">Total Debtors</div>
                <div class="stat-value">{{ number_format($totalDebtors) }}</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon gold">
                <i class="fa-solid fa-clock"></i>
            </div>

            <div>
                <div class="stat-label">With Outstanding Balance</div>
                <div class="stat-value">{{ number_format($unpaidDebtors) }}</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon green">
                <i class="fa-solid fa-circle-check"></i>
            </div>

            <div>
                <div class="stat-label">Fully Paid</div>
                <div class="stat-value">{{ number_format($paidDebtors) }}</div>
            </div>
        </div>

    </section>

    {{-- DEBTOR TABLE --}}

    <section class="table-card">

        <div class="table-header">

            <div class="table-heading">
                <h2>Customer Records</h2>
                <p>View and manage your registered debtors.</p>
            </div>

            <div class="table-tools">

                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>

                    <input
                        type="search"
                        id="debtorSearch"
                        placeholder="Search name, contact, address..."
                        autocomplete="off"
                    >
                </div>

                <select class="sort-select" id="debtorSort">
                    <option value="default">Sort by</option>
                    <option value="name-asc">Name A–Z</option>
                    <option value="name-desc">Name Z–A</option>
                    <option value="balance-desc">Highest Balance</option>
                    <option value="balance-asc">Lowest Balance</option>
                </select>

            </div>

        </div>

        @if($debtorCollection->isNotEmpty())

            <div class="table-responsive">

                <table id="debtorsTable">

                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Contact Number</th>
                            <th>Address</th>
                            <th>Outstanding Balance</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody id="debtorTableBody">

                        @foreach($debtorCollection as $debtor)

                            @php
                                $name = $debtor->full_name ?? $debtor->name ?? 'Unnamed Customer';
                                $contact = $debtor->contact ?? $debtor->phone_number ?? 'Not provided';
                                $address = $debtor->address ?? 'Not provided';
                                $balance = (float) ($debtor->balance ?? $debtor->total_balance ?? 0);
                                $initials = collect(explode(' ', trim($name)))
                                    ->filter()
                                    ->take(2)
                                    ->map(fn($part) => strtoupper(substr($part, 0, 1)))
                                    ->implode('');
                            @endphp

                            <tr
                                class="debtor-row"
                                data-name="{{ strtolower($name) }}"
                                data-contact="{{ strtolower($contact) }}"
                                data-address="{{ strtolower($address) }}"
                                data-balance="{{ $balance }}"
                            >

                                <td>
                                    <div class="debtor-name">

                                        <div class="debtor-avatar">
                                            {{ $initials ?: 'D' }}
                                        </div>

                                        <div class="debtor-info">
                                            <strong>{{ $name }}</strong>
                                            <small>Customer #{{ $debtor->id }}</small>
                                        </div>

                                    </div>
                                </td>

                                <td>{{ $contact }}</td>

                                <td>{{ $address }}</td>

                                <td>
                                    @if($balance > 0)
                                        <span class="balance">
                                            ₱{{ number_format($balance, 2) }}
                                        </span>
                                    @else
                                        <span class="no-balance">₱0.00</span>
                                    @endif
                                </td>

                                <td>
                                    @if($balance > 0)
                                        <span class="status unpaid">
                                            <i class="fa-solid fa-clock"></i>
                                            Unpaid
                                        </span>
                                    @else
                                        <span class="status paid">
                                            <i class="fa-solid fa-circle-check"></i>
                                            Fully Paid
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <div class="actions">

                                        <a
                                            href="{{ route('debtors.show', $debtor->id) }}"
                                            class="action-btn action-view"
                                            title="View Debtor"
                                        >
                                            <i class="fa-solid fa-eye"></i>
                                        </a>

                                        <a
                                            href="{{ route('debtors.edit', $debtor->id) }}"
                                            class="action-btn action-edit"
                                            title="Edit Debtor"
                                        >
                                            <i class="fa-solid fa-pen"></i>
                                        </a>

                                        <form
                                            method="POST"
                                            action="{{ route('debtors.destroy', $debtor->id) }}"
                                            class="delete-form"
                                            onsubmit="return confirmDeleteDebtor(event, {{ $balance }})"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="action-btn action-delete"
                                                title="Delete Debtor"
                                            >
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            <div class="no-results" id="noResults">
                <i class="fa-solid fa-magnifying-glass" style="font-size:22px;margin-bottom:10px;"></i>
                <p>No matching debtor records found.</p>
            </div>

            <div class="table-footer">
                <span>
                    Showing
                    <strong id="visibleCount">{{ $debtorCollection->count() }}</strong>
                    of {{ $totalDebtors }} debtor records on this page
                </span>

                <span>
                    <i class="fa-solid fa-shield-halved"></i>
                    Track&Tally Customer Records
                </span>
            </div>

            @if(method_exists($debtorRecords, 'links'))
                <div style="padding:15px 22px;border-top:1px solid var(--border);">
                    {{ $debtorRecords->links() }}
                </div>
            @endif

        @else

            <div class="empty-state">

                <div class="empty-icon">
                    <i class="fa-solid fa-users"></i>
                </div>

                <h3>No Debtors Yet</h3>

                <p>
                    You have not added any debtors. Start by registering your first customer.
                </p>

                <a href="{{ route('debtors.create') }}">
                    <i class="fa-solid fa-plus"></i>
                    Add Your First Debtor
                </a>

            </div>

        @endif

    </section>

</main>

<script>
    // MOBILE SIDEBAR

    const sidebar = document.getElementById('sidebar');
    const mobileMenuButton = document.getElementById('mobileMenuButton');
    const sidebarOverlay = document.getElementById('sidebarOverlay');

    function closeSidebar() {
        sidebar.classList.remove('open');
        sidebarOverlay.classList.remove('show');
    }

    mobileMenuButton.addEventListener('click', function () {
        sidebar.classList.toggle('open');
        sidebarOverlay.classList.toggle('show');
    });

    sidebarOverlay.addEventListener('click', closeSidebar);

    // SEARCH DEBTORS

    const searchInput = document.getElementById('debtorSearch');
    const tableBody = document.getElementById('debtorTableBody');
    const sortSelect = document.getElementById('debtorSort');
    const noResults = document.getElementById('noResults');
    const visibleCount = document.getElementById('visibleCount');

    function filterDebtors() {
        if (!tableBody) return;

        const search = searchInput.value.toLowerCase().trim();
        const rows = Array.from(tableBody.querySelectorAll('.debtor-row'));

        let visible = 0;

        rows.forEach(row => {
            const searchableText = [
                row.dataset.name,
                row.dataset.contact,
                row.dataset.address
            ].join(' ');

            const matches = searchableText.includes(search);

            row.style.display = matches ? '' : 'none';

            if (matches) visible++;
        });

        visibleCount.textContent = visible;

        if (noResults) {
            noResults.style.display = visible === 0 ? 'block' : 'none';
        }
    }

    if (searchInput) {
        searchInput.addEventListener('input', filterDebtors);
    }

    // SORT DEBTORS

    if (sortSelect && tableBody) {
        sortSelect.addEventListener('change', function () {
            const rows = Array.from(tableBody.querySelectorAll('.debtor-row'));

            rows.sort((a, b) => {
                switch (this.value) {
                    case 'name-asc':
                        return a.dataset.name.localeCompare(b.dataset.name);

                    case 'name-desc':
                        return b.dataset.name.localeCompare(a.dataset.name);

                    case 'balance-desc':
                        return Number(b.dataset.balance) - Number(a.dataset.balance);

                    case 'balance-asc':
                        return Number(a.dataset.balance) - Number(b.dataset.balance);

                    default:
                        return Number(a.dataset.balance) - Number(b.dataset.balance);
                }
            });

            rows.forEach(row => tableBody.appendChild(row));

            filterDebtors();
        });
    }

    // DELETE CONFIRMATION

    function confirmDeleteDebtor(event, balance) {
        if (Number(balance) > 0) {
            event.preventDefault();

            alert(
                'This debtor still has an outstanding balance. Please record the payment before deleting this debtor.'
            );

            return false;
        }

        return confirm(
            'Are you sure you want to delete this debtor? This action cannot be undone.'
        );
    }
</script>

</body>
</html>
