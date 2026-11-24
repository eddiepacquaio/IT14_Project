
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Inventory | Track&Tally</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root {
            --navy: #192e50;
            --navy-light: #344a69;
            --gold: #d9a928;
            --gold-light: #fff4d5;
            --cream: #f8f7f2;
            --white: #ffffff;
            --text: #202b3c;
            --muted: #87909e;
            --border: #e9eaf0;
            --green: #16875d;
            --red: #d94b4b;
            --orange: #dc8b28;
            --shadow: 0 8px 25px rgba(23,36,59,.06);
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
            min-height: 100vh;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        button, input, select {
            font-family: inherit;
        }

        .app {
            min-height: 100vh;
        }

        /* =====================================
           SIDEBAR - ORIGINAL DESIGN PRESERVED
        ===================================== */

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 242px;
            height: 100vh;
            background: var(--navy);
            color: white;
            padding: 26px 13px;
            display: flex;
            flex-direction: column;
            z-index: 100;
            overflow-y: auto;
            border-left: 3px solid rgba(217,169,40,.12);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 13px 35px;
            min-height: 70px;
        }

        .brand img {
            width: 43px;
            height: 43px;
            object-fit: contain;
            border-radius: 12px;
            background: white;
            flex-shrink: 0;
        }

        .brand-icon {
            width: 43px;
            height: 43px;
            background: var(--gold);
            color: var(--navy);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 20px;
            flex-shrink: 0;
        }

        .brand-name {
            font-size: 18px;
            font-weight: 900;
            letter-spacing: -.7px;
            white-space: nowrap;
            color: white;
        }

        .brand-name span {
            color: var(--gold);
        }

        .menu-label {
            color: #8fa3bf;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.5px;
            padding: 0 15px;
            margin: 9px 0 12px;
        }

        .nav-menu {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 15px;
            min-height: 47px;
            padding: 12px 13px;
            border-radius: 11px;
            border-left: 2px solid transparent;
            color: #d0d9e8;
            font-size: 13px;
            font-weight: 600;
            transition: all .22s ease;
        }

        .nav-link i {
            width: 20px;
            text-align: center;
            font-size: 14px;
            color: #c5d1e3;
        }

        .nav-link:hover {
            color: white;
            background: rgba(255,255,255,.07);
        }

        .nav-link.active {
            background: #344a69;
            color: white;
            border-left: 2px solid #e0aa19;
            font-weight: 800;
        }

        .nav-link.active i {
            color: white;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding-top: 17px;
        }

        .sidebar-profile {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 27px 9px 15px;
            border-top: 1px solid rgba(255,255,255,.09);
            margin-bottom: 0;
        }

        .avatar {
            width: 37px;
            height: 37px;
            min-width: 37px;
            border-radius: 11px;
            background: #e0aa19;
            color: var(--navy);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            font-weight: 900;
        }

        .profile-info {
            min-width: 0;
        }

        .profile-info strong {
            display: block;
            font-size: 12px;
            color: white;
            font-weight: 800;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .profile-info small {
            display: block;
            color: #a9b9ce;
            font-size: 10px;
            margin-top: 3px;
        }

        .logout-button {
            width: 100%;
            min-height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 11px 14px;
            background: #2c4262;
            border: none;
            color: white;
            font-size: 12px;
            font-weight: 800;
            cursor: pointer;
            border-radius: 11px;
            transition: .2s;
        }

        .logout-button:hover {
            background: #3a5275;
            color: white;
        }

        /* =====================================
           MAIN CONTENT
        ===================================== */

        .main {
            margin-left: 242px;
            min-height: 100vh;
            padding: 32px 38px 50px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 32px;
        }

        .page-heading h1 {
            color: var(--navy);
            font-size: 29px;
            font-weight: 900;
            letter-spacing: -1.2px;
        }

        .page-heading p {
            color: var(--muted);
            font-size: 12px;
            margin-top: 8px;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .date-display {
            display: flex;
            align-items: center;
            gap: 9px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 11px;
            padding: 12px 15px;
            font-size: 11px;
            font-weight: 700;
            color: var(--navy);
            box-shadow: 0 3px 10px rgba(23,36,59,.03);
        }

        .date-display i {
            color: var(--gold);
        }

        /* =====================================
           BUTTONS
        ===================================== */

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 13px 19px;
            border: none;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 800;
            cursor: pointer;
            transition: .25s;
        }

        .btn-primary {
            background: var(--gold);
            color: var(--navy);
            box-shadow: 0 5px 15px rgba(217,169,40,.22);
        }

        .btn-primary:hover {
            background: #e8b83c;
            color: var(--navy);
            transform: translateY(-3px);
            box-shadow: 0 9px 20px rgba(217,169,40,.3);
        }

        .btn-dark {
            background: var(--navy);
            color: white;
        }

        .btn-dark:hover {
            background: var(--navy-light);
            color: white;
            transform: translateY(-2px);
        }

        .btn-light {
            background: white;
            border: 1px solid var(--border);
            color: var(--navy);
        }

        .btn-light:hover {
            background: #f1f2f5;
        }

        /* =====================================
           ALERTS
        ===================================== */

        .alert {
            padding: 14px 17px;
            border-radius: 11px;
            margin-bottom: 22px;
            font-size: 12px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            color: #126b49;
            background: #e7f7ef;
            border: 1px solid #c8ebd9;
        }

        .alert-error {
            color: #a92e2e;
            background: #fff0f0;
            border: 1px solid #f2cece;
        }

        /* =====================================
           INVENTORY INTRO BANNER
        ===================================== */

        .inventory-intro {
            position: relative;
            overflow: hidden;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            padding: 25px 28px;
            margin-bottom: 25px;
            border-radius: 16px;
            background: linear-gradient(115deg,#192e50,#304b70);
            color: white;
            box-shadow: 0 10px 25px rgba(25,46,80,.12);
        }

        .inventory-intro::before {
            content: "";
            position: absolute;
            width: 230px;
            height: 230px;
            border: 35px solid rgba(255,255,255,.045);
            border-radius: 50%;
            right: 100px;
            top: -125px;
        }

        .inventory-intro::after {
            content: "";
            position: absolute;
            width: 150px;
            height: 150px;
            background: rgba(217,169,40,.10);
            border-radius: 50%;
            right: -45px;
            bottom: -95px;
        }

        .intro-content {
            position: relative;
            z-index: 2;
        }

        .intro-label {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: rgba(255,255,255,.11);
            color: #f7d77c;
            padding: 7px 11px;
            border-radius: 20px;
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 1px;
            margin-bottom: 12px;
        }

        .intro-content h2 {
            font-size: 21px;
            font-weight: 900;
            letter-spacing: -.5px;
            margin-bottom: 7px;
        }

        .intro-content p {
            font-size: 11px;
            color: #c8d4e4;
            line-height: 1.7;
        }

        .intro-decoration {
            position: relative;
            z-index: 2;
            width: 85px;
            height: 85px;
            border-radius: 23px;
            background: rgba(217,169,40,.17);
            border: 1px solid rgba(217,169,40,.35);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold);
            font-size: 37px;
            transform: rotate(5deg);
        }

        /* =====================================
           SUMMARY CARDS
        ===================================== */

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3,minmax(0,1fr));
            gap: 19px;
            margin-bottom: 28px;
        }

        .stat-card {
            position: relative;
            overflow: hidden;
            background: white;
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 23px;
            box-shadow: var(--shadow);
            transition: .3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(23,36,59,.10);
            border-color: #e4d5aa;
        }

        .stat-card::after {
            content: "";
            position: absolute;
            right: -35px;
            bottom: -50px;
            width: 125px;
            height: 125px;
            background: var(--gold-light);
            border-radius: 50%;
            opacity: .75;
            pointer-events: none;
        }

        .stat-card.red-card::after {
            background: #fff0f0;
        }

        .stat-card.green-card::after {
            background: #e9f7f0;
        }

        .stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            z-index: 1;
        }

        .stat-label {
            color: var(--muted);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .7px;
        }

        .stat-icon {
            width: 43px;
            height: 43px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--gold-light);
            color: #b98712;
            font-size: 17px;
            transition: .3s;
        }

        .stat-card:hover .stat-icon {
            transform: rotate(-8deg) scale(1.08);
        }

        .red-card .stat-icon {
            background: #fff0f0;
            color: var(--red);
        }

        .green-card .stat-icon {
            background: #e9f7f0;
            color: var(--green);
        }

        .stat-value {
            margin-top: 18px;
            color: var(--navy);
            font-size: 29px;
            font-weight: 900;
            letter-spacing: -1px;
            position: relative;
            z-index: 1;
        }

        .stat-note {
            color: var(--muted);
            font-size: 10px;
            margin-top: 7px;
            position: relative;
            z-index: 1;
        }

        .stat-bottom {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-top: 15px;
            font-size: 9px;
            color: var(--green);
            font-weight: 800;
            position: relative;
            z-index: 1;
        }

        /* LOW / OUT STOCK BUTTONS */

        .stock-summary-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 14px;
            position: relative;
            z-index: 2;
        }

        .stock-summary-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 8px 11px;
            border-radius: 8px;
            font-size: 9px;
            font-weight: 800;
            transition: .2s;
            border: 1px solid transparent;
        }

        .stock-summary-btn.low {
            color: #a96312;
            background: #fff4e5;
            border-color: #f5dfbd;
        }

        .stock-summary-btn.low:hover {
            background: #ffe9c9;
            transform: translateY(-2px);
        }

        .stock-summary-btn.out {
            color: #c13c3c;
            background: #fff0f0;
            border-color: #f2cece;
        }

        .stock-summary-btn.out:hover {
            background: #ffe1e1;
            transform: translateY(-2px);
        }

        /* =====================================
           INVENTORY PANEL
        ===================================== */

        .inventory-panel {
            background: white;
            border: 1px solid var(--border);
            border-radius: 17px;
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .panel-header {
            padding: 25px 26px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 18px;
            border-bottom: 1px solid var(--border);
        }

        .panel-title h2 {
            color: var(--navy);
            font-size: 17px;
            font-weight: 900;
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .panel-title h2 i {
            color: var(--gold);
        }

        .panel-title p {
            color: var(--muted);
            font-size: 10px;
            margin-top: 7px;
        }

        .panel-tools {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .search-box {
            position: relative;
        }

        .search-box i {
            position: absolute;
            top: 50%;
            left: 14px;
            transform: translateY(-50%);
            color: #9aa3b1;
            font-size: 12px;
            pointer-events: none;
        }

        .search-box input {
            width: 245px;
            height: 42px;
            border: 1px solid var(--border);
            border-radius: 9px;
            outline: none;
            padding: 0 13px 0 38px;
            font-size: 11px;
            color: var(--text);
            transition: .2s;
            background: #fcfcfd;
        }

        .search-box input:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(217,169,40,.1);
            background: white;
        }

        /* =====================================
           STOCK FILTER BUTTONS
        ===================================== */

        .stock-filter-group {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 7px;
            padding: 16px 25px;
            background: #fcfcfd;
            border-bottom: 1px solid var(--border);
        }

        .filter-label {
            font-size: 9px;
            font-weight: 900;
            color: #929baa;
            letter-spacing: .8px;
            margin-right: 5px;
        }

        .stock-filter-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            min-height: 34px;
            padding: 8px 13px;
            border: 1px solid #e7e9ef;
            border-radius: 8px;
            background: white;
            color: #697487;
            font-size: 10px;
            font-weight: 800;
            cursor: pointer;
            transition: .22s ease;
        }

        .stock-filter-btn:hover {
            border-color: var(--gold);
            color: var(--navy);
            transform: translateY(-1px);
        }

        .stock-filter-btn.active {
            background: var(--navy);
            border-color: var(--navy);
            color: white;
            box-shadow: 0 4px 10px rgba(25,46,80,.16);
        }

        .stock-filter-btn .filter-count {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 18px;
            height: 18px;
            padding: 0 5px;
            border-radius: 20px;
            background: rgba(0,0,0,.06);
            font-size: 8px;
        }

        .stock-filter-btn.active .filter-count {
            background: rgba(255,255,255,.18);
            color: white;
        }

        /* =====================================
           INVENTORY TABLE
        ===================================== */

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        .inventory-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 900px;
        }

        .inventory-table thead {
            background: #fafbfc;
        }

        .inventory-table th {
            padding: 16px 19px;
            text-align: left;
            color: #929baa;
            font-size: 9px;
            font-weight: 800;
            letter-spacing: .7px;
            text-transform: uppercase;
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
        }

        .inventory-table td {
            padding: 18px 19px;
            border-bottom: 1px solid #f0f1f4;
            font-size: 11px;
            vertical-align: middle;
        }

        .inventory-table tbody tr {
            transition: .2s;
        }

        .inventory-table tbody tr:hover {
            background: #fffdf7;
        }

        .product-cell {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 185px;
        }

        .product-icon {
            width: 41px;
            height: 41px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 11px;
            background: #fff5dc;
            color: #bd8b17;
            font-size: 16px;
        }

        .product-name {
            font-size: 11px;
            color: var(--navy);
            font-weight: 800;
        }

        .product-category {
            display: block;
            margin-top: 5px;
            color: var(--muted);
            font-size: 9px;
        }

        .category-badge {
            display: inline-block;
            background: #f1f3f7;
            color: #647084;
            padding: 7px 10px;
            border-radius: 7px;
            font-size: 9px;
            font-weight: 700;
        }

        .price {
            color: var(--navy);
            font-weight: 800;
            white-space: nowrap;
        }

        .stock-number {
            color: var(--navy);
            font-weight: 900;
        }

        .stock-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 10px;
            border-radius: 20px;
            font-size: 9px;
            font-weight: 800;
            white-space: nowrap;
        }

        .stock-status.in-stock {
            color: var(--green);
            background: #e9f7f0;
        }

        .stock-status.low-stock {
            color: var(--orange);
            background: #fff4e5;
        }

        .stock-status.out-stock {
            color: var(--red);
            background: #fff0f0;
        }

        .stock-status i {
            font-size: 6px;
        }

        /* =====================================
           ACTION BUTTONS
        ===================================== */

        .actions {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .action-btn {
            width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 9px;
            border: 1px solid var(--border);
            background: white;
            color: var(--navy);
            cursor: pointer;
            font-size: 11px;
            transition: .22s;
        }

        .action-btn.edit:hover {
            background: var(--gold-light);
            border-color: var(--gold);
            color: #9b710e;
            transform: translateY(-2px);
        }

        .action-btn.delete:hover {
            background: #fff0f0;
            border-color: #f3c5c5;
            color: var(--red);
            transform: translateY(-2px);
        }

        /* =====================================
           EMPTY STATE
        ===================================== */

        .empty-state {
            padding: 65px 20px;
            text-align: center;
        }

        .empty-icon {
            width: 70px;
            height: 70px;
            border-radius: 20px;
            background: var(--gold-light);
            color: #bd8b17;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 18px;
            font-size: 26px;
        }

        .empty-state h3 {
            color: var(--navy);
            font-size: 16px;
            font-weight: 900;
        }

        .empty-state p {
            color: var(--muted);
            font-size: 11px;
            margin: 9px 0 20px;
            line-height: 1.7;
        }

        .panel-footer {
            padding: 16px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: var(--muted);
            font-size: 10px;
            gap: 10px;
            background: #fcfcfd;
        }

        .panel-footer i {
            color: var(--gold);
            margin-right: 5px;
        }

        /* =====================================
           MOBILE MENU
        ===================================== */

        .mobile-menu-button {
            display: none;
            width: 39px;
            height: 39px;
            border: 1px solid var(--border);
            border-radius: 9px;
            background: white;
            color: var(--navy);
            cursor: pointer;
            font-size: 16px;
        }

        .sidebar-overlay {
            display: none;
        }

        /* =====================================
           RESPONSIVE
        ===================================== */

        @media (max-width: 1100px) {
            .main {
                padding: 25px;
            }

            .stats-grid {
                gap: 12px;
            }

            .panel-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .panel-tools {
                width: 100%;
            }

            .search-box {
                flex: 1;
            }

            .search-box input {
                width: 100%;
            }
        }

        @media (max-width: 760px) {
            .sidebar {
                transform: translateX(-100%);
                transition: .3s;
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .sidebar-overlay.show {
                display: block;
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,.45);
                z-index: 90;
            }

            .main {
                margin-left: 0;
                padding: 20px 15px 35px;
            }

            .mobile-menu-button {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .topbar {
                align-items: flex-start;
                gap: 12px;
            }

            .page-heading h1 {
                font-size: 22px;
            }

            .page-heading p {
                font-size: 10px;
            }

            .date-display {
                display: none;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .stat-card {
                padding: 19px;
            }

            .stat-value {
                font-size: 25px;
            }

            .inventory-intro {
                padding: 22px;
            }

            .intro-content h2 {
                font-size: 18px;
            }

            .intro-decoration {
                width: 60px;
                height: 60px;
                font-size: 25px;
            }

            .panel-header {
                padding: 19px;
            }

            .panel-tools {
                flex-wrap: wrap;
            }

            .search-box {
                flex-basis: 100%;
            }

            .stock-filter-group {
                padding: 15px;
            }

            .stock-filter-btn {
                font-size: 9px;
                padding: 8px 10px;
            }

            .panel-footer {
                align-items: flex-start;
                flex-direction: column;
            }
        }

        @media (max-width: 420px) {
            .topbar-right .btn {
                padding: 10px 11px;
                font-size: 10px;
            }

            .page-heading h1 {
                font-size: 19px;
            }

            .panel-title h2 {
                font-size: 14px;
            }

            .intro-decoration {
                display: none;
            }
        }
    </style>
</head>

<body>

@php
    $products = $products ?? collect();
    $search = $search ?? request('search', '');

    $totalProducts = $products->count();

    $totalStock = $products->sum(function ($product) {
        return (float) ($product->stock_quantity ?? 0);
    });

    $lowStockCount = $products->filter(function ($product) {
        $stock = (float) ($product->stock_quantity ?? 0);
        $threshold = (float) ($product->low_stock_threshold ?? 0);

        return $stock > 0 && $stock <= $threshold;
    })->count();

    $outOfStockCount = $products->filter(function ($product) {
        return (float) ($product->stock_quantity ?? 0) <= 0;
    })->count();

    $inStockCount = $products->filter(function ($product) {
        $stock = (float) ($product->stock_quantity ?? 0);
        $threshold = (float) ($product->low_stock_threshold ?? 0);

        return $stock > 0 && $stock > $threshold;
    })->count();

    $storeName = session('store_name', 'My Store');
    $userName = auth()->user()->name ?? session('user_name', 'Store Owner');
@endphp

<div class="app">

    <!-- SIDEBAR OVERLAY -->
    <div class="sidebar-overlay"
         id="sidebarOverlay"
         onclick="toggleSidebar()"></div>

    <!-- SIDEBAR - MAIN MENU UNCHANGED -->
    <aside class="sidebar" id="sidebar">

        <div class="brand">

            <img
                src="{{ asset('icon.png') }}"
                alt="Track&Tally Logo"
                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
            >

            <div class="brand-icon" style="display:none;">
                <i class="fas fa-store"></i>
            </div>

            <div class="brand-name">
                Track<span>&Tally</span>
            </div>

        </div>

        <div class="menu-label">MAIN MENU</div>

        <nav class="nav-menu">

            <a href="{{ route('dashboard') }}"
               class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-house"></i>
                <span>Home</span>
            </a>

            <a href="{{ route('debtors.index') }}"
               class="nav-link {{ request()->routeIs('debtors.*') ? 'active' : '' }}">
                <i class="fas fa-chess-pawn"></i>
                <span>Debtors</span>
            </a>

            <a href="{{ route('sell.index') }}"
               class="nav-link {{ request()->routeIs('sell.*') ? 'active' : '' }}">
                <i class="fas fa-cart-shopping"></i>
                <span>Sell</span>
            </a>

            <a href="{{ route('inventory.index') }}"
               class="nav-link {{ request()->routeIs('inventory.*') ? 'active' : '' }}">
                <i class="fas fa-table-cells"></i>
                <span>Inventory</span>
            </a>

            <a href="{{ route('reports.index') }}"
               class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                <i class="fas fa-bars-progress"></i>
                <span>Reports</span>
            </a>

        </nav>

        <div class="sidebar-bottom">

            <div class="sidebar-profile">

                <div class="avatar">
                    {{ strtoupper(substr($userName, 0, 1)) }}
                </div>

                <div class="profile-info">
                    <strong>{{ $userName }}</strong>
                    <small>{{ $storeName }}</small>
                </div>

            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit" class="logout-button">
                    <i class="fas fa-right-from-bracket"></i>
                    <span>Log Out</span>
                </button>
            </form>

        </div>

    </aside>

    <!-- MAIN CONTENT -->
    <main class="main">

        <!-- TOPBAR -->
            <header class="topbar">

 
            <div class="topbar-right">

                <div class="date-display">
                    <i class="far fa-calendar"></i>
                    {{ now()->format('F d, Y') }}
                </div>

                <!-- SCAN SUPPLIER RECEIPT BUTTON -->
                <a href="{{ route('receipt.index') }}" class="btn btn-dark">
                    <i class="fas fa-receipt"></i>
                    Scan Receipt
                </a>

                <!-- ADD PRODUCT BUTTON -->
                <a href="{{ route('inventory.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Add Product
                </a>

            </div>


        </header>

        <!-- SUCCESS MESSAGE -->
        @if(session('success'))
            <div class="alert alert-success" id="successAlert">
                <i class="fas fa-circle-check"></i>
                {{ session('success') }}
            </div>
        @endif

        <!-- INFO MESSAGE -->
        @if(session('info'))
            <div class="alert alert-success">
                <i class="fas fa-circle-info"></i>
                {{ session('info') }}
            </div>
        @endif

        <!-- ERROR MESSAGE -->
        @if(session('error'))
            <div class="alert alert-error">
                <i class="fas fa-circle-exclamation"></i>
                {{ session('error') }}
            </div>
        @endif

        <!-- VALIDATION ERRORS -->
        @if($errors->any())
            <div class="alert alert-error">
                <i class="fas fa-circle-exclamation"></i>
                <div>
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- INVENTORY INTRO -->
        <section class="inventory-intro">

            <div class="intro-content">

                <div class="intro-label">
                    <i class="fas fa-chart-line"></i>
                    INVENTORY OVERVIEW
                </div>

                <h2>Manage Your Store Inventory</h2>

                <p>
                    Keep track of your products, monitor stock availability,
                    and maintain accurate product information.
                </p>

            </div>

            <div class="intro-decoration">
                <i class="fas fa-boxes-stacked"></i>
            </div>

        </section>

        <!-- SUMMARY CARDS -->
        <section class="stats-grid">

            <!-- TOTAL PRODUCTS -->
            <div class="stat-card">

                <div class="stat-top">
                    <span class="stat-label">TOTAL PRODUCTS</span>

                    <div class="stat-icon">
                        <i class="fas fa-box"></i>
                    </div>
                </div>

                <div class="stat-value">
                    {{ number_format($totalProducts) }}
                </div>

                <div class="stat-note">
                    Products registered in your inventory
                </div>

                <div class="stat-bottom">
                    <i class="fas fa-check-circle"></i>
                    Product inventory overview
                </div>

            </div>

            <!-- TOTAL STOCK -->
            <div class="stat-card green-card">

                <div class="stat-top">
                    <span class="stat-label">TOTAL STOCK UNITS</span>

                    <div class="stat-icon">
                        <i class="fas fa-cubes"></i>
                    </div>
                </div>

                <div class="stat-value">
                    {{ number_format($totalStock, 2) }}
                </div>

                <div class="stat-note">
                    Combined quantity of all products
                </div>

                <div class="stat-bottom">
                    <i class="fas fa-boxes-stacked"></i>
                    Available inventory quantity
                </div>

            </div>

            <!-- LOW / OUT OF STOCK -->
            <div class="stat-card red-card">

                <div class="stat-top">
                    <span class="stat-label">LOW / OUT OF STOCK</span>

                    <div class="stat-icon">
                        <i class="fas fa-triangle-exclamation"></i>
                    </div>
                </div>

                <div class="stat-value">
                    {{ number_format($lowStockCount + $outOfStockCount) }}
                </div>

                <div class="stat-note">
                    Products that need inventory attention
                </div>

                <div class="stock-summary-actions">

                    <button type="button"
                            class="stock-summary-btn low"
                            onclick="setStockFilter('low')">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $lowStockCount }} Low Stock
                    </button>

                    <button type="button"
                            class="stock-summary-btn out"
                            onclick="setStockFilter('out')">
                        <i class="fas fa-circle-xmark"></i>
                        {{ $outOfStockCount }} Out of Stock
                    </button>

                </div>

            </div>

        </section>

        <!-- INVENTORY TABLE -->
        <section class="inventory-panel">

            <div class="panel-header">

                <div class="panel-title">

                    <h2>
                        <i class="fas fa-boxes-stacked"></i>
                        Product Inventory
                    </h2>

                    <p>
                        View and manage all products registered in your store.
                    </p>

                </div>

                <div class="panel-tools">

                    <form action="{{ route('inventory.index') }}"
                          method="GET"
                          class="search-box">

                        <i class="fas fa-search"></i>

                        <input
                            type="text"
                            name="search"
                            id="searchInput"
                            value="{{ $search }}"
                            placeholder="Search product or category..."
                        >

                    </form>

                </div>

            </div>

            <!-- STOCK FILTER BUTTONS -->
            <div class="stock-filter-group">

                <span class="filter-label">FILTER STOCK:</span>

                <button type="button"
                        class="stock-filter-btn active"
                        data-filter="all"
                        onclick="setStockFilter('all')">

                    <i class="fas fa-layer-group"></i>
                    All Stock

                    <span class="filter-count">
                        {{ $totalProducts }}
                    </span>

                </button>

                <button type="button"
                        class="stock-filter-btn"
                        data-filter="in"
                        onclick="setStockFilter('in')">

                    <i class="fas fa-circle-check"></i>
                    In Stock

                    <span class="filter-count">
                        {{ $inStockCount }}
                    </span>

                </button>

                <button type="button"
                        class="stock-filter-btn"
                        data-filter="low"
                        onclick="setStockFilter('low')">

                    <i class="fas fa-triangle-exclamation"></i>
                    Low Stock

                    <span class="filter-count">
                        {{ $lowStockCount }}
                    </span>

                </button>

                <button type="button"
                        class="stock-filter-btn"
                        data-filter="out"
                        onclick="setStockFilter('out')">

                    <i class="fas fa-circle-xmark"></i>
                    Out of Stock

                    <span class="filter-count">
                        {{ $outOfStockCount }}
                    </span>

                </button>

            </div>

            <!-- TABLE -->
            <div class="table-wrapper">

                <table class="inventory-table">

                    <thead>
                        <tr>
                            <th>PRODUCT</th>
                            <th>CATEGORY</th>
                            <th>UNIT</th>
                            <th>SELLING PRICE</th>
                            <th>PACKAGE PRICE</th>
                            <th>STOCK</th>
                            <th>STATUS</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>

                    <tbody id="inventoryTableBody">

                        @forelse($products as $product)

                            @php
                                $stock = (float) ($product->stock_quantity ?? 0);
                                $threshold = (float) ($product->low_stock_threshold ?? 0);

                                if ($stock <= 0) {
                                    $status = 'out';
                                    $statusText = 'Out of Stock';
                                    $statusClass = 'out-stock';
                                } elseif ($stock <= $threshold) {
                                    $status = 'low';
                                    $statusText = 'Low Stock';
                                    $statusClass = 'low-stock';
                                } else {
                                    $status = 'in';
                                    $statusText = 'In Stock';
                                    $statusClass = 'in-stock';
                                }
                            @endphp

                            <tr class="product-row"
                                data-status="{{ $status }}">

                                <!-- PRODUCT -->
                                <td>
                                    <div class="product-cell">

                                        <div class="product-icon">
                                            <i class="fas fa-box"></i>
                                        </div>

                                        <div>
                                            <div class="product-name">
                                                {{ $product->name }}
                                            </div>

                                            <span class="product-category">
                                                Product ID: #{{ $product->id }}
                                            </span>
                                        </div>

                                    </div>
                                </td>

                                <!-- CATEGORY -->
                                <td>
                                    <span class="category-badge">
                                        {{ $product->category ?: 'Uncategorized' }}
                                    </span>
                                </td>

                                <!-- UNIT -->
                                <td>
                                    {{ $product->unit ?: 'Piece' }}

                                    @if(!empty($product->measurement_value))
                                        <span style="color:var(--muted);">
                                            ({{ $product->measurement_value }})
                                        </span>
                                    @endif
                                </td>

                                <!-- SELLING PRICE -->
                                <td class="price">
                                    ₱{{ number_format((float)($product->item_price ?? 0), 2) }}
                                </td>

                                <!-- PACKAGE PRICE -->
                                <td class="price">
                                    ₱{{ number_format((float)($product->unit_price ?? 0), 2) }}
                                </td>

                                <!-- STOCK -->
                                <td>
                                    <span class="stock-number">
                                        {{ number_format($stock, 2) }}
                                    </span>
                                </td>

                                <!-- STATUS -->
                                <td>
                                    <span class="stock-status {{ $statusClass }}">
                                        <i class="fas fa-circle"></i>
                                        {{ $statusText }}
                                    </span>
                                </td>

                                <!-- ACTIONS -->
                                <td>
                                    <div class="actions">

                                        <a href="{{ route('inventory.edit', $product->id) }}"
                                           class="action-btn edit"
                                           title="Edit Product"
                                           aria-label="Edit Product">

                                            <i class="fas fa-pen"></i>

                                        </a>

                                        <form
                                            action="{{ route('inventory.destroy', $product->id) }}"
                                            method="POST"
                                            onsubmit="return confirmDelete(this);">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="action-btn delete"
                                                    title="Delete Product"
                                                    aria-label="Delete Product">

                                                <i class="fas fa-trash"></i>

                                            </button>

                                        </form>

                                    </div>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="8">

                                    <div class="empty-state">

                                        <div class="empty-icon">
                                            <i class="fas fa-box-open"></i>
                                        </div>

                                        <h3>No Products Found</h3>

                                        <p>
                                            Your inventory is currently empty.
                                            Add your first product to get started.
                                        </p>

                                        <a href="{{ route('inventory.create') }}"
                                           class="btn btn-primary">

                                            <i class="fas fa-plus"></i>
                                            Add Your First Product

                                        </a>

                                    </div>

                                </td>
                            </tr>

                        @endforelse

                        <!-- FILTER EMPTY STATE -->
                        <tr id="noFilterResults" style="display:none;">

                            <td colspan="8">

                                <div class="empty-state">

                                    <div class="empty-icon">
                                        <i class="fas fa-filter"></i>
                                    </div>

                                    <h3>No Matching Products</h3>

                                    <p>
                                        There are no products matching your selected stock filter.
                                    </p>

                                    <button type="button"
                                            class="btn btn-dark"
                                            onclick="setStockFilter('all')">

                                        <i class="fas fa-rotate-left"></i>
                                        Show All Products

                                    </button>

                                </div>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

            <!-- PANEL FOOTER -->
            <div class="panel-footer">

                <span id="productCount">
                    Showing {{ $products->count() }} product(s)
                </span>

                <span>
                    <i class="fas fa-shield-halved"></i>
                    Track&Tally Inventory Management
                </span>

            </div>

        </section>

    </main>

</div>

<script>

    /* =====================================
       MOBILE SIDEBAR
    ===================================== */

    function toggleSidebar() {

        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');

        sidebar.classList.toggle('open');
        overlay.classList.toggle('show');

    }


    /* =====================================
       DELETE CONFIRMATION
    ===================================== */

    function confirmDelete(form) {

        return confirm(
            'Are you sure you want to delete this product from your inventory?'
        );

    }


    /* =====================================
       STOCK FILTER BUTTONS
    ===================================== */

    const stockFilterButtons = document.querySelectorAll('.stock-filter-btn');

    const productRows = document.querySelectorAll('.product-row');

    const noFilterResults = document.getElementById('noFilterResults');

    const productCount = document.getElementById('productCount');


    function setStockFilter(selected) {

        let visibleCount = 0;

        productRows.forEach(function(row) {

            const status = row.dataset.status;

            const show = selected === 'all' || selected === status;

            row.style.display = show ? '' : 'none';

            if (show) {
                visibleCount++;
            }

        });


        stockFilterButtons.forEach(function(button) {

            button.classList.toggle(
                'active',
                button.dataset.filter === selected
            );

        });


        if (noFilterResults) {

            noFilterResults.style.display =
                visibleCount === 0 && productRows.length > 0
                    ? ''
                    : 'none';

        }


        if (productCount) {

            productCount.textContent =
                'Showing ' + visibleCount + ' product(s)';

        }

    }


    /* =====================================
       SEARCH INPUT
    ===================================== */

    const searchInput = document.getElementById('searchInput');

    if (searchInput) {

        searchInput.addEventListener('keydown', function(event) {

            if (event.key === 'Enter') {
                this.form.submit();
            }

        });

    }


    /* =====================================
       AUTO-HIDE SUCCESS MESSAGE
    ===================================== */

    setTimeout(function() {

        const alert = document.getElementById('successAlert');

        if (alert) {

            alert.style.transition = 'opacity .5s';
            alert.style.opacity = '0';

            setTimeout(function() {
                alert.remove();
            }, 500);

        }

    }, 4000);


</script>

</body>
</html>
