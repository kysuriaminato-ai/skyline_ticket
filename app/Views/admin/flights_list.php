<?php
// app/Views/admin/flights_list.php
require_once '../app/Views/layouts/admin_header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-plane"></i> Danh sách Chuyến bay</h2>
    <a href="/admin/flightmanager/create" class="btn btn-success"><i class="fas fa-plus"></i> Thêm chuyến bay</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mã chuyến bay</th>
                    <th>Điểm khởi hành</th>
                    <th>Điểm đến</th>
                    <th>Thời gian</th>
                    <th>Giá</th>
                    <th>Ghế</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['flights'] as $flight): ?>
                    <tr>
                        <td><?php echo $flight['id']; ?></td>
                        <td><strong><?php echo $flight['flight_number']; ?></strong></td>
                        <td><?php echo $flight['departure']; ?></td>
                        <td><?php echo $flight['destination']; ?></td>
                        <td><?php echo $flight['departure_time']; ?></td>
                        <td><span class="badge bg-success"><?php echo number_format($flight['price']); ?> VND</span></td>
                        <td>
                            <span class="badge bg-info"><?php echo $flight['available_seats'] ?? 0; ?>/<?php echo $flight['total_seats'] ?? 0; ?></span>
                        </td>
                        <td>
                            <a href="/admin/flightmanager/updatePrice/<?php echo $flight['id']; ?>" class="btn btn-sm btn-info" title="Cập nhật giá"><i class="fas fa-dollar-sign"></i></a>
                            <a href="/admin/flightmanager/updateSeats/<?php echo $flight['id']; ?>" class="btn btn-sm btn-warning" title="Cập nhật ghế"><i class="fas fa-chairs"></i></a>
                            <a href="/admin/flightmanager/edit/<?php echo $flight['id']; ?>" class="btn btn-sm btn-secondary" title="Sửa"><i class="fas fa-edit"></i></a>
                            <a href="/admin/flightmanager/delete/<?php echo $flight['id']; ?>" class="btn btn-sm btn-danger" title="Xóa"><i class="fas fa-trash"></i></a>
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