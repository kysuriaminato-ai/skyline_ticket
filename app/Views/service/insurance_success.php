<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #f4f7f6; color: #1a1a2e; display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; }
        .success-box { background: #fff; border-radius: 20px; box-shadow: 0 15px 40px rgba(0,0,0,0.08); padding: 40px; text-align: center; max-width: 500px; width: 100%; border-top: 5px solid #2ecc71; }
        .success-icon { width: 80px; height: 80px; background: #e8f8f5; color: #2ecc71; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 36px; margin: 0 auto 20px; }
        .success-title { font-weight: 800; color: #2c3e50; font-size: 24px; margin-bottom: 10px; }
        .pnr-highlight { display: inline-block; background: #e0f2f1; color: #00897b; padding: 10px 20px; border-radius: 12px; font-weight: 900; font-size: 20px; letter-spacing: 2px; margin: 20px 0; border: 2px dashed #00897b; }
        .btn-home { background: linear-gradient(135deg, #00897b, #00695c); color: #fff; border: none; padding: 12px 30px; border-radius: 12px; font-weight: 700; transition: 0.3s; margin-top: 15px; }
        .btn-home:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(0,137,123,0.3); color: #fff; }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="success-box mx-auto">
                <div class="success-icon">
                    <i class="fas fa-check"></i>
                </div>
                <h2 class="success-title">Thanh Toán Thành Công!</h2>
                
                <?php if (isset($data['invoice']) && $data['invoice']): ?>
                <div class="alert alert-success border-0 text-start mt-4 mb-4" style="background:#f0fdf4; color:#166534; border-radius:15px;">
                    <h5 class="fw-bold mb-3 border-bottom pb-2"><i class="fas fa-file-invoice-dollar me-2"></i>Hóa Đơn Mua Dịch Vụ</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Mã hóa đơn:</span>
                        <span class="fw-bold"><?= $data['invoice']['id'] ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Dịch vụ:</span>
                        <span class="fw-bold"><?= $data['invoice']['service'] ?> - <?= $data['invoice']['plan'] ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Hành khách:</span>
                        <span class="fw-bold"><?= $data['invoice']['fullname'] ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Mã đặt chỗ (PNR):</span>
                        <span class="fw-bold text-primary"><?= $data['invoice']['pnr'] ?></span>
                    </div>
                    <div class="d-flex justify-content-between mt-3 pt-2 border-top">
                        <span class="text-muted">Tổng tiền đã thanh toán:</span>
                        <span class="fw-bold text-danger fs-5"><?= number_format($data['invoice']['amount'], 0, ',', '.') ?> VNĐ</span>
                    </div>
                </div>
                <?php else: ?>
                <p class="text-muted">Bạn đã mua thêm Gói Bảo Hiểm Du Lịch thành công. E-policy (Giấy chứng nhận bảo hiểm) sẽ được gửi vào email của bạn trong ít phút tới.</p>
                <div class="pnr-highlight">
                    PNR: <?= $data['pnr'] ?>
                </div>
                <?php endif; ?>
                
                <p class="small text-muted mb-4"><i class="fas fa-info-circle me-1"></i>Vui lòng xuất trình mã PNR này nếu có yêu cầu hỗ trợ y tế khẩn cấp.</p>
                
                <div class="d-flex gap-2">
                    <a href="<?= BASEURL ?>/home" class="btn btn-home flex-grow-1" style="background: #f8f9fa; color: #2c3e50; border: 1px solid #dee2e6;"><i class="fas fa-home me-2"></i>Trang Chủ</a>
                    <a href="<?= BASEURL ?>/service/history" class="btn btn-home flex-grow-1"><i class="fas fa-history me-2"></i>Lịch Sử Mua</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
