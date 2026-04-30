<?php
// app/Views/admin/reports_detailed.php
require_once '../app/Views/layouts/header.php';
?>

<div class="container mt-5">
    <h1 class="mb-4">Báo cáo Chi tiết</h1>

    <h3>Đặt chỗ</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Flight ID</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>Tổng giá</th>
                <th>Trạng thái</th>
                <th>Ngày tạo</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['bookings'] as $booking): ?>
                <tr>
                    <td><?php echo $booking['id']; ?></td>
                    <td><?php echo $booking['user_id']; ?></td>
                    <td><?php echo $booking['flight_id']; ?></td>
                    <td><?php echo $booking['fullname']; ?></td>
                    <td><?php echo $booking['email']; ?></td>
                    <td><?php echo $booking['total_price']; ?></td>
                    <td><?php echo $booking['status']; ?></td>
                    <td><?php echo $booking['created_at']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3 class="mt-5">Thanh toán</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Booking ID</th>
                <th>Số tiền</th>
                <th>Phương thức</th>
                <th>Trạng thái</th>
                <th>Ngày tạo</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['payments'] as $payment): ?>
                <tr>
                    <td><?php echo $payment['id']; ?></td>
                    <td><?php echo $payment['booking_id']; ?></td>
                    <td><?php echo $payment['amount']; ?></td>
                    <td><?php echo $payment['payment_method']; ?></td>
                    <td><?php echo $payment['status']; ?></td>
                    <td><?php echo $payment['created_at']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
require_once '../app/Views/layouts/footer.php';
?>