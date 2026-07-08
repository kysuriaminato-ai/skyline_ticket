<?php require_once '../app/Views/layouts/header.php'; ?>

<style>
    body {
        background-color: #f4f5f9;
    }
    .ticket-wrapper {
        max-width: 450px;
        margin: 40px auto;
        font-family: 'Inter', sans-serif;
    }
    .ticket-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    .ticket-header h2 {
        font-weight: 700;
        font-size: 28px;
        color: #1f2937;
        margin: 0;
    }
    .ticket-tabs {
        display: flex;
        background-color: #e5e7eb;
        border-radius: 30px;
        padding: 5px;
        margin-bottom: 20px;
    }
    .ticket-tab {
        flex: 1;
        text-align: center;
        padding: 10px 0;
        font-weight: 600;
        font-size: 14px;
        color: #6b7280;
        border-radius: 25px;
        cursor: pointer;
    }
    .ticket-tab.active {
        background-color: #ffffff;
        color: #111827;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    
    .ticket-card {
        background-color: #ffffff;
        border-radius: 24px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        position: relative;
        overflow: hidden;
    }
    
    .ticket-card::before, .ticket-card::after {
        content: '';
        position: absolute;
        top: 180px;
        width: 30px;
        height: 30px;
        background-color: #f4f5f9;
        border-radius: 50%;
        z-index: 10;
    }
    .ticket-card::before { left: -15px; }
    .ticket-card::after { right: -15px; }
    
    .ticket-divider {
        position: absolute;
        top: 195px;
        left: 20px;
        right: 20px;
        border-top: 2px dashed #e5e7eb;
        z-index: 5;
    }
    
    .ticket-top {
        padding: 30px 25px 25px;
    }
    .ticket-bottom {
        padding: 25px 25px 30px;
        margin-top: 15px;
    }
    
    .flight-route {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }
    .route-city {
        font-size: 24px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 5px;
    }
    .route-name {
        font-size: 12px;
        color: #9ca3af;
    }
    .route-plane {
        display: flex;
        align-items: center;
        color: #3b82f6;
        flex: 1;
        justify-content: center;
        position: relative;
    }
    .route-plane::before, .route-plane::after {
        content: '';
        flex: 1;
        border-bottom: 1px dashed #93c5fd;
        margin: 0 10px;
    }
    .route-plane .duration {
        position: absolute;
        top: 25px;
        font-size: 11px;
        color: #6b7280;
        font-weight: 600;
        white-space: nowrap;
    }
    
    .flight-info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
    }
    .info-box {
        text-align: left;
    }
    .info-box.center { text-align: center; }
    .info-box.right { text-align: right; }
    
    .info-label {
        font-size: 11px;
        color: #9ca3af;
        margin-bottom: 5px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .info-value {
        font-size: 14px;
        font-weight: 700;
        color: #111827;
    }
    
    .barcode-container {
        margin-top: 30px;
        text-align: center;
    }
    .barcode-img {
        width: 100%;
        height: 70px;
        opacity: 0.8;
    }
</style>

<div class="ticket-wrapper">
    <div class="ticket-header">
        <h2>Tickets</h2>
    </div>
    
    <div class="ticket-tabs">
        <div class="ticket-tab active">Upcoming</div>
        <a href="<?= BASEURL ?>/booking/history" class="ticket-tab text-decoration-none d-block">Previous</a>
    </div>
    
    <?php
    $b = $data['booking'];
    $depCode = explode(',', $b['departure'])[0];
    $destCode = explode(',', $b['destination'])[0];
    
    // Tính khoảng thời gian nếu có (mocking 6H 30MIN)
    $depTime = strtotime($b['departure_time']);
    $arrTime = strtotime($b['departure_time'] . ' + 6 hours 30 minutes'); // Mocking duration for display
    ?>
    
    <div class="ticket-card">
        <div class="ticket-top">
            <div class="flight-route">
                <div>
                    <div class="route-city"><?= strtoupper(substr($depCode, 0, 3)) ?></div>
                    <div class="route-name"><?= $depCode ?></div>
                </div>
                
                <div class="route-plane">
                    <i class="fas fa-plane"></i>
                    <div class="duration">6H 30MIN</div>
                </div>
                
                <div class="text-end">
                    <div class="route-city"><?= strtoupper(substr($destCode, 0, 3)) ?></div>
                    <div class="route-name"><?= $destCode ?></div>
                </div>
            </div>
            
            <div class="flight-info-grid mt-4 pt-3 border-top">
                <div class="info-box">
                    <div class="info-value"><?= date('d M', $depTime) ?></div>
                    <div class="info-label">Date</div>
                </div>
                <div class="info-box center">
                    <div class="info-value"><?= date('h:i A', $depTime) ?></div>
                    <div class="info-label">Departure Time</div>
                </div>
                <div class="info-box right">
                    <div class="info-value"><?= htmlspecialchars(substr($b['flight_code'], 0, 6)) ?></div>
                    <div class="info-label">Flight</div>
                </div>
            </div>
        </div>
        
        <div class="ticket-divider"></div>
        
        <div class="ticket-bottom">
            <div class="flight-info-grid mb-4">
                <div class="info-box">
                    <div class="info-value"><?= htmlspecialchars($b['contact_name'] ?? $b['fullname']) ?></div>
                    <div class="info-label">Passenger</div>
                </div>
                <div class="info-box center">
                    <div class="info-value"><?= $b['passengers_count'] ?></div>
                    <div class="info-label">Seats</div>
                </div>
                <div class="info-box right">
                    <div class="info-value"><?= htmlspecialchars($b['booking_code']) ?></div>
                    <div class="info-label">Booking Code</div>
                </div>
            </div>
            
            <div class="flight-info-grid mb-3">
                <div class="info-box">
                    <div class="info-value text-primary"><i class="fab fa-cc-visa me-1"></i>*** 7864</div>
                    <div class="info-label">Payment Method</div>
                </div>
                <div class="info-box right" style="grid-column: span 2;">
                    <div class="info-value fs-5 text-danger"><?= number_format($b['total_price'], 0, ',', '.') ?> VND</div>
                    <div class="info-label">Total Price</div>
                </div>
            </div>
            
            <div class="barcode-container">
                <!-- Sử dụng font barcode hoặc ảnh tĩnh barcode cho đẹp -->
                <img src="https://upload.wikimedia.org/wikipedia/commons/e/e9/UPC-A-036000291452.svg" alt="Barcode" class="barcode-img">
            </div>
        </div>
    </div>
    
    <div class="text-center mt-4">
        <a href="<?= BASEURL ?>/home" class="btn btn-outline-secondary rounded-pill px-4 me-2">Về trang chủ</a>
        <button class="btn btn-primary rounded-pill px-4 shadow-sm" style="background-color: #005e6a; border: none;" onclick="window.print()">
            <i class="fas fa-download me-2"></i>Tải vé về máy
        </button>
    </div>
</div>

<?php require_once '../app/Views/layouts/footer.php'; ?>
