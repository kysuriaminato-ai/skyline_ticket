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
        body { font-family: 'Inter', sans-serif; background: #f4f7f6; color: #1a1a2e; }
        .top-nav { background: #fff; box-shadow: 0 2px 20px rgba(0,0,0,0.05); position: sticky; top: 0; z-index: 1000; }
        .brand-logo { font-weight: 900; font-size: 22px; color: #005e6a; text-decoration: none; letter-spacing: -0.5px; }
        .brand-logo span { color: #f39c12; }
        .payment-box { background: #fff; border-radius: 20px; box-shadow: 0 15px 40px rgba(0,0,0,0.08); overflow: hidden; }
        .payment-header { background: linear-gradient(135deg, #00897b, #00695c); color: #fff; padding: 25px 30px; }
        .payment-body { padding: 30px; }
        .detail-row { display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px dashed #eee; font-size: 15px; }
        .detail-row:last-child { border-bottom: none; }
        .total-price { font-size: 28px; font-weight: 800; color: #e74c3c; text-align: right; margin-top: 15px; }
        .btn-pay { background: linear-gradient(135deg, #e74c3c, #c0392b); color: #fff; font-weight: 700; border: none; padding: 15px; border-radius: 12px; font-size: 16px; transition: 0.3s; width: 100%; margin-top: 25px; }
        .btn-pay:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(231,76,60,0.4); }
        .payment-method { border: 2px solid #eee; border-radius: 12px; padding: 15px; cursor: pointer; transition: 0.3s; margin-bottom: 15px; display: flex; align-items: center; }
        .payment-method:hover, .payment-method.active { border-color: #00897b; background: #e0f2f1; }
    </style>
</head>
<body>

<nav class="top-nav py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <a href="<?= BASEURL ?>/home" class="brand-logo">SKYLINE<span>TICKET</span></a>
        <a href="<?= BASEURL ?>/service/insurance" class="btn btn-outline-secondary btn-sm rounded-pill fw-bold"><i class="fas fa-arrow-left me-1"></i> Quay lại</a>
    </div>
</nav>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="payment-box">
                <div class="payment-header">
                    <h4 class="fw-bold mb-0"><i class="fas fa-credit-card me-2"></i>Thanh Toán Gói Bảo Hiểm</h4>
                </div>
                <div class="payment-body">
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3" style="color: #2c3e50;">Chi tiết giao dịch</h5>
                        <div class="detail-row">
                            <span class="text-muted">Mã đặt chỗ (PNR)</span>
                            <span class="fw-bold text-primary fs-5"><?= $data['insurance_info']['pnr'] ?></span>
                        </div>
                        <div class="detail-row">
                            <span class="text-muted">Hành khách</span>
                            <span class="fw-bold"><?= $data['insurance_info']['fullname'] ?></span>
                        </div>
                        <div class="detail-row">
                            <span class="text-muted">Gói Bảo Hiểm</span>
                            <span class="fw-bold text-success"><?= $data['insurance_info']['plan_name'] ?></span>
                        </div>
                        <div class="total-price">
                            <?= number_format($data['insurance_info']['price'], 0, ',', '.') ?> VNĐ
                        </div>
                    </div>

                    <div class="text-center mb-4">
                        <p class="text-muted small mb-2">Sử dụng App Ngân hàng hoặc Ví điện tử để quét mã</p>
                        
                        <?php 
                            $bankBin = "970407"; // Techcombank
                            $accNo = "19072314104015";
                            $accName = urlencode("MAI THANH THU");
                            $amount = $data['insurance_info']['price'];
                            $content = urlencode("BaoHiem " . $data['insurance_info']['pnr']);
                            
                            $qrUrl = "https://img.vietqr.io/image/{$bankBin}-{$accNo}-compact2.png?amount={$amount}&addInfo={$content}&accountName={$accName}";
                        ?>
                        
                        <div class="p-3 border rounded-4 d-inline-block bg-white shadow-sm mb-3">
                            <img src="<?= $qrUrl ?>" alt="Mã QR Thanh Toán" style="width: 250px; height: 250px; object-fit: contain;">
                        </div>
                        
                        <div class="alert alert-info py-2" style="font-size: 13px;">
                            <i class="fas fa-spinner fa-spin me-2"></i>Hệ thống đang chờ nhận tiền. Vui lòng không đóng trang này.
                        </div>
                    </div>
                    
                    <form action="<?= BASEURL ?>/service/confirmInsurancePayment" method="POST">
                        <button type="submit" class="btn-pay"><i class="fas fa-check-circle me-2"></i>TÔI ĐÃ CHUYỂN KHOẢN</button>
                    </form>
                </div>
            </div>
            
            <div class="text-center mt-4 text-muted small">
                <i class="fas fa-shield-alt text-success me-1"></i> Giao dịch được mã hóa 256-bit an toàn tuyệt đối.
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.payment-method').forEach(item => {
        item.addEventListener('click', function() {
            document.querySelectorAll('.payment-method').forEach(el => el.classList.remove('active'));
            this.classList.add('active');
            this.querySelector('input').checked = true;
        });
    });
</script>
</body>
</html>
