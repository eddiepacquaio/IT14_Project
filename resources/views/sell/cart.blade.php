
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Shopping Cart | Track&Tally</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --navy: #17233D;
            --navy-light: #263957;
            --gold: #D9A928;
            --gold-light: #F5D77B;
            --cream: #F5F2E8;
            --muted: #8991A0;
            --border: #EAECEF;
            --white: #FFFFFF;
            --red: #D64545;
            --green: #23834B;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--cream);
            color: var(--navy);
            padding: 40px 25px;
            min-height: 100vh;
        }

        button, input {
            font-family: inherit;
        }

        .container {
            max-width: 1100px;
            margin: auto;
        }

        /* HEADER */

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            gap: 20px;
        }

        .heading-group {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .cart-icon {
            width: 58px;
            height: 58px;
            border-radius: 17px;
            display: grid;
            place-items: center;
            background: var(--navy);
            color: var(--gold-light);
            font-size: 26px;
            box-shadow: 0 7px 18px rgba(23,35,61,.17);
        }

        h1 {
            font-size: 29px;
            font-weight: 900;
            letter-spacing: -.8px;
        }

        .subtitle {
            color: var(--muted);
            margin-top: 6px;
            font-size: 13px;
        }

        /* BUTTONS */

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            border-radius: 11px;
            padding: 12px 18px;
            font-size: 13px;
            font-weight: 800;
            transition: all .25s ease;
            white-space: nowrap;
        }

        .btn:hover {
            transform: translateY(-3px);
        }

        .btn:active {
            transform: scale(.97);
        }

        .btn:focus-visible {
            outline: 3px solid var(--gold);
            outline-offset: 3px;
        }

        .back-btn {
            background: var(--navy);
            color: white;
            box-shadow: 0 5px 12px rgba(23,35,61,.13);
        }

        .back-btn:hover {
            background: var(--navy-light);
            box-shadow: 0 8px 18px rgba(23,35,61,.2);
        }

        /* CART CARD */

        .cart-card {
            background: white;
            border: 1px solid rgba(23,35,61,.04);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 12px 35px rgba(23,35,61,.055);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border);
        }

        .section-header h2 {
            font-size: 17px;
            font-weight: 900;
        }

        .section-caption {
            font-size: 12px;
            color: var(--muted);
        }

        /* CART ITEMS */

        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 25px;
            padding: 24px 5px;
            border-bottom: 1px solid var(--border);
            transition: background .2s ease;
        }

        .cart-item:hover {
            background: #FCFCFA;
        }

        .product-info {
            display: flex;
            align-items: center;
            gap: 16px;
            min-width: 0;
        }

        .product-icon {
            width: 52px;
            height: 52px;
            flex-shrink: 0;
            display: grid;
            place-items: center;
            background: #F5F2E8;
            color: var(--navy);
            border-radius: 15px;
            font-size: 23px;
        }

        .product-name {
            font-size: 15px;
            font-weight: 900;
            overflow-wrap: anywhere;
        }

        .product-details {
            color: var(--muted);
            font-size: 11px;
            margin-top: 7px;
            font-weight: 600;
        }

        .mode-badge {
            display: inline-block;
            background: #F0F3F8;
            color: var(--navy);
            padding: 5px 9px;
            border-radius: 7px;
            font-size: 10px;
            font-weight: 800;
            margin-top: 7px;
        }

        .item-price {
            font-weight: 900;
            font-size: 15px;
            margin-top: 8px;
            color: var(--navy);
        }

        /* QUANTITY AND ACTIONS */

        .actions {
            display: flex;
            align-items: center;
            gap: 9px;
            flex-shrink: 0;
        }

        .update-form {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        input[type="number"] {
            width: 85px;
            height: 42px;
            padding: 0 10px;
            border: 1.5px solid #E0E4EA;
            border-radius: 10px;
            background: #FAFBFC;
            color: var(--navy);
            font-size: 13px;
            font-weight: 800;
            outline: none;
            transition: .2s ease;
        }

        input[type="number"]:focus {
            border-color: var(--gold);
            background: white;
            box-shadow: 0 0 0 3px rgba(217,169,40,.13);
        }

        .update-btn {
            background: var(--navy);
            color: white;
            box-shadow: 0 4px 10px rgba(23,35,61,.13);
        }

        .update-btn:hover {
            background: #304565;
            box-shadow: 0 7px 15px rgba(23,35,61,.2);
        }

        .remove-btn {
            background: #FFF0F0;
            color: var(--red);
            border: 1px solid #F8DADA;
        }

        .remove-btn:hover {
            background: var(--red);
            color: white;
            border-color: var(--red);
            box-shadow: 0 6px 14px rgba(214,69,69,.2);
        }

        /* SUMMARY */

        .summary {
            margin-top: 25px;
            padding: 25px;
            border-radius: 16px;
            background: linear-gradient(135deg, #F9F7F0, #FFFDF7);
            border: 1px solid #EEE7D5;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .total-label {
            color: var(--muted);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.2px;
        }

        .total {
            font-size: 32px;
            font-weight: 900;
            margin-top: 7px;
            letter-spacing: -1px;
            color: var(--navy);
        }

        .summary-note {
            color: var(--muted);
            font-size: 11px;
            margin-top: 5px;
        }

        .summary-actions {
            display: flex;
            align-items: center;
            gap: 11px;
            flex-wrap: wrap;
        }

        .checkout-btn {
            background: linear-gradient(135deg, #E9BD48, #D9A928);
            color: var(--navy);
            padding: 15px 23px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(217,169,40,.25);
        }

        .checkout-btn:hover {
            background: linear-gradient(135deg, #F5D77B, #E0B337);
            box-shadow: 0 10px 22px rgba(217,169,40,.35);
        }

        .clear-btn {
            background: white;
            color: #667085;
            border: 1px solid #E1E4E9;
        }

        .clear-btn:hover {
            background: #F1F2F4;
            color: var(--navy);
            border-color: #CDD2DA;
        }

        /* EMPTY CART */

        .empty {
            text-align: center;
            padding: 75px 15px;
        }

        .empty-icon {
            width: 90px;
            height: 90px;
            border-radius: 28px;
            display: grid;
            place-items: center;
            margin: 0 auto 22px;
            background: #F5F2E8;
            font-size: 40px;
        }

        .empty h2 {
            font-size: 22px;
            font-weight: 900;
            margin-bottom: 10px;
        }

        .empty p {
            color: var(--muted);
            font-size: 13px;
            margin-bottom: 25px;
            line-height: 1.7;
        }

        .browse-btn {
            background: var(--gold);
            color: var(--navy);
            padding: 14px 24px;
            box-shadow: 0 6px 15px rgba(217,169,40,.22);
        }

        .browse-btn:hover {
            background: #EAC04C;
            box-shadow: 0 9px 20px rgba(217,169,40,.32);
        }

        /* ALERTS */

        .alert {
            padding: 14px 17px;
            border-radius: 11px;
            margin-bottom: 18px;
            font-size: 13px;
            font-weight: 600;
            animation: slideDown .3s ease;
        }

        .success {
            background: #EAF8EF;
            color: var(--green);
            border: 1px solid #CDEBD7;
        }

        .error {
            background: #FFF0F0;
            color: #C0392B;
            border: 1px solid #F4D2D2;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* RESPONSIVE */

        @media (max-width: 750px) {
            body {
                padding: 22px 14px;
            }

            .cart-card {
                padding: 20px;
            }

            .cart-item {
                align-items: flex-start;
                flex-direction: column;
                gap: 18px;
            }

            .actions {
                width: 100%;
                flex-wrap: wrap;
            }

            .update-form {
                flex: 1;
            }

            input[type="number"] {
                flex: 1;
                width: 60px;
            }

            .summary {
                align-items: flex-start;
                flex-direction: column;
            }

            .summary-actions {
                width: 100%;
            }

            .summary-actions form {
                flex: 1;
            }

            .summary-actions .btn {
                width: 100%;
            }

            .checkout-btn {
                flex: 1;
            }
        }

        @media (max-width: 480px) {
            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            h1 {
                font-size: 24px;
            }

            .back-btn {
                width: 100%;
            }

            .summary-actions {
                flex-direction: column;
            }

            .summary-actions form,
            .summary-actions > a {
                width: 100%;
            }

            .total {
                font-size: 28px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="topbar">

        <div class="heading-group">
            <div class="cart-icon">🛒</div>

            <div>
                <h1>Shopping Cart</h1>
                <p class="subtitle">
                    Review your selected products before checkout.
                </p>
            </div>
        </div>

        <a href="{{ route('sell.index') }}" class="btn back-btn">
            ← Back to Sell
        </a>

    </div>

    <!-- ALERTS -->
    @if(session('success'))
        <div class="alert success">
            ✓ {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert error">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert error">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <!-- CART -->
    <div class="cart-card">

        @if(empty($cart))

            <div class="empty">

                <div class="empty-icon">🛍️</div>

                <h2>Your cart is empty</h2>

                <p>
                    You haven't added any products yet.<br>
                    Start browsing your inventory to make a sale.
                </p>

                <a href="{{ route('sell.index') }}" class="btn browse-btn">
                    Browse Products →
                </a>

            </div>

        @else

            <div class="section-header">
                <h2>Order Items</h2>
                <span class="section-caption">
                    {{ count($cart) }} product(s)
                </span>
            </div>

            @foreach($cart as $id => $item)

                <div class="cart-item">

                    <div class="product-info">

                        <div class="product-icon">📦</div>

                        <div>
                            <div class="product-name">
                                {{ $item['name'] }}
                            </div>

                            <div class="product-details">
                                ₱{{ number_format((float) $item['price'], 2) }}
                                per {{ $item['mode'] ?? 'item' }}
                            </div>

                            <span class="mode-badge">
                                {{ ucfirst($item['mode'] ?? 'item') }}
                                · {{ $item['quantity'] }}
                                {{ $item['unit'] ?? 'piece' }}
                            </span>

                            <div class="item-price">
                                ₱{{ number_format((float) $item['price'] * (float) $item['quantity'], 2) }}
                            </div>
                        </div>

                    </div>

                    <div class="actions">

                        <!-- UPDATE QUANTITY -->
                        <form
                            action="{{ route('sell.cart.update', $id) }}"
                            method="POST"
                            class="update-form"
                        >
                            @csrf
                            @method('PATCH')

                            <input
                                type="number"
                                name="quantity"
                                value="{{ $item['quantity'] }}"
                                min="1"
                                step="any"
                                required
                                aria-label="Quantity"
                            >

                            <button type="submit" class="btn update-btn">
                                ✓ Update
                            </button>
                        </form>

                        <!-- REMOVE ITEM -->
                        <form
                            action="{{ route('sell.cart.remove', $id) }}"
                            method="POST"
                            onsubmit="return confirm('Are you sure you want to remove this product?')"
                        >
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn remove-btn">
                                ✕ Remove
                            </button>
                        </form>

                    </div>

                </div>

            @endforeach

            <!-- TOTAL SUMMARY -->
            <div class="summary">

                <div>
                    <div class="total-label">TOTAL AMOUNT</div>

                    <div class="total">
                        ₱{{ number_format((float) $total, 2) }}
                    </div>

                    <div class="summary-note">
                        Final amount of all selected products
                    </div>
                </div>

                <div class="summary-actions">

                    <!-- CLEAR CART -->
                    <form
                        action="{{ route('sell.cart.clear') }}"
                        method="POST"
                        onsubmit="return confirm('Clear all items from your cart?')"
                    >
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn clear-btn">
                            🗑 Clear Cart
                        </button>
                    </form>

                    <!-- CHECKOUT -->
                    <a href="{{ route('sell.checkout') }}" class="btn checkout-btn">
                        Proceed to Checkout →
                    </a>

                </div>

            </div>

        @endif

    </div>

</div>

</body>
</html>
