
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Profile | Track&Tally</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --navy: #172D48;
            --navy2: #243F60;
            --gold: #C9A24B;
            --gold-light: #E8C66E;
            --cream: #F5F2E8;
            --white: #FFFFFF;
            --text: #24364B;
            --muted: #8793A2;
            --border: #E5E9EF;
            --green: #31845B;
            --red: #C04444;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            padding: 35px 22px;
            font-family: 'DM Sans', sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at 5% 5%, rgba(201,162,75,.15), transparent 25%),
                radial-gradient(circle at 95% 90%, rgba(36,63,96,.09), transparent 25%),
                #F5F2E8;
        }

        button, input { font: inherit; }

        .page {
            max-width: 1100px;
            width: 100%;
            margin: auto;
        }

        /* NAVIGATION */

        .top-navigation {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
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
            background: linear-gradient(145deg, #243F60, #142940);
            color: var(--gold-light);
            font-size: 23px;
            box-shadow: 0 7px 16px rgba(23,45,72,.18);
        }

        .brand-name {
            font-family: 'Manrope', sans-serif;
            color: var(--navy);
            font-size: 18px;
            font-weight: 800;
        }

        .brand-subtitle {
            margin-top: 2px;
            color: var(--muted);
            font-size: 10px;
            letter-spacing: .4px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 12px 17px;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: white;
            color: var(--navy);
            text-decoration: none;
            font-size: 12px;
            font-weight: 800;
            transition: .25s;
        }

        .back-link:hover {
            border-color: var(--gold);
            color: #A77C24;
            transform: translateY(-3px);
            box-shadow: 0 7px 16px rgba(23,45,72,.07);
        }

        /* INTRO */

        .page-intro {
            margin-bottom: 23px;
        }

        .eyebrow {
            margin-bottom: 7px;
            color: #A98231;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 2px;
        }

        .page-intro h2 {
            color: var(--navy);
            font-family: 'Manrope', sans-serif;
            font-size: 27px;
            font-weight: 800;
            letter-spacing: -.8px;
        }

        .page-intro p {
            margin-top: 6px;
            color: var(--muted);
            font-size: 13px;
        }

        /* HERO */

        .hero {
            position: relative;
            isolation: isolate;
            overflow: hidden;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 25px;
            min-height: 250px;
            padding: 40px 45px;
            margin-bottom: 30px;
            border: 1px solid rgba(232,198,110,.4);
            border-radius: 27px;
            background: linear-gradient(120deg, #142940, #203F60 70%, #315574);
            color: white;
            box-shadow: 0 18px 40px rgba(23,45,72,.17);
        }

        .hero::before {
            content: "";
            position: absolute;
            z-index: -1;
            width: 350px;
            height: 350px;
            right: 5%;
            top: -200px;
            border: 1px solid rgba(232,198,110,.22);
            border-radius: 50%;
            box-shadow:
                0 0 0 25px rgba(232,198,110,.035),
                0 0 0 55px rgba(232,198,110,.025),
                0 0 0 90px rgba(232,198,110,.018);
        }

        .hero::after {
            content: "";
            position: absolute;
            z-index: -1;
            width: 220px;
            height: 220px;
            left: -130px;
            bottom: -150px;
            border-radius: 50%;
            background: rgba(255,255,255,.04);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            min-width: 0;
        }

        .hero-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--gold-light);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 2px;
        }

        .hero-label span {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--gold-light);
            box-shadow: 0 0 10px rgba(232,198,110,.7);
        }

        .hero h1 {
            margin-top: 15px;
            font-family: 'Manrope', sans-serif;
            font-size: clamp(27px, 4vw, 38px);
            font-weight: 800;
            letter-spacing: -1px;
            overflow-wrap: anywhere;
        }

        .hero-description {
            margin-top: 8px;
            color: #C9D3DF;
            font-size: 13px;
        }

        .hero-details {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 22px;
        }

        .hero-detail {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 13px;
            border: 1px solid rgba(255,255,255,.13);
            border-radius: 11px;
            background: rgba(255,255,255,.08);
            color: #E6EBF0;
            font-size: 11px;
        }

        .hero-detail strong { color: var(--gold-light); }

        .hero-avatar-wrap {
            position: relative;
            z-index: 2;
            flex-shrink: 0;
        }

        .hero-avatar {
            width: 125px;
            height: 125px;
            display: grid;
            place-items: center;
            border: 1px solid rgba(232,198,110,.65);
            border-radius: 50%;
            background: rgba(201,162,75,.13);
            box-shadow: 0 0 0 11px rgba(201,162,75,.07);
            color: var(--gold-light);
            font-size: 53px;
        }

        .status-badge {
            position: absolute;
            right: -12px;
            bottom: 0;
            padding: 8px 11px;
            border: 3px solid #203F60;
            border-radius: 20px;
            background: #E9F6EE;
            color: #31845B;
            font-size: 9px;
            font-weight: 800;
            white-space: nowrap;
        }

        /* ALERTS */

        .notice {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 15px 17px;
            margin-bottom: 18px;
            border-radius: 14px;
            font-size: 13px;
            line-height: 1.6;
            animation: appear .35s ease;
        }

        .notice.success {
            background: #EDF7F1;
            border: 1px solid #B9E2C9;
            color: #286B48;
        }

        .notice.error {
            background: #FDF0F0;
            border: 1px solid #F0C5C5;
            color: #A33D3D;
        }

        .notice ul { padding-left: 18px; }
        .notice-icon { font-size: 19px; }

        /* SECTION HEADING */

        .section-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 5px 0 14px;
        }

        .section-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .section-icon {
            width: 45px;
            height: 45px;
            display: grid;
            place-items: center;
            border: 1px solid #E8D8A8;
            border-radius: 14px;
            background: #F1E7C8;
            color: #A98231;
            font-size: 21px;
        }

        .section-heading h2 {
            color: var(--navy);
            font-family: 'Manrope', sans-serif;
            font-size: 16px;
            font-weight: 800;
        }

        .section-heading p {
            margin-top: 3px;
            color: var(--muted);
            font-size: 11px;
        }

        .section-number {
            color: #AAB3BE;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1px;
        }

        /* MAIN GRID */

        .content-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 22px;
            align-items: start;
        }

        .content-column { min-width: 0; }

        /* CARDS */

        .card {
            position: relative;
            overflow: hidden;
            padding: 26px;
            margin-bottom: 23px;
            border: 1px solid var(--border);
            border-radius: 21px;
            background: white;
            box-shadow: 0 8px 24px rgba(23,45,72,.045);
            transition: .25s;
            animation: appear .45s ease both;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 30px rgba(23,45,72,.08);
        }

        .card-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            padding-bottom: 18px;
            margin-bottom: 22px;
            border-bottom: 1px solid #EEF0F3;
        }

        .card-top h3 {
            color: var(--navy);
            font-family: 'Manrope', sans-serif;
            font-size: 14px;
            font-weight: 800;
        }

        .card-top p {
            margin-top: 4px;
            color: var(--muted);
            font-size: 11px;
        }

        .card-tag {
            padding: 7px 10px;
            border-radius: 8px;
            background: #F7F3E7;
            color: #9B772D;
            font-size: 9px;
            font-weight: 800;
            white-space: nowrap;
        }

        /* FORM */

        .field {
            min-width: 0;
            margin-bottom: 19px;
        }

        .field label {
            display: block;
            margin-bottom: 8px;
            color: #34465B;
            font-size: 12px;
            font-weight: 800;
        }

        .input-wrap { position: relative; }

        .input-icon {
            position: absolute;
            top: 50%;
            left: 14px;
            transform: translateY(-50%);
            color: #A18B5C;
            font-size: 16px;
            pointer-events: none;
        }

        .field input {
            width: 100%;
            height: 51px;
            padding: 0 15px 0 43px;
            border: 1px solid #DDE3E9;
            border-radius: 12px;
            outline: none;
            background: #FBFCFD;
            color: var(--navy);
            font-size: 13px;
            transition: .22s;
        }

        .field input:focus {
            border-color: var(--gold);
            background: white;
            box-shadow: 0 0 0 4px rgba(201,162,75,.12);
        }

        .field input::placeholder { color: #AAB3BE; }

        .password-wrap input { padding-right: 70px; }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 13px;
            transform: translateY(-50%);
            padding: 5px;
            border: 0;
            background: transparent;
            color: #A17D32;
            cursor: pointer;
            font-size: 10px;
            font-weight: 800;
        }

        .error-text {
            margin-top: 6px;
            color: var(--red);
            font-size: 11px;
        }

        /* BUTTON */

        .btn {
            width: 100%;
            min-height: 51px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 12px 18px;
            border: 0;
            border-radius: 12px;
            background: linear-gradient(110deg, #29496C, #172D48);
            color: white;
            cursor: pointer;
            font-size: 13px;
            font-weight: 800;
            box-shadow: 0 7px 16px rgba(23,45,72,.14);
            transition: .25s;
        }

        .btn:hover {
            transform: translateY(-2px);
            background: linear-gradient(110deg, #355A80, #203F60);
            box-shadow: 0 10px 20px rgba(23,45,72,.2);
        }

        .btn:active { transform: scale(.99); }

        /* SECURITY INTRO */

        .security-intro {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 15px;
            margin-bottom: 22px;
            border: 1px solid #E6EAF0;
            border-radius: 14px;
            background: #F8FAFC;
        }

        .security-icon {
            width: 47px;
            height: 47px;
            min-width: 47px;
            display: grid;
            place-items: center;
            border-radius: 14px;
            background: #EAF0F7;
            color: var(--navy);
            font-size: 21px;
        }

        .security-intro h3 {
            color: var(--navy);
            font-size: 13px;
            font-weight: 800;
        }

        .security-intro p {
            margin-top: 5px;
            color: var(--muted);
            font-size: 11px;
            line-height: 1.6;
        }

        .password-hint {
            display: flex;
            align-items: center;
            gap: 7px;
            margin-top: 9px;
            color: var(--muted);
            font-size: 10px;
        }

        .password-hint span {
            color: var(--green);
            font-size: 13px;
        }

        /* PASSWORD STRENGTH */

        .strength-area { margin-top: -8px; margin-bottom: 19px; }

        .strength-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 7px;
            color: var(--muted);
            font-size: 10px;
        }

        .strength-header strong { color: var(--navy); }

        .strength-track {
            height: 5px;
            overflow: hidden;
            border-radius: 10px;
            background: #E9EDF1;
        }

        .strength-fill {
            width: 0%;
            height: 100%;
            border-radius: 10px;
            background: #C04444;
            transition: width .25s, background .25s;
        }

        /* NOTE */

        .security-note {
            display: flex;
            align-items: flex-start;
            gap: 13px;
            padding: 17px;
            margin-top: 5px;
            border: 1px solid #E7DDBE;
            border-radius: 15px;
            background: linear-gradient(110deg, #FFFDF7, #F8F4E8);
        }

        .note-icon {
            width: 36px;
            height: 36px;
            min-width: 36px;
            display: grid;
            place-items: center;
            border-radius: 11px;
            background: #F1E7C8;
            color: #A98231;
            font-size: 17px;
        }

        .security-note h3 {
            margin-bottom: 4px;
            color: var(--navy);
            font-size: 12px;
            font-weight: 800;
        }

        .security-note p {
            color: #7F8995;
            font-size: 11px;
            line-height: 1.7;
        }

        /* FOOTER */

        .footer {
            position: relative;
            overflow: hidden;
            padding: 27px 20px;
            margin-top: 30px;
            border: 1px solid rgba(201,162,75,.55);
            border-radius: 21px;
            background: linear-gradient(115deg, #142940, #203F60);
            color: white;
            text-align: center;
        }

        .footer::before {
            content: "";
            position: absolute;
            width: 180px;
            height: 180px;
            right: -90px;
            bottom: -120px;
            border: 1px solid rgba(232,198,110,.2);
            border-radius: 50%;
        }

        .footer-brand {
            position: relative;
            z-index: 1;
            color: var(--gold-light);
            font-family: 'Manrope', sans-serif;
            font-size: 19px;
            font-weight: 800;
        }

        .footer p {
            position: relative;
            z-index: 1;
            margin-top: 6px;
            color: #D1DCE7;
            font-size: 11px;
        }

        .footer-divider {
            width: 43px;
            height: 3px;
            margin: 15px auto;
            border-radius: 5px;
            background: var(--gold);
        }

        .footer small {
            position: relative;
            z-index: 1;
            display: block;
            color: #AEBAC8;
            font-size: 10px;
        }

        /* ANIMATION */

        @keyframes appear {
            from { opacity: 0; transform: translateY(9px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* RESPONSIVE */

        @media (max-width: 850px) {
            .content-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 600px) {
            body { padding: 20px 12px; }

            .top-navigation { gap: 10px; }

            .brand-name { font-size: 16px; }

            .brand-icon {
                width: 40px;
                height: 40px;
            }

            .back-link {
                padding: 10px 11px;
                font-size: 10px;
            }

            .page-intro h2 { font-size: 23px; }

            .hero {
                min-height: auto;
                padding: 28px 23px;
            }

            .hero-avatar {
                width: 85px;
                height: 85px;
                font-size: 35px;
            }

            .hero h1 { font-size: 26px; }

            .card { padding: 20px; }

            .section-number { display: none; }
        }

        @media (max-width: 430px) {
            .hero {
                flex-direction: column-reverse;
                align-items: flex-start;
                gap: 20px;
            }

            .hero-avatar {
                width: 72px;
                height: 72px;
                font-size: 29px;
            }

            .hero-details {
                flex-direction: column;
                align-items: flex-start;
            }

            .card-tag { display: none; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: .01ms !important;
                transition-duration: .01ms !important;
            }
        }
    </style>
</head>

<body>

<div class="page">

    <!-- NAVIGATION -->
    <div class="top-navigation">
        <div class="brand">
            <div class="brand-icon">&#127978;</div>
            <div>
                <div class="brand-name">Track&Tally</div>
                <div class="brand-subtitle">SIMPLE STORE MANAGEMENT</div>
            </div>
        </div>

        <a href="{{ url('/dashboard') }}" class="back-link">
            &#8592; Dashboard
        </a>
    </div>

    <!-- INTRO -->
    <div class="page-intro">
        <div class="eyebrow">YOUR ACCOUNT</div>
        <h2>Account Settings</h2>
        <p>Manage your store information and keep your account secure.</p>
    </div>

    <!-- HERO -->
    <header class="hero">
        <div class="hero-content">
            <div class="hero-label">
                <span></span>
                STORE ACCOUNT
            </div>

            <h1>{{ $user->store_name ?: 'My Store' }}</h1>

            <p class="hero-description">
                Welcome to your Track&Tally store profile.
            </p>

            <div class="hero-details">
                <div class="hero-detail">
                    <strong>&#128222;</strong>
                    {{ $user->phone_number }}
                </div>

                <div class="hero-detail">
                    <strong>&#10003;</strong>
                    Account Profile
                </div>
            </div>
        </div>

        <div class="hero-avatar-wrap">
            <div class="hero-avatar">&#127978;</div>
            <div class="status-badge">&#10003; ACCOUNT ACTIVE</div>
        </div>
    </header>

    <!-- NOTIFICATIONS -->
    @if(session('success'))
        <div class="notice success">
            <div class="notice-icon">&#10003;</div>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    @if(session('password_success'))
        <div class="notice success">
            <div class="notice-icon">&#10003;</div>
            <div>{{ session('password_success') }}</div>
        </div>
    @endif

    @if($errors->any())
        <div class="notice error">
            <div class="notice-icon">&#9888;</div>
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

    <!-- TWO COLUMN CONTENT -->
    <div class="content-grid">

        <!-- STORE DETAILS -->
        <div class="content-column">

            <div class="section-heading">
                <div class="section-left">
                    <div class="section-icon">&#127978;</div>
                    <div>
                        <h2>Store Details</h2>
                        <p>Manage your store information</p>
                    </div>
                </div>
                <div class="section-number">01 / PROFILE</div>
            </div>

            <section class="card">
                <div class="card-top">
                    <div>
                        <h3>Personal & Store Information</h3>
                        <p>Keep your account details updated.</p>
                    </div>
                    <span class="card-tag">PROFILE</span>
                </div>

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf

                    <div class="field">
                        <label for="store_name">Store Name</label>
                        <div class="input-wrap">
                            <span class="input-icon">&#127978;</span>
                            <input
                                type="text"
                                id="store_name"
                                name="store_name"
                                value="{{ old('store_name', $user->store_name) }}"
                                placeholder="Enter your store name"
                                maxlength="255"
                                required
                            >
                        </div>
                        @error('store_name')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="owner_name">Store Owner</label>
                        <div class="input-wrap">
                            <span class="input-icon">&#128100;</span>
                            <input
                                type="text"
                                id="owner_name"
                                name="owner_name"
                                value="{{ old('owner_name', $user->owner_name) }}"
                                placeholder="Enter owner's full name"
                                maxlength="255"
                            >
                        </div>
                        @error('owner_name')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="phone_number">Phone Number</label>
                        <div class="input-wrap">
                            <span class="input-icon">&#128222;</span>
                            <input
                                type="tel"
                                id="phone_number"
                                name="phone_number"
                                value="{{ old('phone_number', $user->phone_number) }}"
                                placeholder="09XXXXXXXXX"
                                maxlength="20"
                                required
                            >
                        </div>
                        @error('phone_number')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn">
                        <span>&#10003;</span>
                        Save Profile Details
                    </button>
                </form>
            </section>
        </div>

        <!-- SECURITY -->
        <div class="content-column">

            <div class="section-heading">
                <div class="section-left">
                    <div class="section-icon">&#128274;</div>
                    <div>
                        <h2>Account Security</h2>
                        <p>Protect your store account</p>
                    </div>
                </div>
                <div class="section-number">02 / SECURITY</div>
            </div>

            <section class="card">
                <div class="card-top">
                    <div>
                        <h3>Password Management</h3>
                        <p>Update your account password.</p>
                    </div>
                    <span class="card-tag">SECURE</span>
                </div>

                <div class="security-intro">
                    <div class="security-icon">&#128274;</div>
                    <div>
                        <h3>Protect Your Account</h3>
                        <p>Use at least 8 characters. A combination of letters, numbers, and symbols is recommended.</p>
                    </div>
                </div>

                <form action="{{ route('profile.password') }}" method="POST">
                    @csrf

                    <div class="field">
                        <label for="current_password">Current Password</label>
                        <div class="input-wrap password-wrap">
                            <span class="input-icon">&#128273;</span>
                            <input
                                type="password"
                                id="current_password"
                                name="current_password"
                                placeholder="Enter current password"
                                autocomplete="current-password"
                                required
                            >
                            <button type="button" class="toggle-password"
                                onclick="togglePassword('current_password', this)">SHOW</button>
                        </div>
                        @error('current_password')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="new_password">New Password</label>
                        <div class="input-wrap password-wrap">
                            <span class="input-icon">&#128274;</span>
                            <input
                                type="password"
                                id="new_password"
                                name="new_password"
                                placeholder="Create a new password"
                                minlength="8"
                                autocomplete="new-password"
                                required
                                oninput="checkPasswordStrength(this.value)"
                            >
                            <button type="button" class="toggle-password"
                                onclick="togglePassword('new_password', this)">SHOW</button>
                        </div>
                        @error('new_password')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="strength-area">
                        <div class="strength-header">
                            <span>Password strength</span>
                            <strong id="strengthText">Not entered</strong>
                        </div>
                        <div class="strength-track">
                            <div class="strength-fill" id="strengthFill"></div>
                        </div>
                    </div>

                    <div class="field">
                        <label for="new_password_confirmation">Confirm New Password</label>
                        <div class="input-wrap password-wrap">
                            <span class="input-icon">&#128274;</span>
                            <input
                                type="password"
                                id="new_password_confirmation"
                                name="new_password_confirmation"
                                placeholder="Confirm new password"
                                minlength="8"
                                autocomplete="new-password"
                                required
                            >
                            <button type="button" class="toggle-password"
                                onclick="togglePassword('new_password_confirmation', this)">SHOW</button>
                        </div>
                    </div>

                    <button type="submit" class="btn">
                        <span>&#128274;</span>
                        Update Password
                    </button>
                </form>
            </section>
        </div>
    </div>

    <!-- SECURITY NOTE -->
    <div class="security-note">
        <div class="note-icon">&#9432;</div>
        <div>
            <h3>Keep Your Password Private</h3>
            <p>
                Never share your password with anyone. Use a unique password
                and keep your account credentials safe. Your password protects
                access to your store records.
            </p>
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="footer-brand">&#127978; Track&Tally</div>
        <p>Simple Store Management</p>
        <div class="footer-divider"></div>
        <small>STORE PROFILE &bull; ACCOUNT SECURITY</small>
        <small style="margin-top: 8px;">
            Your store. Your records. Your control.
        </small>
    </footer>

</div>

<script>
    function togglePassword(inputId, button) {
        const input = document.getElementById(inputId);

        if (input.type === 'password') {
            input.type = 'text';
            button.textContent = 'HIDE';
        } else {
            input.type = 'password';
            button.textContent = 'SHOW';
        }
    }

    function checkPasswordStrength(password) {
        const fill = document.getElementById('strengthFill');
        const text = document.getElementById('strengthText');

        let score = 0;

        if (password.length >= 8) score++;
        if (/[a-z]/.test(password) && /[A-Z]/.test(password)) score++;
        if (/[0-9]/.test(password)) score++;
        if (/[^A-Za-z0-9]/.test(password)) score++;

        const levels = [
            { width: '0%', label: 'Not entered', color: '#E9EDF1' },
            { width: '25%', label: 'Weak', color: '#C04444' },
            { width: '50%', label: 'Fair', color: '#D59A35' },
            { width: '75%', label: 'Good', color: '#6D9D61' },
            { width: '100%', label: 'Strong', color: '#31845B' }
        ];

        const level = password.length === 0 ? levels[0] : levels[score];

        fill.style.width = level.width;
        fill.style.background = level.color;
        text.textContent = level.label;
        text.style.color = level.color;
    }
</script>

</body>
</html>
