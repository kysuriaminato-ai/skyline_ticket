<?php
// Bỏ qua admin_header.php cũ để thiết kế lại toàn bộ trang
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?? 'Admin Dashboard' ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --bg-color: #eaf1fb;
            --sidebar-grad-1: #6a8dff;
            --sidebar-grad-2: #8061ff;
            --card-bg: rgba(255, 255, 255, 0.9);
            --text-main: #334155;
            --text-light: #94a3b8;
            --primary: #4f46e5;
        }

        body {
            font-family: 'Inter', 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #e0eaff 0%, #f0f4ff 100%);
            min-height: 100vh;
            color: var(--text-main);
            overflow-x: hidden;
            margin: 0;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .dashboard-container {
            display: flex;
            width: 100%;
            max-width: 1600px;
            height: 95vh;
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: 1px solid rgba(255,255,255,0.5);
        }

        /* ================= SIDEBAR ================= */
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, var(--sidebar-grad-1) 0%, var(--sidebar-grad-2) 100%);
            color: white;
            padding: 40px 20px;
            display: flex;
            flex-direction: column;
            position: relative;
            z-index: 10;
            border-radius: 30px 0 0 30px;
        }
        
        /* The curved cutout effect on sidebar right edge (optional, complex in raw CSS, simulating with box-shadow) */
        
        .profile-section {
            text-align: center;
            margin-bottom: 40px;
        }
        .profile-img-wrap {
            position: relative;
            width: 90px;
            height: 90px;
            margin: 0 auto 15px;
        }
        .profile-img-wrap::before {
            content: '';
            position: absolute;
            top: -5px; left: -5px; right: -5px; bottom: -5px;
            border-radius: 50%;
            border: 2px solid rgba(255,255,255,0.3);
            border-top-color: #00ffcc;
            transform: rotate(-45deg);
        }
        .profile-img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid white;
        }
        .online-dot {
            position: absolute;
            bottom: 5px; right: 5px;
            width: 15px; height: 15px;
            background: #00ffcc;
            border: 3px solid var(--sidebar-grad-1);
            border-radius: 50%;
        }

        .nav-menu { list-style: none; padding: 0; margin: 0; flex: 1; }
        .nav-item { margin-bottom: 10px; }
        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            border-radius: 25px;
            transition: all 0.3s;
            font-weight: 500;
        }
        .nav-link i { width: 25px; font-size: 1.1em; }
        .nav-link:hover { color: white; background: rgba(255,255,255,0.1); }
        .nav-link.active {
            background: white;
            color: var(--sidebar-grad-2);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        /* Active Users map mockup */
        .active-users-widget { margin-top: auto; padding: 20px 10px 0; }
        .active-users-widget h6 { font-size: 12px; opacity: 0.8; margin-bottom: 15px; text-transform: uppercase; letter-spacing: 1px;}
        .avatars { display: flex; align-items: center; margin-bottom: 20px; }
        .avatars img { width: 35px; height: 35px; border-radius: 50%; border: 2px solid var(--sidebar-grad-2); margin-left: -10px; }
        .avatars img:first-child { margin-left: 0; }
        .avatars .more { width: 35px; height: 35px; border-radius: 50%; background: #00c6ff; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: bold; margin-left: -10px; border: 2px solid var(--sidebar-grad-2); }
        .map-mockup { width: 100%; height: 100px; background: url('https://upload.wikimedia.org/wikipedia/commons/thumb/8/8c/Blank_US_Map_%28states_only%29.svg/800px-Blank_US_Map_%28states_only%29.svg.png') no-repeat center center/contain; opacity: 0.5; filter: invert(1); }

        /* ================= MAIN CONTENT ================= */
        .main-content {
            flex: 1;
            padding: 40px;
            overflow-y: auto;
        }

        /* Top Cards */
        .top-cards { display: grid; grid-template-columns: repeat(3, 1fr); gap: 25px; margin-bottom: 30px; }
        .glass-card {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,0.8);
        }
        .top-card h3 { font-size: 16px; font-weight: 700; color: var(--text-main); margin-bottom: 5px; }
        .top-card .value { font-size: 28px; font-weight: 800; color: var(--primary); }
        .top-card .deco-img { position: absolute; right: -20px; bottom: -20px; width: 150px; opacity: 0.8; }
        
        .bg-pattern { position: absolute; top: 0; right: 0; width: 100%; height: 100%; background: radial-gradient(circle at 100% 0%, rgba(0,0,0,0.03) 0%, transparent 50%); z-index: 0; }
        .card-content { position: relative; z-index: 1; }

        /* Middle Row */
        .middle-row { display: grid; grid-template-columns: 2fr 1fr; gap: 25px; margin-bottom: 30px; }
        
        /* Cutout Table */
        .table-card { position: relative; }
        .table-card::before, .table-card::after {
            content: ''; position: absolute; width: 30px; height: 30px; background: #eaf1fb; border-radius: 50%;
            top: 50%; transform: translateY(-50%); z-index: 2;
        }
        .table-card::before { left: -15px; box-shadow: inset -3px 0 5px rgba(0,0,0,0.02); }
        .table-card::after { right: -15px; box-shadow: inset 3px 0 5px rgba(0,0,0,0.02); }

        .table-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
        .table-header h4 { margin: 0; font-size: 18px; font-weight: 700; }
        .table-header span { font-size: 12px; color: var(--text-light); }
        
        .trip-table { width: 100%; border-collapse: separate; border-spacing: 0 15px; margin-top: -15px; }
        .trip-table th { color: var(--text-light); font-size: 12px; font-weight: 600; text-transform: uppercase; padding: 0 15px; border-bottom: 1px dashed #e2e8f0; padding-bottom: 15px; }
        .trip-table td { padding: 15px; font-weight: 600; font-size: 14px; border-bottom: 1px dashed #e2e8f0; }
        .trip-table tr:last-child td { border-bottom: none; }
        
        .member-info { display: flex; align-items: center; gap: 12px; }
        .member-info img { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; }
        .member-info div { display: flex; flex-direction: column; }
        .member-info .name { color: var(--text-main); }
        .member-info .email { font-size: 11px; color: var(--text-light); font-weight: 400; }
        .route { color: var(--sidebar-grad-1); }
        .price { color: var(--sidebar-grad-2); }

        /* Charts */
        .chart-container { position: relative; height: 220px; width: 100%; }
        .bottom-row { display: grid; grid-template-columns: 1fr 2.5fr; gap: 25px; }
        
        .donut-container { height: 180px; display: flex; align-items: center; justify-content: center; position: relative;}
        .donut-inner-text { position: absolute; text-align: center; top: 50%; left: 50%; transform: translate(-50%, -50%); }
        .donut-inner-text span { display: block; font-size: 10px; font-weight: 700; color: var(--text-light); letter-spacing: 1px;}
        .donut-inner-text strong { font-size: 16px; color: var(--text-main); }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.1); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(0,0,0,0.2); }
    </style>
</head>
<body>

<div class="dashboard-container">
    
    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="profile-section">
            <div class="profile-img-wrap">
                <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?q=80&w=200&auto=format&fit=crop" alt="Admin" class="profile-img">
                <div class="online-dot"></div>
            </div>
            <h5 class="mb-0 fw-bold"><?= htmlspecialchars($_SESSION['user_name'] ?? 'Admin') ?></h5>
            <small style="color: rgba(255,255,255,0.7);"><?= $_SESSION['email'] ?? 'admin@skylineticket.com' ?></small>
        </div>

        <ul class="nav-menu">
            <li class="nav-item"><a href="<?= BASEURL ?>/admin/dashboard" class="nav-link active"><i class="fas fa-border-all"></i> Dashboard</a></li>
            <li class="nav-item"><a href="<?= BASEURL ?>/admin/flightmanager" class="nav-link"><i class="fas fa-plane-departure"></i> Flights</a></li>
            <li class="nav-item"><a href="<?= BASEURL ?>/admin/bookingmanager" class="nav-link"><i class="fas fa-wallet"></i> Bookings</a></li>
            <li class="nav-item"><a href="<?= BASEURL ?>/admin/reports" class="nav-link"><i class="fas fa-file-invoice"></i> Reports</a></li>
            <li class="nav-item"><a href="<?= BASEURL ?>/admin/usermanager" class="nav-link"><i class="fas fa-chart-pie"></i> Users</a></li>
            <li class="nav-item"><a href="<?= BASEURL ?>/admin/settings" class="nav-link"><i class="fas fa-cog"></i> Settings</a></li>
        </ul>

        <div class="active-users-widget">
            <h6>Active users</h6>
            <div class="avatars">
                <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=100&auto=format&fit=crop" alt="u1">
                <img src="https://images.unsplash.com/photo-1599566150163-29194dcaad36?q=80&w=100&auto=format&fit=crop" alt="u2">
                <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?q=80&w=100&auto=format&fit=crop" alt="u3">
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=100&auto=format&fit=crop" alt="u4">
                <div class="more">+13</div>
            </div>
            <div class="map-mockup"></div>
            
            <a href="<?= BASEURL ?>/auth/logout" class="btn btn-sm btn-outline-light w-100 mt-3 rounded-pill" style="border-width: 2px;">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        
        <!-- Top Cards -->
        <div class="top-cards">
            <div class="glass-card top-card">
                <div class="bg-pattern"></div>
                <div class="card-content">
                    <h3>Total Users</h3>
                    <div class="value"><?= number_format($data['totalUsers'] ?? 0) ?></div>
                </div>
                <!-- Plane deco -->
                <img src="https://cdn-icons-png.flaticon.com/512/3163/3163183.png" class="deco-img" alt="Plane" style="filter: grayscale(100%) opacity(0.3) drop-shadow(2px 4px 6px rgba(0,0,0,0.1));">
            </div>
            
            <div class="glass-card top-card">
                <div class="bg-pattern"></div>
                <div class="card-content">
                    <h3>Total Flights</h3>
                    <div class="value"><?= number_format($data['totalFlights'] ?? 0) ?></div>
                </div>
                <img src="https://cdn-icons-png.flaticon.com/512/3163/3163183.png" class="deco-img" alt="Plane" style="filter: grayscale(100%) opacity(0.3) drop-shadow(2px 4px 6px rgba(0,0,0,0.1));">
            </div>

            <div class="glass-card top-card">
                <div class="bg-pattern"></div>
                <div class="card-content">
                    <h3>Total Revenue</h3>
                    <div class="value">$<?= number_format(($data['totalRevenue'] ?? 0) / 25000, 0) ?>k</div>
                </div>
                <img src="https://cdn-icons-png.flaticon.com/512/3163/3163183.png" class="deco-img" alt="Plane" style="filter: grayscale(100%) opacity(0.3) drop-shadow(2px 4px 6px rgba(0,0,0,0.1));">
            </div>
        </div>

        <!-- Middle Row -->
        <div class="middle-row">
            <!-- Last Trips Table -->
            <div class="glass-card table-card">
                <div class="table-header">
                    <h4>Last Bookings</h4>
                    <span>Overview of latest orders</span>
                </div>
                <table class="trip-table">
                    <thead>
                        <tr>
                            <th class="text-start">Members</th>
                            <th>Flight</th>
                            <th class="text-center">Tickets</th>
                            <th class="text-end">Ticket Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $recent = $data['recentBookings'] ?? [];
                        if(!empty($recent)): 
                            foreach($recent as $idx => $bk): 
                                // Mock some avatars
                                $avatar = 'https://i.pravatar.cc/100?img=' . ($idx + 10);
                                $route = ($bk['departure'] ?? 'Unknown') . ' - ' . ($bk['destination'] ?? 'Unknown');
                                // Rút gọn tên thành phố
                                $routeShort = explode(',', $bk['departure'] ?? 'N/A')[0] . ' ✈ ' . explode(',', $bk['destination'] ?? 'N/A')[0];
                        ?>
                        <tr>
                            <td>
                                <div class="member-info">
                                    <img src="<?= $avatar ?>" alt="Avatar">
                                    <div>
                                        <span class="name"><?= htmlspecialchars($bk['fullname'] ?? 'Guest') ?></span>
                                        <span class="email"><?= htmlspecialchars($bk['email'] ?? $bk['contact_email'] ?? '') ?></span>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center route"><?= $routeShort ?></td>
                            <td class="text-center text-muted"><?= $bk['passengers_count'] ?? 1 ?></td>
                            <td class="text-end price">$<?= number_format(($bk['total_price'] ?? 0)/25000, 1) ?>k</td>
                        </tr>
                        <?php 
                            endforeach; 
                        else: 
                        ?>
                        <tr><td colspan="4" class="text-center py-4">No recent bookings found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Statistics Bar Chart -->
            <div class="glass-card">
                <div class="table-header mb-0">
                    <h4>Statistics</h4>
                </div>
                <div class="chart-container" style="height: 250px;">
                    <canvas id="statChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Bottom Row -->
        <div class="bottom-row">
            <!-- Donut Chart -->
            <div class="glass-card">
                <div class="table-header mb-2">
                    <h4>Flights Share</h4>
                </div>
                <div class="donut-container">
                    <canvas id="donutChart"></canvas>
                    <div class="donut-inner-text">
                        <span>FLIGHTS</span>
                        <strong>SHARE</strong>
                    </div>
                </div>
            </div>

            <!-- Line Chart -->
            <div class="glass-card">
                <div class="table-header mb-0">
                    <h4>Flights Schedule</h4>
                    <span>Passengers: <?= number_format($data['totalBookings'] ?? 0 * 1.5) ?></span>
                </div>
                <div class="chart-container" style="height: 180px;">
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
        </div>

    </div>
</div>

<?php
// Chuẩn bị dữ liệu cho biểu đồ từ $data['monthlyReport']
$monthlyData = $data['monthlyReport'] ?? [];
$months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
$chartValues = array_fill(0, 12, 0);

foreach($monthlyData as $row) {
    if(isset($row['month']) && isset($row['count'])) {
        $mIndex = (int)$row['month'] - 1;
        if($mIndex >= 0 && $mIndex < 12) {
            $chartValues[$mIndex] = (int)$row['count'];
        }
    }
}
// Chỉ lấy 6 tháng đầu để hiển thị đẹp như ảnh
$months6 = array_slice($months, 0, 6);
$values6 = array_slice($chartValues, 0, 6);
?>

<script>
// Chart.js Default Configs
Chart.defaults.color = '#94a3b8';
Chart.defaults.font.family = "'Inter', sans-serif";

const monthsLabels = <?= json_encode($months6) ?>;
const dataValues = <?= json_encode($values6) ?>;

// 1. Bar Chart (Statistics)
const ctxBar = document.getElementById('statChart').getContext('2d');
new Chart(ctxBar, {
    type: 'bar',
    data: {
        labels: monthsLabels,
        datasets: [{
            label: 'Bookings',
            data: dataValues.map(v => v === 0 ? Math.floor(Math.random() * 6)+1 : v), // Mock if 0
            backgroundColor: '#4f46e5',
            borderRadius: 50,
            barThickness: 6,
        }]
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, border: {display: false}, grid: { color: '#f1f5f9', drawBorder: false } },
            x: { grid: { display: false, drawBorder: false } }
        }
    }
});

