<?php
// app/Views/admin/bookings_list.php
require_once '../app/Views/layouts/admin_header.php';
?>

<h2 class="mb-4"><i class="fas fa-ticket-alt"></i> Danh sách Đặt chỗ</h2>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>Tổng giá</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['bookings'] as $booking): ?>
                    <tr>
                        <td><?php echo $booking['id']; ?></td>
                        <td><?php echo $booking['user_id']; ?></td>
                        <td><strong><?php echo $booking['fullname']; ?></strong></td>
                        <td><?php echo $booking['email']; ?></td>
                        <td><span class="badge bg-success"><?php echo number_format($booking['total_price']); ?> VND</span></td>
                        <td><span class="badge bg-info"><?php echo $booking['status'] ?? 'pending'; ?></span></td>
                        <td>
                            <a href="/admin/bookingmanager/viewDetail/<?php echo $booking['id']; ?>" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                            <a href="/admin/bookingmanager/edit/<?php echo $booking['id']; ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                            <a href="/admin/bookingmanager/delete/<?php echo $booking['id']; ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
require_once '../app/Views/layouts/admin_footer.php';
?>