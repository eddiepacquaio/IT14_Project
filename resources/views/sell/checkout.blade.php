
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Checkout | Track&Tally</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --navy: #17233D;
            --navy-light: #253653;
            --gold: #D9A928;
            --gold-light: #F6E8B9;
            --cream: #F5F2E8;
            --white: #FFFFFF;
            --text: #202A3B;
            --muted: #7B8494;
            --border: #E7E9EE;
            --green: #15966B;
            --red: #D84B4B;
            --shadow: 0 12px 35px rgba(23, 35, 61, .08);
            --radius: 20px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            background: var(--cream);
            color: var(--text);
            font-family: 'Inter', sans-serif;
        }

        button, input, select {
            font: inherit;
        }

        button {
            cursor: pointer;
        }

        .topbar {
            width: 100%;
            background: var(--navy);
            color: white;
            padding: 17px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 5px 20px rgba(0,0,0,.12);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 21px;
            font-weight: 900;
            letter-spacing: -.7px;
        }

        .brand-icon {
            width: 42px;
            height: 42px;
            background: var(--gold);
            color: var(--navy);
            border-radius: 13px;
            display: grid;
            place-items: center;
        }

        .brand span {
            color: var(--gold);
        }

        .back-link {
            color: white;
            text-decoration: none;
            font-weight: 700;
            display: flex;
            gap: 9px;
            align-items: center;
            padding: 11px 16px;
            border-radius: 12px;
            transition: .2s;
        }

        .back-link:hover {
            background: rgba(255,255,255,.1);
            color: var(--gold);
        }

        .page {
            max-width: 1250px;
            width: 92%;
            margin: 38px auto 70px;
        }

        .page-heading {
            margin-bottom: 27px;
        }

        .eyebrow {
            color: #A77B11;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 11px;
            font-weight: 900;
            margin-bottom: 9px;
        }

        .page-heading h1 {
            font-size: clamp(27px, 4vw, 36px);
            color: var(--navy);
            font-weight: 900;
            letter-spacing: -1.2px;
        }

        .page-heading p {
            color: var(--muted);
            margin-top: 9px;
            line-height: 1.6;
            font-size: 14px;
        }

        .checkout-layout {
            display: grid;
            grid-template-columns: minmax(0, 1.5fr) minmax(310px, .85fr);
            gap: 25px;
            align-items: start;
        }

        .left-column,
        .right-column {
            display: grid;
            gap: 22px;
        }

        .panel {
            background: var(--white);
            border: 1px solid rgba(23,35,61,.05);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .panel-header {
            padding: 22px 25px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .panel-title {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--navy);
            font-size: 16px;
            font-weight: 900;
        }

        .panel-title i {
            color: var(--gold);
            font-size: 18px;
        }

        .panel-body {
            padding: 24px 25px;
        }

        .item-count {
            background: var(--gold-light);
            color: #805D09;
            padding: 7px 11px;
            border-radius: 30px;
            font-size: 11px;
            font-weight: 900;
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            padding: 17px 0;
            border-bottom: 1px solid #F0F1F4;
        }

        .cart-item:first-child {
            padding-top: 0;
        }

        .cart-item:last-child {
            border-bottom: 0;
            padding-bottom: 0;
        }

        .item-info {
            display: flex;
            align-items: center;
            gap: 14px;
            min-width: 0;
        }

        .item-icon {
            width: 49px;
            height: 49px;
            flex-shrink: 0;
            display: grid;
            place-items: center;
            background: #F4F1E7;
            color: var(--navy);
            border-radius: 14px;
            font-size: 19px;
        }

        .item-name {
            color: var(--navy);
            font-weight: 800;
            font-size: 14px;
            overflow-wrap: anywhere;
        }

        .item-meta {
            color: var(--muted);
            font-size: 12px;
            margin-top: 6px;
        }

        .item-total {
            font-size: 14px;
            font-weight: 900;
            color: var(--navy);
            white-space: nowrap;
        }

        .payment-options {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .payment-option {
            position: relative;
        }

        .payment-option input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .payment-card {
            display: flex;
            align-items: flex-start;
            gap: 13px;
            min-height: 112px;
            padding: 18px;
            border: 2px solid var(--border);
            border-radius: 16px;
            cursor: pointer;
            transition: .2s ease;
            background: white;
        }

        .payment-card:hover {
            border-color: var(--gold);
            transform: translateY(-2px);
            box-shadow: 0 7px 18px rgba(217,169,40,.12);
        }

        .payment-option input:checked + .payment-card {
            border-color: var(--gold);
            background: #FFFCF3;
            box-shadow: 0 0 0 3px rgba(217,169,40,.12);
        }

        .payment-icon {
            width: 43px;
            height: 43px;
            display: grid;
            place-items: center;
            border-radius: 13px;
            background: var(--navy);
            color: var(--gold);
            flex-shrink: 0;
            font-size: 17px;
        }

        .payment-option input[value="credit"]:checked + .payment-card .payment-icon {
            background: #FFF0D8;
            color: #A66B0B;
        }

        .payment-name {
            color: var(--navy);
            font-size: 14px;
            font-weight: 900;
            margin-top: 2px;
        }

        .payment-description {
            color: var(--muted);
            font-size: 11px;
            line-height: 1.5;
            margin-top: 7px;
        }

        .check-icon {
            margin-left: auto;
            color: var(--gold);
            opacity: 0;
        }

        .payment-option input:checked + .payment-card .check-icon {
            opacity: 1;
        }

        .debtor-section {
            display: none;
            margin-top: 23px;
            padding: 20px;
            background: #FFFAEF;
            border: 1px solid #F1DFAD;
            border-radius: 15px;
        }

        .debtor-section.show {
            display: block;
            animation: fadeIn .25s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(7px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .field-label {
            display: block;
            color: var(--navy);
            font-size: 12px;
            font-weight: 900;
            margin-bottom: 10px;
        }

        .required {
            color: var(--red);
        }

        .select-wrap {
            position: relative;
        }

        .select-wrap i {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            pointer-events: none;
        }

        .debtor-select {
            width: 100%;
            appearance: none;
            border: 1px solid #E8D8AF;
            background: white;
            padding: 15px 42px 15px 15px;
            border-radius: 12px;
            outline: none;
            color: var(--navy);
            font-weight: 600;
            font-size: 13px;
            transition: .2s;
        }

        .debtor-select:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(217,169,40,.13);
        }

        .debtor-note {
            font-size: 11px;
            color: #876A2A;
            margin-top: 10px;
            line-height: 1.5;
        }

        .summary-panel {
            position: sticky;
            top: 20px;
        }

        .summary-body {
            padding: 24px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 17px;
            color: var(--muted);
            font-size: 13px;
        }

        .summary-row strong {
            color: var(--navy);
            font-weight: 800;
        }

        .summary-divider {
            border: 0;
            border-top: 1px dashed #D9DDE4;
            margin: 21px 0;
        }

        .total-row {
            align-items: flex-end;
            margin-bottom: 0;
        }

        .total-row span {
            color: var(--navy);
            font-weight: 900;
            font-size: 14px;
        }

        .total-amount {
            font-size: 27px;
            color: var(--navy);
            font-weight: 900;
            letter-spacing: -1px;
        }

        .secure-note {
            display: flex;
            gap: 10px;
            align-items: flex-start;
            background: #F1F8F4;
            color: #277653;
            border-radius: 12px;
            padding: 13px;
            margin-top: 23px;
            font-size: 11px;
            line-height: 1.5;
        }

        .secure-note i {
            margin-top: 2px;
        }

        .complete-btn {
            width: 100%;
            margin-top: 22px;
            border: 0;
            background: var(--gold);
            color: var(--navy);
            padding: 17px;
            border-radius: 13px;
            font-weight: 900;
            font-size: 14px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 11px;
            transition: .2s ease;
            box-shadow: 0 7px 18px rgba(217,169,40,.25);
        }

        .complete-btn:hover {
            background: #E9BB3D;
            transform: translateY(-2px);
            box-shadow: 0 10px 22px rgba(217,169,40,.32);
        }

        .complete-btn:active {
            transform: scale(.99);
        }

        .complete-btn:disabled {
            opacity: .65;
            cursor: not-allowed;
            transform: none;
        }

        .cancel-btn {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 9px;
            margin-top: 11px;
            padding: 14px;
            border: 1px solid var(--border);
            border-radius: 12px;
            color: var(--muted);
            background: white;
            text-decoration: none;
            font-size: 12px;
            font-weight: 800;
            transition: .2s;
        }

        .cancel-btn:hover {
            border-color: var(--navy);
            color: var(--navy);
            background: #F8F9FB;
        }

        .alert {
            padding: 15px 18px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 13px;
            font-weight: 600;
            display: flex;
            gap: 10px;
            align-items: flex-start;
        }

        .alert-error {
            background: #FFF0F0;
            border: 1px solid #F3CACA;
            color: #A52E2E;
        }

        .alert-success {
            background: #EFFAF4;
            border: 1px solid #C9EBD7;
            color: #24754B;
        }

        .empty-debtors {
            color: #A66B0B;
            font-size: 12px;
            line-height: 1.5;
            margin-top: 10px;
        }

        .footer-note {
            text-align: center;
            color: #9299A5;
            font-size: 11px;
            margin-top: 30px;
        }

        @media (max-width: 850px) {
            .checkout-layout {
                grid-template-columns: 1fr;
            }

            .summary-panel {
                position: static;
            }
        }

        @media (max-width: 550px) {
            .topbar {
                padding: 13px 4%;
            }

            .brand {
                font-size: 17px;
            }

            .brand-icon {
                width: 36px;
                height: 36px;
            }

            .back-link {
                font-size: 12px;
                padding: 9px;
            }

            .page {
                width: 92%;
                margin-top: 27px;
            }

            .panel-header {
                padding: 18px;
            }

            .panel-body {
                padding: 19px;
            }

            .payment-options {
                grid-template-columns: 1fr;
            }

            .payment-card {
                min-height: auto;
            }

            .total-amount {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>

<header class="topbar">
    <div class="brand">
        <div class="brand-icon">
            <i class="fa-solid fa-store"></i>
        </div>
        Track<span>&Tally</span>
    </div>

    <a href="{{ route('sell.cart') }}" class="back-link">
        <i class="fa-solid fa-arrow-left"></i>
        Back to Cart
    </a>
</header>

<main class="page">

    <div class="page-heading">
        <div class="eyebrow">Track&Tally Store Management</div>
        <h1>Complete Your Checkout</h1>
        <p>Review your items, select your payment method, and complete your transaction.</p>
    </div>

    @if(session('error'))
        <div class="alert alert-error">
            <i class="fa-solid fa-circle-exclamation"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-error">
            <i class="fa-solid fa-circle-exclamation"></i>
            <div>
                <strong>Please check the following:</strong>
                <ul style="margin:8px 0 0 18px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form action="{{ route('sell.complete') }}" method="POST" id="checkoutForm">
        @csrf

        <div class="checkout-layout">

            <div class="left-column">

                <!-- ORDER ITEMS -->
                <section class="panel">
                    <div class="panel-header">
                        <div class="panel-title">
                            <i class="fa-solid fa-bag-shopping"></i>
                            Order Items
                        </div>

                        <span class="item-count">
                            {{ count($cart) }} {{ count($cart) === 1 ? 'ITEM' : 'ITEMS' }}
                        </span>
                    </div>

                    <div class="panel-body">
                        @foreach($cart as $item)
                            <div class="cart-item">
                                <div class="item-info">
                                    <div class="item-icon">
                                        <i class="fa-solid fa-box"></i>
                                    </div>

                                    <div>
                                        <div class="item-name">
                                            {{ $item['name'] ?? 'Product' }}
                                        </div>

                                        <div class="item-meta">
                                            {{ number_format((float)($item['quantity'] ?? 0), 2) }}
                                            {{ $item['unit'] ?? 'pcs' }}
                                            × ₱{{ number_format((float)($item['price'] ?? 0), 2) }}
                                        </div>
                                    </div>
                                </div>

                                <div class="item-total">
                                    ₱{{ number_format((float)($item['price'] ?? 0) * (float)($item['quantity'] ?? 0), 2) }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>

                <!-- PAYMENT METHOD -->
                <section class="panel">
                    <div class="panel-header">
                        <div class="panel-title">
                            <i class="fa-solid fa-wallet"></i>
                            Payment Method
                        </div>
                    </div>

                    <div class="panel-body">

                        <div class="payment-options">

                            <label class="payment-option">
                                <input
                                    type="radio"
                                    name="payment_type"
                                    value="cash"
                                    {{ old('payment_type', 'cash') === 'cash' ? 'checked' : '' }}
                                    required
                                >

                                <div class="payment-card">
                                    <div class="payment-icon">
                                        <i class="fa-solid fa-money-bill-wave"></i>
                                    </div>

                                    <div>
                                        <div class="payment-name">Cash Payment</div>
                                        <div class="payment-description">
                                            Customer pays the full amount immediately.
                                        </div>
                                    </div>

                                    <i class="fa-solid fa-circle-check check-icon"></i>
                                </div>
                            </label>

                            <label class="payment-option">
                                <input
                                    type="radio"
                                    name="payment_type"
                                    value="credit"
                                    {{ old('payment_type') === 'credit' ? 'checked' : '' }}
                                    required
                                >

                                <div class="payment-card">
                                    <div class="payment-icon">
                                        <i class="fa-solid fa-handshake"></i>
                                    </div>

                                    <div>
                                        <div class="payment-name">Utang / Credit</div>
                                        <div class="payment-description">
                                            Record the transaction under a debtor's account.
                                        </div>
                                    </div>

                                    <i class="fa-solid fa-circle-check check-icon"></i>
                                </div>
                            </label>

                        </div>

                        <!-- DEBTOR SELECT -->
                        <div class="debtor-section" id="debtorSection">

                            <label for="debtor_id" class="field-label">
                                Select Debtor <span class="required">*</span>
                            </label>

                            <div class="select-wrap">
                                <select
                                    name="debtor_id"
                                    id="debtor_id"
                                    class="debtor-select"
                                >
                                    <option value="">Choose a debtor...</option>

                                    @foreach($debtors as $debtor)
                                        <option
                                            value="{{ $debtor->id }}"
                                            {{ (string)old('debtor_id') === (string)$debtor->id ? 'selected' : '' }}
                                        >
                                            {{ $debtor->full_name }}
                                        </option>
                                    @endforeach
                                </select>

                                <i class="fa-solid fa-chevron-down"></i>
                            </div>

                            @if(count($debtors) === 0)
                                <div class="empty-debtors">
                                    No debtors found. Add a debtor before completing an Utang transaction.
                                </div>
                            @else
                                <div class="debtor-note">
                                    <i class="fa-solid fa-circle-info"></i>
                                    Select the customer whose account will receive this credit transaction.
                                </div>
                            @endif

                        </div>

                    </div>
                </section>

            </div>

            <!-- ORDER SUMMARY -->
            <div class="right-column">

                <section class="panel summary-panel">

                    <div class="panel-header">
                        <div class="panel-title">
                            <i class="fa-solid fa-receipt"></i>
                            Order Summary
                        </div>
                    </div>

                    <div class="summary-body">

                        <div class="summary-row">
                            <span>Subtotal</span>
                            <strong>₱{{ number_format($total, 2) }}</strong>
                        </div>

                        <div class="summary-row">
                            <span>Discount</span>
                            <strong>₱0.00</strong>
                        </div>

                        <hr class="summary-divider">

                        <div class="summary-row total-row">
                            <span>Total Amount</span>
                            <strong class="total-amount">
                                ₱{{ number_format($total, 2) }}
                            </strong>
                        </div>

                        <div class="secure-note">
                            <i class="fa-solid fa-shield-halved"></i>
                            <span>
                                Your transaction will be recorded in Track&Tally.
                                Please verify your order before completing checkout.
                            </span>
                        </div>

                        <button type="submit" class="complete-btn" id="completeButton">
                            <i class="fa-solid fa-circle-check"></i>
                            Complete Transaction
                        </button>

                        <a href="{{ route('sell.cart') }}" class="cancel-btn">
                            <i class="fa-solid fa-arrow-left"></i>
                            Return to Cart
                        </a>

                    </div>
                </section>

            </div>

        </div>
    </form>

    <div class="footer-note">
        © {{ date('Y') }} Track&Tally · Store Management System
    </div>

</main>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const paymentInputs = document.querySelectorAll(
        'input[name="payment_type"]'
    );

    const debtorSection = document.getElementById('debtorSection');
    const debtorSelect = document.getElementById('debtor_id');
    const checkoutForm = document.getElementById('checkoutForm');
    const completeButton = document.getElementById('completeButton');

    function updatePaymentDisplay() {
        const selectedPayment = document.querySelector(
            'input[name="payment_type"]:checked'
        );

        const paymentType = selectedPayment
            ? selectedPayment.value
            : 'cash';

        if (paymentType === 'credit') {
            debtorSection.classList.add('show');
            debtorSelect.required = true;
        } else {
            debtorSection.classList.remove('show');
            debtorSelect.required = false;
            debtorSelect.setCustomValidity('');
        }
    }

    paymentInputs.forEach(function (input) {
        input.addEventListener('change', updatePaymentDisplay);
    });

    debtorSelect.addEventListener('change', function () {
        if (debtorSelect.value !== '') {
            debtorSelect.setCustomValidity('');
        }
    });

    checkoutForm.addEventListener('submit', function (event) {

        const selectedPayment = document.querySelector(
            'input[name="payment_type"]:checked'
        );

        if (!selectedPayment) {
            event.preventDefault();
            alert('Please select a payment method.');
            return;
        }

        if (
            selectedPayment.value === 'credit' &&
            debtorSelect.value === ''
        ) {
            event.preventDefault();
            debtorSelect.setCustomValidity('Please select a debtor.');
            debtorSelect.reportValidity();
            return;
        }

        completeButton.disabled = true;
        completeButton.innerHTML =
            '<i class="fa-solid fa-spinner fa-spin"></i> Processing Transaction...';
    });

    updatePaymentDisplay();
});
</script>

</body>
</html>
