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

<nav class="navbar navbar-expand-lg navbar-custom sticky-top">
    <div class="container">
        <a class="navbar-brand" href="<?= BASEURL ?>/home">
            <i class="fas fa-plane-departure me-2"></i>SKYLINE TICKET
        </a>
        <button class="navbar-toggler border-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <i class="fas fa-bars text-white"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link" href="<?= BASEURL ?>/home">Trang chủ</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= BASEURL ?>/flight">Chuyến bay</a></li>
                
                <?php if(isset($_SESSION['user_name'])): ?>
                    <li class="nav-item dropdown">
                        <a class="btn btn-outline-light rounded-pill px-4 dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i> Xin chào, <?= htmlspecialchars($_SESSION['user_name']); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                            <!-- Dưới nút "Trang quản trị" (nếu có), thêm dòng này: -->
<li><a class="dropdown-item py-2 fw-bold text-dark" href="<?= BASEURL ?>/profile"><i class="fas fa-list-alt me-2"></i>Lịch sử vé của tôi</a></li>

                            <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                                <li><a class="dropdown-item py-2 fw-bold text-primary" href="<?= BASEURL ?>/admin/dashboard"><i class="fas fa-cogs me-2"></i>Trang Quản trị</a></li>
                            <?php endif; ?>
                            <li><a class="dropdown-item py-2 text-danger fw-bold" href="<?= BASEURL ?>/auth/logout"><i class="fas fa-sign-out-alt me-2"></i>Đăng xuất</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                        <a class="btn btn-outline-light rounded-pill px-4 me-2" href="<?= BASEURL ?>/auth/login">Đăng nhập</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>