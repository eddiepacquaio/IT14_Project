
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Print Reports | Track&Tally</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --navy: #17233d;
            --navy-light: #243653;
            --gold: #d9a928;
            --gold-light: #fff7df;
            --cream: #f8f7f2;
            --white: #ffffff;
            --text: #26334a;
            --muted: #8791a3;
            --border: #e8ebf1;
            --green: #16865b;
            --red: #d64d4d;
            --blue: #3973b8;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f0f2f6;
            color: var(--text);
            padding: 30px;
        }

        .print-actions {
            max-width: 1100px;
            margin: 0 auto 20px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 19px;
            border: none;
            border-radius: 9px;
            font-family: inherit;
            font-size: 12px;
            font-weight: 800;
            text-decoration: none;
            cursor: pointer;
            transition: .2s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .btn-back {
            background: var(--navy);
            color: white;
        }

        .btn-print {
            background: var(--gold);
            color: var(--navy);
            box-shadow: 0 4px 12px rgba(217,169,40,.2);
        }

        .report-container {
            max-width: 1100px;
            margin: auto;
            background: var(--white);
            padding: 48px;
            border-radius: 16px;
            box-shadow: 0 8px 35px rgba(23,35,61,.07);
        }

        .report-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 25px;
            padding-bottom: 28px;
            border-bottom: 3px solid var(--gold);
        }

        .brand {
            font-size: 30px;
            font-weight: 900;
            letter-spacing: -1.5px;
            color: var(--navy);
        }

        .brand span,
        .footer-brand span {
            color: var(--gold);
        }

        .brand-subtitle {
            margin-top: 7px;
            color: var(--muted);
            font-size: 12px;
            font-weight: 600;
        }

        .store-name {
            margin-top: 12px;
            color: var(--navy);
            font-size: 15px;
            font-weight: 800;
        }

        .report-information {
            text-align: right;
            font-size: 11px;
            line-height: 1.9;
            color: var(--muted);
        }

        .report-information strong {
            color: var(--navy);
            font-size: 10px;
            letter-spacing: 1px;
        }

        .section {
            margin-top: 32px;
        }

        .section-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 17px;
        }

        .section-title {
            font-size: 16px;
            font-weight: 900;
            color: var(--navy);
        }

        .section-description {
            margin-top: 5px;
            color: var(--muted);
            font-size: 11px;
        }

        .section-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 29px;
            height: 29px;
            margin-right: 8px;
            border-radius: 8px;
            background: var(--gold-light);
            color: #a77a10;
            font-size: 12px;
            font-weight: 900;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 13px;
        }

        .summary-card {
            padding: 19px;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: white;
            position: relative;
            overflow: hidden;
        }

        .summary-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: var(--gold);
        }

        .summary-label {
            color: var(--muted);
            font-size: 9px;
            font-weight: 900;
            letter-spacing: .8px;
            text-transform: uppercase;
        }

        .summary-value {
            margin-top: 12px;
            color: var(--navy);
            font-size: 22px;
            font-weight: 900;
            letter-spacing: -.7px;
            overflow-wrap: anywhere;
        }

        .summary-note {
            margin-top: 7px;
            color: var(--muted);
            font-size: 10px;
        }

        .gold-text { color: #b88913; }
        .blue-text { color: var(--blue); }
        .green-text { color: var(--green); }
        .red-text { color: var(--red); }

        .highlight-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            padding: 23px;
            border: 1px solid #f2dfaa;
            border-radius: 12px;
            background: var(--gold-light);
        }

        .highlight-card small {
            color: #9a751b;
            font-size: 10px;
            font-weight: 900;
            letter-spacing: .8px;
            text-transform: uppercase;
        }

        .highlight-card h2 {
            margin-top: 8px;
            color: var(--navy);
            font-size: 26px;
            font-weight: 900;
        }

        .highlight-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: white;
            color: #b88913;
            font-size: 24px;
            font-weight: 900;
        }

        .table-wrapper {
            width: 100%;
            overflow: hidden;
            border: 1px solid var(--border);
            border-radius: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }

        thead {
            background: var(--navy);
            color: white;
        }

        th {
            padding: 13px 14px;
            text-align: left;
            font-size: 9px;
            font-weight: 900;
            letter-spacing: .5px;
            text-transform: uppercase;
            white-space: nowrap;
        }

        td {
            padding: 13px 14px;
            border-bottom: 1px solid var(--border);
            color: #4e5a70;
            vertical-align: middle;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr:nth-child(even) {
            background: #fbfcfe;
        }

        .table-strong {
            color: var(--navy);
            font-weight: 800;
        }

        .amount {
            color: var(--navy);
            font-weight: 800;
            white-space: nowrap;
        }

        .empty-row {
            padding: 25px;
            text-align: center;
            color: var(--muted);
            font-size: 11px;
        }

        .status {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 20px;
            font-size: 9px;
            font-weight: 900;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .status-cash {
            background: #e6f6ed;
            color: #16865b;
        }

        .status-payment {
            background: #e9f1ff;
            color: #3973b8;
        }

        .status-credit {
            background: #fff7df;
            color: #a77a10;
        }

        .status-other {
            background: #eef0f4;
            color: #68748a;
        }

        .stock-low {
            color: #c17d18;
            font-weight: 900;
        }

        .stock-out {
            color: var(--red);
            font-weight: 900;
        }

        .report-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-top: 45px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
            color: var(--muted);
            font-size: 10px;
        }

        .footer-brand {
            color: var(--navy);
            font-weight: 900;
        }

        @media (max-width: 800px) {
            body {
                padding: 12px;
            }

            .report-container {
                padding: 22px;
            }

            .summary-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .report-header {
                flex-direction: column;
            }

            .report-information {
                text-align: left;
            }

            .table-wrapper {
                overflow-x: auto;
            }

            table {
                min-width: 650px;
            }
        }

        @media (max-width: 420px) {
            .summary-grid {
                grid-template-columns: 1fr;
            }

            .print-actions {
                flex-wrap: wrap;
            }

            .btn {
                flex: 1;
            }
        }

        @media print {
            body {
                padding: 0;
                background: white;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .print-actions {
                display: none !important;
            }

            .report-container {
                width: 100%;
                max-width: none;
                padding: 0;
                margin: 0;
                border-radius: 0;
                box-shadow: none;
            }

            .section {
                break-inside: avoid;
            }

            .summary-card,
            .highlight-card,
            .table-wrapper {
                break-inside: avoid;
            }

            thead {
                display: table-header-group;
            }

            tr {
                break-inside: avoid;
            }

            @page {
                size: A4;
                margin: 14mm;
            }
        }
    </style>
</head>

<body>

@php
    /*
    |--------------------------------------------------------------------------
    | REPORT DATA
    |--------------------------------------------------------------------------
    */

    $cashSales = (float) ($todayCash ?? 0);
    $creditSales = (float) ($todayCredit ?? 0);
    $totalSales = (float) ($todayGrandTotal ?? ($cashSales + $creditSales));
    $itemsSold = (float) ($todayItemsSold ?? 0);

    /*
    |--------------------------------------------------------------------------
    | UNPAID BALANCES
    |--------------------------------------------------------------------------
    */

    $unpaidBalances = collect($unpaid ?? [])
        ->filter(function ($debtor) {
            return (float) data_get($debtor, 'balance', 0) > 0;
        })
        ->values();

    $totalUnpaid = (float) ($totalUnpaid ?? $unpaidBalances->sum('balance'));

    /*
    |--------------------------------------------------------------------------
    | TRANSACTION HISTORY
    |--------------------------------------------------------------------------
    | Include cash sales, utang sales and payments.
    | Credit transactions are not added separately to avoid duplicates.
    */

    $history = collect($history ?? [])
        ->filter(function ($item) {

            $type = strtolower(trim((string) (
                data_get($item, 'type')
                ?? data_get($item, 'sale_type')
                ?? ''
            )));

            $label = strtolower(trim((string) data_get($item, 'label', '')));

            return in_array($type, ['cash', 'credit', 'payment'], true)
                || in_array($label, ['cash sale', 'utang sale', 'payment'], true);
        })
        ->sortByDesc(function ($item) {
            return data_get($item, 'date')
                ?? data_get($item, 'created_at');
        })
        ->values();

    $lowStockProducts = collect($lowStock ?? []);

    $storeName = $storeName ?? 'My Store';

    /*
    |--------------------------------------------------------------------------
    | FORMATTERS
    |--------------------------------------------------------------------------
    */

    $money = function ($amount) {
        return '₱' . number_format((float) ($amount ?? 0), 2);
    };

    $formatReportDate = function ($date) {

        if (empty($date)) {
            return 'N/A';
        }

        try {
            return \Carbon\Carbon::parse($date)->format('M d, Y h:i A');
        } catch (\Throwable $e) {
            return 'N/A';
        }
    };

    $formatPaymentMethod = function ($method) {

        if (empty($method)) {
            return 'N/A';
        }

        return ucwords(str_replace('_', ' ', (string) $method));
    };
@endphp

<div class="print-actions">

    <a href="{{ route('reports.index') }}" class="btn btn-back">
        ← Back to Reports
    </a>

    <button type="button" onclick="window.print()" class="btn btn-print">
        Print / Save PDF
    </button>

</div>

<main class="report-container">

    <!-- HEADER -->

    <header class="report-header">

        <div>

            <div class="brand">
                Track<span>&</span>Tally
            </div>

            <p class="brand-subtitle">
                Store Management and Financial Reporting System
            </p>

            <div class="store-name">
                {{ $storeName }}
            </div>

        </div>

        <div class="report-information">

            <strong>OFFICIAL STORE REPORT</strong><br>

            Generated Date:
            {{ now()->format('F d, Y') }}<br>

            Generated Time:
            {{ now()->format('h:i A') }}<br>

            Report Period:
            Daily Overview

        </div>

    </header>

    <!-- 01 SALES OVERVIEW -->

    <section class="section">

        <div class="section-heading">

            <div>

                <h2 class="section-title">
                    <span class="section-number">01</span>
                    Sales Overview
                </h2>

                <p class="section-description">
                    Summary of your store's sales performance for today.
                </p>

            </div>

        </div>

        <div class="summary-grid">

            <div class="summary-card">

                <div class="summary-label">
                    Cash Sales
                </div>

                <div class="summary-value gold-text">
                    {{ $money($cashSales) }}
                </div>

                <div class="summary-note">
                    Paid sales
                </div>

            </div>

            <div class="summary-card">

                <div class="summary-label">
                    Utang Sales
                </div>

                <div class="summary-value blue-text">
                    {{ $money($creditSales) }}
                </div>

                <div class="summary-note">
                    Credit sales
                </div>

            </div>

            <div class="summary-card">

                <div class="summary-label">
                    Total Sales
                </div>

                <div class="summary-value green-text">
                    {{ $money($totalSales) }}
                </div>

                <div class="summary-note">
                    Combined sales
                </div>

            </div>

            <div class="summary-card">

                <div class="summary-label">
                    Items Sold
                </div>

                <div class="summary-value">
                    {{ number_format($itemsSold) }}
                </div>

                <div class="summary-note">
                    Total quantity sold
                </div>

            </div>

        </div>

    </section>

    <!-- 02 UNPAID BALANCES -->

    <section class="section">

        <div class="section-heading">

            <div>

                <h2 class="section-title">
                    <span class="section-number">02</span>
                    Unpaid Balances
                </h2>

                <p class="section-description">
                    Debtors who still have outstanding balances.
                </p>

            </div>

        </div>

        <div class="highlight-card" style="margin-bottom:18px;">

            <div>

                <small>
                    Total Outstanding Balance
                </small>

                <h2>
                    {{ $money($totalUnpaid) }}
                </h2>

            </div>

            <div class="highlight-icon">
                ₱
            </div>

        </div>

        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>
                        <th>Debtor Name</th>
                        <th>Contact Number</th>
                        <th>Outstanding Balance</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($unpaidBalances as $debtor)

                        <tr>

                            <td class="table-strong">
                                {{ data_get($debtor, 'full_name', 'Unknown Debtor') }}
                            </td>

                            <td>
                                {{ data_get($debtor, 'contact_number') ?: 'N/A' }}
                            </td>

                            <td class="amount red-text">
                                {{ $money(data_get($debtor, 'balance', 0)) }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="3" class="empty-row">
                                No unpaid balances found.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </section>

    <!-- 03 TRANSACTION HISTORY -->

    <section class="section">

        <div class="section-heading">

            <div>

                <h2 class="section-title">
                    <span class="section-number">03</span>
                    Transaction History
                </h2>

                <p class="section-description">
                    Cash sales, utang sales, and debtor payments.
                </p>

            </div>

        </div>

        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>
                        <th>Date</th>
                        <th>Customer / Debtor</th>
                        <th>Transaction</th>
                        <th>Payment Method</th>
                        <th>Amount</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($history as $item)

                        @php

                            $historyDate = data_get($item, 'date')
                                ?? data_get($item, 'created_at');

                            $customerName = data_get($item, 'debtor_name')
                                ?: (
                                    data_get($item, 'customer_name')
                                    ?: 'Walk-in Customer'
                                );

                            $normalizedType = strtolower(trim((string) (
                                data_get($item, 'type')
                                ?? data_get($item, 'sale_type')
                                ?? ''
                            )));

                            $transactionType = data_get($item, 'label');

                            if (!$transactionType) {
                                $transactionType = match ($normalizedType) {
                                    'credit' => 'Utang Sale',
                                    'payment' => 'Payment',
                                    default => 'Cash Sale',
                                };
                            }

                            $paymentMethod = data_get($item, 'payment_method');

                            $historyAmount = data_get($item, 'amount')
                                ?? data_get($item, 'total_amount')
                                ?? 0;

                            $statusClass = match ($normalizedType) {
                                'cash', 'cash sale' => 'status-cash',
                                'credit', 'utang sale' => 'status-credit',
                                'payment' => 'status-payment',
                                default => 'status-other',
                            };

                        @endphp

                        <tr>

                            <td>
                                {{ $formatReportDate($historyDate) }}
                            </td>

                            <td class="table-strong">
                                {{ $customerName }}
                            </td>

                            <td>

                                <span class="status {{ $statusClass }}">
                                    {{ $transactionType }}
                                </span>

                            </td>

                            <td>
                                {{ $formatPaymentMethod($paymentMethod) }}
                            </td>

                            <td class="amount">
                                {{ $money($historyAmount) }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="empty-row">
                                No transaction history found.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </section>

    <!-- 04 LOW STOCK PRODUCTS -->

    <section class="section">

        <div class="section-heading">

            <div>

                <h2 class="section-title">
                    <span class="section-number">04</span>
                    Low Stock Products
                </h2>

                <p class="section-description">
                    Products that need restocking.
                </p>

            </div>

        </div>

        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Current Stock</th>
                        <th>Low Stock Threshold</th>
                        <th>Status</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($lowStockProducts as $product)

                        @php

                            $stock = (float) data_get(
                                $product,
                                'stock_quantity',
                                0
                            );

                            $threshold = (float) data_get(
                                $product,
                                'low_stock_threshold',
                                5
                            );

                            $unit = data_get($product, 'unit', '');

                            $stockStatus = $stock <= 0
                                ? 'Out of Stock'
                                : 'Low Stock';

                            $stockClass = $stock <= 0
                                ? 'stock-out'
                                : 'stock-low';

                        @endphp

                        <tr>

                            <td class="table-strong">
                                {{ data_get($product, 'name', 'Unnamed Product') }}
                            </td>

                            <td>
                                {{ data_get($product, 'category', 'General') }}
                            </td>

                            <td class="{{ $stockClass }}">
                                {{ number_format($stock, 2) }}
                                {{ $unit }}
                            </td>

                            <td>
                                {{ number_format($threshold, 2) }}
                                {{ $unit }}
                            </td>

                            <td>

                                <span class="status {{ $stock <= 0 ? 'status-other' : 'status-cash' }}">
                                    {{ $stockStatus }}
                                </span>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="empty-row">
                                No low-stock products found.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </section>

    <!-- FOOTER -->

    <footer class="report-footer">

        <div>

            <div class="footer-brand">
                Track<span>&</span>Tally
            </div>

            <div style="margin-top:5px;">
                Store Management System
            </div>

        </div>

        <div style="text-align:right;">

            Generated on {{ now()->format('F d, Y') }}<br>

            This report is system-generated.

        </div>

    </footer>

</main>

</body>
</html>
