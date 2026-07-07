<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7f6; color: #333; }
        .navbar { background: transparent; box-shadow: none; position: absolute; top: 0; left: 0; width: 100%; z-index: 10; }
        .brand-logo { font-weight: 800; font-size: 24px; color: #0c3547; text-decoration: none; }
        .brand-logo span { color: #fff; }
        
        .hero-header { 
            background: url('https://images.unsplash.com/photo-1436491865332-7a61a109cc05?q=80&w=2074&auto=format&fit=crop') no-repeat center center/cover;
            padding: 150px 0 100px; 
            color: #0c3547; 
            margin-bottom: 0; 
            position: relative;
        }
        .hero-header::before {
            content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%; 
            background: rgba(255,255,255,0.6);
        }
        .hero-header .container { position: relative; z-index: 1; }
        .hero-title { font-weight: 800; letter-spacing: -1px; text-shadow: 0 2px 10px rgba(255,255,255,0.8); }
        .hero-subtitle { opacity: 0.9; max-width: 600px; margin: 0 auto; line-height: 1.6; color: #0c3547; font-weight: 600; text-shadow: 0 2px 10px rgba(255,255,255,0.8); }

        .nav-pills-custom { background: white; padding: 10px; border-radius: 50px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); display: inline-flex; margin-top: -30px; position: relative; z-index: 10; }
        .nav-pills-custom .nav-link { border-radius: 50px; color: #555; font-weight: 600; padding: 12px 30px; transition: all 0.3s; }
        .nav-pills-custom .nav-link.active { background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%); color: white; box-shadow: 0 4px 15px rgba(243, 156, 18, 0.4); }
        .nav-pills-custom .nav-link:hover:not(.active) { background-color: #f8f9fa; color: #005e6a; }

        .content-section { background: white; border-radius: 20px; padding: 40px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); margin-bottom: 40px; }
        
        .anchor-nav { display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 40px; border-bottom: 1px solid #eee; padding-bottom: 20px; }
        .anchor-link { color: #0c3547; text-decoration: none; font-size: 14px; font-weight: 600; display: inline-flex; align-items: center; padding: 8px 15px; border-radius: 20px; background: #e0f2f1; transition: 0.3s; }
        .anchor-link:hover { background: #e67e22; color: white; }
        .anchor-link i { margin-right: 6px; font-size: 12px; }

        .feature-box { border: 1px solid #eee; border-radius: 12px; padding: 25px; transition: 0.3s; display: flex; align-items: flex-start; gap: 20px; height: 100%; }
        .feature-box:hover { box-shadow: 0 10px 20px rgba(0,0,0,0.05); border-color: #005e6a; transform: translateY(-5px); }
        .feature-icon { width: 50px; height: 50px; border-radius: 12px; background: #e0f2f1; color: #005e6a; display: flex; align-items: center; justify-content: center; font-size: 24px; flex-shrink: 0; }
        .feature-title { font-weight: bold; color: #333; margin-bottom: 10px; font-size: 16px; }
        .feature-text { color: #666; font-size: 14px; line-height: 1.6; margin: 0; }

        .rule-list { list-style: none; padding: 0; margin: 0; }
        .rule-list li { position: relative; padding-left: 25px; margin-bottom: 12px; color: #555; line-height: 1.6; }
        .rule-list li::before { content: '\f058'; font-family: 'Font Awesome 6 Free'; font-weight: 900; color: #005e6a; position: absolute; left: 0; top: 2px; }

        .suitcase-illustration { background: #f8f9fa; border-radius: 16px; padding: 30px; text-align: center; border: 2px dashed #ccc; }
        .formula { font-size: 24px; font-weight: bold; color: #005e6a; background: white; padding: 10px 20px; border-radius: 50px; display: inline-block; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }

        .btn-action { background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%); color: white; font-weight: 800; padding: 12px 30px; border-radius: 25px; border: none; transition: 0.3s; text-decoration: none; display: inline-block; margin-top: 15px; box-shadow: 0 4px 15px rgba(243, 156, 18, 0.4); }
        .btn-action:hover { background: linear-gradient(135deg, #e67e22 0%, #d35400 100%); transform: translateY(-2px); color: white; box-shadow: 0 8px 20px rgba(243, 156, 18, 0.6); }

        .section-heading { position: relative; padding-bottom: 15px; margin-bottom: 30px; font-weight: bold; color: #0c3547; }
        .section-heading::after { content: ''; position: absolute; left: 0; bottom: 0; width: 50px; height: 3px; background: #a1c4fd; border-radius: 3px; }

        .accordion-item { border: none; margin-bottom: 10px; border-radius: 12px !important; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.03); }
        .accordion-button { font-weight: 600; color: #333; padding: 20px; background: white; }
        .accordion-button:not(.collapsed) { background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%); color: white; box-shadow: none; }
        .accordion-button:focus { box-shadow: none; border-color: rgba(0,0,0,.125); }
        .accordion-button::after { filter: invert(1); }
        .accordion-button:not(.collapsed)::after { filter: brightness(0) invert(1); }
        .accordion-body { background: white; color: #666; line-height: 1.7; padding: 20px; border-top: 1px solid #eee; }

        .custom-table { box-shadow: 0 5px 20px rgba(0,0,0,0.02); border-radius: 12px; overflow: hidden; margin-bottom: 0; }
        .custom-table th { padding: 15px; font-weight: 600; text-transform: uppercase; font-size: 13px; letter-spacing: 0.5px; border-bottom-width: 0; }
        .custom-table td { padding: 15px; vertical-align: middle; border-color: #eee; }
        .custom-table tbody tr { transition: 0.2s; }
        .custom-table tbody tr:hover { background-color: #f0f9fa; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg py-3">
        <div class="container">
            <a class="brand-logo" href="<?= BASEURL ?>/home">SKYLINE<span>TICKET</span></a>
            <div class="d-flex align-items-center ms-auto">
                <a href="<?= BASEURL ?>/home" class="text-dark text-decoration-none me-4 fw-bold" style="color: #0c3547 !important;"><i class="fas fa-home me-1"></i> Trang chủ</a>
                <?php if (isset($_SESSION['user_name'])): ?>
                    <span class="me-3 fw-bold" style="color: #0c3547;"><i class="fas fa-user-circle"></i> Xin chào, <?= htmlspecialchars($_SESSION['user_name']) ?></span>
                    <a href="<?= BASEURL ?>/auth/logout" class="btn btn-outline-dark" style="border-color: #e67e22; color: #e67e22;">Đăng xuất</a>
                <?php else: ?>
                    <a href="<?= BASEURL ?>/auth/login" class="btn btn-outline-dark me-2 fw-bold px-4" style="border-color: #e67e22; color: #e67e22;">Đăng nhập</a>
                    <a href="<?= BASEURL ?>/auth/register" class="btn fw-bold px-4 text-white" style="background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%); border:none;">Đăng ký</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="hero-header text-center">
        <div class="container">
            <h1 class="hero-title mb-3">Mua thêm hành lý ký gửi</h1>
            <p class="hero-subtitle">Tối ưu chi phí và thêm phần thoải mái cho chuyến đi của bạn bằng cách mua trước hành lý hoặc mua ngay tại sân bay.</p>
        </div>
    </div>

    <div class="container text-center mb-5">
        <ul class="nav nav-pills nav-pills-custom" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-prepaid-tab" data-bs-toggle="pill" data-bs-target="#pills-prepaid" type="button" role="tab" aria-controls="pills-prepaid" aria-selected="true"><i class="fas fa-shopping-bag me-2"></i> Hành lý trả trước</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-airport-tab" data-bs-toggle="pill" data-bs-target="#pills-airport" type="button" role="tab" aria-controls="pills-airport" aria-selected="false"><i class="fas fa-plane-departure me-2"></i> Hành lý mua tại sân bay</button>
            </li>
        </ul>
    </div>

    <div class="container pb-5">
        <div class="tab-content" id="pills-tabContent">
            
            <!-- TAB HÀNH LÝ TRẢ TRƯỚC -->
            <div class="tab-pane fade show active" id="pills-prepaid" role="tabpanel" aria-labelledby="pills-prepaid-tab" tabindex="0">
                <div class="content-section">
                    <div class="anchor-nav">
                        <a href="#hl-linhhoat" class="anchor-link"><i class="fas fa-arrow-down"></i> Hành lý linh hoạt</a>
                        <a href="#hl-quydinh" class="anchor-link"><i class="fas fa-arrow-down"></i> Quy định kích thước</a>
                        <a href="#hl-cachmua" class="anchor-link"><i class="fas fa-arrow-down"></i> Cách mua</a>
                        <a href="#hl-mucgia" class="anchor-link"><i class="fas fa-arrow-down"></i> Mức giá</a>
                    </div>

                    <h3 class="section-heading" id="hl-linhhoat">Hành lý linh hoạt, hành trình trọn vẹn</h3>
                    <div class="row g-4 mb-5">
                        <div class="col-md-6">
                            <div class="feature-box">
                                <div class="feature-icon"><i class="fas fa-suitcase-rolling"></i></div>
                                <div>
                                    <h4 class="feature-title">Mua trước hành lý, tiết kiệm chi phí</h4>
                                    <p class="feature-text">Hướng dẫn mua trước hành lý để chuyến đi thêm trọn vẹn. Tiết kiệm lên đến 50% so với mua trực tiếp tại quầy làm thủ tục ở sân bay.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-box">
                                <div class="feature-icon"><i class="fas fa-hand-holding-usd"></i></div>
                                <div>
                                    <h4 class="feature-title">Lựa chọn mức hành lý phù hợp</h4>
                                    <p class="feature-text">Đa dạng các gói hành lý từ 5kg, 10kg, 15kg, 23kg đến 32kg, giúp bạn dễ dàng cân đối nhu cầu và ngân sách của chuyến bay.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h3 class="section-heading" id="hl-quydinh">Quy định về trọng lượng, kích thước của hành lý trả trước</h3>
                    <p class="text-muted mb-4">Hành khách phải đáp ứng quy định về kích thước và trọng lượng của kiện tiêu chuẩn như sau:</p>
                    <div class="row align-items-center mb-5">
                        <div class="col-md-6 mb-4 mb-md-0">
                            <ul class="rule-list">
                                <li>Kiện tiêu chuẩn có trọng lượng tối đa không quá <strong>23kg</strong> (Hạng phổ thông) hoặc <strong>32kg</strong> (Hạng thương gia).</li>
                                <li>Tổng kích thước 3 chiều (dài, rộng, cao) của mỗi kiện hành lý không được vượt quá <strong>158cm</strong> (62 inch).</li>
                                <li>Nếu vượt quá kích thước hoặc trọng lượng trên, hành lý sẽ được tính vào diện Hành lý quá khổ/quá trọng lượng chuẩn và thu thêm phí tại sân bay.</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <div class="suitcase-illustration">
                                <i class="fas fa-suitcase" style="font-size: 80px; color: #cbd5e1; margin-bottom: 20px;"></i><br>
                                <div>
                                    <span class="formula">A + B + C &le; 158cm</span>
                                </div>
                                <p class="text-muted small mt-3 px-3">Tổng kích thước Dài (A), Rộng (B) và Cao (C) không quá 158cm.</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 mb-5">
                            <h3 class="section-heading" id="hl-cachmua">Cách mua hành lý trả trước</h3>
                            <p class="text-muted mb-3">Hành khách có thể mua hành lý trả trước thông qua các hình thức sau:</p>
                            <ul class="rule-list">
                                <li><strong>Mua ngay khi đặt vé:</strong> Trong quá trình mua vé trực tuyến trên website hoặc ứng dụng Skyline Ticket.</li>
                                <li><strong>Mua sau khi đã có vé:</strong> Thông qua mục "Quản lý đặt chỗ" trên website (chậm nhất 6 tiếng trước giờ bay).</li>
                                <li>Liên hệ trực tiếp với Phòng vé hoặc Đại lý chính thức của Skyline Ticket.</li>
                            </ul>
                            <button type="button" class="btn-action mt-3" data-bs-toggle="modal" data-bs-target="#buyBaggageModal">Mua hành lý ngay</button>
                        </div>
                    </div>
                    
                    <!-- NEW MỨC GIÁ MUA HÀNH LÝ TRẢ TRƯỚC -->
                    <div class="row">
                        <div class="col-12">
                            <h3 class="section-heading" id="hl-mucgia">Mức giá mua hành lý trả trước</h3>
                            <p class="text-muted mb-4">Với hành lý trả trước, hành khách có thể mua kiện không quá 23kg với kích thước ba chiều không quá 158cm cho cả hành trình nội địa và quốc tế. Mức giá cước dưới đây chưa bao gồm thuế giá trị gia tăng.</p>
                            
                            <!-- Nội địa -->
                            <h4 class="fw-bold mb-3" style="color: #005e6a;">Hành trình nội địa</h4>
                            <p class="text-muted mb-3">Áp dụng trên chuyến bay do Skyline Ticket và đối tác khai thác.</p>
                            <ul class="rule-list mb-5">
                                <li><strong>Đối với vé xuất/đổi trước 01/06/2026:</strong> hành lý trả trước có mức giá 300.000 VND</li>
                                <li><strong>Đối với vé xuất/đổi từ 01/06/2026:</strong>
                                    <ul class="mt-2" style="list-style-type: disc; padding-left: 20px;">
                                        <li style="color: #666; margin-bottom: 8px;">Các chuyến bay khởi hành trong giai đoạn 01/06/2026-02/09/2026 và 01/12/2026-31/12/2026: hành lý trả trước có mức giá 350.000 VND</li>
                                        <li style="color: #666;">Các chuyến bay khởi hành trong giai đoạn khác: hành lý trả trước có mức giá 300.000 VND</li>
                                    </ul>
                                </li>
                            </ul>
                            
                            <!-- Quốc tế -->
                            <h4 class="fw-bold mb-4" style="color: #005e6a;">Hành trình quốc tế</h4>
                            
                            <!-- Bảng 1: Giai đoạn cao điểm -->
                            <h5 class="fw-bold mb-3">Giai đoạn cao điểm</h5>
                            <div class="table-responsive mb-4">
                                <table class="table custom-table table-bordered align-middle text-center">
                                    <thead style="background-color: #005e6a; color: white;">
                                        <tr>
                                            <th>Hành trình</th>
                                            <th>Giá cước</th>
                                            <th>Giai đoạn bay áp dụng</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-muted fw-medium">
                                        <tr>
                                            <td class="text-start">Việt Nam - Thái Lan/Lào/Malaysia/<br>Singapore/Campuchia/Indonesia/Philippines</td>
                                            <td>120</td>
                                            <td>- Từ 15/01 đến 28/02/2026<br>- Từ 20/05 đến 30/08/2026<br>- Từ 15/12 đến 31/12/2026</td>
                                        </tr>
                                        <tr>
                                            <td class="text-start">Việt Nam - Hàn Quốc/Trung Quốc/Nhật Bản/<br>Đài Loan/Hồng Kông/Ấn Độ</td>
                                            <td>150</td>
                                            <td>- Từ 15/01 đến 28/02/2026<br>- Từ 15/03 đến 15/04/2026<br>- Từ 01/10 đến 31/12/2026</td>
                                        </tr>
                                        <tr>
                                            <td class="text-start">Việt Nam - Anh/Pháp/Đức/Ý/Đan Mạch/Hà Lan</td>
                                            <td>200</td>
                                            <td>- Từ 15/01 đến 28/02/2026<br>- Từ 01/04 đến 15/04/2026<br>- Từ 20/06 đến 30/08/2026<br>- Từ 15/12 đến 31/12/2026</td>
                                        </tr>
                                        <tr>
                                            <td class="text-start">Việt Nam - Mỹ/Úc/Nga</td>
                                            <td>230</td>
                                            <td>- Từ 15/01 đến 28/02/2026<br>- Từ 20/06 đến 30/08/2026<br>- Từ 25/11 đến 31/12/2026</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="text-muted small fst-italic mt-2">Đồng tiền: USD</div>
                            </div>
                            
                            <!-- Bảng 2: Giai đoạn khác -->
                            <h5 class="fw-bold mb-3 mt-5">Giai đoạn khác</h5>
                            <div class="table-responsive mb-4">
                                <table class="table custom-table table-bordered align-middle text-center">
                                    <thead style="background-color: #008ba3; color: white;">
                                        <tr>
                                            <th class="text-start">TỪ/ĐẾN</th>
                                            <th>KHU VỰC A</th>
                                            <th>KHU VỰC B</th>
                                            <th>KHU VỰC C</th>
                                            <th>KHU VỰC D</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-muted fw-medium">
                                        <tr>
                                            <td class="text-start fw-bold" style="color:#005e6a;">Khu vực A</td>
                                            <td>80</td>
                                            <td>110</td>
                                            <td>150</td>
                                            <td>200</td>
                                        </tr>
                                        <tr>
                                            <td class="text-start fw-bold" style="color:#005e6a;">Khu vực B</td>
                                            <td>110</td>
                                            <td>110</td>
                                            <td>150</td>
                                            <td>200</td>
                                        </tr>
                                        <tr>
                                            <td class="text-start fw-bold" style="color:#005e6a;">Khu vực C</td>
                                            <td>150</td>
                                            <td>150</td>
                                            <td>150</td>
                                            <td>200</td>
                                        </tr>
                                        <tr>
                                            <td class="text-start fw-bold" style="color:#005e6a;">Khu vực D</td>
                                            <td>200</td>
                                            <td>200</td>
                                            <td>200</td>
                                            <td>200</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="text-muted small fst-italic mt-2">Đồng tiền: USD</div>
                            </div>
                            
                            <!-- Lưu ý khu vực -->
                            <div class="alert alert-light border mt-4 mb-0" style="border-radius: 12px;">
                                <p class="fw-bold mb-2 text-dark"><i class="fas fa-exclamation-circle text-warning me-2"></i> Lưu ý</p>
                                <p class="text-muted small mb-2">Khu vực bao gồm các quốc gia sau:</p>
                                <ul class="text-muted small ps-3 mb-0" style="line-height: 1.8;">
                                    <li><strong>Khu vực A:</strong> Việt Nam, Thái Lan, Indonesia, Malaysia, Singapore, Lào, Campuchia, Myanmar, Philippines, Hồng Kông và Ma Cao.</li>
                                    <li><strong>Khu vực B:</strong> Đài Loan, Trung Quốc, Hàn Quốc, Nhật Bản, Ấn Độ, các nước thuộc châu Á (trừ khu vực A).</li>
                                    <li><strong>Khu vực C:</strong> Pháp, Đức, Anh, Ý, Đan Mạch, Hà Lan, các nước Châu Âu/Châu Phi/Trung Đông khác.</li>
                                    <li><strong>Khu vực D:</strong> Úc, Nga, Mỹ và các nước thuộc Châu Mỹ.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB HÀNH LÝ MUA TẠI SÂN BAY -->
            <div class="tab-pane fade" id="pills-airport" role="tabpanel" aria-labelledby="pills-airport-tab" tabindex="0">
                <div class="content-section">
                    <div class="anchor-nav">
                        <a href="#sb-trainghiem" class="anchor-link"><i class="fas fa-arrow-down"></i> Trải nghiệm thuận tiện</a>
                        <a href="#sb-tieuchuan" class="anchor-link"><i class="fas fa-arrow-down"></i> Tiêu chuẩn tính cước</a>
                        <a href="#sb-cachmua" class="anchor-link"><i class="fas fa-arrow-down"></i> Cách mua</a>
                        <a href="#sb-faq" class="anchor-link"><i class="fas fa-arrow-down"></i> Câu hỏi thường gặp</a>
                    </div>

                    <h3 class="section-heading" id="sb-trainghiem">Trải nghiệm thuận tiện</h3>
                    <div class="row g-4 mb-5">
                        <div class="col-md-6">
                            <div class="feature-box">
                                <div class="feature-icon"><i class="fas fa-clipboard-check"></i></div>
                                <div>
                                    <h4 class="feature-title">Dễ dàng mua thêm tại sân bay</h4>
                                    <p class="feature-text">Giải quyết nhanh chóng các phát sinh về hành lý ngay tại quầy làm thủ tục trước chuyến bay.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-box">
                                <div class="feature-icon"><i class="fas fa-boxes"></i></div>
                                <div>
                                    <h4 class="feature-title">Thoải mái mang theo vật dụng</h4>
                                    <p class="feature-text">Mang theo bất cứ thứ gì cần thiết cho công việc hay làm quà lưu niệm mà không lo bị từ chối vận chuyển.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h3 class="section-heading" id="sb-tieuchuan">Tiêu chuẩn hành lý tính cước tại sân bay</h3>
                    <p class="text-muted mb-4">Hành lý quá cước tại sân bay được chia thành các loại: mua thêm kiện chuẩn, kiện quá kích thước, và kiện quá trọng lượng.</p>
                    
                    <div class="mb-4">
                        <h5 class="fw-bold text-dark"><i class="fas fa-box me-2" style="color: #005e6a;"></i>Kiện mua thêm tiêu chuẩn</h5>
                        <p class="text-muted ps-4">Hành khách nội địa và quốc tế mua thêm các kiện có trọng lượng không quá 23kg và kích thước 3 chiều không vượt quá 158cm.</p>
                    </div>
                    
                    <div class="mb-4">
                        <h5 class="fw-bold text-dark"><i class="fas fa-expand-arrows-alt me-2" style="color: #005e6a;"></i>Kiện quá kích thước chuẩn</h5>
                        <p class="text-muted ps-4">Kiện hành lý có tổng kích thước 3 chiều vượt quá tiêu chuẩn 158cm (lên đến tối đa 203cm).</p>
                    </div>
                    
                    <div class="mb-5">
                        <h5 class="fw-bold text-dark"><i class="fas fa-weight-hanging me-2" style="color: #005e6a;"></i>Kiện quá trọng lượng chuẩn</h5>
                        <p class="text-muted ps-4">Kiện hành lý vượt quá trọng lượng miễn cước tiêu chuẩn (ví dụ từ 24kg đến 32kg đối với hạng phổ thông).</p>
                        <div class="alert alert-warning ms-4 mt-2 border-0" style="background-color: #fff8e1;">
                            <strong>Lưu ý:</strong> Nếu một kiện hành lý vượt cả kích thước chuẩn và trọng lượng chuẩn, hành khách sẽ phải trả mức phí tổng hợp cho cả 2 loại quá cước này.
                        </div>
                    </div>

                    <h3 class="section-heading" id="sb-cachmua">Cách mua & Mức giá</h3>
                    <p class="text-muted mb-4">Hành khách có thể mua hành lý tính cước tại các quầy làm thủ tục của sân bay hoặc tại văn phòng vé sân bay trong thời gian mở quầy check-in.</p>
                    <p class="text-muted mb-5">Mức giá mua tại sân bay thường sẽ cao hơn từ 30% - 50% so với mua trả trước qua website. Vui lòng liên hệ nhân viên sân bay để được báo giá chính xác dựa trên thực tế kiện hành lý.</p>

                    <h3 class="section-heading" id="sb-faq">Câu hỏi thường gặp</h3>
                    <div class="accordion" id="airportFaq">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqOne">
                                    Tôi có được đổi hành lý trả trước sang chuyến bay mới khi đã thay đổi chuyến bay/hành trình không?
                                </button>
                            </h2>
                            <div id="faqOne" class="accordion-collapse collapse show" data-bs-parent="#airportFaq">
                                <div class="accordion-body">
                                    Được. Nếu bạn thực hiện đổi vé hợp lệ sang một chuyến bay khác do Skyline Ticket khai thác, hành lý trả trước chưa sử dụng sẽ được chuyển sang chuyến bay mới (cùng mức giá hoặc bù chênh lệch nếu có).
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqTwo">
                                    Đã thay đổi kế hoạch, tôi có được hoàn hoặc chuyển nhượng hành lý trả trước đã mua?
                                </button>
                            </h2>
                            <div id="faqTwo" class="accordion-collapse collapse" data-bs-parent="#airportFaq">
                                <div class="accordion-body">
                                    Rất tiếc là không. Hành lý trả trước không được phép hoàn lại phí (trừ trường hợp hãng hủy chuyến) và không được chuyển nhượng cho hành khách khác dưới mọi hình thức.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqThree">
                                    Tôi có thể mua thêm hành lý ký gửi tại sân bay bằng cách nào?
                                </button>
                            </h2>
                            <div id="faqThree" class="accordion-collapse collapse" data-bs-parent="#airportFaq">
                                <div class="accordion-body">
                                    Bạn có thể mua trực tiếp tại Quầy làm thủ tục (Check-in counter) hoặc Quầy vé giờ chót tại sân bay. Thanh toán có thể thực hiện bằng tiền mặt hoặc thẻ tín dụng.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- MODAL MUA HÀNH LÝ -->
    <div class="modal fade" id="buyBaggageModal" tabindex="-1" aria-labelledby="buyBaggageModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 15px; overflow: hidden;">
          <div class="modal-header" style="background: linear-gradient(135deg, #a1c4fd 0%, #c2e9fb 100%); color: #0c3547;">
            <h5 class="modal-title fw-bold" id="buyBaggageModalLabel"><i class="fas fa-suitcase-rolling me-2"></i>Mua thêm hành lý trả trước</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-4" id="modalBody">
            <!-- STEP 1: TÌM KIẾM -->
            <div id="stepSearch">
                <p class="text-muted mb-4">Vui lòng nhập thông tin để hệ thống tìm kiếm chuyến bay của bạn.</p>
                <div class="mb-3">
                    <label class="form-label fw-bold" style="color: #0c3547;">Mã đặt chỗ (PNR) / Số vé</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-ticket-alt text-muted"></i></span>
                        <input type="text" id="pnrInput" class="form-control border-start-0" placeholder="VD: BK-A1B2">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold" style="color: #0c3547;">Họ khách hàng</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-user text-muted"></i></span>
                        <input type="text" id="lastNameInput" class="form-control border-start-0" placeholder="Nhập họ (không dấu)">
                    </div>
                </div>
                <button type="button" class="btn text-white w-100 fw-bold py-2" style="border-radius: 25px; background: linear-gradient(135deg, #e07a5f 0%, #f4a58a 100%); box-shadow: 0 4px 15px rgba(224, 122, 95, 0.3);" onclick="nextStep()" onmouseover="this.style.background='linear-gradient(135deg, #c4694f 0%, #e07a5f 100%)'" onmouseout="this.style.background='linear-gradient(135deg, #e07a5f 0%, #f4a58a 100%)'">Tiếp tục <i class="fas fa-arrow-right ms-1"></i></button>
            </div>

            <!-- STEP 2: CHỌN GÓI HÀNH LÝ -->
            <div id="stepSelect" style="display: none;">
                <div class="alert alert-success d-flex align-items-center mb-4" role="alert">
                  <i class="fas fa-check-circle fs-4 me-3"></i>
                  <div>
                    Tìm thấy chuyến bay <strong>HAN - MEL</strong> của hành khách <strong id="displayLastName"></strong>.
                  </div>
                </div>
                
                <h6 class="fw-bold mb-3" style="color: #0c3547;">Chọn gói hành lý muốn mua thêm:</h6>
                
                <!-- Gói 10kg -->
                <label class="w-100 mb-3" style="cursor: pointer;">
                    <input type="radio" name="baggage_package" value="300000" class="d-none peer-radio">
                    <div class="border rounded-3 p-3 transition-all package-box d-flex justify-content-between align-items-center">
                        <div>
                            <div class="fw-bold fs-5 text-dark">Gói 10kg</div>
                            <div class="small text-muted">Kiện chuẩn, tổng kích thước ≤ 158cm</div>
                        </div>
                        <div class="fw-bold fs-5" style="color: #0c3547;">300.000 VNĐ</div>
                    </div>
                </label>

                <!-- Gói 23kg -->
                <label class="w-100 mb-3" style="cursor: pointer;">
                    <input type="radio" name="baggage_package" value="600000" class="d-none peer-radio" checked>
                    <div class="border rounded-3 p-3 transition-all package-box d-flex justify-content-between align-items-center" style="border-color: #a1c4fd !important; background-color: #f0f6ff;">
                        <div>
                            <div class="fw-bold fs-5 text-dark">Gói 23kg <span class="badge text-white ms-2" style="background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);">Phổ biến</span></div>
                            <div class="small text-muted">Kiện chuẩn, tổng kích thước ≤ 158cm</div>
                        </div>
                        <div class="fw-bold fs-5" style="color: #0c3547;">600.000 VNĐ</div>
                    </div>
                </label>

                <!-- Gói 32kg -->
                <label class="w-100 mb-4" style="cursor: pointer;">
                    <input type="radio" name="baggage_package" value="900000" class="d-none peer-radio">
                    <div class="border rounded-3 p-3 transition-all package-box d-flex justify-content-between align-items-center">
                        <div>
                            <div class="fw-bold fs-5 text-dark">Gói 32kg</div>
                            <div class="small text-muted">Dành cho hạng Thương gia</div>
                        </div>
                        <div class="fw-bold fs-5" style="color: #0c3547;">900.000 VNĐ</div>
                    </div>
                </label>

                <div class="d-flex justify-content-between align-items-center border-top pt-3">
                    <div>
                        <div class="text-muted small">Tổng thanh toán</div>
                        <div class="fw-bold fs-4 text-danger" id="totalPriceDisplay">600.000 VNĐ</div>
                    </div>
                    <button type="button" class="btn text-white fw-bold px-4 py-2" style="border-radius: 25px; background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%); box-shadow: 0 4px 15px rgba(243, 156, 18, 0.3);" onclick="processPayment()" onmouseover="this.style.background='linear-gradient(135deg, #e67e22 0%, #d35400 100%)'" onmouseout="this.style.background='linear-gradient(135deg, #f39c12 0%, #e67e22 100%)'">Thanh toán ngay</button>
                </div>
            </div>
            
            <!-- STEP 3: THÀNH CÔNG -->
            <div id="stepSuccess" class="text-center py-4" style="display: none;">
                <i class="fas fa-check-circle text-success mb-3" style="font-size: 60px;"></i>
                <h4 class="fw-bold text-dark">Thanh toán thành công!</h4>
                <p class="text-muted mb-4">Hành lý đã được thêm vào vé của bạn. Hóa đơn và vé điện tử cập nhật đã được gửi qua Email.</p>
                <a href="<?= BASEURL ?>/home" class="btn btn-outline-secondary px-4 fw-bold" style="border-radius: 20px;">Trở về trang chủ</a>
            </div>

          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // CSS for dynamic modal parts
        const style = document.createElement('style');
        style.innerHTML = `
            .package-box { border-color: #dee2e6; }
            .peer-radio:checked + .package-box { border-color: #a1c4fd !important; background-color: #f0f6ff; box-shadow: 0 4px 10px rgba(161, 196, 253, 0.3); }
            .transition-all { transition: all 0.2s ease; }
        `;
        document.head.appendChild(style);

        // Update radio buttons selection style
        const radios = document.querySelectorAll('input[name="baggage_package"]');
        const priceDisplay = document.getElementById('totalPriceDisplay');
        radios.forEach(radio => {
            radio.addEventListener('change', function() {
                // Reset all boxes
                document.querySelectorAll('.package-box').forEach(box => {
                    box.style.borderColor = '#dee2e6';
                    box.style.backgroundColor = '#fff';
                });
                // Highlight selected
                if(this.checked) {
                    this.nextElementSibling.style.borderColor = '#a1c4fd';
                    this.nextElementSibling.style.backgroundColor = '#f0f6ff';
                    priceDisplay.innerText = new Intl.NumberFormat('vi-VN').format(this.value) + ' VNĐ';
                }
            });
        });

        function nextStep() {
            const pnr = document.getElementById('pnrInput').value;
            const lastName = document.getElementById('lastNameInput').value;
            
            if(!pnr || !lastName) {
                alert("Vui lòng nhập đầy đủ Mã đặt chỗ và Họ khách hàng!");
                return;
            }
            
            document.getElementById('displayLastName').innerText = lastName.toUpperCase();
            
            // Fade out step 1 and show step 2
            document.getElementById('stepSearch').style.display = 'none';
            document.getElementById('stepSelect').style.display = 'block';
        }

        function processPayment() {
            // Fake processing
            const btn = event.target;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang xử lý...';
            btn.disabled = true;
            
            setTimeout(() => {
                document.getElementById('stepSelect').style.display = 'none';
                document.getElementById('stepSuccess').style.display = 'block';
            }, 1500);
        }
        
        // Reset modal when closed
        document.getElementById('buyBaggageModal').addEventListener('hidden.bs.modal', function () {
            document.getElementById('stepSearch').style.display = 'block';
            document.getElementById('stepSelect').style.display = 'none';
            document.getElementById('stepSuccess').style.display = 'none';
            document.getElementById('pnrInput').value = '';
            document.getElementById('lastNameInput').value = '';
        });
    </script>
</body>
</html>
