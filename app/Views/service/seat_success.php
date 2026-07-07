<?php require_once '../app/Views/layouts/header.php'; ?>

<style>
    body { background-color: #f4f7f6; font-family: 'Inter', 'Segoe UI', sans-serif; }
    .success-card { background: #fff; border-radius: 20px; padding: 40px; box-shadow: 0 15px 50px rgba(0,0,0,0.08); margin-top: 50px; margin-bottom: 70px; border: 1px solid #eee; text-align: center; }
    
    .success-icon-wrapper { width: 90px; height: 90px; background: linear-gradient(135deg, #2ecc71, #27ae60); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 40px; margin: 0 auto 25px; box-shadow: 0 10px 25px rgba(46,204,113,0.3); }
    
    .page-title { font-weight: 800; color: #0c3547; margin-bottom: 15px; font-size: 28px; }
    
    .ticket-box { background: #f8fbff; border-radius: 16px; padding: 30px; margin-top: 30px; border: 2px dashed #b3d4f0; text-align: left; }
    .info-label { font-size: 13px; color: #666; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 5px; }
    .info-value { font-size: 18px; color: #0c3547; font-weight: 800; }
    
    .btn-home { background: linear-gradient(135deg, #0071c2 0%, #0c3547 100%); color: white; font-weight: 700; font-size: 16px; padding: 14px 35px; border-radius: 50px; border: none; display: inline-block; text-decoration: none; transition: all 0.3s; margin-top: 30px; }
    .btn-home:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(0,113,194,0.3); color: white; background: linear-gradient(135deg, #0c3547 0%, #0071c2 100%); }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="success-card">
                <div class="success-icon-wrapper">
                    <i class="fas fa-check"></i>
                </div>
                
                <h2 class="page-title">Thanh toán thành công!</h2>
                <p class="text-muted" style="font-size: 16px;">
                    <?php if (($data['status'] ?? '') === 'free'): ?>
                        Chỗ ngồi tiêu chuẩn của bạn đã được xác nhận.
                    <?php else: ?>
                        Cảm ơn bạn! Thanh toán cho dịch vụ nâng hạng chỗ ngồi đã hoàn tất.
                    <?php endif; ?>
                    Hệ thống sẽ gửi email cập nhật vé điện tử cho bạn trong ít phút tới.
                </p>

                <div class="ticket-box">
                    <div class="row g-4">
                        <div class="col-sm-6">
                            <div class="info-label">Mã đặt chỗ (PNR)</div>
                            <div class="info-value text-primary" style="font-size: 24px; letter-spacing: 2px;">
                                <?= htmlspecialchars($data['pnr'] ?? 'UNKNOWN') ?>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="info-label">Trạng thái thanh toán</div>
                            <div class="info-value text-success">
                                <i class="fas fa-check-circle me-1"></i> 
                                <?= (($data['status'] ?? '') === 'free') ? 'Miễn phí' : 'Đã thanh toán' ?>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="<?= BASEURL ?>/home" class="btn-home">
                    <i class="fas fa-home me-2"></i> Trở về Trang chủ
                </a>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/Views/layouts/footer.php'; ?>
