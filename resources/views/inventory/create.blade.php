
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>New Product | Track&Tally</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --navy: #172B4D;
            --navy-light: #243F69;
            --navy-dark: #101F38;
            --gold: #D9A928;
            --gold-light: #F6E7B7;
            --cream: #F7F5EF;
            --white: #FFFFFF;
            --text: #263449;
            --muted: #8791A2;
            --border: #E7E5DE;
            --success: #23845B;
            --danger: #D9534F;
            --shadow: 0 12px 35px rgba(23,43,77,.07);
            --shadow-hover: 0 18px 45px rgba(23,43,77,.13);
            --radius: 20px;
            --transition: .25s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            min-height: 100vh;
            background:
                radial-gradient(circle at 5% 5%, rgba(217,169,40,.07), transparent 25%),
                radial-gradient(circle at 95% 30%, rgba(36,63,105,.05), transparent 25%),
                var(--cream);
            color: var(--text);
            font-family: 'Inter', sans-serif;
        }

        body, button, input, select {
            font-family: 'Inter', sans-serif;
        }

        button, a, input, select {
            -webkit-tap-highlight-color: transparent;
        }

        button {
            border: none;
        }

        a {
            color: inherit;
        }

        .page-wrapper {
            width: 100%;
            max-width: 1150px;
            margin: auto;
            padding: 28px 32px 70px;
        }

        /* ================================
           HEADER
        ================================= */

        .top-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            min-height: 78px;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .back-button {
            position: relative;
            width: 47px;
            height: 47px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--navy);
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 15px;
            text-decoration: none;
            transition: var(--transition);
            box-shadow: 0 4px 12px rgba(23,43,77,.04);
        }

        .back-button:hover {
            color: var(--white);
            background: var(--navy);
            border-color: var(--navy);
            transform: translateX(-4px);
            box-shadow: 0 8px 18px rgba(23,43,77,.18);
        }

        .back-button:active {
            transform: scale(.94);
        }

        .header-title {
            color: var(--navy);
            font-size: 22px;
            font-weight: 900;
            letter-spacing: -.7px;
        }

        .header-subtitle {
            margin-top: 5px;
            color: var(--muted);
            font-size: 12px;
            font-weight: 600;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .header-status {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            color: var(--success);
            background: #EAF7F0;
            border: 1px solid #CDEBDD;
            border-radius: 30px;
            font-size: 10px;
            font-weight: 800;
        }

        .header-status i {
            font-size: 11px;
        }

        .header-icon {
            width: 47px;
            height: 47px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--navy);
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 15px;
            font-size: 19px;
            box-shadow: 0 4px 12px rgba(23,43,77,.04);
        }

        /* ================================
           BREADCRUMB
        ================================= */

        .breadcrumb {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 9px;
            margin-bottom: 24px;
            color: var(--muted);
            font-size: 11px;
            font-weight: 600;
        }

        .breadcrumb a {
            color: var(--navy);
            text-decoration: none;
            transition: var(--transition);
        }

        .breadcrumb a:hover {
            color: var(--gold);
        }

        .breadcrumb i {
            font-size: 9px;
            color: #B5BBC5;
        }

        .breadcrumb .current {
            color: var(--gold);
            font-weight: 800;
        }

        /* ================================
           INTRO CARD
        ================================= */

        .intro-card {
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            gap: 22px;
            min-height: 160px;
            padding: 30px;
            margin-bottom: 32px;
            color: var(--white);
            background: linear-gradient(125deg, var(--navy-dark), var(--navy), #31537F);
            border-radius: 23px;
            box-shadow: 0 16px 38px rgba(23,43,77,.17);
        }

        .intro-card::before {
            content: "";
            position: absolute;
            width: 270px;
            height: 270px;
            right: -70px;
            top: -135px;
            border: 40px solid rgba(255,255,255,.045);
            border-radius: 50%;
        }

        .intro-card::after {
            content: "";
            position: absolute;
            width: 160px;
            height: 160px;
            right: 145px;
            bottom: -115px;
            background: rgba(217,169,40,.13);
            border-radius: 50%;
        }

        .intro-decoration {
            position: absolute;
            width: 100px;
            height: 100px;
            right: 12%;
            top: 15px;
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 25px;
            transform: rotate(35deg);
        }

        .intro-icon {
            position: relative;
            z-index: 1;
            flex-shrink: 0;
            width: 66px;
            height: 66px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold);
            background: rgba(255,255,255,.12);
            border: 1px solid rgba(255,255,255,.12);
            border-radius: 19px;
            font-size: 27px;
            box-shadow: inset 0 1px 0 rgba(255,255,255,.12);
        }

        .intro-content {
            position: relative;
            z-index: 1;
            flex: 1;
        }

        .intro-title {
            margin-bottom: 8px;
            font-size: 20px;
            font-weight: 900;
            letter-spacing: -.4px;
        }

        .intro-text {
            max-width: 590px;
            color: rgba(255,255,255,.73);
            font-size: 12px;
            line-height: 1.8;
        }

        .intro-badge {
            position: relative;
            z-index: 1;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 11px 16px;
            margin-left: auto;
            color: #F7D77D;
            background: rgba(217,169,40,.15);
            border: 1px solid rgba(217,169,40,.35);
            border-radius: 30px;
            font-size: 10px;
            font-weight: 900;
            white-space: nowrap;
        }

        /* ================================
           PROGRESS
        ================================= */

        .progress-card {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 17px 20px;
            margin-bottom: 30px;
            background: rgba(255,255,255,.8);
            border: 1px solid var(--border);
            border-radius: 15px;
        }

        .progress-number {
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--navy);
            background: var(--gold-light);
            border-radius: 11px;
            font-size: 13px;
            font-weight: 900;
        }

        .progress-content {
            flex: 1;
        }

        .progress-title {
            color: var(--navy);
            font-size: 11px;
            font-weight: 900;
        }

        .progress-subtitle {
            margin-top: 4px;
            color: var(--muted);
            font-size: 10px;
        }

        .progress-track {
            width: 130px;
            height: 7px;
            overflow: hidden;
            background: #ECEAE3;
            border-radius: 20px;
        }

        .progress-fill {
            width: 0%;
            height: 100%;
            background: linear-gradient(90deg, var(--gold), #F0CD72);
            border-radius: inherit;
            transition: width .3s ease;
        }

        .progress-percent {
            min-width: 35px;
            color: var(--navy);
            font-size: 11px;
            font-weight: 900;
            text-align: right;
        }

        /* ================================
           ALERTS
        ================================= */

        .alert {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 16px 18px;
            margin-bottom: 20px;
            border-radius: 13px;
            font-size: 12px;
            line-height: 1.6;
            font-weight: 600;
            animation: slideDown .35s ease;
        }

        .alert i {
            margin-top: 2px;
        }

        .alert-success {
            color: #176A47;
            background: #E9F7EF;
            border: 1px solid #C5E9D2;
        }

        .alert-danger {
            color: #A52E2E;
            background: #FFF0EF;
            border: 1px solid #F2CECB;
        }

        .alert ul {
            padding-left: 18px;
            margin-top: 5px;
        }

        /* ================================
           FORM SECTIONS
        ================================= */

        .form-section {
            margin-bottom: 30px;
        }

        .section-heading {
            display: flex;
            align-items: center;
            gap: 13px;
            margin-bottom: 15px;
        }

        .section-icon {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--navy);
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 13px;
            font-size: 17px;
            box-shadow: 0 4px 12px rgba(23,43,77,.04);
        }

        .section-title {
            color: var(--navy);
            font-size: 15px;
            font-weight: 900;
        }

        .section-subtitle {
            margin-top: 4px;
            color: var(--muted);
            font-size: 11px;
            font-weight: 500;
        }

        .section-counter {
            margin-left: auto;
            padding: 7px 11px;
            color: var(--navy);
            background: var(--gold-light);
            border-radius: 20px;
            font-size: 9px;
            font-weight: 900;
        }

        /* ================================
           FIELDS CARD
        ================================= */

        .fields-card {
            padding: 27px;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .fields-card:hover {
            box-shadow: var(--shadow-hover);
        }

        .fields-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 24px 22px;
        }

        .field {
            min-width: 0;
        }

        .field.full-width {
            grid-column: 1 / -1;
        }

        .field-label {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 10px;
            color: var(--navy);
            font-size: 12px;
            font-weight: 800;
        }

        .field-label i {
            color: var(--gold);
            font-size: 13px;
        }

        .required {
            color: var(--danger);
            margin-left: -5px;
        }

        .optional-tag {
            margin-left: auto;
            padding: 4px 8px;
            color: var(--muted);
            background: #F2F3F5;
            border-radius: 20px;
            font-size: 9px;
            font-weight: 700;
        }

        /* ================================
           INPUTS
        ================================= */

        .input-control {
            width: 100%;
            height: 53px;
            padding: 0 16px;
            color: var(--text);
            background: var(--cream);
            border: 1px solid var(--border);
            border-radius: 12px;
            outline: none;
            font-size: 13px;
            font-weight: 600;
            transition: .22s ease;
        }

        .input-control::placeholder {
            color: #A8AFBA;
            font-weight: 500;
        }

        .input-control:hover {
            border-color: #C8C3B5;
            background: #FBFAF6;
        }

        .input-control:focus {
            background: var(--white);
            border-color: var(--gold);
            box-shadow: 0 0 0 4px rgba(217,169,40,.12);
        }

        .input-control.is-invalid {
            border-color: var(--danger);
            background: #FFF8F7;
        }

        .input-control.is-invalid:focus {
            box-shadow: 0 0 0 4px rgba(217,83,79,.10);
        }

        select.input-control {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%23172B4D' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 17px center;
            padding-right: 42px;
        }

        /* ================================
           INPUT WITH ICON
        ================================= */

        .input-icon-wrap {
            position: relative;
        }

        .input-icon-wrap .input-control {
            padding-left: 44px;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            z-index: 1;
            color: #A2A9B5;
            font-size: 13px;
            transform: translateY(-50%);
            pointer-events: none;
        }

        /* ================================
           PRICE INPUT
        ================================= */

        .price-input-wrap {
            display: flex;
            height: 53px;
            overflow: hidden;
            background: var(--cream);
            border: 1px solid var(--border);
            border-radius: 12px;
            transition: .22s ease;
        }

        .price-input-wrap:hover {
            border-color: #C8C3B5;
        }

        .price-input-wrap:focus-within {
            background: var(--white);
            border-color: var(--gold);
            box-shadow: 0 0 0 4px rgba(217,169,40,.12);
        }

        .price-input-wrap.is-invalid {
            border-color: var(--danger);
        }

        .currency-box {
            width: 52px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold);
            background: var(--navy);
            font-size: 19px;
            font-weight: 900;
        }

        .price-input {
            width: 100%;
            min-width: 0;
            padding: 0 16px;
            color: var(--text);
            background: transparent;
            border: none;
            outline: none;
            font-size: 14px;
            font-weight: 800;
        }

        .price-input::placeholder {
            color: #A8AFBA;
            font-size: 12px;
            font-weight: 500;
        }

        /* ================================
           HELPER TEXT
        ================================= */

        .helper-row {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            padding: 0 2px;
            margin-top: 9px;
            color: var(--muted);
            font-size: 10px;
            line-height: 1.7;
        }

        .helper-row i {
            margin-top: 2px;
            color: var(--gold);
        }

        .error-message {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-top: 8px;
            color: var(--danger);
            font-size: 10px;
            font-weight: 700;
        }

        /* ================================
           PRICE SUMMARY
        ================================= */

        .price-summary {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 13px;
            margin-top: 22px;
        }

        .price-summary-item {
            padding: 15px 17px;
            background: #FBFAF6;
            border: 1px solid var(--border);
            border-radius: 13px;
        }

        .price-summary-label {
            display: flex;
            align-items: center;
            gap: 7px;
            color: var(--muted);
            font-size: 10px;
            font-weight: 700;
        }

        .price-summary-label i {
            color: var(--gold);
        }

        .price-summary-value {
            display: block;
            margin-top: 9px;
            color: var(--navy);
            font-size: 19px;
            font-weight: 900;
        }

        /* ================================
           STOCK PREVIEW
        ================================= */

        .stock-preview {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 18px 20px;
            margin-top: 22px;
            background: linear-gradient(120deg, #FFFCF3, #FFF9E9);
            border: 1px dashed #D9C58E;
            border-radius: 15px;
        }

        .stock-preview-left {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .stock-preview-icon {
            width: 43px;
            height: 43px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--navy);
            background: var(--gold-light);
            border-radius: 12px;
            font-size: 17px;
        }

        .stock-preview-title {
            color: var(--navy);
            font-size: 11px;
            font-weight: 900;
        }

        .stock-preview-subtitle {
            margin-top: 4px;
            color: var(--muted);
            font-size: 10px;
        }

        .stock-preview-right {
            text-align: right;
        }

        .stock-preview-value {
            color: var(--navy);
            font-size: 23px;
            font-weight: 900;
            letter-spacing: -.7px;
        }

        .stock-preview-unit {
            display: block;
            margin-top: 2px;
            color: var(--muted);
            font-size: 9px;
            font-weight: 800;
        }

        /* ================================
           LOW STOCK PREVIEW
        ================================= */

        .threshold-preview {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 13px 15px;
            margin-top: 13px;
            background: #F6F8FB;
            border: 1px solid #E5EAF1;
            border-radius: 12px;
        }

        .threshold-preview i {
            color: var(--navy);
            font-size: 14px;
        }

        .threshold-preview p {
            flex: 1;
            color: var(--muted);
            font-size: 10px;
            line-height: 1.6;
        }

        .threshold-preview strong {
            color: var(--navy);
        }

        /* ================================
           FORM FOOTER
        ================================= */

        .form-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 23px 25px;
            margin-top: 30px;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }

        .footer-note {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            max-width: 380px;
            color: var(--muted);
            font-size: 10px;
            line-height: 1.7;
        }

        .footer-note i {
            margin-top: 2px;
            color: var(--gold);
            font-size: 14px;
        }

        .footer-note strong {
            color: var(--navy);
        }

        .footer-actions {
            display: flex;
            align-items: center;
            gap: 11px;
            flex-shrink: 0;
        }

        /* ================================
           BUTTONS
        ================================= */

        .btn {
            position: relative;
            min-height: 49px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 0 22px;
            overflow: hidden;
            border: 1px solid transparent;
            border-radius: 12px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 900;
            cursor: pointer;
            transition: .25s ease;
        }

        .btn i {
            font-size: 13px;
            transition: transform .25s ease;
        }

        .btn-cancel {
            color: var(--navy);
            background: var(--cream);
            border-color: var(--border);
        }

        .btn-cancel:hover {
            color: var(--navy);
            background: #ECEAE2;
            border-color: #D8D5CA;
            transform: translateY(-3px);
            box-shadow: 0 7px 15px rgba(23,43,77,.08);
        }

        .btn-cancel:hover i {
            transform: rotate(90deg);
        }

        .btn-save {
            min-width: 165px;
            color: var(--navy);
            background: linear-gradient(135deg, #F0CE75, var(--gold));
            box-shadow: 0 7px 17px rgba(217,169,40,.25);
        }

        .btn-save::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 70%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,.35), transparent);
            transform: skewX(-20deg);
            transition: left .6s ease;
        }

        .btn-save:hover {
            background: linear-gradient(135deg, #F5D98F, #D6A01E);
            transform: translateY(-3px);
            box-shadow: 0 11px 24px rgba(217,169,40,.34);
        }

        .btn-save:hover::before {
            left: 140%;
        }

        .btn-save:hover i {
            transform: translateY(-2px);
        }

        .btn-save:active {
            transform: scale(.97);
        }

        .btn-save:disabled {
            opacity: .65;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .btn-save:disabled::before {
            display: none;
        }

        /* ================================
           BOTTOM INFORMATION
        ================================= */

        .bottom-information {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 23px 10px 0;
            color: #A0A6B0;
            font-size: 10px;
            font-weight: 600;
            text-align: center;
        }

        .bottom-information i {
            color: var(--gold);
        }

        .bottom-space {
            height: 12px;
        }

        /* ================================
           ANIMATIONS
        ================================= */

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

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(14px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-in {
            animation: fadeUp .5s ease both;
        }

        .delay-1 { animation-delay: .05s; }
        .delay-2 { animation-delay: .10s; }
        .delay-3 { animation-delay: .15s; }

        /* ================================
           RESPONSIVE
        ================================= */

        @media (max-width: 760px) {
            .page-wrapper {
                padding: 19px 17px 40px;
            }

            .top-header {
                margin-bottom: 22px;
            }

            .header-title {
                font-size: 19px;
            }

            .header-status {
                display: none;
            }

            .intro-card {
                min-height: auto;
                padding: 23px;
            }

            .intro-title {
                font-size: 17px;
            }

            .intro-badge {
                display: none;
            }

            .progress-card {
                padding: 14px;
            }

            .progress-track {
                width: 75px;
            }

            .fields-card {
                padding: 21px;
            }

            .fields-grid {
                grid-template-columns: 1fr;
                gap: 21px;
            }

            .field.full-width {
                grid-column: auto;
            }

            .form-footer {
                align-items: stretch;
                flex-direction: column;
                padding: 20px;
            }

            .footer-actions {
                display: grid;
                grid-template-columns: 1fr 1.3fr;
            }

            .btn {
                padding: 0 13px;
            }

            .btn-save {
                min-width: 0;
            }
        }

        @media (max-width: 430px) {
            .page-wrapper {
                padding: 15px 12px 35px;
            }

            .header-icon {
                display: none;
            }

            .header-title {
                font-size: 17px;
            }

            .header-subtitle {
                font-size: 10px;
            }

            .back-button {
                width: 42px;
                height: 42px;
            }

            .intro-card {
                align-items: flex-start;
                gap: 13px;
                padding: 19px;
                border-radius: 17px;
            }

            .intro-icon {
                width: 47px;
                height: 47px;
                border-radius: 13px;
                font-size: 20px;
            }

            .intro-title {
                font-size: 15px;
            }

            .intro-text {
                font-size: 10px;
            }

            .progress-card {
                gap: 9px;
            }

            .progress-track {
                display: none;
            }

            .section-title {
                font-size: 14px;
            }

            .fields-card {
                padding: 17px;
            }

            .price-summary {
                grid-template-columns: 1fr;
            }

            .stock-preview {
                padding: 14px;
            }

            .stock-preview-value {
                font-size: 19px;
            }

            .footer-actions {
                grid-template-columns: 1fr;
            }

            .btn {
                width: 100%;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                scroll-behavior: auto !important;
                animation-duration: .01ms !important;
                transition-duration: .01ms !important;
            }
        }
    </style>
</head>

<body>

<div class="page-wrapper">

    <!-- HEADER -->
    <header class="top-header animate-in">
        <div class="header-left">

            <a href="{{ route('inventory.index') }}"
               class="back-button"
               title="Back to Inventory"
               aria-label="Back to Inventory">
                <i class="fa-solid fa-arrow-left"></i>
            </a>

            <div>
                <h1 class="header-title">New Product</h1>
                <p class="header-subtitle">Add an item to your inventory</p>
            </div>

        </div>

        <div class="header-right">
            <div class="header-status">
                <i class="fa-solid fa-circle-check"></i>
                Inventory Management
            </div>

            <div class="header-icon">
                <i class="fa-solid fa-cube"></i>
            </div>
        </div>
    </header>

    <!-- BREADCRUMB -->
    <nav class="breadcrumb animate-in">
        <a href="{{ route('inventory.index') }}">Inventory</a>
        <i class="fa-solid fa-chevron-right"></i>
        <span class="current">New Product</span>
    </nav>

    <!-- SUCCESS MESSAGE -->
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- GENERAL ERROR MESSAGE -->
    @if($errors->any())
        <div class="alert alert-danger">
            <i class="fa-solid fa-circle-exclamation"></i>
            <div>
                <strong>Please check the following:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- INTRO CARD -->
    <section class="intro-card animate-in delay-1">

        <div class="intro-decoration"></div>

        <div class="intro-icon">
            <i class="fa-solid fa-cube"></i>
        </div>

        <div class="intro-content">
            <h2 class="intro-title">Product information</h2>

            <p class="intro-text">
                Enter the details of the product you want to keep in your
                inventory. Set its measurement unit, selling price,
                package price, and starting stock quantity.
            </p>
        </div>

        <div class="intro-badge">
            <i class="fa-solid fa-plus"></i>
            NEW ITEM
        </div>

    </section>

    <!-- PROGRESS -->
    <div class="progress-card animate-in delay-2">

        <div class="progress-number">
            <i class="fa-solid fa-list-check"></i>
        </div>

        <div class="progress-content">
            <p class="progress-title">Product setup</p>
            <p class="progress-subtitle">Complete the required product information</p>
        </div>

        <div class="progress-track">
            <div class="progress-fill" id="progressFill"></div>
        </div>

        <span class="progress-percent" id="progressPercent">0%</span>

    </div>

    <!-- PRODUCT FORM -->
    <form action="{{ route('inventory.store') }}"
          method="POST"
          id="productForm">

        @csrf

        <!-- =========================
             PRODUCT DETAILS
        ========================== -->

        <section class="form-section animate-in delay-1">

            <div class="section-heading">

                <div class="section-icon">
                    <i class="fa-solid fa-circle-info"></i>
                </div>

                <div>
                    <h2 class="section-title">Product details</h2>
                    <p class="section-subtitle">Basic product information</p>
                </div>

                <span class="section-counter">STEP 01</span>

            </div>

            <div class="fields-card">

                <div class="fields-grid">

                    <!-- PRODUCT NAME -->
                    <div class="field full-width">

                        <label class="field-label" for="name">
                            <i class="fa-solid fa-tag"></i>
                            Product name
                            <span class="required">*</span>
                        </label>

                        <div class="input-icon-wrap">
                            <i class="fa-solid fa-box input-icon"></i>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="input-control @error('name') is-invalid @enderror"
                                placeholder="e.g. Lucky Me Pancit Canton"
                                value="{{ old('name') }}"
                                maxlength="255"
                                autocomplete="off"
                                required
                            >
                        </div>

                        <div class="helper-row">
                            <i class="fa-solid fa-circle-info"></i>
                            <span>Enter a clear and recognizable product name.</span>
                        </div>

                        @error('name')
                            <p class="error-message">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <!-- CATEGORY -->
                    <div class="field">

                        <label class="field-label" for="category">
                            <i class="fa-solid fa-layer-group"></i>
                            Category
                            <span class="optional-tag">OPTIONAL</span>
                        </label>

                        <div class="input-icon-wrap">
                            <i class="fa-solid fa-folder input-icon"></i>

                            <input
                                type="text"
                                id="category"
                                name="category"
                                class="input-control @error('category') is-invalid @enderror"
                                placeholder="e.g. Noodles, Canned goods"
                                value="{{ old('category') }}"
                                maxlength="255"
                            >
                        </div>

                        @error('category')
                            <p class="error-message">{{ $message }}</p>
                        @enderror

                    </div>

                    <!-- MEASUREMENT VALUE -->
                    <div class="field">

                        <label class="field-label" for="measurement_value">
                            <i class="fa-solid fa-calculator"></i>
                            Numerical value
                            <span class="optional-tag">OPTIONAL</span>
                        </label>

                        <div class="input-icon-wrap">
                            <i class="fa-solid fa-ruler input-icon"></i>

                            <input
                                type="number"
                                id="measurement_value"
                                name="measurement_value"
                                class="input-control @error('measurement_value') is-invalid @enderror"
                                placeholder="e.g. 500"
                                value="{{ old('measurement_value') }}"
                                min="0"
                                step="any"
                            >
                        </div>

                        <div class="helper-row">
                            <i class="fa-solid fa-circle-info"></i>
                            <span>Example: 500 for a 500g product.</span>
                        </div>

                        @error('measurement_value')
                            <p class="error-message">{{ $message }}</p>
                        @enderror

                    </div>

                    <!-- UNIT -->
                    <div class="field">

                        <label class="field-label" for="unit">
                            <i class="fa-solid fa-ruler-combined"></i>
                            Unit of measurement
                            <span class="required">*</span>
                        </label>

                        <select
                            id="unit"
                            name="unit"
                            class="input-control @error('unit') is-invalid @enderror"
                            required
                        >
                            <option value="piece" {{ old('unit', 'piece') === 'piece' ? 'selected' : '' }}>
                                Piece
                            </option>

                            <option value="kg" {{ old('unit') === 'kg' ? 'selected' : '' }}>
                                Kilogram (kg)
                            </option>

                            <option value="g" {{ old('unit') === 'g' ? 'selected' : '' }}>
                                Gram (g)
                            </option>

                            <option value="liter" {{ old('unit') === 'liter' ? 'selected' : '' }}>
                                Liter (L)
                            </option>

                            <option value="ml" {{ old('unit') === 'ml' ? 'selected' : '' }}>
                                Milliliter (ml)
                            </option>

                            <option value="pack" {{ old('unit') === 'pack' ? 'selected' : '' }}>
                                Pack
                            </option>

                            <option value="box" {{ old('unit') === 'box' ? 'selected' : '' }}>
                                Box
                            </option>

                            <option value="bottle" {{ old('unit') === 'bottle' ? 'selected' : '' }}>
                                Bottle
                            </option>
                        </select>

                        @error('unit')
                            <p class="error-message">{{ $message }}</p>
                        @enderror

                    </div>

                    <!-- SELLING PRICE -->
                    <div class="field">

                        <label class="field-label" for="selling_price">
                            <i class="fa-solid fa-money-bill-wave"></i>
                            Selling price
                            <span class="required">*</span>
                        </label>

                        <div class="price-input-wrap @error('selling_price') is-invalid @enderror">

                            <div class="currency-box">₱</div>

                            <input
                                type="number"
                                id="selling_price"
                                name="selling_price"
                                class="price-input"
                                placeholder="0.00"
                                value="{{ old('selling_price') }}"
                                min="0"
                                step="0.01"
                                required
                            >

                        </div>

                        <div class="helper-row">
                            <i class="fa-solid fa-circle-info"></i>
                            <span>Price customers pay for one selling unit.</span>
                        </div>

                        @error('selling_price')
                            <p class="error-message">{{ $message }}</p>
                        @enderror

                    </div>

                    <!-- PACKAGE PRICE -->
                    <div class="field">

                        <label class="field-label" for="package_price">
                            <i class="fa-solid fa-box-open"></i>
                            Package price
                            <span class="optional-tag">OPTIONAL</span>
                        </label>

                        <div class="price-input-wrap @error('package_price') is-invalid @enderror">

                            <div class="currency-box">₱</div>

                            <input
                                type="number"
                                id="package_price"
                                name="package_price"
                                class="price-input"
                                placeholder="Optional"
                                value="{{ old('package_price') }}"
                                min="0"
                                step="0.01"
                            >

                        </div>

                        <div class="helper-row">
                            <i class="fa-solid fa-circle-info"></i>
                            <span>If blank, the package price will use the selling price.</span>
                        </div>

                        @error('package_price')
                            <p class="error-message">{{ $message }}</p>
                        @enderror

                    </div>

                </div>

                <!-- PRICE SUMMARY -->
                <div class="price-summary">

                    <div class="price-summary-item">
                        <p class="price-summary-label">
                            <i class="fa-solid fa-tag"></i>
                            Selling price
                        </p>
                        <strong class="price-summary-value" id="sellingPricePreview">₱0.00</strong>
                    </div>

                    <div class="price-summary-item">
                        <p class="price-summary-label">
                            <i class="fa-solid fa-box"></i>
                            Package price
                        </p>
                        <strong class="price-summary-value" id="packagePricePreview">₱0.00</strong>
                    </div>

                </div>

            </div>

        </section>

        <!-- =========================
             INVENTORY DETAILS
        ========================== -->

        <section class="form-section animate-in delay-2">

            <div class="section-heading">

                <div class="section-icon">
                    <i class="fa-solid fa-layer-group"></i>
                </div>

                <div>
                    <h2 class="section-title">Inventory details</h2>
                    <p class="section-subtitle">Stock and low-stock settings</p>
                </div>

                <span class="section-counter">STEP 02</span>

            </div>

            <div class="fields-card">

                <div class="fields-grid">

                    <!-- STARTING STOCK -->
                    <div class="field">

                        <label class="field-label" for="stock_quantity">
                            <i class="fa-solid fa-cubes-stacked"></i>
                            Starting stock quantity
                            (<span id="stockUnitLabel">pieces</span>)
                        </label>

                        <div class="input-icon-wrap">
                            <i class="fa-solid fa-boxes-stacked input-icon"></i>

                            <input
                                type="number"
                                id="stock_quantity"
                                name="stock_quantity"
                                class="input-control @error('stock_quantity') is-invalid @enderror"
                                placeholder="0"
                                value="{{ old('stock_quantity', '0') }}"
                                min="0"
                                step="1"
                            >
                        </div>

                        <div class="helper-row">
                            <i class="fa-solid fa-circle-info"></i>
                            <span>Enter the quantity currently available in your store.</span>
                        </div>

                        @error('stock_quantity')
                            <p class="error-message">{{ $message }}</p>
                        @enderror

                    </div>

                    <!-- LOW STOCK THRESHOLD -->
                    <div class="field">

                        <label class="field-label" for="low_stock_threshold">
                            <i class="fa-solid fa-bell"></i>
                            Low stock alert threshold
                        </label>

                        <div class="input-icon-wrap">
                            <i class="fa-solid fa-triangle-exclamation input-icon"></i>

                            <input
                                type="number"
                                id="low_stock_threshold"
                                name="low_stock_threshold"
                                class="input-control @error('low_stock_threshold') is-invalid @enderror"
                                placeholder="5"
                                value="{{ old('low_stock_threshold', '5') }}"
                                min="0"
                                step="any"
                            >
                        </div>

                        <div class="helper-row">
                            <i class="fa-solid fa-circle-info"></i>
                            <span>Set the quantity at which you want to receive a low-stock indicator.</span>
                        </div>

                        @error('low_stock_threshold')
                            <p class="error-message">{{ $message }}</p>
                        @enderror

                    </div>

                </div>

                <!-- STOCK PREVIEW -->
                <div class="stock-preview">

                    <div class="stock-preview-left">

                        <div class="stock-preview-icon">
                            <i class="fa-solid fa-boxes-stacked"></i>
                        </div>

                        <div>
                            <p class="stock-preview-title">Starting inventory</p>
                            <p class="stock-preview-subtitle">Your initial available stock</p>
                        </div>

                    </div>

                    <div class="stock-preview-right">
                        <div class="stock-preview-value">
                            <span id="stockPreview">0</span>
                        </div>

                        <span class="stock-preview-unit" id="stockPreviewUnit">pcs</span>
                    </div>

                </div>

                <!-- THRESHOLD PREVIEW -->
                <div class="threshold-preview">
                    <i class="fa-solid fa-bell"></i>
                    <p>
                        Low-stock alert will be triggered when your stock reaches
                        <strong id="thresholdPreview">5</strong>
                        <strong id="thresholdUnit">pieces</strong>.
                    </p>
                </div>

            </div>

        </section>

        <!-- =========================
             FORM FOOTER
        ========================== -->

        <div class="form-footer animate-in delay-3">

            <div class="footer-note">
                <i class="fa-solid fa-shield-halved"></i>

                <span>
                    <strong>Almost done!</strong><br>
                    Please review your product details before saving.
                    Your product will be added to your inventory.
                </span>
            </div>

            <div class="footer-actions">

                <a href="{{ route('inventory.index') }}"
                   class="btn btn-cancel"
                   id="cancelButton">
                    <i class="fa-solid fa-xmark"></i>
                    Cancel
                </a>

                <button type="submit"
                        class="btn btn-save"
                        id="saveButton">

                    <i class="fa-solid fa-floppy-disk" id="saveIcon"></i>

                    <span id="saveButtonText">Save product</span>

                </button>

            </div>

        </div>

    </form>

    <div class="bottom-information">
        <i class="fa-solid fa-shield-halved"></i>
        <span>Track&Tally Inventory Management</span>
        <span>•</span>
        <span>Keep your store organized</span>
    </div>

    <div class="bottom-space"></div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('productForm');

    const nameInput = document.getElementById('name');
    const categoryInput = document.getElementById('category');
    const measurementInput = document.getElementById('measurement_value');
    const unitInput = document.getElementById('unit');
    const sellingPriceInput = document.getElementById('selling_price');
    const packagePriceInput = document.getElementById('package_price');
    const stockInput = document.getElementById('stock_quantity');
    const thresholdInput = document.getElementById('low_stock_threshold');

    const stockUnitLabel = document.getElementById('stockUnitLabel');
    const stockPreview = document.getElementById('stockPreview');
    const stockPreviewUnit = document.getElementById('stockPreviewUnit');
    const thresholdPreview = document.getElementById('thresholdPreview');
    const thresholdUnit = document.getElementById('thresholdUnit');

    const sellingPricePreview = document.getElementById('sellingPricePreview');
    const packagePricePreview = document.getElementById('packagePricePreview');

    const progressFill = document.getElementById('progressFill');
    const progressPercent = document.getElementById('progressPercent');

    const saveButton = document.getElementById('saveButton');
    const saveButtonText = document.getElementById('saveButtonText');
    const saveIcon = document.getElementById('saveIcon');

    let isSubmitting = false;

    const unitLabels = {
        piece: {
            label: 'pieces',
            singular: 'piece',
            short: 'pcs'
        },
        kg: {
            label: 'kilograms',
            singular: 'kilogram',
            short: 'kg'
        },
        g: {
            label: 'grams',
            singular: 'gram',
            short: 'g'
        },
        liter: {
            label: 'liters',
            singular: 'liter',
            short: 'L'
        },
        ml: {
            label: 'milliliters',
            singular: 'milliliter',
            short: 'ml'
        },
        pack: {
            label: 'packs',
            singular: 'pack',
            short: 'packs'
        },
        box: {
            label: 'boxes',
            singular: 'box',
            short: 'boxes'
        },
        bottle: {
            label: 'bottles',
            singular: 'bottle',
            short: 'bottles'
        }
    };

    function getUnitInfo(unit) {
        return unitLabels[unit] || {
            label: unit,
            singular: unit,
            short: unit
        };
    }

    function formatNumber(value) {
        return Number(value || 0).toLocaleString('en-PH', {
            maximumFractionDigits: 3
        });
    }

    function formatCurrency(value) {
        return '₱' + Number(value || 0).toLocaleString('en-PH', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }

    /* STOCK PREVIEW */

    function updateStockPreview() {
        const unit = unitInput.value;
        const quantity = Number(stockInput.value) || 0;
        const threshold = Number(thresholdInput.value) || 0;
        const info = getUnitInfo(unit);

        stockUnitLabel.textContent = info.label;
        stockPreviewUnit.textContent = info.short;

        stockPreview.textContent = formatNumber(quantity);

        thresholdPreview.textContent = formatNumber(threshold);
        thresholdUnit.textContent = info.label;

        stockInput.step = unit === 'piece' ? '1' : 'any';
    }

    /* PRICE PREVIEW */

    function updatePricePreview() {
        const sellingPrice = Number(sellingPriceInput.value) || 0;

        const packagePriceValue =
            packagePriceInput.value === ''
                ? sellingPrice
                : Number(packagePriceInput.value) || 0;

        sellingPricePreview.textContent = formatCurrency(sellingPrice);
        packagePricePreview.textContent = formatCurrency(packagePriceValue);
    }

    /* PROGRESS INDICATOR */

    function updateProgress() {
        const requiredFields = [
            nameInput,
            unitInput,
            sellingPriceInput
        ];

        let completed = 0;

        requiredFields.forEach(function (field) {
            if (String(field.value).trim() !== '') {
                completed++;
            }
        });

        const percentage = Math.round(
            (completed / requiredFields.length) * 100
        );

        progressFill.style.width = percentage + '%';
        progressPercent.textContent = percentage + '%';
    }

    /* UPDATE ALL PREVIEWS */

    function updateAllPreviews() {
        updateStockPreview();
        updatePricePreview();
        updateProgress();
    }

    unitInput.addEventListener('change', updateAllPreviews);
    stockInput.addEventListener('input', updateAllPreviews);
    thresholdInput.addEventListener('input', updateAllPreviews);

    sellingPriceInput.addEventListener('input', updateAllPreviews);
    packagePriceInput.addEventListener('input', updateAllPreviews);

    nameInput.addEventListener('input', updateProgress);

    updateAllPreviews();

    /* FORM VALIDATION */

    form.addEventListener('submit', function (event) {

        if (isSubmitting) {
            event.preventDefault();
            return;
        }

        const name = nameInput.value.trim();
        const price = sellingPriceInput.value;
        const stock = Number(stockInput.value || 0);

        if (!name || price === '') {
            event.preventDefault();

            alert('Product name and selling price are required.');

            if (!name) {
                nameInput.focus();
            } else {
                sellingPriceInput.focus();
            }

            return;
        }

        if (Number(price) < 0) {
            event.preventDefault();
            alert('Selling price cannot be negative.');
            sellingPriceInput.focus();
            return;
        }

        if (
            unitInput.value === 'piece' &&
            !Number.isInteger(stock)
        ) {
            event.preventDefault();

            alert(
                'Products measured by piece must have whole-number stock quantities.'
            );

            stockInput.focus();
            return;
        }

        if (stock < 0) {
            event.preventDefault();
            alert('Stock quantity cannot be negative.');
            stockInput.focus();
            return;
        }

        isSubmitting = true;

        saveButton.disabled = true;
        saveButtonText.textContent = 'Saving product...';
        saveIcon.className = 'fa-solid fa-spinner fa-spin';
    });

    /* RESET BUTTON STATE WHEN PAGE IS RESTORED */

    window.addEventListener('pageshow', function () {
        isSubmitting = false;
        saveButton.disabled = false;
        saveButtonText.textContent = 'Save product';
        saveIcon.className = 'fa-solid fa-floppy-disk';
    });

    /* OPTIONAL: HIDE ALERTS AFTER A SHORT DELAY */

    document.querySelectorAll('.alert-success').forEach(function (alertBox) {
        setTimeout(function () {
            alertBox.style.transition = 'opacity .4s ease';
            alertBox.style.opacity = '0';

            setTimeout(function () {
                alertBox.remove();
            }, 450);
        }, 5000);
    });

});
</script>

</body>
</html>
