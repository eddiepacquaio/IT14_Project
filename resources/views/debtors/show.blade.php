<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Details | Track&Tally</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --navy: #172D48;
            --navy2: #29496C;
            --gold: #C9A24B;
            --gold-light: #E8C66E;
            --cream: #F5F2E8;
            --white: #FFFFFF;
            --text: #273A50;
            --muted: #8995A4;
            --border: #E8EBEF;
            --green: #31845B;
            --red: #C04444;
            --shadow: 0 12px 35px rgba(23,45,72,.07);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            font-family: 'DM Sans', sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at 5% 0%, rgba(201,162,75,.13), transparent 28%),
                radial-gradient(circle at 95% 30%, rgba(41,73,108,.06), transparent 25%),
                #F6F5F0;
        }

        button, input {
            font: inherit;
        }

        button, a {
            -webkit-tap-highlight-color: transparent;
        }

        .app {
            max-width: 1300px;
            margin: auto;
            padding: 28px 35px 55px;
        }

        /* TOP NAVIGATION */

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 19px;
            margin-bottom: 35px;
            border: 1px solid rgba(255,255,255,.9);
            border-radius: 20px;
            background: rgba(255,255,255,.92);
            box-shadow: 0 8px 25px rgba(23,45,72,.05);
            backdrop-filter: blur(12px);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-icon {
            width: 47px;
            height: 47px;
            display: grid;
            place-items: center;
            border-radius: 15px;
            background: linear-gradient(145deg, #345B79, #142940);
            color: var(--gold-light);
            font-size: 23px;
            box-shadow: 0 5px 12px rgba(23,45,72,.18);
        }

        .brand-name {
            color: var(--navy);
            font-family: 'Manrope', sans-serif;
            font-size: 17px;
            font-weight: 800;
        }

        .brand-subtitle {
            margin-top: 3px;
            color: var(--muted);
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 1.3px;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 12px 17px;
            border: 1px solid #E7EAF0;
            border-radius: 12px;
            background: white;
            color: var(--navy);
            text-decoration: none;
            font-size: 11px;
            font-weight: 800;
            transition: .25s ease;
        }

        .back-button:hover {
            transform: translateY(-2px);
            border-color: var(--gold);
            background: #FFFCF5;
            box-shadow: 0 7px 16px rgba(201,162,75,.12);
        }

        /* PAGE HEADING */

        .page-heading {
            margin-bottom: 24px;
        }

        .eyebrow {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 9px;
            color: #A98231;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 2px;
        }

        .eyebrow::before {
            content: "";
            width: 22px;
            height: 2px;
            border-radius: 5px;
            background: var(--gold);
        }

        .page-heading h1 {
            color: var(--navy);
            font-family: 'Manrope', sans-serif;
            font-size: 34px;
            font-weight: 800;
            letter-spacing: -1.2px;
        }

        .page-heading p {
            margin-top: 8px;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.7;
        }

        /* FLASH MESSAGES */

        .flash {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 15px 18px;
            margin-bottom: 20px;
            border-radius: 13px;
            font-size: 12px;
            font-weight: 700;
        }

        .flash-icon {
            width: 29px;
            height: 29px;
            display: grid;
            place-items: center;
            border-radius: 9px;
            background: rgba(255,255,255,.7);
            font-size: 15px;
        }

        .flash.success {
            border: 1px solid #CBE8D5;
            background: #EDF7F1;
            color: var(--green);
        }

        .flash.error {
            border: 1px solid #F0CCCC;
            background: #FDF0F0;
            color: var(--red);
        }

        /* PROFILE CARD */

        .profile-card {
            position: relative;
            overflow: hidden;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 25px;
            padding: 34px;
            margin-bottom: 25px;
            border: 1px solid rgba(232,198,110,.3);
            border-radius: 25px;
            background: linear-gradient(115deg, #13283E, #1D3A58 65%, #345B79);
            color: white;
            box-shadow: 0 18px 40px rgba(23,45,72,.14);
        }

        .profile-card::before {
            content: "";
            position: absolute;
            width: 310px;
            height: 310px;
            right: 8%;
            top: -210px;
            border: 1px solid rgba(232,198,110,.2);
            border-radius: 50%;
            box-shadow:
                0 0 0 30px rgba(232,198,110,.035),
                0 0 0 65px rgba(232,198,110,.025);
        }

        .profile-card::after {
            content: "";
            position: absolute;
            width: 160px;
            height: 160px;
            bottom: -115px;
            left: 38%;
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 50%;
        }

        .profile-left {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            gap: 21px;
            min-width: 0;
        }

        .avatar {
            width: 88px;
            height: 88px;
            min-width: 88px;
            display: grid;
            place-items: center;
            border: 2px solid rgba(232,198,110,.55);
            border-radius: 25px;
            background: linear-gradient(145deg, rgba(201,162,75,.27), rgba(201,162,75,.08));
            color: var(--gold-light);
            font-family: 'Manrope', sans-serif;
            font-size: 32px;
            font-weight: 800;
            box-shadow: inset 0 0 20px rgba(255,255,255,.04);
        }

        .profile-name {
            color: white;
            font-family: 'Manrope', sans-serif;
            font-size: 26px;
            font-weight: 800;
            overflow-wrap: anywhere;
        }

        .profile-id {
            margin-top: 7px;
            color: #C8D2DE;
            font-size: 11px;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 13px;
            padding: 8px 12px;
            border: 1px solid rgba(255,255,255,.09);
            border-radius: 9px;
            font-size: 9px;
            font-weight: 800;
            letter-spacing: .7px;
        }

        .status.owes {
            background: rgba(255,225,225,.13);
            color: #FFD0D0;
        }

        .status.settled {
            background: rgba(183,255,210,.13);
            color: #B8F0CC;
        }

        .status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: currentColor;
            box-shadow: 0 0 8px currentColor;
        }

        .profile-balance {
            position: relative;
            z-index: 1;
            min-width: 245px;
            padding: 23px 25px;
            border: 1px solid rgba(255,255,255,.16);
            border-radius: 19px;
            background: rgba(255,255,255,.09);
            backdrop-filter: blur(10px);
            text-align: right;
        }

        .balance-label {
            color: #FFFFFFB0;
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 1.5px;
        }

        .balance-value {
            margin-top: 9px;
            color: white;
            font-family: 'Manrope', sans-serif;
            font-size: 31px;
            font-weight: 800;
            letter-spacing: -.8px;
        }

        .balance-caption {
            margin-top: 7px;
            color: #C8D2DE;
            font-size: 10px;
        }

        /* ACTION BUTTONS */

        .action-section {
            padding: 20px;
            margin-bottom: 25px;
            border: 1px solid var(--border);
            border-radius: 19px;
            background: rgba(255,255,255,.85);
            box-shadow: 0 6px 20px rgba(23,45,72,.035);
        }

        .action-heading {
            margin-bottom: 14px;
            color: var(--navy);
            font-family: 'Manrope', sans-serif;
            font-size: 12px;
            font-weight: 800;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 12px;
        }

        .action-button {
            position: relative;
            overflow: hidden;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            min-height: 47px;
            padding: 0 19px;
            border: 1px solid #E7EAF0;
            border-radius: 12px;
            background: white;
            color: var(--navy);
            text-decoration: none;
            font-size: 11px;
            font-weight: 800;
            cursor: pointer;
            transition: transform .22s ease, box-shadow .22s ease, background .22s ease, border-color .22s ease;
        }

        .action-button:hover {
            transform: translateY(-3px);
            border-color: var(--gold);
            background: #FFFCF5;
            box-shadow: 0 8px 18px rgba(23,45,72,.09);
        }

        .action-button:active {
            transform: translateY(-1px) scale(.98);
        }

        .action-button:focus-visible,
        .back-button:focus-visible,
        .delete-transaction:focus-visible {
            outline: 3px solid rgba(201,162,75,.4);
            outline-offset: 3px;
        }

        .button-icon {
            width: 25px;
            height: 25px;
            display: grid;
            place-items: center;
            border-radius: 8px;
            background: #F0F3F7;
            font-size: 13px;
            transition: .2s;
        }

        .action-button:hover .button-icon {
            background: #F8EFD9;
        }

        .action-button.primary {
            border-color: var(--navy);
            background: linear-gradient(135deg, #29496C, #172D48);
            color: white;
            box-shadow: 0 5px 12px rgba(23,45,72,.13);
        }

        .action-button.primary .button-icon {
            background: rgba(255,255,255,.13);
            color: var(--gold-light);
        }

        .action-button.primary:hover {
            border-color: #345B79;
            background: linear-gradient(135deg, #345B79, #203D5D);
            box-shadow: 0 9px 20px rgba(23,45,72,.2);
        }

        .action-button.payment-button {
            border-color: #CFE8D8;
            background: #F2FAF5;
            color: #28734E;
        }

        .action-button.payment-button .button-icon {
            background: #DFF2E6;
        }

        .action-button.payment-button:hover {
            border-color: #82C59B;
            background: #EAF7EF;
            box-shadow: 0 8px 18px rgba(49,132,91,.1);
        }

        .action-button.danger {
            margin-left: auto;
            border-color: #F1D7D7;
            background: #FFF8F8;
            color: var(--red);
        }

        .action-button.danger .button-icon {
            background: #FCE8E8;
        }

        .action-button.danger:hover {
            border-color: #E4A5A5;
            background: #FDF0F0;
            box-shadow: 0 8px 18px rgba(192,68,68,.1);
        }

        .delete-form {
            display: inline-flex;
            margin: 0;
        }

        /* CONTENT GRID */

        .content-grid {
            display: grid;
            grid-template-columns: minmax(280px, .95fr) minmax(0, 1.5fr);
            gap: 22px;
            align-items: start;
        }

        .panel {
            overflow: hidden;
            border: 1px solid var(--border);
            border-radius: 20px;
            background: white;
            box-shadow: var(--shadow);
            transition: box-shadow .25s ease;
        }

        .panel:hover {
            box-shadow: 0 15px 35px rgba(23,45,72,.08);
        }

        .panel-header {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 21px 23px;
            border-bottom: 1px solid #EEF0F3;
            background: linear-gradient(110deg, #FBFCFD, #F8F9FB);
        }

        .panel-header-icon {
            width: 39px;
            height: 39px;
            display: grid;
            place-items: center;
            border-radius: 12px;
            background: #F3EEDG;
            background: #F6F0E2;
            color: #A98231;
            font-size: 17px;
        }

        .panel-header h2 {
            color: var(--navy);
            font-family: 'Manrope', sans-serif;
            font-size: 14px;
            font-weight: 800;
        }

        .panel-header p {
            margin-top: 5px;
            color: var(--muted);
            font-size: 10px;
        }

        .panel-body {
            padding: 23px;
        }

        /* PERSONAL INFORMATION */

        .info-item {
            position: relative;
            padding: 14px 0;
            border-bottom: 1px solid #F0F2F5;
        }

        .info-item:first-child {
            padding-top: 0;
        }

        .info-item:last-child {
            padding-bottom: 0;
            border-bottom: 0;
        }

        .info-label {
            color: var(--muted);
            font-size: 9px;
            font-weight: 800;
            letter-spacing: .9px;
            text-transform: uppercase;
        }

        .info-value {
            margin-top: 7px;
            color: var(--navy);
            font-size: 12px;
            font-weight: 700;
            line-height: 1.6;
            overflow-wrap: anywhere;
        }

        .photo-box {
            padding-top: 19px;
            margin-top: 17px;
            border-top: 1px solid #F0F2F5;
        }

        .photo-title {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 11px;
            color: var(--muted);
            font-size: 9px;
            font-weight: 800;
            letter-spacing: .9px;
        }

        .photo-box img {
            display: block;
            width: 100%;
            max-height: 240px;
            object-fit: contain;
            padding: 7px;
            border: 1px solid var(--border);
            border-radius: 13px;
            background: #F8F9FA;
        }

        /* TRANSACTION HISTORY */

        .history-summary {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            padding: 12px 14px;
            margin-bottom: 5px;
            border: 1px solid #EEE8D9;
            border-radius: 11px;
            background: #FFFCF5;
        }

        .history-summary span {
            color: #8A7650;
            font-size: 10px;
            font-weight: 700;
        }

        .history-summary strong {
            color: var(--navy);
            font-size: 11px;
            font-weight: 800;
        }

        .transaction {
            display: grid;
            grid-template-columns: 43px minmax(0,1fr) auto;
            align-items: center;
            gap: 13px;
            padding: 18px 0;
            border-bottom: 1px solid #F0F2F5;
        }

        .transaction:last-child {
            border-bottom: 0;
        }

        .transaction-icon {
            width: 42px;
            height: 42px;
            display: grid;
            place-items: center;
            border-radius: 14px;
            font-size: 18px;
            font-weight: 800;
        }

        .transaction-icon.credit {
            background: #FDF0F0;
            color: var(--red);
        }

        .transaction-icon.payment {
            background: #EDF7F1;
            color: var(--green);
        }

        .transaction-title {
            color: var(--navy);
            font-size: 11px;
            font-weight: 800;
        }

        .transaction-description {
            margin-top: 5px;
            color: var(--muted);
            font-size: 9px;
            line-height: 1.7;
            overflow-wrap: anywhere;
        }

        .transaction-date {
            display: flex;
            align-items: center;
            gap: 5px;
            margin-top: 6px;
            color: #A2ABB5;
            font-size: 9px;
        }

        .transaction-right {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 7px;
        }

        .transaction-amount {
            text-align: right;
            font-family: 'Manrope', sans-serif;
            font-size: 13px;
            font-weight: 800;
            white-space: nowrap;
        }

        .transaction-amount.credit {
            color: var(--red);
        }

        .transaction-amount.payment {
            color: var(--green);
        }

        .running-balance {
            margin-top: 5px;
            color: var(--muted);
            font-size: 9px;
            text-align: right;
        }

        .delete-transaction {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            min-height: 29px;
            padding: 0 10px;
            border: 1px solid #F0DADA;
            border-radius: 8px;
            background: #FFF8F8;
            color: var(--red);
            cursor: pointer;
            font-size: 9px;
            font-weight: 800;
            transition: .2s ease;
        }

        .delete-transaction:hover {
            transform: translateY(-2px);
            border-color: #DFAAAA;
            background: #FCEBEB;
            box-shadow: 0 4px 10px rgba(192,68,68,.08);
        }

        .empty-history {
            padding: 50px 15px;
            color: var(--muted);
            text-align: center;
            font-size: 11px;
            line-height: 1.7;
        }

        .empty-icon {
            width: 58px;
            height: 58px;
            display: grid;
            place-items: center;
            margin: 0 auto 15px;
            border-radius: 19px;
            background: #F5F2E8;
            color: #A98231;
            font-size: 25px;
        }

        .empty-history strong {
            display: block;
            margin-bottom: 7px;
            color: var(--navy);
            font-family: 'Manrope', sans-serif;
            font-size: 15px;
        }

        /* FOOTER */

        .footer {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            padding: 23px 4px 0;
            margin-top: 30px;
            border-top: 1px solid rgba(23,45,72,.1);
            color: var(--muted);
            font-size: 10px;
        }

        .footer strong {
            color: var(--navy);
        }

        /* RESPONSIVE DESIGN */

        @media (max-width: 900px) {
            .app {
                padding: 22px;
            }

            .content-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 700px) {
            .profile-card {
                align-items: flex-start;
                flex-direction: column;
            }

            .profile-balance {
                width: 100%;
                text-align: left;
            }

            .balance-value {
                font-size: 28px;
            }

            .action-button.danger {
                margin-left: 0;
            }
        }

        @media (max-width: 480px) {
            .app {
                padding: 14px 11px 30px;
            }

            .topbar {
                padding: 10px;
                margin-bottom: 27px;
                border-radius: 15px;
            }

            .brand {
                gap: 8px;
            }

            .brand-icon {
                width: 39px;
                height: 39px;
                border-radius: 12px;
                font-size: 19px;
            }

            .brand-name {
                font-size: 13px;
            }

            .brand-subtitle {
                font-size: 7px;
                letter-spacing: .8px;
            }

            .back-button {
                gap: 5px;
                padding: 9px;
                font-size: 9px;
            }

            .page-heading h1 {
                font-size: 27px;
            }

            .profile-card {
                padding: 22px 17px;
                border-radius: 19px;
            }

            .profile-left {
                gap: 12px;
            }

            .avatar {
                width: 61px;
                height: 61px;
                min-width: 61px;
                border-radius: 17px;
                font-size: 23px;
            }

            .profile-name {
                font-size: 18px;
            }

            .profile-id {
                font-size: 9px;
            }

            .status {
                font-size: 8px;
            }

            .profile-balance {
                min-width: 0;
                padding: 17px;
            }

            .balance-label {
                font-size: 8px;
            }

            .balance-value {
                font-size: 25px;
            }

            .action-section {
                padding: 15px;
            }

            .actions {
                display: grid;
                grid-template-columns: 1fr;
                gap: 9px;
            }

            .action-button,
            .delete-form {
                width: 100%;
            }

            .action-button {
                min-height: 48px;
                justify-content: flex-start;
                padding: 0 14px;
            }

            .action-button.danger {
                margin-left: 0;
            }

            .panel-header {
                padding: 17px;
            }

            .panel-body {
                padding: 17px;
            }

            .transaction {
                grid-template-columns: 36px minmax(0,1fr);
                gap: 10px;
            }

            .transaction-icon {
                width: 35px;
                height: 35px;
                border-radius: 11px;
                font-size: 15px;
            }

            .transaction-right {
                grid-column: 2;
                display: flex;
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
                width: 100%;
                gap: 10px;
            }

            .transaction-amount {
                text-align: left;
            }

            .running-balance {
                text-align: left;
            }

            .footer {
                flex-direction: column;
                line-height: 1.7;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                scroll-behavior: auto !important;
                transition-duration: .01ms !important;
                animation-duration: .01ms !important;
            }
        }
    </style>
</head>

<body>
<div class="app">

    <!-- TOP NAVIGATION -->
    <header class="topbar">
        <div class="brand">
            <div class="brand-icon">🏪</div>
            <div>
                <div class="brand-name">Track&Tally</div>
                <div class="brand-subtitle">SIMPLE STORE MANAGEMENT</div>
            </div>
        </div>

        <a href="{{ route('debtors.index') }}" class="back-button">
            <span>←</span>
            Back to Debtors
        </a>
    </header>

    @php
        $name = $debtor->full_name ?? 'Unknown Customer';
        $initial = strtoupper(mb_substr(trim($name), 0, 1));
        $balance = max((float) ($balance ?? 0), 0);
        $hasDebt = $balance > 0;
        $transactionCount = $transactions->count();
    @endphp

    <!-- PAGE HEADING -->
    <section class="page-heading">
        <div class="eyebrow">CUSTOMER MANAGEMENT</div>
        <h1>Customer Details</h1>
        <p>Manage customer information, outstanding credit, and payment history.</p>
    </section>

    <!-- FLASH MESSAGES -->
    @if(session('success'))
        <div class="flash success">
            <span class="flash-icon">✓</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="flash error">
            <span class="flash-icon">!</span>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <!-- CUSTOMER PROFILE -->
    <section class="profile-card">

        <div class="profile-left">
            <div class="avatar">{{ $initial }}</div>

            <div>
                <div class="profile-name">{{ $name }}</div>

                <div class="profile-id">
                    Customer Account #{{ $debtor->id }}
                </div>

                <div class="status {{ $hasDebt ? 'owes' : 'settled' }}">
                    <span class="status-dot"></span>
                    {{ $hasDebt ? 'HAS OUTSTANDING BALANCE' : 'ACCOUNT SETTLED' }}
                </div>
            </div>
        </div>

        <div class="profile-balance">
            <div class="balance-label">CURRENT OUTSTANDING BALANCE</div>
            <div class="balance-value">₱{{ number_format($balance, 2) }}</div>
            <div class="balance-caption">
                {{ $hasDebt ? 'Amount the customer still needs to pay' : 'No outstanding payment' }}
            </div>
        </div>

    </section>

    <!-- ACTION BUTTONS -->
    <section class="action-section">

        <div class="action-heading">CUSTOMER ACTIONS</div>

        <div class="actions">

            <a href="{{ url('/debtors/' . $debtor->id . '/edit') }}" class="action-button">
                <span class="button-icon">✏️</span>
                Edit Profile
            </a>

            <a href="{{ url('/debtors/' . $debtor->id . '/add-credit') }}"
               class="action-button primary">
                <span class="button-icon">＋</span>
                Add Credit
            </a>

            <a href="{{ route('debtors.payments.create', ['debtorId' => $debtor->id]) }}"
            class="action-button payment-button">
                <span class="button-icon">₱</span>
                Record Payment
            </a>

            <form class="delete-form"
                  action="{{ route('debtors.destroy', $debtor->id) }}"
                  method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this customer?');">

                @csrf
                @method('DELETE')

                <button type="submit" class="action-button danger">
                    <span class="button-icon">🗑</span>
                    Delete Customer
                </button>
            </form>

        </div>
    </section>

    <!-- MAIN CONTENT -->
    <div class="content-grid">

        <!-- PERSONAL INFORMATION -->
        <section class="panel">

            <div class="panel-header">
                <div class="panel-header-icon">👤</div>
                <div>
                    <h2>Personal Information</h2>
                    <p>Customer contact and account information</p>
                </div>
            </div>

            <div class="panel-body">

                <div class="info-item">
                    <div class="info-label">Full Name</div>
                    <div class="info-value">
                        {{ $debtor->full_name ?? 'Not provided' }}
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">Contact Number</div>
                    <div class="info-value">
                        {{ $debtor->contact_number ?? 'Not provided' }}
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">ID Number</div>
                    <div class="info-value">
                        {{ $debtor->id_number ?? 'Not provided' }}
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">Address</div>
                    <div class="info-value">
                        {{ $debtor->address ?? 'Not provided' }}
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">Credit Limit</div>
                    <div class="info-value">
                        ₱{{ number_format((float) ($debtor->credit_limit ?? 0), 2) }}
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">Notes</div>
                    <div class="info-value">
                        {{ $debtor->notes ?: 'No additional notes' }}
                    </div>
                </div>

                @if(!empty($debtor->profile_photo_uri))
                    <div class="photo-box">
                        <div class="photo-title">📷 PROFILE PHOTO</div>
                        <img src="{{ asset($debtor->profile_photo_uri) }}"
                             alt="Customer profile photo">
                    </div>
                @endif

                @if(!empty($debtor->id_photo_uri))
                    <div class="photo-box">
                        <div class="photo-title">🪪 IDENTIFICATION PHOTO</div>
                        <img src="{{ asset($debtor->id_photo_uri) }}"
                             alt="Customer identification photo">
                    </div>
                @endif

            </div>
        </section>

        <!-- TRANSACTION HISTORY -->
        <section class="panel">

            <div class="panel-header">
                <div class="panel-header-icon">📋</div>
                <div>
                    <h2>Transaction History</h2>
                    <p>Credit records and customer payments</p>
                </div>
            </div>

            <div class="panel-body">

                <div class="history-summary">
                    <span>Total recorded transactions</span>
                    <strong>{{ $transactionCount }} Records</strong>
                </div>

                @forelse($transactions as $transaction)

                    @php
                        $type = strtolower($transaction->type ?? '');
                        $isPayment = $type === 'payment';
                        $amount = (float) ($transaction->amount ?? 0);
                    @endphp

                    <div class="transaction">

                        <div class="transaction-icon {{ $isPayment ? 'payment' : 'credit' }}">
                            {{ $isPayment ? '✓' : '+' }}
                        </div>

                        <div>
                            <div class="transaction-title">
                                {{ $isPayment ? 'Customer Payment' : 'Credit / Utang' }}
                            </div>

                            <div class="transaction-description">
                                {{ $transaction->description ?: ($isPayment ? 'Payment received' : 'Credit added') }}

                                @if(!empty($transaction->payment_method))
                                    <br>Method: {{ ucfirst($transaction->payment_method) }}
                                @endif

                                @if(!empty($transaction->payment_provider))
                                    <br>Provider: {{ $transaction->payment_provider }}
                                @endif

                                @if(!empty($transaction->payment_reference))
                                    <br>Reference: {{ $transaction->payment_reference }}
                                @endif
                            </div>

                            <div class="transaction-date">
                                🕒
                                {{ $transaction->created_at
                                    ? \Carbon\Carbon::parse($transaction->created_at)->format('M d, Y • h:i A')
                                    : 'Date unavailable' }}
                            </div>
                        </div>

                        <div class="transaction-right">

                            <div>
                                <div class="transaction-amount {{ $isPayment ? 'payment' : 'credit' }}">
                                    {{ $isPayment ? '-' : '+' }}₱{{ number_format($amount, 2) }}
                                </div>

                                @if(isset($transaction->running_balance))
                                    <div class="running-balance">
                                        Balance: ₱{{ number_format((float) $transaction->running_balance, 2) }}
                                    </div>
                                @endif
                            </div>

                            <form class="delete-form"
                                  action="{{ route('debtors.transactions.destroy', [$debtor->id, $transaction->id]) }}"
                                  method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this transaction?');">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="delete-transaction">
                                    🗑 Delete
                                </button>
                            </form>

                        </div>

                    </div>

                @empty

                    <div class="empty-history">
                        <div class="empty-icon">📋</div>
                        <strong>No Transactions Yet</strong>
                        This customer does not have any credit or payment records.
                    </div>

                @endforelse

            </div>
        </section>

    </div>

    <!-- FOOTER -->
    <footer class="footer">
        <div>
            <strong>🏪 Track&Tally</strong> — Simple Store Management
        </div>

        <div>
            Your store. Your records. Your control.
        </div>
    </footer>

</div>
</body>
</html>
