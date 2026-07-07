<?php
// app/Views/admin/flights_list.php
require_once '../app/Views/layouts/admin_header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div class="d-flex align-items-center">
        <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
            <a href="<?= BASEURL ?>/admin/dashboard" class="btn btn-outline-secondary btn-sm me-3 shadow-sm rounded-pill">
                <i class="fas fa-arrow-left"></i> Quay lại Dashboard
            </a>
        <?php endif; ?>
        <h2 class="h3 mb-0 text-gray-800 fw-bold"><i class="fas fa-plane me-2 text-primary"></i> Danh sách Chuyến bay</h2>
    </div>
    
    <!-- CHỈ ADMIN MỚI THẤY NÚT THÊM CHUYẾN BAY -->
    <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
        <a href="<?= BASEURL ?>/admin/flightmanager/create" class="btn btn-success shadow-sm fw-bold">
            <i class="fas fa-plus-circle me-1"></i> Thêm chuyến bay mới
        </a>
    <?php endif; ?>
</div>

<!-- Thanh tìm kiếm chuyến bay -->
<div class="card shadow-sm border-0 mb-4 rounded-3">
    <div class="card-body">
        <form action="<?= BASEURL ?>/admin/flightmanager" method="GET" class="row g-2 align-items-center">
            <div class="col-md-9">
                <input type="text" name="search" class="form-control" placeholder="Tìm kiếm theo mã chuyến bay, điểm đi, điểm đến..." value="<?= $_GET['search'] ?? '' ?>">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100 fw-bold"><i class="fas fa-search me-1"></i> Tìm kiếm</button>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm border-0 rounded-3">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light text-muted">
                <tr>
                    <th class="border-0">ID</th>
                    <th class="border-0">Mã chuyến bay</th>
                    <th class="border-0">Lộ trình</th>
                    <th class="border-0">Thời gian đi</th>
                    <th class="border-0">Giá cơ bản</th>
                    <th class="border-0">Số ghế</th>
                    <th class="border-0 text-end">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($data['flights'])): ?>
                    <?php foreach ($data['flights'] as $flight): ?>
                        <tr>
                            <td><?= $flight['id']; ?></td>
                            <td><span class="badge bg-primary fs-6"><?= $flight['flight_number'] ?? $flight['flight_code']; ?></span></td>
                            <td>
                                <strong><?= $flight['departure']; ?></strong>
                                <i class="fas fa-arrow-right mx-1 text-muted"></i>
                                <strong><?= $flight['destination']; ?></strong>
                            </td>
                            <td><?= date('d/m/Y H:i', strtotime($flight['departure_time'])); ?></td>
                            <td><span class="text-success fw-bold"><?= number_format($flight['price']); ?> đ</span></td>
                            <td>
                                <div class="progress" style="height: 20px;">
                                    <?php 
                                        $avail = $flight['available_seats'] ?? 0;
                                        $total = $flight['total_seats'] ?? 100;
                                        $percent = $total > 0 ? ($avail / $total) * 100 : 0;
                                        $color = $percent < 20 ? 'bg-danger' : 'bg-info';
                                    ?>
                                    <div class="progress-bar <?= $color ?>" role="progressbar" style="width: <?= $percent ?>%;" aria-valuenow="<?= $avail ?>" aria-valuemin="0" aria-valuemax="<?= $total ?>">
                                        <?= $avail; ?> / <?= $total; ?>
                                    </div>
                                </div>
                            </td>
                            <td class="text-end">
                                <!-- Nút cập nhật trạng thái chung -->
                                <a href="<?= BASEURL ?>/admin/flightmanager/updatePrice/<?= $flight['id']; ?>" class="btn btn-sm btn-outline-info" title="Cập nhật giá"><i class="fas fa-dollar-sign"></i></a>
                                
                                <!-- NÚT SỬA VÀ XÓA (CHỈ DÀNH CHO ADMIN) -->
                                <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                                    <a href="<?= BASEURL ?>/admin/flightmanager/edit/<?= $flight['id']; ?>" class="btn btn-sm btn-outline-secondary ms-1" title="Chỉnh sửa chi tiết"><i class="fas fa-edit"></i></a>
                                    <a href="<?= BASEURL ?>/admin/flightmanager/delete/<?= $flight['id']; ?>" class="btn btn-sm btn-outline-danger ms-1" title="Xóa chuyến bay" onclick="return confirm('Cảnh báo: Hành động này không thể hoàn tác. Bạn chắc chắn muốn xóa chuyến bay này?');"><i class="fas fa-trash"></i></a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="7" class="text-center py-4 text-muted">Không tìm thấy chuyến bay nào phù hợp.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
require_once '../app/Views/layouts/admin_footer.php';
?>