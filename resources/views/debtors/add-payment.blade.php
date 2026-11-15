<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Payment | Track&Tally</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --navy: #1c3049;
            --navy-dark: #14263c;
            --navy-soft: #304e6b;
            --gold: #c49a45;
            --gold-light: #f8f0df;
            --cream: #f5f4ef;
            --white: #ffffff;
            --text: #27364a;
            --muted: #8993a1;
            --border: #e8e7e1;
            --green: #23845b;
            --red: #c44848;
            --shadow: 0 12px 35px rgba(28, 48, 73, .07);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            background: var(--cream);
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
        }

        button, input, select, textarea {
            font: inherit;
        }

        button, a {
            -webkit-tap-highlight-color: transparent;
        }

        button {
            cursor: pointer;
        }

        .topbar {
            height: 76px;
            background: var(--white);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 6%;
            position: sticky;
            top: 0;
            z-index: 50;
            box-shadow: 0 3px 15px rgba(28,48,73,.035);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .brand-logo {
            width: 43px;
            height: 43px;
            border-radius: 13px;
            background: linear-gradient(145deg, var(--navy), #304d6b);
            color: var(--gold);
            display: grid;
            place-items: center;
            font-size: 19px;
            box-shadow: 0 6px 15px rgba(28,48,73,.2);
        }

        .brand-name {
            color: var(--navy);
            font-family: 'Manrope', sans-serif;
            font-size: 19px;
            font-weight: 800;
            letter-spacing: -.7px;
        }

        .brand-name span,
        .footer-brand span {
            color: var(--gold);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--muted);
            font-size: 12px;
            font-weight: 700;
        }

        .secure-label {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #f0f7f2;
            color: var(--green);
            padding: 10px 15px;
            border-radius: 30px;
            border: 1px solid #dceee2;
        }

        .page {
            width: min(1120px, 92%);
            margin: 38px auto 65px;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 9px;
            color: var(--muted);
            font-size: 12px;
            margin-bottom: 23px;
            flex-wrap: wrap;
        }

        .breadcrumb a {
            color: var(--navy-soft);
            text-decoration: none;
            font-weight: 700;
            transition: .2s;
        }

        .breadcrumb a:hover {
            color: var(--gold);
        }

        .page-heading {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 20px;
            margin-bottom: 25px;
        }

        .eyebrow {
            color: var(--gold);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .page-title {
            color: var(--navy);
            font-family: 'Manrope', sans-serif;
            font-size: clamp(25px, 4vw, 34px);
            font-weight: 800;
            letter-spacing: -1.2px;
        }

        .page-subtitle {
            color: var(--muted);
            font-size: 13px;
            margin-top: 7px;
            line-height: 1.6;
        }

        .back-link {
            color: var(--navy);
            background: var(--white);
            border: 1px solid var(--border);
            text-decoration: none;
            padding: 12px 17px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            gap: 9px;
            transition: all .25s ease;
            white-space: nowrap;
        }

        .back-link:hover {
            background: var(--navy);
            color: var(--white);
            border-color: var(--navy);
            transform: translateY(-3px);
            box-shadow: 0 8px 18px rgba(28,48,73,.18);
        }

        .layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 330px;
            gap: 23px;
            align-items: start;
        }

        .main-column {
            min-width: 0;
        }

        .card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 18px;
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-bottom: 20px;
            transition: box-shadow .25s, transform .25s;
        }

        .card:hover {
            box-shadow: 0 16px 40px rgba(28,48,73,.09);
        }

        .card-header {
            padding: 21px 25px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .card-heading {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .card-icon {
            width: 43px;
            height: 43px;
            border-radius: 13px;
            background: linear-gradient(145deg, #fbf5e8, #f0dfb9);
            color: var(--navy);
            display: grid;
            place-items: center;
            font-size: 17px;
        }

        .card-title {
            color: var(--navy);
            font-size: 15px;
            font-weight: 800;
        }

        .card-description {
            color: var(--muted);
            font-size: 11px;
            margin-top: 4px;
        }

        .required-tag {
            color: #94702d;
            background: var(--gold-light);
            padding: 7px 11px;
            border-radius: 30px;
            font-size: 9px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .card-body {
            padding: 25px;
        }

        .debtor-strip {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 17px;
            background: #f8f9fa;
            border: 1px solid var(--border);
            border-radius: 14px;
            margin-bottom: 21px;
        }

        .debtor-avatar {
            width: 49px;
            height: 49px;
            flex-shrink: 0;
            border-radius: 15px;
            background: linear-gradient(145deg, var(--navy), #385979);
            color: var(--gold-light);
            display: grid;
            place-items: center;
            font-size: 19px;
            box-shadow: 0 5px 12px rgba(28,48,73,.15);
        }

        .debtor-info {
            min-width: 0;
            flex: 1;
        }

        .debtor-label {
            color: var(--muted);
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .8px;
            margin-bottom: 4px;
        }

        .debtor-name {
            color: var(--navy);
            font-size: 15px;
            font-weight: 800;
            overflow-wrap: anywhere;
        }

        .debtor-contact {
            color: var(--muted);
            font-size: 11px;
            margin-top: 3px;
        }

        .verified {
            color: var(--green);
            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
        }

        .balance-panel {
            position: relative;
            overflow: hidden;
            padding: 25px;
            border-radius: 16px;
            background: linear-gradient(125deg, var(--navy-dark), #294664);
            color: var(--white);
            margin-bottom: 24px;
            box-shadow: 0 10px 25px rgba(20,38,60,.2);
        }

        .balance-panel::before,
        .balance-panel::after {
            content: "";
            position: absolute;
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 50%;
            pointer-events: none;
        }

        .balance-panel::before {
            width: 230px;
            height: 230px;
            right: -90px;
            top: -145px;
        }

        .balance-panel::after {
            width: 180px;
            height: 180px;
            right: -50px;
            bottom: -135px;
        }

        .balance-top,
        .balance-amount,
        .balance-bottom {
            position: relative;
            z-index: 1;
        }

        .balance-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
        }

        .balance-label {
            color: #e6d2a5;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.5px;
        }

        .balance-symbol {
            width: 37px;
            height: 37px;
            display: grid;
            place-items: center;
            border-radius: 11px;
            background: rgba(255,255,255,.12);
            color: var(--gold-light);
        }

        .balance-amount {
            font-family: 'Manrope', sans-serif;
            font-size: clamp(29px, 5vw, 38px);
            font-weight: 800;
            letter-spacing: -1px;
            margin: 14px 0 10px;
            overflow-wrap: anywhere;
        }

        .balance-bottom {
            color: #d3dce5;
            font-size: 11px;
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .balance-bottom i {
            color: var(--gold);
        }

        .field {
            margin-bottom: 20px;
        }

        .field:last-child {
            margin-bottom: 0;
        }

        .field-label {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            color: var(--navy);
            font-size: 12px;
            font-weight: 800;
            margin-bottom: 9px;
        }

        .field-label small {
            color: var(--muted);
            font-size: 10px;
            font-weight: 600;
        }

        .input-wrap {
            display: flex;
            min-height: 54px;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: #fbfbf9;
            overflow: hidden;
            transition: .2s;
        }

        .input-wrap:focus-within {
            border-color: var(--gold);
            box-shadow: 0 0 0 4px rgba(196,154,69,.13);
            background: var(--white);
        }

        .currency {
            width: 54px;
            display: grid;
            place-items: center;
            flex-shrink: 0;
            background: linear-gradient(145deg, var(--navy), #304e6b);
            color: var(--gold-light);
            font-size: 21px;
            font-weight: 800;
        }

        .amount-input {
            width: 100%;
            min-width: 0;
            border: 0;
            outline: 0;
            background: transparent;
            padding: 12px 15px;
            color: var(--navy);
            font-family: 'Manrope', sans-serif;
            font-size: 23px;
            font-weight: 800;
        }

        .regular-input,
        .select-input,
        .note-input {
            width: 100%;
            min-height: 50px;
            border: 1px solid var(--border);
            border-radius: 11px;
            background: #fbfbf9;
            outline: 0;
            padding: 12px 14px;
            color: var(--navy);
            font-size: 13px;
            transition: .2s;
        }

        .regular-input:focus,
        .select-input:focus,
        .note-input:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 4px rgba(196,154,69,.12);
            background: var(--white);
        }

        .note-input {
            min-height: 100px;
            resize: vertical;
            line-height: 1.6;
        }

        .regular-input::placeholder,
        .amount-input::placeholder,
        .note-input::placeholder {
            color: #aab1ba;
        }

        .quick-heading {
            display: flex;
            align-items: center;
            gap: 7px;
            color: var(--navy);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .8px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .quick-heading i {
            color: var(--gold);
        }

        .quick-options {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 13px;
        }

        .quick-button {
            border: 1px solid #ead9b4;
            background: #fffdf8;
            padding: 13px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
            text-align: left;
            cursor: pointer;
            transition: all .25s ease;
            position: relative;
            overflow: hidden;
        }

        .quick-button::after {
            content: "";
            position: absolute;
            width: 65px;
            height: 65px;
            border-radius: 50%;
            background: rgba(196,154,69,.09);
            right: -25px;
            bottom: -35px;
            transition: .25s;
        }

        .quick-button:hover {
            background: var(--gold-light);
            border-color: var(--gold);
            transform: translateY(-3px);
            box-shadow: 0 8px 18px rgba(196,154,69,.15);
        }

        .quick-button:active {
            transform: scale(.98);
        }

        .quick-icon {
            width: 36px;
            height: 36px;
            display: grid;
            place-items: center;
            border-radius: 11px;
            background: var(--white);
            color: var(--gold);
            flex-shrink: 0;
            box-shadow: 0 3px 8px rgba(28,48,73,.07);
        }

        .quick-text {
            color: var(--navy);
            font-size: 11px;
            font-weight: 800;
        }

        .quick-value {
            display: block;
            color: var(--muted);
            font-size: 10px;
            font-weight: 600;
            margin-top: 3px;
        }

        .method-options {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .method-option {
            position: relative;
        }

        .method-option input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .method-option label {
            min-height: 100px;
            padding: 14px 8px;
            border: 1px solid var(--border);
            border-radius: 13px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 9px;
            color: var(--muted);
            background: #fbfbf9;
            cursor: pointer;
            transition: all .25s ease;
            text-align: center;
        }

        .method-option label i {
            font-size: 23px;
            transition: .25s;
        }

        .method-option label span {
            color: var(--navy);
            font-size: 11px;
            font-weight: 800;
        }

        .method-option input:checked + label {
            background: linear-gradient(145deg, #fffaf0, var(--gold-light));
            border: 2px solid var(--gold);
            color: var(--gold);
            box-shadow: 0 5px 15px rgba(196,154,69,.15);
            transform: translateY(-2px);
        }

        .method-option input:checked + label i {
            transform: scale(1.12);
        }

        .method-option label:hover {
            border-color: var(--gold);
            transform: translateY(-2px);
        }

        .method-option input:focus-visible + label {
            outline: 3px solid rgba(196,154,69,.3);
            outline-offset: 3px;
        }

        .conditional-fields {
            display: none;
            padding: 17px;
            margin-top: 17px;
            border-radius: 12px;
            background: #f8f9fa;
            border: 1px solid var(--border);
        }

        .conditional-fields.show {
            display: block;
            animation: appear .2s ease;
        }

        @keyframes appear {
            from { opacity: 0; transform: translateY(5px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .conditional-fields .field {
            margin-bottom: 14px;
        }

        .conditional-fields .field:last-child {
            margin-bottom: 0;
        }

        .error-message {
            color: var(--red);
            font-size: 11px;
            font-weight: 700;
            margin-top: 7px;
            line-height: 1.5;
        }

        .alert {
            padding: 14px 16px;
            border-radius: 12px;
            margin-bottom: 17px;
            display: flex;
            gap: 10px;
            align-items: flex-start;
            font-size: 12px;
            line-height: 1.5;
        }

        .alert-success {
            background: #edf8f1;
            color: #216b48;
            border: 1px solid #ccebd7;
        }

        .alert-error {
            background: #fff1f0;
            color: #a53636;
            border: 1px solid #f3d0ce;
        }

        .summary-card {
            background: #fbf8ef;
            border: 1px solid #eee2c8;
            border-radius: 15px;
            padding: 19px;
            display: flex;
            gap: 13px;
            align-items: flex-start;
            margin-bottom: 18px;
        }

        .summary-icon {
            width: 40px;
            height: 40px;
            flex-shrink: 0;
            border-radius: 12px;
            display: grid;
            place-items: center;
            color: var(--navy);
            background: #f0dfb9;
        }

        .summary-title {
            color: var(--navy);
            font-size: 13px;
            font-weight: 800;
            margin-bottom: 5px;
        }

        .summary-description {
            color: #7f8490;
            font-size: 11px;
            line-height: 1.6;
        }

        /* FORM BUTTONS */

        .form-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 18px;
            border: 1px solid var(--border);
            border-radius: 16px;
            background: var(--white);
            box-shadow: var(--shadow);
        }

        .save-button {
            min-height: 55px;
            flex: 1;
            border: 0;
            border-radius: 12px;
            color: var(--white);
            background: linear-gradient(115deg, var(--navy), #355b7e);
            font-size: 13px;
            font-weight: 800;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 7px 16px rgba(28,48,73,.2);
            transition: all .25s ease;
            position: relative;
            overflow: hidden;
        }

        .save-button::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(100deg, transparent, rgba(255,255,255,.17), transparent);
            transition: .5s;
        }

        .save-button:hover::before {
            left: 100%;
        }

        .save-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 23px rgba(28,48,73,.27);
            background: linear-gradient(115deg, #243d5a, #42698b);
        }

        .save-button:active {
            transform: translateY(-1px) scale(.99);
        }

        .save-button:disabled {
            opacity: .55;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .save-button i,
        .save-button span {
            position: relative;
            z-index: 1;
        }

        .cancel-button {
            min-height: 55px;
            padding: 0 23px;
            border: 1px solid var(--border);
            border-radius: 12px;
            color: var(--navy);
            background: var(--white);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 12px;
            font-weight: 800;
            transition: all .25s ease;
        }

        .cancel-button:hover {
            border-color: var(--red);
            color: var(--red);
            background: #fff7f6;
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(196,72,72,.08);
        }

        /* SIDE PANEL */

        .side-column {
            position: sticky;
            top: 100px;
        }

        .side-card {
            padding: 22px;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 17px;
            box-shadow: var(--shadow);
            margin-bottom: 17px;
        }

        .side-title {
            color: var(--navy);
            font-family: 'Manrope', sans-serif;
            font-size: 14px;
            font-weight: 800;
            margin-bottom: 16px;
        }

        .breakdown-row {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            padding: 13px 0;
            border-bottom: 1px solid #f0f0ed;
            font-size: 11px;
        }

        .breakdown-row:last-child {
            border-bottom: 0;
        }

        .breakdown-label {
            color: var(--muted);
        }

        .breakdown-value {
            color: var(--navy);
            font-weight: 800;
            text-align: right;
            overflow-wrap: anywhere;
        }

        .side-tip {
            background: linear-gradient(145deg, var(--navy-dark), #294664);
            color: var(--white);
            border-radius: 16px;
            padding: 21px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 8px 20px rgba(28,48,73,.14);
        }

        .side-tip::after {
            content: "";
            width: 110px;
            height: 110px;
            border: 1px solid rgba(255,255,255,.1);
            border-radius: 50%;
            position: absolute;
            right: -45px;
            bottom: -60px;
        }

        .tip-icon {
            width: 37px;
            height: 37px;
            border-radius: 11px;
            display: grid;
            place-items: center;
            background: rgba(255,255,255,.12);
            color: var(--gold-light);
            margin-bottom: 13px;
        }

        .tip-title {
            font-size: 13px;
            font-weight: 800;
            margin-bottom: 7px;
        }

        .tip-text {
            color: #cbd5df;
            font-size: 11px;
            line-height: 1.7;
        }

        .security-note {
            display: flex;
            gap: 9px;
            align-items: flex-start;
            color: var(--muted);
            font-size: 10px;
            line-height: 1.6;
            padding: 5px 3px;
        }

        .security-note i {
            color: var(--green);
            margin-top: 2px;
        }

        .footer {
            border-top: 1px solid var(--border);
            padding: 23px 6%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            color: var(--muted);
            font-size: 10px;
            background: rgba(255,255,255,.55);
        }

        .footer-brand {
            color: var(--navy);
            font-weight: 800;
        }

        /* RECEIPT */

        .receipt-overlay {
            position: fixed;
            inset: 0;
            z-index: 200;
            padding: 20px;
            background: rgba(12, 25, 40, .7);
            backdrop-filter: blur(6px);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .receipt-modal {
            width: min(440px, 100%);
            max-height: 92vh;
            overflow-y: auto;
            background: var(--white);
            border-radius: 20px;
            padding: 27px;
            box-shadow: 0 25px 70px rgba(0,0,0,.25);
            animation: appear .25s ease;
        }

        .receipt-success-icon {
            width: 61px;
            height: 61px;
            border-radius: 50%;
            background: #eaf7ef;
            color: var(--green);
            display: grid;
            place-items: center;
            font-size: 25px;
            margin: 0 auto 13px;
        }

        .receipt-heading {
            color: var(--navy);
            text-align: center;
            font-family: 'Manrope', sans-serif;
            font-size: 21px;
            font-weight: 800;
        }

        .receipt-store {
            color: var(--navy-soft);
            text-align: center;
            font-size: 12px;
            font-weight: 800;
            margin-top: 5px;
        }

        .receipt-date {
            color: var(--muted);
            text-align: center;
            font-size: 10px;
            margin-top: 4px;
        }

        .receipt-divider {
            border-top: 1px dashed #d9d9d3;
            margin: 19px 0;
        }

        .receipt-line {
            display: flex;
            justify-content: space-between;
            gap: 13px;
            margin: 12px 0;
            font-size: 11px;
        }

        .receipt-line span:first-child {
            color: var(--muted);
        }

        .receipt-line span:last-child {
            color: var(--navy);
            font-weight: 800;
            text-align: right;
            overflow-wrap: anywhere;
        }

        .receipt-total {
            color: var(--navy);
            font-family: 'Manrope', sans-serif;
            font-size: 22px;
            font-weight: 800;
        }

        .receipt-actions {
            display: flex;
            gap: 10px;
            margin-top: 21px;
        }

        .receipt-actions button {
            min-height: 48px;
            flex: 1;
            border-radius: 11px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 800;
            transition: .2s;
        }

        .print-button {
            border: 1px solid var(--border);
            background: var(--cream);
            color: var(--navy);
        }

        .print-button:hover {
            background: var(--gold-light);
            border-color: var(--gold);
            transform: translateY(-2px);
        }

        .done-button {
            border: 0;
            background: linear-gradient(115deg, var(--navy), #355b7e);
            color: var(--white);
            box-shadow: 0 5px 12px rgba(28,48,73,.17);
        }

        .done-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 17px rgba(28,48,73,.22);
        }

        @media (max-width: 850px) {
            .layout {
                grid-template-columns: 1fr;
            }

            .side-column {
                position: static;
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 15px;
            }

            .side-card {
                margin: 0;
            }

            .side-tip {
                min-height: 100%;
            }

            .security-note {
                grid-column: 1 / -1;
            }
        }

        @media (max-width: 600px) {
            .topbar {
                height: 65px;
                padding: 0 5%;
            }

            .brand-logo {
                width: 38px;
                height: 38px;
            }

            .brand-name {
                font-size: 17px;
            }

            .secure-label {
                padding: 8px 10px;
                font-size: 10px;
            }

            .page {
                width: 92%;
                margin-top: 25px;
            }

            .page-heading {
                align-items: flex-start;
            }

            .page-heading .back-link {
                padding: 11px;
                font-size: 0;
            }

            .page-heading .back-link i {
                font-size: 14px;
            }

            .card-header {
                padding: 17px;
            }

            .card-body {
                padding: 17px;
            }

            .balance-panel {
                padding: 21px;
            }

            .method-options {
                gap: 7px;
            }

            .method-option label {
                min-height: 85px;
            }

            .method-option label span {
                font-size: 10px;
            }

            .quick-options {
                gap: 8px;
            }

            .quick-button {
                padding: 10px 8px;
                gap: 7px;
            }

            .quick-text {
                font-size: 10px;
            }

            .side-column {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column-reverse;
                padding: 14px;
            }

            .save-button,
            .cancel-button {
                width: 100%;
            }

            .footer {
                flex-direction: column;
                text-align: center;
                padding: 20px;
            }

            .receipt-actions {
                flex-direction: column;
            }
        }

        @media print {
            body * {
                visibility: hidden !important;
            }

            .receipt-modal,
            .receipt-modal * {
                visibility: visible !important;
            }

            .receipt-overlay {
                position: absolute;
                inset: 0;
                padding: 0;
                background: white;
                display: block;
            }

            .receipt-modal {
                width: 100%;
                max-width: 100%;
                max-height: none;
                overflow: visible;
                box-shadow: none;
                border-radius: 0;
            }

            .receipt-actions {
                display: none !important;
            }
        }
    </style>
</head>

<body>

<header class="topbar">
    <a href="{{ url('/') }}" class="brand">
        <div class="brand-logo">
            <i class="fa-solid fa-chart-simple"></i>
        </div>
        <div class="brand-name">Track<span>&</span>Tally</div>
    </a>

    <div class="topbar-right">
        <div class="secure-label">
            <i class="fa-solid fa-shield-halved"></i>
            Secure Transaction
        </div>
    </div>
</header>

<main class="page">

    <div class="breadcrumb">
        <a href="{{ url('/dashboard') }}">Dashboard</a>
        <i class="fa-solid fa-chevron-right" style="font-size:9px;"></i>
        <a href="{{ url('/debtors') }}">Debtors</a>
        <i class="fa-solid fa-chevron-right" style="font-size:9px;"></i>
        <span>Record Payment</span>
    </div>

    <div class="page-heading">
        <div>
            <div class="eyebrow">DEBTOR MANAGEMENT</div>
            <h1 class="page-title">Record Payment</h1>
            <p class="page-subtitle">
                Record and manage payments received from your customer.
            </p>
        </div>

        <a href="{{ route('debtors.show', $debtor->id) }}" class="back-link">
            <i class="fa-solid fa-arrow-left"></i>
            Back to Debtor
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fa-solid fa-circle-check"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-error">
            <i class="fa-solid fa-circle-exclamation"></i>
            <div>
                <strong>Please check the following:</strong>
                <ul style="padding-left:17px; margin-top:5px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="layout">

        <div class="main-column">

            <form
                action="{{ route('debtors.payments.store', ['debtorId' => $debtor->id]) }}"
                method="POST"
                id="paymentForm"
            >
                @csrf

                <section class="card">
                    <div class="card-header">
                        <div class="card-heading">
                            <div class="card-icon">
                                <i class="fa-solid fa-wallet"></i>
                            </div>
                            <div>
                                <div class="card-title">Payment Details</div>
                                <div class="card-description">Enter the payment information below</div>
                            </div>
                        </div>
                        <span class="required-tag">Required fields</span>
                    </div>

                    <div class="card-body">

                        <div class="debtor-strip">
                            <div class="debtor-avatar">
                                <i class="fa-solid fa-user"></i>
                            </div>

                            <div class="debtor-info">
                                <div class="debtor-label">Receiving payment from</div>
                                <div class="debtor-name">{{ $debtor->full_name }}</div>
                                <div class="debtor-contact">
                                    {{ $debtor->contact_number ?: 'No contact number provided' }}
                                </div>
                            </div>

                            <div class="verified">
                                <i class="fa-solid fa-circle-check"></i>
                                Debtor
                            </div>
                        </div>

                        <div class="balance-panel">
                            <div class="balance-top">
                                <div class="balance-label">CURRENT OUTSTANDING BALANCE</div>
                                <div class="balance-symbol">
                                    <i class="fa-solid fa-money-bill-wave"></i>
                                </div>
                            </div>

                            <div class="balance-amount">
                                ₱{{ number_format($balance, 2) }}
                            </div>

                            <div class="balance-bottom">
                                <i class="fa-solid fa-circle-info"></i>
                                Total amount the customer still needs to pay
                            </div>
                        </div>

                        <div class="field">
                            <label for="amount" class="field-label">
                                <span>Amount Paid <span style="color:var(--red)">*</span></span>
                                <small>PHP / Philippine Peso</small>
                            </label>

                            <div class="input-wrap">
                                <div class="currency">₱</div>
                                <input
                                    type="number"
                                    name="amount"
                                    id="amount"
                                    class="amount-input"
                                    placeholder="0.00"
                                    min="0.01"
                                    max="{{ number_format($balance, 2, '.', '') }}"
                                    step="0.01"
                                    value="{{ old('amount') }}"
                                    required
                                >
                            </div>

                            @error('amount')
                                <div class="error-message">{{ $message }}</div>
                            @enderror

                            <div id="amountWarning" class="error-message" style="display:none;"></div>

                            @if($balance > 0)
                                <div style="margin-top:17px;">
                                    <div class="quick-heading">
                                        <i class="fa-solid fa-bolt"></i>
                                        Quick payment amount
                                    </div>

                                    <div class="quick-options">
                                        <button
                                            type="button"
                                            class="quick-button"
                                            data-amount="{{ number_format($balance, 2, '.', '') }}"
                                        >
                                            <span class="quick-icon">
                                                <i class="fa-solid fa-check-double"></i>
                                            </span>
                                            <span class="quick-text">
                                                Pay Full Balance
                                                <span class="quick-value">
                                                    ₱{{ number_format($balance, 2) }}
                                                </span>
                                            </span>
                                        </button>

                                        <button
                                            type="button"
                                            class="quick-button"
                                            data-amount="{{ number_format($balance / 2, 2, '.', '') }}"
                                        >
                                            <span class="quick-icon">
                                                <i class="fa-solid fa-coins"></i>
                                            </span>
                                            <span class="quick-text">
                                                Pay Half
                                                <span class="quick-value">
                                                    ₱{{ number_format($balance / 2, 2) }}
                                                </span>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </section>

                <section class="card">
                    <div class="card-header">
                        <div class="card-heading">
                            <div class="card-icon">
                                <i class="fa-solid fa-credit-card"></i>
                            </div>
                            <div>
                                <div class="card-title">Payment Method</div>
                                <div class="card-description">Select how the payment was received</div>
                            </div>
                        </div>
                        <span class="required-tag">Required</span>
                    </div>

                    <div class="card-body">

                        <div class="field">
                            <label class="field-label">
                                <span>Choose Payment Method <span style="color:var(--red)">*</span></span>
                            </label>

                            <div class="method-options">

                                <div class="method-option">
                                    <input
                                        type="radio"
                                        name="payment_method"
                                        id="method_cash"
                                        value="cash"
                                        {{ old('payment_method', 'cash') === 'cash' ? 'checked' : '' }}
                                    >
                                    <label for="method_cash">
                                        <i class="fa-solid fa-money-bill-wave"></i>
                                        <span>Cash</span>
                                    </label>
                                </div>

                                <div class="method-option">
                                    <input
                                        type="radio"
                                        name="payment_method"
                                        id="method_wallet"
                                        value="e_wallet"
                                        {{ old('payment_method') === 'e_wallet' ? 'checked' : '' }}
                                    >
                                    <label for="method_wallet">
                                        <i class="fa-solid fa-mobile-screen-button"></i>
                                        <span>E-wallet</span>
                                    </label>
                                </div>

                                <div class="method-option">
                                    <input
                                        type="radio"
                                        name="payment_method"
                                        id="method_banking"
                                        value="e_banking"
                                        {{ old('payment_method') === 'e_banking' ? 'checked' : '' }}
                                    >
                                    <label for="method_banking">
                                        <i class="fa-solid fa-building-columns"></i>
                                        <span>E-banking</span>
                                    </label>
                                </div>

                            </div>

                            @error('payment_method')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="conditional-fields" id="walletFields">
                            <div class="field">
                                <label for="wallet_provider" class="field-label">
                                    <span>E-wallet Provider <span style="color:var(--red)">*</span></span>
                                </label>

                                <select
                                    name="wallet_provider"
                                    id="wallet_provider"
                                    class="select-input"
                                >
                                    <option value="GCash" {{ old('wallet_provider', 'GCash') === 'GCash' ? 'selected' : '' }}>GCash</option>
                                    <option value="Maya" {{ old('wallet_provider') === 'Maya' ? 'selected' : '' }}>Maya</option>
                                    <option value="Other" {{ old('wallet_provider') === 'Other' ? 'selected' : '' }}>Other</option>
                                </select>

                                @error('wallet_provider')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="field" id="customWalletField" style="display:none;">
                                <label for="custom_wallet" class="field-label">
                                    <span>Other E-wallet Name <span style="color:var(--red)">*</span></span>
                                </label>

                                <input
                                    type="text"
                                    name="custom_wallet"
                                    id="custom_wallet"
                                    class="regular-input"
                                    placeholder="Enter wallet provider name"
                                    value="{{ old('custom_wallet') }}"
                                    maxlength="100"
                                >

                                @error('custom_wallet')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="conditional-fields" id="bankingFields">
                            <div class="field">
                                <label for="payment_provider" class="field-label">
                                    <span>Bank / Payment Provider</span>
                                    <small>Optional</small>
                                </label>

                                <input
                                    type="text"
                                    name="payment_provider"
                                    id="payment_provider"
                                    class="regular-input"
                                    placeholder="Example: BDO, BPI, UnionBank"
                                    value="{{ old('payment_provider') }}"
                                    maxlength="100"
                                >

                                @error('payment_provider')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="conditional-fields" id="referenceFields">
                            <div class="field">
                                <label for="payment_reference" class="field-label">
                                    <span>Transaction Reference Number</span>
                                    <small>Optional</small>
                                </label>

                                <input
                                    type="text"
                                    name="payment_reference"
                                    id="payment_reference"
                                    class="regular-input"
                                    placeholder="Enter transaction reference"
                                    value="{{ old('payment_reference') }}"
                                    maxlength="150"
                                    autocomplete="off"
                                >

                                @error('payment_reference')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                </section>

                <section class="card">
                    <div class="card-header">
                        <div class="card-heading">
                            <div class="card-icon">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </div>
                            <div>
                                <div class="card-title">Payment Note</div>
                                <div class="card-description">Add additional information about this payment</div>
                            </div>
                        </div>

                        <span class="required-tag" style="background:#f1f2f3;color:#737d89;">
                            Optional
                        </span>
                    </div>

                    <div class="card-body">
                        <div class="field">
                            <label for="description" class="field-label">
                                <span>Description / Note</span>
                            </label>

                            <textarea
                                name="description"
                                id="description"
                                class="note-input"
                                placeholder="Example: Partial payment, payment received at the store, or other details..."
                                maxlength="500"
                            >{{ old('description') }}</textarea>

                            @error('description')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </section>

                <div class="summary-card">
                    <div class="summary-icon">
                        <i class="fa-solid fa-receipt"></i>
                    </div>
                    <div>
                        <div class="summary-title">Ready to record this payment?</div>
                        <div class="summary-description">
                            The payment will be saved to this customer's transaction
                            history and deducted from their outstanding balance.
                            Please review the amount before continuing.
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <a
                        href="{{ route('debtors.show', $debtor->id) }}"
                        class="cancel-button"
                    >
                        <i class="fa-solid fa-xmark"></i>
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="save-button"
                        id="saveButton"
                        {{ $balance <= 0 ? 'disabled' : '' }}
                    >
                        <i class="fa-solid fa-shield-halved"></i>
                        <span id="saveButtonText">
                            {{ $balance <= 0 ? 'No Outstanding Balance' : 'Save Payment' }}
                        </span>
                    </button>
                </div>

            </form>
        </div>

        <aside class="side-column">

            <div class="side-card">
                <div class="side-title">
                    <i class="fa-solid fa-chart-pie" style="color:var(--gold); margin-right:7px;"></i>
                    Payment Overview
                </div>

                <div class="breakdown-row">
                    <span class="breakdown-label">Customer</span>
                    <span class="breakdown-value">{{ $debtor->full_name }}</span>
                </div>

                <div class="breakdown-row">
                    <span class="breakdown-label">Outstanding balance</span>
                    <span class="breakdown-value">
                        ₱{{ number_format($balance, 2) }}
                    </span>
                </div>

                <div class="breakdown-row">
                    <span class="breakdown-label">Payment status</span>
                    <span
                        class="breakdown-value"
                        style="color:{{ $balance > 0 ? '#b17d24' : '#23845b' }};"
                    >
                        {{ $balance > 0 ? 'Unpaid' : 'Fully Paid' }}
                    </span>
                </div>

                <div class="breakdown-row">
                    <span class="breakdown-label">Currency</span>
                    <span class="breakdown-value">PHP (₱)</span>
                </div>
            </div>

            <div class="side-tip">
                <div class="tip-icon">
                    <i class="fa-solid fa-lightbulb"></i>
                </div>
                <div class="tip-title">Payment reminder</div>
                <div class="tip-text">
                    Always verify the amount received before saving.
                    For digital payments, keep the transaction reference
                    number for easier verification.
                </div>
            </div>

            <div class="security-note">
                <i class="fa-solid fa-lock"></i>
                <span>
                    This transaction is associated with your Track&Tally
                    account and the selected debtor.
                </span>
            </div>

        </aside>
    </div>
</main>

<footer class="footer">
    <div class="footer-brand">Track<span>&</span>Tally</div>
    <div>Organized records. Better business decisions.</div>
    <div>&copy; {{ date('Y') }} Track&Tally. All rights reserved.</div>
</footer>

@if(session('payment_receipt'))
    @php
        $receipt = session('payment_receipt');

        $methodLabels = [
            'cash' => 'Cash',
            'e_wallet' => 'E-wallet',
            'e_banking' => 'E-banking',
        ];

        $receiptMethod = $methodLabels[$receipt['payment_method']] ?? 'Payment';
    @endphp

    <div class="receipt-overlay" id="receiptOverlay">
        <div class="receipt-modal" id="receiptModal">

            <div class="receipt-success-icon">
                <i class="fa-solid fa-check"></i>
            </div>

            <h2 class="receipt-heading">Payment Recorded!</h2>

            <div class="receipt-store">
                {{ $receipt['store_name'] ?? 'Track&Tally' }}
            </div>

            <div class="receipt-date">
                {{ $receipt['date'] ?? now()->format('M d, Y h:i A') }}
            </div>

            <div class="receipt-divider"></div>

            <div class="receipt-line">
                <span>Received from</span>
                <span>{{ $receipt['debtor_name'] ?? $debtor->full_name }}</span>
            </div>

            <div class="receipt-line">
                <span>Payment method</span>
                <span>
                    {{ $receiptMethod }}
                    @if(!empty($receipt['provider']))
                        · {{ $receipt['provider'] }}
                    @endif
                </span>
            </div>

            @if(!empty($receipt['reference']))
                <div class="receipt-line">
                    <span>Reference number</span>
                    <span>{{ $receipt['reference'] }}</span>
                </div>
            @endif

            @if(!empty($receipt['description']))
                <div class="receipt-line">
                    <span>Note</span>
                    <span>{{ $receipt['description'] }}</span>
                </div>
            @endif

            <div class="receipt-divider"></div>

            <div class="receipt-line">
                <span>Amount paid</span>
                <span class="receipt-total">
                    ₱{{ number_format((float)($receipt['amount'] ?? 0), 2) }}
                </span>
            </div>

            <div class="receipt-line">
                <span>Remaining balance</span>
                <span>
                    ₱{{ number_format((float)($receipt['balance_after'] ?? 0), 2) }}
                </span>
            </div>

            <div class="receipt-divider"></div>

            <div style="text-align:center;color:var(--muted);font-size:10px;">
                Thank you for your payment!
            </div>

            <div class="receipt-actions">
                <button type="button" class="print-button" onclick="window.print()">
                    <i class="fa-solid fa-print"></i>
                    Print / PDF
                </button>

                <button
                    type="button"
                    class="done-button"
                    onclick="window.location.href='{{ route('debtors.show', $debtor->id) }}'"
                >
                    <i class="fa-solid fa-check"></i>
                    Done
                </button>
            </div>

        </div>
    </div>
@endif

<script>
document.addEventListener('DOMContentLoaded', function () {

    const amountInput = document.getElementById('amount');
    const amountWarning = document.getElementById('amountWarning');
    const saveButton = document.getElementById('saveButton');
    const saveButtonText = document.getElementById('saveButtonText');

    const balance = Number(@json((float) $balance));

    const walletFields = document.getElementById('walletFields');
    const referenceFields = document.getElementById('referenceFields');
    const bankingFields = document.getElementById('bankingFields');

    const walletProvider = document.getElementById('wallet_provider');
    const customWalletField = document.getElementById('customWalletField');
    const customWalletInput = document.getElementById('custom_wallet');

    const paymentForm = document.getElementById('paymentForm');

    let submitting = false;

    // QUICK PAYMENT BUTTONS
    document.querySelectorAll('.quick-button').forEach(function (button) {
        button.addEventListener('click', function () {
            amountInput.value = this.dataset.amount;
            validateAmount();
            amountInput.focus();
        });
    });

    // AMOUNT VALIDATION
    function validateAmount() {
        const amount = Number(amountInput.value);

        amountWarning.style.display = 'none';
        amountWarning.textContent = '';

        if (amountInput.value === '') {
            saveButton.disabled = balance <= 0;
            saveButtonText.textContent =
                balance <= 0 ? 'No Outstanding Balance' : 'Save Payment';
            return false;
        }

        if (!Number.isFinite(amount) || amount <= 0) {
            amountWarning.textContent = 'Enter an amount greater than zero.';
            amountWarning.style.display = 'block';
            saveButton.disabled = true;
            return false;
        }

        if (amount > balance) {
            amountWarning.textContent =
                'Payment cannot exceed the outstanding balance of ₱' +
                balance.toLocaleString('en-PH', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }) + '.';

            amountWarning.style.display = 'block';
            saveButton.disabled = true;
            return false;
        }

        saveButton.disabled = balance <= 0;
        saveButtonText.textContent =
            balance <= 0 ? 'No Outstanding Balance' : 'Save Payment';

        return true;
    }

    amountInput.addEventListener('input', validateAmount);

    // PAYMENT METHOD DISPLAY
    function updatePaymentFields() {
        const selected = document.querySelector(
            'input[name="payment_method"]:checked'
        );

        const method = selected ? selected.value : 'cash';

        walletFields.classList.toggle('show', method === 'e_wallet');
        referenceFields.classList.toggle(
            'show',
            method === 'e_wallet' || method === 'e_banking'
        );
        bankingFields.classList.toggle('show', method === 'e_banking');

        if (method !== 'e_wallet') {
            walletFields.classList.remove('show');
        }

        if (method !== 'e_banking') {
            bankingFields.classList.remove('show');
        }

        if (method !== 'e_wallet' && method !== 'e_banking') {
            referenceFields.classList.remove('show');
        }
    }

    document.querySelectorAll('input[name="payment_method"]').forEach(function (radio) {
        radio.addEventListener('change', updatePaymentFields);
    });

    // CUSTOM WALLET
    function updateCustomWallet() {
        if (!walletProvider) return;

        const isOther = walletProvider.value === 'Other';

        customWalletField.style.display = isOther ? 'block' : 'none';
        customWalletInput.required = isOther;
        customWalletInput.disabled = !isOther;
    }

    if (walletProvider) {
        walletProvider.addEventListener('change', updateCustomWallet);
        updateCustomWallet();
    }

    updatePaymentFields();
    validateAmount();

    // PREVENT DOUBLE SUBMISSION
    paymentForm.addEventListener('submit', function (event) {

        if (submitting) {
            event.preventDefault();
            return;
        }

        if (!validateAmount()) {
            event.preventDefault();
            amountInput.focus();
            return;
        }

        const selectedMethod = document.querySelector(
            'input[name="payment_method"]:checked'
        );

        if (!selectedMethod) {
            event.preventDefault();
            alert('Please select a payment method.');
            return;
        }

        if (
            selectedMethod.value === 'e_wallet' &&
            walletProvider.value === 'Other' &&
            !customWalletInput.value.trim()
        ) {
            event.preventDefault();
            alert('Please enter the name of the e-wallet provider.');
            customWalletInput.focus();
            return;
        }

        submitting = true;
        saveButton.disabled = true;
        saveButtonText.textContent = 'Saving Payment...';
    });

});
</script>

</body>
</html>
