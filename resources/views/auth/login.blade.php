<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Track&Tally</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        :root {
            --navy: #172943;
            --navy-light: #294363;
            --gold: #d5aa48;
            --gold-light: #f1d58d;
            --cream: #f7f5ef;
            --text: #26364d;
            --muted: #7c8795;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 35px 20px;
            overflow-x: hidden;
            background:
                radial-gradient(circle at 15% 20%, #e7dfca 0, transparent 35%),
                radial-gradient(circle at 85% 80%, #dce3e9 0, transparent 35%),
                linear-gradient(135deg, #f5f3ed, #e9edf0, #f4f0e6);
        }

        /* Background decorations */

        .ambient {
            position: fixed;
            border-radius: 50%;
            pointer-events: none;
            filter: blur(3px);
            z-index: 0;
        }

        .ambient.one {
            width: 280px;
            height: 280px;
            background: rgba(213, 170, 72, .15);
            top: -90px;
            left: -70px;
        }

        .ambient.two {
            width: 360px;
            height: 360px;
            background: rgba(63, 93, 125, .12);
            bottom: -150px;
            right: -100px;
        }

        .ambient.three {
            width: 120px;
            height: 120px;
            background: rgba(255, 255, 255, .65);
            top: 65%;
            left: 10%;
            filter: blur(15px);
        }

        /* Main glass container */

        .container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 1120px;
            min-height: 660px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            overflow: hidden;
            border-radius: 30px;

            background: rgba(255, 255, 255, .56);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);

            border: 1px solid rgba(255, 255, 255, .85);

            box-shadow:
                0 25px 75px rgba(35, 49, 67, .13),
                inset 0 1px 0 rgba(255, 255, 255, .9);

            animation: appear .8s ease both;
        }

        @keyframes appear {
            from {
                opacity: 0;
                transform: translateY(25px) scale(.98);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Left panel */

        .left {
            position: relative;
            overflow: hidden;
            padding: 60px 52px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: white;

            background:
                linear-gradient(
                    145deg,
                    rgba(19, 37, 62, .96),
                    rgba(37, 62, 91, .91)
                );

            border-right: 1px solid rgba(255, 255, 255, .2);
        }

        .left::before {
            content: "";
            position: absolute;
            width: 430px;
            height: 430px;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,.13);
            top: -200px;
            right: -180px;
            box-shadow:
                0 0 0 35px rgba(255,255,255,.035),
                0 0 0 75px rgba(255,255,255,.025),
                0 0 0 115px rgba(255,255,255,.015);
        }

        .left::after {
            content: "";
            position: absolute;
            width: 280px;
            height: 280px;
            border-radius: 50%;
            bottom: -170px;
            left: -110px;
            background: radial-gradient(
                circle,
                rgba(213,170,72,.19),
                transparent 70%
            );
        }

        .left-content {
            position: relative;
            z-index: 2;
        }

        /* Brand */

        .brand {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 65px;
        }

        .brand img {
            width: 62px;
            height: 62px;
            object-fit: contain;
            padding: 6px;
            border-radius: 17px;
            background: rgba(255,255,255,.95);
            box-shadow: 0 8px 25px rgba(0,0,0,.18);
        }

        .brand h2 {
            font-size: 25px;
            font-weight: 800;
            letter-spacing: .3px;
        }

        .brand h2 span {
            color: var(--gold-light);
        }

        /* Left text */

        .left h1 {
            font-size: 43px;
            line-height: 1.22;
            font-weight: 800;
            margin-bottom: 22px;
        }

        .left h1 span {
            color: var(--gold-light);
        }

        .left-description {
            color: #d7dfeb;
            font-size: 14px;
            line-height: 1.9;
            max-width: 430px;
        }

        /* Features */

        .features {
            display: grid;
            gap: 18px;
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
            width: 27px;
            height: 27px;
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
            color: #b5c0cf;
            font-size: 12px;
        }

        /* Right panel */

        .right {
            position: relative;
            padding: 65px 58px;
            display: flex;
            flex-direction: column;
            justify-content: center;

            background: rgba(255, 255, 255, .63);
            backdrop-filter: blur(22px);
            -webkit-backdrop-filter: blur(22px);
        }

        .right::before {
            content: "";
            position: absolute;
            width: 190px;
            height: 190px;
            top: -95px;
            right: -75px;
            border-radius: 50%;
            background: rgba(213,170,72,.09);
            filter: blur(5px);
            pointer-events: none;
        }

        .right-content {
            position: relative;
            z-index: 1;
        }

        .welcome-icon {
            width: 58px;
            height: 58px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 18px;
            margin-bottom: 23px;
            font-size: 26px;
            color: #a47b25;
            background: linear-gradient(145deg, #fff9e9, #f5ebd0);
            border: 1px solid rgba(213,170,72,.22);
            box-shadow: 0 7px 20px rgba(150,120,55,.09);
        }

        .right h1 {
            color: var(--navy);
            font-size: 34px;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .subtitle {
            color: var(--muted);
            font-size: 14px;
            margin-bottom: 34px;
            line-height: 1.6;
        }

        /* Alerts */

        .alert {
            padding: 13px 15px;
            margin-bottom: 19px;
            border-radius: 11px;
            font-size: 13px;
            color: #a52d2d;
            background: #fff0ef;
            border: 1px solid #f4d2cf;
        }

        .alert.success {
            color: #28643a;
            background: #edf7ef;
            border-color: #cce7d1;
        }

        /* Form */

        .form-group {
            margin-bottom: 23px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-size: 13px;
            font-weight: 700;
            color: #35445a;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper input {
            width: 100%;
            padding: 16px 75px 16px 17px;
            border: 1px solid #dce1e7;
            border-radius: 12px;
            background: rgba(250,251,252,.85);
            color: var(--navy);
            font-size: 14px;
            outline: none;
            transition: border .25s, box-shadow .25s, background .25s;
        }

        .input-wrapper input::placeholder {
            color: #a0a8b2;
        }

        .input-wrapper input:hover {
            border-color: #c9b77e;
            background: #fff;
        }

        .input-wrapper input:focus {
            border-color: var(--gold);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(213,170,72,.13);
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            color: #8b929e;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .5px;
            cursor: pointer;
            padding: 6px;
        }

        .toggle-password:hover {
            color: #a47b25;
        }

        .error {
            color: #c62828;
            font-size: 12px;
            margin-top: 7px;
        }

        /* Login button */

        .login-btn {
            position: relative;
            overflow: hidden;
            width: 100%;
            padding: 16px;
            margin-top: 10px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #e9c56f, #d4a642);
            color: #1d2d43;
            font-size: 15px;
            font-weight: 800;
            cursor: pointer;
            box-shadow: 0 7px 20px rgba(177,135,45,.19);
            transition: transform .25s, box-shadow .25s;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 11px 24px rgba(177,135,45,.26);
        }

        .login-btn:active {
            transform: scale(.99);
        }

        /* Signup and security */

        .signup {
            text-align: center;
            margin-top: 27px;
            color: #818b98;
            font-size: 13px;
        }

        .signup a {
            color: #a47b25;
            font-weight: 800;
            text-decoration: none;
        }

        .signup a:hover {
            text-decoration: underline;
        }

        .security {
            text-align: center;
            margin-top: 32px;
            color: #929ba6;
            font-size: 11px;
        }

        /* Responsive */

        @media(max-width: 900px) {
            .container {
                max-width: 620px;
                grid-template-columns: 1fr;
            }

            .left {
                padding: 42px;
            }

            .brand {
                margin-bottom: 35px;
            }

            .left h1 {
                font-size: 35px;
            }

            .features {
                grid-template-columns: 1fr 1fr;
            }

            .left-footer {
                margin-top: 30px;
            }

            .right {
                padding: 45px 42px;
            }
        }

        @media(max-width: 500px) {
            body {
                padding: 14px;
            }

            .container {
                border-radius: 22px;
            }

            .left {
                padding: 30px 25px;
            }

            .brand {
                margin-bottom: 32px;
            }

            .brand img {
                width: 52px;
                height: 52px;
            }

            .brand h2 {
                font-size: 22px;
            }

            .left h1 {
                font-size: 29px;
            }

            .left-description {
                font-size: 13px;
            }

            .features {
                grid-template-columns: 1fr;
                gap: 13px;
            }

            .right {
                padding: 35px 25px;
            }

            .right h1 {
                font-size: 29px;
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

    <div class="ambient one"></div>
    <div class="ambient two"></div>
    <div class="ambient three"></div>

    <main class="container">

        <!-- LEFT PANEL -->
        <section class="left">

            <div class="left-content">

                <div class="brand">
                    <img src="{{ asset('icon.png') }}" alt="Track&Tally Logo">
                    <h2>Track<span>&</span>Tally</h2>
                </div>

                <h1>
                    Manage your store.<br>
                    <span>Track your success.</span>
                </h1>

                <p class="left-description">
                    Keep your store organized with Track&Tally.
                    Manage your products, monitor sales, and keep
                    track of customer debts in one convenient place.
                </p>

                <div class="features">

                    <div class="feature">
                        <div class="check">✓</div>
                        Manage your inventory
                    </div>

                    <div class="feature">
                        <div class="check">✓</div>
                        Track daily sales
                    </div>

                    <div class="feature">
                        <div class="check">✓</div>
                        Monitor customer debts
                    </div>

                    <div class="feature">
                        <div class="check">✓</div>
                        View business reports
                    </div>

                </div>

            </div>

            <div class="left-footer">
                © {{ date('Y') }} Track&Tally. All rights reserved.
            </div>

        </section>

        <!-- RIGHT PANEL -->
        <section class="right">

            <div class="right-content">

                <div class="welcome-icon">✦</div>

                <h1>Welcome Back!</h1>

                <p class="subtitle">
                    Sign in to access your store account.
                </p>

                @if ($errors->has('login'))
                    <div class="alert">
                        {{ $errors->first('login') }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert success">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ url('/login') }}">
                    @csrf

                    <!-- Phone Number -->
                    <div class="form-group">

                        <label for="phone_number">Phone Number</label>

                        <div class="input-wrapper">
                            <input
                                type="tel"
                                id="phone_number"
                                name="phone_number"
                                placeholder="Enter your phone number"
                                value="{{ old('phone_number', session('last_phone')) }}"
                                autocomplete="tel"
                                required
                            >
                        </div>

                        @error('phone_number')
                            <div class="error">{{ $message }}</div>
                        @enderror

                    </div>

                    <!-- Password -->
                    <div class="form-group">

                        <label for="password">Password</label>

                        <div class="input-wrapper">
                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Enter your password"
                                autocomplete="current-password"
                                required
                            >

                            <button
                                type="button"
                                class="toggle-password"
                                id="togglePassword"
                                aria-label="Show password"
                            >
                                SHOW
                            </button>
                        </div>

                        @error('password')
                            <div class="error">{{ $message }}</div>
                        @enderror

                    </div>

                    <button type="submit" class="login-btn">
                        Sign In →
                    </button>

                </form>

                <div class="signup">
                    Don't have an account?
                    <a href="{{ url('/signup') }}">Create Account</a>
                </div>

                <div class="security">
                    🔒 Your store account is protected.
                </div>

            </div>

        </section>

    </main>

    <script>
        // Show / Hide Password
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');

        togglePassword.addEventListener('click', function () {

            const isHidden = passwordInput.type === 'password';

            passwordInput.type = isHidden ? 'text' : 'password';

            this.textContent = isHidden ? 'HIDE' : 'SHOW';

            this.setAttribute(
                'aria-label',
                isHidden ? 'Hide password' : 'Show password'
            );

        });
    </script>

</body>
</html>
