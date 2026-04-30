<?php
// app/Views/admin/dashboard.php
require_once '../app/Views/layouts/admin_header.php';
?>

<div class="row">
    <div class="col-md-6 col-lg-3">
        <a href="/admin/usermanager" class="stat-card-link">
            <div class="card stat-card bg-primary">
                <div class="card-body">
                    <div class="stat-icon"><i class="fas fa-users"></i></div>
                    <div class="stat-label">Người dùng</div>
                    <div class="stat-value text-white"><?php echo $data['totalUsers']; ?></div>
                    <small class="text-white">Đã đăng ký</small>
                </div>
            </div>
        </a>
    </div>
    
    <div class="col-md-6 col-lg-3">
        <a href="/admin/flightmanager" class="stat-card-link">
            <div class="card stat-card bg-success">
                <div class="card-body">
                    <div class="stat-icon"><i class="fas fa-plane"></i></div>
                    <div class="stat-label">Chuyến bay</div>
                    <div class="stat-value text-white"><?php echo $data['totalFlights']; ?></div>
                    <small class="text-white">Đang hoạt động</small>
                </div>
            </div>
        </a>
    </div>
    
    <div class="col-md-6 col-lg-3">
        <a href="/admin/bookingmanager" class="stat-card-link">
            <div class="card stat-card bg-warning">
                <div class="card-body">
                    <div class="stat-icon"><i class="fas fa-ticket-alt"></i></div>
                    <div class="stat-label">Đặt chỗ</div>
                    <div class="stat-value text-white"><?php echo $data['totalBookings']; ?></div>
                    <small class="text-white">Vé đã đặt</small>
                </div>
            </div>
        </a>
    </div>
    
    <div class="col-md-6 col-lg-3">
        <a href="/admin/reports" class="stat-card-link">
            <div class="card stat-card bg-info">
                <div class="card-body">
                    <div class="stat-icon"><i class="fas fa-dollar-sign"></i></div>
                    <div class="stat-label">Doanh thu</div>
                    <div class="stat-value text-white"><?php echo number_format($data['totalRevenue']); ?></div>
                    <small class="text-white">VND</small>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-cogs"></i> Quản lý Hệ thống</h5>
            </div>
            <div class="card-body">
                <p>Chọn chức năng quản trị:</p>
                <div class="action-menu">
                    <a href="/admin/flightmanager" class="btn action-btn btn-primary">
                        <i class="fas fa-plane-departure"></i> Quản lý Chuyến bay
                    </a>
                    <a href="/admin/usermanager" class="btn action-btn btn-secondary">
                        <i class="fas fa-users"></i> Quản lý Người dùng
                    </a>
                    <a href="/admin/bookingmanager" class="btn action-btn btn-info">
                        <i class="fas fa-ticket-alt"></i> Quản lý Đặt chỗ
                    </a>
                    <a href="/admin/reports" class="btn action-btn btn-success">
                        <i class="fas fa-file-alt"></i> Báo cáo & Thống kê
                    </a>
                    <a href="/admin/settings" class="btn action-btn btn-warning">
                        <i class="fas fa-cog"></i> Cài đặt Hệ thống
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once '../app/Views/layouts/admin_footer.php';
?>