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
            background: linear-gradient(135deg, rgba(0,94,106,0.85), rgba(0,40,50,0.9)), url('https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1920&q=80') center/cover;
            padding: 100px 0 80px;
            color: #fff;
            text-align: center;
        }
        .hero-section h1 { font-weight: 900; font-size: 42px; letter-spacing: -1px; margin-bottom: 15px; }
        .hero-section p { font-size: 18px; opacity: 0.85; max-width: 600px; margin: 0 auto 30px; }

        /* SEARCH BAR */
        .search-bar-wrap {
            background: #fff; border-radius: 20px; padding: 30px 35px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.1); margin-top: -50px; position: relative; z-index: 10;
        }
        .search-bar-wrap label { font-size: 12px; font-weight: 700; color: #888; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; display: block; }
        .search-bar-wrap .form-control, .search-bar-wrap .form-select {
            border: 2px solid #e8ecf0; border-radius: 12px; padding: 12px 16px; font-weight: 600; font-size: 14px; transition: 0.2s;
        }
        .search-bar-wrap .form-control:focus, .search-bar-wrap .form-select:focus { border-color: #005e6a; box-shadow: 0 0 0 3px rgba(0,94,106,0.1); }
        .btn-search-hotel { background: linear-gradient(135deg, #005e6a, #007a8a); color: #fff; border: none; border-radius: 12px; padding: 14px 35px; font-weight: 700; font-size: 15px; transition: 0.3s; }
        .btn-search-hotel:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(0,94,106,0.3); color: #fff; }

        /* SECTION TITLES */
        .section-title { font-size: 28px; font-weight: 800; color: #1a1a2e; margin-bottom: 8px; }
        .section-subtitle { font-size: 15px; color: #888; margin-bottom: 35px; }

        /* HOTEL CARDS */
        .hotel-card {
            background: #fff; border-radius: 16px; overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04); transition: 0.3s; border: 1px solid #f0f0f0;
        }
        .hotel-card:hover { transform: translateY(-6px); box-shadow: 0 12px 35px rgba(0,0,0,0.1); }
        .hotel-card .card-img { height: 200px; object-fit: cover; width: 100%; }
        .hotel-card .card-body { padding: 20px; }
        .hotel-card .hotel-name { font-weight: 700; font-size: 16px; color: #1a1a2e; margin-bottom: 6px; }
        .hotel-card .hotel-location { font-size: 13px; color: #888; margin-bottom: 10px; }
        .hotel-card .hotel-location i { color: #e74c3c; margin-right: 4px; }
        .hotel-stars { color: #f39c12; font-size: 12px; margin-bottom: 10px; }
        .hotel-amenities { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 12px; }
        .amenity-tag { font-size: 11px; background: #f0f8ff; color: #005e6a; padding: 4px 10px; border-radius: 6px; font-weight: 600; }
        .hotel-price { display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #f5f5f5; padding-top: 12px; }
        .hotel-price .price { font-size: 20px; font-weight: 800; color: #e74c3c; }
        .hotel-price .price small { font-size: 12px; color: #aaa; font-weight: 500; }
        .btn-book { background: #005e6a; color: #fff; border: none; border-radius: 10px; padding: 8px 20px; font-weight: 700; font-size: 13px; transition: 0.2s; }
        .btn-book:hover { background: #007a8a; color: #fff; transform: translateY(-1px); }

        /* TOUR CARDS */
        .tour-card {
            background: #fff; border-radius: 16px; overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04); transition: 0.3s; border: 1px solid #f0f0f0; position: relative;
        }
        .tour-card:hover { transform: translateY(-6px); box-shadow: 0 12px 35px rgba(0,0,0,0.1); }
        .tour-card .card-img { height: 180px; object-fit: cover; width: 100%; }
        .tour-card .badge-duration {
            position: absolute; top: 15px; left: 15px;
            background: rgba(0,0,0,0.6); color: #fff; padding: 5px 12px; border-radius: 8px; font-size: 12px; font-weight: 700;
            backdrop-filter: blur(5px);
        }
        .tour-card .card-body { padding: 20px; }
        .tour-card .tour-name { font-weight: 700; font-size: 15px; color: #1a1a2e; margin-bottom: 8px; }
        .tour-card .tour-desc { font-size: 13px; color: #777; line-height: 1.5; margin-bottom: 12px; }
        .tour-card .tour-meta { display: flex; gap: 15px; font-size: 12px; color: #999; margin-bottom: 12px; }
        .tour-card .tour-meta i { color: #005e6a; margin-right: 3px; }

        /* COMBO BANNER */
        .combo-banner {
            background: linear-gradient(135deg, #ff6b35, #f7931e);
            border-radius: 20px; padding: 50px; color: #fff; position: relative; overflow: hidden;
        }
        .combo-banner::after {
            content: '✈'; font-size: 200px; position: absolute; right: -20px; bottom: -40px; opacity: 0.1;
        }
        .combo-banner h2 { font-weight: 900; font-size: 32px; margin-bottom: 10px; }
        .combo-banner p { font-size: 16px; opacity: 0.9; margin-bottom: 25px; max-width: 500px; }
        .btn-combo { background: #fff; color: #f7931e; border: none; border-radius: 12px; padding: 14px 35px; font-weight: 800; font-size: 15px; transition: 0.3s; }
        .btn-combo:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(0,0,0,0.2); }

        /* FOOTER */
        .page-footer { background: #0c2233; color: rgba(255,255,255,0.6); padding: 40px 0; text-align: center; font-size: 14px; }
        .page-footer a { color: #f39c12; text-decoration: none; }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="top-nav">
    <div class="container d-flex justify-content-between align-items-center py-3">
        <a href="<?= BASEURL ?>/home" class="brand-logo">SKYLINE<span>TICKET</span></a>
        <div class="d-flex gap-2">
            <a href="<?= BASEURL ?>/home" class="nav-link-custom"><i class="fas fa-home me-1"></i> Trang chủ</a>
            <a href="<?= BASEURL ?>/service/shopping" class="nav-link-custom"><i class="fas fa-shopping-cart me-1"></i> Mua sắm</a>
            <a href="<?= BASEURL ?>/service/hotelTour" class="nav-link-custom" style="background:#f0f8ff; color:#005e6a;"><i class="fas fa-hotel me-1"></i> Khách sạn & Tour</a>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="hero-section">
    <div class="container">
        <h1><i class="fas fa-hotel me-2"></i> Khách Sạn & Tour Du Lịch</h1>
        <p>Đặt phòng khách sạn cao cấp và tham gia các tour trải nghiệm tuyệt vời cùng Skyline Ticket</p>
    </div>
</section>

<!-- SEARCH BAR -->
<div class="container">
    <div class="search-bar-wrap">
        <form class="row g-3 align-items-end">
            <div class="col-md-3">
                <label>Điểm đến</label>
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Nhập thành phố..." value="Melbourne, Úc">
                </div>
            </div>
            <div class="col-md-2">
                <label>Nhận phòng</label>
                <input type="date" class="form-control" value="2026-07-15">
            </div>
            <div class="col-md-2">
                <label>Trả phòng</label>
                <input type="date" class="form-control" value="2026-07-20">
            </div>
            <div class="col-md-2">
                <label>Số phòng</label>
                <select class="form-select">
                    <option>1 phòng, 2 khách</option>
                    <option>2 phòng, 4 khách</option>
                    <option>3 phòng, 6 khách</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="button" class="btn-search-hotel w-100"><i class="fas fa-search me-2"></i>Tìm Khách Sạn</button>
            </div>
        </form>
    </div>
</div>

<!-- COMBO BANNER -->
<div class="container my-5">
    <div class="combo-banner">
        <span class="badge bg-white text-danger fw-bold mb-3 px-3 py-2" style="font-size:14px;"><i class="fas fa-fire me-1"></i> HOT DEAL</span>
        <h2>Combo Vé Bay + Khách Sạn</h2>
        <p>Đặt cùng lúc vé máy bay và khách sạn để nhận ngay ưu đãi giảm <strong>15%</strong> tổng giá trị đơn hàng. Áp dụng cho mọi điểm đến!</p>
        <button class="btn-combo"><i class="fas fa-bolt me-2"></i>Đặt Combo Ngay</button>
    </div>
</div>

<!-- KHÁCH SẠN NỔI BẬT -->
<div class="container my-5 pt-3">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h2 class="section-title"><i class="fas fa-star text-warning me-2"></i>Khách Sạn Nổi Bật</h2>
            <p class="section-subtitle mb-0">Được đánh giá cao nhất bởi du khách Skyline</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-secondary btn-sm rounded-pill px-3 fw-bold active" style="border-color:#005e6a; color:#005e6a;">Tất cả</button>
            <button class="btn btn-outline-secondary btn-sm rounded-pill px-3 fw-bold">4-5 sao</button>
            <button class="btn btn-outline-secondary btn-sm rounded-pill px-3 fw-bold">Giá tốt</button>
        </div>
    </div>
    <div class="row g-4">
        <!-- Hotel 1 -->
        <div class="col-md-6 col-lg-4">
            <div class="hotel-card">
                <img src="https://images.unsplash.com/photo-1566073171659-4d9f345cd320?auto=format&fit=crop&w=600&q=80" class="card-img" alt="Grand Melbourne">
                <div class="card-body">
                    <div class="hotel-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                    <h5 class="hotel-name">Grand Hyatt Melbourne</h5>
                    <p class="hotel-location"><i class="fas fa-map-marker-alt"></i> 123 Collins Street, Melbourne CBD</p>
                    <div class="hotel-amenities">
                        <span class="amenity-tag"><i class="fas fa-wifi me-1"></i>WiFi</span>
                        <span class="amenity-tag"><i class="fas fa-swimming-pool me-1"></i>Hồ bơi</span>
                        <span class="amenity-tag"><i class="fas fa-spa me-1"></i>Spa</span>
                        <span class="amenity-tag"><i class="fas fa-dumbbell me-1"></i>Gym</span>
                    </div>
                    <div class="hotel-price">
                        <div class="price">$189 <small>/đêm</small></div>
                        <button class="btn-book">Đặt Ngay</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hotel 2 -->
        <div class="col-md-6 col-lg-4">
            <div class="hotel-card">
                <img src="https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?auto=format&fit=crop&w=600&q=80" class="card-img" alt="Park Royal">
                <div class="card-body">
                    <div class="hotel-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
                    <h5 class="hotel-name">Park Royal Darling Harbour</h5>
                    <p class="hotel-location"><i class="fas fa-map-marker-alt"></i> 150 Day Street, Sydney</p>
                    <div class="hotel-amenities">
                        <span class="amenity-tag"><i class="fas fa-wifi me-1"></i>WiFi</span>
                        <span class="amenity-tag"><i class="fas fa-utensils me-1"></i>Nhà hàng</span>
                        <span class="amenity-tag"><i class="fas fa-parking me-1"></i>Bãi đỗ</span>
                    </div>
                    <div class="hotel-price">
                        <div class="price">$145 <small>/đêm</small></div>
                        <button class="btn-book">Đặt Ngay</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hotel 3 -->
        <div class="col-md-6 col-lg-4">
            <div class="hotel-card">
                <img src="https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?auto=format&fit=crop&w=600&q=80" class="card-img" alt="InterContinental">
                <div class="card-body">
                    <div class="hotel-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                    <h5 class="hotel-name">InterContinental Đà Nẵng</h5>
                    <p class="hotel-location"><i class="fas fa-map-marker-alt"></i> Bãi Bắc, Bán đảo Sơn Trà</p>
                    <div class="hotel-amenities">
                        <span class="amenity-tag"><i class="fas fa-umbrella-beach me-1"></i>Biển riêng</span>
                        <span class="amenity-tag"><i class="fas fa-spa me-1"></i>Spa</span>
                        <span class="amenity-tag"><i class="fas fa-swimming-pool me-1"></i>Infinity Pool</span>
                    </div>
                    <div class="hotel-price">
                        <div class="price">3.200.000₫ <small>/đêm</small></div>
                        <button class="btn-book">Đặt Ngay</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hotel 4 -->
        <div class="col-md-6 col-lg-4">
            <div class="hotel-card">
                <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=600&q=80" class="card-img" alt="Vinpearl">
                <div class="card-body">
                    <div class="hotel-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                    <h5 class="hotel-name">Vinpearl Resort Nha Trang</h5>
                    <p class="hotel-location"><i class="fas fa-map-marker-alt"></i> Đảo Hòn Tre, Nha Trang</p>
                    <div class="hotel-amenities">
                        <span class="amenity-tag"><i class="fas fa-water me-1"></i>Công viên nước</span>
                        <span class="amenity-tag"><i class="fas fa-gamepad me-1"></i>VinWonders</span>
                        <span class="amenity-tag"><i class="fas fa-child me-1"></i>Gia đình</span>
                    </div>
                    <div class="hotel-price">
                        <div class="price">2.800.000₫ <small>/đêm</small></div>
                        <button class="btn-book">Đặt Ngay</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hotel 5 -->
        <div class="col-md-6 col-lg-4">
            <div class="hotel-card">
                <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?auto=format&fit=crop&w=600&q=80" class="card-img" alt="JW Marriott">
                <div class="card-body">
                    <div class="hotel-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                    <h5 class="hotel-name">JW Marriott Phú Quốc</h5>
                    <p class="hotel-location"><i class="fas fa-map-marker-alt"></i> Bãi Dài, Phú Quốc</p>
                    <div class="hotel-amenities">
                        <span class="amenity-tag"><i class="fas fa-umbrella-beach me-1"></i>Biển riêng</span>
                        <span class="amenity-tag"><i class="fas fa-cocktail me-1"></i>Bar</span>
                        <span class="amenity-tag"><i class="fas fa-hot-tub me-1"></i>Jacuzzi</span>
                    </div>
                    <div class="hotel-price">
                        <div class="price">4.500.000₫ <small>/đêm</small></div>
                        <button class="btn-book">Đặt Ngay</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hotel 6 -->
        <div class="col-md-6 col-lg-4">
            <div class="hotel-card">
                <img src="https://images.unsplash.com/photo-1445019980597-93fa8acb246c?auto=format&fit=crop&w=600&q=80" class="card-img" alt="Novotel">
                <div class="card-body">
                    <div class="hotel-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
                    <h5 class="hotel-name">Novotel Bangkok Sukhumvit</h5>
                    <p class="hotel-location"><i class="fas fa-map-marker-alt"></i> Sukhumvit Soi 20, Bangkok</p>
                    <div class="hotel-amenities">
                        <span class="amenity-tag"><i class="fas fa-swimming-pool me-1"></i>Rooftop Pool</span>
                        <span class="amenity-tag"><i class="fas fa-subway me-1"></i>Gần BTS</span>
                        <span class="amenity-tag"><i class="fas fa-wifi me-1"></i>WiFi</span>
                    </div>
                    <div class="hotel-price">
                        <div class="price">$95 <small>/đêm</small></div>
                        <button class="btn-book">Đặt Ngay</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- TOUR DU LỊCH -->
<div class="container my-5 pt-4">
    <h2 class="section-title"><i class="fas fa-route text-success me-2"></i>Tour Du Lịch Hấp Dẫn</h2>
    <p class="section-subtitle">Trải nghiệm các tour được thiết kế riêng cho hành khách Skyline</p>
    <div class="row g-4">
        <!-- Tour 1 -->
        <div class="col-md-6 col-lg-4">
            <div class="tour-card">
                <img src="https://images.unsplash.com/photo-1514801198595-53896dfaebc1?auto=format&fit=crop&w=600&q=80" class="card-img" alt="Great Ocean Road">
                <span class="badge-duration"><i class="fas fa-clock me-1"></i> 2 ngày 1 đêm</span>
                <div class="card-body">
                    <h5 class="tour-name">Tour Great Ocean Road - 12 Tông Đồ</h5>
                    <p class="tour-desc">Hành trình dọc bờ biển huyền thoại của Úc, ngắm 12 Tông Đồ và rừng mưa nhiệt đới Otway.</p>
                    <div class="tour-meta">
                        <span><i class="fas fa-users"></i> Tối đa 15 người</span>
                        <span><i class="fas fa-utensils"></i> Bao gồm bữa trưa</span>
                    </div>
                    <div class="hotel-price">
                        <div class="price">$185 <small>/người</small></div>
                        <button class="btn-book">Đặt Tour</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tour 2 -->
        <div class="col-md-6 col-lg-4">
            <div class="tour-card">
                <img src="https://images.unsplash.com/photo-1588656602075-e9cc5c4c3445?auto=format&fit=crop&w=600&q=80" class="card-img" alt="Bà Nà Hills">
                <span class="badge-duration"><i class="fas fa-clock me-1"></i> 1 ngày</span>
                <div class="card-body">
                    <h5 class="tour-name">Cáp Treo Bà Nà Hills & Cầu Vàng</h5>
                    <p class="tour-desc">Khám phá Làng Pháp trên đỉnh Bà Nà, check-in Cầu Vàng và thưởng thức ẩm thực cao cấp.</p>
                    <div class="tour-meta">
                        <span><i class="fas fa-users"></i> Tối đa 20 người</span>
                        <span><i class="fas fa-ticket-alt"></i> Bao gồm vé cáp treo</span>
                    </div>
                    <div class="hotel-price">
                        <div class="price">900.000₫ <small>/người</small></div>
                        <button class="btn-book">Đặt Tour</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tour 3 -->
        <div class="col-md-6 col-lg-4">
            <div class="tour-card">
                <img src="https://images.unsplash.com/photo-1528127269322-539801943592?auto=format&fit=crop&w=600&q=80" class="card-img" alt="Phú Quốc">
                <span class="badge-duration"><i class="fas fa-clock me-1"></i> 3 ngày 2 đêm</span>
                <div class="card-body">
                    <h5 class="tour-name">Phú Quốc Paradise - Lặn Biển & BBQ</h5>
                    <p class="tour-desc">Tour trọn gói bao gồm lặn ngắm san hô, tham quan làng chài và tiệc BBQ bãi biển.</p>
                    <div class="tour-meta">
                        <span><i class="fas fa-users"></i> Tối đa 12 người</span>
                        <span><i class="fas fa-bed"></i> Bao gồm khách sạn</span>
                    </div>
                    <div class="hotel-price">
                        <div class="price">3.500.000₫ <small>/người</small></div>
                        <button class="btn-book">Đặt Tour</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tour 4 -->
        <div class="col-md-6 col-lg-4">
            <div class="tour-card">
                <img src="https://images.unsplash.com/photo-1504214208698-ea1916a2195a?auto=format&fit=crop&w=600&q=80" class="card-img" alt="Bangkok">
                <span class="badge-duration"><i class="fas fa-clock me-1"></i> 4 ngày 3 đêm</span>
                <div class="card-body">
                    <h5 class="tour-name">Bangkok Food & Culture Tour</h5>
                    <p class="tour-desc">Khám phá chợ nổi Damnoen Saduak, chùa Phật Vàng và thưởng thức street food huyền thoại.</p>
                    <div class="tour-meta">
                        <span><i class="fas fa-users"></i> Tối đa 10 người</span>
                        <span><i class="fas fa-utensils"></i> Bao gồm ăn uống</span>
                    </div>
                    <div class="hotel-price">
                        <div class="price">$320 <small>/người</small></div>
                        <button class="btn-book">Đặt Tour</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tour 5 -->
        <div class="col-md-6 col-lg-4">
            <div class="tour-card">
                <img src="https://images.unsplash.com/photo-1503899036084-c55cdd92da26?auto=format&fit=crop&w=600&q=80" class="card-img" alt="Tokyo">
                <span class="badge-duration"><i class="fas fa-clock me-1"></i> 5 ngày 4 đêm</span>
                <div class="card-body">
                    <h5 class="tour-name">Tokyo Highlights & Mùa Hoa Anh Đào</h5>
                    <p class="tour-desc">Thăm Shinjuku, Shibuya, Akihabara, núi Phú Sĩ. Trải nghiệm văn hóa samurai và onsen.</p>
                    <div class="tour-meta">
                        <span><i class="fas fa-users"></i> Tối đa 15 người</span>
                        <span><i class="fas fa-train"></i> Bao gồm JR Pass</span>
                    </div>
                    <div class="hotel-price">
                        <div class="price">$890 <small>/người</small></div>
                        <button class="btn-book">Đặt Tour</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tour 6 -->
        <div class="col-md-6 col-lg-4">
            <div class="tour-card">
                <img src="https://images.unsplash.com/photo-1512453979798-5ea266f8880c?auto=format&fit=crop&w=600&q=80" class="card-img" alt="Dubai">
                <span class="badge-duration"><i class="fas fa-clock me-1"></i> 4 ngày 3 đêm</span>
                <div class="card-body">
                    <h5 class="tour-name">Dubai Luxury Experience</h5>
                    <p class="tour-desc">Burj Khalifa, Safari sa mạc, Dubai Mall và du thuyền trên vịnh Dubai Marina.</p>
                    <div class="tour-meta">
                        <span><i class="fas fa-users"></i> Tối đa 8 người</span>
                        <span><i class="fas fa-star"></i> Tour VIP</span>
                    </div>
                    <div class="hotel-price">
                        <div class="price">$1,250 <small>/người</small></div>
                        <button class="btn-book">Đặt Tour</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FOOTER -->
<footer class="page-footer mt-5">
    <div class="container">
        <p>&copy; 2026 <a href="<?= BASEURL ?>/home">Skyline Ticket</a>. Dịch vụ Khách sạn & Tour được cung cấp bởi đối tác du lịch uy tín.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
