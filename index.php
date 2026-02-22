<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Thiệp Cưới Hoàng Rin & Thanh Thúy</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">

</head>
<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        background-color: #1a1a1a;
        font-family: 'Playfair Display', serif;
        color: #333;
        /* Background họa tiết nhẹ cho PC khi tấm thiệp nằm giữa */
        background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
        overflow-x: hidden;
    }

    :root {
        --red-bg: #9a0d14;
        /* Đỏ rượu */
        --gold-text: #e0b976;
        /* Vàng kim */
        --light-bg: #fdf8f5;
        /* Trắng ngà */
    }

    /* Tiện ích căn chỉnh */
    .text-center {
        text-align: center;
    }

    .mt-3 {
        margin-top: 1.5rem;
    }

    .red-text {
        color: var(--red-bg);
        font-weight: bold;
    }

    /* =========================================
       CONTAINER CHÍNH (KHUNG THIỆP)
       ========================================= */
    .mobile-wrapper {
        width: 100%;
        max-width: 100%;
        /* Mặc định trên điện thoại là full màn hình */
        margin: 0 auto;
        background-color: var(--light-bg);
        position: relative;

        /* Chặn cuộn ban đầu khi chưa mở thiệp */
        height: 100vh;
        overflow: hidden;
        transition: all 0.5s ease;
    }

    /* Khi thiệp đã mở -> Thả chiều cao để cuộn đọc nội dung */
    .mobile-wrapper.scrollable {
        height: auto;
        overflow: visible;
    }

    /* =========================================
       HIỆU ỨNG BÌ THƯ (PHỦ TOÀN MÀN HÌNH)
       ========================================= */
    .envelope {
        position: fixed;
        /* Fixed để bì thư che toàn bộ màn hình thiết bị */
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        z-index: 100;
        display: flex;
        flex-direction: column;
        transition: visibility 1.5s;
    }

    .env-top,
    .env-bottom {
        background-color: var(--red-bg);
        background-image: url('https://www.transparenttextures.com/patterns/floral-flourish.png');
        width: 100%;
        height: 50%;
        transition: transform 1.2s cubic-bezier(0.77, 0, 0.175, 1);
        position: relative;
    }

    .env-bottom {
        border-top: 2px solid rgba(255, 215, 0, 0.3);
    }

    .env-text {
        position: absolute;
        bottom: 40px;
        width: 100%;
        text-align: center;
        color: var(--gold-text);
    }

    .env-text p {
        letter-spacing: 2px;
        font-size: 0.9rem;
    }

    .env-text h2 {
        font-family: 'Dancing Script', cursive;
        font-size: 2.5rem;
        margin-top: 10px;
    }

    /* Nút Chữ Hỷ */
    .seal {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 70px;
        height: 70px;
        background-color: #c0131d;
        border: 3px solid var(--gold-text);
        border-radius: 5px;
        display: flex;
        justify-content: center;
        align-items: center;
        color: var(--gold-text);
        font-size: 2.5rem;
        cursor: pointer;
        z-index: 101;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        transition: opacity 0.5s, transform 0.3s;
        animation: pulse 1.5s infinite;
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(224, 185, 118, 0.7);
        }

        70% {
            box-shadow: 0 0 0 15px rgba(224, 185, 118, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(224, 185, 118, 0);
        }
    }

    /* Kích hoạt mở thiệp */
    .envelope.is-open .env-top {
        transform: translateY(-100%);
    }

    .envelope.is-open .env-bottom {
        transform: translateY(100%);
    }

    .envelope.is-open .seal {
        opacity: 0;
        pointer-events: none;
        animation: none;
    }

    /* Nút Nhạc (Ghim góc phải dưới cùng) */
    .music-btn {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 45px;
        height: 45px;
        background-color: var(--red-bg);
        color: white;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 99;
        cursor: pointer;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        font-size: 1.2rem;
    }

    .spinning {
        animation: spin 3s linear infinite;
    }

    @keyframes spin {
        100% {
            transform: rotate(360deg);
        }
    }


    /* =========================================
       NỘI DUNG THIỆP CHÍNH
       ========================================= */
    .main-content {
        padding-bottom: 50px;
        opacity: 0;
        transition: opacity 1.5s ease-in-out;
    }

    .mobile-wrapper.scrollable .main-content {
        opacity: 1;
    }

    section {
        padding: 40px 20px;
        border-bottom: 1px dashed #ddd;
    }

    .sub-title {
        font-size: 0.9rem;
        letter-spacing: 2px;
        color: gray;
        text-align: center;
    }

    .couple-name {
        font-family: 'Dancing Script', cursive;
        font-size: 3.5rem;
        color: var(--red-bg);
        text-align: center;
        margin: 10px 0;
    }

    .couple-name-small {
        font-family: 'Dancing Script', cursive;
        font-size: 2.5rem;
        color: var(--gold-text);
    }

    .time-box {
        text-align: center;
        margin-bottom: 30px;
    }

    .big-date {
        font-size: 1.8rem;
        font-weight: bold;
        color: var(--red-bg);
        border-top: 1px solid #ccc;
        border-bottom: 1px solid #ccc;
        display: inline-block;
        padding: 10px 30px;
    }

    .hero-image img,
    .content-img {
        width: 100%;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        object-fit: cover;
    }

    .content-img {
        margin-top: 20px;
        border-radius: 150px 150px 10px 10px;
    }

    .parents-grid {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        font-size: 1rem;
        gap: 10px;
    }

    .divider {
        color: var(--red-bg);
        font-size: 2rem;
        opacity: 0.5;
        display: flex;
        align-items: center;
    }

    .section-title {
        font-size: 2rem;
        color: var(--red-bg);
        margin-bottom: 25px;
        font-family: 'Dancing Script', cursive;
    }

    .btn-map {
        display: inline-block;
        padding: 12px 30px;
        background-color: var(--red-bg);
        color: white;
        text-decoration: none;
        border-radius: 30px;
        font-weight: bold;
        margin-top: 15px;
        transition: 0.3s;
    }

    .btn-map:hover {
        background-color: #7a0a10;
        transform: translateY(-2px);
    }

    .date-box {
        font-size: 1.2rem;
    }

    .calendar-icon {
        display: inline-block;
        border: 2px solid var(--red-bg);
        border-radius: 8px;
        padding: 10px;
        margin-top: 10px;
    }

    .calendar-icon span {
        display: block;
    }

    .calendar-icon .day {
        font-size: 2rem;
        font-weight: bold;
        color: var(--red-bg);
        line-height: 1;
        margin: 5px 0;
    }

    /* Lịch cơ bản */
    .calendar-view {
        max-width: 400px;
        margin: 0 auto;
    }

    .days-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 8px;
        margin-top: 20px;
        font-size: 1rem;
    }

    .days-grid span {
        padding: 8px 0;
    }

    .highlight {
        background-color: var(--red-bg);
        color: white;
        border-radius: 50%;
        font-weight: bold;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    /* Grid Album Ảnh Mobile (2 cột) */
    .gallery-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .gallery-grid img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 8px;
        transition: transform 0.3s;
    }

    .gallery-grid img:hover {
        transform: scale(1.02);
    }

    .full-width {
        grid-column: span 2;
        height: 300px !important;
    }


    /* =========================================
       MEDIA QUERIES - RESPONSIVE ĐA THIẾT BỊ
       ========================================= */

    /* DÀNH CHO TABLET (iPad, màn hình cỡ trung) */
    @media (min-width: 768px) {
        .mobile-wrapper {
            max-width: 700px;
            /* Biến thành một tấm card */
            margin: 40px auto;
            /* Căn giữa màn hình */
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            height: calc(100vh - 80px);
            /* Khóa cuộn theo chiều cao mới */
        }

        section {
            padding: 50px 40px;
        }

        .couple-name {
            font-size: 4rem;
        }

        .hero-image img {
            height: 500px;
        }

        /* Album Ảnh lên 3 cột */
        .gallery-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .full-width {
            grid-column: span 3;
            height: 400px !important;
        }
    }

    /* DÀNH CHO DESKTOP (PC, Laptop màn hình rộng) */
    @media (min-width: 1024px) {
        .mobile-wrapper {
            max-width: 850px;
            /* Card to hơn một chút */
            margin: 60px auto;
            height: calc(100vh - 120px);
        }

        .parents-grid {
            gap: 40px;
        }

        .hero-image img {
            height: 600px;
        }

        .gallery-grid {
            gap: 20px;
        }

        .gallery-grid img {
            height: 250px;
        }

        .full-width {
            height: 500px !important;
        }

        .calendar-view {
            max-width: 500px;
        }

        .days-grid {
            font-size: 1.1rem;
            gap: 10px;
        }
    }
