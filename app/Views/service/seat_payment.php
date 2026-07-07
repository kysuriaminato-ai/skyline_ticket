<?php require_once '../app/Views/layouts/header.php'; ?>

<style>
    body { background-color: #f4f7f6; font-family: 'Inter', 'Segoe UI', sans-serif; }
    .payment-card { background: #fff; border-radius: 16px; padding: 35px; box-shadow: 0 10px 40px rgba(0,0,0,0.05); margin-top: 40px; margin-bottom: 60px; border: 1px solid #eee; }
    .page-title { font-weight: 800; color: #0c3547; margin-bottom: 30px; text-align: center; }
    
    .info-box { background: #f8fbff; border-radius: 12px; padding: 20px; margin-bottom: 25px; border: 1px solid #e0ebf5; }
    .info-label { font-size: 13px; color: #666; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 5px; }
    .info-value { font-size: 16px; color: #0c3547; font-weight: 700; }
    
    .price-row { display: flex; justify-content: space-between; align-items: center; padding: 15px 0; border-bottom: 1px dashed #ddd; }
    .price-row.total { border-bottom: none; border-top: 2px solid #eee; margin-top: 10px; padding-top: 20px; }
    
    .btn-pay { background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%); color: white; font-weight: 700; font-size: 16px; padding: 15px 30px; border-radius: 50px; border: none; width: 100%; transition: all 0.3s; box-shadow: 0 5px 15px rgba(243,156,18,0.3); text-transform: uppercase; }
    .btn-pay:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(243,156,18,0.4); color: white; background: linear-gradient(135deg, #e67e22 0%, #d35400 100%); }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="payment-card">
                <div class="text-center mb-4">
                    <div style="width: 70px; height: 70px; background: #e8f5e9; color: #2ecc71; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 30px; margin: 0 auto 15px;">
                        <i class="fas fa-check"></i>
                    </div>
                    <h2 class="page-title mb-1">Xác nhận thông tin & Thanh toán</h2>
                    <p class="text-muted">Vui lòng kiểm tra lại thông tin nâng hạng ghế của bạn</p>
                </div>

                <div class="info-box">
                    <div class="row g-4">
                        <div class="col-6">
                            <div class="info-label">Mã đặt chỗ (PNR)</div>
                            <div class="info-value"><?= htmlspecialchars($data['seat_info']['pnr'] ?? '') ?></div>
                        </div>
                        <div class="col-6">
                            <div class="info-label">Hành khách</div>
                            <div class="info-value"><?= htmlspecialchars($data['seat_info']['last_name'] ?? '') ?></div>
                        </div>
                        <div class="col-6">
                            <div class="info-label">Hành trình</div>
                            <div class="info-value">
                                <?= htmlspecialchars($data['seat_info']['departure'] ?? 'N/A') ?> 
                                <i class="fas fa-arrow-right mx-1 text-muted"></i> 
                                <?= htmlspecialchars($data['seat_info']['destination'] ?? 'N/A') ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="info-label">Ngày bay</div>
                            <div class="info-value"><?= date('d/m/Y', strtotime($data['seat_info']['departure_date'] ?? time())) ?></div>
                        </div>
                    </div>
                </div>

                <h5 class="fw-bold text-dark mt-4 mb-3">Chi tiết thanh toán</h5>
                <div class="price-row">
                    <span class="text-muted">Phí nâng hạng ghế</span>
                    <span class="fw-bold text-dark"><?= number_format($data['seat_info']['price'] ?? 0) ?> đ</span>
                </div>
                <div class="price-row">
                    <span class="text-muted">Thuế & phí</span>
                    <span class="fw-bold text-success">Đã bao gồm</span>
                </div>
                <div class="price-row total">
                    <h5 class="fw-bold mb-0 text-dark">Tổng thanh toán</h5>
                    <h3 class="fw-bold mb-0" style="color: #e74c3c;"><?= number_format($data['seat_info']['price'] ?? 0) ?> đ</h3>
                </div>

                <form action="<?= BASEURL ?>/service/confirmSeatPayment" method="POST" class="mt-5">
                    <button type="submit" class="btn btn-pay">
                        <i class="fas fa-lock me-2"></i> Thanh toán an toàn
                    </button>
                </form>
                <div class="text-center mt-3">
                    <a href="<?= BASEURL ?>/service/seatSelection" class="text-muted text-decoration-none" style="font-size: 14px;"><i class="fas fa-arrow-left me-1"></i> Quay lại chỉnh sửa</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/Views/layouts/footer.php'; ?>
