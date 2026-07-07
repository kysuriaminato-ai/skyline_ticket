<?php
// app/Views/admin/user_role.php
require_once '../app/Views/layouts/header.php';
?>

<div class="container mt-5">
    <h1 class="mb-4">Cập nhật Quyền Người dùng</h1>

    <div class="card">
        <div class="card-body">
            <h5>Người dùng: <?php echo $data['user']['fullname']; ?> (<?php echo $data['user']['email']; ?>)</h5>
            <p>Quyền hiện tại: <?php echo $data['user']['role']; ?></p>

            <form action="/admin/usermanager/updateRole/<?php echo $data['user']['id']; ?>" method="post">
                <div class="form-group">
                    <label for="role">Quyền mới:</label>
                    <select class="form-control" id="role" name="role" required>
                        <option value="user" <?php echo $data['user']['role'] == 'user' ? 'selected' : ''; ?>>User</option>
                        <option value="admin" <?php echo $data['user']['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <a href="<?= BASEURL ?>/admin/usermanager" class="btn btn-secondary">Hủy</a>
            </form>
        </div>
    </div>
</div>

<?php
require_once '../app/Views/layouts/footer.php';
?>