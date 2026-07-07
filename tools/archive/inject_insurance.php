<?php
$content = file_get_contents('c:\\xampp\\htdocs\\skyline_ticket\\app\\Views\\booking\\checkout.php');

$searchHtml = <<<EOD
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
EOD;

$replaceHtml = <<<EOD
                    <!-- BẢO HIỂM CHUYẾN ĐI -->
                    <div class="bg-white p-4 rounded-4 border mt-4 shadow-sm" style="border-color: #e0f2f1 !important;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold mb-0" style="color: #005e6a;"><i class="fas fa-shield-alt text-success me-2"></i>Bảo hiểm Chuyến đi Toàn diện</h5>
                            <button type="button" class="btn btn-link text-decoration-none p-0 fw-bold" style="font-size: 13px;" data-bs-toggle="modal" data-bs-target="#insuranceModal">Xem chi tiết quyền lợi</button>
                        </div>
                        <p class="text-muted small mb-4">Du lịch an tâm hơn với các gói bảo hiểm được thiết kế riêng cho bạn. Chỉ cần bật công tắc để thêm vào vé.</p>
                        
                        <!-- Toggle 1: Trễ chuyến / Mất hành lý -->
                        <div class="d-flex align-items-center justify-content-between p-3 mb-3 bg-light rounded-3 border custom-switch-wrapper transition hover-shadow">
                            <div class="d-flex align-items-center">
                                <div class="bg-white p-2 rounded-circle shadow-sm me-3"><i class="fas fa-suitcase-rolling text-warning fa-lg"></i></div>
                                <div>
                                    <h6 class="fw-bold mb-1">Trễ chuyến & Mất hành lý</h6>
                                    <span class="text-muted" style="font-size: 12px;">Bồi thường lên đến 10.000.000đ</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="fw-bold text-danger me-3">+150.000 đ</span>
                                <div class="form-check form-switch fs-4 mb-0">
                                    <input class="form-check-input ins-toggle" type="checkbox" role="switch" name="ins_baggage" value="150000" data-name="Bảo hiểm hành lý" onchange="calculateTotal()">
                                </div>
                            </div>
                        </div>

                        <!-- Toggle 2: Y tế du lịch -->
                        <div class="d-flex align-items-center justify-content-between p-3 mb-3 bg-light rounded-3 border custom-switch-wrapper transition hover-shadow">
                            <div class="d-flex align-items-center">
                                <div class="bg-white p-2 rounded-circle shadow-sm me-3"><i class="fas fa-briefcase-medical text-danger fa-lg"></i></div>
                                <div>
                                    <h6 class="fw-bold mb-1">Y tế Du lịch Cơ bản</h6>
                                    <span class="text-muted" style="font-size: 12px;">Bảo lãnh viện phí toàn cầu</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="fw-bold text-danger me-3">+250.000 đ</span>
                                <div class="form-check form-switch fs-4 mb-0">
                                    <input class="form-check-input ins-toggle" type="checkbox" role="switch" name="ins_medical" value="250000" data-name="Bảo hiểm y tế" onchange="calculateTotal()">
                                </div>
                            </div>
                        </div>

                        <!-- Toggle 3: OSHC -->
                        <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded-3 border custom-switch-wrapper transition hover-shadow">
                            <div class="d-flex align-items-center">
                                <div class="bg-white p-2 rounded-circle shadow-sm me-3"><i class="fas fa-graduation-cap text-primary fa-lg"></i></div>
                                <div>
                                    <h6 class="fw-bold mb-1">Sinh viên Quốc tế (OSHC)</h6>
                                    <span class="text-muted" style="font-size: 12px;">Bắt buộc đối với Visa Du học sinh Úc</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="fw-bold text-danger me-3">+1.500.000 đ</span>
                                <div class="form-check form-switch fs-4 mb-0">
                                    <input class="form-check-input ins-toggle" type="checkbox" role="switch" name="ins_oshc" value="1500000" data-name="Bảo hiểm OSHC" onchange="calculateTotal()">
                                </div>
                            </div>
                        </div>
                    </div>
EOD;

$content = str_replace($searchHtml, $replaceHtml, $content);

$searchJs = <<<EOD
        // Lấy giá trị Bảo vệ hành lý
        const isBaggageChecked = document.getElementById('baggageCheck').checked;
        const baggagePrice = isBaggageChecked ? 150000 : 0;
        
        // Tính tổng
        const finalPrice = basePrice + tierPrice + baggagePrice + seatPrice;
EOD;

