<?php
$content = file_get_contents('c:\\xampp\\htdocs\\skyline_ticket\\app\\Views\\home\\index.php');

// 1. Inject CSS
$cssAdd = <<<EOD
    /* Cross Selling UI */
    .btn-service {
        background: #f8f9fa; border: 1px solid #e9ecef; border-radius: 20px;
        padding: 6px 15px; font-size: 13px; font-weight: 600; color: #495057;
        transition: 0.3s; box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }
    .btn-service:hover { background: #fff; transform: translateY(-2px); box-shadow: 0 4px 8px rgba(0,0,0,0.08); border-color: #dee2e6; }
    .btn-service i { margin-right: 5px; font-size: 14px; }
    
    .cs-card {
        min-width: 220px; max-width: 220px; border-radius: 12px; overflow: hidden;
        border: 1px solid #eee; background: #fff; box-shadow: 0 4px 10px rgba(0,0,0,0.03);
        flex: 0 0 auto; cursor: pointer; transition: 0.3s;
    }
    .cs-card:hover { transform: translateY(-4px); box-shadow: 0 8px 20px rgba(0,0,0,0.1); border-color: #ddd; }
    .cs-card img { width: 100%; height: 120px; object-fit: cover; }
    .cs-card h6 { font-size: 13px; font-weight: 700; margin-bottom: 4px; color: #2c3e50; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .cs-card small { font-size: 11px; color: #7f8c8d; display: block; margin-bottom: 10px; line-height: 1.3; }
    .cs-card .price { font-size: 14px; font-weight: 800; color: #e74c3c; }
EOD;
$content = str_replace('</style>', $cssAdd . "\n</style>", $content);


// 2. Inject HTML Service Bar
$searchFormEnd = <<<EOD
                                <button type="submit" class="btn btn-search px-5 py-3 fs-5">
                                    TÌM CHUYẾN BAY <i class="fas fa-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </form>
EOD;

$serviceBarHtml = <<<EOD
                                <button type="submit" class="btn btn-search px-5 py-3 fs-5">
                                    TÌM CHUYẾN BAY <i class="fas fa-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- CROSS-SELLING ECOSYSTEM -->
                    <div class="mt-4 pt-4 border-top cross-selling-wrapper">
                        <h6 class="fw-bold text-muted mb-3" style="font-size: 13px; text-transform: uppercase;"><i class="fas fa-star text-warning me-1"></i> Tối ưu chuyến đi của bạn</h6>
                        <div class="d-flex flex-wrap gap-2 service-pills">
                            <button type="button" class="btn-service" onclick="toggleContextualServices()"><i class="fas fa-hotel text-primary"></i> Khách sạn & Tour</button>
                            <button type="button" class="btn-service" data-bs-toggle="offcanvas" data-bs-target="#dutyFreeOffcanvas"><i class="fas fa-shopping-bag text-danger"></i> Mua sắm Miễn Thuế</button>
                            <button type="button" class="btn-service" data-bs-toggle="modal" data-bs-target="#checklistModal"><i class="fas fa-clipboard-check text-success"></i> Trợ lý Nhắc nhở</button>
                            <button type="button" class="btn-service"><i class="fas fa-wifi text-info"></i> eSIM Quốc tế</button>
                            <button type="button" class="btn-service"><i class="fas fa-car text-warning"></i> Đưa đón Sân bay</button>
                        </div>

                        <!-- KHU VỰC GỢI Ý KHÁCH SẠN & TOUR (Ẩn mặc định, hiện khi bấm) -->
                        <div id="contextualServices" class="mt-4 p-3 rounded-4" style="display: none; background: #f8fbfa; border: 1px dashed #b2bec3;">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h5 class="fw-bold mb-1" style="color: #005e6a;">Gợi ý dành riêng cho hành trình đến <span id="csDestName" class="text-danger">Melbourne</span></h5>
                                    <p class="text-muted small mb-0"><i class="fas fa-tag text-warning"></i> Đặt kèm để giảm thêm <strong>15% giá vé máy bay</strong>!</p>
                                </div>
                                <button class="btn btn-sm btn-close" onclick="toggleContextualServices()"></button>
                            </div>
                            <div class="cs-carousel-container">
                                <!-- Cards will be injected by JS -->
                                <div class="d-flex gap-3 overflow-auto pb-3 pt-1 px-1" id="csCardWrapper" style="scrollbar-width: thin;"></div>
                            </div>
                        </div>
                    </div>
EOD;
$content = str_replace($searchFormEnd, $serviceBarHtml, $content);


// 3. Inject JS Logic
$jsLogic = <<<EOD
        // ================= LOGIC CROSS-SELLING (HOTELS & TOURS) =================
        const csMockData = {
            'MEL': [
                { type: 'hotel', title: 'Ký túc xá UniLodge', desc: 'Căn hộ sinh viên cao cấp sát ĐH Melbourne.', price: 'Từ $45/đêm', img: 'https://images.unsplash.com/photo-1555854877-bab0e564b8d5?auto=format&fit=crop&w=300&q=80' },
                { type: 'hotel', title: 'Homestay St Kilda', desc: 'Trải nghiệm văn hóa bản địa, gần biển.', price: 'Từ $60/đêm', img: 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=300&q=80' },
                { type: 'tour', title: 'Tour Great Ocean Road', desc: 'Khám phá thiên nhiên kỳ vĩ, ngắm 12 vị tông đồ.', price: 'Từ $85', img: 'https://images.unsplash.com/photo-1514801198595-53896dfaebc1?auto=format&fit=crop&w=300&q=80' },
                { type: 'tour', title: 'Vé tàu Puffing Billy', desc: 'Hành trình xuyên rừng trên tàu hơi nước cổ kính.', price: 'Từ $35', img: 'https://images.unsplash.com/photo-1523419137599-47fdf3174eb6?auto=format&fit=crop&w=300&q=80' }
            ],
            'DAD': [
                { type: 'hotel', title: 'Resort Biển Mỹ Khê', desc: 'Bãi biển lọt top thế giới, view siêu đẹp.', price: 'Từ 850k/đêm', img: 'https://images.unsplash.com/photo-1563911302283-d2bc129e7570?auto=format&fit=crop&w=300&q=80' },
                { type: 'tour', title: 'Cáp treo Bà Nà Hills', desc: 'Trải nghiệm Làng Pháp và Cầu Vàng.', price: 'Từ 900k', img: 'https://images.unsplash.com/photo-1588656602075-e9cc5c4c3445?auto=format&fit=crop&w=300&q=80' }
            ],
            'DEFAULT': [
                { type: 'hotel', title: 'Khách sạn Trung tâm', desc: 'Tiện lợi di chuyển, ngắm phố phường.', price: 'Từ 500k/đêm', img: 'https://images.unsplash.com/photo-1566073171639-4d9f345cd320?auto=format&fit=crop&w=300&q=80' },
                { type: 'tour', title: 'City Tour trong ngày', desc: 'Khám phá các điểm check-in cực hot.', price: 'Từ 300k', img: 'https://images.unsplash.com/photo-1506012787146-f92b2d7d6d96?auto=format&fit=crop&w=300&q=80' }
            ]
        };

        function toggleContextualServices() {
            const csDiv = document.getElementById('contextualServices');
            if (csDiv.style.display === 'block') {
                csDiv.style.display = 'none';
                return;
            }
            
            const currentDestCode = document.getElementById('destCode').innerText;
            const currentDestName = document.getElementById('destName').innerText.split(',')[0];
            
            document.getElementById('csDestName').innerText = currentDestName;
            
            const data = csMockData[currentDestCode] || csMockData['DEFAULT'];
            let html = '';
            data.forEach(item => {
                const icon = item.type === 'hotel' ? '<i class="fas fa-bed text-primary me-1"></i>' : '<i class="fas fa-map-marked-alt text-success me-1"></i>';
                html += `
                    <div class="cs-card">
                        <img src="\${item.img}" alt="\${item.title}">
                        <div class="p-3">
                            <h6>\${icon} \${item.title}</h6>
                            <small>\${item.desc}</small>
                            <div class="d-flex justify-content-between align-items-center border-top pt-2 mt-1">
                                <span class="price">\${item.price}</span>
                                <button class="btn btn-sm btn-outline-primary py-1 px-2" style="font-size:11px; font-weight:700;">CHỌN</button>
                            </div>
                        </div>
                    </div>
                `;
            });
            document.getElementById('csCardWrapper').innerHTML = html;
            csDiv.style.display = 'block';
        }

EOD;
$content = str_replace('// ================= LOGIC ĐÁNH GIÁ KHÁCH HÀNG =================', $jsLogic . "\n        // ================= LOGIC ĐÁNH GIÁ KHÁCH HÀNG =================", $content);


// 4. Inject Modals and Offcanvas at the bottom of the body
$modalsHtml = <<<EOD
    <!-- Duty Free Offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="dutyFreeOffcanvas" style="width: 400px; z-index: 1055;">
        <div class="offcanvas-header bg-danger text-white">
            <h5 class="offcanvas-title fw-bold"><i class="fas fa-shopping-bag me-2"></i>Duty Free Pre-order</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="alert alert-info py-2 border-0 rounded-3 shadow-sm" style="font-size: 13px; background: #e3f2fd; color: #0d47a1;">
                <i class="fas fa-plane text-info me-2"></i><strong>Nhận hàng độc quyền:</strong> Tại cửa khởi hành hoặc tiếp viên giao trực tiếp tại ghế ngồi.
            </div>
            
            <h6 class="fw-bold mt-4 mb-3" style="color:#2c3e50;">Nước hoa & Mỹ phẩm</h6>
            <div class="d-flex align-items-center mb-3 p-2 border rounded-3 shadow-sm bg-white hover-shadow transition">
                <img src="https://images.unsplash.com/photo-1528701800487-ba01fea498c0?auto=format&fit=crop&w=80&q=80" style="width: 70px; height: 70px; object-fit: cover; border-radius: 8px;" class="me-3">
                <div class="flex-grow-1">
                    <h6 class="mb-1 fw-bold" style="font-size: 14px;">Chanel No.5 Eau De Parfum</h6>
                    <span class="text-danger fw-bold fs-5">$135.00</span> <small class="text-decoration-line-through text-muted ms-1">$150.00</small>
                </div>
                <button class="btn btn-outline-danger rounded-circle p-2" style="width:35px; height:35px; display:flex; align-items:center; justify-content:center;"><i class="fas fa-cart-plus"></i></button>
            </div>
            
            <h6 class="fw-bold mt-4 mb-3" style="color:#2c3e50;">Công nghệ (Miễn Thuế)</h6>
            <div class="d-flex align-items-center mb-3 p-2 border rounded-3 shadow-sm bg-white hover-shadow transition">
                <img src="https://images.unsplash.com/photo-1505156868547-9b49f4df4e04?auto=format&fit=crop&w=80&q=80" style="width: 70px; height: 70px; object-fit: cover; border-radius: 8px;" class="me-3">
                <div class="flex-grow-1">
                    <h6 class="mb-1 fw-bold" style="font-size: 14px;">Tai nghe Sony WH-1000XM5</h6>
                    <span class="text-danger fw-bold fs-5">$299.00</span> <small class="text-decoration-line-through text-muted ms-1">$350.00</small>
                </div>
                <button class="btn btn-outline-danger rounded-circle p-2" style="width:35px; height:35px; display:flex; align-items:center; justify-content:center;"><i class="fas fa-cart-plus"></i></button>
            </div>
            
            <hr class="my-4 text-muted">
            <h6 class="fw-bold mb-3" style="color:#2c3e50;"><i class="fas fa-truck-fast me-2 text-warning"></i> Tùy chọn nhận hàng</h6>
            <div class="form-check mb-2 custom-radio">
                <input class="form-check-input" type="radio" name="delivery" id="d1" checked>
                <label class="form-check-label fw-semibold" for="d1">Nhận tại Cửa khởi hành (Boarding Gate)</label>
            </div>
            <div class="form-check custom-radio">
                <input class="form-check-input" type="radio" name="delivery" id="d2">
                <label class="form-check-label fw-semibold" for="d2">Tiếp viên giao tại ghế ngồi (In-flight)</label>
            </div>
        </div>
        <div class="offcanvas-footer p-3 border-top bg-light">
            <button class="btn btn-danger w-100 fw-bold py-2 fs-6 shadow-sm rounded-pill">CHUYỂN VÀO GIỎ HÀNG <i class="fas fa-arrow-right ms-2"></i></button>
        </div>
    </div>

    <!-- Checklist Modal -->
    <div class="modal fade" id="checklistModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-0 rounded-4 shadow-lg">
                <div class="modal-header bg-success text-white rounded-top-4 border-0 p-3">
                    <h5 class="modal-title fw-bold fs-6"><i class="fas fa-clipboard-check me-2"></i>Trợ lý Nhắc nhở Chuyến bay</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-4">
                    <i class="fas fa-envelope-open-text text-success mb-3" style="font-size: 3rem;"></i>
                    <p class="mb-4 text-muted" style="font-size: 13px;">Đừng để quên hộ chiếu hay visa! Hệ thống sẽ gửi một checklist hành trang chi tiết vào email của bạn trước ngày bay 3 ngày.</p>
                    <input type="email" class="form-control mb-3 text-center rounded-pill bg-light border-success text-success fw-semibold" placeholder="Nhập email của bạn" value="user@example.com">
                    <div class="form-check text-start mb-3 d-flex justify-content-center">
                        <input class="form-check-input me-2" type="checkbox" id="checkRemind" checked>
                        <label class="form-check-label text-muted" for="checkRemind" style="font-size: 13px; font-weight: 500;">Bật nhắc nhở thông minh</label>
                    </div>
                    <button class="btn btn-success w-100 rounded-pill py-2 fw-bold shadow-sm" data-bs-dismiss="modal">KÍCH HOẠT NGAY</button>
                </div>
            </div>
        </div>
    </div>
EOD;

$content = str_replace('</body>', $modalsHtml . "\n</body>", $content);
file_put_contents('c:\\xampp\\htdocs\\skyline_ticket\\app\\Views\\home\\index.php', $content);
echo "Homepage cross-selling injected successfully!";
