<?php require_once '../app/Views/layouts/header.php'; ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white text-center py-3" style="background-color: #005e6a !important;">
                    <h4 class="mb-0 fw-bold"><i class="fas fa-qrcode me-2"></i>Thanh toán QR Code</h4>
                </div>
                <div class="card-body p-4 p-md-5 text-center">
                    
                    <h5 class="text-muted mb-2">Tổng số tiền cần thanh toán:</h5>
                    <h2 class="text-danger fw-bold mb-4"><?= number_format($data['booking']['total_price'], 0, ',', '.') ?> VND</h2>

                    <!-- Đồng hồ đếm ngược -->
                    <div class="alert alert-warning d-inline-block px-4 py-2 rounded-pill fw-bold" style="font-size: 18px;">
                        <i class="fas fa-clock me-2"></i>Thời gian giữ chỗ: <span id="timer" class="text-danger">10:00</span>
                    </div>

                    <p class="text-muted mt-3 mb-4">Vui lòng sử dụng ứng dụng Ngân hàng (hoặc MoMo/VNPAY) quét mã QR dưới đây để thanh toán tự động.</p>

                    <!-- Khung chứa ảnh QR -->
                    <div class="p-3 border rounded-4 d-inline-block bg-light mb-4 shadow-sm">
                        <?php 
                        // API tự động tạo mã VietQR theo số tiền
                        $qrAmount = $data['booking']['total_price'];
                        $qrInfo = "THANH TOAN VE " . $data['booking']['booking_code'];
                        // Dùng 1 ngân hàng giả lập, ở đây ví dụ MBBank, STK: 0123456789
                        $qrUrl = "https://img.vietqr.io/image/mbbank-0123456789-compact2.png?amount={$qrAmount}&addInfo=" . urlencode($qrInfo) . "&accountName=SKYLINE%20TICKET";
                        ?>
                        <img src="<?= $qrUrl ?>" alt="QR Code" class="img-fluid" style="max-width: 250px;">
                    </div>

                    <!-- Nút xác nhận giả lập thanh toán -->
                    <form action="<?= BASEURL ?>/booking/confirmPayment" method="POST" id="paymentForm">
                        <input type="hidden" name="booking_code" value="<?= $data['booking']['booking_code'] ?>">
                        <button type="submit" class="btn btn-lg w-100 fw-bold text-white shadow" style="background-color: #eeb83e; border-radius: 8px;">
                            <i class="fas fa-check-circle me-2"></i> TÔI ĐÃ THANH TOÁN THÀNH CÔNG
                        </button>
                    </form>
                    
                    <div class="mt-3">
                        <a href="<?= BASEURL ?>/booking/cancelBooking?code=<?= $data['booking']['booking_code'] ?>" class="text-muted text-decoration-none" onclick="return confirm('Bạn có chắc chắn muốn hủy giao dịch này không?');">Hủy giao dịch</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPTS ĐẾM NGƯỢC THỜI GIAN -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    let timeLeft = <?= $data['remaining_time'] ?>; 
    let bookingCode = "<?= $data['booking']['booking_code'] ?>";
    const timerElement = document.getElementById('timer');

    const countdown = setInterval(function() {
        if (timeLeft <= 0) {
            clearInterval(countdown);
            // Hết giờ -> Chuyển hướng về trang hủy
            window.location.href = "<?= BASEURL ?>/booking/cancelBooking?code=" + bookingCode;
            return;
        }

        // Tính phút và giây
        let minutes = Math.floor(timeLeft / 60);
        let seconds = timeLeft % 60;
        
        // Format hiển thị 00:00
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;
        
        timerElement.textContent = minutes + ":" + seconds;
        
        // Đổi màu đỏ khi sắp hết giờ (dưới 1 phút)
        if (timeLeft <= 60) {
            timerElement.classList.add('text-danger', 'animate-pulse');
        }

        timeLeft -= 1;
    }, 1000);
});
</script>

<?php require_once '../app/Views/layouts/footer.php'; ?>