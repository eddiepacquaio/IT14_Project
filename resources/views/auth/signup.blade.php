
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account | Track&Tally</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        :root {
            --navy: #172943;
            --gold: #d5aa48;
            --gold-light: #f1d58d;
            --muted: #7c8795;
        }

        body {
            min-height: 100vh;
            padding: 35px 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            background:
                radial-gradient(circle at 12% 15%, #e8dfc9, transparent 34%),
                radial-gradient(circle at 88% 85%, #dce4eb, transparent 35%),
                linear-gradient(135deg, #f5f3ed, #e9edf0, #f4f0e6);
            overflow-x: hidden;
        }

        .orb {
            position: fixed;
            border-radius: 50%;
            pointer-events: none;
            filter: blur(5px);
        }

        .orb.one {
            width: 280px;
            height: 280px;
            background: rgba(213,170,72,.16);
            top: -100px;
            left: -80px;
        }

        .orb.two {
            width: 350px;
            height: 350px;
            background: rgba(62,92,124,.13);
            right: -120px;
            bottom: -140px;
        }

        .container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 1120px;
            min-height: 730px;
            display: grid;
            grid-template-columns: .9fr 1.1fr;
            overflow: hidden;
            border-radius: 30px;
            background: rgba(255,255,255,.56);
            backdrop-filter: blur(25px);
            border: 1px solid rgba(255,255,255,.85);
            box-shadow: 0 25px 75px rgba(35,49,67,.14);
            animation: enter .7s ease both;
        }

        @keyframes enter {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .left {
            position: relative;
            overflow: hidden;
            padding: 55px 45px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: white;
            background: linear-gradient(145deg, #13253e, #294363);
        }

        .left::before {
            content: "";
            position: absolute;
            width: 400px;
            height: 400px;
            border: 1px solid rgba(255,255,255,.12);
            border-radius: 50%;
            top: -170px;
            right: -190px;
            box-shadow:
                0 0 0 35px rgba(255,255,255,.025),
                0 0 0 75px rgba(255,255,255,.02);
        }

        .left-content {
            position: relative;
            z-index: 2;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 65px;
        }

        .brand img {
            width: 58px;
            height: 58px;
            object-fit: contain;
            padding: 5px;
            border-radius: 15px;
            background: white;
        }

        .brand h2 {
            font-size: 24px;
            font-weight: 800;
        }

        .brand h2 span,
        .left h1 span {
            color: var(--gold-light);
        }

        .left h1 {
            font-size: 42px;
            line-height: 1.2;
            margin-bottom: 20px;
            font-weight: 800;
        }

        .left-description {
            font-size: 14px;
            line-height: 1.9;
            color: #d7dfeb;
        }

        .features {
            display: grid;
            gap: 19px;
            margin-top: 35px;
        }

        .feature {
            display: flex;
            align-items: center;
            gap: 13px;
            font-size: 14px;
            color: #f1f3f7;
        }

        .check {
            width: 28px;
            height: 28px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: var(--gold-light);
            background: rgba(213,170,72,.16);
            border: 1px solid rgba(213,170,72,.4);
        }

        .left-footer {
            position: relative;
            z-index: 2;
            margin-top: 55px;
            font-size: 11px;
            color: #b5c0cf;
        }

        .right {
            padding: 45px 55px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: rgba(255,255,255,.75);
        }

        .welcome-icon {
            width: 52px;
            height: 52px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 16px;
            margin-bottom: 17px;
            color: #a47b25;
            font-size: 25px;
            background: linear-gradient(145deg,#fff9e9,#f5ebd0);
        }

        .right h1 {
            color: var(--navy);
            font-size: 31px;
            font-weight: 800;
            margin-bottom: 7px;
        }

        .subtitle {
            color: var(--muted);
            font-size: 13px;
            margin-bottom: 23px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #35445a;
            font-size: 12px;
            font-weight: 700;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper input {
            width: 100%;
            height: 49px;
            padding: 0 60px 0 15px;
            border: 1px solid #dce1e7;
            border-radius: 11px;
            background: #fafbfc;
            color: var(--navy);
            font-size: 13px;
            outline: none;
            transition: .25s;
        }

        .input-wrapper input:focus {
            background: white;
            border-color: var(--gold);
            box-shadow: 0 0 0 4px rgba(213,170,72,.12);
        }

        .input-wrapper input::placeholder {
            color: #a0a8b2;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 13px;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            color: #8b929e;
            font-size: 10px;
            font-weight: 800;
            cursor: pointer;
        }

        .toggle-password:hover {
            color: #a47b25;
        }

        .error {
            color: #c62828;
            font-size: 11px;
            margin-top: 6px;
        }

        .alert {
            padding: 12px 14px;
            margin-bottom: 16px;
            border-radius: 10px;
            background: #fff0ef;
            border: 1px solid #f4d2cf;
            color: #a52d2d;
            font-size: 12px;
        }

        .password-hint {
            color: #8b929e;
            font-size: 10px;
            margin-top: 6px;
        }

        .signup-btn {
            width: 100%;
            height: 52px;
            margin-top: 8px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg,#e9c56f,#d4a642);
            color: #1d2d43;
            font-size: 13px;
            font-weight: 900;
            letter-spacing: .6px;
            cursor: pointer;
            box-shadow: 0 7px 20px rgba(177,135,45,.2);
            transition: .25s;
        }

        .signup-btn:hover {
            transform: translateY(-2px);
        }

        .login-link {
            text-align: center;
            margin-top: 22px;
            color: #818b98;
            font-size: 12px;
        }

        .login-link a {
            color: #a47b25;
            font-weight: 800;
            text-decoration: none;
        }

        .security {
            text-align: center;
            margin-top: 20px;
            color: #929ba6;
            font-size: 10px;
        }

        /* SUCCESS MODAL */

        .success-overlay {
            position: fixed;
            inset: 0;
            z-index: 99999;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(16,29,46,.60);
            backdrop-filter: blur(6px);
        }

        .success-modal {
            width: 100%;
            max-width: 390px;
            padding: 35px 28px;
            text-align: center;
            background: white;
            border-radius: 22px;
            box-shadow: 0 20px 60px rgba(0,0,0,.2);
            animation: modalEnter .3s ease;
        }

        .success-icon {
            width: 76px;
            height: 76px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #e8f6ed;
            color: #239653;
            font-size: 40px;
            font-weight: bold;
        }

        .success-modal h2 {
            color: var(--navy);
            font-size: 23px;
            margin-bottom: 12px;
        }

        .success-modal p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.7;
            margin-bottom: 25px;
        }

        .success-modal a {
            display: block;
            padding: 15px;
            border-radius: 11px;
            background: linear-gradient(135deg,#e9c56f,#d4a642);
            color: var(--navy);
            text-decoration: none;
            font-size: 13px;
            font-weight: 900;
        }

        @keyframes modalEnter {
            from {
                opacity: 0;
                transform: translateY(15px) scale(.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @media(max-width: 900px) {
            .container {
                max-width: 650px;
                grid-template-columns: 1fr;
            }

            .left {
                padding: 35px 40px;
            }

            .brand {
                margin-bottom: 30px;
            }

            .left h1 {
                font-size: 34px;
            }

            .features {
                grid-template-columns: 1fr 1fr;
            }

            .left-footer {
                margin-top: 30px;
            }

            .right {
                padding: 40px;
            }
        }

        @media(max-width: 500px) {
            body {
                padding: 13px;
            }

            .container {
                border-radius: 21px;
            }

            .left {
                padding: 28px 24px;
            }

            .brand img {
                width: 50px;
                height: 50px;
            }

            .left h1 {
                font-size: 29px;
            }

            .left-description {
                font-size: 12px;
            }

            .features {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .right {
                padding: 30px 23px;
            }

            .right h1 {
                font-size: 27px;
            }
        }

        @media(prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation: none !important;
                transition: none !important;
            }
        }
    </style>
</head>

<body>

    <div class="orb one"></div>
    <div class="orb two"></div>

    @if (session('signup_success'))
        <div class="success-overlay">
            <div class="success-modal">
                <div class="success-icon">✓</div>

                <h2>Account Created Successfully!</h2>

                <p>
                    {{ session('signup_success') }}
                    You can now log in using your registered
                    phone number and password.
                </p>

                <a href="{{ url('/login') }}">
                    GO TO LOGIN →
                </a>
            </div>
        </div>
    @endif

    <main class="container">

        <section class="left">
            <div class="left-content">

                <div class="brand">
                    <img src="{{ asset('icon.png') }}" alt="Track&Tally Logo">
                    <h2>Track<span>&</span>Tally</h2>
                </div>

                <h1>
                    Start your business journey.<br>
                    <span>Stay organized.</span>
                </h1>

                <p class="left-description">
                    Create your Track&Tally account and manage
                    your store with a simple and convenient
                    business management system.
                </p>

                <div class="features">
                    <div class="feature">
                        <div class="check">✓</div>
                        Organize your store inventory
                    </div>

                    <div class="feature">
                        <div class="check">✓</div>
                        Monitor your daily sales
                    </div>

                    <div class="feature">
                        <div class="check">✓</div>
                        Keep customer credit records
                    </div>

                    <div class="feature">
                        <div class="check">✓</div>
                        Review your business reports
                    </div>
                </div>
            </div>

            <div class="left-footer">
                © {{ date('Y') }} Track&Tally. All rights reserved.
            </div>
        </section>

        <section class="right">
            <div class="right-content">

                <div class="welcome-icon">✦</div>

                <h1>Create Account</h1>

                <p class="subtitle">
                    Enter your details to register your store.
                </p>

                @if ($errors->any())
                    <div class="alert">
                        Please check the information you entered.
                    </div>
                @endif

                <form method="POST" action="{{ route('signup.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="store_name">Store Name</label>
                        <div class="input-wrapper">
                            <input
                                type="text"
                                id="store_name"
                                name="store_name"
                                placeholder="Enter your store name"
                                value="{{ old('store_name') }}"
                                maxlength="150"
                                required
                            >
                        </div>
                        @error('store_name')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="owner_name">Owner Name</label>
                        <div class="input-wrapper">
                            <input
                                type="text"
                                id="owner_name"
                                name="owner_name"
                                placeholder="Enter the owner's full name"
                                value="{{ old('owner_name') }}"
                                maxlength="150"
                                required
                            >
                        </div>
                        @error('owner_name')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <div class="input-wrapper">
                            <input
                                type="tel"
                                id="phone_number"
                                name="phone_number"
                                placeholder="09XXXXXXXXX"
                                value="{{ old('phone_number') }}"
                                maxlength="11"
                                inputmode="numeric"
                                autocomplete="tel"
                                required
                            >
                        </div>
                        @error('phone_number')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-wrapper">
                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Create your password"
                                autocomplete="new-password"
                                required
                            >

                            <button type="button"
                                class="toggle-password"
                                data-target="password">
                                SHOW
                            </button>
                        </div>

                        <p class="password-hint">
                            Use at least 8 characters.
                        </p>

                        @error('password')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">
                            Confirm Password
                        </label>

                        <div class="input-wrapper">
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                placeholder="Re-enter your password"
                                autocomplete="new-password"
                                required
                            >

                            <button type="button"
                                class="toggle-password"
                                data-target="password_confirmation">
                                SHOW
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="signup-btn">
                        CREATE MY ACCOUNT →
                    </button>
                </form>

                <div class="login-link">
                    Already have an account?
                    <a href="{{ url('/login') }}">Log In</a>
                </div>

                <div class="security">
                    🔒 Your account information is securely protected.
                </div>

            </div>
        </section>

    </main>

    <script>
        // Show and hide passwords
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function () {
                const input = document.getElementById(this.dataset.target);
                const hidden = input.type === 'password';

                input.type = hidden ? 'text' : 'password';
                this.textContent = hidden ? 'HIDE' : 'SHOW';
            });
        });

        // Allow numbers only
        const phoneInput = document.getElementById('phone_number');

        phoneInput.addEventListener('input', function () {
            this.value = this.value.replace(/\D/g, '').slice(0, 11);
        });
    </script>

</body>
</html>