$replaceJs = <<<EOD
        // Lấy giá trị các gói Bảo hiểm
        let insPriceTotal = 0;
        let insDetailsHTML = '';
        document.querySelectorAll('.ins-toggle:checked').forEach(checkbox => {
            const price = parseInt(checkbox.value);
            const name = checkbox.getAttribute('data-name');
            insPriceTotal += price;
            
            insDetailsHTML += `
                <div class="summary-row text-success mb-1">
                    <span>\${name}</span>
                    <span class="fw-bold">+\${new Intl.NumberFormat('vi-VN').format(price)} đ</span>
                </div>
            `;
        });
        
        // Tính tổng
        const finalPrice = basePrice + tierPrice + seatPrice + insPriceTotal;
EOD;

$content = str_replace($searchJs, $replaceJs, $content);

$searchSummaryHtml = <<<EOD
                <div class="summary-row text-primary" id="rowBaggage" style="display: none;">
                    <span>Bảo vệ hành lý</span>
                    <span class="fw-bold">+150.000 đ</span>
                </div>
EOD;

$replaceSummaryHtml = <<<EOD
                <div id="insSummaryContainer"></div>
EOD;
$content = str_replace($searchSummaryHtml, $replaceSummaryHtml, $content);

$searchJs2 = <<<EOD
        // Hiển thị dòng Hành lý nếu có tick
        document.getElementById('rowBaggage').style.display = isBaggageChecked ? 'flex' : 'none';
EOD;
$replaceJs2 = <<<EOD
        // Hiển thị danh sách các bảo hiểm đã chọn
        document.getElementById('insSummaryContainer').innerHTML = insDetailsHTML;
EOD;
$content = str_replace($searchJs2, $replaceJs2, $content);

// Thêm CSS cho Switch
$cssAdd = <<<EOD
    <style>
        .custom-switch-wrapper:hover {
            border-color: #005e6a !important;
        }
        .ins-toggle:checked {
            background-color: #2ecc71;
            border-color: #2ecc71;
        }
    </style>
EOD;
$content = str_replace('<!-- TÓM TẮT CHI PHÍ (CỘT PHẢI) -->', $cssAdd . "\n<!-- TÓM TẮT CHI PHÍ (CỘT PHẢI) -->", $content);


$modalHtml = <<<EOD
    <!-- Insurance Details Modal -->
    <div class="modal fade" id="insuranceModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content border-0 rounded-4 shadow-lg">
                <div class="modal-header bg-light text-dark rounded-top-4 border-0 p-3">
                    <h5 class="modal-title fw-bold fs-6"><i class="fas fa-shield-alt text-success me-2"></i>Quyền lợi Bảo hiểm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 text-start">
                    <h6 class="fw-bold text-primary mb-2">1. Trễ chuyến & Mất hành lý</h6>
                    <ul class="text-muted small mb-4">
                        <li>Bồi thường chuyến bay chậm trễ trên 4 tiếng: Tối đa 2.000.000đ.</li>
                        <li>Trợ cấp hành lý thất lạc/hư hỏng: Lên đến 10.000.000đ.</li>
                        <li>Được ưu tiên xử lý hồ sơ claim trong 24h.</li>
                    </ul>
                    
                    <h6 class="fw-bold text-danger mb-2">2. Y tế Du lịch Cơ bản</h6>
                    <ul class="text-muted small mb-4">
                        <li>Bảo lãnh viện phí nội trú và ngoại trú toàn cầu lên đến 500 triệu đồng.</li>
                        <li>Vận chuyển y tế khẩn cấp miễn phí.</li>
                        <li>Hỗ trợ người thân thăm viếng nếu nằm viện quá 5 ngày.</li>
                    </ul>

                    <h6 class="fw-bold text-success mb-2">3. Sinh viên Quốc tế (OSHC)</h6>
                    <ul class="text-muted small mb-0">
                        <li>Đáp ứng 100% yêu cầu về Thị thực (Visa) Du học sinh của Úc.</li>
                        <li>Chi trả 100% chi phí khám chữa bệnh Medicare (MBS).</li>
                        <li>Bao gồm xe cứu thương và 100% chi phí giường bệnh viện công.</li>
                    </ul>
                </div>
                <div class="modal-footer bg-light border-0">
                    <button class="btn btn-primary w-100 fw-bold rounded-pill" data-bs-dismiss="modal">ĐÃ HIỂU</button>
                </div>
            </div>
        </div>
    </div>
</body>
EOD;
$content = str_replace('</body>', $modalHtml, $content);


file_put_contents('c:\\xampp\\htdocs\\skyline_ticket\\app\\Views\\booking\\checkout.php', $content);
echo "Insurance updated in checkout.php";
