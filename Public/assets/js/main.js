// public/js/main.js

document.addEventListener("DOMContentLoaded", function() {
    // Xử lý cập nhật số tiền khi kéo thanh trượt "Giá vé tối đa" trong trang Danh sách chuyến bay
    const priceRange = document.querySelector('input[name="max_price"]');
    const priceValDisplay = document.getElementById('priceVal');

    if (priceRange && priceValDisplay) {
        priceRange.addEventListener('input', function() {
            // Định dạng số thành chuẩn Việt Nam Đồng (vd: 1.000.000đ)
            let formattedPrice = new Intl.NumberFormat('vi-VN').format(this.value) + 'đ';
            priceValDisplay.innerText = formattedPrice;
        });
    }

    // Auto-hide alert sau 5 giây (nếu có thông báo thành công)
    const alertSuccess = document.querySelector('.alert-success');
    if (alertSuccess) {
        setTimeout(() => {
            alertSuccess.style.transition = "opacity 0.5s ease";
            alertSuccess.style.opacity = "0";
            setTimeout(() => alertSuccess.remove(), 500);
        }, 5000);
    }
});