<?php
// app/Views/admin/flight_price.php
require_once '../app/Views/layouts/header.php';
?>

<div class="container mt-5">
    <h1 class="mb-4">Cập nhật Giá Vé</h1>

    <div class="card">
        <div class="card-body">
            <h5>Chuyến bay: <?php echo $data['flight']['flight_number']; ?> - <?php echo $data['flight']['departure']; ?> đến <?php echo $data['flight']['destination']; ?></h5>
            <p>Giá hiện tại: <?php echo $data['flight']['price']; ?> VND</p>

            <form action="/admin/flightmanager/updatePrice/<?php echo $data['flight']['id']; ?>" method="post">
                <div class="form-group">
                    <label for="price">Giá mới:</label>
                    <input type="number" class="form-control" id="price" name="price" value="<?php echo $data['flight']['price']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <a href="/admin/flightmanager" class="btn btn-secondary">Hủy</a>
            </form>
        </div>
    </div>
</div>

<?php
require_once '../app/Views/layouts/footer.php';
?>