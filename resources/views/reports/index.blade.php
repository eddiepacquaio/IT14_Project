
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Reports | Track&Tally</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root {
            --navy: #192e50;
            --navy-dark: #142642;
            --navy-light: #344966;
            --gold: #e5ad20;
            --gold-light: #f6d77d;
            --cream: #f8f7f2;
            --white: #ffffff;
            --text: #263348;
            --muted: #8992a1;
            --border: #e9e7df;
            --green: #278653;
            --red: #c64b4b;
            --shadow: 0 8px 24px rgba(25,46,80,.06);
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
        }

        button, input, select {
            font: inherit;
        }

        /* =========================================
           SIDEBAR - MATCHING REFERENCE DESIGN
        ========================================= */

        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            width: 246px;
            height: 100vh;
            background: #192e50;
            color: white;
            padding: 26px 15px 28px;
            display: flex;
            flex-direction: column;
            z-index: 100;
            border-right: 1px solid rgba(255,255,255,.08);
            transition: transform .25s ease;
        }

        /* BRAND */

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 10px;
            margin-bottom: 36px;
        }

        .brand img {
            width: 43px;
            height: 43px;
            object-fit: contain;
            border-radius: 10px;
            flex-shrink: 0;
        }

        .brand-name {
            font-size: 18px;
            font-weight: 900;
            letter-spacing: -.7px;
            color: white;
            white-space: nowrap;
        }

        .brand-name span {
            color: var(--gold);
        }

        /* MENU LABEL */

        .menu-label {
            color: #8497b4;
            font-size: 10px;
            font-weight: 900;
            letter-spacing: 1.5px;
            padding: 0 12px;
            margin-bottom: 13px;
        }

        /* NAVIGATION */

        .nav-list {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .nav-link {
            position: relative;
            display: flex;
            align-items: center;
            gap: 15px;
            min-height: 48px;
            color: #d5ddec;
            text-decoration: none;
            padding: 13px 15px;
            border-radius: 11px;
            font-size: 13px;
            font-weight: 700;
            transition: all .2s ease;
            overflow: hidden;
        }

        .nav-link i {
            width: 19px;
            text-align: center;
            font-size: 14px;
            color: #c3cee0;
            transition: .2s;
        }

        .nav-link:hover {
            color: white;
            background: rgba(255,255,255,.07);
        }

        .nav-link:hover i {
            color: var(--gold);
        }

        /* ACTIVE MENU */

        .nav-link.active {
            color: white;
            background: #344966;
            box-shadow: inset 3px 0 var(--gold);
        }

        .nav-link.active i {
            color: white;
        }

        /* SIDEBAR BOTTOM */

        .sidebar-bottom {
            margin-top: auto;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 27px 10px 20px;
            border-top: 1px solid rgba(255,255,255,.13);
            margin-top: 20px;
        }

        .avatar {
            width: 38px;
            height: 38px;
            min-width: 38px;
            border-radius: 12px;
            background: var(--gold);
            color: var(--navy);
            display: grid;
            place-items: center;
            font-size: 15px;
            font-weight: 900;
        }

        .profile-name {
            font-size: 12px;
            font-weight: 800;
            color: white;
        }

        .profile-store {
            font-size: 10px;
            color: #9eafc8;
            margin-top: 4px;
        }

        /* LOGOUT BUTTON */

        .logout-form {
            padding: 0;
        }

        .logout-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            border: none;
            background: #2a4162;
            color: white;
            width: 100%;
            min-height: 40px;
            padding: 11px;
            border-radius: 11px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 800;
            text-align: center;
            transition: all .2s ease;
        }

        .logout-btn:hover {
            background: #354f73;
            color: white;
            transform: translateY(-1px);
        }

        /* =========================================
           MAIN CONTENT
        ========================================= */

        .main {
            margin-left: 246px;
            min-height: 100vh;
            padding: 32px 38px 55px;
        }

        .mobile-top {
            display: none;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .menu-toggle {
            border: 0;
            background: var(--navy);
            color: white;
            width: 42px;
            height: 42px;
            border-radius: 12px;
            cursor: pointer;
        }

        .page-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 27px;
        }

        .eyebrow {
            color: var(--gold);
            font-size: 10px;
            font-weight: 900;
            letter-spacing: 1.6px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        h1 {
            color: var(--navy);
            font-size: clamp(25px, 3vw, 33px);
            font-weight: 900;
            letter-spacing: -1.2px;
        }

        .page-subtitle {
            color: var(--muted);
            font-size: 12px;
            margin-top: 7px;
        }

        .top-date {
            background: white;
            border: 1px solid var(--border);
            padding: 12px 15px;
            border-radius: 12px;
            color: var(--navy);
            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
        }

        /* ALERTS */

        .alert {
            padding: 13px 16px;
            border-radius: 12px;
            margin-bottom: 18px;
            font-size: 12px;
            font-weight: 700;
        }

        .alert-success {
            color: #216b43;
            background: #eaf7ef;
            border: 1px solid #ccebd7;
        }

        .alert-error {
            color: #a43c3c;
            background: #fff0f0;
            border: 1px solid #f3d0d0;
        }

        /* TABS */

        .tabs {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 8px;
            padding: 6px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: var(--shadow);
            margin-bottom: 25px;
        }

        .tab {
            text-decoration: none;
            border: 0;
            cursor: pointer;
            border-radius: 11px;
            padding: 13px 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            color: var(--muted);
            background: transparent;
            font-size: 12px;
            font-weight: 800;
            transition: .2s;
        }

        .tab:hover {
            background: var(--cream);
            color: var(--navy);
        }

        .tab.active {
            color: white;
            background: var(--navy);
        }

        .tab.active i {
            color: var(--gold-light);
        }

        /* SECTION HEADINGS */

        .section-heading {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 26px 0 16px;
        }

        .section-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: white;
            border: 1px solid var(--border);
            color: var(--navy);
            display: grid;
            place-items: center;
        }

        .section-heading h2 {
            font-size: 15px;
            color: var(--navy);
            font-weight: 900;
        }

        .section-heading p {
            font-size: 10px;
            color: var(--muted);
            margin-top: 4px;
        }

        /* CARDS */

        .period-card,
        .panel,
        .metric-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 17px;
            box-shadow: var(--shadow);
        }

        .period-card {
            padding: 17px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 18px;
        }

        .period-title {
            color: var(--navy);
            font-size: 13px;
            font-weight: 900;
        }

        .period-description {
            color: var(--muted);
            font-size: 10px;
            margin-top: 4px;
        }

        .period-options {
            display: flex;
            gap: 7px;
        }

        .period-btn {
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 10px;
            background: var(--cream);
            border: 1px solid var(--border);
            color: var(--navy);
            font-size: 11px;
            font-weight: 800;
            transition: .2s;
        }

        .period-btn:hover {
            border-color: var(--gold);
        }

        .period-btn.active {
            color: white;
            background: var(--navy);
            border-color: var(--navy);
        }

        /* METRICS */

        .metrics {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 25px;
        }

        .metric-card {
            padding: 18px;
            min-width: 0;
            transition: .2s;
        }

        .metric-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 28px rgba(25,46,80,.10);
        }

        .metric-icon {
            width: 39px;
            height: 39px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            background: #f7f3e8;
            color: var(--navy);
            margin-bottom: 15px;
        }

        .metric-icon.red {
            background: #fff0f0;
            color: var(--red);
        }

        .metric-icon.green {
            background: #eaf7ef;
            color: var(--green);
        }

        .metric-label {
            color: var(--muted);
            font-size: 10px;
            font-weight: 800;
        }

        .metric-value {
            color: var(--navy);
            font-size: clamp(17px, 2vw, 23px);
            font-weight: 900;
            margin-top: 7px;
            overflow-wrap: anywhere;
        }

        .metric-value.red {
            color: var(--red);
        }

        .metric-value.green {
            color: var(--green);
        }

        /* PANELS AND TABLES */

        .panel {
            overflow: hidden;
            margin-bottom: 22px;
        }

        .panel-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 17px 19px;
            border-bottom: 1px solid var(--border);
        }

        .panel-head h3 {
            color: var(--navy);
            font-size: 13px;
            font-weight: 900;
        }

        .panel-head p {
            color: var(--muted);
            font-size: 10px;
            margin-top: 4px;
        }

        .table-wrap {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 530px;
        }

        th {
            background: #fbfaf6;
            color: #9299a5;
            text-align: left;
            padding: 12px 18px;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: .8px;
            font-weight: 900;
        }

        td {
            padding: 14px 18px;
            border-top: 1px solid #f0efe9;
            font-size: 11px;
            color: var(--text);
        }

        tbody tr:hover {
            background: #fdfcf8;
        }

        .amount {
            text-align: right;
            font-weight: 900;
            color: var(--navy);
            white-space: nowrap;
        }

        .amount.red {
            color: var(--red);
        }

        .amount.green {
            color: var(--green);
        }

        .date-cell {
            font-weight: 800;
            color: var(--navy);
        }

        .sub-cell {
            display: block;
            font-size: 9px;
            color: var(--muted);
            margin-top: 4px;
        }

        /* BADGES */

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 9px;
            border-radius: 20px;
            font-size: 9px;
            font-weight: 900;
            white-space: nowrap;
        }

        .badge.cash {
            color: #225d91;
            background: #edf5fc;
        }

        .badge.credit {
            color: #a34848;
            background: #fff0f0;
        }

        .badge.payment {
            color: #24764a;
            background: #eaf7ef;
        }

        .badge.wallet {
            color: #795e15;
            background: #fff7df;
        }

        .badge.stock {
            color: #a34848;
            background: #fff0f0;
        }

        /* EMPTY STATE */

        .empty-state {
            padding: 42px 20px;
            text-align: center;
            color: var(--muted);
        }

        .empty-state i {
            font-size: 30px;
            color: #c7cbd1;
            margin-bottom: 12px;
        }

        .empty-state h3 {
            color: var(--navy);
            font-size: 13px;
            margin-bottom: 5px;
        }

        .empty-state p {
            font-size: 10px;
        }

        /* OUTSTANDING */

        .outstanding {
            background: linear-gradient(120deg, var(--navy), #263f65);
            border-radius: 18px;
            padding: 23px;
            display: flex;
            align-items: center;
            gap: 16px;
            color: white;
            margin-bottom: 20px;
            box-shadow: 0 10px 25px rgba(25,46,80,.15);
        }

        .outstanding-icon {
            width: 48px;
            height: 48px;
            background: rgba(255,255,255,.1);
            border-radius: 15px;
            display: grid;
            place-items: center;
            color: var(--gold-light);
            font-size: 20px;
        }

        .outstanding-label {
            color: var(--gold-light);
            font-size: 10px;
            font-weight: 800;
        }

        .outstanding-value {
            font-size: 27px;
            font-weight: 900;
            margin-top: 4px;
        }

        .outstanding-note {
            font-size: 10px;
            color: rgba(255,255,255,.65);
            margin-top: 3px;
        }

        /* FILTERS */

        .filters {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 13px;
            padding: 16px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: var(--shadow);
            margin-bottom: 17px;
        }

        .filter-group label {
            display: block;
            font-size: 10px;
            font-weight: 900;
            color: var(--muted);
            margin-bottom: 7px;
        }

        .filter-group select {
            width: 100%;
            height: 43px;
            padding: 0 12px;
            border-radius: 10px;
            border: 1px solid var(--border);
            background: var(--cream);
            color: var(--navy);
            font-size: 11px;
            font-weight: 700;
            outline: none;
        }

        .filter-group select:focus {
            border-color: var(--gold);
        }

        /* BUTTONS */

        .btn {
            border: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border-radius: 10px;
            padding: 10px 14px;
            cursor: pointer;
            text-decoration: none;
            font-size: 10px;
            font-weight: 900;
            transition: .2s;
            white-space: nowrap;
        }

        .btn:hover {
            transform: translateY(-1px);
            filter: brightness(.97);
        }

        .btn-primary {
            background: var(--navy);
            color: white;
        }

        .btn-gold {
            background: var(--gold);
            color: var(--navy);
        }

        .btn-danger {
            background: #fff0f0;
            color: var(--red);
        }

        .btn-outline {
            background: white;
            color: var(--navy);
            border: 1px solid var(--border);
        }

        .btn-small {
            padding: 7px 9px;
            font-size: 9px;
        }

        .toolbar {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            align-items: center;
        }

        .delete-form {
            display: inline;
        }

        /* PRINT INTRO */

        .report-intro {
            background: white;
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 22px;
            display: flex;
            align-items: center;
            gap: 17px;
            margin-bottom: 20px;
            box-shadow: var(--shadow);
        }

        .report-intro-icon {
            width: 55px;
            height: 55px;
            flex: 0 0 55px;
            border-radius: 16px;
            display: grid;
            place-items: center;
            color: var(--navy);
            background: #f7f3e8;
            font-size: 23px;
        }

        .report-intro h3 {
            font-size: 15px;
            color: var(--navy);
            font-weight: 900;
        }

        .report-intro p {
            color: var(--muted);
            font-size: 11px;
            line-height: 1.7;
            margin-top: 5px;
        }

        .print-filter {
            display: flex;
            align-items: end;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 17px;
        }

        .print-filter .filter-group {
            min-width: 220px;
            flex: 1;
        }

        /* MOBILE OVERLAY */

        .mobile-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.45);
            z-index: 90;
        }

        /* =========================================
           RESPONSIVE DESIGN
        ========================================= */

        @media(max-width: 1100px) {
            .main {
                padding: 28px 25px;
            }

            .metrics {
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

            .mobile-overlay.show {
                display: block;
            }

            .main {
                margin-left: 0;
                padding: 18px 15px 35px;
            }

            .mobile-top {
                display: flex;
            }

            .page-top {
                align-items: flex-start;
            }

            .top-date {
                display: none;
            }

            .tabs {
                gap: 3px;
            }

            .tab {
                flex-direction: column;
                gap: 5px;
                font-size: 9px;
                padding: 10px 3px;
            }

            .period-card {
                align-items: flex-start;
                flex-direction: column;
            }

            .period-options {
                width: 100%;
            }

            .period-btn {
                flex: 1;
                text-align: center;
                padding: 10px 5px;
            }

            .filters {
                grid-template-columns: 1fr;
            }

            .report-intro {
                align-items: flex-start;
            }

            .panel-head {
                align-items: flex-start;
                flex-direction: column;
            }
        }

        @media(max-width: 420px) {
            .metrics {
                gap: 9px;
            }

            .metric-card {
                padding: 13px;
            }

            .metric-value {
                font-size: 17px;
            }

            .outstanding-value {
                font-size: 23px;
            }

            .report-intro {
                padding: 16px;
            }
        }
    </style>
</head>

<body>

@php
    $activeTab = request('tab', 'sales');

    $salesPeriod = $salesPeriod ?? request()->query('period', 'daily');

    $periodLabels = [
        'daily' => 'Today',
        'weekly' => 'Last 7 days',
        'monthly' => 'Last 30 days',
    ];

    $periodSubtitles = [
        'daily' => 'Sales recorded today',
        'weekly' => 'Sales recorded over the last 7 days',
        'monthly' => 'Sales recorded over the last 30 days',
    ];

    $money = fn ($amount) => '₱' . number_format((float) $amount, 2);

    $formatDate = fn ($date) => \Carbon\Carbon::parse($date)->format('M d, Y');

    $currentUser = auth()->user();
    $ownerName = $currentUser?->owner_name ?? $currentUser?->name ?? 'Store Owner';
    $storeName = $currentUser?->store_name ?? 'Susan Store';
@endphp

<div class="mobile-overlay" id="mobileOverlay" onclick="closeSidebar()"></div>

<!-- =========================================
     SIDEBAR
========================================= -->

<aside class="sidebar" id="sidebar">

    <div class="brand">
        <img src="{{ asset('icon.png') }}" alt="Track&Tally Logo">

        <div class="brand-name">
            Track<span>&</span>Tally
        </div>
    </div>

    <div class="menu-label">MAIN MENU</div>

    <nav class="nav-list">

        <a href="{{ url('/dashboard') }}" class="nav-link">
            <i class="fa-solid fa-house"></i>
            <span>Home</span>
        </a>

        <a href="{{ url('/debtors') }}" class="nav-link">
            <i class="fa-solid fa-user-tie"></i>
            <span>Debtors</span>
        </a>

        <a href="{{ url('/sell') }}" class="nav-link">
            <i class="fa-solid fa-cart-shopping"></i>
            <span>Sell</span>
        </a>

        <a href="{{ url('/inventory') }}" class="nav-link">
            <i class="fa-solid fa-table-cells"></i>
            <span>Inventory</span>
        </a>

        <a href="{{ route('reports.index') }}" class="nav-link active">
            <i class="fa-solid fa-chart-column"></i>
            <span>Reports</span>
        </a>

    </nav>

    <div class="sidebar-bottom">

        <div class="profile">

            <div class="avatar">
                {{ strtoupper(substr($ownerName, 0, 1)) }}
            </div>

            <div>
                <div class="profile-name">
                    {{ $ownerName }}
                </div>

                <div class="profile-store">
                    {{ $storeName }}
                </div>
            </div>

        </div>

        <form method="POST" action="{{ url('/logout') }}" class="logout-form">
            @csrf

            <button class="logout-btn" type="submit">
                <i class="fa-solid fa-right-from-bracket"></i>
                Log Out
            </button>
        </form>

    </div>

</aside>

<!-- =========================================
     MAIN CONTENT
========================================= -->

<main class="main">

    <div class="mobile-top">

        <button class="menu-toggle" onclick="openSidebar()" aria-label="Open menu">
            <i class="fa-solid fa-bars"></i>
        </button>

        <strong style="color:var(--navy)">
            Track<span style="color:var(--gold)">&</span>Tally
        </strong>

    </div>

    <!-- PAGE HEADER -->

    <div class="page-top">

        <div>
            <div class="eyebrow">Store performance</div>

            <h1>Reports</h1>

            <p class="page-subtitle">
                Monitor sales, customer balances, and transaction activity.
            </p>
        </div>

        <div class="top-date">
            <i class="fa-regular fa-calendar"></i>
            &nbsp; {{ now()->format('F d, Y') }}
        </div>

    </div>

    <!-- ALERTS -->

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fa-solid fa-circle-check"></i>
            &nbsp; {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-error">
            {{ $errors->first() }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif

    <!-- REPORT TABS -->

    <nav class="tabs">

        <a class="tab {{ $activeTab === 'sales' ? 'active' : '' }}"
           href="{{ route('reports.index', ['tab' => 'sales', 'period' => $salesPeriod]) }}">
            <i class="fa-solid fa-chart-line"></i>
            Sales
        </a>

        <a class="tab {{ $activeTab === 'unpaid' ? 'active' : '' }}"
           href="{{ route('reports.index', ['tab' => 'unpaid']) }}">
            <i class="fa-solid fa-wallet"></i>
            Unpaid
        </a>

        <a class="tab {{ $activeTab === 'history' ? 'active' : '' }}"
           href="{{ route('reports.index', ['tab' => 'history']) }}">
            <i class="fa-solid fa-clock-rotate-left"></i>
            History
        </a>

        <a class="tab {{ $activeTab === 'backup' ? 'active' : '' }}"
           href="{{ route('reports.index', ['tab' => 'backup']) }}">
            <i class="fa-solid fa-file-pdf"></i>
            Print
        </a>

    </nav>

    <!-- =========================================
         SALES TAB
    ========================================= -->

    @if($activeTab === 'sales')

        <div class="section-heading">

            <div class="section-icon">
                <i class="fa-solid fa-chart-column"></i>
            </div>

            <div>
                <h2>{{ $periodLabels[$salesPeriod] ?? 'Today' }} sales</h2>

                <p>
                    {{ $periodSubtitles[$salesPeriod] ?? 'Sales recorded today' }}
                </p>
            </div>

        </div>

        <section class="period-card">

            <div>
                <div class="period-title">Sales period</div>

                <div class="period-description">
                    Choose how you want to view your sales.
                </div>
            </div>

            <div class="period-options">

                @foreach(['daily' => 'Daily', 'weekly' => 'Weekly', 'monthly' => 'Monthly'] as $value => $label)

                    <a href="{{ route('reports.index', ['tab' => 'sales', 'period' => $value]) }}"
                       class="period-btn {{ $salesPeriod === $value ? 'active' : '' }}">
                        {{ $label }}
                    </a>

                @endforeach

            </div>

        </section>

        <!-- SALES METRICS -->

        <div class="metrics">

            <div class="metric-card">

                <div class="metric-icon">
                    <i class="fa-solid fa-money-bill-wave"></i>
                </div>

                <div class="metric-label">CASH SALES</div>

                <div class="metric-value">
                    {{ $money($selectedCash) }}
                </div>

            </div>

            <div class="metric-card">

                <div class="metric-icon red">
                    <i class="fa-solid fa-wallet"></i>
                </div>

                <div class="metric-label">UTANG SALES</div>

                <div class="metric-value red">
                    {{ $money($selectedCredit) }}
                </div>

            </div>

            <div class="metric-card">

                <div class="metric-icon green">
                    <i class="fa-solid fa-arrow-trend-up"></i>
                </div>

                <div class="metric-label">GRAND TOTAL</div>

                <div class="metric-value green">
                    {{ $money($selectedGrandTotal) }}
                </div>

            </div>

            <div class="metric-card">

                <div class="metric-icon">
                    <i class="fa-solid fa-cubes"></i>
                </div>

                <div class="metric-label">ITEMS SOLD</div>

                <div class="metric-value">
                    {{ number_format($selectedItemsSold) }}
                </div>

            </div>

        </div>

        <!-- SALES BREAKDOWN -->

        <div class="section-heading">

            <div class="section-icon">
                <i class="fa-regular fa-calendar"></i>
            </div>

            <div>
                <h2>{{ $periodLabels[$salesPeriod] ?? 'Today' }} breakdown</h2>
                <p>Daily sales activity</p>
            </div>

        </div>

        <section class="panel">

            @if($summary->isEmpty() || $summary->sum('cash_total') + $summary->sum('credit_total') <= 0)

                <div class="empty-state">
                    <i class="fa-solid fa-chart-simple"></i>

                    <h3>No sales recorded yet</h3>

                    <p>Your sales activity will appear here.</p>
                </div>

            @else

                <div class="table-wrap">

                    <table>

                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Items sold</th>
                                <th>Cash sales</th>
                                <th>Utang sales</th>
                                <th class="amount">Total sales</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($summary as $row)

                                <tr>

                                    <td class="date-cell">
                                        {{ $formatDate($row->date) }}
                                    </td>

                                    <td>
                                        {{ number_format($row->item_count) }} items
                                    </td>

                                    <td>
                                        {{ $money($row->cash_total) }}
                                    </td>

                                    <td class="amount red">
                                        {{ $money($row->credit_total) }}
                                    </td>

                                    <td class="amount">
                                        {{ $money($row->cash_total + $row->credit_total) }}
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @endif

        </section>

    @endif

    <!-- =========================================
         UNPAID TAB
    ========================================= -->

    @if($activeTab === 'unpaid')

        <div class="section-heading">

            <div class="section-icon">
                <i class="fa-solid fa-wallet"></i>
            </div>

            <div>
                <h2>Unpaid balances ({{ $unpaid->count() }})</h2>
                <p>Customers with outstanding balances</p>
            </div>

        </div>

        <div class="outstanding">

            <div class="outstanding-icon">
                <i class="fa-solid fa-circle-exclamation"></i>
            </div>

            <div>

                <div class="outstanding-label">
                    TOTAL OUTSTANDING
                </div>

                <div class="outstanding-value">
                    {{ $money($totalUnpaid) }}
                </div>

                <div class="outstanding-note">
                    {{ $unpaid->count() }}
                    {{ $unpaid->count() === 1 ? 'debtor has' : 'debtors have' }}
                    an outstanding balance
                </div>

            </div>

        </div>

        <section class="panel">

            <div class="panel-head">

                <div>
                    <h3>Customer balances</h3>
                    <p>Open a debtor record to view more details.</p>
                </div>

                <span class="badge credit">
                    {{ $unpaid->count() }} UNPAID
                </span>

            </div>

            @if($unpaid->isEmpty())

                <div class="empty-state">

                    <i class="fa-solid fa-circle-check"></i>

                    <h3>Everyone is settled up</h3>

                    <p>There are no outstanding debtor balances.</p>

                </div>

            @else

                <div class="table-wrap">

                    <table>

                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Contact</th>
                                <th class="amount">Outstanding balance</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($unpaid as $debtor)

                                <tr>

                                    <td class="date-cell">
                                        {{ $debtor->full_name }}
                                    </td>

                                    <td>
                                        {{ $debtor->contact_number ?: '—' }}
                                    </td>

                                    <td class="amount red">
                                        {{ $money($debtor->balance) }}
                                    </td>

                                    <td>
                                        <a class="btn btn-outline btn-small"
                                           href="{{ url('/debtors/'.$debtor->id) }}">
                                            View
                                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                        </a>
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @endif

        </section>

    @endif

    <!-- =========================================
         HISTORY TAB
    ========================================= -->

    @if($activeTab === 'history')

        <div class="section-heading">

            <div class="section-icon">
                <i class="fa-solid fa-clock-rotate-left"></i>
            </div>

            <div>
                <h2>Recent history</h2>
                <p>Filter your latest sales and payment records.</p>
            </div>

        </div>

        <!-- HISTORY FILTERS -->

        <div class="filters">

            <div class="filter-group">

                <label for="typeFilter">
                    TRANSACTION TYPE
                </label>

                <select id="typeFilter" onchange="applyHistoryFilters()">

                    <option value="all" {{ $historyTypeFilter === 'all' ? 'selected' : '' }}>
                        All transactions
                    </option>

                    <option value="cash" {{ $historyTypeFilter === 'cash' ? 'selected' : '' }}>
                        Cash sale
                    </option>

                    <option value="e_wallet" {{ $historyTypeFilter === 'e_wallet' ? 'selected' : '' }}>
                        E-wallet sale
                    </option>

                    <option value="credit" {{ $historyTypeFilter === 'credit' ? 'selected' : '' }}>
                        Utang
                    </option>

                    <option value="payment" {{ $historyTypeFilter === 'payment' ? 'selected' : '' }}>
                        Payments
                    </option>

                </select>

            </div>

            <div class="filter-group">

                <label for="dateFilter">
                    DATE
                </label>

                <select id="dateFilter" onchange="applyHistoryFilters()">

                    <option value="all" {{ $historyDateFilter === 'all' ? 'selected' : '' }}>
                        All dates
                    </option>

                    @foreach($historyDates as $date)

                        <option value="{{ $date }}" {{ $historyDateFilter === $date ? 'selected' : '' }}>
                            {{ $formatDate($date) }}
                        </option>

                    @endforeach

                </select>

            </div>

        </div>

        <!-- HISTORY TABLE -->

        <section class="panel">

            <div class="panel-head">

                <div>
                    <h3>Transaction records</h3>
                    <p>Longer-term records are available through the print report.</p>
                </div>

                <form method="POST"
                      action="{{ route('reports.history.clear') }}"
                      onsubmit="return confirm('Clear all sales and payment history? This cannot be undone. Debtor profiles and products will remain.')">

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">
                        <i class="fa-regular fa-trash-can"></i>
                        Clear history
                    </button>

                </form>

            </div>

            @if($filteredHistory->isEmpty())

                <div class="empty-state">

                    <i class="fa-solid fa-filter-circle-xmark"></i>

                    <h3>
                        {{ $history->isEmpty() ? 'No activity recorded yet' : 'No matching transactions' }}
                    </h3>

                    <p>
                        {{ $history->isEmpty()
                            ? 'Sales and payments will appear here.'
                            : 'Try a different transaction type or date.' }}
                    </p>

                </div>

            @else

                <div class="table-wrap">

                    <table>

                        <thead>
                            <tr>
                                <th>Transaction</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Type</th>
                                <th class="amount">Amount</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($filteredHistory as $entry)

                                <tr>

                                    <td class="date-cell">
                                        {{ $entry->label }}
                                    </td>

                                    <td>
                                        {{ $entry->debtor_name ?: '—' }}
                                    </td>

                                    <td>
                                        {{ $formatDate($entry->date) }}
                                    </td>

                                    <td>

                                        @if($entry->label === 'E-wallet Sale')

                                            <span class="badge wallet">
                                                E-WALLET
                                            </span>

                                        @elseif($entry->type === 'payment')

                                            <span class="badge payment">
                                                PAYMENT
                                            </span>

                                        @elseif($entry->type === 'credit')

                                            <span class="badge credit">
                                                UTANG
                                            </span>

                                        @else

                                            <span class="badge cash">
                                                CASH SALE
                                            </span>

                                        @endif

                                    </td>

                                    <td class="amount {{ $entry->type === 'payment' ? 'green' : '' }}">

                                        {{ $entry->type === 'payment' ? '−' : '+' }}{{ $money($entry->amount) }}

                                    </td>

                                    <td>

                                        <form class="delete-form"
                                              method="POST"
                                              action="{{ route('reports.history.delete', [
                                                  'source' => $entry->source,
                                                  'id' => $entry->record_id
                                              ]) }}"
                                              onsubmit="return confirm('Delete this history record? This cannot be undone.')">

                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-danger btn-small"
                                                    type="submit"
                                                    title="Delete record">

                                                <i class="fa-regular fa-trash-can"></i>

                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @endif

        </section>

    @endif

    <!-- =========================================
         PRINT TAB
    ========================================= -->

    @if($activeTab === 'backup')

        <div class="section-heading">

            <div class="section-icon">
                <i class="fa-solid fa-file-pdf"></i>
            </div>

            <div>
                <h2>Report output</h2>
                <p>Print or save a readable store report.</p>
            </div>

        </div>

        <!-- PRINT INTRO -->

        <section class="report-intro">

            <div class="report-intro-icon">
                <i class="fa-solid fa-file-lines"></i>
            </div>

            <div>

                <h3>Print or save reports</h3>

                <p>
                    Create a printable report containing today's sales summary,
                    unpaid customer balances, transaction history, and inventory
                    products that need attention.
                </p>

            </div>

        </section>

        <!-- PRINT SETTINGS -->

        <section class="panel">

            <div class="panel-head">

                <div>
                    <h3>Report settings</h3>
                    <p>Select which transaction history records to include.</p>
                </div>

                <span class="badge wallet">
                    <i class="fa-solid fa-shield-halved"></i>
                    STORE REPORT
                </span>

            </div>

            <div style="padding:18px">

                <div class="print-filter">

                    <div class="filter-group">

                        <label for="printDate">
                            HISTORY RECORDS TO PRINT
                        </label>

                        <select id="printDate">

                            <option value="all">
                                All dates
                            </option>

                            @foreach($historyDates as $date)

                                <option value="{{ $date }}" {{ $printDateFilter === $date ? 'selected' : '' }}>
                                    {{ $formatDate($date) }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <button type="button"
                            class="btn btn-primary"
                            onclick="printReport()">

                        <i class="fa-solid fa-print"></i>
                        Print Reports

                    </button>

                </div>

            </div>

        </section>

        <!-- TODAY METRICS -->

        <div class="metrics">

            <div class="metric-card">

                <div class="metric-icon">
                    <i class="fa-solid fa-money-bill-wave"></i>
                </div>

                <div class="metric-label">
                    TODAY CASH SALES
                </div>

                <div class="metric-value">
                    {{ $money($todayCash) }}
                </div>

            </div>

            <div class="metric-card">

                <div class="metric-icon red">
                    <i class="fa-solid fa-wallet"></i>
                </div>

                <div class="metric-label">
                    TODAY UTANG SALES
                </div>

                <div class="metric-value red">
                    {{ $money($todayCredit) }}
                </div>

            </div>

            <div class="metric-card">

                <div class="metric-icon green">
                    <i class="fa-solid fa-chart-line"></i>
                </div>

                <div class="metric-label">
                    TODAY TOTAL SALES
                </div>

                <div class="metric-value green">
                    {{ $money($todayGrandTotal) }}
                </div>

            </div>

            <div class="metric-card">

                <div class="metric-icon">
                    <i class="fa-solid fa-cubes"></i>
                </div>

                <div class="metric-label">
                    TODAY ITEMS SOLD
                </div>

                <div class="metric-value">
                    {{ number_format($todayItemsSold) }}
                </div>

            </div>

        </div>

        <!-- INVENTORY WATCH -->

        <section class="panel">

            <div class="panel-head">

                <div>
                    <h3>Inventory watch</h3>
                    <p>Products that have reached their low-stock threshold.</p>
                </div>

                <span class="badge stock">
                    {{ $lowStock->count() }} NEED ATTENTION
                </span>

            </div>

            @if($lowStock->isEmpty())

                <div class="empty-state">

                    <i class="fa-solid fa-circle-check" style="color:var(--green)"></i>

                    <h3>Stock levels look healthy</h3>

                    <p>No low-stock products need attention right now.</p>

                </div>

            @else

                <div class="table-wrap">

                    <table>

                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Stock remaining</th>
                                <th>Low-stock threshold</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($lowStock as $product)

                                <tr>

                                    <td class="date-cell">
                                        {{ $product->name }}
                                    </td>

                                    <td>
                                        {{ $product->category ?: '—' }}
                                    </td>

                                    <td class="amount red">
                                        {{ number_format((float)$product->stock_quantity, 2) }}
                                        {{ $product->unit }}
                                    </td>

                                    <td>
                                        {{ number_format((float)($product->low_stock_threshold ?? 5), 2) }}
                                    </td>

                                    <td>

                                        <span class="badge stock">
                                            {{ (float)$product->stock_quantity <= 0 ? 'OUT OF STOCK' : 'LOW STOCK' }}
                                        </span>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @endif

        </section>

    @endif

</main>

<!-- =========================================
     JAVASCRIPT
========================================= -->

<script>

    /* OPEN MOBILE SIDEBAR */

    function openSidebar() {
        document.getElementById('sidebar').classList.add('open');
        document.getElementById('mobileOverlay').classList.add('show');
    }

    /* CLOSE MOBILE SIDEBAR */

    function closeSidebar() {
        document.getElementById('sidebar').classList.remove('open');
        document.getElementById('mobileOverlay').classList.remove('show');
    }

    /* HISTORY FILTERS */

    function applyHistoryFilters() {

        const type = document.getElementById('typeFilter').value;
        const date = document.getElementById('dateFilter').value;

        const url = new URL(window.location.href);

        url.searchParams.set('tab', 'history');
        url.searchParams.set('type', type);
        url.searchParams.set('date', date);

        window.location.href = url.toString();
    }

    /* PRINT REPORT */

    function printReport() {

        const date = document.getElementById('printDate').value;

        const url = new URL(
            @json(route('reports.print')),
            window.location.origin
        );

        url.searchParams.set('date', date);

        const printWindow = window.open(url.toString(), '_blank');

        if (!printWindow) {
            alert('Please allow pop-ups for this website to print your report.');
        }
    }

</script>

</body>
</html>
