<?php
$c = file_get_contents('app/Views/home/index.php');

$newHtml = <<<HTML
    <!-- ================= CLIENT REVIEW SECTION ================= -->
    <div class="container my-5 py-5">
        <div class="d-flex justify-content-between align-items-end mb-5">
            <div>
                <h3 class="fw-bold mb-2" style="color: #333;"><?= __('home.client_review_title') ?></h3>
                <p class="text-muted mb-0"><?= __('home.client_review_desc') ?></p>
            </div>
            <button class="btn btn-outline-primary rounded-pill px-4" onclick="document.getElementById('reviewFormArea').style.display='block'; window.location.hash='reviewFormArea';">
                <i class="fas fa-pencil-alt me-2"></i>Viết đánh giá
            </button>
        </div>

        <div class="row align-items-center mb-5" id="currentReviewDisplay">
            <div class="col-md-5 position-relative text-center mb-4 mb-md-0">
                <div class="review-bg-circle"></div>
                <img src="https://images.unsplash.com/photo-1501504905252-473c47e087f8?auto=format&fit=crop&w=600&q=80" alt="Client Review" class="client-review-img">
            </div>
            <div class="col-md-7 ps-md-5 position-relative">
                <i class="fas fa-quote-left review-quote-icon"></i>
                <p class="fs-4 fst-italic text-muted mb-4 position-relative" style="line-height: 1.8; z-index: 2;" id="displayReviewContent">
                    <?= __('home.client_review_quote') ?>
                </p>
                <h5 class="fw-bold mb-1" style="color: #0c3547;" id="displayReviewName">Jane Cooper</h5>
                <div class="text-warning" id="displayReviewStars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
            </div>
        </div>

        <!-- Review Form Area (Hidden by default) -->
        <div class="row justify-content-center" id="reviewFormArea" style="display: none;">
            <div class="col-md-8">
                <div class="card border-0 shadow-lg rounded-4 p-4 p-md-5">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="fw-bold text-primary mb-0">Chia sẻ trải nghiệm của bạn</h4>
                        <button type="button" class="btn-close" onclick="document.getElementById('reviewFormArea').style.display='none';"></button>
                    </div>
                    
                    <div class="mb-4 text-center">
                        <label class="form-label d-block text-muted mb-2">Đánh giá sao</label>
                        <div class="star-rating fs-2" id="starRatingSystem">
                            <i class="fas fa-star" data-rating="1"></i>
                            <i class="fas fa-star" data-rating="2"></i>
                            <i class="fas fa-star" data-rating="3"></i>
                            <i class="fas fa-star" data-rating="4"></i>
                            <i class="fas fa-star" data-rating="5"></i>
                        </div>
                        <input type="hidden" id="selectedRating" value="5">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label text-muted">Họ và Tên</label>
                        <input type="text" class="form-control form-control-lg bg-light border-0" id="reviewerName" placeholder="Nhập tên của bạn...">
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label text-muted">Nhận xét của bạn</label>
                        <textarea class="form-control bg-light border-0" id="reviewText" rows="4" placeholder="Kể cho mọi người nghe về chuyến đi tuyệt vời của bạn cùng Skyline Ticket..."></textarea>
                    </div>
                    
                    <button class="btn btn-primary btn-lg w-100 rounded-pill fw-bold shadow-sm" onclick="submitReview()">
                        Gửi Đánh Giá Ngay <i class="fas fa-paper-plane ms-2"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Star Rating Logic
    document.addEventListener('DOMContentLoaded', function() {
        const stars = document.querySelectorAll('#starRatingSystem .fa-star');
        const ratingInput = document.getElementById('selectedRating');
        
        // Highlight stars up to clicked/hovered one
        function highlightStars(rating) {
            stars.forEach(star => {
                if (parseInt(star.dataset.rating) <= rating) {
                    star.classList.add('text-warning');
                    star.classList.remove('text-secondary');
                } else {
                    star.classList.remove('text-warning');
                    star.classList.add('text-secondary');
                }
            });
        }
        
        // Initial setup
        highlightStars(5);
        
        stars.forEach(star => {
            star.style.cursor = 'pointer';
            star.classList.add('text-warning', 'transition-all');
            
            star.addEventListener('mouseover', function() {
                highlightStars(parseInt(this.dataset.rating));
            });
            
            star.addEventListener('mouseout', function() {
                highlightStars(parseInt(ratingInput.value));
            });
            
            star.addEventListener('click', function() {
                ratingInput.value = this.dataset.rating;
                highlightStars(parseInt(this.dataset.rating));
                // Add pop animation
                this.style.transform = 'scale(1.2)';
                setTimeout(() => { this.style.transform = 'scale(1)'; }, 200);
            });
        });
    });

    // Submit Review Logic
    function submitReview() {
        const name = document.getElementById('reviewerName').value.trim();
        const text = document.getElementById('reviewText').value.trim();
        const rating = parseInt(document.getElementById('selectedRating').value);
        
        if(!name || !text) {
            alert('Vui lòng nhập đầy đủ tên và nhận xét!');
            return;
        }
        
        // Cập nhật giao diện hiện tại
        document.getElementById('displayReviewName').innerText = name;
        document.getElementById('displayReviewContent').innerText = '"' + text + '"';
        
        let starsHtml = '';
        for(let i=1; i<=5; i++) {
            if(i <= rating) {
                starsHtml += '<i class="fas fa-star"></i> ';
            } else {
                starsHtml += '<i class="far fa-star"></i> ';
            }
        }
        document.getElementById('displayReviewStars').innerHTML = starsHtml;
        
        // Đổi ảnh random để tạo cảm giác người mới
        const randomImgId = Math.floor(Math.random() * 1000) + 1;
        document.querySelector('.client-review-img').src = 'https://picsum.photos/seed/' + randomImgId + '/600/600';
        
        // Ẩn form và báo thành công
        document.getElementById('reviewFormArea').style.display = 'none';
        
        // Reset form
        document.getElementById('reviewerName').value = '';
        document.getElementById('reviewText').value = '';
        
        alert('Cảm ơn ' + name + '! Đánh giá của bạn đã được ghi nhận.');
        
        // Cuộn nhẹ lên trên
        window.scrollTo({
            top: document.getElementById('currentReviewDisplay').offsetTop - 100,
            behavior: 'smooth'
        });
    }
    </script>
HTML;

$css = <<<CSS
        /* ================= CLIENT REVIEW FIXES ================= */
        .client-review-img {
            width: 100%;
            max-width: 450px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            position: relative;
            z-index: 2;
            object-fit: cover;
            border: 8px solid white;
        }
        .review-bg-circle {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80%;
            padding-bottom: 80%;
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            border-radius: 50%;
            z-index: 1;
        }
        .review-quote-icon {
            font-size: 80px;
            color: rgba(0, 113, 194, 0.1);
            position: absolute;
            top: -30px;
            left: -20px;
            z-index: 1;
        }
        #starRatingSystem i { transition: transform 0.2s, color 0.2s; }
CSS;

// Thay thế HTML cũ
$c = preg_replace('/<!-- ================= CLIENT REVIEW SECTION ================= -->.*?<\/div>\s*<\/div>\s*<\/div>/is', $newHtml, $c);

// Bơm CSS
$c = str_replace("</style>", "$css\n    </style>", $c); 

file_put_contents('app/Views/home/index.php', $c);
echo "Injected review fixes and interactive functionality!";
