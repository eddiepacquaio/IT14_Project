<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sell Products | Track&Tally</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root {
            --navy: #192e50;
            --navy-dark: #172b4b;
            --navy-light: #304565;
            --gold: #e5ad20;
            --cream: #f8f7f2;
            --white: #ffffff;
            --text: #263248;
            --muted: #8992a1;
            --border: #e9e8e2;
            --green: #21875a;
            --red: #d94b4b;
            --shadow: 0 5px 20px rgba(23, 36, 59, .05);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--cream);
            color: var(--text);
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        button, input {
            font-family: inherit;
        }

        .app {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR - ORIGINAL DESIGN */

        .sidebar {
            width: 260px;
            min-width: 260px;
            background: var(--navy-dark);
            color: white;
            padding: 27px 17px 16px;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 100;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 10px;
            margin-bottom: 35px;
        }

        /* UPDATED LOGO WITH WHITE BACKGROUND */

        .brand img {
            width: 46px;
            height: 46px;
            object-fit: contain;
            border-radius: 12px;
            background: #ffffff;
            padding: 5px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, .18);
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

        .menu-heading {
            margin: 0 12px 15px;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 2px;
            color: #94a6c0;
        }

        .nav-menu {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 13px 15px;
            min-height: 45px;
            border-radius: 11px;
            color: #e0e6f0;
            font-size: 13px;
            font-weight: 600;
            transition: .2s;
            border-left: 2px solid transparent;
        }

        .nav-link i {
            width: 18px;
            text-align: center;
            font-size: 16px;
        }

        .nav-link:hover {
            background: rgba(255,255,255,.08);
            color: white;
        }

        .nav-link.active {
            background: #344968;
            color: white;
            border-left: 2px solid var(--gold);
            font-weight: 800;
        }

        /* SIDEBAR BOTTOM */

        .sidebar-bottom {
            margin-top: auto;
            border-top: 1px solid rgba(255,255,255,.12);
            padding-top: 28px;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 0 10px 20px;
        }

        .profile-avatar {
            width: 39px;
            height: 39px;
            min-width: 39px;
            border-radius: 11px;
            background: var(--gold);
            color: var(--navy-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            font-weight: 900;
        }

        .profile-info {
            min-width: 0;
        }

        .profile-name {
            font-size: 12px;
            font-weight: 800;
            color: white;
        }

        .profile-store {
            font-size: 10px;
            color: #aebbd0;
            margin-top: 4px;
        }

        .logout-btn {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 12px 15px;
            border: none;
            background: #2c4263;
            color: white;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 800;
            cursor: pointer;
            transition: .2s;
        }

        .logout-btn:hover {
            background: #3b5274;
        }

        /* MAIN CONTENT */

        .main {
            margin-left: 260px;
            width: calc(100% - 260px);
            min-height: 100vh;
            padding: 38px 42px;
        }

        .topbar {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-bottom: 35px;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .top-store {
            text-align: right;
        }

        .top-store strong {
            display: block;
            font-size: 12px;
            color: var(--navy);
        }

        .top-store small {
            display: block;
            color: var(--muted);
            font-size: 10px;
            margin-top: 3px;
        }

        .top-avatar {
            width: 38px;
            height: 38px;
            background: #f5e6b5;
            color: var(--navy);
            border-radius: 11px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 900;
            font-size: 13px;
        }

        /* PAGE HEADER */

        .page-heading {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 20px;
            margin-bottom: 27px;
        }

        .eyebrow {
            color: #b48a20;
            font-size: 10px;
            font-weight: 900;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 9px;
        }

        .page-heading h1 {
            font-size: 30px;
            color: var(--navy);
            font-weight: 900;
            letter-spacing: -1.2px;
        }

        .page-heading p {
            color: var(--muted);
            font-size: 12px;
            margin-top: 8px;
        }

        .cart-button {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: var(--navy-dark);
            color: white;
            padding: 13px 19px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 800;
            transition: .2s;
            white-space: nowrap;
        }

        .cart-button:hover {
            background: #304565;
            transform: translateY(-2px);
        }

        .cart-button i {
            color: var(--gold);
        }

        /* SUMMARY CARDS */

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 25px;
        }

        .summary-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 13px;
            padding: 19px 20px;
            box-shadow: var(--shadow);
        }

        .summary-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 13px;
        }

        .summary-label {
            color: var(--muted);
            font-size: 11px;
            font-weight: 700;
        }

        .summary-icon {
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 9px;
            background: #f8f0d9;
            color: #b48a20;
            font-size: 14px;
        }

        .summary-value {
            font-size: 25px;
            font-weight: 900;
            color: var(--navy);
            letter-spacing: -.7px;
        }

        .summary-note {
            font-size: 10px;
            color: var(--muted);
            margin-top: 5px;
        }

        /* ALERTS */

        .alert {
            padding: 13px 16px;
            border-radius: 9px;
            margin-bottom: 18px;
            font-size: 12px;
            font-weight: 600;
        }

        .alert-success {
            background: #e8f7ef;
            color: #187548;
            border: 1px solid #c6ead6;
        }

        .alert-error {
            background: #fff0ef;
            color: #b93636;
            border: 1px solid #f2cfcb;
        }

        /* PRODUCT SECTION */

        .products-section {
            background: white;
            border: 1px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .section-header {
            padding: 22px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .section-title h2 {
            font-size: 15px;
            font-weight: 900;
            color: var(--navy);
        }

        .section-title p {
            font-size: 10px;
            color: var(--muted);
            margin-top: 5px;
        }

        .search-box {
            width: 280px;
            position: relative;
        }

        .search-box i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #a0a5ae;
            font-size: 13px;
        }

        .search-box input {
            width: 100%;
            padding: 12px 14px 12px 39px;
            border: 1px solid var(--border);
            background: #fbfbf9;
            border-radius: 9px;
            outline: none;
            font-size: 11px;
            transition: .2s;
        }

        .search-box input:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(217,169,40,.1);
        }

        /* PRODUCT ROWS */

        .product-list {
            padding: 0 24px;
        }

        .product-row {
            display: flex;
            align-items: center;
            gap: 17px;
            padding: 18px 0;
            border-bottom: 1px solid #f0f0ec;
        }

        .product-row:last-child {
            border-bottom: none;
        }

        .product-icon {
            width: 49px;
            height: 49px;
            flex-shrink: 0;
            border-radius: 12px;
            background: #f8f2e3;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #b48a20;
            font-size: 19px;
        }

        .product-info {
            flex: 1;
            min-width: 0;
        }

        .product-name {
            font-size: 13px;
            font-weight: 800;
            color: var(--navy);
            margin-bottom: 6px;
        }

        .product-category {
            font-size: 10px;
            color: var(--muted);
        }

        .product-stock {
            margin-top: 7px;
            font-size: 10px;
            font-weight: 700;
        }

        .stock-normal {
            color: var(--green);
        }

        .stock-low {
            color: #c28b16;
        }

        .stock-out {
            color: var(--red);
        }

        .product-price {
            min-width: 110px;
            text-align: right;
        }

        .price-label {
            font-size: 9px;
            color: var(--muted);
            font-weight: 700;
            margin-bottom: 5px;
        }

        .price-value {
            font-size: 15px;
            font-weight: 900;
            color: var(--navy);
        }

        .add-form {
            min-width: 125px;
            text-align: right;
        }

        .add-button {
            border: none;
            background: var(--gold);
            color: var(--navy-dark);
            padding: 11px 15px;
            border-radius: 8px;
            font-size: 10px;
            font-weight: 900;
            cursor: pointer;
            transition: .2s;
        }

        .add-button:hover {
            background: #edc04d;
            transform: translateY(-1px);
        }

        .add-button:disabled {
            background: #e7e7e3;
            color: #999;
            cursor: not-allowed;
            transform: none;
        }

        .empty-state {
            padding: 60px 20px;
            text-align: center;
            color: var(--muted);
        }

        .empty-state i {
            font-size: 35px;
            color: #d5d5ce;
            margin-bottom: 14px;
        }

        .empty-state h3 {
            color: var(--navy);
            font-size: 14px;
            margin-bottom: 7px;
        }

        .empty-state p {
            font-size: 11px;
        }

        .no-results {
            display: none;
        }

        .footer-note {
            text-align: center;
            color: #a0a4aa;
            font-size: 10px;
            margin-top: 22px;
        }

        /* MOBILE */

        .mobile-menu-button {
            display: none;
            border: none;
            background: var(--navy-dark);
            color: white;
            width: 39px;
            height: 39px;
            border-radius: 9px;
            cursor: pointer;
            font-size: 16px;
        }

        .sidebar-overlay {
            display: none;
        }

        @media (max-width: 1000px) {
            .main {
                padding: 28px 25px;
            }
        }

        @media (max-width: 760px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform .25s ease;
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .sidebar-overlay.show {
                display: block;
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,.4);
                z-index: 90;
            }

            .main {
                margin-left: 0;
                width: 100%;
                padding: 20px 16px;
            }

            .topbar {
                justify-content: space-between;
                margin-bottom: 25px;
            }

            .mobile-menu-button {
                display: block;
            }

            .page-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .page-heading h1 {
                font-size: 25px;
            }

            .summary-grid {
                grid-template-columns: 1fr;
            }

            .section-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .search-box {
                width: 100%;
            }

            .product-list {
                padding: 0 15px;
            }

            .product-row {
                flex-wrap: wrap;
                gap: 12px;
            }

            .product-info {
                width: calc(100% - 65px);
                flex: none;
            }

            .product-price {
                text-align: left;
                flex: 1;
                min-width: 90px;
                padding-left: 61px;
            }

            .add-form {
                min-width: auto;
            }

            .add-button {
                padding: 10px 12px;
            }
        }

        @media (max-width: 390px) {
            .top-store {
                display: none;
            }

            .product-price {
                padding-left: 0;
            }
        }
    </style>
