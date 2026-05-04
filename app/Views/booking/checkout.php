<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?? 'Thanh toán - Skyline Ticket' ?></title>
    <!-- Bootstrap 5 & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7f6; }
        .navbar { background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .brand-logo { font-weight: 800; font-size: 24px; color: #000; text-decoration: none; }
        .brand-logo span { color: #0d6efd; }
        
        .checkout-header {
            background-color: #005e6a;
            color: white;
            padding: 30px 0 60px;
            margin-bottom: -40px;
        }
        
        /* Box Chuyến bay đã chọn */
        .selected-flight-box {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            margin-bottom: 30px;
            position: relative;
            z-index: 10;
        }
        .flight-route-big { font-size: 24px; font-weight: 800; color: #333; margin-bottom: 5px; }
        .flight-date-badge { background: #e0f2f1; color: #005e6a; padding: 5px 12px; border-radius: 20px; font-size: 13px; font-weight: 700; display: inline-block; margin-bottom: 15px;}
        
        .timeline-box { display: flex; align-items: center; }
        .timeline-time { font-size: 20px; font-weight: 700; color: #333; }
        .timeline-airport { font-size: 14px; color: #666; }
        .timeline-line { flex: 1; height: 2px; background: #ddd; margin: 0 15px; position: relative; display: flex; align-items: center; justify-content: center;}
        .timeline-line i { position: absolute; background: white; padding: 0 5px; color: #005e6a; }

        /* Khối nhập thông tin & Thanh toán */
        .checkout-section {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            margin-bottom: 25px;
            border: 1px solid #eee;
        }
        .section-title {
            font-size: 18px;
            font-weight: 800;
            color: #333;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
            display: flex;
            align-items: center;
        }
        .section-title i { color: #005e6a; margin-right: 12px; font-size: 22px; }

        .form-label { font-weight: 600; color: #555; font-size: 14px; }
        .form-control, .form-select { border-radius: 8px; padding: 12px 15px; border: 1px solid #ced4da; }
        .form-control:focus, .form-select:focus { border-color: #005e6a; box-shadow: 0 0 0 0.2rem rgba(0, 94, 106, 0.2); }

        /* Cột Tóm tắt giá */
        .price-summary-box {
            background: #fbfcfc;
            border-radius: 12px;
            padding: 25px;
            border: 2px solid #005e6a;
            position: sticky;
            top: 20px;
        }
        .summary-row { display: flex; justify-content: space-between; margin-bottom: 12px; font-size: 14px; color: #555; }
        .summary-total { display: flex; justify-content: space-between; margin-top: 20px; padding-top: 20px; border-top: 2px dashed #ddd; font-size: 20px; font-weight: 800; color: #d32f2f; }

        .btn-pay {
            background-color: #eeb83e;
            color: #005e6a;
            font-weight: 800;
            padding: 15px;
            border-radius: 8px;
            border: none;
            width: 100%;
            font-size: 16px;
            margin-top: 20px;
            transition: 0.3s;
        }
        .btn-pay:hover { background-color: #dca028; transform: translateY(-2px); }

    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg py-3">
        <div class="container">
            <a class="brand-logo" href="<?= BASEURL ?>/home">SKYLINE<span>TICKET</span></a>
            <div class="d-flex align-items-center ms-auto">
                <span class="me-3 fw-bold"><i class="fas fa-user-circle"></i> Xin chào, <?= $_SESSION['user_name'] ?? 'Khách' ?></span>
            </div>
        </div>
    </nav>

    <!-- HEADER XANH -->
    <div class="checkout-header">
        <div class="container">
            <h2 class="fw-bold mb-0">Hoàn tất đặt vé & Thanh toán</h2>
            <p class="mb-0 text-white-50">Vui lòng điền thông tin hành khách chính xác như trên giấy tờ tùy thân.</p>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="container my-4">
        
        <?php 
        $flight = $data['flight'];
        $info = $data['booking_info'];
        $deptTime = date('H:i', strtotime($flight['departure_time']));
        $arrTime = date('H:i', strtotime($flight['arrival_time']));
        $flightDate = date('d/m/Y', strtotime($flight['departure_time']));
        
        // Tính thời gian bay
        $diff = strtotime($flight['arrival_time']) - strtotime($flight['departure_time']);
        $hours = floor($diff / 3600);
        $mins = floor(($diff % 3600) / 60);
        ?>

        <div class="row">
            <!-- CỘT TRÁI: THÔNG TIN HÀNH KHÁCH -->
            <div class="col-lg-8">
                
                <!-- Box Chuyến bay đã chọn -->
                <div class="selected-flight-box">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <div class="flight-route-big"><?= $flight['departure'] ?> <i class="fas fa-arrow-right mx-2 text-muted" style="font-size: 18px;"></i> <?= $flight['destination'] ?></div>
                            <div class="flight-date-badge"><i class="far fa-calendar-alt me-1"></i> <?= $flightDate ?> &nbsp;|&nbsp; <?= $info['class_name'] ?></div>
                        </div>
                        <div class="text-end">
                            <img src="https://booking.vietnamairlines.com/images/vna_logo.png" alt="Logo" style="width: 30px; background:#005e6a; border-radius:50%; margin-bottom:5px;">
                            <div class="fw-bold" style="font-size: 14px;"><?= $flight['flight_code'] ?></div>
                        </div>
                    </div>
                    
                    <div class="timeline-box mt-4">
                        <div class="text-center">
                            <div class="timeline-time"><?= $deptTime ?></div>
                            <div class="timeline-airport"><?= substr($flight['departure'], -4, 3) ?></div>
                        </div>
                        <div class="timeline-line">
                            <span style="position: absolute; top: -20px; font-size: 12px; color: #666; background: white; padding: 0 10px;"><?= $hours ?>h <?= $mins ?>p</span>
                            <i class="fas fa-plane"></i>
                        </div>
                        <div class="text-center">
                            <div class="timeline-time"><?= $arrTime ?></div>
                            <div class="timeline-airport"><?= substr($flight['destination'], -4, 3) ?></div>
                        </div>
                    </div>
                </div>

                <!-- Form Thông tin liên hệ -->
                <div class="checkout-section">
                    <div class="section-title"><i class="fas fa-address-book"></i> Thông tin liên hệ</div>
                    <form id="checkoutForm" action="<?= BASEURL ?>/booking/process" method="POST">
                        <input type="hidden" name="flight_id" value="<?= $flight['id'] ?>">
                        <input type="hidden" name="class" value="<?= $info['class'] ?>">
                        <input type="hidden" name="total_price" value="<?= $info['total_price'] ?>">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Họ tên <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="contact_name" value="<?= $_SESSION['user_name'] ?? '' ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Điện thoại <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" name="contact_phone" placeholder="Nhập số điện thoại" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="contact_email" placeholder="Vé điện tử sẽ gửi về email này" required>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Thông tin hành khách 1 -->
                <div class="checkout-section">
                    <div class="section-title"><i class="fas fa-user"></i> Hành khách 1 (Người lớn)</div>
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Danh xưng <span class="text-danger">*</span></label>
                            <select class="form-select" required form="checkoutForm">
                                <option value="Ông">Ông</option>
                                <option value="Bà">Bà</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Họ <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="VD: NGUYEN" required form="checkoutForm">
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">Đệm & Tên <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="VD: VAN A" required form="checkoutForm">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Ngày sinh <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" required form="checkoutForm">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Hành lý mua thêm</label>
                            <select class="form-select" form="checkoutForm">
                                <option value="0">Không mua thêm (Mặc định)</option>
                                <option value="150000">+ 10kg (150.000 VND)</option>
                                <option value="300000">+ 23kg (300.000 VND)</option>
                            </select>
                        </div>
                    </div>
                </div>

            </div>

            <!-- CỘT PHẢI: TÓM TẮT GIÁ -->
            <div class="col-lg-4">
                <div class="price-summary-box">
                    <h5 class="fw-bold mb-4" style="color: #005e6a;">Tóm tắt chi phí</h5>
                    
                    <div class="summary-row">
                        <span>Hành khách (x<?= $info['adults'] ?>)</span>
                        <span class="fw-bold"><?= number_format($info['price_per_pax'], 0, ',', '.') ?> VND</span>
                    </div>
                    <div class="summary-row">
                        <span>Thuế, Phí & Lệ phí</span>
                        <span>Đã bao gồm</span>
                    </div>
                    <div class="summary-row">
                        <span>Hành lý mua thêm</span>
                        <span>0 VND</span>
                    </div>

                    <div class="summary-total">
                        <span>Tổng cộng</span>
                        <span><?= number_format($info['total_price'], 0, ',', '.') ?> <small style="font-size: 14px;">VND</small></span>
                    </div>

                    <div class="mt-4">
                        <label class="form-label">Phương thức thanh toán</label>
                        <select class="form-select mb-3" name="payment_method" form="checkoutForm">
                            <option value="vnpay">Thanh toán VNPAY (QR/Thẻ nội địa)</option>
                            <option value="credit">Thẻ tín dụng (Visa/Mastercard)</option>
                            <option value="momo">Ví MoMo</option>
                        </select>
                    </div>

                    <button type="submit" form="checkoutForm" class="btn btn-pay">
                        THANH TOÁN NGAY
                    </button>
                    <div class="text-center mt-3 text-muted" style="font-size: 12px;">
                        <i class="fas fa-lock me-1 text-success"></i> Giao dịch được mã hóa an toàn
                    </div>
                </div>
            </div>

        </div>
    </div>

    <footer class="site-footer bg-white border-top py-4 mt-5">
        <div class="container text-center text-muted">
            <p class="mb-0">© 2026 Skyline Ticket. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>