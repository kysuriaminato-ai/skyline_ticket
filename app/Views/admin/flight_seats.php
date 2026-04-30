<?php
// app/Views/admin/flight_seats.php
require_once '../app/Views/layouts/header.php';
?>

<div class="container mt-5">
    <h1 class="mb-4">Cập nhật Ghế</h1>

    <div class="card">
        <div class="card-body">
            <h5>Chuyến bay: <?php echo $data['flight']['flight_number']; ?> - <?php echo $data['flight']['departure']; ?> đến <?php echo $data['flight']['destination']; ?></h5>
            <p>Tổng ghế hiện tại: <?php echo $data['flight']['total_seats']; ?></p>
            <p>Ghế trống: <?php echo $data['flight']['available_seats']; ?></p>

            <form action="/admin/flightmanager/updateSeats/<?php echo $data['flight']['id']; ?>" method="post">
                <div class="form-group">
                    <label for="total_seats">Tổng số ghế:</label>
                    <input type="number" class="form-control" id="total_seats" name="total_seats" value="<?php echo $data['flight']['total_seats']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="available_seats">Ghế trống:</label>
                    <input type="number" class="form-control" id="available_seats" name="available_seats" value="<?php echo $data['flight']['available_seats']; ?>" required>
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