// 2. Donut Chart (Flights Share)
const ctxDonut = document.getElementById('donutChart').getContext('2d');
new Chart(ctxDonut, {
    type: 'doughnut',
    data: {
        labels: ['Domestic', 'International', 'Charter'],
        datasets: [{
            data: [45, 35, 20],
            backgroundColor: ['#4f46e5', '#00ffcc', '#e2e8f0'],
            borderWidth: 0,
            hoverOffset: 4
        }]
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        cutout: '75%',
        plugins: { legend: { display: false } }
    }
});

// 3. Line Chart (Flights Schedule)
const ctxLine = document.getElementById('lineChart').getContext('2d');
new Chart(ctxLine, {
    type: 'line',
    data: {
        labels: monthsLabels,
        datasets: [
            {
                label: 'Arrivals',
                data: [1, 2, 5, 3, 4, 1],
                borderColor: '#4f46e5',
                borderWidth: 2,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#4f46e5',
                pointBorderWidth: 2,
                tension: 0.4
            },
            {
                label: 'Departures',
                data: [0, 0.5, 1.5, 0.5, 2.5, 0],
                borderColor: '#00ffcc',
                borderWidth: 2,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#00ffcc',
                pointBorderWidth: 2,
                tension: 0.4
            }
        ]
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            y: { display: false, beginAtZero: true },
            x: { grid: { display: false, drawBorder: false } }
        }
    }
});
</script>

</body>
</html>
