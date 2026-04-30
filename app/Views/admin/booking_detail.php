<?php
// app/Views/admin/booking_detail.php
require_once '../app/Views/layouts/header.php';
?>

<div class="container mt-5">
    <h1 class="mb-4">Chi tiết Đặt chỗ</h1>

    <div class="card">
        <div class="card-header">Thông tin Đặt chỗ</div>
        <div class="card-body">
            <p><strong>ID:</strong> <?php echo $data['booking']['id']; ?></p>
            <p><strong>User ID:</strong> <?php echo $data['booking']['user_id']; ?></p>
            <p><strong>Flight ID:</strong> <?php echo $data['booking']['flight_id']; ?></p>
            <p><strong>Họ tên:</strong> <?php echo $data['booking']['fullname']; ?></p>
            <p><strong>Email:</strong> <?php echo $data['booking']['email']; ?></p>
            <p><strong>Điện thoại:</strong> <?php echo $data['booking']['phone']; ?></p>
            <p><strong>Hạng ghế:</strong> <?php echo $data['booking']['cabin_class']; ?></p>
            <p><strong>Tổng giá:</strong> <?php echo $data['booking']['total_price']; ?></p>
            <p><strong>Trạng thái:</strong> <?php echo $data['booking']['status']; ?></p>
            <p><strong>Ngày tạo:</strong> <?php echo $data['booking']['created_at']; ?></p>
        </div>
    </div>

    <h3 class="mt-4">Lịch sử Thanh toán</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
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