<!-- app/Views/flights/checkout.php -->
<?php 
/** @var array $data */
require_once '../app/Views/layouts/header.php'; 
?>
<?php 
$flight = $data['flight'];
$cabin_class = $data['cabin_class'];
$base_price = $data['base_price'];
$tax_fee = $data['tax_fee'];
$total_price = $data['total_price'];
?>

<style>
    .nav-pills .nav-link { border-radius: 8px; color: #495057; font-weight: bold; padding: 12px 20px; }
    .nav-pills .nav-link.active { background-color: var(--primary-color); color: white; }
    .payment-box { border: 2px solid #e9ecef; border-radius: 12px; padding: 20px; margin-top: 15px; }
</style>

<div class="bg-primary text-white py-3 mb-4" style="background-color: var(--primary-color) !important;">
    <div class="container">
        <h4 class="mb-0 fw-bold"><i class="fas fa-lock me-2"></i>Thanh toán an toàn</h4>
    </div>
</div>

<div class="container mb-5">
    <form action="<?= BASEURL ?>/checkout/process" method="POST">
        <input type="hidden" name="flight_id" value="<?= $flight['id'] ?>">
        <input type="hidden" name="cabin_class" value="<?= htmlspecialchars($cabin_class) ?>">
        <input type="hidden" name="total_price" value="<?= $total_price ?>">

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                        <h5 class="fw-bold"><i class="fas fa-user-edit text-primary me-2"></i>1. Thông tin liên hệ</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label small fw-bold text-muted">Họ và tên (In hoa không dấu) *</label>
                                <input type="text" class="form-control py-2" name="fullname" placeholder="VD: NGUYEN VAN A" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Số điện thoại *</label>
                                <input type="tel" class="form-control py-2" name="phone" placeholder="09xxxxxxx" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Địa chỉ Email *</label>
                                <input type="email" class="form-control py-2" name="email" placeholder="email@example.com" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                        <h5 class="fw-bold"><i class="fas fa-wallet text-primary me-2"></i>2. Phương thức thanh toán</h5>
                    </div>
                    <div class="card-body p-4">
                        <ul class="nav nav-pills nav-fill mb-3" id="paymentTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="card-tab" data-bs-toggle="pill" data-bs-target="#card" type="button" role="tab"><i class="far fa-credit-card me-2"></i>Thẻ tín dụng / Ghi nợ</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="qr-tab" data-bs-toggle="pill" data-bs-target="#qr" type="button" role="tab"><i class="fas fa-qrcode me-2"></i>Quét mã QR</button>
                            </li>
                        </ul>

                        <div class="tab-content" id="paymentTabsContent">
                            <div class="tab-pane fade show active payment-box" id="card" role="tabpanel">
                                <div class="mb-3 d-flex gap-2">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/0/04/Visa.svg" width="40" alt="Visa">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" width="40" alt="Mastercard">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/JCB_logo.svg" width="40" alt="JCB">
                                </div>
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label small fw-bold">Số thẻ</label>
                                        <input type="text" class="form-control" placeholder="0000 0000 0000 0000">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label small fw-bold">Tên in trên thẻ</label>
                                        <input type="text" class="form-control" placeholder="NGUYEN VAN A">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Ngày hết hạn (MM/YY)</label>
                                        <input type="text" class="form-control" placeholder="MM/YY">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Mã bảo mật (CVV)</label>
                                        <input type="text" class="form-control" placeholder="123">
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade payment-box text-center" id="qr" role="tabpanel">
                                <h6 class="fw-bold mb-3">Mở ứng dụng ngân hàng hoặc Momo để quét mã</h6>
                                <div class="bg-white p-3 d-inline-block border rounded-3 mb-3">
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=SkylineTicket_<?= $flight['id'] ?>" alt="QR Code">
                                </div>
                                <p class="text-danger fw-bold fs-5 mb-1">Số tiền: <?= number_format($total_price, 0, ',', '.') ?> VND</p>
                                <p class="small text-muted mb-0">Đơn hàng sẽ tự động xác nhận sau khi thanh toán thành công.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 sticky-top" style="top: 100px;">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                        <h5 class="fw-bold">Chi tiết chuyến bay</h5>
                    </div>
                    <div class="card-body p-4">
                        
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <span class="badge bg-success mb-1"><?= htmlspecialchars($flight["airline"]) ?></span>
                                <div class="fw-bold"><?= htmlspecialchars($flight["flight_number"]) ?></div>
                            </div>
                            <div class="text-end small text-muted">
                                Ngày bay: <br>
                                <strong class="text-dark"><?= date('d/m/Y', strtotime($flight["departure_time"])) ?></strong>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center bg-light p-3 rounded-3 mb-4">
                            <div class="text-center">
                                <div class="fw-bold fs-5"><?= date('H:i', strtotime($flight["departure_time"])) ?></div>
                                <div class="small"><?= substr($flight["departure_city"], -4, 3) ?></div>
                            </div>
                            <div class="flex-grow-1 text-center px-3">
                                <i class="fas fa-plane text-primary"></i>
                                <div style="border-top: 1px dashed #ccc; margin-top: -8px;"></div>
                            </div>
                            <div class="text-center">
                                <div class="fw-bold fs-5">--:--</div>
                                <div class="small"><?= substr($flight["arrival_city"], -4, 3) ?></div>
                            </div>
                        </div>

                        <hr class="text-muted">

                        <h6 class="fw-bold mb-3">Tóm tắt chi phí</h6>
                        <div class="d-flex justify-content-between mb-2 small">
                            <span>Giá vé (<?= htmlspecialchars(explode(' ', $cabin_class)[0]) ?>)</span>
                            <strong><?= number_format($base_price, 0, ',', '.') ?> đ</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2 small">
                            <span>Thuế & Phí</span>
                            <strong><?= number_format($tax_fee, 0, ',', '.') ?> đ</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-3 small">
                            <span>Hành lý xách tay</span>
                            <strong class="text-success">Miễn phí (7kg)</strong>
                        </div>

                        <div class="bg-primary-subtle p-3 rounded-3 border mb-4" style="background-color: #e6f0ff;">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold">Tổng thanh toán</span>
                                <strong class="text-danger fs-4"><?= number_format($total_price, 0, ',', '.') ?> đ</strong>
                            </div>
                        </div>

                        <button type="submit" class="btn w-100 fw-bold py-3 text-white fs-5" style="background-color: var(--secondary-color); border-radius: 8px;">
                            ĐẶT VÉ & THANH TOÁN
                        </button>
                        <p class="text-center small text-muted mt-3 mb-0">
                            Bằng cách nhấp vào nút này, bạn đồng ý với các <a href="#">Điều khoản & Điều kiện</a> của chúng tôi.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<?php require_once '../app/Views/layouts/footer.php'; ?>