</head>

<body>

<div class="app">

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">

        <!-- LOGO -->
        <div class="brand">
            <img src="{{ asset('icon.png') }}" alt="Track&Tally Logo">

            <div class="brand-name">
                Track<span>&</span>Tally
            </div>
        </div>

        <!-- MAIN MENU -->
        <div class="menu-heading">MAIN MENU</div>

        <nav class="nav-menu">

            <a href="{{ url('/dashboard') }}" class="nav-link">
                <i class="fa-solid fa-house"></i>
                <span>Home</span>
            </a>

            <a href="{{ url('/debtors') }}" class="nav-link">
                <i class="fa-solid fa-users"></i>
                <span>Debtors</span>
            </a>

            <a href="{{ url('/sell') }}" class="nav-link active">
                <i class="fa-solid fa-cart-shopping"></i>
                <span>Sell</span>
            </a>

            <a href="{{ url('/inventory') }}" class="nav-link">
                <i class="fa-solid fa-boxes-stacked"></i>
                <span>Inventory</span>
            </a>

            <a href="{{ url('/reports') }}" class="nav-link">
                <i class="fa-solid fa-chart-column"></i>
                <span>Reports</span>
            </a>

        </nav>

        <!-- PROFILE AND LOGOUT -->
        <div class="sidebar-bottom">

            <div class="profile">

                <div class="profile-avatar">S</div>

                <div class="profile-info">
                    <div class="profile-name">Store Owner</div>

                    <div class="profile-store">
                        {{ auth()->user()->store_name ?? 'Susan Store' }}
                    </div>
                </div>

            </div>

            <form method="POST" action="{{ url('/logout') }}">
                @csrf

                <button type="submit" class="logout-btn">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Log Out</span>
                </button>
            </form>

        </div>

    </aside>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- MAIN CONTENT -->
    <main class="main">

        <!-- TOPBAR -->
        <div class="topbar">

            <button class="mobile-menu-button" id="mobileMenuButton" type="button">
                <i class="fa-solid fa-bars"></i>
            </button>

            <div class="topbar-right">

                <div class="top-store">
                    <strong>{{ auth()->user()->name ?? 'Susan Mae' }}</strong>
                    <small>{{ auth()->user()->store_name ?? 'Susan Store' }}</small>
                </div>

                <div class="top-avatar">S</div>

            </div>

        </div>

        <!-- PAGE HEADER -->
        <div class="page-heading">

            <div>
                <div class="eyebrow">SALES MANAGEMENT</div>

                <h1>Sell Products</h1>

                <p>
                    Select products from your inventory and add them to your cart.
                </p>
            </div>

            <a href="{{ url('/sell/cart') }}" class="cart-button">
                <i class="fa-solid fa-cart-shopping"></i>
                View Cart
                <i class="fa-solid fa-arrow-right"></i>
            </a>

        </div>

        <!-- FLASH MESSAGES -->
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
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <!-- SUMMARY DATA -->
        @php
            $productCount = $products->count();

            $totalStock = $products->sum(function ($product) {
                return (int) $product->stock_quantity;
            });

            $lowStockCount = $products->filter(function ($product) {
                return (int) $product->stock_quantity > 0
                    && (int) $product->stock_quantity <= (int) ($product->low_stock_threshold ?? 5);
            })->count();

            $outOfStockCount = $products->filter(function ($product) {
                return (int) $product->stock_quantity <= 0;
            })->count();
        @endphp

        <!-- SUMMARY CARDS -->
        <div class="summary-grid">

            <div class="summary-card">
                <div class="summary-top">
                    <span class="summary-label">Available Products</span>
                    <div class="summary-icon">
                        <i class="fa-solid fa-box"></i>
                    </div>
                </div>

                <div class="summary-value">{{ number_format($productCount) }}</div>
                <div class="summary-note">Products in your inventory</div>
            </div>

            <div class="summary-card">
                <div class="summary-top">
                    <span class="summary-label">Total Stock</span>
                    <div class="summary-icon">
                        <i class="fa-solid fa-cubes-stacked"></i>
                    </div>
                </div>

                <div class="summary-value">{{ number_format($totalStock) }}</div>
                <div class="summary-note">Total available item quantities</div>
            </div>

            <div class="summary-card">
                <div class="summary-top">
                    <span class="summary-label">Low / Out of Stock</span>
                    <div class="summary-icon">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                </div>

                <div class="summary-value">
                    {{ number_format($lowStockCount + $outOfStockCount) }}
                </div>

                <div class="summary-note">
                    {{ $lowStockCount }} low stock · {{ $outOfStockCount }} out of stock
                </div>
            </div>

        </div>

        <!-- PRODUCT LIST -->
        <section class="products-section">

            <div class="section-header">

                <div class="section-title">
                    <h2>Product List</h2>
                    <p>Choose a product to add to your sale.</p>
                </div>

                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>

                    <input
                        type="text"
                        id="productSearch"
                        placeholder="Search product name or category..."
                        value="{{ request('q') }}"
                        autocomplete="off"
                    >
                </div>

            </div>

            <div class="product-list" id="productList">

                @forelse($products as $product)

                    @php
                        $stock = (int) $product->stock_quantity;
                        $threshold = (int) ($product->low_stock_threshold ?? 5);

                        if ($stock <= 0) {
                            $stockClass = 'stock-out';
                            $stockText = 'Out of stock';
                        } elseif ($stock <= $threshold) {
                            $stockClass = 'stock-low';
                            $stockText = 'Low stock';
                        } else {
                            $stockClass = 'stock-normal';
                            $stockText = 'In stock';
                        }
                    @endphp

                    <div
                        class="product-row"
                        data-search="{{ strtolower($product->name . ' ' . ($product->category ?? '')) }}"
                    >

                        <div class="product-icon">
                            <i class="fa-solid fa-box-open"></i>
                        </div>

                        <div class="product-info">

                            <div class="product-name">
                                {{ $product->name }}
                            </div>

                            <div class="product-category">
                                {{ $product->category ?? 'Uncategorized' }}
                                ·
                                {{ $product->unit ?? 'piece' }}
                            </div>

                            <div class="product-stock {{ $stockClass }}">
                                <i class="fa-solid fa-circle" style="font-size:7px;"></i>
                                {{ $stockText }}
                                ·
                                {{ number_format($stock) }}
                                {{ $product->unit ?? 'pcs' }}
                            </div>

                        </div>

                        <div class="product-price">
                            <div class="price-label">SELLING PRICE</div>

                            <div class="price-value">
                                ₱{{ number_format((float) $product->item_price, 2) }}
                            </div>
                        </div>

                        <div class="add-form">

                            <form
                                action="{{ route('sell.cart.add', $product->id) }}"
                                method="POST"
                            >
                                @csrf

                                <input type="hidden" name="quantity" value="1">
                                <input type="hidden" name="mode" value="item">

                                <button
                                    type="submit"
                                    class="add-button"
                                    {{ $stock <= 0 ? 'disabled' : '' }}
                                >
                                    @if($stock <= 0)
                                        <i class="fa-solid fa-ban"></i>
                                        Unavailable
                                    @else
                                        <i class="fa-solid fa-plus"></i>
                                        Add to Cart
                                    @endif
                                </button>

                            </form>

                        </div>

                    </div>

                @empty

                    <div class="empty-state">
                        <i class="fa-solid fa-box-open"></i>
                        <h3>No Products Found</h3>
                        <p>
                            Add products to your inventory before making a sale.
                        </p>
                    </div>

                @endforelse

                <div class="empty-state no-results" id="noResults">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <h3>No Matching Products</h3>
                    <p>Try searching using another product name or category.</p>
                </div>

            </div>

        </section>

        <div class="footer-note">
            Track&Tally &copy; {{ date('Y') }} · Sales and Inventory Management
        </div>

    </main>

</div>

<script>
    // MOBILE SIDEBAR
    const sidebar = document.getElementById('sidebar');
    const menuButton = document.getElementById('mobileMenuButton');
    const overlay = document.getElementById('sidebarOverlay');

    function closeSidebar() {
        sidebar.classList.remove('open');
        overlay.classList.remove('show');
    }

    menuButton.addEventListener('click', function () {
        sidebar.classList.toggle('open');
        overlay.classList.toggle('show');
    });

    overlay.addEventListener('click', closeSidebar);

    // PRODUCT SEARCH
    const searchInput = document.getElementById('productSearch');
    const productRows = document.querySelectorAll('.product-row');
    const noResults = document.getElementById('noResults');

    function searchProducts() {
        const searchValue = searchInput.value.toLowerCase().trim();
        let visibleCount = 0;

        productRows.forEach(function (row) {
            const productText = row.dataset.search || '';

            if (productText.includes(searchValue)) {
                row.style.display = 'flex';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        noResults.style.display =
            visibleCount === 0 && productRows.length > 0
                ? 'block'
                : 'none';
    }

    searchInput.addEventListener('input', searchProducts);
    searchProducts();
</script>

</body>
</html>