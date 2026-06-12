<?php
// app/Views/admin/users_list.php
require_once '../app/Views/layouts/admin_header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 mb-0 text-gray-800 fw-bold"><i class="fas fa-users me-2 text-primary"></i> Quản lý Nhân viên & Người dùng</h2>
    
    <!-- CHỈ ADMIN MỚI ĐƯỢC THÊM TÀI KHOẢN -->
    <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
        <a href="<?= BASEURL ?>/admin/usermanager/create" class="btn btn-success shadow-sm fw-bold">
            <i class="fas fa-user-plus me-1"></i> Cấp tài khoản mới
        </a>
    <?php endif; ?>
</div>

<!-- Thanh tìm kiếm tài khoản -->
<div class="card shadow-sm border-0 mb-4 rounded-3">
    <div class="card-body">
        <form action="<?= BASEURL ?>/admin/usermanager" method="GET" class="row g-2 align-items-center">
            <div class="col-md-9">
                <input type="text" name="search" class="form-control" placeholder="Tìm kiếm theo Tên, Email hoặc Số điện thoại..." value="<?= $_GET['search'] ?? '' ?>">
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
                    <th class="border-0">Họ và Tên</th>
                    <th class="border-0">Email liên hệ</th>
                    <th class="border-0">Vai trò (Role)</th>
                    <th class="border-0">Ngày tham gia</th>
                    <th class="border-0 text-end">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($data['users'])): ?>
                    <?php foreach ($data['users'] as $user): ?>
                        <tr>
                            <td><?= $user['id']; ?></td>
                            <td><strong><?= htmlspecialchars($user['fullname'] ?? $user['name'] ?? 'Chưa cập nhật'); ?></strong></td>
                            <td><?= htmlspecialchars($user['email']); ?></td>
                            <td>
                                <?php if($user['role'] === 'admin'): ?>
                                    <span class="badge bg-danger"><i class="fas fa-crown me-1"></i> Quản trị viên</span>
                                <?php elseif($user['role'] === 'staff'): ?>
                                    <span class="badge bg-warning text-dark"><i class="fas fa-user-tie me-1"></i> Nhân viên</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary"><i class="fas fa-user me-1"></i> Khách hàng</span>
                                <?php endif; ?>
                            </td>
                            <td><?= date('d/m/Y', strtotime($user['created_at'] ?? 'now')); ?></td>
                            <td class="text-end">
                                <a href="<?= BASEURL ?>/admin/usermanager/view/<?= $user['id']; ?>" class="btn btn-sm btn-outline-info" title="Xem chi tiết"><i class="fas fa-eye"></i></a>
                                
                                <!-- CHỈ ADMIN MỚI THẤY NÚT SỬA VÀ XÓA -->
                                <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                                    <!-- Không cho phép tự xóa chính mình -->
                                    <?php if($user['id'] !== $_SESSION['user_id']): ?>
                                        <a href="<?= BASEURL ?>/admin/usermanager/edit/<?= $user['id']; ?>" class="btn btn-sm btn-outline-secondary ms-1" title="Chỉnh sửa thông tin"><i class="fas fa-user-edit"></i></a>
                                        <a href="<?= BASEURL ?>/admin/usermanager/delete/<?= $user['id']; ?>" class="btn btn-sm btn-outline-danger ms-1" title="Xóa tài khoản" onclick="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn tài khoản này?');"><i class="fas fa-trash"></i></a>
                                    <?php else: ?>
                                        <span class="badge bg-light text-muted ms-1">Đang đăng nhập</span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6" class="text-center py-4 text-muted">Không tìm thấy tài khoản nào phù hợp.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
require_once '../app/Views/layouts/admin_footer.php';
?>