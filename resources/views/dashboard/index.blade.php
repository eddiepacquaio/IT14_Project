
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Track&Tally</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --navy: #172B4D;
            --navy-light: #243D63;
            --gold: #D9A928;
            --cream: #F7F5EF;
            --white: #FFFFFF;
            --text: #27364B;
            --muted: #8993A3;
            --border: #E8E9EC;
            --green: #218653;
            --red: #D94B45;
            --shadow: 0 5px 20px rgba(23, 43, 77, .055);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', Arial, sans-serif;
            background: var(--cream);
            color: var(--text);
            min-height: 100vh;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 245px;
            height: 100vh;
            background: var(--navy);
            padding: 28px 18px;
            display: flex;
            flex-direction: column;
            z-index: 10;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 10px 35px;
            color: white;
        }

        .brand img {
            width: 43px;
            height: 43px;
            object-fit: contain;
            background: white;
            border-radius: 12px;
            padding: 4px;
        }

        .brand-name {
            font-size: 18px;
            font-weight: 900;
            letter-spacing: -.5px;
        }

        .brand-name span {
            color: var(--gold);
        }

        .nav-label {
            color: #91A0B7;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.5px;
            padding: 0 12px;
            margin-bottom: 13px;
        }

        .nav-links {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .nav-links a {
            text-decoration: none;
            color: #D6DDE8;
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 13px 14px;
            border-radius: 11px;
            font-size: 13px;
            font-weight: 600;
            transition: .2s;
        }

        .nav-links a:hover,
        .nav-links a.active {
            background: rgba(255,255,255,.12);
            color: white;
        }

        .nav-links a.active {
            border-left: 3px solid var(--gold);
        }

        .nav-icon {
            width: 22px;
            text-align: center;
            font-size: 17px;
        }

        .sidebar-bottom {
            margin-top: auto;
            border-top: 1px solid rgba(255,255,255,.13);
            padding-top: 18px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            margin-bottom: 10px;
        }

        .avatar {
            width: 37px;
            height: 37px;
            border-radius: 12px;
            background: var(--gold);
            color: var(--navy);
            display: grid;
            place-items: center;
            font-weight: 900;
            flex-shrink: 0;
        }

        .user-name {
            color: white;
            font-size: 12px;
            font-weight: 700;
        }

        .user-role {
            color: #AAB6C8;
            font-size: 10px;
            margin-top: 3px;
        }

        .logout {
            width: 100%;
            border: 0;
            background: rgba(255,255,255,.08);
            color: white;
            padding: 12px;
            border-radius: 10px;
            font-weight: 700;
            cursor: pointer;
            font-size: 12px;
        }

        .logout:hover {
            background: rgba(255,255,255,.15);
        }

        .main {
            margin-left: 245px;
            padding: 32px 38px;
            max-width: 1600px;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 32px;
            gap: 15px;
        }

        .page-title {
            color: var(--navy);
            font-size: 25px;
            font-weight: 900;
            letter-spacing: -.7px;
            overflow-wrap: anywhere;
        }

        .page-subtitle {
            color: var(--muted);
            font-size: 12px;
            margin-top: 6px;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .store-pill {
            display: flex;
            align-items: center;
            gap: 10px;
            background: white;
            padding: 10px 15px;
            border: 1px solid var(--border);
            border-radius: 13px;
            box-shadow: var(--shadow);
            font-size: 12px;
            font-weight: 700;
            color: var(--navy);
        }

        .store-icon {
            width: 32px;
            height: 32px;
            border-radius: 10px;
            background: #F7F1DF;
            display: grid;
            place-items: center;
            color: var(--gold);
            font-size: 16px;
        }

        .profile-btn {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 10px 15px;
            background: var(--navy);
            color: white;
            border: 1px solid var(--navy);
            border-radius: 13px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 700;
            transition: .2s;
            box-shadow: var(--shadow);
        }

        .profile-btn:hover {
            background: var(--navy-light);
            transform: translateY(-2px);
        }

        .profile-icon {
            width: 28px;
            height: 28px;
            border-radius: 9px;
            background: rgba(255,255,255,.13);
            display: grid;
            place-items: center;
            font-size: 16px;
        }

        .welcome {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 22px;
        }

        .welcome-label {
            color: var(--gold);
            font-size: 10px;
            font-weight: 900;
            letter-spacing: 1.6px;
            margin-bottom: 7px;
        }

        .date {
            color: var(--navy);
            font-size: 19px;
            font-weight: 800;
        }

        .calendar {
            background: var(--navy);
            width: 48px;
            height: 48px;
            border-radius: 15px;
            display: grid;
            place-items: center;
            color: var(--gold);
            font-size: 21px;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 17px;
            margin-bottom: 30px;
        }

        .metric-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 17px;
            padding: 22px;
            min-height: 155px;
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
        }

        .metric-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 17px;
        }

        .metric-icon {
            width: 42px;
            height: 42px;
            border-radius: 13px;
            display: grid;
            place-items: center;
            font-size: 20px;
        }

        .green-bg {
            background: #EAF6EF;
            color: var(--green);
        }

        .red-bg {
            background: #FDEDEC;
            color: var(--red);
        }

        .metric-label {
            font-size: 12px;
            font-weight: 700;
            color: var(--muted);
            margin-bottom: 7px;
        }

        .metric-value {
            font-size: clamp(20px, 2.5vw, 27px);
            font-weight: 900;
            color: var(--green);
            letter-spacing: -.8px;
            overflow-wrap: anywhere;
        }

        .metric-value.red {
            color: var(--red);
        }

        .metric-card::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--green);
        }

        .metric-card.danger::after {
            background: var(--red);
        }

        .alerts {
            display: grid;
            gap: 12px;
            margin-bottom: 30px;
        }

        .alert {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 15px;
            background: #FFF8F6;
            border: 1px solid #F1D9D4;
            border-radius: 14px;
            text-decoration: none;
            transition: .2s;
        }

        .alert:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .alert-icon {
            width: 43px;
            height: 43px;
            display: grid;
            place-items: center;
            border-radius: 13px;
            background: #FDEDEC;
            color: var(--red);
            font-size: 20px;
            flex-shrink: 0;
        }

        .alert-content {
            flex: 1;
        }

        .alert-title {
            color: var(--red);
            font-size: 13px;
            font-weight: 900;
            margin-bottom: 4px;
        }

        .alert-text {
            color: var(--muted);
            font-size: 11px;
            font-weight: 600;
        }

        .alert-arrow {
            color: var(--red);
            font-size: 20px;
        }

        .section-heading {
            display: flex;
            align-items: center;
            gap: 11px;
            margin-bottom: 16px;
            margin-top: 25px;
        }

        .section-accent {
            width: 4px;
            height: 31px;
            background: var(--gold);
            border-radius: 5px;
        }

        .section-title {
            color: var(--navy);
            font-size: 17px;
            font-weight: 900;
        }

        .section-subtitle {
            color: var(--muted);
            font-size: 10px;
            font-weight: 600;
            margin-top: 3px;
        }

        .actions-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 15px;
        }

        .action-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 17px;
            min-height: 132px;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: var(--shadow);
            transition: .2s;
        }

        .action-card:hover {
            transform: translateY(-3px);
            border-color: #E6D39D;
        }

        .action-icon {
            width: 48px;
            height: 48px;
            border-radius: 15px;
            background: #F7F3E8;
            display: grid;
            place-items: center;
            color: var(--navy);
            font-size: 23px;
        }

        .action-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 5px;
            margin-top: 14px;
        }

        .action-title {
            color: var(--text);
            font-size: 12px;
            font-weight: 800;
        }

        .action-arrow {
            color: var(--gold);
            font-size: 17px;
        }

        .glance-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 15px;
        }

        .glance-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 20px 12px;
            text-align: center;
            box-shadow: var(--shadow);
        }

        .glance-icon {
            width: 42px;
            height: 42px;
            margin: 0 auto 11px;
            border-radius: 13px;
            display: grid;
            place-items: center;
            background: #EAF6EF;
            color: var(--green);
            font-size: 20px;
        }

        .glance-icon.red {
            background: #FDEDEC;
            color: var(--red);
        }

        .glance-icon.gold {
            background: #F7F3E8;
            color: var(--navy);
        }

        .glance-label {
            color: var(--muted);
            font-size: 11px;
            font-weight: 700;
        }

        .glance-value {
            color: var(--navy);
            font-size: 17px;
            font-weight: 900;
            margin-top: 6px;
            overflow-wrap: anywhere;
        }

        .glance-value.red {
            color: var(--red);
        }

        .footer {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 35px;
            color: var(--muted);
            font-size: 10px;
            font-weight: 900;
            letter-spacing: 1.2px;
            justify-content: center;
        }

        .footer-line {
            height: 1px;
            flex: 1;
            background: var(--border);
        }

        .footer-mark {
            width: 27px;
            height: 27px;
            background: var(--navy);
            color: var(--gold);
            border-radius: 9px;
            display: grid;
            place-items: center;
            font-size: 14px;
        }

        @media (max-width: 1100px) {
            .actions-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 760px) {
            .sidebar {
                position: static;
                width: 100%;
                height: auto;
                padding: 15px;
            }

            .brand {
                padding: 0 5px 15px;
            }

            .nav-label,
            .sidebar-bottom {
                display: none;
            }

            .nav-links {
                flex-direction: row;
                overflow-x: auto;
                padding-bottom: 3px;
            }

            .nav-links a {
                white-space: nowrap;
                padding: 10px;
                font-size: 11px;
            }

            .main {
                margin-left: 0;
                padding: 23px 17px;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
                margin-bottom: 25px;
            }

            .topbar-actions {
                width: 100%;
                flex-wrap: wrap;
            }

            .page-title {
                font-size: 22px;
            }

            .store-pill {
                font-size: 10px;
                padding: 7px 9px;
            }

            .profile-btn {
                font-size: 11px;
                padding: 8px 11px;
            }

            .summary-grid {
                gap: 10px;
            }

            .metric-card {
                padding: 15px;
                min-height: 140px;
            }

            .metric-value {
                font-size: 20px;
            }

            .actions-grid {
                gap: 10px;
            }

            .action-card {
                min-height: 120px;
                padding: 13px;
            }

            .glance-grid {
                gap: 9px;
            }

            .glance-card {
                padding: 15px 7px;
            }

            .glance-value {
                font-size: 14px;
            }
        }

        @media (max-width: 380px) {
            .summary-grid,
            .glance-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    @php
        $displayName = $ownerName ?? 'Store Owner';
        $displayStore = $storeName ?? 'My Store';
        $stats = $stats ?? [];
    @endphp

    <aside class="sidebar">

        <div class="brand">
            <img src="{{ asset('icon.png') }}" alt="Track&Tally Logo">
            <div class="brand-name">Track<span>&</span>Tally</div>
        </div>

        <div class="nav-label">MAIN MENU</div>

        <nav class="nav-links">

            <a href="{{ url('/dashboard') }}" class="active">
                <span class="nav-icon">⌂</span> Home
            </a>

            <a href="{{ url('/debtors') }}">
                <span class="nav-icon">♙</span> Debtors
            </a>

            <a href="{{ url('/sell') }}">
                <span class="nav-icon">🛒</span> Sell
            </a>

            <a href="{{ url('/inventory') }}">
                <span class="nav-icon">▦</span> Inventory
            </a>

            <!-- REPORTS: OPENS resources/views/reports/index.blade.php -->
            <a href="{{ route('reports.index') }}">
                <span class="nav-icon">▤</span> Reports
            </a>

        </nav>

        <div class="sidebar-bottom">

            <div class="user-info">

                <div class="avatar">
                    {{ strtoupper(substr($displayName, 0, 1)) }}
                </div>

                <div>
                    <div class="user-name">{{ $displayName }}</div>
                    <div class="user-role">{{ $displayStore }}</div>
                </div>

            </div>

            <form method="POST" action="{{ url('/logout') }}">
                @csrf

                <button type="submit" class="logout">
                    ↪ &nbsp; Log Out
                </button>
            </form>

        </div>

    </aside>

    <main class="main">

        <header class="topbar">

            <div>
                <h1 class="page-title">{{ $displayName }}</h1>

                <p class="page-subtitle">
                    Welcome back, {{ $displayName }}!
                    Here's what's happening in your store.
                </p>
            </div>

            <div class="topbar-actions">

                <div class="store-pill">
                    <div class="store-icon">▣</div>
                    {{ $displayStore }}
                </div>

                <a href="{{ url('/profile') }}" class="profile-btn">
                    <span class="profile-icon">♙</span>
                    Profile
                </a>

            </div>

        </header>

        <section class="welcome">

            <div>
                <div class="welcome-label">TODAY'S OVERVIEW</div>
                <div class="date">{{ $todayLabel ?? now()->format('F d, Y') }}</div>
            </div>

            <div class="calendar">▦</div>

        </section>

        <section class="summary-grid">

            <div class="metric-card">

                <div class="metric-top">
                    <div class="metric-icon green-bg">↗</div>
                    <span style="color:#AAB1BC;">•••</span>
                </div>

                <div class="metric-label">Today's Sales</div>

                <div class="metric-value">
                    ₱{{ number_format($stats['todaySales'] ?? 0, 2) }}
                </div>

            </div>

            <div class="metric-card danger">

                <div class="metric-top">
                    <div class="metric-icon red-bg">!</div>
                    <span style="color:#AAB1BC;">•••</span>
                </div>

                <div class="metric-label">Outstanding Utang</div>

                <div class="metric-value red">
                    ₱{{ number_format($stats['outstanding'] ?? 0, 2) }}
                </div>

            </div>

        </section>

        <section class="alerts">

            @if(($stats['lowStockCount'] ?? 0) > 0)

                <a href="{{ url('/inventory?filter=low') }}" class="alert">

                    <div class="alert-icon">⚠</div>

                    <div class="alert-content">

                        <div class="alert-title">Low Stock Alert</div>

                        <div class="alert-text">
                            {{ $stats['lowStockCount'] }}
                            product{{ ($stats['lowStockCount'] ?? 0) == 1 ? '' : 's' }}
                            low on stock
                        </div>

                    </div>

                    <div class="alert-arrow">›</div>

                </a>

            @endif

            @if(($stats['outOfStockCount'] ?? 0) > 0)

                <a href="{{ url('/inventory?filter=out') }}" class="alert">

                    <div class="alert-icon">⊗</div>

                    <div class="alert-content">

                        <div class="alert-title">Out of Stock Alert</div>

                        <div class="alert-text">
                            {{ $stats['outOfStockCount'] }}
                            product{{ ($stats['outOfStockCount'] ?? 0) == 1 ? '' : 's' }}
                            need restocking
                        </div>

                    </div>

                    <div class="alert-arrow">›</div>

                </a>

            @endif

        </section>

        <!-- QUICK ACTIONS -->
        <section>

            <div class="section-heading">

                <div class="section-accent"></div>

                <div>
                    <div class="section-title">Quick Actions</div>
                    <div class="section-subtitle">Manage your store</div>
                </div>

            </div>

            <div class="actions-grid">

                <!-- NEW SALE -->
                <a href="{{ url('/sell') }}" class="action-card">

                    <div class="action-icon">🛒</div>

                    <div class="action-bottom">
                        <span class="action-title">New Sale</span>
                        <span class="action-arrow">→</span>
                    </div>

                </a>

                <!-- RECORD PAYMENT -->
                <a href="{{ url('/debtors') }}" class="action-card">

                    <div class="action-icon">₱</div>

                    <div class="action-bottom">
                        <span class="action-title">Record Payment</span>
                        <span class="action-arrow">→</span>
                    </div>

                </a>

                <!-- ADD PRODUCT -->
                <a href="{{ url('/inventory/new') }}" class="action-card">

                    <div class="action-icon">＋</div>

                    <div class="action-bottom">
                        <span class="action-title">Add Product</span>
                        <span class="action-arrow">→</span>
                    </div>

                </a>

                <!-- ADD DEBTOR -->
                <a href="{{ url('/debtors/create') }}" class="action-card">

                    <div class="action-icon">♙</div>

                    <div class="action-bottom">
                        <span class="action-title">Add Debtor</span>
                        <span class="action-arrow">→</span>
                    </div>

                </a>

            </div>

        </section>

        <!-- TODAY AT A GLANCE -->
        <section>

            <div class="section-heading">

                <div class="section-accent"></div>

                <div>
                    <div class="section-title">Today at a Glance</div>
                    <div class="section-subtitle">Your daily activity</div>
                </div>

            </div>

            <div class="glance-grid">

                <div class="glance-card">

                    <div class="glance-icon">₱</div>

                    <div class="glance-label">Cash Sales</div>

                    <div class="glance-value">
                        ₱{{ number_format($stats['cashSales'] ?? 0, 2) }}
                    </div>

                </div>

                <div class="glance-card">

                    <div class="glance-icon red">▣</div>

                    <div class="glance-label">Utang Sales</div>

                    <div class="glance-value red">
                        ₱{{ number_format($stats['utangSales'] ?? 0, 2) }}
                    </div>

                </div>

                <div class="glance-card">

                    <div class="glance-icon gold">▦</div>

                    <div class="glance-label">Items Sold</div>

                    <div class="glance-value">
                        {{ number_format($stats['itemsSold'] ?? 0) }}
                    </div>

                </div>

            </div>

        </section>

        <footer class="footer">

            <div class="footer-line"></div>
            <div class="footer-mark">▥</div>
            <span>TRACK & TALLY</span>
            <div class="footer-line"></div>

        </footer>

    </main>

</body>
</html>
