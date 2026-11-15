
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer | Track&Tally</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --navy: #1c3049;
            --navy-dark: #14263c;
            --navy-light: #304e6b;
            --gold: #c49a45;
            --gold-light: #f8f0df;
            --cream: #f5f4ef;
            --white: #fff;
            --text: #263548;
            --muted: #84909e;
            --border: #e8ebef;
            --green: #24845c;
            --red: #c64d4d;
            --shadow: 0 15px 45px rgba(28,48,73,.07);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            min-height: 100vh;
            background:
                radial-gradient(circle at 8% 5%, rgba(196,154,69,.09), transparent 25%),
                radial-gradient(circle at 95% 35%, rgba(48,78,107,.05), transparent 25%),
                var(--cream);
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
        }

        button, input, textarea {
            font: inherit;
        }

        /* TOP NAVIGATION */

        .topbar {
            height: 76px;
            padding: 0 7%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(255,255,255,.94);
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 20;
            backdrop-filter: blur(15px);
            box-shadow: 0 4px 20px rgba(28,48,73,.025);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 11px;
            color: var(--navy);
            font: 800 21px 'Manrope', sans-serif;
            letter-spacing: -.7px;
        }

        .brand-mark {
            width: 42px;
            height: 42px;
            border-radius: 13px;
            display: grid;
            place-items: center;
            color: #f4d58f;
            background: linear-gradient(145deg, var(--navy-light), var(--navy-dark));
            box-shadow: 0 6px 14px rgba(28,48,73,.2);
        }

        .brand span {
            color: var(--gold);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .topbar-note {
            color: var(--muted);
            font-size: 12px;
            font-weight: 700;
        }

        .secure-label {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 15px;
            background: #f1f7f3;
            color: var(--green);
            border: 1px solid #dceee3;
            border-radius: 30px;
            font-size: 11px;
            font-weight: 800;
        }

        /* PAGE */

        .page {
            width: min(100% - 36px, 1080px);
            margin: 38px auto 55px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 27px;
            color: #788595;
            text-decoration: none;
            font-size: 12px;
            font-weight: 800;
            transition: .2s;
        }

        .back-link:hover {
            color: var(--navy);
            transform: translateX(-4px);
        }

        .heading-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 20px;
            margin-bottom: 28px;
        }

        .eyebrow {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #ae8438;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 10px;
            font-weight: 800;
            margin-bottom: 10px;
        }

        h1 {
            color: var(--navy);
            font: 800 clamp(28px, 4vw, 39px) 'Manrope', sans-serif;
            letter-spacing: -1.5px;
        }

        .subtitle {
            color: var(--muted);
            margin-top: 9px;
            font-size: 13px;
            line-height: 1.7;
        }

        .record-label {
            display: flex;
            align-items: center;
            gap: 9px;
            color: #758293;
            font-size: 11px;
            font-weight: 700;
            padding: 12px 16px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 11px;
            box-shadow: 0 4px 12px rgba(28,48,73,.025);
            white-space: nowrap;
        }

        .record-label i {
            color: var(--gold);
        }

        .record-label strong {
            color: var(--navy);
        }

        /* PROFILE BANNER */

        .profile-banner {
            position: relative;
            display: flex;
            align-items: center;
            gap: 18px;
            padding: 23px 26px;
            margin-bottom: 22px;
            border: 1px solid #e9e4d9;
            border-radius: 18px;
            background: linear-gradient(110deg, #fff, #fcfaf5);
            box-shadow: 0 7px 22px rgba(28,48,73,.035);
            overflow: hidden;
        }

        .profile-banner::after {
            content: "";
            position: absolute;
            width: 170px;
            height: 170px;
            right: -65px;
            top: -105px;
            border: 1px solid rgba(196,154,69,.17);
            border-radius: 50%;
            box-shadow: 0 0 0 20px rgba(196,154,69,.035);
            pointer-events: none;
        }

        .avatar {
            width: 65px;
            height: 65px;
            flex-shrink: 0;
            display: grid;
            place-items: center;
            border: 3px solid white;
            border-radius: 19px;
            color: #f3d796;
            background: linear-gradient(145deg, #304e6b, #172d46);
            font: 800 22px 'Manrope', sans-serif;
            overflow: hidden;
            box-shadow: 0 4px 13px rgba(28,48,73,.15);
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-info {
            min-width: 0;
        }

        .profile-info h2 {
            color: var(--navy);
            font: 800 17px 'Manrope', sans-serif;
            overflow-wrap: anywhere;
        }

        .profile-info p {
            margin-top: 6px;
            color: var(--muted);
            font-size: 11px;
        }

        .profile-info p i {
            color: var(--gold);
            margin-right: 4px;
        }

        .profile-status {
            margin-left: auto;
            padding: 9px 14px;
            color: var(--green);
            background: #eff8f2;
            border: 1px solid #dceee3;
            border-radius: 30px;
            font-size: 10px;
            font-weight: 800;
            white-space: nowrap;
        }

        /* MAIN FORM CARD */

        .form-card {
            background: var(--white);
            border: 1px solid rgba(231,233,237,.95);
            border-radius: 21px;
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .card-top {
            position: relative;
            padding: 26px 30px;
            background: linear-gradient(115deg, #203852, #304d68);
            color: white;
            display: flex;
            align-items: center;
            gap: 15px;
            overflow: hidden;
        }

        .card-top::after {
            content: "";
            position: absolute;
            width: 200px;
            height: 200px;
            right: -45px;
            top: -115px;
            border: 1px solid rgba(255,255,255,.13);
            border-radius: 50%;
            box-shadow: 0 0 0 25px rgba(255,255,255,.025),
                        0 0 0 50px rgba(255,255,255,.02);
            pointer-events: none;
        }

        .card-icon {
            width: 48px;
            height: 48px;
            flex-shrink: 0;
            display: grid;
            place-items: center;
            border-radius: 15px;
            background: rgba(255,255,255,.13);
            color: #f1d18a;
            font-size: 19px;
        }

        .card-top h2 {
            font: 800 16px 'Manrope', sans-serif;
        }

        .card-top p {
            color: rgba(255,255,255,.7);
            margin-top: 5px;
            font-size: 11px;
        }

        .form-body {
            padding: 33px;
        }

        /* ALERTS */

        .alert {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 15px 17px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 12px;
            line-height: 1.7;
        }

        .alert i {
            margin-top: 3px;
        }

        .alert-error {
            color: #9d3333;
            background: #fff3f2;
            border: 1px solid #f3d6d3;
        }

        .alert-success {
            color: #1e704d;
            background: #eff9f3;
            border: 1px solid #d1ebda;
        }

        .alert ul {
            padding-left: 18px;
            margin-top: 5px;
        }

        /* SECTION HEADINGS */

        .section-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 21px;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 11px;
            color: var(--navy);
            font: 800 15px 'Manrope', sans-serif;
        }

        .section-number {
            width: 32px;
            height: 32px;
            display: grid;
            place-items: center;
            border-radius: 10px;
            background: var(--gold-light);
            color: #a87d2c;
            font-size: 11px;
        }

        .section-description {
            color: #a0a8b2;
            font-size: 10px;
        }

        /* FORM FIELDS */

        .fields {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
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

        label {
            color: #3d4b5c;
            font-size: 11px;
            font-weight: 800;
        }

        .required {
            color: var(--red);
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap > i {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #a1aab5;
            font-size: 13px;
            pointer-events: none;
            transition: .2s;
        }

        .input-wrap input {
            padding-left: 41px;
        }

        input, textarea {
            width: 100%;
            border: 1px solid #e3e7eb;
            border-radius: 11px;
            background: #fbfcfd;
            padding: 13px 14px;
            color: var(--text);
            font: 500 12px 'DM Sans', sans-serif;
            outline: none;
            transition: border .2s, box-shadow .2s, background .2s;
        }

        input {
            min-height: 48px;
        }

        textarea {
            min-height: 116px;
            resize: vertical;
            line-height: 1.7;
        }

        input:focus, textarea:focus {
            border-color: var(--gold);
            background: white;
            box-shadow: 0 0 0 4px rgba(196,154,69,.11);
        }

        .input-wrap:focus-within > i {
            color: var(--gold);
        }

        input::placeholder, textarea::placeholder {
            color: #aab2bd;
        }

        .hint {
            color: #929ba7;
            font-size: 10px;
            line-height: 1.6;
        }

        .separator {
            height: 1px;
            background: var(--border);
            margin: 34px 0;
        }

        /* PHOTO UPLOAD */

        .photo-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 19px;
        }

        .photo-card {
            border: 1px solid var(--border);
            background: #fcfcfd;
            border-radius: 16px;
            padding: 19px;
            transition: .25s;
        }

        .photo-card:hover {
            border-color: #d9c69e;
            box-shadow: 0 9px 23px rgba(28,48,73,.055);
            transform: translateY(-2px);
        }

        .photo-heading {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--navy);
            font-size: 12px;
            font-weight: 800;
            margin-bottom: 15px;
        }

        .photo-heading i {
            width: 30px;
            height: 30px;
            display: grid;
            place-items: center;
            border-radius: 9px;
            background: var(--gold-light);
            color: var(--gold);
        }

        .photo-preview {
            height: 185px;
            width: 100%;
            border: 1px dashed #d5dbe2;
            border-radius: 13px;
            background: linear-gradient(145deg, #f8f9fa, #f0f2f5);
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            margin-bottom: 16px;
            color: #9aa4af;
            font-size: 11px;
            text-align: center;
        }

        .photo-preview img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .empty-photo {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .empty-photo i {
            font-size: 30px;
            color: #c2cad3;
        }

        input[type="file"] {
            min-height: auto;
            padding: 9px;
            background: white;
            font-size: 10px;
        }

        input[type="file"]::file-selector-button {
            border: 0;
            border-radius: 8px;
            background: #eaf0f5;
            color: var(--navy);
            padding: 9px 11px;
            margin-right: 9px;
            cursor: pointer;
            font-weight: 800;
            transition: .2s;
        }

        input[type="file"]::file-selector-button:hover {
            background: #dce6ef;
        }

        .remove-photo {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 14px;
            color: var(--red);
            font-size: 10px;
            font-weight: 700;
            cursor: pointer;
        }

        .remove-photo input {
            width: 15px;
            min-height: 15px;
            accent-color: var(--red);
        }

        .photo-note {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 19px;
            padding: 14px 16px;
            border: 1px solid #eee7d8;
            border-radius: 11px;
            color: #718093;
            background: #fcfaf5;
            font-size: 10px;
            line-height: 1.7;
        }

        .photo-note i {
            color: var(--gold);
            font-size: 15px;
        }

        /* ENHANCED BOTTOM ACTION AREA */

        .form-actions {
            position: relative;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 36px;
            padding: 25px;
            border: 1px solid #e8e6df;
            border-radius: 17px;
            background:
                radial-gradient(circle at 95% 10%, rgba(196,154,69,.10), transparent 35%),
                linear-gradient(135deg, #fafaf8, #f4f5f5);
            overflow: hidden;
        }

        .form-actions::before {
            content: "";
            position: absolute;
            top: 0;
            left: 25px;
            width: 60px;
            height: 3px;
            background: var(--gold);
            border-radius: 0 0 5px 5px;
        }

        .action-left {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .save-reminder {
            display: flex;
            align-items: center;
            gap: 8px;
            max-width: 230px;
            color: #8993a0;
            font-size: 10px;
            line-height: 1.6;
        }

        .save-reminder i {
            color: var(--gold);
            font-size: 15px;
            flex-shrink: 0;
        }

        .button-group {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .btn {
            position: relative;
            min-height: 49px;
            padding: 0 19px;
            border-radius: 11px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            border: 1px solid transparent;
            text-decoration: none;
            cursor: pointer;
            font: 800 11px 'DM Sans', sans-serif;
            transition: all .25s ease;
            white-space: nowrap;
        }

        .btn:hover {
            transform: translateY(-3px);
        }

        .btn:active {
            transform: scale(.97);
        }

        /* CANCEL */

        .btn-cancel {
            color: #667385;
            background: #fff;
            border: 1px solid #e2e6eb;
            box-shadow: 0 3px 8px rgba(28,48,73,.035);
        }

        .btn-cancel:hover {
            color: var(--navy);
            background: #f0f3f6;
            border-color: #cbd4df;
            box-shadow: 0 7px 15px rgba(28,48,73,.07);
        }

        /* RESET */

        .btn-reset {
            color: #92733c;
            background: #fffaf0;
            border: 1px solid #eadfc7;
        }

        .btn-reset:hover {
            color: #75551e;
            background: #f7ecd5;
            border-color: #d9c18e;
            box-shadow: 0 7px 15px rgba(196,154,69,.12);
        }

        .btn-reset i {
            transition: transform .35s ease;
        }

        .btn-reset:hover i {
            transform: rotate(-45deg);
        }

        /* SAVE */

        .btn-save {
            min-width: 220px;
            min-height: 59px;
            padding: 7px 15px;
            justify-content: flex-start;
            gap: 11px;
            color: white;
            background: linear-gradient(135deg, #304e6b, #172d46);
            border: 1px solid #304e6b;
            box-shadow: 0 7px 18px rgba(28,48,73,.18);
            overflow: hidden;
        }

        .btn-save::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 60%;
            height: 100%;
            background: linear-gradient(
                110deg,
                transparent,
                rgba(255,255,255,.14),
                transparent
            );
            transform: skewX(-20deg);
            transition: left .6s ease;
        }

        .btn-save:hover::before {
            left: 150%;
        }

        .btn-save:hover {
            background: linear-gradient(135deg, #3c5d7d, #1c3856);
            box-shadow: 0 11px 25px rgba(28,48,73,.25);
        }

        .save-icon {
            width: 39px;
            height: 39px;
            flex-shrink: 0;
            display: grid;
            place-items: center;
            border-radius: 11px;
            color: #f5d894;
            background: rgba(255,255,255,.13);
            font-size: 15px;
        }

        .save-text {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 3px;
        }

        .save-text strong {
            color: white;
            font-size: 12px;
            font-weight: 800;
        }

        .save-text small {
            color: rgba(255,255,255,.65);
            font-size: 9px;
            font-weight: 500;
        }

        .save-arrow {
            margin-left: auto;
            color: #f2d18b;
            font-size: 12px;
            transition: transform .2s ease;
        }

        .btn-save:hover .save-arrow {
            transform: translateX(4px);
        }

        .btn-save:disabled {
            opacity: .7;
            cursor: wait;
            transform: none;
        }

        /* BOTTOM SECURITY INFORMATION */

        .bottom-information {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 13px;
            margin-top: 19px;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 15px;
            background: rgba(255,255,255,.75);
            border: 1px solid #e9e9e4;
            border-radius: 13px;
            transition: .2s;
        }

        .info-item:hover {
            background: white;
            border-color: #ded2b8;
            transform: translateY(-2px);
        }

        .info-icon {
            width: 35px;
            height: 35px;
            flex-shrink: 0;
            display: grid;
            place-items: center;
            border-radius: 10px;
            color: var(--gold);
            background: var(--gold-light);
            font-size: 13px;
        }

        .info-item strong {
            display: block;
            color: var(--navy);
            font-size: 10px;
            font-weight: 800;
        }

        .info-item span {
            display: block;
            color: #929ba7;
            font-size: 9px;
            margin-top: 3px;
        }

        /* FOOTER */

        .footer {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 18px;
            margin-top: 25px;
            padding: 22px 25px;
            color: #8a95a2;
            background: rgba(255,255,255,.86);
            border: 1px solid #e9e9e4;
            border-radius: 16px;
            box-shadow: 0 5px 18px rgba(28,48,73,.035);
            font-size: 10px;
            overflow: hidden;
        }

        .footer::before {
            content: "";
            position: absolute;
            left: 0;
            top: 15px;
            bottom: 15px;
            width: 3px;
            background: var(--gold);
            border-radius: 0 5px 5px 0;
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .footer-logo {
            width: 35px;
            height: 35px;
            display: grid;
            place-items: center;
            border-radius: 10px;
            color: #f4d58f;
            background: var(--navy);
        }

        .footer-brand strong {
            display: block;
            color: var(--navy);
            font: 800 12px 'Manrope', sans-serif;
        }

        .footer-brand small {
            display: block;
            color: #9aa3ae;
            margin-top: 3px;
            font-size: 9px;
        }

        .footer-right {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #718093;
        }

        .footer-right i {
            color: var(--gold);
            font-size: 13px;
        }

        .copyright {
            width: 100%;
            padding-top: 14px;
            border-top: 1px solid #eceeea;
            color: #a0a8b2;
            text-align: center;
            font-size: 9px;
        }

        /* SCROLL TO TOP */

        .scroll-top {
            position: fixed;
            right: 25px;
            bottom: 25px;
            width: 43px;
            height: 43px;
            display: grid;
            place-items: center;
            color: white;
            background: var(--navy);
            border: 1px solid rgba(255,255,255,.2);
            border-radius: 13px;
            box-shadow: 0 6px 18px rgba(28,48,73,.2);
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: .25s;
            z-index: 15;
        }

        .scroll-top.visible {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .scroll-top:hover {
            background: var(--gold);
            transform: translateY(-3px);
        }

        /* RESPONSIVE */

        @media (max-width: 800px) {
            .bottom-information {
                grid-template-columns: 1fr;
            }

            .form-actions {
                align-items: stretch;
            }

            .action-left {
                justify-content: space-between;
            }
        }

        @media (max-width: 700px) {
            .topbar {
                height: 66px;
                padding: 0 18px;
            }

            .topbar-note {
                display: none;
            }

            .secure-label {
                padding: 8px 10px;
                font-size: 9px;
            }

            .brand {
                font-size: 18px;
            }

            .brand-mark {
                width: 36px;
                height: 36px;
            }

            .page {
                margin-top: 25px;
            }

            .heading-row {
                align-items: flex-start;
                flex-direction: column;
            }

            .record-label {
                display: none;
            }

            .profile-banner {
                padding: 17px;
            }

            .profile-status {
                font-size: 9px;
                padding: 7px 9px;
            }

            .form-body {
                padding: 21px;
            }

            .card-top {
                padding: 20px;
            }

            .section-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .fields,
            .photo-grid {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column;
                align-items: stretch;
                padding: 20px 16px;
                gap: 17px;
            }

            .action-left {
                flex-direction: column;
                align-items: stretch;
                gap: 12px;
            }

            .save-reminder {
                max-width: 100%;
                padding: 11px 12px;
                background: white;
                border: 1px solid #e9e9e4;
                border-radius: 9px;
            }

            .button-group {
                display: grid;
                grid-template-columns: 1fr 1.4fr;
                gap: 9px;
            }

            .button-group .btn {
                width: 100%;
                padding: 0 10px;
            }

            .btn-save {
                min-width: 0;
            }

            .btn-reset {
                font-size: 10px;
            }

            .footer {
                padding: 18px;
            }

            .footer-right {
                font-size: 9px;
            }
        }

        @media (max-width: 390px) {
            .button-group {
                grid-template-columns: 1fr;
            }

            .profile-banner {
                gap: 12px;
            }

            .profile-status {
                display: none;
            }

            .avatar {
                width: 54px;
                height: 54px;
            }

            .footer {
                flex-direction: column;
                align-items: flex-start;
            }

            .scroll-top {
                right: 14px;
                bottom: 14px;
            }
        }

        /* ACCESSIBILITY */

        button:focus-visible,
        a:focus-visible,
        input:focus-visible,
        textarea:focus-visible {
            outline: 3px solid rgba(196,154,69,.4);
            outline-offset: 3px;
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

<header class="topbar">
    <div class="brand">
        <div class="brand-mark">
            <i class="fa-solid fa-chart-simple"></i>
        </div>
        <div>Track<span>&</span>Tally</div>
    </div>

    <div class="topbar-right">
        <span class="topbar-note">Customer Management</span>
        <div class="secure-label">
            <i class="fa-solid fa-shield-halved"></i>
            Secure Records
        </div>
    </div>
</header>

<main class="page">

    <a href="{{ route('debtors.show', $debtor->id) }}" class="back-link">
        <i class="fa-solid fa-arrow-left"></i>
        Back to customer details
    </a>

    <div class="heading-row">
        <div>
            <div class="eyebrow">
                <i class="fa-solid fa-user-pen"></i>
                Customer Management
            </div>

            <h1>Edit Customer</h1>

            <p class="subtitle">
                Update personal details, credit information, and customer photos.
            </p>
        </div>

        <div class="record-label">
            <i class="fa-regular fa-id-card"></i>
            Record ID: <strong>#{{ $debtor->id }}</strong>
        </div>
    </div>

    <!-- CUSTOMER PROFILE -->
    <div class="profile-banner">

        <div class="avatar" id="profileAvatar">
            @if(!empty($debtor->profile_photo_uri))
                <img src="{{ asset($debtor->profile_photo_uri) }}" alt="Customer profile">
            @else
                {{ strtoupper(substr($debtor->full_name ?? 'C', 0, 1)) }}
            @endif
        </div>

        <div class="profile-info">
            <h2>{{ $debtor->full_name ?? 'Customer' }}</h2>
            <p>
                <i class="fa-regular fa-user"></i>
                Customer record · #{{ $debtor->id }}
            </p>
        </div>

        <div class="profile-status">
            <i class="fa-solid fa-circle-check"></i>
            Existing Record
        </div>

    </div>

    <!-- MAIN FORM -->
    <div class="form-card">

        <div class="card-top">
            <div class="card-icon">
                <i class="fa-solid fa-user-pen"></i>
            </div>

            <div>
                <h2>Customer Information</h2>
                <p>Make changes to the customer's saved information.</p>
            </div>
        </div>

        <div class="form-body">

            <!-- SUCCESS MESSAGE -->
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fa-solid fa-circle-check"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            <!-- ERROR MESSAGE -->
            @if(session('error'))
                <div class="alert alert-error">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <div>{{ session('error') }}</div>
                </div>
            @endif

            <!-- VALIDATION ERRORS -->
            @if($errors->any())
                <div class="alert alert-error">
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

            <form id="editCustomerForm"
                  action="{{ route('debtors.update', $debtor->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <!-- SECTION 01 -->
                <div class="section-heading">
                    <div class="section-title">
                        <span class="section-number">01</span>
                        Personal Information
                    </div>

                    <span class="section-description">
                        Basic customer details
                    </span>
                </div>

                <div class="fields">

                    <div class="field full">
                        <label for="full_name">
                            Full Name <span class="required">*</span>
                        </label>

                        <div class="input-wrap">
                            <i class="fa-regular fa-user"></i>

                            <input
                                type="text"
                                id="full_name"
                                name="full_name"
                                value="{{ old('full_name', $debtor->full_name ?? '') }}"
                                placeholder="Enter customer's complete name"
                                maxlength="255"
                                required
                            >
                        </div>
                    </div>

                    <div class="field">
                        <label for="contact_number">Contact Number</label>

                        <div class="input-wrap">
                            <i class="fa-solid fa-phone"></i>

                            <input
                                type="text"
                                id="contact_number"
                                name="contact_number"
                                value="{{ old('contact_number', $debtor->contact_number ?? '') }}"
                                placeholder="e.g. 09XXXXXXXXX"
                                maxlength="30"
                            >
                        </div>
                    </div>

                    <div class="field">
                        <label for="id_number">Valid ID Number</label>

                        <div class="input-wrap">
                            <i class="fa-regular fa-id-card"></i>

                            <input
                                type="text"
                                id="id_number"
                                name="id_number"
                                value="{{ old('id_number', $debtor->id_number ?? '') }}"
                                placeholder="Enter ID number"
                                maxlength="100"
                            >
                        </div>

                        <span class="hint">
                            Optional. Requires an id_number column in your database.
                        </span>
                    </div>

                    <div class="field full">
                        <label for="address">Complete Address</label>

                        <div class="input-wrap">
                            <i class="fa-solid fa-location-dot"></i>

                            <input
                                type="text"
                                id="address"
                                name="address"
                                value="{{ old('address', $debtor->address ?? '') }}"
                                placeholder="Enter complete address"
                                maxlength="1000"
                            >
                        </div>
                    </div>

                    <div class="field">
                        <label for="credit_limit">Credit Limit (₱)</label>

                        <div class="input-wrap">
                            <i class="fa-solid fa-peso-sign"></i>

                            <input
                                type="number"
                                id="credit_limit"
                                name="credit_limit"
                                value="{{ old('credit_limit', $debtor->credit_limit ?? 0) }}"
                                placeholder="0.00"
                                min="0"
                                step="0.01"
                            >
                        </div>

                        <span class="hint">
                            Maximum amount this customer is allowed to borrow.
                        </span>
                    </div>

                    <div class="field">
                        <label for="notes">Notes</label>

                        <textarea
                            id="notes"
                            name="notes"
                            placeholder="Additional information about this customer..."
                            maxlength="2000"
                        >{{ old('notes', $debtor->notes ?? '') }}</textarea>
                    </div>

                </div>

                <div class="separator"></div>

                <!-- SECTION 02 -->
                <div class="section-heading">
                    <div class="section-title">
                        <span class="section-number">02</span>
                        Customer Photos
                    </div>

                    <span class="section-description">
                        Upload or replace images
                    </span>
                </div>

                <div class="photo-grid">

                    <!-- PROFILE PHOTO -->
                    <div class="photo-card">

                        <div class="photo-heading">
                            <i class="fa-solid fa-camera"></i>
                            Profile Photo
                        </div>

                        <div class="photo-preview" id="profilePreview">
                            @if(!empty($debtor->profile_photo_uri))
                                <img
                                    src="{{ asset($debtor->profile_photo_uri) }}"
                                    alt="Current profile photo"
                                >
                            @else
                                <div class="empty-photo">
                                    <i class="fa-regular fa-image"></i>
                                    <span>No profile photo uploaded</span>
                                </div>
                            @endif
                        </div>

                        <div class="field">
                            <label for="profile_photo">Choose New Profile Photo</label>

                            <input
                                type="file"
                                id="profile_photo"
                                name="profile_photo"
                                accept="image/jpeg,image/png,image/webp"
                            >

                            <span class="hint">
                                JPG, PNG, or WEBP. Maximum 4 MB.
                            </span>
                        </div>

                        @if(!empty($debtor->profile_photo_uri))
                            <label class="remove-photo">
                                <input type="checkbox" name="remove_profile_photo" value="1">
                                Remove current profile photo
                            </label>
                        @endif

                    </div>

                    <!-- ID PHOTO -->
                    <div class="photo-card">

                        <div class="photo-heading">
                            <i class="fa-solid fa-address-card"></i>
                            Valid ID Photo
                        </div>

                        <div class="photo-preview" id="idPreview">
                            @if(!empty($debtor->id_photo_uri))
                                <img
                                    src="{{ asset($debtor->id_photo_uri) }}"
                                    alt="Current ID photo"
                                >
                            @else
                                <div class="empty-photo">
                                    <i class="fa-regular fa-image"></i>
                                    <span>No ID photo uploaded</span>
                                </div>
                            @endif
                        </div>

                        <div class="field">
                            <label for="id_photo">Choose New ID Photo</label>

                            <input
                                type="file"
                                id="id_photo"
                                name="id_photo"
                                accept="image/jpeg,image/png,image/webp"
                            >

                            <span class="hint">
                                JPG, PNG, or WEBP. Maximum 4 MB.
                            </span>
                        </div>

                        @if(!empty($debtor->id_photo_uri))
                            <label class="remove-photo">
                                <input type="checkbox" name="remove_id_photo" value="1">
                                Remove current ID photo
                            </label>
                        @endif

                    </div>

                </div>

                <div class="photo-note">
                    <i class="fa-solid fa-circle-info"></i>

                    <span>
                        Upload a clear photo. Selecting a new image will replace
                        the existing image after you save.
                    </span>
                </div>

                <!-- PREMIUM ACTION BUTTONS -->
                <div class="form-actions">

                    <div class="action-left">

                        <a href="{{ route('debtors.show', $debtor->id) }}"
                           class="btn btn-cancel">

                            <i class="fa-solid fa-arrow-left"></i>
                            Cancel
                        </a>

                        <div class="save-reminder">
                            <i class="fa-solid fa-circle-info"></i>

                            <span>
                                Your changes will be saved to this customer record.
                            </span>
                        </div>

                    </div>

                    <div class="button-group">

                        <button type="reset" class="btn btn-reset">
                            <i class="fa-solid fa-rotate-left"></i>
                            Reset Changes
                        </button>

                        <button type="submit" class="btn btn-save" id="saveButton">

                            <span class="save-icon">
                                <i class="fa-solid fa-floppy-disk"></i>
                            </span>

                            <span class="save-text">
                                <strong>Save Changes</strong>
                                <small>Update customer record</small>
                            </span>

                            <i class="fa-solid fa-arrow-right save-arrow"></i>

                        </button>

                    </div>

                </div>

            </form>

            <!-- BOTTOM INFORMATION -->
            <div class="bottom-information">

                <div class="info-item">
                    <div class="info-icon">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>

                    <div>
                        <strong>Protected Records</strong>
                        <span>Customer information management</span>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">
                        <i class="fa-solid fa-image"></i>
                    </div>

                    <div>
                        <strong>Photo Preview</strong>
                        <span>Review images before saving</span>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">
                        <i class="fa-solid fa-clipboard-check"></i>
                    </div>

                    <div>
                        <strong>Easy Management</strong>
                        <span>Keep customer details organized</span>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- FOOTER -->
    <footer class="footer">

        <div class="footer-brand">
            <div class="footer-logo">
                <i class="fa-solid fa-chart-simple"></i>
            </div>

            <div>
                <strong>Track&Tally</strong>
                <small>Smart Customer and Store Management</small>
            </div>
        </div>

        <div class="footer-right">
            <i class="fa-solid fa-shield-halved"></i>
            Customer information management
        </div>

        <div class="copyright">
            © {{ date('Y') }} Track&Tally. All rights reserved.
            Manage your customer records with confidence.
        </div>

    </footer>

</main>

<!-- SCROLL TO TOP -->
<button type="button" class="scroll-top" id="scrollTop" aria-label="Scroll to top">
    <i class="fa-solid fa-arrow-up"></i>
</button>

<script>
    // IMAGE PREVIEW
    function previewImage(inputId, previewId) {
        const input = document.getElementById(inputId);
        const preview = document.getElementById(previewId);

        if (!input || !preview) return;

        input.addEventListener('change', function () {
            const file = this.files && this.files[0];

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
                alert('The image must not exceed 4 MB.');
                this.value = '';
                return;
            }

            const reader = new FileReader();

            reader.onload = function (event) {
                preview.innerHTML = '';

                const image = document.createElement('img');
                image.src = event.target.result;
                image.alt = 'Selected photo preview';

                preview.appendChild(image);

                // Update profile avatar too
                if (inputId === 'profile_photo') {
                    const avatar = document.getElementById('profileAvatar');

                    if (avatar) {
                        avatar.innerHTML = '';

                        const avatarImage = document.createElement('img');
                        avatarImage.src = event.target.result;
                        avatarImage.alt = 'New profile preview';

                        avatar.appendChild(avatarImage);
                    }
                }
            };

            reader.readAsDataURL(file);
        });
    }

    previewImage('profile_photo', 'profilePreview');
    previewImage('id_photo', 'idPreview');

    // SUBMIT LOADING STATE
    document.getElementById('editCustomerForm').addEventListener('submit', function (event) {
        const form = this;

        if (!form.checkValidity()) {
            return;
        }

        const button = document.getElementById('saveButton');

        if (button.disabled) {
            event.preventDefault();
            return;
        }

        button.disabled = true;

        button.innerHTML = `
            <span class="save-icon">
                <i class="fa-solid fa-spinner fa-spin"></i>
            </span>
            <span class="save-text">
                <strong>Saving Changes...</strong>
                <small>Please wait</small>
            </span>
        `;
    });

    // SCROLL TO TOP BUTTON
    const scrollTopButton = document.getElementById('scrollTop');

    window.addEventListener('scroll', function () {
        if (window.scrollY > 300) {
            scrollTopButton.classList.add('visible');
        } else {
            scrollTopButton.classList.remove('visible');
        }
    });

    scrollTopButton.addEventListener('click', function () {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
</script>

</body>
</html>
