<?php
// app/Views/admin/reports.php
require_once '../app/Views/layouts/admin_header.php';
?>

<h2 class="mb-4"><i class="fas fa-file-alt"></i> Báo cáo và Thống kê</h2>

<div class="row">
    <div class="col-md-6 col-lg-3">
        <div class="card stat-card bg-success">
            <div class="card-body">
                <div class="stat-icon"><i class="fas fa-dollar-sign"></i></div>
                <div class="stat-label">Tổng Doanh thu</div>
                <div class="stat-value text-white"><?php echo number_format($data['totalRevenue']); ?></div>
                <small class="text-white">VND</small>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card stat-card bg-primary">
            <div class="card-body">
                <div class="stat-icon"><i class="fas fa-ticket-alt"></i></div>
                <div class="stat-label">Tổng Đặt chỗ</div>
                <div class="stat-value text-white"><?php echo $data['totalBookings']; ?></div>
                <small class="text-white">Vé</small>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card stat-card bg-info">
            <div class="card-body">
                <div class="stat-icon"><i class="fas fa-users"></i></div>
                <div class="stat-label">Tổng Người dùng</div>
                <div class="stat-value text-white"><?php echo $data['totalUsers']; ?></div>
                <small class="text-white">Người</small>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card stat-card bg-warning">
            <div class="card-body">
                <div class="stat-icon"><i class="fas fa-plane"></i></div>
                <div class="stat-label">Tổng Chuyến bay</div>
                <div class="stat-value text-white"><?php echo $data['totalFlights']; ?></div>
                <small class="text-white">Chuyến</small>
            </div>
        </div>
    </div>
</div>

<div class="row mt-5">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-calendar"></i> Đặt chỗ theo tháng</h5>
            </div>
            <div class="card-body">
                <?php if (empty($data['monthlyBookings'])): ?>
                    <p class="text-muted">Chưa có dữ liệu</p>
                <?php else: ?>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($data['monthlyBookings'] as $month): ?>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Tháng <?php echo $month['month']; ?></span>
                                <span class="badge bg-primary"><?php echo $month['count']; ?> đặt chỗ</span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="fas fa-money-bill"></i> Doanh thu theo tháng</h5>
            </div>
            <div class="card-body">
                <?php if (empty($data['monthlyRevenue'])): ?>
                    <p class="text-muted">Chưa có dữ liệu</p>
                <?php else: ?>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($data['monthlyRevenue'] as $month): ?>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Tháng <?php echo $month['month']; ?></span>
                                <span class="badge bg-success"><?php echo number_format($month['revenue']); ?> VND</span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="mt-4">
    <a href="<?= BASEURL ?>/admin/reports/detailed" class="btn btn-primary"><i class="fas fa-bars"></i> Xem Báo cáo Chi tiết</a>
</div>

<?php
require_once '../app/Views/layouts/admin_footer.php';
?>