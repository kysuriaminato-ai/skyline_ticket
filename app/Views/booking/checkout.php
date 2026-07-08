<?php require_once '../app/Views/layouts/header.php'; ?>

<style>
    body { background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
    
    /* ================= PROGRESS BAR ================= */
    .booking-steps { background: #fff; padding: 25px 0; border-bottom: 1px solid #e0e0e0; margin-bottom: 30px; }
    .steps-container { display: flex; justify-content: space-between; align-items: center; max-width: 800px; margin: 0 auto; position: relative; }
    .step { flex: 1; text-align: center; position: relative; z-index: 2; transition: 0.3s; }
    .step-icon { width: 32px; height: 32px; background: #fff; border: 2px solid #ccc; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px; font-weight: bold; color: #ccc; transition: 0.3s; }
    .step-text { font-size: 14px; color: #888; font-weight: 600; }
    
    .step.active .step-icon { background: #0071c2; border-color: #0071c2; color: #fff; box-shadow: 0 0 0 5px rgba(0, 113, 194, 0.1); }
    .step.active .step-text { color: #0071c2; }
    
    .step.completed .step-icon { background: #28a745; border-color: #28a745; color: #fff; }
    .step.completed .step-text { color: #28a745; }

    .steps-line { position: absolute; top: 16px; left: 15%; right: 15%; height: 2px; background: #eee; z-index: 1; }
    .line-fill { height: 100%; background: #28a745; width: 0%; transition: width 0.5s ease; }

    /* ================= GIAO DIỆN CHUNG ================= */
    .checkout-section { background: #fff; border-radius: 12px; padding: 25px; margin-bottom: 20px; border: 1px solid #e0e0e0; box-shadow: 0 2px 8px rgba(0,0,0,0.02); }
    .section-title { font-weight: 700; font-size: 18px; color: #333; margin-bottom: 20px; display: flex; align-items: center; }
    .section-title i { color: #0071c2; margin-right: 10px; }
    
    /* ================= TIỆN ÍCH (UPGRADE CARDS) ================= */
    .upgrade-container { display: flex; gap: 15px; margin-top: 15px; flex-wrap: wrap;}
    .upgrade-card { 
        flex: 1; min-width: 200px; border: 2px solid #e0e0e0; border-radius: 12px; padding: 20px 15px; 
        text-align: center; cursor: pointer; transition: 0.3s; position: relative; background: #fff;
    }
    .upgrade-card:hover { border-color: #b3d4f0; background: #f8fbff; }
    .upgrade-card.selected { border-color: #0071c2; background: #f0f8ff; box-shadow: 0 4px 15px rgba(0,113,194,0.15); }
    
    .upgrade-title { font-weight: 700; font-size: 16px; color: #333; margin-bottom: 5px; }
    .upgrade-price { font-size: 18px; font-weight: 800; color: #333; margin-bottom: 15px; }
    .upgrade-feature { font-size: 13px; color: #555; margin-bottom: 10px; display: flex; align-items: center; justify-content: center; gap: 8px;}
    .badge-popular { position: absolute; top: -12px; left: 50%; transform: translateX(-50%); background: #e8f5e9; color: #28a745; font-weight: 700; font-size: 12px; padding: 3px 12px; border-radius: 12px; border: 1px solid #c3e6cb; white-space: nowrap;}
    .btn-select-tier { width: 100%; padding: 8px; border-radius: 8px; border: 1px solid #ccc; background: #fff; font-weight: 600; color: #555; transition: 0.3s; margin-top: 15px; }
    .upgrade-card.selected .btn-select-tier { background: #0071c2; border-color: #0071c2; color: #fff; }

    /* Hành lý thất lạc */
    .baggage-protection { border: 1px solid #e0e0e0; border-radius: 12px; padding: 20px; display: flex; align-items: flex-start; gap: 15px; margin-top: 20px; background: #fff;}
    .baggage-protection:hover { border-color: #ccc; }
    
    /* ================= TÓM TẮT CHI PHÍ ================= */
    .price-summary-box { background: #fff; border-radius: 12px; padding: 25px; border: 1px solid #e0e0e0; position: sticky; top: 100px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
    .summary-row { display: flex; justify-content: space-between; margin-bottom: 12px; color: #555; font-size: 14px;}
    .total-row { border-top: 1px dashed #ddd; padding-top: 15px; margin-top: 15px; display: flex; justify-content: space-between; align-items: center; }
    
    .btn-pay { background-color: #f6c23e; border: none; color: #fff; font-weight: 800; padding: 15px; border-radius: 8px; width: 100%; transition: 0.3s; font-size: 16px; display: flex; justify-content: center; align-items: center;}
    .btn-pay:hover:not(:disabled) { background-color: #eeb83e; transform: translateY(-2px); box-shadow: 0 4px 10px rgba(246, 194, 62, 0.3); }
    .btn-pay:disabled { background-color: #ccc; cursor: not-allowed; transform: none; box-shadow: none; }

    /* Trust Signals */
    .trust-signals { display: flex; align-items: center; justify-content: center; gap: 10px; margin-top: 15px; }
    .trust-signals img { height: 24px; opacity: 0.7; filter: grayscale(100%); transition: 0.3s; }
    .trust-signals img:hover { opacity: 1; filter: grayscale(0%); }

    /* Ẩn radio button mặc định */
    input[type="radio"].tier-radio { display: none; }

    /* ================= MOBILE STICKY BOTTOM BAR ================= */
    @media (max-width: 991px) {
        .price-summary-box { border-radius: 0; position: fixed; bottom: 0; left: 0; right: 0; z-index: 999; padding: 15px; box-shadow: 0 -4px 15px rgba(0,0,0,0.1); top: auto; }
        .summary-details { display: none; } /* Ẩn chi tiết trên mobile cho gọn */
        .summary-details.show { display: block; }
        .total-row { border-top: none; padding-top: 0; margin-top: 0; }
        body { padding-bottom: 150px; } /* Tránh bị che content */
        .btn-toggle-summary { display: flex; align-items: center; justify-content: center; background: none; border: none; color: #0071c2; font-size: 12px; width: 100%; margin-bottom: 10px; }
    }
    @media (min-width: 992px) {
        .btn-toggle-summary { display: none; }
    }

    /* Hiệu ứng loading spinner */
    .spinner-border { width: 1.2rem; height: 1.2rem; border-width: 0.2em; display: none; margin-right: 8px;}
    .btn-pay.loading .spinner-border { display: inline-block; }
    .btn-pay.loading .btn-text-content { display: none; }
    .btn-pay.loading::after { content: "Đang xử lý..."; }
</style>

<div class="booking-steps shadow-sm">
    <div class="container">
        <div class="steps-container">
            <div class="step active" id="indicator-step1">
                <div class="step-icon"><i class="fas fa-user"></i></div>
                <div class="step-text">Thông tin hành khách</div>
            </div>
            <div class="step" id="indicator-step2">
                <div class="step-icon"><i class="fas fa-suitcase-rolling"></i></div>
                <div class="step-text">Tiện ích bổ sung</div>
            </div>
            <div class="step" id="indicator-step3">
                <div class="step-icon"><i class="fas fa-credit-card"></i></div>
                <div class="step-text">Thanh toán</div>
            </div>
            <div class="steps-line"><div class="line-fill" id="progress-bar-fill" style="width: 25%;"></div></div>
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
                        <p class="text-muted mb-0"><i class="far fa-calendar-alt me-2"></i><?= date('d/m/Y', strtotime($data['flight']['departure_time'])) ?> | Hạng vé: <strong class="text-primary"><?= htmlspecialchars($data['info']['class']) ?></strong></p>
                    </div>
                    <div class="text-end">
                        <span class="badge bg-light text-primary border p-2 fs-6"><?= $data['flight']['flight_code'] ?? 'VN 273' ?></span>
                    </div>
                </div>
            </div>

            <form id="checkoutForm" action="<?= BASEURL ?>/booking/process" method="POST" onsubmit="return handleFormSubmit(event)">
                <input type="hidden" name="flight_id" value="<?= $data['flight']['id'] ?>">
                <input type="hidden" name="base_price" id="basePriceInput" value="<?= $data['info']['final_price'] ?? $data['info']['total_price'] ?>">
                <input type="hidden" name="total_price" id="finalPriceInput" value="<?= $data['info']['final_price'] ?? $data['info']['total_price'] ?>">
                <input type="hidden" name="adults" value="<?= $data['info']['adults'] ?>">
                <input type="hidden" name="children" value="<?= $data['info']['children'] ?>">

                <!-- ================= BƯỚC 1: THÔNG TIN ================= -->
                <div id="step-1-content">
                    <!-- THÔNG TIN LIÊN HỆ -->
                    <div class="checkout-section">
                        <div class="section-title"><i class="fas fa-address-book"></i> Chi tiết liên lạc</div>
                        <p class="text-muted small mb-3">*Mục bắt buộc. Thông tin vé điện tử sẽ được gửi về đây.</p>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Họ và Tên *</label>
                                <input type="text" class="form-control" name="contact_name" id="contact_name" value="<?= $_SESSION['user_name'] ?? '' ?>" autocomplete="name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Điện thoại di động *</label>
                                <!-- Đổi thành type="tel" để hiện bàn phím số trên Mobile -->
                                <input type="tel" inputmode="numeric" class="form-control" name="contact_phone" id="contact_phone" placeholder="VD: 0912345678" autocomplete="tel" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-bold">Email ID *</label>
                                <input type="email" class="form-control" name="contact_email" id="contact_email" placeholder="VD: email@example.com" value="<?= $_SESSION['user_email'] ?? '' ?>" autocomplete="email" required>
                            </div>
                        </div>
                        
                        <div class="form-check mt-3 bg-light p-2 rounded">
                            <input class="form-check-input ms-1" type="checkbox" id="autofillPassenger" onchange="autoFillFirstPassenger()">
                            <label class="form-check-label ms-2 fw-bold text-primary" for="autofillPassenger">
                                Tôi là hành khách tham gia chuyến bay (Tự động điền Hành khách 1)
                            </label>
                        </div>
                    </div>

                    <!-- THÔNG TIN HÀNH KHÁCH -->
                    <div class="checkout-section">
                        <div class="section-title"><i class="fas fa-user-friends"></i> Hành khách (Người lớn, từ 18 tuổi trở lên)</div>
                        <p class="text-muted small mb-3 text-danger"><i class="fas fa-exclamation-triangle"></i> Thông tin hành khách phải trùng khớp với hộ chiếu hoặc giấy tờ tùy thân.</p>
                        
                        <?php for($i = 1; $i <= $data['info']['adults']; $i++): ?>
                            <div class="p-3 bg-light rounded-3 mb-3 border passenger-card">
                                <h6 class="fw-bold mb-3 text-primary">Hành khách <?= $i ?></h6>
                                <div class="row g-2">
                                    <div class="col-md-4">
                                        <label class="form-label small fw-bold">Họ (vd: Nguyễn) *</label>
                                        <input type="text" class="form-control pax-last-name" id="pax_last_<?= $i ?>" name="passengers[<?= $i ?>][last_name]" required>
                                    </div>
                                    <div class="col-md-8">
                                        <label class="form-label small fw-bold">Tên & Tên đệm *</label>
                                        <input type="text" class="form-control pax-first-name" id="pax_first_<?= $i ?>" name="passengers[<?= $i ?>][first_name]" required>
                                    </div>
                                </div>
                            </div>
                        <?php endfor; ?>

                        <?php if (isset($data['info']['children']) && $data['info']['children'] > 0): ?>
                            <div class="section-title mt-4"><i class="fas fa-child"></i> Hành khách (Trẻ em, dưới 18 tuổi)</div>
                            <?php for($j = 1; $j <= $data['info']['children']; $j++): ?>
                                <div class="p-3 bg-light rounded-3 mb-3 border passenger-card">
                                    <h6 class="fw-bold mb-3 text-info">Trẻ em <?= $j ?></h6>
                                    <div class="row g-2">
                                        <div class="col-md-4">
                                            <label class="form-label small fw-bold">Họ (vd: Nguyễn) *</label>
                                            <input type="text" class="form-control pax-last-name" name="children[<?= $j ?>][last_name]" required>
                                        </div>
                                        <div class="col-md-8">
                                            <label class="form-label small fw-bold">Tên & Tên đệm *</label>
                                            <input type="text" class="form-control pax-first-name" name="children[<?= $j ?>][first_name]" required>
                                        </div>
                                    </div>
                                </div>
                            <?php endfor; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- ================= BƯỚC 2: TIỆN ÍCH ================= -->
                <div id="step-2-content" style="display: none;">
                    <div class="checkout-section bg-light border-0">
                        <div class="section-title mb-1"><i class="fas fa-star text-warning"></i> Tiện ích bổ sung</div>
                        
                        <div class="bg-white p-4 rounded-3 border mt-3 shadow-sm">
                            <h5 class="fw-bold mb-1">Nâng cấp mức hỗ trợ của quý khách</h5>
                            <p class="text-muted small mb-4">Lựa chọn gói hỗ trợ cao cấp để được ưu tiên xử lý khi có sự cố.</p>
                            
                            <div class="upgrade-container">
                                <!-- Cơ bản -->
                                <label class="upgrade-card selected" id="card-tier-basic">
                                    <input type="radio" class="tier-radio" name="support_tier" value="0" data-name="Cơ bản" checked onchange="updateTier(this)">
                                    <div class="upgrade-title">Cơ bản</div>
                                    <div class="upgrade-price">0 đ</div>
                                    <div class="upgrade-feature"><i class="fas fa-check text-success"></i> Hỗ trợ chuẩn</div>
                                    <div class="upgrade-feature text-muted"><i class="fas fa-times text-secondary"></i> Không hỗ trợ ưu tiên</div>
                                    <div class="btn-select-tier mt-4">Đã chọn</div>
                                </label>
                                <!-- Cộng -->
                                <label class="upgrade-card" id="card-tier-plus">
                                    <input type="radio" class="tier-radio" name="support_tier" value="237217" data-name="Gói Cộng" onchange="updateTier(this)">
                                    <div class="upgrade-title">Cộng</div>
                                    <div class="upgrade-price">237.217 đ</div>
                                    <div class="upgrade-feature"><i class="fas fa-check text-success"></i> Hỗ trợ 24/7</div>
                                    <div class="upgrade-feature"><i class="fas fa-times text-secondary"></i> Không ưu tiên</div>
                                    <div class="btn-select-tier mt-4">Chọn</div>
                                </label>
                                <!-- Cao cấp -->
                                <label class="upgrade-card" id="card-tier-premium" style="border-color: #c3e6cb;">
                                    <div class="badge-popular"><i class="fas fa-thumbs-up me-1"></i> Phổ biến</div>
                                    <input type="radio" class="tier-radio" name="support_tier" value="527148" data-name="Gói Cao Cấp" onchange="updateTier(this)">
                                    <div class="upgrade-title">Cao cấp</div>
                                    <div class="upgrade-price">527.148 đ</div>
                                    <div class="upgrade-feature"><i class="fas fa-check text-success"></i> Hỗ trợ 24/7</div>
                                    <div class="upgrade-feature"><i class="fas fa-check text-success"></i> Hỗ trợ ưu tiên</div>
                                    <div class="btn-select-tier mt-4">Chọn</div>
                                </label>
                            </div>
                        </div>

                        <!-- Bảo vệ hành lý -->
                        <label class="baggage-protection w-100 mt-4 shadow-sm" style="cursor: pointer;">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="baggage_protection" id="baggageCheck" value="150000" style="width: 20px; height: 20px;" onchange="calculateTotal()">
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <h6 class="fw-bold mb-1">Bảo vệ hành lý thất lạc <span class="text-danger float-end fw-bold">+150.000 đ</span></h6>
                                <div class="text-muted small mt-2">
                                    <p class="mb-1"><i class="fas fa-check text-success me-1"></i> Theo dõi và đẩy nhanh hoàn trả mọi hành lý ký gửi bị thất lạc.</p>
                                    <p class="mb-0"><i class="fas fa-check text-success me-1"></i> Nhận 1,000 USD mỗi kiện nếu hành lý chưa đến trong vòng 96 giờ.</p>
                                </div>
                            </div>
                            <i class="fas fa-shield-alt fa-3x text-success opacity-25"></i>
                        </label>

                        <!-- Chọn trước chỗ ngồi (Seat Upgrade) -->
                        <div class="bg-white p-4 rounded-3 border mt-4 shadow-sm">
                            <h5 class="fw-bold mb-1">Nâng hạng ghế (Tận hưởng chuyến bay theo cách riêng)</h5>
                            <p class="text-muted small mb-4">Lựa chọn vị trí ngồi thoải mái nhất cho chuyến hành trình của bạn.</p>
                            
                            <div class="upgrade-container">
                                <!-- Ghế tiêu chuẩn -->
                                <label class="upgrade-card selected" id="card-seat-basic">
                                    <input type="radio" style="display: none;" name="seat_upgrade" value="0" data-name="Ghế tiêu chuẩn" checked onchange="updateSeat(this)">
                                    <div class="upgrade-title">Tiêu chuẩn</div>
                                    <div class="upgrade-price">0 đ</div>
                                    <div class="upgrade-feature"><i class="fas fa-check text-success"></i> Khoảng cách ghế 79cm</div>
                                    <div class="upgrade-feature text-muted"><i class="fas fa-check text-success"></i> Tự động khi check-in</div>
                                    <div class="btn-select-tier mt-4 btn-select-seat">Đã chọn</div>
                                </label>
                                <!-- Ghế ưu tiên -->
                                <label class="upgrade-card" id="card-seat-priority">
                                    <input type="radio" style="display: none;" name="seat_upgrade" value="150000" data-name="Ghế ưu tiên" onchange="updateSeat(this)">
                                    <div class="upgrade-title">Ưu tiên</div>
                                    <div class="upgrade-price">150.000 đ</div>
                                    <div class="upgrade-feature"><i class="fas fa-check text-success"></i> Vị trí gần phía trước cabin</div>
                                    <div class="upgrade-feature"><i class="fas fa-check text-success"></i> Ra máy bay nhanh hơn</div>
                                    <div class="btn-select-tier mt-4 btn-select-seat">Chọn</div>
                                </label>
                                <!-- Ghế hàng đầu -->
                                <label class="upgrade-card" id="card-seat-front" style="border-color: #c3e6cb;">
                                    <div class="badge-popular"><i class="fas fa-star me-1"></i> Vip</div>
                                    <input type="radio" style="display: none;" name="seat_upgrade" value="350000" data-name="Ghế hàng đầu" onchange="updateSeat(this)">
                                    <div class="upgrade-title">Hàng đầu</div>
                                    <div class="upgrade-price">350.000 đ</div>
                                    <div class="upgrade-feature"><i class="fas fa-check text-success"></i> Không gian để chân tăng 50%</div>
                                    <div class="upgrade-feature"><i class="fas fa-check text-success"></i> Ưu tiên phục vụ đồ uống</div>
                                    <div class="btn-select-tier mt-4 btn-select-seat">Chọn</div>
                                </label>
                            </div>
                        </div>

                        <!-- Bảo hiểm Du lịch -->
                        <div class="bg-white p-4 rounded-3 border mt-4 shadow-sm">
                            <h5 class="fw-bold mb-1">Các Gói Bảo Hiểm Du Lịch</h5>
                            <p class="text-muted small mb-4">Lựa chọn gói bảo vệ phù hợp với nhu cầu của chuyến đi.</p>
                            
                            <div class="upgrade-container">
                                <!-- Không bảo hiểm -->
                                <label class="upgrade-card selected" id="card-ins-none">
                                    <input type="radio" style="display: none;" name="insurance" value="0" data-name="Không bảo hiểm" onchange="updateInsurance(this)" checked>
                                    <div class="upgrade-title">Không bảo hiểm</div>
                                    <div class="upgrade-price">0 đ</div>
                                    <div class="upgrade-feature"><i class="fas fa-times text-secondary"></i> Tự chịu rủi ro chuyến đi</div>
                                    <div class="btn-select-tier mt-4 btn-select-ins">Đã chọn</div>
                                </label>
                                <!-- Trễ chuyến bay -->
                                <label class="upgrade-card" id="card-ins-delay">
                                    <input type="radio" style="display: none;" name="insurance" value="49000" data-name="Trễ chuyến bay" onchange="updateInsurance(this)">
                                    <div class="upgrade-title">Trễ chuyến bay</div>
                                    <div class="upgrade-price">49.000 đ</div>
                                    <div class="upgrade-feature"><i class="fas fa-check text-success"></i> Bồi thường 1tr5</div>
                                    <div class="upgrade-feature"><i class="fas fa-check text-success"></i> Hỗ trợ ăn ở</div>
                                    <div class="btn-select-tier mt-4 btn-select-ins">Chọn</div>
                                </label>
                                <!-- An tâm hành lý -->
                                <label class="upgrade-card" id="card-ins-baggage" style="border-color: #c3e6cb;">
                                    <div class="badge-popular"><i class="fas fa-thumbs-up me-1"></i> Phổ biến</div>
                                    <input type="radio" style="display: none;" name="insurance" value="89000" data-name="An Tâm Hành Lý" onchange="updateInsurance(this)">
                                    <div class="upgrade-title">An Tâm Hành Lý</div>
                                    <div class="upgrade-price">89.000 đ</div>
                                    <div class="upgrade-feature"><i class="fas fa-check text-success"></i> Bồi thường đến 15tr</div>
                                    <div class="btn-select-tier mt-4 btn-select-ins">Chọn</div>
                                </label>
                                <!-- Y tế toàn diện -->
                                <label class="upgrade-card" id="card-ins-medical">
                                    <input type="radio" style="display: none;" name="insurance" value="199000" data-name="Y Tế Toàn Diện" onchange="updateInsurance(this)">
                                    <div class="upgrade-title">Y Tế Toàn Diện</div>
                                    <div class="upgrade-price">199.000 đ</div>
                                    <div class="upgrade-feature"><i class="fas fa-check text-success"></i> Y tế đến 2 Tỷ</div>
                                    <div class="upgrade-feature"><i class="fas fa-check text-success"></i> Bao gồm tất cả</div>
                                    <div class="btn-select-tier mt-4 btn-select-ins">Chọn</div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- TÓM TẮT CHI PHÍ (CỘT PHẢI / ĐÁY MOBILE) -->
        <div class="col-lg-4">
            <div class="price-summary-box">
                <button class="btn-toggle-summary" onclick="toggleMobileSummary()">
                    <i class="fas fa-chevron-up me-1" id="icon-toggle-summary"></i> Xem chi tiết đơn hàng
                </button>
                
                <div class="summary-details" id="summary-details">
                    <h5 class="fw-bold mb-4 d-none d-lg-block" style="color: #0071c2;">Chi tiết giá</h5>
                    
                    <div class="summary-row">
                        <span>Hành khách (<?= $data['info']['adults'] ?> Người lớn<?= (isset($data['info']['children']) && $data['info']['children'] > 0) ? ', ' . $data['info']['children'] . ' Trẻ em' : '' ?>)</span>
                        <span class="fw-bold"><?= number_format($data['info']['total_price'], 0, ',', '.') ?> đ</span>
                    </div>
                    
                    <?php if (isset($data['info']['discount_amount']) && $data['info']['discount_amount'] > 0): ?>
                    <div class="summary-row text-success border-bottom pb-2 mb-3">
                        <span><i class="fas fa-tag me-1"></i> <?= $data['info']['promo_name'] ?></span>
                        <span class="fw-bold">-<?= number_format($data['info']['discount_amount'], 0, ',', '.') ?> đ</span>
                    </div>
                    <div class="summary-row">
                        <span>Thành tiền sau giảm</span>
                        <span class="fw-bold" id="displayBasePrice"><?= number_format($data['info']['final_price'], 0, ',', '.') ?> đ</span>
                    </div>
                    <?php endif; ?>
                    
                    <div class="summary-row text-primary" id="rowSupportTier" style="display: none;">
                        <span id="nameSupportTier">Gói hỗ trợ</span>
                        <span class="fw-bold" id="priceSupportTier">0 đ</span>
                    </div>

                    <div class="summary-row text-primary" id="rowSeatUpgrade" style="display: none;">
                        <span id="nameSeatUpgrade">Nâng hạng ghế</span>
                        <span class="fw-bold" id="priceSeatUpgrade">0 đ</span>
                    </div>

                    <div class="summary-row text-primary" id="rowInsurance" style="display: none;">
                        <span id="nameInsurance">Bảo hiểm</span>
                        <span class="fw-bold" id="priceInsurance">0 đ</span>
                    </div>
                    
                    <div class="summary-row text-primary" id="rowBaggage" style="display: none;">
                        <span>Bảo vệ hành lý</span>
                        <span class="fw-bold">+150.000 đ</span>
                    </div>

                    <div class="summary-row text-success">
                        <span>Thuế và phí</span>
                        <span>Đã bao gồm</span>
                    </div>
                </div>
                
                <div class="total-row">
                    <h5 class="fw-bold mb-0 text-dark">Tổng cộng</h5>
                    <h3 class="fw-bold text-danger mb-0" id="displayTotalPrice"><?= number_format($data['info']['final_price'] ?? $data['info']['total_price'], 0, ',', '.') ?> đ</h3>
                </div>
                
                <div class="mt-3">
                    <!-- Nút Bước 1 -->
                    <button type="button" class="btn-pay" id="btnNextStep" onclick="goToStep2()">
                        <span class="btn-text-content">TIẾP TỤC CHỌN TIỆN ÍCH <i class="fas fa-arrow-right ms-2"></i></span>
                    </button>
                    <!-- Nút Bước 2 (Submit) -->
                    <button type="submit" form="checkoutForm" class="btn-pay" id="btnSubmitForm" style="display: none;">
                        <span class="spinner-border text-light"></span>
                        <span class="btn-text-content"><i class="fas fa-lock me-2"></i> THANH TOÁN AN TOÀN</span>
                    </button>
                    
                    <!-- Trust Signals -->
                    <p class="text-center text-success small mt-3 fw-bold mb-2"><i class="fas fa-shield-alt me-1"></i> MÃ HÓA BẢO MẬT 256-BIT SSL</p>
                    <div class="trust-signals">
                        <i class="fab fa-cc-visa fa-2x text-muted"></i>
                        <i class="fab fa-cc-mastercard fa-2x text-muted"></i>
                        <i class="fab fa-cc-jcb fa-2x text-muted"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // ================= XỬ LÝ MULTI-STEP =================
    function goToStep2() {
        // Validate form HTML5 trước khi qua bước 2
        const form = document.getElementById('checkoutForm');
        if (!form.reportValidity()) {
            return; // Dừng lại nếu form chưa điền đủ
        }

        // Ẩn Bước 1, Hiện Bước 2
        document.getElementById('step-1-content').style.display = 'none';
        document.getElementById('step-2-content').style.display = 'block';
        
        // Cập nhật Progress Bar
        document.getElementById('indicator-step1').classList.add('completed');
        document.getElementById('indicator-step1').classList.remove('active');
        document.getElementById('indicator-step2').classList.add('active');
        document.getElementById('progress-bar-fill').style.width = '75%';

        // Đổi nút bấm ở cột phải
        document.getElementById('btnNextStep').style.display = 'none';
        document.getElementById('btnSubmitForm').style.display = 'flex';
        
        // Scroll lên đầu trang (UX mượt mà)
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // ================= XỬ LÝ NÚT THANH TOÁN (Anti-double click) =================
    function handleFormSubmit(e) {
        const btn = document.getElementById('btnSubmitForm');
        // Thêm class loading để vô hiệu hóa và xoay spinner
        btn.classList.add('loading');
        btn.setAttribute('disabled', 'true');
        return true; // Cho phép form submit
    }

    // ================= AUTOFILL TÊN =================
    function autoFillFirstPassenger() {
        const isChecked = document.getElementById('autofillPassenger').checked;
        if(isChecked) {
            const fullName = document.getElementById('contact_name').value.trim();
            if(fullName) {
                // Tách họ và tên đơn giản (lấy chữ đầu làm họ, còn lại là tên đệm + tên)
                const parts = fullName.split(' ');
                let lastName = parts[0];
                let firstName = parts.length > 1 ? parts.slice(1).join(' ') : '';
                
                document.getElementById('pax_last_1').value = lastName;
                document.getElementById('pax_first_1').value = firstName;
            }
        } else {
            // Xóa đi nếu bỏ tick
            document.getElementById('pax_last_1').value = '';
            document.getElementById('pax_first_1').value = '';
        }
    }

    // ================= TÍNH TOÁN TIỆN ÍCH =================
    const basePrice = <?= $data['info']['final_price'] ?? $data['info']['total_price'] ?>;
    
    function updateTier(radioElement) {
        document.querySelectorAll('.upgrade-card').forEach(card => {
            card.classList.remove('selected');
            card.querySelector('.btn-select-tier').innerText = 'Chọn';
        });
        
        const parentCard = radioElement.closest('.upgrade-card');
        parentCard.classList.add('selected');
        parentCard.querySelector('.btn-select-tier').innerText = 'Đã chọn';
        
        calculateTotal();
    }

    function updateSeat(radioElement) {
        document.querySelectorAll('input[name="seat_upgrade"]').forEach(el => {
            const card = el.closest('.upgrade-card');
            card.classList.remove('selected');
            card.querySelector('.btn-select-seat').innerText = 'Chọn';
        });
        
        const parentCard = radioElement.closest('.upgrade-card');
        parentCard.classList.add('selected');
        parentCard.querySelector('.btn-select-seat').innerText = 'Đã chọn';
        
        calculateTotal();
    }

    function updateInsurance(radioElement) {
        document.querySelectorAll('input[name="insurance"]').forEach(el => {
            const card = el.closest('.upgrade-card');
            card.classList.remove('selected');
            card.querySelector('.btn-select-ins').innerText = 'Chọn';
        });
        
        const parentCard = radioElement.closest('.upgrade-card');
        parentCard.classList.add('selected');
        parentCard.querySelector('.btn-select-ins').innerText = 'Đã chọn';
        
        calculateTotal();
    }

    function calculateTotal() {
        const selectedTier = document.querySelector('input[name="support_tier"]:checked');
        const tierPrice = parseInt(selectedTier.value);
        const tierName = selectedTier.getAttribute('data-name');
        
        const selectedSeat = document.querySelector('input[name="seat_upgrade"]:checked');
        const seatPrice = parseInt(selectedSeat.value);
        const seatName = selectedSeat.getAttribute('data-name');
        
        const selectedIns = document.querySelector('input[name="insurance"]:checked');
        const insPrice = parseInt(selectedIns.value);
        const insName = selectedIns.getAttribute('data-name');

        const isBaggageChecked = document.getElementById('baggageCheck').checked;
        const baggagePrice = isBaggageChecked ? 150000 : 0;
        
        const finalPrice = basePrice + tierPrice + seatPrice + insPrice + baggagePrice;
        const formatter = new Intl.NumberFormat('vi-VN');
        
        document.getElementById('finalPriceInput').value = finalPrice;
        document.getElementById('displayTotalPrice').innerText = formatter.format(finalPrice) + ' đ';
        
        const rowTier = document.getElementById('rowSupportTier');
        if (tierPrice > 0) {
            rowTier.style.display = 'flex';
            document.getElementById('nameSupportTier').innerText = 'Hỗ trợ: ' + tierName;
            document.getElementById('priceSupportTier').innerText = '+' + formatter.format(tierPrice) + ' đ';
        } else {
            rowTier.style.display = 'none';
        }

        const rowSeat = document.getElementById('rowSeatUpgrade');
        if (seatPrice > 0) {
            rowSeat.style.display = 'flex';
            document.getElementById('nameSeatUpgrade').innerText = 'Ghế: ' + seatName;
            document.getElementById('priceSeatUpgrade').innerText = '+' + formatter.format(seatPrice) + ' đ';
        } else {
            rowSeat.style.display = 'none';
        }

        const rowIns = document.getElementById('rowInsurance');
        if (insPrice > 0) {
            rowIns.style.display = 'flex';
            document.getElementById('nameInsurance').innerText = 'Bảo hiểm: ' + insName;
            document.getElementById('priceInsurance').innerText = '+' + formatter.format(insPrice) + ' đ';
        } else {
            rowIns.style.display = 'none';
        }
        
        document.getElementById('rowBaggage').style.display = isBaggageChecked ? 'flex' : 'none';
    }

    // ================= MOBILE TOGGLE SUMMARY =================
    function toggleMobileSummary() {
        const details = document.getElementById('summary-details');
        const icon = document.getElementById('icon-toggle-summary');
        details.classList.toggle('show');
        if(details.classList.contains('show')){
            icon.classList.replace('fa-chevron-up', 'fa-chevron-down');
        } else {
            icon.classList.replace('fa-chevron-down', 'fa-chevron-up');
        }
    }
</script>

<?php require_once '../app/Views/layouts/footer.php'; ?>