<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Debtor | Track&Tally</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --navy: #172D48;
            --navy-light: #294663;
            --gold: #D5AD52;
            --gold-light: #F6E9C6;
            --cream: #F6F5F0;
            --white: #FFFFFF;
            --text: #29384B;
            --muted: #8792A0;
            --border: #E9E7DF;
            --green: #25835D;
            --red: #B94C48;
            --shadow: 0 12px 35px rgba(23,45,72,.055);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            background:
                radial-gradient(circle at 5% 5%, rgba(213,173,82,.10), transparent 23%),
                radial-gradient(circle at 95% 40%, rgba(41,70,99,.05), transparent 25%),
                var(--cream);
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
        }

        button, input, textarea {
            font: inherit;
        }

        a {
            text-decoration: none;
        }

        /* HEADER */

        .topbar {
            height: 76px;
            padding: 0 6%;
            background: rgba(255,255,255,.94);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
            backdrop-filter: blur(15px);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--navy);
            font-family: 'Manrope', sans-serif;
            font-size: 21px;
            font-weight: 800;
            letter-spacing: -.7px;
        }

        .brand img {
            width: 43px;
            height: 43px;
            object-fit: contain;
            border-radius: 12px;
        }

        .brand span {
            color: var(--gold);
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
            color: var(--muted);
            font-size: 12px;
            font-weight: 700;
        }

        .secure {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 9px 14px;
            border-radius: 30px;
            background: #EDF6F0;
            border: 1px solid #DCEDE2;
            color: var(--green);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .5px;
        }

        .secure-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #42A777;
        }

        /* MAIN PAGE */

        .page {
            width: min(1160px, 92%);
            margin: 35px auto 65px;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 25px;
            color: #A0A7AF;
            font-size: 12px;
        }

        .breadcrumb a {
            color: var(--navy);
            font-weight: 800;
        }

        .breadcrumb a:hover {
            color: #B58A2D;
        }

        .page-heading {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 25px;
        }

        .eyebrow {
            display: flex;
            align-items: center;
            gap: 9px;
            color: #B28C3A;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 2px;
            margin-bottom: 10px;
        }

        .eyebrow::before {
            content: "";
            width: 23px;
            height: 2px;
            background: var(--gold);
            border-radius: 5px;
        }

        h1 {
            color: var(--navy);
            font-family: 'Manrope', sans-serif;
            font-size: clamp(27px, 4vw, 36px);
            font-weight: 800;
            letter-spacing: -1.2px;
        }

        .heading-description {
            margin-top: 8px;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.6;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 12px 17px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 12px;
            color: var(--navy);
            font-size: 12px;
            font-weight: 800;
            transition: .2s;
            white-space: nowrap;
        }

        .back-button:hover {
            border-color: var(--gold);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(23,45,72,.06);
        }

        /* WELCOME BANNER */

        .hero {
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 30px 34px;
            margin-bottom: 27px;
            border-radius: 21px;
            color: white;
            background: linear-gradient(115deg, #172D48, #294966);
            box-shadow: 0 14px 32px rgba(23,45,72,.13);
        }

        .hero::before,
        .hero::after {
            content: "";
            position: absolute;
            border: 1px solid rgba(245,232,195,.14);
            border-radius: 50%;
            pointer-events: none;
        }

        .hero::before {
            width: 280px;
            height: 280px;
            right: -65px;
            top: -190px;
            box-shadow: 0 0 0 30px rgba(255,255,255,.018),
                        0 0 0 60px rgba(255,255,255,.015);
        }

        .hero::after {
            width: 130px;
            height: 130px;
            right: 260px;
            bottom: -100px;
        }

        .hero-left {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .hero-icon {
            width: 58px;
            height: 58px;
            flex-shrink: 0;
            display: grid;
            place-items: center;
            border-radius: 17px;
            color: #F3D98F;
            background: rgba(213,173,82,.17);
            border: 1px solid rgba(245,232,195,.25);
            font-size: 25px;
        }

        .hero h2 {
            font-family: 'Manrope', sans-serif;
            font-size: 19px;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .hero p {
            max-width: 650px;
            color: rgba(255,255,255,.72);
            font-size: 12px;
            line-height: 1.7;
        }

        .hero-label {
            position: relative;
            z-index: 1;
            padding: 10px 14px;
            border: 1px solid rgba(255,255,255,.15);
            border-radius: 10px;
            background: rgba(255,255,255,.08);
            color: #F3D98F;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .8px;
            white-space: nowrap;
        }

        /* ALERTS */

        .alert {
            padding: 15px 18px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 12px;
            font-weight: 600;
            line-height: 1.7;
        }

        .alert-success {
            color: #24734E;
            background: #EDF7F0;
            border: 1px solid #D5EBDC;
        }

        .alert-error {
            color: #A63D38;
            background: #FFF1F0;
            border: 1px solid #F1D6D3;
        }

        .alert ul {
            padding-left: 20px;
            margin-top: 7px;
        }

        /* FORM LAYOUT */

        .form-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 325px;
            gap: 24px;
            align-items: start;
        }

        .main-column,
        .side-column {
            display: grid;
            gap: 23px;
            min-width: 0;
        }

        /* CARDS */

        .card {
            padding: 27px;
            background: rgba(255,255,255,.97);
            border: 1px solid var(--border);
            border-radius: 19px;
            box-shadow: var(--shadow);
            transition: .25s;
        }

        .card:hover {
            border-color: #E5D7B3;
            box-shadow: 0 16px 38px rgba(23,45,72,.075);
        }

        .section-heading {
            display: flex;
            align-items: center;
            gap: 13px;
            padding-bottom: 19px;
            margin-bottom: 23px;
            border-bottom: 1px solid #F0EFEA;
        }

        .section-icon {
            width: 44px;
            height: 44px;
            flex-shrink: 0;
            display: grid;
            place-items: center;
            border-radius: 14px;
            color: #A37E2D;
            background: linear-gradient(145deg, #FBF5E5, #F4EACD);
            border: 1px solid #F0E5C9;
            font-size: 19px;
        }

        .section-heading h3 {
            color: var(--navy);
            font-family: 'Manrope', sans-serif;
            font-size: 15px;
            font-weight: 800;
        }

        .section-heading p {
            color: var(--muted);
            font-size: 11px;
            margin-top: 4px;
        }

        .section-number {
            margin-left: auto;
            color: #B2A98F;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .5px;
        }

        /* INPUTS */

        .field-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 21px;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 8px;
            min-width: 0;
        }

        .field.full {
            grid-column: 1 / -1;
        }

        .field label,
        .credit-box label {
            color: var(--navy);
            font-size: 11px;
            font-weight: 800;
        }

        .required {
            color: var(--red);
        }

        .input-wrap {
            position: relative;
        }

        .field-symbol {
            position: absolute;
            top: 50%;
            left: 14px;
            transform: translateY(-50%);
            color: #A48B54;
            font-size: 15px;
            pointer-events: none;
        }

        input,
        textarea {
            width: 100%;
            outline: none;
            border: 1px solid #E8E7E1;
            border-radius: 11px;
            background: #FCFBF8;
            padding: 14px;
            color: var(--text);
            font-size: 12px;
            transition: .2s;
        }

        .input-wrap input {
            padding-left: 42px;
        }

        input:focus,
        textarea:focus {
            border-color: #D6B45F;
            background: white;
            box-shadow: 0 0 0 4px rgba(213,173,82,.12);
        }

        input::placeholder,
        textarea::placeholder {
            color: #A9AFB7;
        }

        textarea {
            min-height: 115px;
            resize: vertical;
            line-height: 1.7;
        }

        .field-hint {
            color: #9AA2AC;
            font-size: 10px;
            line-height: 1.6;
        }

        /* PROFILE PHOTO */

        .photo-card {
            text-align: center;
        }

        .photo-card .section-heading {
            text-align: left;
        }

        .photo-preview {
            width: 148px;
            height: 148px;
            padding: 5px;
            margin: 8px auto 18px;
            border-radius: 50%;
            background: linear-gradient(145deg, #E9D18C, #C69A3B);
            box-shadow: 0 7px 20px rgba(198,154,59,.15);
        }

        .photo-preview-inner {
            width: 100%;
            height: 100%;
            display: grid;
            place-items: center;
            overflow: hidden;
            border-radius: 50%;
            background: #F8F6EF;
        }

        .photo-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: none;
        }

        .photo-placeholder {
            color: #B99B59;
            font-size: 43px;
        }

        .photo-label {
            display: block;
            margin-bottom: 6px;
            color: var(--navy);
            font-size: 13px;
            font-weight: 800;
        }

        .photo-description {
            margin-bottom: 17px;
            color: var(--muted);
            font-size: 10px;
            line-height: 1.6;
        }

        /* UPLOAD BUTTONS */

        .upload-button {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 9px;
            width: 100%;
            padding: 13px;
            border-radius: 11px;
            color: white;
            background: var(--navy);
            cursor: pointer;
            font-size: 11px;
            font-weight: 800;
            transition: .2s;
        }

        .upload-button:hover {
            background: var(--navy-light);
            box-shadow: 0 7px 15px rgba(23,45,72,.13);
            transform: translateY(-1px);
        }

        .upload-button input {
            display: none;
        }

        .remove-photo {
            display: none;
            border: 0;
            background: none;
            color: var(--red);
            cursor: pointer;
            font-size: 10px;
            font-weight: 800;
            margin-top: 12px;
        }

        .remove-photo:hover {
            text-decoration: underline;
        }

        /* ID IMAGE */

        .id-preview {
            width: 100%;
            aspect-ratio: 1.65 / 1;
            display: grid;
            place-items: center;
            overflow: hidden;
            margin-bottom: 16px;
            border: 1px dashed #D9D4C5;
            border-radius: 14px;
            color: #A48B54;
            background: linear-gradient(145deg, #FCFBF7, #F7F5EF);
        }

        .id-preview img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            display: none;
        }

        .id-placeholder {
            text-align: center;
            font-size: 33px;
        }

        .id-placeholder small {
            display: block;
            margin-top: 8px;
            color: var(--muted);
            font-size: 10px;
        }

        /* CREDIT SETTINGS */

        .credit-box {
            padding: 20px;
            border: 1px solid #EFE3C4;
            border-radius: 15px;
            background: linear-gradient(145deg, #FCF8ED, #F8F2E1);
        }

        .credit-box label {
            display: block;
            margin-bottom: 11px;
        }

        .currency-wrap {
            position: relative;
        }

        .currency-symbol {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #A47D2B;
            font-size: 14px;
            font-weight: 800;
        }

        .currency-wrap input {
            padding-left: 38px;
            background: white;
            color: var(--navy);
            font-size: 17px;
            font-weight: 800;
        }

        .credit-caption {
            margin-top: 11px;
            color: #93845F;
            font-size: 10px;
            line-height: 1.6;
        }

        /* SAVE PANEL */

        .save-card {
            position: sticky;
            top: 98px;
            border-color: #E9D9AE;
            background: linear-gradient(155deg, #FFFFFF 65%, #FCF8ED);
        }

        .ready {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 11px;
            border-radius: 30px;
            color: var(--green);
            background: #EDF7F0;
            border: 1px solid #DDEDE2;
            font-size: 9px;
            font-weight: 800;
            letter-spacing: .5px;
        }

        .ready-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #3DA274;
        }

        .save-title {
            margin: 16px 0 7px;
            color: var(--navy);
            font-family: 'Manrope', sans-serif;
            font-size: 18px;
            font-weight: 800;
        }

        .save-description {
            margin-bottom: 20px;
            color: var(--muted);
            font-size: 11px;
            line-height: 1.7;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            padding: 12px 0;
            border-bottom: 1px solid #F0EDE4;
            color: #8A929B;
            font-size: 10px;
        }

        .summary-item strong {
            color: var(--navy);
            font-size: 11px;
        }

        .completion {
            margin: 20px 0;
        }

        .completion-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 9px;
            color: #7F8995;
            font-size: 10px;
            font-weight: 700;
        }

        .completion-top strong {
            color: var(--navy);
        }

        .progress-track {
            height: 6px;
            overflow: hidden;
            border-radius: 20px;
            background: #EEECE5;
        }

        .progress-fill {
            width: 0%;
            height: 100%;
            border-radius: inherit;
            background: linear-gradient(90deg, #D5AD52, #E8C96E);
            transition: width .3s;
        }

        .save-button {
            width: 100%;
            min-height: 53px;
            border: 0;
            border-radius: 12px;
            color: var(--navy);
            background: linear-gradient(135deg, #F0D78F, #D5AD52);
            font-size: 13px;
            font-weight: 900;
            cursor: pointer;
            box-shadow: 0 8px 17px rgba(213,173,82,.22);
            transition: .2s;
        }

        .save-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 11px 22px rgba(213,173,82,.3);
        }

        .save-button:disabled {
            opacity: .65;
            cursor: wait;
            transform: none;
        }

        .cancel-button {
            display: block;
            padding: 15px 10px 5px;
            text-align: center;
            color: #8993A0;
            font-size: 11px;
            font-weight: 700;
            transition: .2s;
        }

        .cancel-button:hover {
            color: var(--navy);
        }

        .security-note {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-top: 19px;
            padding-top: 16px;
            border-top: 1px solid #EEEAE0;
            color: #929BA5;
            font-size: 9px;
            line-height: 1.7;
        }

        .security-note span {
            color: var(--green);
            font-size: 14px;
        }

        /* FOOTER */

        .footer {
            margin-top: 36px;
            padding-top: 22px;
            border-top: 1px solid #E8E5DB;
            text-align: center;
            color: #A1A7AE;
            font-size: 10px;
        }

        /* RESPONSIVE */

        @media (max-width: 950px) {
            .form-layout {
                grid-template-columns: minmax(0, 1fr) 290px;
                gap: 17px;
            }

            .card {
                padding: 22px;
            }
        }

        @media (max-width: 780px) {
            .form-layout {
                grid-template-columns: 1fr;
            }

            .side-column {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                align-items: start;
            }

            .save-card {
                position: static;
                grid-column: 1 / -1;
            }
        }

        @media (max-width: 600px) {
            .topbar {
                height: 67px;
                padding: 0 4%;
            }

            .brand {
                font-size: 17px;
            }

            .brand img {
                width: 37px;
                height: 37px;
            }

            .header-right > span:first-child {
                display: none;
            }

            .secure {
                padding: 8px 10px;
                font-size: 8px;
            }

            .page {
                width: 92%;
                margin-top: 24px;
            }

            .page-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .back-button {
                padding: 10px 13px;
            }

            .hero {
                padding: 22px 19px;
            }

            .hero-left {
                align-items: flex-start;
            }

            .hero-icon {
                width: 45px;
                height: 45px;
                border-radius: 14px;
                font-size: 20px;
            }

            .hero-label {
                display: none;
            }

            .card {
                padding: 19px;
                border-radius: 16px;
            }

            .field-grid,
            .side-column {
                grid-template-columns: 1fr;
            }

            .field.full {
                grid-column: auto;
            }

            .save-card {
                grid-column: auto;
            }

            .section-heading {
                margin-bottom: 18px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                transition-duration: .01ms !important;
                animation-duration: .01ms !important;
            }
        }
    </style>
</head>

<body>

<header class="topbar">
    <a href="{{ url('/dashboard') }}" class="brand">
        <img src="{{ asset('icon.png') }}" alt="Track&Tally Logo">
        Track<span>&</span>Tally
    </a>

    <div class="header-right">
        <span>Customer Management</span>
        <span class="secure">
            <span class="secure-dot"></span>
            SECURE FORM
        </span>
    </div>
</header>

<main class="page">

    <nav class="breadcrumb">
        <a href="{{ route('debtors.index') }}">Debtors</a>
        <span>›</span>
        <span>New Debtor</span>
    </nav>

    <div class="page-heading">
        <div>
            <div class="eyebrow">CUSTOMER MANAGEMENT</div>
            <h1>Create debtor profile</h1>
            <p class="heading-description">
                Register a new customer and organize their information in one place.
            </p>
        </div>

        <a href="{{ route('debtors.index') }}" class="back-button">
            ← Back to Debtors
        </a>
    </div>

    <section class="hero">
        <div class="hero-left">
            <div class="hero-icon">✦</div>
            <div>
                <h2>Welcome a new customer</h2>
                <p>
                    Create a complete customer record. Add contact information,
                    identification, and a credit limit to manage customer transactions.
                </p>
            </div>
        </div>

        <div class="hero-label">TRACK & TALLY</div>
    </section>

    @if(session('success'))
        <div class="alert alert-success">
            ✓ {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-error">
            <strong>Please check the following information:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('debtors.store') }}"
        method="POST"
        enctype="multipart/form-data"
        id="debtorForm"
    >
        @csrf

        <div class="form-layout">

            <!-- LEFT COLUMN -->
            <div class="main-column">

                <!-- BASIC INFORMATION -->
                <section class="card">

                    <div class="section-heading">
                        <div class="section-icon">♙</div>
                        <div>
                            <h3>Basic Information</h3>
                            <p>Customer identity and contact details</p>
                        </div>
                        <span class="section-number">01 / 03</span>
                    </div>

                    <div class="field-grid">

                        <div class="field full">
                            <label>
                                Full name <span class="required">*</span>
                            </label>

                            <div class="input-wrap">
                                <span class="field-symbol">♙</span>
                                <input
                                    type="text"
                                    name="full_name"
                                    value="{{ old('full_name') }}"
                                    placeholder="Enter customer's complete name"
                                    maxlength="255"
                                    required
                                >
                            </div>
                        </div>

                        <div class="field">
                            <label>Contact number</label>

                            <div class="input-wrap">
                                <span class="field-symbol">☎</span>
                                <input
                                    type="tel"
                                    name="contact_number"
                                    value="{{ old('contact_number') }}"
                                    placeholder="09XX XXX XXXX"
                                >
                            </div>
                        </div>

                        <div class="field">
                            <label>ID number</label>

                            <div class="input-wrap">
                                <span class="field-symbol">▤</span>
                                <input
                                    type="text"
                                    name="id_number"
                                    value="{{ old('id_number') }}"
                                    placeholder="Identification number"
                                >
                            </div>
                        </div>

                        <div class="field full">
                            <label>Complete address</label>

                            <div class="input-wrap">
                                <span class="field-symbol">⌖</span>
                                <input
                                    type="text"
                                    name="address"
                                    value="{{ old('address') }}"
                                    placeholder="House number, street, barangay, city"
                                >
                            </div>
                        </div>

                        <div class="field full">
                            <label>Additional notes</label>

                            <textarea
                                name="notes"
                                placeholder="Write additional information about this customer..."
                            >{{ old('notes') }}</textarea>

                            <span class="field-hint">
                                Optional information that may help you manage this customer.
                            </span>
                        </div>

                    </div>
                </section>

                <!-- ID VERIFICATION -->
                <section class="card">

                    <div class="section-heading">
                        <div class="section-icon">▣</div>
                        <div>
                            <h3>ID Verification</h3>
                            <p>Customer identification document</p>
                        </div>
                        <span class="section-number">02 / 03</span>
                    </div>

                    <div class="id-preview">
                        <div class="id-placeholder" id="idPlaceholder">
                            ▤
                            <small>No ID image selected</small>
                        </div>

                        <img id="idPreview" alt="ID photo preview">
                    </div>

                    <label class="upload-button">
                        <span>＋</span>
                        Choose ID Photo
                        <input
                            type="file"
                            name="id_photo"
                            id="idPhoto"
                            accept="image/jpeg,image/png,image/webp"
                            capture="environment"
                        >
                    </label>

                    <button
                        type="button"
                        class="remove-photo"
                        id="removeId"
                    >
                        Remove ID photo
                    </button>

                    <p class="field-hint" style="margin-top:13px;">
                        Accepted formats: JPG, PNG, WEBP. Maximum file size: 4 MB.
                    </p>

                </section>

            </div>

            <!-- RIGHT COLUMN -->
            <aside class="side-column">

                <!-- PROFILE PHOTO -->
                <section class="card photo-card">

                    <div class="section-heading">
                        <div class="section-icon">♙</div>
                        <div>
                            <h3>Profile Photo</h3>
                            <p>Customer identification</p>
                        </div>
                    </div>

                    <div class="photo-preview">
                        <div class="photo-preview-inner">
                            <div class="photo-placeholder" id="profilePlaceholder">♙</div>
                            <img id="profilePreview" alt="Profile photo preview">
                        </div>
                    </div>

                    <span class="photo-label">Customer photo</span>

                    <p class="photo-description">
                        Upload a clear photo to easily recognize this customer.
                    </p>

                    <label class="upload-button">
                        <span>＋</span>
                        Choose Profile Photo
                        <input
                            type="file"
                            name="profile_photo"
                            id="profilePhoto"
                            accept="image/jpeg,image/png,image/webp"
                            capture="user"
                        >
                    </label>

                    <button
                        type="button"
                        class="remove-photo"
                        id="removeProfile"
                    >
                        Remove profile photo
                    </button>

                </section>

                <!-- CREDIT SETTINGS -->
                <section class="card">

                    <div class="section-heading">
                        <div class="section-icon">₱</div>
                        <div>
                            <h3>Credit Settings</h3>
                            <p>Customer borrowing allowance</p>
                        </div>
                    </div>

                    <div class="credit-box">
                        <label for="credit_limit">Credit limit (PHP)</label>

                        <div class="currency-wrap">
                            <span class="currency-symbol">₱</span>
                            <input
                                type="number"
                                id="credit_limit"
                                name="credit_limit"
                                value="{{ old('credit_limit', '0') }}"
                                min="0"
                                step="0.01"
                                placeholder="0.00"
                            >
                        </div>

                        <p class="credit-caption">
                            Set the maximum amount this customer is allowed
                            to borrow. Enter 0 if no limit is specified.
                        </p>
                    </div>

                </section>

                <!-- SAVE PANEL -->
                <section class="card save-card">

                    <span class="ready">
                        <span class="ready-dot"></span>
                        READY TO SAVE
                    </span>

                    <h3 class="save-title">Create customer profile</h3>

                    <p class="save-description">
                        Review the information before adding this customer
                        to your Track&Tally records.
                    </p>

                    <div class="summary-item">
                        <span>Required fields</span>
                        <strong>1 field</strong>
                    </div>

                    <div class="summary-item">
                        <span>Profile photo</span>
                        <strong id="profileStatus">Not added</strong>
                    </div>

                    <div class="summary-item">
                        <span>ID document</span>
                        <strong id="idStatus">Not added</strong>
                    </div>

                    <div class="completion">
                        <div class="completion-top">
                            <span>Required information</span>
                            <strong id="completionText">0%</strong>
                        </div>

                        <div class="progress-track">
                            <div class="progress-fill" id="progressFill"></div>
                        </div>
                    </div>

                    <button type="submit" class="save-button" id="saveButton">
                        ✓ &nbsp; Save Debtor
                    </button>

                    <a href="{{ route('debtors.index') }}" class="cancel-button">
                        Cancel and go back
                    </a>

                    <div class="security-note">
                        <span>✓</span>
                        <p>
                            Your customer information and uploaded images
                            will be saved with your Track&Tally records.
                        </p>
                    </div>

                </section>

            </aside>

        </div>
    </form>

    <footer class="footer">
        © {{ date('Y') }} Track&Tally. Customer Management System.
    </footer>

</main>

<script>
    // IMAGE PREVIEW AND FILE VALIDATION

    function setupImagePreview(inputId, previewId, placeholderId, removeId, statusId) {
        const input = document.getElementById(inputId);
        const preview = document.getElementById(previewId);
        const placeholder = document.getElementById(placeholderId);
        const removeButton = document.getElementById(removeId);
        const status = document.getElementById(statusId);

        let currentUrl = null;

        input.addEventListener('change', function () {
            const file = this.files[0];

            if (!file) return;

            const allowedTypes = [
                'image/jpeg',
                'image/png',
                'image/webp'
            ];

            if (!allowedTypes.includes(file.type)) {
                alert('Please select a JPG, PNG, or WEBP image.');
                this.value = '';
                return;
            }

            if (file.size > 4 * 1024 * 1024) {
                alert('Image must not exceed 4 MB.');
                this.value = '';
                return;
            }

            if (currentUrl) {
                URL.revokeObjectURL(currentUrl);
            }

            currentUrl = URL.createObjectURL(file);

            preview.src = currentUrl;
            preview.style.display = 'block';
            placeholder.style.display = 'none';
            removeButton.style.display = 'inline-block';

            if (status) {
                status.textContent = 'Added';
                status.style.color = '#25835D';
            }
        });

        removeButton.addEventListener('click', function () {
            input.value = '';

            if (currentUrl) {
                URL.revokeObjectURL(currentUrl);
                currentUrl = null;
            }

            preview.src = '';
            preview.style.display = 'none';
            placeholder.style.display = 'block';
            removeButton.style.display = 'none';

            if (status) {
                status.textContent = 'Not added';
                status.style.color = '';
            }
        });
    }

    setupImagePreview(
        'profilePhoto',
        'profilePreview',
        'profilePlaceholder',
        'removeProfile',
        'profileStatus'
    );

    setupImagePreview(
        'idPhoto',
        'idPreview',
        'idPlaceholder',
        'removeId',
        'idStatus'
    );


    // REQUIRED FIELD COMPLETION

    const fullNameInput = document.querySelector('[name="full_name"]');
    const progressFill = document.getElementById('progressFill');
    const completionText = document.getElementById('completionText');

    function updateCompletion() {
        const percentage = fullNameInput.value.trim() !== '' ? 100 : 0;

        progressFill.style.width = percentage + '%';
        completionText.textContent = percentage + '%';
    }

    fullNameInput.addEventListener('input', updateCompletion);
    updateCompletion();


    // FORM SUBMISSION

    document.getElementById('debtorForm').addEventListener('submit', function (event) {
        if (!fullNameInput.value.trim()) {
            event.preventDefault();
            fullNameInput.focus();
            alert("Please enter the debtor's full name.");
            return;
        }

        const button = document.getElementById('saveButton');

        button.disabled = true;
        button.textContent = 'Saving customer...';
    });
</script>

</body>
</html>
