<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chào mừng - Skyline Ticket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* ============================================= */
        /*               DESIGN TOKENS                   */
        /* ============================================= */
        :root {
            --font-heading: 'Outfit', sans-serif;
            --font-body: 'Inter', sans-serif;

            /* Colors */
            --navy: #0c1e3a;
            --navy-mid: #132d54;
            --navy-light: #1a3f6f;
            --sky-blue: #4a9eda;
            --sky-light: #7ec8e3;
            --coral: #e07a5f;
            --coral-light: #f4a58a;
            --gold: #f0c040;
            --white: #ffffff;
            --white-90: rgba(255,255,255,0.9);
            --white-70: rgba(255,255,255,0.7);
            --white-40: rgba(255,255,255,0.4);
            --white-20: rgba(255,255,255,0.2);
            --white-10: rgba(255,255,255,0.1);

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

        body {
            font-family: var(--font-body);
            min-height: 100vh;
            overflow: hidden;
            position: relative;
            background: var(--navy);
        }

        /* ============================================= */
        /*           BACKGROUND IMAGE                    */
        /* ============================================= */
        .splash-bg {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            z-index: 0;
        }

        .splash-bg img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center 40%;
            animation: bgZoomIn 6s ease-out forwards;
        }

        @keyframes bgZoomIn {
            0% { transform: scale(1.15); filter: brightness(0.4) blur(4px); }
            100% { transform: scale(1); filter: brightness(0.65) blur(0px); }
        }

        /* Gradient overlay */
        .splash-bg::after {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: linear-gradient(
                180deg,
                rgba(12, 30, 58, 0.5) 0%,
                rgba(12, 30, 58, 0.2) 40%,
                rgba(12, 30, 58, 0.3) 70%,
                rgba(12, 30, 58, 0.7) 100%
            );
            z-index: 1;
        }

        /* ============================================= */
        /*          FLOATING PARTICLES                   */
        /* ============================================= */
        .particles {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            z-index: 2;
            pointer-events: none;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            width: 4px; height: 4px;
            background: var(--white-40);
            border-radius: 50%;
            animation: floatParticle linear infinite;
        }

        .particle:nth-child(1) { left: 10%; animation-duration: 8s; animation-delay: 0s; width: 3px; height: 3px; }
        .particle:nth-child(2) { left: 25%; animation-duration: 10s; animation-delay: -2s; width: 5px; height: 5px; }
        .particle:nth-child(3) { left: 40%; animation-duration: 7s; animation-delay: -4s; }
        .particle:nth-child(4) { left: 55%; animation-duration: 9s; animation-delay: -1s; width: 3px; height: 3px; }
        .particle:nth-child(5) { left: 70%; animation-duration: 11s; animation-delay: -3s; width: 6px; height: 6px; }
        .particle:nth-child(6) { left: 85%; animation-duration: 8s; animation-delay: -5s; }
        .particle:nth-child(7) { left: 15%; animation-duration: 12s; animation-delay: -6s; width: 2px; height: 2px; }
        .particle:nth-child(8) { left: 60%; animation-duration: 9s; animation-delay: -7s; width: 4px; height: 4px; }

        @keyframes floatParticle {
            0% { bottom: -10px; opacity: 0; transform: translateX(0); }
            10% { opacity: 0.6; }
            90% { opacity: 0.6; }
            100% { bottom: 110%; opacity: 0; transform: translateX(30px); }
        }

        /* ============================================= */
        /*            MAIN CONTENT                       */
        /* ============================================= */
        .splash-content {
            position: relative;
            z-index: 10;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 40px 20px;
            text-align: center;
            color: var(--white);
        }

        /* Logo */
        .splash-logo {
            margin-bottom: 35px;
            animation: logoReveal 0.8s var(--ease-out) 0.2s both;
        }

        .splash-logo .logo-box {
            display: inline-flex;
            align-items: center;
            gap: 16px;
            padding: 16px 32px;
            background: var(--white-10);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--white-20);
            border-radius: 20px;
            transition: transform 0.3s var(--ease-spring);
        }

        .splash-logo .logo-box:hover {
            transform: scale(1.03);
        }

        .splash-logo .logo-icon {
            width: 52px; height: 52px;
            background: linear-gradient(135deg, var(--coral) 0%, var(--coral-light) 100%);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: var(--white);
            box-shadow: 0 8px 24px rgba(224, 122, 95, 0.4);
        }

        .splash-logo .logo-name {
            font-family: var(--font-heading);
            font-weight: 800;
            font-size: 30px;
            letter-spacing: 1px;
            color: var(--white);
        }

        .splash-logo .logo-name span {
            color: var(--coral-light);
        }

        @keyframes logoReveal {
            from { opacity: 0; transform: translateY(-30px) scale(0.9); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        /* Headline */
        .splash-headline {
            font-family: var(--font-heading);
            font-size: 56px;
            font-weight: 900;
            line-height: 1.15;
            margin-bottom: 18px;
            animation: headlineReveal 0.8s var(--ease-out) 0.45s both;
            text-shadow: 0 4px 30px rgba(0,0,0,0.3);
        }

        .splash-headline .gradient-text {
            background: linear-gradient(135deg, var(--sky-light) 0%, var(--coral-light) 50%, var(--gold) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        @keyframes headlineReveal {
            from { opacity: 0; transform: translateY(25px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Subtitle */
        .splash-subtitle {
            font-size: 18px;
            color: var(--white-70);
            line-height: 1.6;
            max-width: 550px;
            margin-bottom: 40px;
            animation: subtitleReveal 0.8s var(--ease-out) 0.65s both;
        }

        @keyframes subtitleReveal {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Welcome message for logged-in user */
        .welcome-user {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 14px 30px;
            background: linear-gradient(135deg, rgba(224, 122, 95, 0.2) 0%, rgba(244, 165, 138, 0.15) 100%);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(224, 122, 95, 0.3);
            border-radius: 50px;
            margin-bottom: 40px;
            animation: welcomeReveal 0.8s var(--ease-out) 0.85s both;
        }

        .welcome-user i {
            font-size: 20px;
            color: var(--coral-light);
        }

        .welcome-user span {
            font-size: 16px;
            font-weight: 600;
            color: var(--white-90);
        }

        .welcome-user .user-name {
            color: var(--coral-light);
            font-weight: 700;
        }

        @keyframes welcomeReveal {
            from { opacity: 0; transform: translateY(15px) scale(0.95); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        /* ============================================= */
        /*          BOTTOM INFO BAR                      */
        /* ============================================= */
        .info-bar {
            position: fixed;
            bottom: 0; left: 0;
            width: 100%;
            z-index: 15;
            padding: 20px 0;
            background: linear-gradient(0deg, rgba(12,30,58,0.8) 0%, transparent 100%);
        }

        .info-bar-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 30px;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 14px;
            animation: infoReveal 0.6s var(--ease-out) both;
        }

        .info-item:nth-child(1) { animation-delay: 1s; }
        .info-item:nth-child(2) { animation-delay: 1.15s; }
        .info-item:nth-child(3) { animation-delay: 1.3s; }

        .info-icon {
            width: 46px; height: 46px;
            background: var(--white-10);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid var(--white-20);
            border-radius: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: var(--coral-light);
            transition: all 0.3s var(--ease-spring);
        }

        .info-item:hover .info-icon {
            background: var(--coral);
            color: var(--white);
            transform: scale(1.08);
            box-shadow: 0 6px 20px rgba(224, 122, 95, 0.4);
        }

        .info-text-group {
            display: flex;
            flex-direction: column;
        }

        .info-label {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: var(--white-40);
        }

        .info-value {
            font-family: var(--font-heading);
            font-size: 16px;
            font-weight: 700;
            color: var(--white-90);
        }

        @keyframes infoReveal {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ============================================= */
        /*          PROGRESS BAR                         */
        /* ============================================= */
        .progress-container {
            width: 280px;
            margin-bottom: 15px;
            animation: progressReveal 0.6s var(--ease-out) 1s both;
        }

        .progress-bar-wrapper {
            width: 100%;
            height: 4px;
            background: var(--white-20);
            border-radius: 4px;
            overflow: hidden;
            margin-bottom: 10px;
        }

        .progress-fill {
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, var(--coral) 0%, var(--coral-light) 50%, var(--gold) 100%);
            border-radius: 4px;
            animation: progressFill 3s linear 0.5s forwards;
            box-shadow: 0 0 12px var(--coral-glow);
        }

        .progress-text {
            font-size: 13px;
            color: var(--white-40);
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        .progress-text i {
            color: var(--coral-light);
            margin-right: 6px;
            animation: spin 1.5s linear infinite;
        }

        @keyframes progressFill {
            0% { width: 0%; }
            100% { width: 100%; }
        }

        @keyframes progressReveal {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* ============================================= */
        /*          FLYING PLANE                         */
        /* ============================================= */
        .animated-plane {
            position: fixed;
            z-index: 5;
            color: var(--white-40);
            font-size: 28px;
            animation: planeFly 4s var(--ease-out) 0.5s both;
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.2));
        }

        @keyframes planeFly {
            0% {
                top: 70%;
                left: -5%;
                transform: rotate(-15deg) scale(0.6);
                opacity: 0;
            }
            15% { opacity: 0.7; }
            50% {
                top: 35%;
                left: 50%;
                transform: rotate(-10deg) scale(1);
                opacity: 0.5;
            }
            100% {
                top: 10%;
                left: 110%;
                transform: rotate(-8deg) scale(1.2);
                opacity: 0;
            }
        }

        /* ============================================= */
        /*          FADE OUT TRANSITION                  */
        /* ============================================= */
        .fade-out {
            animation: pageExit 0.6s ease-in forwards;
        }

        @keyframes pageExit {
            0% { opacity: 1; transform: scale(1); }
            100% { opacity: 0; transform: scale(1.05); filter: blur(5px); }
        }

        /* ============================================= */
        /*           RESPONSIVE                          */
        /* ============================================= */
        @media (max-width: 900px) {
            .splash-headline {
                font-size: 42px;
            }
            .info-bar-content {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }
        }

        @media (max-width: 600px) {
            .splash-headline {
                font-size: 32px;
            }
            .splash-subtitle {
                font-size: 15px;
            }
            .splash-logo .logo-name {
                font-size: 22px;
            }
            .splash-logo .logo-icon {
                width: 42px; height: 42px;
                font-size: 20px;
            }
            .welcome-user {
                padding: 10px 20px;
            }
            .welcome-user span {
                font-size: 14px;
            }
            .info-bar {
                padding: 15px 0;
            }
            .info-value {
                font-size: 14px;
            }
            .particles { display: none; }
            .animated-plane { display: none; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>
<body>
    <!-- Background Image -->
    <div class="splash-bg">
        <img src="<?= BASEURL ?>/assets/images/welcome_splash_bg.png" alt="Skyline Ticket Welcome">
    </div>

    <!-- Floating Particles -->
    <div class="particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <!-- Animated Plane -->
    <div class="animated-plane">
        <i class="fas fa-plane"></i>
    </div>

    <!-- Main Content -->
    <div class="splash-content" id="splashContent">

        <!-- Logo -->
        <div class="splash-logo">
            <div class="logo-box">
                <div class="logo-icon">
                    <i class="fas fa-plane-departure"></i>
                </div>
                <div class="logo-name">SKYLINE<span>TICKET</span></div>
            </div>
        </div>

        <!-- Headline -->
        <h1 class="splash-headline">
            Book a Flight<br>
            <span class="gradient-text">Ticket Online</span>
        </h1>

        <!-- Subtitle -->
        <p class="splash-subtitle">
            Trải nghiệm đặt vé máy bay trực tuyến dễ dàng, nhanh chóng và an toàn. Khám phá hàng ngàn chuyến bay đến mọi điểm đến trên thế giới.
        </p>

        <!-- Welcome User -->
        <?php if (isset($_SESSION['user_name'])): ?>
        <div class="welcome-user">
            <i class="fas fa-user-check"></i>
            <span>Xin chào, <span class="user-name"><?= htmlspecialchars($_SESSION['user_name']) ?></span>! Chào mừng trở lại.</span>
        </div>
        <?php endif; ?>

        <!-- Progress Bar -->
        <div class="progress-container">
            <div class="progress-bar-wrapper">
                <div class="progress-fill"></div>
            </div>
            <div class="progress-text">
                <i class="fas fa-circle-notch"></i> Đang chuyển hướng đến trang chủ...
            </div>
        </div>

    </div>

    <!-- Bottom Info Bar -->
    <div class="info-bar">
        <div class="info-bar-content">
            <!-- Call Us -->
            <div class="info-item">
                <div class="info-icon">
                    <i class="fas fa-phone-alt"></i>
                </div>
                <div class="info-text-group">
                    <span class="info-label">Gọi cho chúng tôi</span>
                    <span class="info-value">0327 936 359</span>
                </div>
            </div>

            <!-- Visit Website -->
            <div class="info-item">
                <div class="info-icon">
                    <i class="fas fa-globe"></i>
                </div>
                <div class="info-text-group">
                    <span class="info-label">Website</span>
                    <span class="info-value">www.skylineticket.com</span>
                </div>
            </div>

            <!-- Email -->
            <div class="info-item">
                <div class="info-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="info-text-group">
                    <span class="info-label">Email liên hệ</span>
                    <span class="info-value">contact@skylineticket.com</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto redirect after 3 seconds with fade-out animation
        setTimeout(function() {
            document.getElementById('splashContent').classList.add('fade-out');
            document.querySelector('.info-bar').classList.add('fade-out');
            document.querySelector('.splash-bg').style.transition = 'opacity 0.5s ease';
            document.querySelector('.splash-bg').style.opacity = '0';

            setTimeout(function() {
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                    window.location.href = '<?= BASEURL ?>/admin/dashboard';
                <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'staff'): ?>
                    window.location.href = '<?= BASEURL ?>/admin/bookingmanager';
                <?php else: ?>
                    window.location.href = '<?= BASEURL ?>/home';
                <?php endif; ?>
            }, 600);
        }, 3000);
    </script>
</body>
</html>
