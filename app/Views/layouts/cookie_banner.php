<!-- ================= COOKIE CONSENT BANNER ================= -->
<style>
    /* CSS cho Cookie Banner */
    .cookie-banner {
        position: fixed;
        bottom: -100%; /* Ẩn mặc định dưới màn hình */
        left: 0;
        width: 100%;
        background-color: #ffffff;
        z-index: 1050; /* Hiển thị trên cùng */
        box-shadow: 0 -4px 20px rgba(0,0,0,0.15);
        transition: bottom 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        border-top: 3px solid #005e6a; /* Viền xanh nhận diện thương hiệu */
    }
    
    .cookie-banner.show {
        bottom: 0; /* Trượt lên khi có class show */
    }

    .cookie-text {
        font-size: 13.5px;
        color: #444;
        line-height: 1.6;
        padding-right: 30px;
    }

    .btn-cookie {
        font-weight: 600;
        font-size: 13px;
        border-radius: 25px;
        padding: 10px 20px;
        transition: all 0.3s ease;
        white-space: nowrap;
    }

    /* Nút Cài đặt */
    .btn-cookie-outline {
        background-color: #ffffff;
        color: #005e6a;
        border: 1.5px solid #005e6a;
    }
    .btn-cookie-outline:hover {
        background-color: #f0f8ff;
        color: #00454e;
    }

    /* Nút Từ chối & Chấp nhận */
    .btn-cookie-solid {
        background-color: #005e6a;
        color: #ffffff;
        border: 1.5px solid #005e6a;
    }
    .btn-cookie-solid:hover {
        background-color: #00454e;
        color: #ffffff;
        border-color: #00454e;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 94, 106, 0.2);
    }

    /* Nút tắt X */
    .btn-close-cookie {
        position: absolute;
        top: 15px;
        right: 15px;
        background: none;
        border: none;
        color: #888;
        font-size: 18px;
        cursor: pointer;
        transition: color 0.3s;
    }
    .btn-close-cookie:hover {
        color: #333;
    }

    /* Responsive cho điện thoại */
    @media (max-width: 991px) {
        .cookie-actions {
            margin-top: 15px;
            justify-content: flex-start !important;
        }
        .btn-cookie {
            flex-grow: 1;
            text-align: center;
        }
    }
</style>

<div id="cookieConsentBanner" class="cookie-banner">
    <div class="container py-4 position-relative">
        <button class="btn-close-cookie" onclick="handleCookieConsent('close')"><i class="fas fa-times"></i></button>
        
        <div class="row align-items-center">
            <!-- Nội dung Text -->
            <div class="col-lg-7 col-md-12">
                <p class="cookie-text mb-0">
                    Bằng cách nhấp vào "Chấp nhận tất cả cookie", bạn đồng ý với việc lưu trữ cookie trên thiết bị của mình để cải thiện điều hướng trang web, phân tích việc sử dụng trang và hỗ trợ các nỗ lực tiếp thị của chúng tôi.
                </p>
            </div>
            
            <!-- Các nút bấm -->
            <div class="col-lg-5 col-md-12 d-flex gap-2 justify-content-lg-end cookie-actions">
                <button class="btn-cookie btn-cookie-outline" onclick="handleCookieConsent('settings')">Cài đặt cookie</button>
                <button class="btn-cookie btn-cookie-solid" onclick="handleCookieConsent('reject')">Từ chối tất cả</button>
                <button class="btn-cookie btn-cookie-solid" onclick="handleCookieConsent('accept')">Chấp nhận tất cả Cookie</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Kiểm tra xem người dùng đã chọn cookie chưa (Lưu trong LocalStorage)
        const cookieConsent = localStorage.getItem('skyline_cookie_consent');
        
        // Nếu chưa có, hiển thị banner trượt lên sau 1 giây
        if (!cookieConsent) {
            setTimeout(() => {
                document.getElementById('cookieConsentBanner').classList.add('show');
            }, 1000);
        }
    });

    function handleCookieConsent(action) {
        // Ẩn banner bằng hiệu ứng trượt xuống
        document.getElementById('cookieConsentBanner').classList.remove('show');
        
        // Xử lý logic theo nút bấm
        if (action === 'accept') {
            localStorage.setItem('skyline_cookie_consent', 'accepted');
        } else if (action === 'reject') {
            localStorage.setItem('skyline_cookie_consent', 'rejected');
        } else if (action === 'settings') {
            alert("Tính năng Cài đặt Cookie chi tiết đang được phát triển.");
        } else if (action === 'close') {
            // Nếu chỉ bấm dấu X tắt, hệ thống sẽ hỏi lại vào lần tải trang sau
        }
    }
</script>