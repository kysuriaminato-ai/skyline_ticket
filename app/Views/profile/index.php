<?php require_once '../app/Views/layouts/header.php'; ?>

<div class="container my-5" style="min-height: 60vh;">
    <h2 class="mb-4" style="color: #005e6a;"><i class="fas fa-ticket-alt me-2"></i>Lịch sử đặt vé của bạn</h2>
    
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th>Mã đặt chỗ</th>
                            <th>Mã chuyến bay</th>
                            <th>Hành trình</th>
                            <th>Ngày đi</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($data['bookings'])): ?>
                            <tr><td colspan="6" class="text-center py-4">Bạn chưa có chuyến bay nào.</td></tr>
                        <?php else: ?>
                            <?php foreach ($data['bookings'] as $b): ?>
                                <tr>
                                    <td><strong class="text-danger"><?= $b['booking_code'] ?></strong></td>
                                    <td><strong><?= $b['flight_code'] ?></strong></td>
                                    <td><?= substr($b['departure'], 0, 3) ?> <i class="fas fa-arrow-right mx-1 text-muted"></i> <?= substr($b['destination'], 0, 3) ?></td>
                                    <td><?= date('d/m/Y H:i', strtotime($b['departure_time'])) ?></td>
                                    <td><?= number_format($b['total_price']) ?> VND</td>
                                    <td>
                                        <?php if($b['status'] == 'confirmed'): ?>
                                            <span class="badge bg-success">Đã xác nhận</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning text-dark">Chờ xử lý</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/Views/layouts/footer.php'; ?>
