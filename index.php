<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding RIN & THÚY | CineLove</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Dancing+Script:wght@400;500;600;700&family=Cormorant+Garamond:wght@300;400;500&display=swap" rel="stylesheet">

</head>
<body>
    <!-- Background Particles -->
    <div class="particles" id="particles"></div>

    <!-- Music Player -->
    <div class="music-player" id="musicPlayer">
        <i class="fas fa-music music-icon" id="musicIcon"></i>
    </div>

    <div class="wedding-card">
        <!-- Header -->
        <div class="header">
            <div class="header-overlay"></div>
            <div class="header-content">
                <h1 class="wedding-title">WEDDING</h1>
                <div class="date-large" style="color: var(--ivory); font-size: 2rem; margin-bottom: 10px;">
                    20/03/2026
                </div>
                <div class="lunar-date" style="color: var(--champagne); font-size: 1.2rem;">
                    (02/02/2026 Âm lịch)
                </div>
            </div>
        </div>

        <!-- Photo Gallery -->
        <div class="photo-gallery">
            <div class="main-photo">
                <img src="https://img.cinelove.me/uploads/3eec4509-4df7-491a-9d7f-62d3acc79d9e/e0a3fb6a-d035-4dac-ba61-2b02544e8971.jpg?resize=1000x" 
                     alt="Hoàng Rin & Thanh Thúy">
                
                <!-- Decorative Photo Frames -->
                <div class="photo-frame frame-1">
                    <img src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80" alt="Memory 1">
                </div>
                <div class="photo-frame frame-2">
                    <img src="https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80" alt="Memory 2">
                </div>
                <div class="photo-frame frame-3">
                    <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80" alt="Memory 3">
                </div>
                <div class="photo-frame frame-4">
                    <img src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80" alt="Memory 4">
                </div>
            </div>

            <div class="couple-info">
                <h2 class="couple-name">Hoàng Rin ❤️ Thanh Thúy</h2>
                <div class="invitation-label" style="background: linear-gradient(135deg, var(--gold), var(--rose-gold)); color: white; padding: 12px 40px; border-radius: 30px; font-size: 1.3rem; letter-spacing: 2px; display: inline-block;">
                    Thiệp Mời
                </div>
            </div>
            <div class="guest-info-container">
                <p class="guest-label">Trân trọng kính mời</p>
                <h3 id="guest-name" class="guest-name">Quý Khách</h3>
                <p style="color: var(--dark-brown); font-size: 1.3rem; margin-bottom: 30px; line-height: 2;">
                    Vui lòng đến chung vui cùng chúng tôi
                </p>
            </div>
        </div>

        <!-- Timeline -->
        <div class="timeline-section">
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h3 class="timeline-title">Lễ Thành Hôn</h3>
                        <p style="color: var(--dark-brown); margin-bottom: 15px;">
                            ⏰ 10:30 Sáng<br>
                            📅 Thứ Sáu, 20/03/2026<br>
                            🏠 Tư Gia Nhà Trai
                        </p>
                        <div class="timeline-image">
                            <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80" alt="Venue">
                        </div>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h3 class="timeline-title">Tiệc Cưới</h3>
                        <p style="color: var(--dark-brown); margin-bottom: 15px;">
                            ⏰ 18:30 Tối<br>
                            📅 Thứ Sáu, 20/03/2026<br>
                            🏨 Nhà Hàng Royal Palace
                        </p>
                        <div class="timeline-image">
                            <img src="https://images.unsplash.com/photo-1519167758481-83f550bb49b3?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80" alt="Reception">
                        </div>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h3 class="timeline-title">Yêu</h3>
                        <p style="color: var(--dark-brown); font-style: italic; font-size: 1.2rem;">
                            "Môi hôn ngọt ngào, như hoa nở,<br>
                            Trái tim rộn ràng, nhịp yêu vương."
                        </p>
                        <div class="timeline-image">
                            <img src="https://images.unsplash.com/photo-1511988617509-a57c8a288659?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80" alt="Love">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Love Story -->
        <div class="love-story">
            <!-- Floating Flowers -->
            <div class="story-flower" style="top: 10%; left: 5%;">🌸</div>
            <div class="story-flower" style="top: 20%; right: 10%;">🌺</div>
            <div class="story-flower" style="bottom: 30%; left: 15%;">🌹</div>
            <div class="story-flower" style="bottom: 10%; right: 20%;">💐</div>

            <div class="story-content">
                <h2 class="story-title">Câu Chuyện Tình Yêu</h2>
                
                <p style="color: var(--dark-brown); font-size: 1.3rem; margin-bottom: 30px; line-height: 2;">
                    Hôm nay anh học toán hình,<br>
                    Tròn vuông chẳng có, toàn hình bóng em...
                </p>

                <div class="story-images">
                    <div class="story-img">
                        <img src="https://images.unsplash.com/photo-1511988617509-a57c8a288659?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80" alt="Love Story 1">
                    </div>
                    <div class="story-img">
                        <img src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?ixlib=rb-1.2.1&auto=format&fit=crop&w-400&q=80" alt="Love Story 2">
                    </div>
                    <div class="story-img">
                        <img src="https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80" alt="Love Story 3">
                    </div>
                </div>

                <p style="color: var(--dark-brown); font-size: 1.3rem; margin-top: 30px; font-style: italic;">
                    Thương anh mấy núi cũng trèo,<br>
                    Mấy sông cũng lội, mấy đèo cũng qua.<br>
                    Thương anh không quản chi xa,<br>
                    Đá vàng cũng quyết, phong ba cũng liều.
                </p>
            </div>
        </div>

        <!-- Invitation Card -->
        <div class="invitation-card">
            <div class="invitation-content">
                <h2 class="invitation-title">Thông Tin Chi Tiết</h2>
                
                <div class="details-grid">
                    <div class="detail-item">
                        <div class="detail-icon">📅</div>
                        <div class="detail-text">
                            <strong>Ngày Cưới</strong><br>
                            20/03/2026<br>
                            (02/02/2026 ÂL)
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-icon">⏰</div>
                        <div class="detail-text">
                            <strong>Giờ Tổ Chức</strong><br>
                            10:30 - Lễ Thành Hôn<br>
                            18:30 - Tiệc Cưới
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-icon">📍</div>
                        <div class="detail-text">
                            <strong>Địa Điểm</strong><br>
                            Tư Gia Nhà Trai<br>
                            Nhà Hàng Royal Palace
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-icon">👰‍♀️🤵‍♂️</div>
                        <div class="detail-text">
                            <strong>Cặp Đôi</strong><br>
                            Hoàng Rin<br>
                            &<br>
                            Thanh Thúy
                        </div>
                    </div>
                </div>

                <div style="text-align: center; margin-top: 30px;">
                    <div style="font-size: 1.8rem; color: var(--rose-gold); margin-bottom: 15px;">
                        Rất hi vọng bạn sẽ có mặt
                    </div>
                    <p style="color: var(--dark-brown); font-size: 1.2rem;">
                        trong ngày trọng đại này của chúng mình nha!
                    </p>
                    <div style="font-size: 2rem; color: var(--gold); margin-top: 20px; font-family: 'Dancing Script', cursive;">
                        Thương nhiều!
                    </div>
                </div>
            </div>
        </div>

        <!-- Interactive Section -->
        <div class="interactive-section">
            <div class="wish-container">
                <h2 style="color: var(--dark-brown); margin-bottom: 25px; font-family: 'Playfair Display', serif;">
                    Gửi Lời Chúc Đến Đôi Trẻ
                </h2>
                <textarea class="wish-input" placeholder="Viết lời chúc của bạn ở đây..."></textarea>
                <button class="send-wish-btn">
                    <i class="fas fa-paper-plane"></i> Gửi Lời Chúc
                </button>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div style="margin-bottom: 30px;">
                <div style="font-size: 1.5rem; color: var(--gold); margin-bottom: 15px;">
                    Chia Sẻ Khoảnh Khắc
                </div>
                <div class="social-links">
                    <div class="social-icon">
                        <i class="fab fa-facebook-f"></i>
                    </div>
                    <div class="social-icon">
                        <i class="fab fa-instagram"></i>
                    </div>
                    <div class="social-icon">
                        <i class="fab fa-tiktok"></i>
                    </div>
                    <div class="social-icon">
                        <i class="fas fa-camera"></i>
                    </div>
                </div>
            </div>

            <div style="color: var(--champagne); font-size: 1rem; opacity: 0.8;">
                Made with <i class="fas fa-heart" style="color: var(--rose-gold); margin: 0 5px;"></i> by CineLove
            </div>
        </div>
    </div>

