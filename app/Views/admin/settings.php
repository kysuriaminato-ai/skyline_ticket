<?php
// app/Views/admin/settings.php
require_once '../app/Views/layouts/admin_header.php';
?>

<h2 class="mb-4"><i class="fas fa-cog"></i> Cài đặt Hệ thống</h2>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Cấu hình cơ bản</h5>
            </div>
            <div class="card-body">
                <form action="/admin/settings/update" method="post">
                    <div class="mb-3">
                        <label for="site_name" class="form-label">Tên trang web</label>
                        <input type="text" class="form-control" id="site_name" name="site_name" value="Skyline Ticket">
                    </div>
                    <div class="mb-3">
                        <label for="admin_email" class="form-label">Email Admin</label>
                        <input type="email" class="form-control" id="admin_email" name="admin_email" value="admin@skyline.com">
                    </div>
                    <div class="mb-3">
                        <label for="max_bookings" class="form-label">Số đặt chỗ tối đa</label>
                        <input type="number" class="form-control" id="max_bookings" name="max_bookings" value="100">
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Lưu cài đặt</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
require_once '../app/Views/layouts/admin_footer.php';
?>