</style>
<body>

    <audio id="bgMusic" loop>
        <source src="assets/nhac1.mp3" type="audio/mpeg">
    </audio>

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
                    <p>Thứ 6 - 10:00</p>
                    <p class="big-date">20 . 03 . 2026</p>
                </div>
                <div class="hero-image">
                    <img src="images/anh3.jpg"
                        alt="Ảnh cưới chính">
                </div>
            </section>

            <section class="section-parents text-center">
                <div class="parents-grid">
                    <div>
                        <h3 class="red-text">Nhà trai</h3>
                        <p>Ông: Đỗ Văn Kin</p>
                        <p>Bà: Lê Thị Mỹ</p>
                        <p><em>An Phú</em></p>
                    </div>
                    <div class="divider">囍</div>
                    <div>
                        <h3 class="red-text">Nhà gái</h3>
                        <p>Ông: Nguyễn Văn Linh</p>
                        <p>Bà: Nguyễn Thùy Trang</p>
                        <p><em>Sa Huỳnh</em></p>
                    </div>
                </div>
                <div class="invite-text mt-3">
                    <p>Trân Trọng Báo Tin Lễ Thành Hôn Của</p>
                    <h2 class="couple-name-small">Hoàng Rin</h2>
                    <p>&</p>
                    <h2 class="couple-name-small">Thanh Thúy</h2>
                </div>
                <img src="images/1.jpg"
                    alt="Ảnh phụ" class="content-img">
            </section>

            <section class="section-event text-center">
                <h2 class="section-title">Lễ Thành Hôn</h2>
                <div class="date-box">
                    <p>Vào Lúc<br><strong>17 giờ 00</strong></p>
                    <div class="calendar-icon">
                        <span class="month">Tháng 03</span>
                        <span class="day">20</span>
                        <span class="year">Năm 2026</span>
                    </div>
                </div>
                <p class="lunar-date">(Tức Ngày 02 Tháng 02 Năm Bính Ngọ)</p>

                <div class="location-box mt-3">
                    <p>BUỔI TIỆC ĐƯỢC TỔ CHỨC TẠI</p>
                    <h3 class="red-text">TƯ GIA NHÀ TRAI</h3>
                    <p>Xã An Phú, Tỉnh Quảng Ngãi</p>
                    <a href="https://www.google.com/maps/dir/?api=1&destination=15.11446336711209, 108.89726884229977" target="_blank" class="btn-map">Xem Chỉ Đường</a>
                </div>

                <div class="calendar-view mt-3">
    <h3 class="red-text">THÁNG 03 - 2026</h3>
    <div class="days-grid">
        <span>T2</span><span>T3</span><span>T4</span><span>T5</span><span class="red-text">T6</span><span>T7</span><span>CN</span>
        
        <span></span><span></span><span></span><span></span><span></span><span></span><span>1</span>
        
        <span>2</span><span>3</span><span>4</span><span>5</span><span>6</span><span>7</span><span>8</span>
        
        <span>9</span><span>10</span><span>11</span><span>12</span><span>13</span><span>14</span><span>15</span>
        
        <span>16</span><span>17</span><span>18</span><span>19</span><span class="highlight">20</span><span>21</span><span>22</span>
        
        <span>23</span><span>24</span><span>25</span><span>26</span><span>27</span><span>28</span><span>29</span>
        
        <span>30</span><span>31</span><span></span><span></span><span></span><span></span><span></span>
    </div>
</div>
            </section>

            <section class="section-gallery">
                <h2 class="section-title text-center">Album Hình Cưới</h2>
                <div class="gallery-grid">
                    <img src="images/2.jpg"
                        alt="Ảnh 1">
                    <img src="images/anh4.jpg"
                        alt="Ảnh 2">
                    <img src="images/2.jpg"
                        alt="Ảnh 2">
                    <img src="images/anh3.jpg"
                        alt="Ảnh 3" class="full-width">
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