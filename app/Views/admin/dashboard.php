<?php require_once '../app/Views/layouts/admin_header.php'; ?>
<div class="container-fluid" style="padding: 20px;">
    
    <!-- Tiêu đề -->
    <div class="row mb-4">
        <div class="col-12">
            <h1>📊 Dashboard Quản Trị Hệ Thống</h1>
            <p class="text-muted">Xin chào, <strong><?= htmlspecialchars($_SESSION['user_name']) ?></strong>!</p>
        </div>
    </div>

    <!-- Thống kê -->
    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div class="card stat-card bg-primary text-white">
                <div class="card-body">
                    <div style="font-size: 2em; margin-bottom: 10px;">👥</div>
                    <div class="stat-label">Người dùng</div>
                    <div class="stat-value" style="font-size: 2.5em; font-weight: bold;"><?= $data['totalUsers']; ?></div>
                    <small>Đã đăng ký</small>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-3">
            <div class="card stat-card bg-success text-white">
                <div class="card-body">
                    <div style="font-size: 2em; margin-bottom: 10px;">✈️</div>
                    <div class="stat-label">Chuyến bay</div>
                    <div class="stat-value" style="font-size: 2.5em; font-weight: bold;"><?= $data['totalFlights']; ?></div>
                    <small>Đang hoạt động</small>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-3">
            <div class="card stat-card bg-warning text-white">
                <div class="card-body">
                    <div style="font-size: 2em; margin-bottom: 10px;">🎫</div>
                    <div class="stat-label">Đặt chỗ</div>
                    <div class="stat-value" style="font-size: 2.5em; font-weight: bold;"><?= $data['totalBookings']; ?></div>
                    <small>Vé đã đặt</small>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-3">
            <div class="card stat-card bg-info text-white">
                <div class="card-body">
                    <div style="font-size: 2em; margin-bottom: 10px;">💰</div>
                    <div class="stat-label">Doanh thu</div>
                    <div class="stat-value" style="font-size: 2.5em; font-weight: bold;"><?= number_format($data['totalRevenue']); ?></div>
                    <small>VND</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu quản lý -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">⚙️ Quản lý Hệ thống</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-3 mb-3">
                            <a href="<?= BASEURL ?>/admin/flights" class="btn btn-primary btn-block" style="padding: 20px; text-align: center; font-size: 1.1em;">
                                ✈️<br>Quản lý Chuyến bay
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-3 mb-3">
                            <a href="<?= BASEURL ?>/admin/users" class="btn btn-secondary btn-block" style="padding: 20px; text-align: center; font-size: 1.1em;">
                                👥<br>Quản lý Người dùng
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-3 mb-3">
                            <a href="<?= BASEURL ?>/admin/bookings" class="btn btn-info btn-block" style="padding: 20px; text-align: center; font-size: 1.1em;">
                                🎫<br>Quản lý Đặt chỗ
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-3 mb-3">
                            <a href="<?= BASEURL ?>/admin/reports" class="btn btn-success btn-block" style="padding: 20px; text-align: center; font-size: 1.1em;">
                                📈<br>Báo cáo & Thống kê
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<style>
.card {
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    margin-bottom: 20px;
    border: none;
}

.stat-card {
    border: none;
    border-radius: 5px;
}

.stat-label {
    font-size: 0.9em;
    opacity: 0.9;
    margin-bottom: 10px;
}

.stat-value {
    color: white;
}

.btn-block {
    display: block;
    width: 100%;
    border-radius: 5px;
    border: none;
    transition: all 0.3s ease;
}

.btn-block:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.btn-primary:hover { background-color: #0056b3 !important; }
.btn-secondary:hover { background-color: #545b62 !important; }
.btn-info:hover { background-color: #0c5460 !important; }
.btn-success:hover { background-color: #1e7e34 !important; }
</style>

<?php
require_once '../app/Views/layouts/admin_footer.php';
?>

