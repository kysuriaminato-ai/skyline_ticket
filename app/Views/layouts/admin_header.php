<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title'] ?? 'Admin Dashboard'; ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        :root { --primary-color: #0d6efd; --sidebar-color: #2c3e50; --sidebar-hover: #34495e; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f5f5f5; }
        .admin-layout { display: flex; min-height: 100vh; }
        .admin-sidebar { width: 250px; background: var(--sidebar-color); color: white; padding: 0; position: fixed; height: 100vh; overflow-y: auto; top: 0; left: 0; z-index: 999; }
        .sidebar-brand { padding: 20px; border-bottom: 1px solid rgba(255,255,255,0.1); font-size: 18px; font-weight: bold; text-align: center; }
        .sidebar-menu { list-style: none; padding: 0; margin: 0; }
        .sidebar-menu li { border-bottom: 1px solid rgba(255,255,255,0.05); }
        .sidebar-menu a { display: block; padding: 15px 20px; color: #ecf0f1; text-decoration: none; transition: all 0.3s; }
        .sidebar-menu a:hover { background: var(--sidebar-hover); padding-left: 25px; color: #fff; }
        .sidebar-menu a i { width: 20px; margin-right: 10px; }
        .admin-content { margin-left: 250px; flex: 1; display: flex; flex-direction: column; }
        .admin-header { background: white; padding: 20px; border-bottom: 1px solid #e0e0e0; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .admin-header h1 { margin: 0; font-size: 28px; color: var(--sidebar-color); }
        .admin-main { padding: 30px; flex: 1; }
        .stat-card { border-radius: 10px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: all 0.3s; margin-bottom: 20px; }
        .stat-card:hover { transform: translateY(-5px); box-shadow: 0 8px 12px rgba(0,0,0,0.15); }
        .stat-card .card-body { padding: 25px; text-align: center; }
        .stat-card .stat-value { font-size: 32px; font-weight: bold; margin: 10px 0; }
        .stat-card .stat-label { font-size: 14px; color: rgba(0,0,0,0.6); text-transform: uppercase; letter-spacing: 0.5px; }
        .stat-card .stat-icon { font-size: 40px; margin-bottom: 10px; opacity: 0.8; }
        .stat-card-link { text-decoration: none; color: inherit; display: block; transition: all 0.3s; }
        .stat-card-link:hover .stat-card { transform: translateY(-8px) scale(1.02); box-shadow: 0 10px 20px rgba(0,0,0,0.2); }
        .action-menu { margin-top: 30px; }
        .action-btn { padding: 15px 20px; margin: 10px 5px; border-radius: 5px; border: none; font-weight: 500; transition: all 0.3s; }
        .action-btn:hover { transform: scale(1.05); }
        .table-responsive { border-radius: 10px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .table { margin: 0; }
        .table thead { background: var(--primary-color); color: white; }
        .table tbody tr:hover { background: #f0f0f0; }
        @media (max-width: 768px) {
            .admin-sidebar { width: 80px; padding: 0; }
            .sidebar-menu a span { display: none; }
            .admin-content { margin-left: 80px; }
            .admin-main { padding: 15px; }
            .stat-card .stat-icon { font-size: 30px; }
        }
    </style>
</head>
<body>
    <div class="admin-layout">
        <!-- Đã thêm BASEURL vào tất cả các link -->
        <div class="admin-sidebar">
            <div class="sidebar-brand">
                <a href="<?= BASEURL ?>/home" class="text-white text-decoration-none"><i class="fas fa-plane"></i> Skyline</a>
            </div>
            <ul class="sidebar-menu">
                <li><a href="<?= BASEURL ?>/admin"><i class="fas fa-chart-line"></i> <span>Dashboard</span></a></li>
                <li><a href="<?= BASEURL ?>/admin/flightmanager"><i class="fas fa-plane-departure"></i> <span>Chuyến bay</span></a></li>
                <li><a href="<?= BASEURL ?>/admin/usermanager"><i class="fas fa-users"></i> <span>Người dùng</span></a></li>
                <li><a href="<?= BASEURL ?>/admin/bookingmanager"><i class="fas fa-ticket-alt"></i> <span>Đặt chỗ</span></a></li>
                <li><a href="<?= BASEURL ?>/admin/reports"><i class="fas fa-file-alt"></i> <span>Báo cáo</span></a></li>
                <li><a href="<?= BASEURL ?>/admin/settings"><i class="fas fa-cog"></i> <span>Cài đặt</span></a></li>
                <li style="margin-top: 20px;"><a href="<?= BASEURL ?>/auth/logout" style="background: #e74c3c;"><i class="fas fa-sign-out-alt"></i> <span>Đăng xuất</span></a></li>
            </ul>
        </div>
        
        <div class="admin-content">
            <div class="admin-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1><?php echo $data['title'] ?? 'Dashboard'; ?></h1>
                    </div>
                    <div>
                        <span class="me-3">👤 <?= $_SESSION['user_name'] ?? 'Admin' ?></span>
                        <a href="<?= BASEURL ?>/auth/logout" class="btn btn-sm btn-outline-danger">Đăng xuất</a>
                    </div>
                </div>
            </div>
            
            <div class="admin-main">