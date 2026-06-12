<?php
// app/Views/admin/dashboard.php
require_once '../app/Views/layouts/admin_header.php';
require_once '../app/Core/Database.php';

// ================= LẤY 100% DỮ LIỆU THỰC TẾ TỪ DATABASE =================
$db = new Database();

// 1. TỔNG QUAN
$db->query("SELECT SUM(total_price) as revenue FROM bookings WHERE status != 'cancelled'");
$totalRevenue = $db->single()['revenue'] ?? 0;

$db->query("SELECT COUNT(*) as total FROM bookings");
$totalBookings = $db->single()['total'] ?? 0;

$db->query("SELECT COUNT(DISTINCT flight_id) as total_active FROM bookings WHERE status != 'cancelled'");
$totalFlights = $db->single()['total_active'] ?? 0;

$db->query("SELECT COUNT(*) as total FROM users WHERE role != 'admin'");
$totalUsers = $db->single()['total'] ?? 0;

// 2. DỮ LIỆU BIỂU ĐỒ DOANH THU THEO 12 THÁNG
$currentYear = date('Y');
$monthlyRevenue = array_fill(1, 12, 0); // Khởi tạo mảng 12 tháng, tất cả bằng 0

$db->query("SELECT MONTH(created_at) as m, SUM(total_price) as total 
            FROM bookings 
            WHERE YEAR(created_at) = :year AND status != 'cancelled'
            GROUP BY MONTH(created_at)");
$db->bind(':year', $currentYear);
$revenueData = $db->resultSet();

foreach($revenueData as $row) {
    $monthlyRevenue[$row['m']] = (int)$row['total'];
}
$monthlyRevenueJS = implode(',', array_values($monthlyRevenue)); 

// 3. DỮ LIỆU BÁO CÁO TRONG MODAL
$db->query("SELECT SUM(total_price) as total FROM bookings WHERE DATE(created_at) = CURDATE() AND status != 'cancelled'");
$revenueToday = $db->single()['total'] ?? 0;

$db->query("SELECT SUM(total_price) as total FROM bookings WHERE YEARWEEK(created_at, 1) = YEARWEEK(CURDATE(), 1) AND status != 'cancelled'");
$revenueWeek = $db->single()['total'] ?? 0;

// Trạng thái vé (Doughnut Chart)
$db->query("SELECT status, COUNT(*) as count FROM bookings GROUP BY status");
$statusData = $db->resultSet();
$statusCount = ['confirmed' => 0, 'pending' => 0, 'cancelled' => 0];
foreach($statusData as $st) {
    $statusCount[$st['status']] = $st['count'];
}
?>

<!-- Nạp thư viện Chart.js để vẽ biểu đồ -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- ================= CSS TÙY CHỈNH ================= -->
<style>
    :root {
        --primary-color: #4e73df; --success-color: #1cc88a; --info-color: #36b9cc;
        --warning-color: #f6c23e; --danger-color: #e74a3b; --dark-color: #5a5c69; --light-bg: #f8f9fc;
    }
    body { background-color: #f4f7f6; }
    .page-title { font-weight: 800; color: var(--dark-color); text-transform: uppercase; letter-spacing: 1px; }
    .btn-download { transition: all 0.3s ease; background: linear-gradient(45deg, var(--primary-color), #2e59d9); border: none; box-shadow: 0 4px 10px rgba(78, 115, 223, 0.3); }
    .btn-download:hover { transform: translateY(-2px); box-shadow: 0 6px 15px rgba(78, 115, 223, 0.5); }
    .summary-card { cursor: pointer; transition: all 0.4s; border: none !important; border-radius: 16px !important; position: relative; overflow: hidden; box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1) !important; }
    .summary-card::before { content: ""; position: absolute; top: 0; left: 0; width: 6px; height: 100%; transition: 0.4s; }
    .summary-card.card-success::before { background-color: var(--success-color); }
    .summary-card.card-info::before { background-color: var(--info-color); }
    .summary-card.card-warning::before { background-color: var(--warning-color); }
    .summary-card.card-primary::before { background-color: var(--primary-color); }
    .summary-card:hover { transform: translateY(-8px); box-shadow: 0 15px 25px -10px rgba(0,0,0,0.2) !important; }
    .summary-card:hover::before { width: 100%; opacity: 0.08; }
    .icon-wrapper { display: inline-flex; align-items: center; justify-content: center; width: 65px; height: 65px; border-radius: 50%; background: rgba(0,0,0,0.03); transition: 0.4s; }
    .summary-card:hover .icon-wrapper { transform: scale(1.15) rotate(10deg); background: rgba(0,0,0,0.08); }
    .dashboard-panel { border-radius: 16px; border: 1px solid rgba(0,0,0,0.03); box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.05) !important; background: #fff; }
    .dashboard-panel .card-header { border-radius: 16px 16px 0 0 !important; background-color: #ffffff; border-bottom: 1px solid rgba(0,0,0,0.05) !important; padding: 1.25rem 1.5rem; }
    .btn-quick-action { border-radius: 12px; border-width: 2px; }
    .btn-quick-action:hover { transform: translateX(8px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
    .custom-modal .modal-content { border-radius: 20px; border: none; box-shadow: 0 20px 50px rgba(0,0,0,0.2); }
    .stat-box { border-radius: 16px; border: 1px solid #e3e6f0; background: #fff; transition: 0.3s; }
    .stat-box:hover { transform: translateY(-5px); box-shadow: 0 8px 20px rgba(0,0,0,0.08); }
    .search-input-modern { border-radius: 50px 0 0 50px; padding-left: 20px; border: 2px solid #eaecf4; }
    .search-input-modern:focus { border-color: var(--primary-color); box-shadow: none; }
    .search-btn-modern { border-radius: 0 50px 50px 0; border: 2px solid var(--primary-color); padding: 0 25px; }
</style>

<div class="container-fluid pt-4 pb-5">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 page-title">Bảng điều khiển quản trị</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-primary btn-download rounded-pill px-4 py-2 text-white">
            <i class="fas fa-file-pdf fa-sm me-2"></i> Tải báo cáo PDF
        </a>
    </div>

    <!-- HÀNG 1: THỐNG KÊ TỔNG QUAN -->
    <div class="row mb-2">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card summary-card card-success h-100 py-2" data-bs-toggle="modal" data-bs-target="#revenueModal">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-2" style="font-size: 13px; letter-spacing: 1px;">Tổng Doanh Thu</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?= number_format($totalRevenue) ?> đ</div>
                        </div>
                        <div class="col-auto">
                            <div class="icon-wrapper"><i class="fas fa-hand-holding-usd fa-2x text-success" style="opacity: 0.8;"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card summary-card card-info h-100 py-2" data-bs-toggle="modal" data-bs-target="#bookingsModal">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-2" style="font-size: 13px; letter-spacing: 1px;">Tổng Số Vé Bán</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?= number_format($totalBookings) ?></div>
                        </div>
                        <div class="col-auto">
                            <div class="icon-wrapper"><i class="fas fa-ticket-alt fa-2x text-info" style="opacity: 0.8;"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card summary-card card-warning h-100 py-2" data-bs-toggle="modal" data-bs-target="#flightsModal">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-2" style="font-size: 13px; letter-spacing: 1px;">Chuyến Bay Hoạt Động</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?= number_format($totalFlights) ?></div>
                        </div>
                        <div class="col-auto">
                            <div class="icon-wrapper"><i class="fas fa-plane-departure fa-2x text-warning" style="opacity: 0.8;"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card summary-card card-primary h-100 py-2" data-bs-toggle="modal" data-bs-target="#usersModal">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-2" style="font-size: 13px; letter-spacing: 1px;">Tổng Khách Hàng</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?= number_format($totalUsers) ?></div>
                        </div>
                        <div class="col-auto">
                            <div class="icon-wrapper"><i class="fas fa-users fa-2x text-primary" style="opacity: 0.8;"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- HÀNG 2: BIỂU ĐỒ -->
    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card dashboard-panel mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary fw-bold"><i class="fas fa-chart-line me-2"></i> Doanh thu 12 Tháng (Năm <?= $currentYear ?>)</h6>
                </div>
                <div class="card-body pt-4">
                    <div class="chart-area" style="position: relative; height: 320px; width: 100%;">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-5">
            <div class="card dashboard-panel mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary fw-bold"><i class="fas fa-chart-pie me-2"></i> Tỉ lệ Trạng thái Vé</h6>
                </div>
                <div class="card-body pt-4">
                    <div class="chart-pie pt-2 pb-2" style="position: relative; height: 240px; width: 100%;">
                        <canvas id="statusChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small fw-bold text-muted">
                        <span class="me-3"><i class="fas fa-circle text-success me-1"></i> Đã thanh toán (<?= $statusCount['confirmed'] ?>)</span>
                        <span class="me-3"><i class="fas fa-circle text-warning me-1"></i> Chờ xử lý (<?= $statusCount['pending'] ?>)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- HÀNG 3 & 4 (Quick Actions) -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card dashboard-panel h-100">
                <div class="card-header"><h6 class="m-0 font-weight-bold text-primary fw-bold"><i class="fas fa-search-location me-2"></i> Quản lý Chuyến bay</h6></div>
                <div class="card-body">
                    <div class="d-flex justify-content-between gap-3 mt-2">
                        <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                            <a href="<?= BASEURL ?>/admin/flightmanager/create" class="btn btn-success flex-grow-1 fw-bold rounded-pill py-2 shadow-sm"><i class="fas fa-plus-circle me-1"></i> Thêm chuyến bay</a>
                        <?php endif; ?>
                        <a href="<?= BASEURL ?>/admin/flightmanager" class="btn btn-light border flex-grow-1 fw-bold rounded-pill py-2 shadow-sm text-dark"><i class="fas fa-list me-1 text-primary"></i> Xem danh sách</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card dashboard-panel h-100">
                <div class="card-header"><h6 class="m-0 font-weight-bold text-primary fw-bold"><i class="fas fa-user-shield me-2"></i> Quản lý Người dùng</h6></div>
                <div class="card-body">
                    <div class="d-flex justify-content-between gap-3 mt-2">
                        <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                            <a href="<?= BASEURL ?>/admin/usermanager/create" class="btn btn-success flex-grow-1 fw-bold rounded-pill py-2 shadow-sm"><i class="fas fa-user-plus me-1"></i> Cấp tài khoản</a>
                        <?php endif; ?>
                        <a href="<?= BASEURL ?>/admin/usermanager" class="btn btn-light border flex-grow-1 fw-bold rounded-pill py-2 shadow-sm text-dark"><i class="fas fa-users me-1 text-primary"></i> Xem danh sách</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ================= CÁC CỬA SỔ HIỂN THỊ CHI TIẾT (MODALS) ================= -->
<div class="modal fade custom-modal" id="revenueModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white" style="background: linear-gradient(45deg, #1cc88a, #13855c) !important;">
                <h5 class="modal-title fw-bold fs-4"><i class="fas fa-wallet me-2"></i> Báo cáo Doanh thu</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row text-center mb-5">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="p-4 stat-box shadow-sm">
                            <h6 class="text-muted mb-2 text-uppercase fw-bold" style="font-size: 12px;">Hôm nay</h6>
                            <h4 class="text-success fw-bold mb-0"><?= number_format($revenueToday) ?> đ</h4>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="p-4 stat-box shadow-sm">
                            <h6 class="text-muted mb-2 text-uppercase fw-bold" style="font-size: 12px;">Tuần này</h6>
                            <h4 class="text-success fw-bold mb-0"><?= number_format($revenueWeek) ?> đ</h4>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-4 stat-box shadow-sm" style="border: 2px solid var(--success-color);">
                            <h6 class="text-muted mb-2 text-uppercase fw-bold" style="font-size: 12px;">Tổng Lũy Kế</h6>
                            <h4 class="text-success fw-bold mb-0"><?= number_format($totalRevenue) ?> đ</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ================= SCRIPT KHỞI TẠO BIỂU ĐỒ ================= -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    Chart.defaults.font.family = "'Segoe UI', 'Nunito', '-apple-system', 'system-ui', 'BlinkMacSystemFont', sans-serif";
    Chart.defaults.color = '#858796';

    const rawData = [<?= $monthlyRevenueJS ?>];
    
    // Tự động TÔ XÁM các tháng không có doanh thu (= 0)
    const pointBackgroundColors = rawData.map(value => value > 0 ? "rgba(78, 115, 223, 1)" : "rgba(200, 200, 200, 0.5)"); 
    const pointBorderColors = rawData.map(value => value > 0 ? "rgba(255, 255, 255, 1)" : "rgba(200, 200, 200, 0.8)");
    const pointRadii = rawData.map(value => value > 0 ? 6 : 3);

    var ctxArea = document.getElementById("revenueChart");
    new Chart(ctxArea, {
        type: 'line',
        data: {
            labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
            datasets: [{
                label: "Doanh thu (VND)",
                lineTension: 0.3, 
                backgroundColor: "rgba(78, 115, 223, 0.05)", 
                borderColor: "rgba(78, 115, 223, 0.5)",
                pointRadius: pointRadii,
                pointBackgroundColor: pointBackgroundColors, 
                pointBorderColor: pointBorderColors,
                pointHoverRadius: 8,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(255, 255, 255, 1)",
                pointBorderWidth: 2,
                fill: true,
                data: rawData,
            }],
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }, 
                tooltip: {
                    backgroundColor: "rgba(255,255,255,0.9)",
                    titleColor: "#5a5c69",
                    bodyColor: "#5a5c69",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    padding: 12,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            if(context.parsed.y === 0) return "Chưa có giao dịch";
                            return "Doanh thu: " + new Intl.NumberFormat('vi-VN').format(context.parsed.y) + ' đ';
                        }
                    }
                }
            },
            scales: {
                x: { grid: { display: false, drawBorder: false } },
                y: {
                    beginAtZero: true,
                    ticks: { maxTicksLimit: 6, padding: 10, callback: function(value) { return value === 0 ? '0' : value / 1000000 + ' Tr'; } },
                    grid: { color: "rgb(234, 236, 244)", zeroLineColor: "rgb(234, 236, 244)", drawBorder: false, borderDash: [2], zeroLineBorderDash: [2] }
                }
            }
        }
    });

    var ctxPie = document.getElementById("statusChart");
    new Chart(ctxPie, {
        type: 'doughnut',
        data: {
            labels: ["Đã thanh toán", "Chờ xử lý", "Đã hủy"],
            datasets: [{
                data: [<?= $statusCount['confirmed'] ?>, <?= $statusCount['pending'] ?>, <?= $statusCount['cancelled'] ?>],
                backgroundColor: ['#1cc88a', '#f6c23e', '#e74a3b'],
                hoverBackgroundColor: ['#17a673', '#dda20a', '#be2617'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
                borderWidth: 2,
            }],
        },
        options: { maintainAspectRatio: false, cutout: '75%', plugins: { legend: { display: false } } }
    });
});
</script>

<?php require_once '../app/Views/layouts/admin_footer.php'; ?>