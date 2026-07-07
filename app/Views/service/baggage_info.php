<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f8f9fa; }
        .navbar { background: linear-gradient(135deg, #a1c4fd 0%, #c2e9fb 100%); box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .brand-logo { font-weight: 800; font-size: 24px; color: #0c3547; text-decoration: none; }
        .brand-logo span { color: #fff; }
        
        .page-header { padding: 40px 0 20px; }
        .search-card { background: #fff; border-radius: 16px; box-shadow: 0 10px 40px rgba(0,0,0,0.08); padding: 40px; margin-top: 30px; }
        
        .airport-trigger { padding: 15px 20px; border: 1px solid #ced4da; border-radius: 8px; cursor: pointer; transition: 0.3s; height: 100%; display: flex; flex-direction: column; justify-content: center;}
        .airport-trigger:hover { border-color: #005e6a; background: #fbfcfc; }
        .airport-trigger .label { font-size: 13px; color: #005e6a; font-weight: 600; margin-bottom: 5px; }
        .airport-trigger .code-display { font-size: 24px; font-weight: bold; color: #333; }
        
        .btn-swap { background: white; border: 1px solid #ced4da; border-radius: 50%; width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center; color: #005e6a; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 5; }
        
        .form-control, .form-select { border-radius: 8px; padding: 12px 15px; border: 1px solid #ced4da; height: 55px; }
        .input-label { font-size: 13px; color: #005e6a; font-weight: 600; margin-bottom: 8px; display: block; }
        
        .btn-search { background-color: #e0e0e0; color: #888; font-weight: bold; border-radius: 25px; border: none; padding: 12px 40px; cursor: not-allowed; transition: 0.3s; }
        .btn-search:hover { background-color: #d0d0d0; }
        /* When active: background-color: #005e6a; color: white; cursor: pointer; */
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg py-3">
        <div class="container">
            <a class="brand-logo" href="<?= BASEURL ?>/home">SKYLINE<span>TICKET</span></a>
            <div class="d-flex align-items-center ms-auto">
                <a href="<?= BASEURL ?>/home" class="text-dark text-decoration-none me-4 fw-bold" style="color: #0c3547 !important;"><i class="fas fa-home me-1"></i> Trang chủ</a>
                <?php if (isset($_SESSION['user_name'])): ?>
                    <span class="me-3 fw-bold" style="color: #0c3547;"><i class="fas fa-user-circle"></i> Xin chào, <?= htmlspecialchars($_SESSION['user_name']) ?></span>
                    <a href="<?= BASEURL ?>/auth/logout" class="btn btn-outline-dark" style="border-color: #0c3547; color: #0c3547;">Đăng xuất</a>
                <?php else: ?>
                    <a href="<?= BASEURL ?>/auth/login" class="btn btn-outline-dark me-2 fw-bold px-4" style="border-color: #0c3547; color: #0c3547;">Đăng nhập</a>
                    <a href="<?= BASEURL ?>/auth/register" class="btn fw-bold px-4 text-white" style="background: #0c3547; border:none;">Đăng ký</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="container pb-5">
        <div class="page-header">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= BASEURL ?>/home" class="text-decoration-none" style="color: #005e6a;">Trang chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tra cứu thông tin hành lý</li>
                </ol>
            </nav>
            <h1 class="display-6 fw-bold text-dark mt-3">Tra cứu thông tin hành lý</h1>
            <p class="text-muted mt-3" style="max-width: 800px; line-height: 1.6;">
                Tiêu chuẩn hành lý của Skyline Ticket sẽ khác nhau tùy theo hành trình và hạng dịch vụ. Hành khách sử dụng tính năng Tra cứu hành lý dưới đây để tìm hiểu tiêu chuẩn hành lý miễn cước và các loại hành lý khác.
            </p>
            <p class="text-muted" style="max-width: 800px; line-height: 1.6;">
                Xin lưu ý chức năng Tra cứu hành lý chỉ áp dụng cho các chuyến bay do Skyline Ticket khai thác.
            </p>
        </div>

        <div class="search-card">
            <form action="#" method="GET">
                <div class="row g-4 position-relative mb-4">
                    <!-- Điểm đi -->
                    <div class="col-md-5">
                        <div class="airport-trigger">
                            <div class="label"><i class="fas fa-plane-departure me-1"></i> Từ *</div>
                            <div class="code-display">HAN <span class="badge bg-light text-dark fw-normal fs-6 ms-2 border">Hà Nội, Việt Nam</span></div>
                        </div>
                    </div>
                    
                    <div class="col-md-2 position-relative" style="height: 0;">
                        <div class="btn-swap"><i class="fas fa-exchange-alt"></i></div>
                    </div>
                    
                    <!-- Điểm đến -->
                    <div class="col-md-5">
                        <div class="airport-trigger">
                            <div class="label"><i class="fas fa-plane-arrival me-1"></i> Đến *</div>
                            <div class="text-muted fw-bold" style="font-size: 20px;">Chọn điểm đến</div>
                        </div>
                    </div>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label class="input-label"><i class="fas fa-chair me-1"></i> Hạng dịch vụ *</label>
                        <select class="form-select text-muted fw-bold">
                            <option selected disabled>Chọn hạng dịch vụ</option>
                            <option>Thương gia</option>
                            <option>Phổ thông đặc biệt</option>
                            <option>Phổ thông</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="input-label"><i class="fas fa-ticket-alt me-1"></i> Loại vé *</label>
                        <select class="form-select text-muted fw-bold">
                            <option selected disabled>Chọn loại vé</option>
                            <option>Linh hoạt</option>
                            <option>Tiêu chuẩn</option>
                            <option>Tiết kiệm</option>
                        </select>
                    </div>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label class="input-label"><i class="far fa-calendar-alt me-1"></i> Ngày khởi hành *</label>
                        <input type="date" class="form-control text-muted fw-bold">
                    </div>
                    <div class="col-md-6">
                        <label class="input-label"><i class="far fa-calendar-check me-1"></i> Ngày mua vé *</label>
                        <input type="date" class="form-control text-muted fw-bold">
                    </div>
                </div>

                <div class="text-end mt-4 pt-4 border-top">
                    <button type="button" class="btn-search">Tra cứu</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
