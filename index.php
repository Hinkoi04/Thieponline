<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Thiệp Cưới Hoàng Rin & Thanh Thúy</title>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    
</head>
<body>

    <audio id="bgMusic" loop>
        <source src="assets/nhac1.mp3" type="audio/mpeg"> </audio>

    <div class="mobile-wrapper">
        
        <div class="music-btn spinning" id="musicBtn" onclick="toggleMusic()">
            <i class="fas fa-music"></i>
        </div>

        <div class="envelope" id="envelope">
            <div class="env-top">
                <div class="env-text">
                    <p>THƯ MỜI CƯỚI</p>
                    <h2>Hoàng Rin & Thanh Thúy</h2>
                </div>
            </div>
            <div class="env-bottom"></div>
            <div class="seal" onclick="openInvitation()">
                <span>Mở</span>
            </div>
        </div>

        <div class="main-content">
            
            <section class="section-hero">
                <p class="sub-title">THƯ MỜI CƯỚI</p>
                <h1 class="couple-name">Hoàng Rin & Thanh Thúy</h1>
                <div class="time-box">
                    <p>Thứ 5 - 17:00</p>
                    <p class="big-date">01 . 01 . 2026</p>
                </div>
                <div class="hero-image">
                    <img src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=800&auto=format&fit=crop" alt="Ảnh cưới chính">
                </div>
            </section>

            <section class="section-parents text-center">
                <div class="parents-grid">
                    <div>
                        <h3 class="red-text">Nhà trai</h3>
                        <p>Ông: Vũ Đức Đạt</p>
                        <p>Bà: Trịnh Thị Lan</p>
                        <p><em>Hải Phòng</em></p>
                    </div>
                    <div class="divider">囍</div>
                    <div>
                        <h3 class="red-text">Nhà gái</h3>
                        <p>Ông: Nguyễn Văn Linh</p>
                        <p>Bà: Nguyễn Thùy Trang</p>
                        <p><em>Phú Thọ</em></p>
                    </div>
                </div>
                <div class="invite-text mt-3">
                    <p>Trân Trọng Báo Tin Lễ Thành Hôn Của</p>
                    <h2 class="couple-name-small">Hoàng Rin</h2>
                    <p>&</p>
                    <h2 class="couple-name-small">Thanh Thúy</h2>
                </div>
                <img src="https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=800&auto=format&fit=crop" alt="Ảnh phụ" class="content-img">
            </section>

            <section class="section-event text-center">
                <h2 class="section-title">Lễ Thành Hôn</h2>
                <div class="date-box">
                    <p>Vào Lúc<br><strong>17 giờ 00</strong></p>
                    <div class="calendar-icon">
                        <span class="month">Tháng 01</span>
                        <span class="day">01</span>
                        <span class="year">Năm 2026</span>
                    </div>
                </div>
                <p class="lunar-date">(Tức Ngày 13 Tháng 11 Năm Ất Tỵ)</p>
                
                <div class="location-box mt-3">
                    <p>BUỔI TIỆC ĐƯỢC TỔ CHỨC TẠI</p>
                    <h3 class="red-text">TƯ GIA NHÀ TRAI</h3>
                    <p>Tiên Lãng, Hải Phòng</p>
                    <a href="#" class="btn-map">Xem Chỉ Đường</a>
                </div>

                <div class="calendar-view mt-3">
                    <h3 class="red-text">THÁNG 1 - 2026</h3>
                    <div class="days-grid">
                        <span>T2</span><span>T3</span><span>T4</span><span class="red-text">T5</span><span>T6</span><span>T7</span><span>CN</span>
                        <span></span><span></span><span></span>
                        <span class="highlight">1</span><span>2</span><span>3</span><span>4</span>
                        <span>5</span><span>6</span><span>7</span><span>8</span><span>9</span><span>10</span><span>11</span>
                        <span>12</span><span>13</span><span>14</span><span>15</span><span>16</span><span>...</span><span></span>
                    </div>
                </div>
            </section>

            <section class="section-gallery">
                <h2 class="section-title text-center">Album Hình Cưới</h2>
                <div class="gallery-grid">
                    <img src="https://images.unsplash.com/photo-1606800052052-a08af7148866?q=80&w=400&auto=format&fit=crop" alt="Ảnh 1">
                    <img src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?q=80&w=400&auto=format&fit=crop" alt="Ảnh 2">
                    <img src="https://images.unsplash.com/photo-1520854221256-17451cc331bf?q=80&w=400&auto=format&fit=crop" alt="Ảnh 3" class="full-width">
                </div>
            </section>

            <section class="section-thankyou text-center">
                <h1 class="couple-name">Thank you</h1>
                <p>Rất hân hạnh được đón tiếp!</p>
            </section>

        </div>
    </div>

    <script src="js/script.js"></script>
</body>
</html>