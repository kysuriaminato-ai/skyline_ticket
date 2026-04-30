<!-- app/Views/flights/list.php -->
<?php require_once '../app/Views/layouts/header.php'; ?>
<?php extract($data['search_params']); // Trích xuất các biến $from, $to... từ mảng ?>

<div class="bg-primary text-white py-4" style="background-color: var(--primary-color) !important;">
    <div class="container text-center">
        <h3 class="mb-0 fw-bold">Danh Sách Chuyến Bay</h3>
    </div>
</div>

<div class="container my-4">
    <div class="row">
        <!-- Cột trái: BỘ LỌC TÌM KIẾM -->
        <div class="col-lg-3 mb-4">
            <form action="<?= BASEURL ?>/flight" method="GET" id="mainSearchForm">
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h5 class="fw-bold mb-4"><i class="fas fa-search me-2 text-primary"></i>Tìm kiếm</h5>
                    <!-- Form input Điểm đi, điểm đến giống hệt code cũ của bạn -->
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Điểm đi (Mã sân bay)</label>
                        <input type="text" class="form-control" name="from" value="<?= htmlspecialchars($from) ?>" placeholder="HAN">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Điểm đến (Mã sân bay)</label>
                        <input type="text" class="form-control" name="to" value="<?= htmlspecialchars($to) ?>" placeholder="SGN">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Ngày đi</label>
                        <input type="date" class="form-control" name="date" value="<?= htmlspecialchars($date) ?>">
                    </div>
                    <button type="submit" class="btn btn-primary w-100 fw-bold">Tìm kiếm</button>
                </div>
            </form>
        </div>

        <!-- Cột phải: DANH SÁCH KẾT QUẢ -->
        <div class="col-lg-9">
            <?php if (!$data['has_search']): ?>
                <div class="alert alert-warning text-center p-5 rounded-4 shadow-sm border border-warning" style="background-color: #fff9e6;">
                    <h4 class="fw-bold text-dark">Vui lòng nhập thông tin tìm kiếm</h4>
                </div>
            <?php elseif (empty($data['flights'])): ?>
                <div class="alert alert-danger text-center p-5 rounded-4 shadow-sm border border-danger">
                    <h4 class="fw-bold text-dark">Không tìm thấy chuyến bay nào!</h4>
                </div>
            <?php else: ?>
                <h5 class="fw-bold mb-4 text-muted">Tìm thấy <?= count($data['flights']) ?> chuyến bay phù hợp</h5>
                
                <?php foreach($data['flights'] as $flight): ?>
                    <div class="flight-card d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <div class="d-flex align-items-center mb-3 mb-md-0" style="min-width: 250px;">
                            <div class="bg-light p-3 rounded-circle me-3 text-center text-primary" style="width: 60px; height: 60px;">
                                <i class="fas fa-plane fs-4"></i>
                            </div>
                            <div>
                                <h5 class="mb-1 fw-bold"><?= htmlspecialchars($flight['airline']) ?></h5>
                                <p class="text-muted small mb-0">Chuyến bay: <strong><?= htmlspecialchars($flight['flight_number']) ?></strong></p>
                            </div>
                        </div>
                        
                        <div class="text-center px-3 mb-3 mb-md-0">
                            <div class="flight-time"><?= date('H:i', strtotime($flight['departure_time'])) ?></div>
                            <div class="small fw-bold"><?= htmlspecialchars($flight['departure_city']) ?></div>
                        </div>
                        
                        <div class="text-end border-start-md ps-md-4 ms-md-2">
                            <div class="flight-price mb-1 text-primary"><?= number_format($flight['price'], 0, ',', '.') ?>đ</div>
                            <a href="<?= BASEURL ?>/checkout/index?id=<?= $flight['id'] ?>" class="btn btn-warning py-2 px-4 w-100 text-white fw-bold">Chọn vé</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once '../app/Views/layouts/footer.php'; ?>
