<!-- app/Views/layouts/header.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= defined('SITENAME') ? SITENAME : 'Skyline Ticket'; ?></title>
    <!-- Đã fix lỗi link CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASEURL ?>/css/style.css"> 
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-custom sticky-top" style="background: linear-gradient(135deg, #a1c4fd 0%, #c2e9fb 100%);">
    <div class="container">
        <a class="navbar-brand fw-bold fs-3" style="color: #0c3547;" href="<?= BASEURL ?>/home">
            <i class="fas fa-plane-departure me-2"></i>SKYLINE TICKET
        </a>
        <button class="navbar-toggler border-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <i class="fas fa-bars" style="color: #0c3547;"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link fw-bold" style="color: #0c3547;" href="<?= BASEURL ?>/home"><?= __('header.home') ?></a></li>
                <li class="nav-item"><a class="nav-link fw-bold" style="color: #0c3547;" href="<?= BASEURL ?>/flight">Chuyến bay</a></li>
                
                <li class="nav-item dropdown me-3">
                    <a class="nav-link dropdown-toggle fw-bold" style="color: #0c3547;" href="#" data-bs-toggle="dropdown">
                        <i class="fas fa-globe"></i> <?= ($_SESSION['lang'] ?? 'vi') === 'vi' ? 'VN' : 'EN' ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" style="min-width: 100px;">
                        <li><a class="dropdown-item py-2 fw-bold" href="<?= BASEURL ?>/lang/change/vi"><img src="https://flagcdn.com/w20/vn.png" class="me-2"> VN</a></li>
                        <li><a class="dropdown-item py-2 fw-bold" href="<?= BASEURL ?>/lang/change/en"><img src="https://flagcdn.com/w20/us.png" class="me-2"> EN</a></li>
                    </ul>
                </li>
                
                <?php if(isset($_SESSION['user_name'])): ?>
                    <li class="nav-item dropdown">
                        <a class="btn btn-outline-dark rounded-pill px-4 dropdown-toggle fs-5 fw-bold" href="#" data-bs-toggle="dropdown" style="border-color: #0c3547; color: #0c3547;">
                            <i class="fas fa-user-circle me-1"></i> <?= __('header.welcome') ?> <?= htmlspecialchars($_SESSION['user_name']); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                            <li><a class="dropdown-item py-2 fw-bold text-dark" href="<?= BASEURL ?>/profile"><i class="fas fa-list-alt me-2"></i>Lịch sử vé của tôi</a></li>

                            <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                                <li><a class="dropdown-item py-2 fw-bold text-primary" href="<?= BASEURL ?>/admin/dashboard"><i class="fas fa-cogs me-2"></i>Trang Quản trị</a></li>
                            <?php endif; ?>
                            <li><a class="dropdown-item py-2 text-danger fw-bold" href="<?= BASEURL ?>/auth/logout"><i class="fas fa-sign-out-alt me-2"></i><?= __('header.logout') ?></a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                        <a class="btn btn-outline-dark rounded-pill px-4 me-2 fs-5 fw-bold" href="<?= BASEURL ?>/auth/login" style="border-color: #0c3547; color: #0c3547;"><?= __('header.login') ?></a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>