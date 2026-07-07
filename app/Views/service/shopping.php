<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f0f4f8; color: #1a1a2e; }

        /* NAVBAR */
        .top-nav { background: rgba(255,255,255,0.95); backdrop-filter: blur(20px); box-shadow: 0 2px 20px rgba(0,0,0,0.06); position: sticky; top: 0; z-index: 1000; }
        .brand-logo { font-weight: 900; font-size: 22px; color: #005e6a; text-decoration: none; letter-spacing: -0.5px; }
        .brand-logo span { color: #f39c12; }
        .nav-link-custom { color: #555; font-weight: 600; font-size: 14px; text-decoration: none; padding: 8px 16px; border-radius: 8px; transition: 0.2s; }
        .nav-link-custom:hover { background: #f0f8ff; color: #005e6a; }

        /* HERO */
        .hero-section {
            background: linear-gradient(135deg, rgba(231,76,60,0.88), rgba(192,57,43,0.92)), url('https://images.unsplash.com/photo-1441986300917-64674bd600d8?auto=format&fit=crop&w=1920&q=80') center/cover;
            padding: 100px 0 80px;
            color: #fff;
            text-align: center;
        }
        .hero-section h1 { font-weight: 900; font-size: 42px; letter-spacing: -1px; margin-bottom: 15px; }
        .hero-section p { font-size: 18px; opacity: 0.85; max-width: 650px; margin: 0 auto 30px; }

        /* CATEGORY TABS */
        .cat-tabs-wrap {
            background: #fff; border-radius: 20px; padding: 15px 25px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.1); margin-top: -35px; position: relative; z-index: 10;
            display: flex; gap: 10px; justify-content: center; flex-wrap: wrap;
        }
        .cat-tab {
            background: #f8f9fa; border: 2px solid transparent; border-radius: 14px; padding: 14px 24px;
            font-weight: 700; font-size: 14px; color: #555; cursor: pointer; transition: 0.3s;
            display: flex; align-items: center; gap: 8px;
        }
        .cat-tab:hover { border-color: #e74c3c; color: #e74c3c; }
        .cat-tab.active { background: linear-gradient(135deg, #e74c3c, #c0392b); color: #fff; border-color: transparent; box-shadow: 0 4px 15px rgba(231,76,60,0.3); }
        .cat-tab.active i { color: #fff; }
        .cat-tab i { font-size: 18px; color: #e74c3c; }

        /* SECTION TITLES */
        .section-title { font-size: 26px; font-weight: 800; color: #1a1a2e; margin-bottom: 8px; }
        .section-subtitle { font-size: 15px; color: #888; margin-bottom: 35px; }

        /* PRODUCT CARDS */
        .product-card {
            background: #fff; border-radius: 16px; overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04); transition: 0.3s; border: 1px solid #f0f0f0;
            height: 100%;
        }
        .product-card:hover { transform: translateY(-6px); box-shadow: 0 12px 35px rgba(0,0,0,0.1); }
        .product-card .card-img { height: 200px; object-fit: cover; width: 100%; }
        .product-card .card-body { padding: 20px; display: flex; flex-direction: column; height: calc(100% - 200px); }
        .product-card .product-category { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; }
        .product-card .product-name { font-weight: 700; font-size: 15px; color: #1a1a2e; margin-bottom: 8px; line-height: 1.4; }
        .product-card .product-desc { font-size: 13px; color: #777; line-height: 1.5; margin-bottom: 12px; flex-grow: 1; }
        .product-card .product-pricing { display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #f5f5f5; padding-top: 12px; margin-top: auto; }
        .product-card .price { font-size: 18px; font-weight: 800; color: #e74c3c; }
        .product-card .price-old { font-size: 13px; color: #bbb; text-decoration: line-through; display: block; }
        .btn-cart { background: #e74c3c; color: #fff; border: none; border-radius: 10px; padding: 8px 18px; font-weight: 700; font-size: 12px; transition: 0.2s; white-space: nowrap; }
        .btn-cart:hover { background: #c0392b; color: #fff; transform: translateY(-1px); }

        /* PROMO BANNER */
        .promo-banner {
            background: linear-gradient(135deg, #2c3e50, #3498db);
            border-radius: 20px; padding: 40px 50px; color: #fff; position: relative; overflow: hidden;
        }
        .promo-banner::after { content: '🛒'; font-size: 150px; position: absolute; right: 30px; bottom: -20px; opacity: 0.08; }
        .promo-banner h3 { font-weight: 900; font-size: 26px; margin-bottom: 10px; }
        .promo-banner p { opacity: 0.85; font-size: 15px; max-width: 500px; margin-bottom: 20px; }

        /* BADGE TAGS */
        .badge-hot { position: absolute; top: 15px; right: 15px; background: #e74c3c; color: #fff; padding: 5px 12px; border-radius: 8px; font-size: 11px; font-weight: 700; z-index: 2; }
        .badge-new { position: absolute; top: 15px; right: 15px; background: #27ae60; color: #fff; padding: 5px 12px; border-radius: 8px; font-size: 11px; font-weight: 700; z-index: 2; }

        /* FOOTER */
        .page-footer { background: #0c2233; color: rgba(255,255,255,0.6); padding: 40px 0; text-align: center; font-size: 14px; }
        .page-footer a { color: #f39c12; text-decoration: none; }

        /* PRODUCT GRID VISIBILITY */
        .product-section { display: none; }
        .product-section.active { display: block; }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="top-nav">
    <div class="container d-flex justify-content-between align-items-center py-3">
        <a href="<?= BASEURL ?>/home" class="brand-logo">SKYLINE<span>TICKET</span></a>
        <div class="d-flex gap-2">
            <a href="<?= BASEURL ?>/home" class="nav-link-custom"><i class="fas fa-home me-1"></i> Trang chủ</a>
            <a href="<?= BASEURL ?>/service/shopping" class="nav-link-custom" style="background:#fff5f5; color:#e74c3c;"><i class="fas fa-shopping-cart me-1"></i> Mua sắm</a>
            <a href="<?= BASEURL ?>/service/hotelTour" class="nav-link-custom"><i class="fas fa-hotel me-1"></i> Khách sạn & Tour</a>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="hero-section">
    <div class="container">
        <h1><i class="fas fa-shopping-bag me-2"></i> Skyline Travel Shop</h1>
        <p>SIM quốc tế, eSIM, phụ kiện công nghệ và mọi đồ dùng thiết yếu cho chuyến du lịch nước ngoài hoàn hảo</p>
    </div>
</section>

<!-- CATEGORY TABS -->
<div class="container">
    <div class="cat-tabs-wrap">
        <div class="cat-tab active" data-target="sim"><i class="fas fa-sim-card"></i> SIM & eSIM</div>
        <div class="cat-tab" data-target="tech"><i class="fas fa-plug"></i> Phụ kiện công nghệ</div>
        <div class="cat-tab" data-target="travel"><i class="fas fa-suitcase-rolling"></i> Đồ dùng du lịch</div>
        <div class="cat-tab" data-target="beauty"><i class="fas fa-spray-can-sparkles"></i> Mỹ phẩm miễn thuế</div>
    </div>
</div>

<!-- PROMO BANNER -->
<div class="container my-5">
    <div class="promo-banner">
        <span class="badge bg-warning text-dark fw-bold mb-3 px-3 py-2" style="font-size:13px;"><i class="fas fa-plane me-1"></i> ƯU ĐÃI HÀNH KHÁCH SKYLINE</span>
        <h3>Giảm thêm 20% khi mua kèm vé máy bay</h3>
        <p>Đặt SIM quốc tế hoặc phụ kiện du lịch cùng lúc với vé bay để nhận ngay mã giảm giá độc quyền. Nhận hàng tại quầy check-in hoặc giao tận cửa khởi hành.</p>
        <button class="btn btn-light fw-bold px-4 py-2 rounded-pill"><i class="fas fa-tag me-2"></i>Xem Ưu Đãi</button>
    </div>
</div>

<!-- ========== SIM & eSIM ========== -->
<div class="container product-section active" id="section-sim">
    <h2 class="section-title"><i class="fas fa-sim-card text-primary me-2"></i>SIM Quốc Tế & eSIM</h2>
    <p class="section-subtitle">Kết nối mọi lúc mọi nơi - Không lo mất sóng khi ra nước ngoài</p>
    <div class="row g-4">
        <div class="col-md-6 col-lg-4">
            <div class="product-card position-relative">
                <span class="badge-hot"><i class="fas fa-fire me-1"></i>Bán chạy</span>
                <img src="https://images.unsplash.com/photo-1556656793-08538906a9f8?auto=format&fit=crop&w=600&q=80" class="card-img" alt="eSIM Châu Á">
                <div class="card-body">
                    <div class="product-category text-primary">eSIM</div>
                    <h5 class="product-name">eSIM Châu Á 15 Quốc Gia - 10GB/30 ngày</h5>
                    <p class="product-desc">Phủ sóng Nhật, Hàn, Thái, Singapore, Malaysia... Kích hoạt tức thì bằng QR code, không cần đổi SIM vật lý.</p>
                    <div class="product-pricing">
                        <div><span class="price">299.000₫</span><span class="price-old">450.000₫</span></div>
                        <button class="btn-cart"><i class="fas fa-cart-plus me-1"></i>Thêm</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="product-card position-relative">
                <span class="badge-new"><i class="fas fa-bolt me-1"></i>Mới</span>
                <img src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?auto=format&fit=crop&w=600&q=80" class="card-img" alt="eSIM Toàn Cầu">
                <div class="card-body">
                    <div class="product-category text-success">eSIM</div>
                    <h5 class="product-name">eSIM Toàn Cầu - 5GB/15 ngày</h5>
                    <p class="product-desc">Sử dụng tại hơn 100 quốc gia trên toàn thế giới. Tự động chuyển mạng, data tốc độ cao 4G/5G.</p>
                    <div class="product-pricing">
                        <div><span class="price">499.000₫</span><span class="price-old">750.000₫</span></div>
                        <button class="btn-cart"><i class="fas fa-cart-plus me-1"></i>Thêm</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="product-card">
                <img src="https://images.unsplash.com/photo-1601784551446-20c9e07cdbdb?auto=format&fit=crop&w=600&q=80" class="card-img" alt="SIM Nhật Bản">
                <div class="card-body">
                    <div class="product-category text-warning">SIM Vật Lý</div>
                    <h5 class="product-name">SIM Du Lịch Nhật Bản - Unlimited Data 7 ngày</h5>
                    <p class="product-desc">Data không giới hạn tại Nhật Bản. Nhận SIM trước khi bay tại quầy Skyline hoặc giao tận nhà.</p>
                    <div class="product-pricing">
                        <div><span class="price">350.000₫</span><span class="price-old">500.000₫</span></div>
                        <button class="btn-cart"><i class="fas fa-cart-plus me-1"></i>Thêm</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="product-card">
                <img src="https://images.unsplash.com/photo-1523206489230-c012c64b2b48?auto=format&fit=crop&w=600&q=80" class="card-img" alt="SIM Châu Âu">
                <div class="card-body">
                    <div class="product-category text-info">SIM Vật Lý</div>
                    <h5 class="product-name">SIM Châu Âu 30 Quốc Gia - 20GB/30 ngày</h5>
                    <p class="product-desc">Phủ sóng toàn EU: Pháp, Đức, Ý, Tây Ban Nha... Bao gồm cuộc gọi nội vùng miễn phí.</p>
                    <div class="product-pricing">
                        <div><span class="price">550.000₫</span><span class="price-old">800.000₫</span></div>
                        <button class="btn-cart"><i class="fas fa-cart-plus me-1"></i>Thêm</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="product-card">
                <img src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?auto=format&fit=crop&w=600&q=80" class="card-img" alt="SIM Úc">
                <div class="card-body">
                    <div class="product-category text-danger">SIM Vật Lý</div>
                    <h5 class="product-name">SIM Du Lịch Úc & New Zealand - 15GB/14 ngày</h5>
                    <p class="product-desc">Data tốc độ cao tại Úc và New Zealand. Bao gồm cuộc gọi về Việt Nam 60 phút.</p>
                    <div class="product-pricing">
                        <div><span class="price">420.000₫</span><span class="price-old">600.000₫</span></div>
                        <button class="btn-cart"><i class="fas fa-cart-plus me-1"></i>Thêm</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="product-card position-relative">
                <span class="badge-hot"><i class="fas fa-crown me-1"></i>Premium</span>
                <img src="https://images.unsplash.com/photo-1585771724684-38269d6639fd?auto=format&fit=crop&w=600&q=80" class="card-img" alt="eSIM Premium">
                <div class="card-body">
                    <div class="product-category text-danger">eSIM PREMIUM</div>
                    <h5 class="product-name">eSIM Doanh Nhân - Unlimited 90 ngày toàn cầu</h5>
                    <p class="product-desc">Gói premium cho doanh nhân: Data không giới hạn, 5G ưu tiên, hỗ trợ 24/7 đa ngôn ngữ.</p>
                    <div class="product-pricing">
                        <div><span class="price">2.500.000₫</span><span class="price-old">3.800.000₫</span></div>
                        <button class="btn-cart"><i class="fas fa-cart-plus me-1"></i>Thêm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ========== PHỤ KIỆN CÔNG NGHỆ ========== -->
<div class="container product-section" id="section-tech">
    <h2 class="section-title"><i class="fas fa-plug text-warning me-2"></i>Phụ Kiện Công Nghệ Du Lịch</h2>
    <p class="section-subtitle">Adapter, sạc dự phòng, tai nghe chống ồn - Sẵn sàng cho mọi chuyến bay</p>
    <div class="row g-4">
        <div class="col-md-6 col-lg-4">
            <div class="product-card position-relative">
                <span class="badge-hot"><i class="fas fa-fire me-1"></i>Bán chạy</span>
                <img src="https://images.unsplash.com/photo-1583394838336-acd977736f90?auto=format&fit=crop&w=600&q=80" class="card-img" alt="Tai nghe">
                <div class="card-body">
                    <div class="product-category text-primary">Tai nghe</div>
                    <h5 class="product-name">Sony WH-1000XM5 - Chống ồn chủ động</h5>
                    <p class="product-desc">Tai nghe chống ồn hàng đầu thế giới. Pin 30 giờ, kết nối đa thiết bị, gấp gọn tiện lợi khi bay.</p>
                    <div class="product-pricing">
                        <div><span class="price">$299</span><span class="price-old">$399</span></div>
                        <button class="btn-cart"><i class="fas fa-cart-plus me-1"></i>Thêm</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="product-card">
                <img src="https://images.unsplash.com/photo-1609091839311-d5365f9ff1c5?auto=format&fit=crop&w=600&q=80" class="card-img" alt="Adapter">
                <div class="card-body">
                    <div class="product-category text-success">Adapter</div>
                    <h5 class="product-name">Adapter Ổ Cắm Đa Năng - Universal Travel Adapter</h5>
                    <p class="product-desc">Tương thích 200+ quốc gia. 4 cổng USB-A + 1 USB-C PD 30W. Chống sốc, chống quá tải.</p>
                    <div class="product-pricing">
                        <div><span class="price">450.000₫</span><span class="price-old">650.000₫</span></div>
                        <button class="btn-cart"><i class="fas fa-cart-plus me-1"></i>Thêm</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="product-card">
                <img src="https://images.unsplash.com/photo-1609091839311-d5365f9ff1c5?auto=format&fit=crop&w=600&q=80" class="card-img" alt="Sạc dự phòng">
                <div class="card-body">
                    <div class="product-category text-warning">Pin sạc</div>
                    <h5 class="product-name">Pin Sạc Dự Phòng 20.000mAh - Chuẩn hàng không</h5>
                    <p class="product-desc">Dung lượng 20.000mAh, đạt chuẩn mang lên máy bay. Sạc nhanh PD 22.5W, 2 cổng output.</p>
                    <div class="product-pricing">
                        <div><span class="price">550.000₫</span><span class="price-old">750.000₫</span></div>
                        <button class="btn-cart"><i class="fas fa-cart-plus me-1"></i>Thêm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ========== ĐỒ DÙNG DU LỊCH ========== -->
<div class="container product-section" id="section-travel">
    <h2 class="section-title"><i class="fas fa-suitcase-rolling text-info me-2"></i>Đồ Dùng Du Lịch Thiết Yếu</h2>
    <p class="section-subtitle">Gối cổ, bịt mắt, túi đựng hộ chiếu - Mọi thứ bạn cần cho chuyến đi</p>
    <div class="row g-4">
        <div class="col-md-6 col-lg-4">
            <div class="product-card">
                <img src="https://images.unsplash.com/photo-1553062407-98eeb64c6a62?auto=format&fit=crop&w=600&q=80" class="card-img" alt="Balo du lịch">
                <div class="card-body">
                    <div class="product-category text-info">Balo & Túi</div>
                    <h5 class="product-name">Balo Du Lịch Chống Nước 40L - Cabin Size</h5>
                    <p class="product-desc">Kích thước vừa cabin, chống nước IPX4, ngăn laptop 15.6", khóa TSA tích hợp.</p>
                    <div class="product-pricing">
                        <div><span class="price">890.000₫</span><span class="price-old">1.200.000₫</span></div>
                        <button class="btn-cart"><i class="fas fa-cart-plus me-1"></i>Thêm</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="product-card position-relative">
                <span class="badge-hot"><i class="fas fa-fire me-1"></i>Bán chạy</span>
                <img src="https://images.unsplash.com/photo-1544161515-4ab6ce6db874?auto=format&fit=crop&w=600&q=80" class="card-img" alt="Travel Kit">
                <div class="card-body">
                    <div class="product-category text-success">Bộ Kit</div>
                    <h5 class="product-name">Travel Comfort Kit - Gối cổ + Bịt mắt + Bịt tai</h5>
                    <p class="product-desc">Bộ 3 phụ kiện thiết yếu cho chuyến bay dài. Chất liệu memory foam cao cấp, bao đựng nhỏ gọn.</p>
                    <div class="product-pricing">
                        <div><span class="price">320.000₫</span><span class="price-old">450.000₫</span></div>
                        <button class="btn-cart"><i class="fas fa-cart-plus me-1"></i>Thêm</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="product-card">
                <img src="https://images.unsplash.com/photo-1601972599720-36938d4ecd31?auto=format&fit=crop&w=600&q=80" class="card-img" alt="Ví hộ chiếu">
                <div class="card-body">
                    <div class="product-category text-danger">Phụ kiện</div>
                    <h5 class="product-name">Ví Đựng Hộ Chiếu RFID - Da PU cao cấp</h5>
                    <p class="product-desc">Chặn sóng RFID bảo vệ thông tin. Đựng hộ chiếu, thẻ tín dụng, boarding pass và tiền mặt.</p>
                    <div class="product-pricing">
                        <div><span class="price">180.000₫</span><span class="price-old">280.000₫</span></div>
                        <button class="btn-cart"><i class="fas fa-cart-plus me-1"></i>Thêm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ========== MỸ PHẨM MIỄN THUẾ ========== -->
<div class="container product-section" id="section-beauty">
    <h2 class="section-title"><i class="fas fa-spray-can-sparkles text-danger me-2"></i>Nước Hoa & Mỹ Phẩm Miễn Thuế</h2>
    <p class="section-subtitle">Giá rẻ hơn thị trường đến 40% - Nhận hàng tại cửa khởi hành</p>
    <div class="row g-4">
        <div class="col-md-6 col-lg-4">
            <div class="product-card position-relative">
                <span class="badge-hot"><i class="fas fa-crown me-1"></i>Best Seller</span>
                <img src="https://images.unsplash.com/photo-1528701800487-ba01fea498c0?auto=format&fit=crop&w=600&q=80" class="card-img" alt="Chanel">
                <div class="card-body">
                    <div class="product-category text-danger">Nước hoa</div>
                    <h5 class="product-name">Chanel No.5 Eau De Parfum 100ml</h5>
                    <p class="product-desc">Hương thơm kinh điển vượt thời gian. Phiên bản duty-free độc quyền với hộp quà sang trọng.</p>
                    <div class="product-pricing">
                        <div><span class="price">$135</span><span class="price-old">$180</span></div>
                        <button class="btn-cart"><i class="fas fa-cart-plus me-1"></i>Thêm</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="product-card">
                <img src="https://images.unsplash.com/photo-1571781926291-c477ebfd024b?auto=format&fit=crop&w=600&q=80" class="card-img" alt="Dior">
                <div class="card-body">
                    <div class="product-category text-info">Nước hoa</div>
                    <h5 class="product-name">Dior Sauvage Eau De Toilette 100ml</h5>
                    <p class="product-desc">Hương thơm nam tính mạnh mẽ. Top seller toàn cầu, phù hợp làm quà tặng.</p>
                    <div class="product-pricing">
                        <div><span class="price">$110</span><span class="price-old">$155</span></div>
                        <button class="btn-cart"><i class="fas fa-cart-plus me-1"></i>Thêm</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="product-card">
                <img src="https://images.unsplash.com/photo-1596462502278-27bfdc403348?auto=format&fit=crop&w=600&q=80" class="card-img" alt="MAC">
                <div class="card-body">
                    <div class="product-category text-warning">Mỹ phẩm</div>
                    <h5 class="product-name">MAC Travel Exclusive Lipstick Set (5 màu)</h5>
                    <p class="product-desc">Set 5 son MAC best-seller phiên bản du lịch. Bao gồm Ruby Woo, Velvet Teddy, Diva...</p>
                    <div class="product-pricing">
                        <div><span class="price">$65</span><span class="price-old">$95</span></div>
                        <button class="btn-cart"><i class="fas fa-cart-plus me-1"></i>Thêm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FOOTER -->
<footer class="page-footer mt-5">
    <div class="container">
        <p>&copy; 2026 <a href="<?= BASEURL ?>/home">Skyline Ticket</a>. Mua sắm miễn thuế - Nhận hàng tại cửa khởi hành hoặc giao tận ghế ngồi.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Category Tab Switching
document.querySelectorAll('.cat-tab').forEach(tab => {
    tab.addEventListener('click', function() {
        document.querySelectorAll('.cat-tab').forEach(t => t.classList.remove('active'));
        this.classList.add('active');
        const target = this.getAttribute('data-target');
        document.querySelectorAll('.product-section').forEach(s => s.classList.remove('active'));
        document.getElementById('section-' + target).classList.add('active');
    });
});
</script>
</body>
</html>
