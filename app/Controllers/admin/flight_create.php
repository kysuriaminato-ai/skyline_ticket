<?php
// app/Views/admin/flight_create.php
require_once '../app/Views/layouts/admin_header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 mb-0 text-gray-800 fw-bold"><i class="fas fa-plus-circle me-2 text-primary"></i> Thêm Chuyến Bay Mới</h2>
    <a href="<?= BASEURL ?>/admin/flightmanager" class="btn btn-secondary shadow-sm fw-bold">
        <i class="fas fa-arrow-left me-1"></i> Quay lại
    </a>
</div>

<div class="card shadow-sm border-0 rounded-3 mb-5">
    <div class="card-header bg-white py-3 border-bottom-0">
        <h6 class="m-0 font-weight-bold text-primary">Thông tin chi tiết chuyến bay</h6>
    </div>
    <div class="card-body px-4 pb-4">
        <form action="<?= BASEURL ?>/admin/flightmanager/store" method="POST">
            <div class="row g-3">
                <div class="col-md-6 mb-3">
                    <label for="flight_code" class="form-label fw-bold">Mã chuyến bay (Ký hiệu)</label>
                    <input type="text" class="form-control" id="flight_code" name="flight_code" placeholder="VD: VN 273, VJ 101" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="airlines" class="form-label fw-bold">Hãng Hàng Không</label>
                    <select class="form-select" id="airlines" name="airlines" required>
                        <option value="Vietnam Airlines">Vietnam Airlines</option>
                        <option value="Vietjet Air">Vietjet Air</option>
                        <option value="Bamboo Airways">Bamboo Airways</option>
                        <option value="Singapore Airlines">Singapore Airlines</option>
                        <option value="Thai Airways">Thai Airways</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="departure" class="form-label fw-bold">Điểm Đi</label>
                    <input type="text" class="form-control" id="departure" name="departure" placeholder="VD: Hà Nội (HAN)" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="destination" class="form-label fw-bold">Điểm Đến</label>
                    <input type="text" class="form-control" id="destination" name="destination" placeholder="VD: TP Hồ Chí Minh (SGN)" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="departure_time" class="form-label fw-bold">Thời gian cất cánh</label>
                    <input type="datetime-local" class="form-control" id="departure_time" name="departure_time" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="arrival_time" class="form-label fw-bold">Thời gian hạ cánh (Dự kiến)</label>
                    <input type="datetime-local" class="form-control" id="arrival_time" name="arrival_time" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="price" class="form-label fw-bold">Giá vé cơ bản (VND)</label>
                    <input type="number" class="form-control" id="price" name="price" placeholder="VD: 1500000" min="0" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="total_seats" class="form-label fw-bold">Tổng số ghế</label>
                    <input type="number" class="form-control" id="total_seats" name="total_seats" value="180" min="10" required>
                </div>
            </div>

            <hr class="mt-4 mb-4">
            
            <div class="text-end">
                <button type="submit" class="btn btn-primary px-5 fw-bold"><i class="fas fa-save me-1"></i> Lưu Chuyến Bay</button>
            </div>
        </form>
    </div>
</div>

<?php
require_once '../app/Views/layouts/admin_footer.php';
?>