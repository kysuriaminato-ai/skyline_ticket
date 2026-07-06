<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?? 'Đăng nhập - Skyline Ticket' ?></title>
    <meta name="description" content="Đăng nhập vào Skyline Ticket - Hệ thống đặt vé máy bay trực tuyến hàng đầu Việt Nam">
    <!-- Bootstrap 5 & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* ============================================= */
        /*          DESIGN TOKENS & VARIABLES            */
        /* ============================================= */
        :root {
            --font-heading: 'Outfit', sans-serif;
            --font-body: 'Inter', sans-serif;

            /* Primary palette - Sky & Ocean */
            --sky-light: #b8e4f0;
            --sky-mid: #7cc8e6;
            --sky-deep: #1a73a7;
            --ocean-dark: #0c3547;

            /* Accent - Coral Sunset */
            --coral: #e07a5f;
            --coral-hover: #c4694f;
            --coral-light: #f4a58a;
            --coral-glow: rgba(224, 122, 95, 0.4);

            /* Warm tones */
            --peach: #f8c8a4;
            --sand: #f5deb3;
            --warm-white: #fdf8f3;

            /* Neutrals */
            --white: #ffffff;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;

            /* Effects */
            --glass-bg: rgba(255, 255, 255, 0.12);
            --glass-border: rgba(255, 255, 255, 0.25);
            --glass-shadow: 0 8px 32px rgba(12, 53, 71, 0.15);
            --card-shadow: 0 20px 60px rgba(12, 53, 71, 0.12);
            --input-shadow: 0 2px 8px rgba(12, 53, 71, 0.06);

            /* Transitions */
            --ease-out: cubic-bezier(0.16, 1, 0.3, 1);
            --ease-spring: cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        /* ============================================= */
        /*               GLOBAL RESET                    */
        /* ============================================= */
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--font-body);
            min-height: 100vh;
            overflow: hidden;
            position: relative;
            background: linear-gradient(180deg,
                #a8d8ea 0%,
                #b8e4f0 15%,
                #d4eef7 30%,
                #e8d5c4 55%,
                #f0c5a8 70%,
                #d4a585 85%,
                #c49070 100%
            );
        }

        /* ============================================= */
        /*         BACKGROUND IMAGE & OVERLAY            */
        /* ============================================= */
        .bg-airport {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        .bg-airport img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center bottom;
        }

        .bg-airport::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                180deg,
                rgba(168, 216, 234, 0.3) 0%,
                rgba(184, 228, 240, 0.15) 30%,
                rgba(240, 197, 168, 0.1) 60%,
                rgba(196, 144, 112, 0.2) 100%
            );
        }

        /* ============================================= */
        /*          FLOATING CLOUDS ANIMATION            */
        /* ============================================= */
        .cloud {
            position: fixed;
            z-index: 1;
            opacity: 0.5;
            filter: blur(1px);
            animation: floatCloud linear infinite;
        }

        .cloud-1 {
            top: 8%;
            left: -200px;
            width: 180px;
            height: 60px;
            background: radial-gradient(ellipse, rgba(255,255,255,0.7) 0%, transparent 70%);
            animation-duration: 45s;
        }

        .cloud-2 {
            top: 15%;
            left: -150px;
            width: 120px;
            height: 45px;
            background: radial-gradient(ellipse, rgba(255,255,255,0.5) 0%, transparent 70%);
            animation-duration: 55s;
            animation-delay: -15s;
        }

        .cloud-3 {
            top: 5%;
            left: -250px;
            width: 220px;
            height: 70px;
            background: radial-gradient(ellipse, rgba(255,255,255,0.6) 0%, transparent 70%);
            animation-duration: 65s;
            animation-delay: -30s;
        }

        @keyframes floatCloud {
            0% { transform: translateX(-200px); }
            100% { transform: translateX(calc(100vw + 300px)); }
        }

        /* ============================================= */
        /*          FLOATING PLANE ANIMATION             */
        /* ============================================= */
        .flying-plane {
            position: fixed;
            z-index: 2;
            font-size: 22px;
            color: rgba(12, 53, 71, 0.35);
            animation: flyPlane 20s linear infinite;
            filter: drop-shadow(2px 2px 4px rgba(0,0,0,0.1));
        }

        .flying-plane:nth-child(2) {
            font-size: 16px;
            color: rgba(12, 53, 71, 0.2);
            animation-duration: 28s;
            animation-delay: -8s;
        }

        @keyframes flyPlane {
            0% {
                top: 25%;
                left: -5%;
                transform: rotate(-8deg) scale(0.8);
                opacity: 0;
            }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% {
                top: 8%;
                left: 105%;
                transform: rotate(-8deg) scale(1.1);
                opacity: 0;
            }
        }

        /* ============================================= */
        /*           MAIN GLASS CONTAINER                */
        /* ============================================= */
        .main-container {
            position: relative;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .glass-frame {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.35);
            border-radius: 28px;
            box-shadow:
                0 25px 80px rgba(12, 53, 71, 0.15),
                0 8px 32px rgba(12, 53, 71, 0.08),
                inset 0 1px 0 rgba(255, 255, 255, 0.4);
            width: 100%;
            max-width: 1050px;
            display: flex;
            overflow: hidden;
            animation: frameSlideUp 0.8s var(--ease-out) both;
        }

        @keyframes frameSlideUp {
            from {
                opacity: 0;
                transform: translateY(40px) scale(0.97);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* ============================================= */
        /*            LEFT SIDE - BRANDING               */
        /* ============================================= */
        .brand-side {
            flex: 1.15;
            padding: 50px 45px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Decorative gradient orb */
        .brand-side::before {
            content: '';
            position: absolute;
            top: -60px;
            left: -60px;
            width: 250px;
            height: 250px;
            background: radial-gradient(circle, rgba(224, 122, 95, 0.2) 0%, transparent 70%);
            border-radius: 50%;
            animation: pulseOrb 6s ease-in-out infinite;
        }

        @keyframes pulseOrb {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.15); opacity: 0.8; }
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 40px;
            animation: fadeInDown 0.6s var(--ease-out) 0.2s both;
        }

        .brand-logo .logo-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--coral) 0%, var(--coral-light) 100%);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 22px;
            box-shadow: 0 8px 24px var(--coral-glow);
            transition: transform 0.3s var(--ease-spring);
        }

        .brand-logo .logo-icon:hover {
            transform: rotate(-8deg) scale(1.08);
        }

        .brand-logo .logo-text {
            font-family: var(--font-heading);
            font-weight: 800;
            font-size: 24px;
            color: var(--ocean-dark);
            letter-spacing: 0.5px;
        }

        .brand-logo .logo-text span {
            color: var(--coral);
        }

        .brand-headline {
            font-family: var(--font-heading);
            font-size: 42px;
            font-weight: 800;
            line-height: 1.15;
            color: var(--ocean-dark);
            margin-bottom: 16px;
            animation: fadeInDown 0.6s var(--ease-out) 0.35s both;
        }

        .brand-headline .highlight {
            background: linear-gradient(135deg, var(--coral) 0%, var(--coral-light) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .brand-subtitle {
            font-size: 16px;
            color: var(--gray-600);
            line-height: 1.6;
            margin-bottom: 35px;
            max-width: 380px;
            animation: fadeInDown 0.6s var(--ease-out) 0.5s both;
        }

        /* Stats row */
        .brand-stats {
            display: flex;
            gap: 30px;
            animation: fadeInDown 0.6s var(--ease-out) 0.65s both;
        }

        .stat-item {
            text-align: center;
        }

        .stat-value {
            font-family: var(--font-heading);
            font-size: 28px;
            font-weight: 800;
            color: var(--ocean-dark);
            line-height: 1;
        }

        .stat-value .plus {
            color: var(--coral);
            font-size: 22px;
        }

        .stat-label {
            font-size: 12px;
            color: var(--gray-500);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 4px;
            font-weight: 600;
        }

        .stat-divider {
            width: 1px;
            background: var(--gray-300);
            align-self: stretch;
        }

        /* Nav links on left side */
        .brand-nav {
            display: flex;
            gap: 24px;
            margin-bottom: 8px;
            animation: fadeInDown 0.6s var(--ease-out) 0.15s both;
        }

        .brand-nav a {
            font-size: 14px;
            font-weight: 500;
            color: var(--gray-600);
            text-decoration: none;
            transition: color 0.3s ease;
            position: relative;
        }

        .brand-nav a::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--coral);
            border-radius: 2px;
            transition: width 0.3s var(--ease-out);
        }

        .brand-nav a:hover {
            color: var(--coral);
        }

        .brand-nav a:hover::after {
            width: 100%;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ============================================= */
        /*           RIGHT SIDE - LOGIN FORM             */
        /* ============================================= */
        .form-side {
            flex: 0.85;
            padding: 50px 45px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background: var(--white);
            border-radius: 22px;
            padding: 42px 36px;
            width: 100%;
            max-width: 380px;
            box-shadow:
                0 20px 60px rgba(12, 53, 71, 0.1),
                0 4px 16px rgba(12, 53, 71, 0.05);
            animation: cardSlideUp 0.7s var(--ease-out) 0.3s both;
            position: relative;
            overflow: hidden;
        }

        /* Decorative top gradient line */
        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--coral) 0%, var(--coral-light) 50%, var(--sky-mid) 100%);
        }

        @keyframes cardSlideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-title {
            font-family: var(--font-heading);
            font-size: 26px;
            font-weight: 700;
            color: var(--gray-800);
            margin-bottom: 6px;
        }

        .form-subtitle {
            font-size: 14px;
            color: var(--gray-500);
            margin-bottom: 32px;
        }

        /* Form Groups */
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--gray-600);
            margin-bottom: 8px;
            letter-spacing: 0.3px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
            font-size: 16px;
            transition: color 0.3s ease;
            z-index: 2;
        }

        .input-wrapper input {
            width: 100%;
            padding: 14px 16px 14px 46px;
            border: 2px solid var(--gray-200);
            border-radius: 12px;
            font-family: var(--font-body);
            font-size: 15px;
            color: var(--gray-800);
            background: var(--gray-50);
            transition: all 0.3s var(--ease-out);
            outline: none;
        }

        .input-wrapper input::placeholder {
            color: var(--gray-400);
            font-weight: 400;
        }

        .input-wrapper input:focus {
            border-color: var(--coral);
            background: var(--white);
            box-shadow: 0 0 0 4px var(--coral-glow);
        }

        .input-wrapper input:focus ~ .input-icon {
            color: var(--coral);
        }

        /* Password toggle */
        .toggle-password {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--gray-400);
            cursor: pointer;
            padding: 4px;
            font-size: 16px;
            transition: color 0.3s ease;
            z-index: 2;
        }

        .toggle-password:hover {
            color: var(--coral);
        }

        /* Remember me */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
        }

        .custom-check {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .custom-check input[type="checkbox"] {
            appearance: none;
            -webkit-appearance: none;
            width: 18px;
            height: 18px;
            border: 2px solid var(--gray-300);
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
        }

        .custom-check input[type="checkbox"]:checked {
            background: var(--coral);
            border-color: var(--coral);
        }

        .custom-check input[type="checkbox"]:checked::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 12px;
            font-weight: bold;
        }

        .custom-check span {
            font-size: 13px;
            color: var(--gray-500);
        }

        .forgot-link {
            font-size: 13px;
            color: var(--coral);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .forgot-link:hover {
            color: var(--coral-hover);
        }

        /* Submit Button */
        .btn-login {
            width: 100%;
            padding: 16px;
            border: none;
            border-radius: 14px;
            font-family: var(--font-heading);
            font-size: 17px;
            font-weight: 700;
            color: var(--white);
            background: linear-gradient(135deg, var(--coral) 0%, var(--coral-light) 100%);
            cursor: pointer;
            transition: all 0.3s var(--ease-out);
            position: relative;
            overflow: hidden;
            letter-spacing: 0.5px;
            box-shadow: 0 8px 24px var(--coral-glow);
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255,255,255,0.2),
                transparent
            );
            transition: left 0.6s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(224, 122, 95, 0.5);
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login i {
            margin-left: 8px;
            transition: transform 0.3s var(--ease-spring);
        }

        .btn-login:hover i {
            transform: translateX(4px);
        }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            margin: 24px 0;
            gap: 12px;
        }

        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--gray-200);
        }

        .divider span {
            font-size: 12px;
            color: var(--gray-400);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }

        /* Register link */
        .register-section {
            text-align: center;
        }

        .register-section p {
            font-size: 14px;
            color: var(--gray-500);
            margin-bottom: 12px;
        }

        .btn-register {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 32px;
            border: 2px solid var(--gray-200);
            border-radius: 12px;
            background: var(--white);
            font-family: var(--font-heading);
            font-size: 15px;
            font-weight: 600;
            color: var(--gray-700);
            text-decoration: none;
            transition: all 0.3s var(--ease-out);
        }

        .btn-register:hover {
            border-color: var(--coral);
            color: var(--coral);
            background: rgba(224, 122, 95, 0.05);
            transform: translateY(-1px);
        }

        /* Error Alert */
        .error-alert {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            border: 1px solid #fca5a5;
            border-radius: 12px;
            padding: 12px 16px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: shakeAlert 0.4s ease;
        }

        .error-alert i {
            color: #ef4444;
            font-size: 18px;
        }

        .error-alert span {
            font-size: 14px;
            color: #991b1b;
            font-weight: 500;
        }

        @keyframes shakeAlert {
            0%, 100% { transform: translateX(0); }
            20% { transform: translateX(-8px); }
            40% { transform: translateX(8px); }
            60% { transform: translateX(-4px); }
            80% { transform: translateX(4px); }
        }

        /* ============================================= */
        /*             RESPONSIVE DESIGN                 */
        /* ============================================= */

        /* Tablet landscape */
        @media (max-width: 1024px) {
            .glass-frame {
                max-width: 900px;
            }
            .brand-side {
                padding: 40px 35px;
            }
            .brand-headline {
                font-size: 36px;
            }
            .form-side {
                padding: 40px 35px;
            }
        }

        /* Tablet portrait */
        @media (max-width: 860px) {
            body {
                overflow-y: auto;
            }

            .glass-frame {
                flex-direction: column;
                max-width: 500px;
            }

            .brand-side {
                padding: 35px 30px 20px;
                text-align: center;
                align-items: center;
            }

            .brand-nav {
                justify-content: center;
            }

            .brand-headline {
                font-size: 30px;
            }

            .brand-subtitle {
                margin-left: auto;
                margin-right: auto;
                margin-bottom: 20px;
            }

            .brand-stats {
                justify-content: center;
            }

            .form-side {
                padding: 10px 30px 35px;
            }

            .login-card {
                max-width: 100%;
            }
        }

        /* Mobile */
        @media (max-width: 560px) {
            .main-container {
                padding: 15px;
                align-items: flex-start;
                padding-top: 30px;
            }

            .glass-frame {
                border-radius: 22px;
            }

            .brand-side {
                padding: 28px 24px 15px;
            }

            .brand-logo .logo-text {
                font-size: 20px;
            }

            .brand-headline {
                font-size: 24px;
            }

            .brand-subtitle {
                font-size: 14px;
                margin-bottom: 16px;
            }

            .brand-stats {
                gap: 20px;
            }

            .stat-value {
                font-size: 22px;
            }

            .form-side {
                padding: 5px 24px 28px;
            }

            .login-card {
                padding: 30px 24px;
                border-radius: 18px;
            }

            .form-title {
                font-size: 22px;
            }

            .cloud { display: none; }
            .flying-plane { display: none; }
        }

        /* Very small mobile */
        @media (max-width: 380px) {
            .brand-side {
                padding: 20px 18px 10px;
            }

            .brand-headline {
                font-size: 22px;
            }

            .brand-nav {
                gap: 16px;
            }

            .brand-nav a {
                font-size: 12px;
            }

            .form-side {
                padding: 5px 18px 22px;
            }

            .login-card {
                padding: 24px 18px;
            }

            .form-options {
                flex-direction: column;
                gap: 10px;
                align-items: flex-start;
            }
        }

        /* Hover-capable devices only */
        @media (hover: hover) {
            .input-wrapper input:hover {
                border-color: var(--gray-300);
            }
        }

        /* Prefers reduced motion */
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>
<body>
    <!-- Background -->
    <div class="bg-airport">
        <img src="<?= BASEURL ?>/assets/images/airport_login_bg.png" alt="Airport background" loading="eager">
    </div>

    <!-- Floating Clouds -->
    <div class="cloud cloud-1"></div>
    <div class="cloud cloud-2"></div>
    <div class="cloud cloud-3"></div>

    <!-- Flying Planes -->
    <div class="flying-plane"><i class="fas fa-plane"></i></div>
    <div class="flying-plane"><i class="fas fa-plane"></i></div>

    <!-- Main Content -->
    <div class="main-container">
        <div class="glass-frame">

            <!-- LEFT SIDE: Branding -->
            <div class="brand-side">
                <!-- Navigation -->
                <nav class="brand-nav">
                    <a href="<?= BASEURL ?>/home">Trang chủ</a>
                    <a href="<?= BASEURL ?>/flight">Chuyến bay</a>
                    <a href="#">Hỗ trợ</a>
                    <a href="#">Về chúng tôi</a>
                </nav>

                <!-- Logo -->
                <div class="brand-logo">
                    <div class="logo-icon">
                        <i class="fas fa-plane-departure"></i>
                    </div>
                    <div class="logo-text">SKYLINE<span>TICKET</span></div>
                </div>

                <!-- Headline -->
                <h1 class="brand-headline">
                    Đặt vé máy bay<br>
                    <span class="highlight">trực tuyến</span><br>
                    dễ dàng & nhanh chóng
                </h1>

                <!-- Subtitle -->
                <p class="brand-subtitle">
                    Tiết kiệm thời gian, trải nghiệm dịch vụ bay đẳng cấp cùng hàng ngàn điểm đến trên khắp thế giới.
                </p>

                <!-- Stats -->
                <div class="brand-stats">
                    <div class="stat-item">
                        <div class="stat-value">500<span class="plus">+</span></div>
                        <div class="stat-label">Chuyến Bay</div>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-item">
                        <div class="stat-value">120<span class="plus">+</span></div>
                        <div class="stat-label">Điểm Đến</div>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-item">
                        <div class="stat-value">50K<span class="plus">+</span></div>
                        <div class="stat-label">Khách Hàng</div>
                    </div>
                </div>
            </div>

            <!-- RIGHT SIDE: Login Form -->
            <div class="form-side">
                <div class="login-card" id="loginCard">

                    <h2 class="form-title">Đăng nhập</h2>
                    <p class="form-subtitle">Chào mừng bạn trở lại! Vui lòng nhập thông tin của bạn.</p>

                    <!-- Error message -->
                    <?php if (!empty($data['error'])): ?>
                        <div class="error-alert">
                            <i class="fas fa-exclamation-circle"></i>
                            <span><?= $data['error'] ?></span>
                        </div>
                    <?php endif; ?>

                    <form action="<?= BASEURL ?>/auth/login" method="POST" id="loginForm">
                        <!-- Email / Username -->
                        <div class="form-group">
                            <label for="email">Email hoặc tên đăng nhập</label>
                            <div class="input-wrapper">
                                <i class="fas fa-envelope input-icon"></i>
                                <input
                                    type="text"
                                    id="email"
                                    name="email"
                                    placeholder="Nhập email hoặc tên đăng nhập..."
                                    autocomplete="username"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <label for="password">Mật khẩu</label>
                            <div class="input-wrapper">
                                <i class="fas fa-lock input-icon"></i>
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    placeholder="Nhập mật khẩu..."
                                    autocomplete="current-password"
                                    required
                                >
                                <button type="button" class="toggle-password" id="togglePassword" aria-label="Hiện/ẩn mật khẩu">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Options Row -->
                        <div class="form-options">
                            <label class="custom-check">
                                <input type="checkbox" name="remember" id="rememberMe">
                                <span>Ghi nhớ đăng nhập</span>
                            </label>
                            <a href="#" class="forgot-link">Quên mật khẩu?</a>
                        </div>

                        <!-- Login Button -->
                        <button type="submit" class="btn-login" id="btnLogin">
                            Đăng nhập <i class="fas fa-arrow-right"></i>
                        </button>
                    </form>

                    <!-- Divider -->
                    <div class="divider">
                        <span>hoặc</span>
                    </div>

                    <!-- Register -->
                    <div class="register-section">
                        <p>Bạn chưa có tài khoản?</p>
                        <a href="<?= BASEURL ?>/auth/register" class="btn-register">
                            <i class="fas fa-user-plus"></i> Đăng ký ngay
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.querySelector('i').classList.toggle('fa-eye');
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });
        }

        // Animate stats counter on load
        function animateCounter(element, target, suffix = '') {
            let current = 0;
            const increment = target / 40;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                element.innerHTML = Math.floor(current) + suffix + '<span class="plus">+</span>';
            }, 30);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const statValues = document.querySelectorAll('.stat-value');
            if (statValues.length >= 3) {
                setTimeout(() => {
                    animateCounter(statValues[0], 500, '');
                    animateCounter(statValues[1], 120, '');
                    animateCounter(statValues[2], 50, 'K');
                }, 800);
            }

            // Focus animation for email input
            const emailInput = document.getElementById('email');
            if (emailInput) {
                setTimeout(() => emailInput.focus(), 1200);
            }
        });
    </script>
</body>
</html>
