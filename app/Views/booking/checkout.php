<?php require_once '../app/Views/layouts/header.php'; ?>

<style>
    body { background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
    
    /* ================= PROGRESS BAR ================= */
    .booking-steps { background: #fff; padding: 25px 0; border-bottom: 1px solid #e0e0e0; margin-bottom: 30px; }
    .steps-container { display: flex; justify-content: space-between; align-items: center; max-width: 800px; margin: 0 auto; position: relative; }
    .step { flex: 1; text-align: center; position: relative; z-index: 2; }
    .step-icon { width: 32px; height: 32px; background: #fff; border: 2px solid #ccc; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px; font-weight: bold; color: #ccc; transition: 0.3s; }
    .step-text { font-size: 14px; color: #888; font-weight: 600; }
    .step.active .step-icon { background: #0071c2; border-color: #0071c2; color: #fff; box-shadow: 0 0 0 5px rgba(0, 113, 194, 0.1); }
    .step.active .step-text { color: #0071c2; }
    .steps-line { position: absolute; top: 16px; left: 15%; right: 15%; height: 2px; background: #eee; z-index: 1; }
    .line-fill { height: 100%; background: #0071c2; width: 0%; transition: width 0.5s ease; }

    /* ================= GIAO DIỆN CHUNG ================= */
    .checkout-section { background: #fff; border-radius: 12px; padding: 25px; margin-bottom: 20px; border: 1px solid #e0e0e0; box-shadow: 0 2px 8px rgba(0,0,0,0.02); }
    .section-title { font-weight: 700; font-size: 18px; color: #333; margin-bottom: 20px; display: flex; align-items: center; }
    .section-title i { color: #0071c2; margin-right: 10px; }
    
    /* ================= TIỆN ÍCH (UPGRADE CARDS) ================= */
    .upgrade-container { display: flex; gap: 15px; margin-top: 15px; }
    .upgrade-card { 
        flex: 1; border: 2px solid #e0e0e0; border-radius: 12px; padding: 20px 15px; 
        text-align: center; cursor: pointer; transition: 0.3s; position: relative; background: #fff;
    }
    .upgrade-card:hover { border-color: #b3d4f0; background: #f8fbff; }
    .upgrade-card.selected { border-color: #0071c2; background: #f0f8ff; box-shadow: 0 4px 15px rgba(0,113,194,0.15); }
    
    .upgrade-title { font-weight: 700; font-size: 16px; color: #333; margin-bottom: 5px; }
    .upgrade-price { font-size: 18px; font-weight: 800; color: #333; margin-bottom: 15px; }
    
    .upgrade-feature { font-size: 13px; color: #555; margin-bottom: 10px; display: flex; align-items: center; justify-content: center; gap: 8px;}
    .upgrade-feature i.fa-check { color: #28a745; }
    .upgrade-feature i.fa-times { color: #ccc; }
    
    .badge-popular { position: absolute; top: -12px; left: 50%; transform: translateX(-50%); background: #e8f5e9; color: #28a745; font-weight: 700; font-size: 12px; padding: 3px 12px; border-radius: 12px; border: 1px solid #c3e6cb; white-space: nowrap;}
    .badge-speed { background: #e8f5e9; color: #28a745; font-weight: 700; font-size: 12px; padding: 3px 10px; border-radius: 4px; display: inline-block; margin-bottom: 15px;}
    
    .btn-select-tier { width: 100%; padding: 8px; border-radius: 8px; border: 1px solid #ccc; background: #fff; font-weight: 600; color: #555; transition: 0.3s; margin-top: 15px; }
    .upgrade-card.selected .btn-select-tier { background: #0071c2; border-color: #0071c2; color: #fff; }

    /* Hành lý thất lạc */
    .baggage-protection { border: 1px solid #e0e0e0; border-radius: 12px; padding: 20px; display: flex; align-items: flex-start; gap: 15px; margin-top: 20px; background: #fff;}
    .baggage-protection:hover { border-color: #ccc; }
    
    /* ================= TÓM TẮT CHI PHÍ ================= */
    .price-summary-box { background: #fff; border-radius: 12px; padding: 25px; border: 1px solid #e0e0e0; position: sticky; top: 100px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
    .summary-row { display: flex; justify-content: space-between; margin-bottom: 12px; color: #555; font-size: 14px;}
    .total-row { border-top: 1px dashed #ddd; padding-top: 15px; margin-top: 15px; display: flex; justify-content: space-between; align-items: center; }
    .btn-pay { background-color: #f6c23e; border: none; color: #fff; font-weight: 800; padding: 15px; border-radius: 8px; width: 100%; transition: 0.3s; font-size: 16px;}
    .btn-pay:hover { background-color: #eeb83e; transform: translateY(-2px); box-shadow: 0 4px 10px rgba(246, 194, 62, 0.3); }

    /* Ẩn radio button mặc định */
    input[type="radio"].tier-radio { display: none; }
</style>

<div class="booking-steps shadow-sm">
    <div class="container">
        <div class="steps-container">
            <div class="step active">
                <div class="step-icon">1</div>
                <div class="step-text">Thông tin khách hàng</div>
            </div>
            <div class="step">
                <div class="step-icon">2</div>
                <div class="step-text">Chi tiết thanh toán</div>
            </div>
            <div class="step">
                <div class="step-icon">3</div>
                <div class="step-text">Đã xác nhận đặt chỗ!</div>
            </div>
            <div class="steps-line"><div class="line-fill" style="width: 0%;"></div></div>
        </div>
    </div>
</div>

<div class="container mb-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Thông tin chuyến bay -->
            <div class="checkout-section" style="border-left: 5px solid #0071c2;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="fw-bold mb-1"><?= $data['flight']['departure'] ?> <i class="fas fa-arrow-right mx-2 text-muted fs-5"></i> <?= $data['flight']['destination'] ?></h4>
                        <p class="text-muted mb-0"><i class="far fa-calendar-alt me-2"></i><?= date('d/m/Y', strtotime($data['flight']['departure_time'])) ?> | <?= $data['info']['class'] == 'biz' ? 'Thương gia' : 'Phổ thông' ?></p>
                    </div>
                    <div class="text-end">
                        <span class="badge bg-light text-primary border p-2 fs-6"><?= $data['flight']['flight_code'] ?? 'VN 273' ?></span>
                    </div>
                </div>
            </div>

            <form id="checkoutForm" action="<?= BASEURL ?>/booking/process" method="POST">
                <input type="hidden" name="flight_id" value="<?= $data['flight']['id'] ?>">
                <input type="hidden" name="base_price" id="basePriceInput" value="<?= $data['info']['total_price'] ?>">
                <input type="hidden" name="total_price" id="finalPriceInput" value="<?= $data['info']['total_price'] ?>">
                <input type="hidden" name="adults" value="<?= $data['info']['adults'] ?>">
                <input type="hidden" name="children" value="<?= $data['info']['children'] ?>">

                <!-- THÔNG TIN LIÊN HỆ -->
                <div class="checkout-section">
                    <div class="section-title"><i class="fas fa-address-book"></i> Chi tiết liên lạc</div>
                    <p class="text-muted small mb-3">*Mục bắt buộc</p>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Họ và Tên *</label>
                            <input type="text" class="form-control" name="contact_name" value="<?= $_SESSION['user_name'] ?? '' ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Điện thoại di động *</label>
                            <input type="text" class="form-control" name="contact_phone" placeholder="VD: 0912345678" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Email ID *</label>
                            <input type="email" class="form-control" name="contact_email" placeholder="Vé điện tử sẽ gửi về email này" value="<?= $_SESSION['user_email'] ?? '' ?>" required>
                        </div>
                    </div>
                </div>

                <!-- THÔNG TIN HÀNH KHÁCH -->
                <div class="checkout-section">
                    <div class="section-title"><i class="fas fa-user-friends"></i> Hành khách (Người lớn, từ 18 tuổi trở lên)</div>
                    <p class="text-muted small mb-3">Thông tin hành khách phải trùng khớp với hộ chiếu hoặc giấy tờ tùy thân có ảnh của quý khách.</p>
                    
                    <?php for($i = 1; $i <= $data['info']['adults']; $i++): ?>
                        <div class="p-3 bg-light rounded-3 mb-3 border">
                            <h6 class="fw-bold mb-3 text-primary">Hành khách <?= $i ?></h6>
                            <div class="row g-2">
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold">Họ (vd: Nguyễn) *</label>
                                    <input type="text" class="form-control" name="passengers[<?= $i ?>][last_name]" required>
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label small fw-bold">Tên & Tên đệm *</label>
                                    <input type="text" class="form-control" name="passengers[<?= $i ?>][first_name]" required>
                                </div>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>

                <!-- TIỆN ÍCH (AGODA STYLE) -->
                <div class="checkout-section bg-light border-0">
                    <div class="section-title mb-1"><i class="fas fa-star text-warning"></i> Tiện ích</div>
                    
                    <div class="bg-white p-4 rounded-3 border mt-3">
                        <h5 class="fw-bold mb-1">Nâng cấp mức hỗ trợ của quý khách</h5>
                        <p class="text-muted small mb-4">Cấp độ dịch vụ cao cấp của chúng tôi có thể giúp quý khách tiết kiệm tiền nếu kế hoạch thay đổi.</p>
                        
                        <!-- 3 Thẻ Upgrade -->
                        <div class="row g-3">
                            <!-- Cơ bản -->
                            <div class="col-md-4">
                                <label class="upgrade-card selected w-100" id="card-tier-basic">
                                    <input type="radio" class="tier-radio" name="support_tier" value="0" data-name="Cơ bản" checked onchange="updateTier(this)">
                                    <div class="upgrade-title">Cơ bản</div>
                                    <div class="upgrade-price">0 đ</div>
                                    <div class="upgrade-feature"><i class="fas fa-check"></i> Hỗ trợ chuẩn</div>
                                    <div class="upgrade-feature"><i class="fas fa-times"></i> Tặng mã giảm giá</div>
                                    <div class="upgrade-feature"><i class="fas fa-times"></i> Hỗ trợ ưu tiên</div>
                                    <div class="btn-select-tier mt-4">Đã chọn</div>
                                </label>
                            </div>
                            <!-- Cộng -->
                            <div class="col-md-4">
                                <label class="upgrade-card w-100" id="card-tier-plus">
                                    <input type="radio" class="tier-radio" name="support_tier" value="237217" data-name="Gói Cộng" onchange="updateTier(this)">
                                    <div class="upgrade-title">Cộng</div>
                                    <div class="upgrade-price">237.217 đ</div>
                                    <div class="badge-speed">Nhanh</div>
                                    <div class="upgrade-feature"><i class="fas fa-check"></i> Hỗ trợ 24/7</div>
                                    <div class="upgrade-feature"><i class="fas fa-check"></i> Mã giảm 250k</div>
                                    <div class="upgrade-feature"><i class="fas fa-times"></i> Hỗ trợ ưu tiên</div>
                                    <div class="btn-select-tier">Chọn</div>
                                </label>
                            </div>
                            <!-- Cao cấp -->
                            <div class="col-md-4">
                                <label class="upgrade-card w-100" id="card-tier-premium" style="border-color: #c3e6cb;">
                                    <div class="badge-popular"><i class="fas fa-thumbs-up me-1"></i> Phổ biến</div>
                                    <input type="radio" class="tier-radio" name="support_tier" value="527148" data-name="Gói Cao Cấp" onchange="updateTier(this)">
                                    <div class="upgrade-title">Cao cấp</div>
                                    <div class="upgrade-price">527.148 đ</div>
                                    <div class="badge-speed" style="background: #0071c2; color: #fff;">Nhanh nhất</div>
                                    <div class="upgrade-feature"><i class="fas fa-check"></i> Hỗ trợ 24/7</div>
                                    <div class="upgrade-feature"><i class="fas fa-check"></i> Mã giảm 500k</div>
                                    <div class="upgrade-feature"><i class="fas fa-check"></i> Hỗ trợ ưu tiên</div>
                                    <div class="btn-select-tier">Chọn</div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Bảo vệ hành lý -->
                    <label class="baggage-protection w-100 cursor-pointer" style="cursor: pointer;">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="baggage_protection" id="baggageCheck" value="150000" style="width: 20px; height: 20px;" onchange="calculateTotal()">
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h6 class="fw-bold mb-1">Bảo vệ hành lý thất lạc <span class="text-danger float-end fw-bold">+150.000 đ</span></h6>
                            <div class="text-muted small mt-2">
                                <p class="mb-1"><i class="fas fa-check text-success me-1"></i> Theo dõi và đẩy nhanh hoàn trả mọi hành lý ký gửi bị thất lạc.</p>
                                <p class="mb-0"><i class="fas fa-check text-success me-1"></i> Nhận USD 1,000 mỗi kiện nếu hành lý chưa được chuyển đến trong vòng 96 giờ.</p>
                            </div>
                        </div>
                        <i class="fas fa-suitcase-rolling fa-3x text-primary opacity-50"></i>
                    </label>
                </div>
            </form>
        </div>

        <!-- TÓM TẮT CHI PHÍ (CỘT PHẢI) -->
        <div class="col-lg-4">
            <div class="price-summary-box">
                <h5 class="fw-bold mb-4" style="color: #0071c2;">Chi tiết giá</h5>
                
                <div class="summary-row">
                    <span>Hành khách (<?= $data['info']['adults'] ?> Người lớn)</span>
                    <span class="fw-bold" id="displayBasePrice"><?= number_format($data['info']['total_price']) ?> đ</span>
                </div>
                
                <!-- Hiển thị tự động khi chọn Tiện ích -->
                <div class="summary-row text-primary" id="rowSupportTier" style="display: none;">
                    <span id="nameSupportTier">Gói hỗ trợ</span>
                    <span class="fw-bold" id="priceSupportTier">0 đ</span>
                </div>
                
                <div class="summary-row text-primary" id="rowBaggage" style="display: none;">
                    <span>Bảo vệ hành lý</span>
                    <span class="fw-bold">+150.000 đ</span>
                </div>

                <div class="summary-row text-success">
                    <span>Thuế và phí</span>
                    <span>Đã bao gồm</span>
                </div>
                
                <div class="total-row">
                    <h5 class="fw-bold mb-0 text-dark">Tổng cộng</h5>
                    <h3 class="fw-bold text-danger mb-0" id="displayTotalPrice"><?= number_format($data['info']['total_price']) ?> đ</h3>
                </div>
                
                <div class="mt-4">
                    <button type="submit" form="checkoutForm" class="btn-pay">TIẾP TỤC BƯỚC CUỐI <i class="fas fa-arrow-right ms-2"></i></button>
                    <p class="text-center text-muted small mt-3"><i class="fas fa-shield-alt me-1"></i> Giao dịch được mã hóa an toàn 256-bit</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Xử lý Giao diện chọn Gói Hỗ Trợ và Tính Tiền
    const basePrice = <?= $data['info']['total_price'] ?>;
    
    function updateTier(radioElement) {
        // Reset CSS của tất cả các thẻ
        document.querySelectorAll('.upgrade-card').forEach(card => {
            card.classList.remove('selected');
            card.querySelector('.btn-select-tier').innerText = 'Chọn';
        });
        
        // Active thẻ vừa click
        const parentCard = radioElement.closest('.upgrade-card');
        parentCard.classList.add('selected');
        parentCard.querySelector('.btn-select-tier').innerText = 'Đã chọn';
        
        calculateTotal();
    }

    function calculateTotal() {
        // Lấy giá trị của Gói hỗ trợ đang được check
        const selectedTier = document.querySelector('input[name="support_tier"]:checked');
        const tierPrice = parseInt(selectedTier.value);
        const tierName = selectedTier.getAttribute('data-name');
        
        // Lấy giá trị Bảo vệ hành lý
        const isBaggageChecked = document.getElementById('baggageCheck').checked;
        const baggagePrice = isBaggageChecked ? 150000 : 0;
        
        // Tính tổng
        const finalPrice = basePrice + tierPrice + baggagePrice;
        
        // Format tiền tệ
        const formatter = new Intl.NumberFormat('vi-VN');
        
        // Cập nhật DOM (Giao diện cột phải)
        document.getElementById('finalPriceInput').value = finalPrice;
        document.getElementById('displayTotalPrice').innerText = formatter.format(finalPrice) + ' đ';
        
        // Hiển thị dòng Gói hỗ trợ nếu có phí
        const rowTier = document.getElementById('rowSupportTier');
        if (tierPrice > 0) {
            rowTier.style.display = 'flex';
            document.getElementById('nameSupportTier').innerText = 'Tiện ích: ' + tierName;
            document.getElementById('priceSupportTier').innerText = '+' + formatter.format(tierPrice) + ' đ';
        } else {
            rowTier.style.display = 'none';
        }
        
        // Hiển thị dòng Hành lý nếu có tick
        document.getElementById('rowBaggage').style.display = isBaggageChecked ? 'flex' : 'none';
    }
</script>

<?php require_once '../app/Views/layouts/footer.php'; ?>