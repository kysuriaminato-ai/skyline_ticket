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
        
        .history-container { padding: 40px 0; }
        .history-card { background: #fff; border-radius: 16px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.05); margin-bottom: 20px; overflow: hidden; transition: 0.3s; }
        .history-card:hover { transform: translateY(-3px); box-shadow: 0 15px 35px rgba(0,0,0,0.1); }
        .history-header { background: #fafafa; border-bottom: 1px solid #f0f0f0; padding: 15px 25px; display: flex; justify-content: space-between; align-items: center; }
        .history-body { padding: 25px; }
        .invoice-id { font-weight: 800; color: #2c3e50; font-size: 16px; }
        .invoice-date { color: #888; font-size: 14px; font-weight: 500; }
        
        .status-badge { padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: 700; background: #e8f8f5; color: #2ecc71; }
        
        .empty-state { text-align: center; padding: 60px 20px; background: #fff; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .empty-icon { font-size: 60px; color: #e0e0e0; margin-bottom: 20px; }
    </style>
</head>
<body>

<nav class="top-nav py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <a href="<?= BASEURL ?>/home" class="brand-logo">SKYLINE<span>TICKET</span></a>
        <a href="<?= BASEURL ?>/home" class="btn btn-outline-secondary btn-sm rounded-pill fw-bold"><i class="fas fa-home me-1"></i> Trang chủ</a>
    </div>
</nav>

<div class="container history-container">
    <div class="d-flex align-items-center mb-4">
        <h2 class="fw-bold mb-0"><i class="fas fa-history me-3 text-primary"></i>Lịch Sử Mua Dịch Vụ</h2>
    </div>

    <div class="row">
        <div class="col-lg-8 mx-auto">
            <?php if (empty($data['invoices'])): ?>
                <div class="empty-state">
                    <div class="empty-icon"><i class="fas fa-file-invoice"></i></div>
                    <h4 class="fw-bold text-secondary">Chưa có giao dịch nào</h4>
                    <p class="text-muted">Bạn chưa thực hiện giao dịch mua dịch vụ bổ sung nào.</p>
                    <a href="<?= BASEURL ?>/service/insurance" class="btn btn-primary rounded-pill px-4 mt-3">Mua Bảo Hiểm Ngay</a>
                </div>
            <?php else: ?>
                <?php foreach (array_reverse($data['invoices']) as $invoice): ?>
                    <div class="history-card">
                        <div class="history-header">
                            <div>
                                <div class="invoice-id"><i class="fas fa-receipt me-2 text-muted"></i>Hóa Đơn: <?= $invoice['id'] ?></div>
                                <div class="invoice-date"><i class="far fa-clock me-1"></i> <?= date('d/m/Y H:i', strtotime($invoice['date'])) ?></div>
                            </div>
                            <div class="status-badge"><i class="fas fa-check-circle me-1"></i> <?= $invoice['status'] ?></div>
                        </div>
                        <div class="history-body">
                            <div class="row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <p class="mb-1 text-muted small">Dịch vụ</p>
                                    <h5 class="fw-bold text-primary mb-2"><?= $invoice['service'] ?></h5>
                                    <p class="mb-0 fw-semibold"><i class="fas fa-tag me-1 text-warning"></i> <?= $invoice['plan'] ?></p>
                                </div>
                                <div class="col-sm-6 text-sm-end">
                                    <p class="mb-1 text-muted small">Mã PNR</p>
                                    <h5 class="fw-bold mb-3"><?= $invoice['pnr'] ?></h5>
                                    
                                    <p class="mb-1 text-muted small">Tổng thanh toán</p>
                                    <h4 class="fw-bold text-danger mb-0"><?= number_format($invoice['amount'], 0, ',', '.') ?> VNĐ</h4>
                                </div>
                            </div>
                            <hr class="text-muted opacity-25">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-user-circle fs-4 text-secondary me-2"></i>
                                <span class="fw-semibold text-secondary">Hành khách: <?= $invoice['fullname'] ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
