<?php
// app/Views/admin/users_list.php
require_once '../app/Views/layouts/admin_header.php';
?>

<h2 class="mb-4"><i class="fas fa-users"></i> Danh sách Người dùng</h2>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>Quyền</th>
                    <th>Ngày tạo</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['users'] as $user): ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><strong><?php echo $user['fullname']; ?></strong></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><span class="badge bg-secondary"><?php echo $user['role'] ?? 'user'; ?></span></td>
                        <td><?php echo $user['created_at']; ?></td>
                        <td>
                            <a href="/admin/usermanager/updateRole/<?php echo $user['id']; ?>" class="btn btn-sm btn-info"><i class="fas fa-user-shield"></i></a>
                            <a href="/admin/usermanager/edit/<?php echo $user['id']; ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                            <a href="/admin/usermanager/delete/<?php echo $user['id']; ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
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