<audio id="backgroundMusic" loop>
    <source src="assets/nhac.mp3" type="audio/mpeg">
</audio>

<script>
    // Hàm lấy tên từ Link (VD: tenmien.com/?to=Anh+Nam)
function getGuestName() {
    const urlParams = new URLSearchParams(window.location.search);
    let guestName = urlParams.get('to');
    
    if (guestName) {
        // Thay dấu cộng (+) thành khoảng trắng
        guestName = guestName.replace(/\+/g, ' '); 
        
        const guestElement = document.getElementById('guest-name');
        if (guestElement) {
            guestElement.innerText = guestName;
        }
    }
}

// Chạy hàm khi web tải xong
window.addEventListener('load', getGuestName);
    /**
     * PHẦN 1: CẤU HÌNH NHẠC TỰ ĐỘNG PHÁT
     * Giải quyết chính sách chặn Autoplay của Chrome/Safari
     */
    const audio = document.getElementById('backgroundMusic');
    const musicIcon = document.getElementById('musicIcon');
    const musicPlayer = document.getElementById('musicPlayer');
    let isPlaying = false;

    // Hàm thực hiện phát nhạc
    function playMusic() {
        if (!isPlaying) {
            audio.play().then(() => {
                isPlaying = true;
                if (musicIcon) musicIcon.classList.add('playing');
                console.log("Nhạc đã bắt đầu phát!");
                removeMusicListeners(); // Thành công thì dừng lắng nghe
            }).catch(error => {
                // Trình duyệt vẫn chặn, đợi tương tác tiếp theo
                console.log("Đang đợi tương tác để mở nhạc...");
            });
        }
    }

    // Các sự kiện kích hoạt nhạc (Chỉ cần 1 trong các hành động này)
    function triggerMusic() {
        playMusic();
    }

    function removeMusicListeners() {
        ['click', 'touchstart', 'scroll', 'mousemove', 'keydown'].forEach(evt => {
            document.removeEventListener(evt, triggerMusic);
        });
    }

    // Đăng ký lắng nghe tương tác người dùng
    document.addEventListener('click', triggerMusic);
    document.addEventListener('touchstart', triggerMusic);
    document.addEventListener('scroll', triggerMusic);
    document.addEventListener('mousemove', triggerMusic);
    document.addEventListener('keydown', triggerMusic);

    // Xử lý nút bấm điều khiển nhạc thủ công (nếu có icon Loa trên web)
    if (musicPlayer) {
        musicPlayer.addEventListener('click', function(e) {
            e.stopPropagation();
            if (isPlaying) {
                audio.pause();
                if (musicIcon) musicIcon.classList.remove('playing');
                isPlaying = false;
            } else {
                playMusic();
            }
        });
    }


    /**
     * PHẦN 2: HIỆU ỨNG HẠT (PARTICLES)
     */
    function createParticles() {
        const container = document.getElementById('particles');
        if (!container) return;
        for (let i = 0; i < 50; i++) {
            const p = document.createElement('div');
            p.classList.add('particle');
            p.style.left = Math.random() * 100 + 'vw';
            p.style.animationDelay = Math.random() * 20 + 's';
            const size = Math.random() * 4 + 1;
            p.style.width = size + 'px';
            p.style.height = size + 'px';
            p.style.opacity = Math.random() * 0.6 + 0.1;
            container.appendChild(p);
        }
    }


    /**
     * PHẦN 3: HIỆU ỨNG TRÁI TIM RƠI
     */
    function createFallingHeart() {
        const heart = document.createElement('div');
        // Sử dụng FontAwesome hoặc ký tự Unicode
        heart.innerHTML = '<i class="fas fa-heart"></i>'; 
        const colors = ['#e6a4a4', '#ffb6c1', '#f08080', '#ffc0cb', '#d8b089', '#ff9999'];
        
        heart.style.cssText = `
            position: fixed;
            top: -50px;
            left: ${Math.random() * 100}vw;
            color: ${colors[Math.floor(Math.random() * colors.length)]};
            opacity: ${Math.random() * 0.8 + 0.2};
            font-size: ${Math.random() * 25 + 12}px;
            z-index: 999;
            pointer-events: none;
            text-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: transform ${Math.random() * 4 + 3}s linear, opacity 2s;
        `;
        
        document.body.appendChild(heart);

        // Chuyển động rơi
        setTimeout(() => {
            heart.style.transform = `translateY(110vh) translateX(${Math.random() * 200 - 100}px) rotate(${Math.random() * 720}deg)`;
            heart.style.opacity = '0';
        }, 100);

        // Xóa sau khi rơi xong
        setTimeout(() => { heart.remove(); }, 6000);
    }


    /**
     * PHẦN 4: HIỆU ỨNG CUỘN (TIMELINE) & KHỞI TẠO
     */
    function initAnimations() {
        // Timeline Observer
        const items = document.querySelectorAll('.timeline-item');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.2 });
        items.forEach(item => observer.observe(item));

        // Hover ảnh
        document.querySelectorAll('.story-img').forEach(img => {
            img.onmouseenter = () => img.style.transform = 'scale(1.1) rotate(2deg)';
            img.onmouseleave = () => img.style.transform = 'scale(1) rotate(0deg)';
        });
    }

    // Chạy tất cả khi trang tải xong
    window.addEventListener('load', () => {
        createParticles();
        initAnimations();
        setInterval(createFallingHeart, 300); // Cứ 0.3 giây rơi 1 tim
        
        // Thử phát nhạc ngay (Thường bị trình duyệt chặn, nhưng vẫn nên gọi)
        playMusic();

        // Thêm animation xuất hiện card chính
        const weddingCard = document.querySelector('.wedding-card');
        if (weddingCard) {
            weddingCard.style.animation = 'cardAppear 1.2s ease-out forwards';
        }
    });

    // Style cho hiệu ứng card (nếu chưa có trong CSS)
    const style = document.createElement('style');
    style.textContent = `
        @keyframes cardAppear {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }
    `;
    document.head.appendChild(style);
    /**
 * PHẦN: LẤY TÊN KHÁCH MỜI TỪ URL
 * Ví dụ: tenmien.com/?to=Nguyễn+Văn+A
 */
function getGuestName() {
    // 1. Lấy toàn bộ tham số trên thanh địa chỉ
    const urlParams = new URLSearchParams(window.location.search);
    
    // 2. Tìm tham số có tên là 'to'
    let guestName = urlParams.get('to');

    // 3. Nếu tìm thấy tên, hãy ghi nó vào thẻ HTML
    if (guestName) {
        // Thay thế dấu cộng (+) hoặc %20 bằng khoảng trắng để tên đẹp hơn
        guestName = guestName.replace(/\+/g, ' '); 
        
        const guestElement = document.getElementById('guest-name');
        if (guestElement) {
            guestElement.innerText = guestName;
        }
    }
}

// Gọi hàm này ngay khi trang web vừa tải xong
window.addEventListener('load', () => {
    getGuestName();
    // ... các hàm khác của bạn (createParticles, playMusic...)
});
</script>
</body>
</html>