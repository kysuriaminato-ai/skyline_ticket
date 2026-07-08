<?php require_once '../app/Views/layouts/header.php'; ?>

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
        <h2 class="fw-bold mb-0" style="color: #005e6a;"><i class="fas fa-history me-2"></i> Lịch sử thanh toán & Đặt vé</h2>
        <a href="<?= BASEURL ?>/home" class="btn btn-outline-secondary rounded-pill px-4">
            <i class="fas fa-arrow-left me-2"></i> Trở về Trang chủ
        </a>
    </div>

    <?php if (empty($data['bookings'])): ?>
        <div class="text-center py-5 bg-light rounded-4 shadow-sm">
            <img src="https://cdn-icons-png.flaticon.com/512/1076/1076335.png" alt="No Data" style="width: 120px; opacity: 0.5;" class="mb-4">
            <h4 class="text-muted fw-bold">Bạn chưa có lịch sử đặt vé nào!</h4>
            <p class="text-secondary mb-4">Hãy trải nghiệm các chuyến bay tuyệt vời cùng Skyline Ticket ngay hôm nay.</p>
            <a href="<?= BASEURL ?>/home" class="btn btn-primary px-5 py-2 rounded-pill fw-bold shadow-sm" style="background-color: #005e6a; border: none;">
                Đặt vé ngay
            </a>
        </div>
    <?php else: ?>
        <div class="table-responsive bg-white rounded-4 shadow-sm p-4 border">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-muted" style="border-radius: 10px;">
                    <tr>
                        <th class="py-3 px-4">Mã Đặt Chỗ</th>
                        <th class="py-3">Chuyến Bay</th>
                        <th class="py-3">Thời gian đi</th>
                        <th class="py-3 text-center">Số vé</th>
                        <th class="py-3 text-end">Tổng tiền</th>
                        <th class="py-3 text-center">Trạng thái</th>
                        <th class="py-3 text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['bookings'] as $booking): ?>
                        <tr>
                            <td class="px-4">
                                <span class="badge bg-primary fs-6 px-3 py-2 rounded-pill">
                                    <?= htmlspecialchars($booking['booking_code']) ?>
                                </span>
                            </td>
                            <td>
                                <div class="fw-bold text-dark">
                                    <i class="fas fa-plane-departure text-muted me-1"></i> <?= htmlspecialchars($booking['flight_code']) ?>
                                </div>
                                <small class="text-muted">
                                    <?= htmlspecialchars(explode(',', $booking['departure'])[0]) ?> 
                                    <i class="fas fa-long-arrow-alt-right mx-1"></i> 
                                    <?= htmlspecialchars(explode(',', $booking['destination'])[0]) ?>
                                </small>
                            </td>
                            <td>
                                <div class="fw-bold"><?= date('d/m/Y', strtotime($booking['departure_time'])) ?></div>
                                <small class="text-muted"><?= date('H:i', strtotime($booking['departure_time'])) ?></small>
                            </td>
                            <td class="text-center fw-bold">
                                <?= $booking['passengers_count'] ?> <i class="fas fa-user-friends text-muted"></i>
                            </td>
                            <td class="text-end fw-bold text-danger">
                                <?= number_format($booking['total_price'], 0, ',', '.') ?>đ
                            </td>
                            <td class="text-center">
                                <?php if ($booking['status'] === 'pending'): ?>
                                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill"><i class="fas fa-clock me-1"></i> Đang chờ</span>
                                <?php elseif ($booking['status'] === 'confirmed'): ?>
                                    <span class="badge bg-success px-3 py-2 rounded-pill"><i class="fas fa-check-circle me-1"></i> Đã thanh toán</span>
                                <?php elseif ($booking['status'] === 'cancelled'): ?>
                                    <span class="badge bg-danger px-3 py-2 rounded-pill"><i class="fas fa-times-circle me-1"></i> Đã hủy</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary px-3 py-2 rounded-pill"><?= htmlspecialchars($booking['status']) ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if ($booking['status'] === 'pending'): ?>
                                    <a href="<?= BASEURL ?>/booking/payment?code=<?= $booking['booking_code'] ?>" class="btn btn-sm btn-info text-white rounded-pill px-3 shadow-sm" title="Thanh toán ngay">
                                        <i class="fas fa-money-bill-wave"></i> Thanh toán
                                    </a>
                                <?php else: ?>
                                    <button class="btn btn-sm btn-outline-secondary rounded-pill px-3" disabled>
                                        <i class="fas fa-eye"></i> Chi tiết
                                    </button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php require_once '../app/Views/layouts/footer.php'; ?>
