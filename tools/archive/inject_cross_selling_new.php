<?php
$content = file_get_contents('c:\\xampp\\htdocs\\skyline_ticket\\app\\Views\\home\\index.php');

// 1. Inject CSS for Cross-Selling Cards and Modals
$cssAdd = <<<EOD
    /* Cross Selling UI */
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

// 2. Replace the Extra Services block with our updated one
$searchExtraServices = <<<EOD
            <!-- VNA STYLE EXTRA SERVICES -->
            <div class="extra-services">
                <a href="javascript:void(0)" class="service-item" id="baggageServiceItem">
                    <i class="fas fa-shopping-bag"></i>
                    <span><?= __('service_nav.baggage') ?></span>
                </a>
                <a href="javascript:void(0)" class="service-item" id="upgradeServiceItem">
                    <i class="fas fa-chair"></i>
                    <span><?= __('service_nav.upgrade') ?></span>
                </a>
                <a href="#" class="service-item">
                    <i class="fas fa-shopping-cart"></i>
                    <span><?= __('service_nav.shopping') ?></span>
                </a>
                <a href="#" class="service-item">
                    <i class="fas fa-building"></i>
                    <span><?= __('service_nav.hotel_tour') ?></span>
                </a>
                <a href="#" class="service-item">
                    <i class="fas fa-heartbeat"></i>
                    <span><?= __('service_nav.insurance') ?></span>
                </a>
                <a href="#" class="service-item">
                    <i class="fas fa-ellipsis-h"></i>
                    <span><?= __('service_nav.others') ?></span>
                </a>
            </div>
EOD;

$replaceExtraServices = <<<EOD
            <!-- VNA STYLE EXTRA SERVICES -->
            <div class="extra-services">
                <a href="javascript:void(0)" class="service-item" id="baggageServiceItem">
                    <i class="fas fa-shopping-bag text-secondary"></i>
                    <span><?= __('service_nav.baggage') ?></span>
                </a>
                <a href="javascript:void(0)" class="service-item" id="upgradeServiceItem">
                    <i class="fas fa-chair text-secondary"></i>
                    <span><?= __('service_nav.upgrade') ?></span>
                </a>
                <button type="button" class="service-item" data-bs-toggle="offcanvas" data-bs-target="#dutyFreeOffcanvas" style="background:none; border:none; color:inherit; text-decoration:none;">
                    <i class="fas fa-shopping-cart text-danger"></i>
                    <span><?= __('service_nav.shopping') ?></span>
                </button>
                <button type="button" class="service-item" onclick="toggleContextualServices()" style="background:none; border:none; color:inherit; text-decoration:none;">
                    <i class="fas fa-building text-primary"></i>
                    <span><?= __('service_nav.hotel_tour') ?></span>
                </button>
                <button type="button" class="service-item" onclick="alert('Vui lòng chọn chuyến bay trước. Bạn có thể thêm bảo hiểm tại bước Thanh Toán.')" style="background:none; border:none; color:inherit; text-decoration:none;">
                    <i class="fas fa-shield-alt text-success"></i>
                    <span><?= __('service_nav.insurance') ?></span>
                </button>
                <button type="button" class="service-item" data-bs-toggle="modal" data-bs-target="#checklistModal" style="background:none; border:none; color:inherit; text-decoration:none;">
                    <i class="fas fa-clipboard-check text-warning"></i>
                    <span><?= __('service_nav.others') ?></span>
                </button>
            </div>
EOD;
$content = str_replace($searchExtraServices, $replaceExtraServices, $content);

// 3. Inject Contextual Services Div after the Submenus
$searchSubmenus = <<<EOD
            <div class="service-submenu" id="upgradeSubmenu" style="display: none;">
                <a href="<?= BASEURL ?>/service/seatSelection" class="submenu-link">CHỌN CHỖ NGỒI</a>
                <a href="<?= BASEURL ?>/service/classUpgrade" class="submenu-link">NÂNG HẠNG</a>
                <a href="<?= BASEURL ?>/service/skySofa" class="submenu-link">SKY-SOFA</a>
            </div>
        </div>
EOD;
$replaceSubmenus = <<<EOD
            <div class="service-submenu" id="upgradeSubmenu" style="display: none;">
                <a href="<?= BASEURL ?>/service/seatSelection" class="submenu-link">CHỌN CHỖ NGỒI</a>
                <a href="<?= BASEURL ?>/service/classUpgrade" class="submenu-link">NÂNG HẠNG</a>
                <a href="<?= BASEURL ?>/service/skySofa" class="submenu-link">SKY-SOFA</a>
            </div>
            
            <!-- KHU VỰC GỢI Ý KHÁCH SẠN & TOUR (Ẩn mặc định, hiện khi bấm) -->
            <div id="contextualServices" class="mt-3 p-3 rounded-4" style="display: none; background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border: 1px dashed #005e6a;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h5 class="fw-bold mb-1" style="color: #005e6a;"><i class="fas fa-star text-warning me-1"></i> Gợi ý dành riêng cho hành trình đến <span id="csDestName" class="text-danger">Melbourne</span></h5>
                        <p class="text-muted small mb-0"><i class="fas fa-tag text-warning"></i> Đặt kèm để giảm thêm <strong>15% giá vé máy bay</strong>!</p>
                    </div>
                    <button class="btn btn-sm btn-close" onclick="toggleContextualServices()"></button>
                </div>
                <div class="cs-carousel-container">
                    <div class="d-flex gap-3 overflow-auto pb-3 pt-1 px-1" id="csCardWrapper" style="scrollbar-width: thin;"></div>
                </div>
            </div>
        </div>
EOD;
$content = str_replace($searchSubmenus, $replaceSubmenus, $content);

// 4. Inject JS Logic
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
            
            const deptCodeElem = document.getElementById('deptCode');
            const destCodeElem = document.getElementById('destCode');
            const currentDestCode = destCodeElem ? destCodeElem.innerText : 'DEFAULT';
            
            const destNameElem = document.getElementById('destName');
            const currentDestName = destNameElem ? destNameElem.innerText.split(',')[0] : 'bạn';
            
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
// Inject JS before closing script tag or before review logic
$content = str_replace('// ================= LOGIC ĐÁNH GIÁ KHÁCH HÀNG =================', $jsLogic . "\n        // ================= LOGIC ĐÁNH GIÁ KHÁCH HÀNG =================", $content);

// 5. Inject Modals and Offcanvas at the bottom of the body
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
echo "New Cross-selling injected successfully into extra-services!";
