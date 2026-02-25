<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=3.0, user-scalable=yes">
    <title>Thiệp Cưới Hoàng Rin & Thanh Thúy</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
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
        background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
        overflow-x: hidden;
    }

    :root {
        --red-bg: #9a0d14;
        --gold-text: #e0b976;
        --light-bg: #fdf8f5;
    }

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

    .mobile-wrapper {
        width: 100%;
        max-width: 100%;
        margin: 0 auto;
        background-color: var(--light-bg);
        position: relative;
        height: 100vh;
        overflow: hidden;
        transition: all 0.5s ease;
    }

    .mobile-wrapper.scrollable {
        height: auto;
        overflow: visible;
    }

    .envelope {
        position: fixed;
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
        font-size: clamp(1.8rem, 6vw, 3rem);
        color: var(--red-bg);
        text-align: center;
        margin: 10px 0;
        white-space: nowrap;
        width: 100%;
        display: block;
        line-height: 1.3;
        padding: 0 5px;
        overflow: visible;
    }

    @media (max-width: 480px) {
        .couple-name {
            font-size: clamp(1.6rem, 5vw, 2.2rem);
            white-space: nowrap;
            letter-spacing: -0.5px;
        }
    }

    @media (max-width: 360px) {
        .couple-name {
            font-size: clamp(1.4rem, 4.5vw, 1.8rem);
        }
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
        display: grid;
        grid-template-columns: 5fr 2fr 5fr;
        gap: 5px;
        width: 100%;
        align-items: start;
    }

    .parents-grid>div:first-child {
        text-align: center;
        padding-right: 10px;
    }

    .parents-grid>div:last-child {
        text-align: center;
        padding-left: 10px;
    }

    .parents-grid>div p {
        white-space: nowrap;
        overflow: visible;
        font-size: 0.95rem;
        margin: 5px 0;
    }

    .parents-grid>div p em {
        white-space: nowrap;
        font-size: 0.85rem;
        display: block;
        font-style: italic;
    }

    .divider {
        color: var(--red-bg);
        opacity: 0.5;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        grid-column: 2;
    }

    @media (max-width: 768px) {
        .parents-grid {
            grid-template-columns: 5fr 1.5fr 5fr;
            gap: 3px;
        }

        .parents-grid>div:first-child {
            padding-right: 5px;
        }

        .parents-grid>div:last-child {
            padding-left: 5px;
        }

        .parents-grid>div p {
            font-size: 0.85rem;
        }

        .parents-grid>div p em {
            font-size: 0.75rem;
        }

        .divider {
            font-size: 1.6rem;
        }

        .parents-grid h3 {
            font-size: 1rem;
            white-space: nowrap;
            margin-bottom: 8px;
        }
    }

    @media (max-width: 480px) {
        .parents-grid {
            grid-template-columns: 5fr 1.2fr 5fr;
            gap: 2px;
        }

        .parents-grid>div p {
            font-size: 0.8rem;
        }

        .parents-grid>div p em {
            font-size: 0.7rem;
        }

        .divider {
            font-size: 1.4rem;
        }

        .parents-grid h3 {
            font-size: 0.95rem;
        }
    }

    @media (max-width: 360px) {
        .parents-grid {
            grid-template-columns: 5fr 1fr 5fr;
        }

        .parents-grid>div p {
            font-size: 0.7rem;
        }

        .parents-grid>div p em {
            font-size: 0.6rem;
        }

        .divider {
            font-size: 1.2rem;
        }

        .parents-grid h3 {
            font-size: 0.85rem;
        }
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

    .calendar-view {
        max-width: 400px;
        margin: 20px auto 0;
        padding: 25px 20px;
        border: 2px solid var(--red-bg);
        border-radius: 15px;
        background-color: #ffffff;
        box-shadow: 0 5px 15px rgba(154, 13, 20, 0.1);
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

    .gallery-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .gallery-grid img {
        width: 100%;
        height: 250px;
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

    @media (min-width: 769px) {
        .mobile-wrapper {
            max-width: 700px;
            margin: 40px auto;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            height: calc(100vh - 80px);
        }

        section {
            padding: 50px 40px;
        }

        .couple-name {
            font-size: 3rem;
            white-space: nowrap;
        }

        .hero-image img {
            height: 100%;
        }

        .gallery-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .full-width {
            grid-column: span 3;
            height: 400px !important;
        }

        .parents-grid {
            gap: 15px;
        }

        .parents-grid>div p {
            font-size: 1rem;
            white-space: nowrap;
        }

        .parents-grid>div p em {
            font-size: 0.9rem;
            white-space: nowrap;
        }

        .divider {
            font-size: 2rem;
        }
    }

    @media (min-width: 1024px) {
        .mobile-wrapper {
            max-width: 850px;
            margin: 60px auto;
            height: calc(100vh - 120px);
        }

        .parents-grid {
            gap: 20px;
        }

        .hero-image img {
            height: 100%;
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

    .animate-on-scroll {
        opacity: 0;
        transform: translateY(60px);
        transition: opacity 1s ease-out, transform 1s ease-out;
    }

    .animate-on-scroll.is-visible {
        opacity: 1;
        transform: translateY(0);
    }

    #heart-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        pointer-events: none;
        z-index: 90;
        overflow: hidden;
    }

    .heart {
        position: absolute;
        top: -10vh;
        color: #ff4d4d;
        opacity: 0.8;
        animation: fall linear forwards;
    }

    @keyframes fall {
        0% {
            transform: translateY(-10vh) rotate(0deg);
            opacity: 0.8;
        }

        100% {
            transform: translateY(110vh) rotate(360deg);
            opacity: 0;
        }
    }

    .invitation-guest {
        font-family: 'Playfair Display', serif;
        font-size: 1.3rem;
        color: var(--red-bg, #9a0d14);
        margin: 0 auto 20px auto;
        font-style: italic;
        background: rgba(224, 185, 118, 0.1);
        padding: 10px 20px;
        border-radius: 50px;
        display: table;
        border: 1px dashed var(--gold-text, #e0b976);
        text-align: center;
    }

    .section-hero {
        text-align: center;
    }

    .guest-name {
        font-family: 'Dancing Script', cursive;
        font-size: 2rem;
        font-weight: bold;
        color: var(--red-bg, #9a0d14);
        margin: 0 5px;
        white-space: nowrap;
    }

    @media (max-width: 480px) {
        .invitation-guest {
            font-size: 1.1rem;
            padding: 8px 15px;
        }

        .guest-name {
            font-size: 1.6rem;
        }
    }

    @media (max-width: 360px) {
        .invitation-guest {
            font-size: 1rem;
        }

        .guest-name {
            font-size: 1.4rem;
        }
    }

    .invitation-guest {
        animation: fadeIn 1s ease-in-out;
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
            transform: translateY(-10px);
        }

        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
    </style>
</head>

<body>
    <audio id="bgMusic" loop>
        <source src="assets/nhac1.mp3" type="audio/mpeg">
    </audio>
    <div id="heart-container"></div>
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
            <section class="section-hero animate-on-scroll">
                <p class="sub-title">THƯ MỜI CƯỚI</p>
                <h1 class="couple-name">Hoàng Rin & Thanh Thúy</h1>
                <div class="time-box">
                    <p>Thứ 6 - 10:30</p>
                    <p class="big-date">20 . 03 . 2026</p>
                </div>
                <div id="guestInvitation" class="invitation-guest" style="display: none;">
                    <span>Kính mời:</span>
                    <span id="guestName" class="guest-name"></span>
                </div>
                <div class="hero-image">
                    <img src="images/chinh.jpg" alt="Ảnh cưới chính">
                </div>
            </section>
            <section class="section-parents text-center animate-on-scroll">
                <div class="parents-grid">
                    <div>
                        <h3 class="red-text">Nhà trai</h3>
                        <p>Ông: Đỗ Văn Kin</p>
                        <p>Bà: Lê Thị Mỹ</p>
                        <p><em>Xã An Phú, Tỉnh Quảng Ngãi</em></p>
                    </div>
                    <div class="divider">囍</div>
                    <div>
                        <h3 class="red-text">Nhà gái</h3>
                        <p>Ông: Lê Tân Núi</p>
                        <p>Bà: Võ Thị Thanh Thủy</p>
                        <p><em>Sa Huỳnh, Tỉnh Quảng Ngãi</em></p>
                    </div>
                </div>
                <div class="invite-text mt-3">
                    <p>Trân Trọng Báo Tin Lễ Thành Hôn Của</p>
                    <h2 class="couple-name-small">Đỗ Hoàng Rin</h2>
                    <p>&</p>
                    <h2 class="couple-name-small">Lê Võ Thanh Thúy</h2>
                </div>
                <img src="images/anh1.jpg" alt="Ảnh phụ" class="content-img">
            </section>
            <section class="section-event text-center animate-on-scroll">
                <h2 class="section-title">Lễ Thành Hôn</h2>
                <div class="date-box">
                    <p>Vào Lúc<br><strong>11 giờ 00</strong></p>
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
                    <a href="https://maps.google.com/?q=15.114808343987669, 108.89738915220063" target="_blank"
                        class="btn-map">Xem Chỉ Đường</a>
                </div>
                <div class="calendar-view mt-3">
                    <h3 class="red-text">THÁNG 03 - 2026</h3>
                    <div class="days-grid">
                        <span>T2</span><span>T3</span><span>T4</span><span>T5</span><span
                            class="red-text">T6</span><span>T7</span><span>CN</span>
                        <span></span><span></span><span></span><span></span><span></span><span></span><span>1</span>
                        <span>2</span><span>3</span><span>4</span><span>5</span><span>6</span><span>7</span><span>8</span>
                        <span>9</span><span>10</span><span>11</span><span>12</span><span>13</span><span>14</span><span>15</span>
                        <span>16</span><span>17</span><span>18</span><span>19</span><span
                            class="highlight">20</span><span>21</span><span>22</span>
                        <span>23</span><span>24</span><span>25</span><span>26</span><span>27</span><span>28</span><span>29</span>
                        <span>30</span><span>31</span><span></span><span></span><span></span><span></span><span></span>
                    </div>
                </div>
            </section>
            <section class="section-gallery animate-on-scroll">
                <h2 class="section-title text-center">Album Hình Cưới</h2>
                <div class="gallery-grid">
                    <img src="images/2.jpg" alt="Ảnh 1">
                    <img src="images/abum1.jpg" alt="Ảnh 2">
                    <img src="images/2.jpg" alt="Ảnh 3">
                    <img src="images/anh3.jpg" alt="Ảnh 4">
                </div>
            </section>
            <section class="section-thankyou text-center animate-on-scroll">
                <h1 class="couple-name">Thank you</h1>
                <p>Rất hân hạnh được đón tiếp!</p>
            </section>
        </div>
    </div>
    <script>
    (function() {
        const guestInvitation = document.getElementById('guestInvitation');
        const guestNameSpan = document.getElementById('guestName');

        function getGuestFromUrl() {
            const urlParams = new URLSearchParams(window.location.search);
            let guestName = urlParams.get('to');
            if (guestName && guestName.trim() !== '') {
                guestName = guestName.replace(/\+/g, ' ');
                try {
                    guestName = decodeURIComponent(guestName);
                } catch (e) {}
                guestName = guestName.trim();
                if (guestNameSpan) {
                    guestNameSpan.innerText = guestName;
                }
                if (guestInvitation) {
                    guestInvitation.style.display = 'table';
                }
            } else {
                if (guestInvitation) {
                    guestInvitation.style.display = 'none';
                }
            }
        }
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', getGuestFromUrl);
        } else {
            getGuestFromUrl();
        }
    })();

    const envelope = document.getElementById('envelope');
    const mobileWrapper = document.querySelector('.mobile-wrapper');
    const bgMusic = document.getElementById('bgMusic');
    const musicBtn = document.getElementById('musicBtn');
    const musicIcon = musicBtn.querySelector('i');

    let isMusicPlaying = false;
    let heartInterval;
    let scrollAnimationFrame = null;
    let isUserInteracted = false;

    function stopScroll() {
        if (scrollAnimationFrame) {
            cancelAnimationFrame(scrollAnimationFrame);
            scrollAnimationFrame = null;
        }
    }

    function openInvitation() {
        envelope.classList.add('is-open');
        setTimeout(() => {
            mobileWrapper.classList.add('scrollable');
            envelope.style.visibility = 'hidden';
            initScrollAnimation();
            heartInterval = setInterval(createHeart, 400);
            setTimeout(() => {
                if (!isUserInteracted) {
                    smoothScrollToBottom();
                }
            }, 1000);
        }, 1000);
        playMusic();
    }

    function smoothScrollToBottom() {
        stopScroll();
        const scrollHeight = document.body.scrollHeight;
        const windowHeight = window.innerHeight;
        const startY = window.scrollY;
        const distance = scrollHeight - startY - windowHeight + 150;
        const duration = 30000;
        let startTime = null;

        function animation(currentTime) {
            if (scrollAnimationFrame === null || isUserInteracted) return;
            if (startTime === null) startTime = currentTime;
            const timeElapsed = currentTime - startTime;
            const progress = Math.min(timeElapsed / duration, 1);
            const ease = t => t < 0.5 ? 2 * t * t : 1 - Math.pow(-2 * t + 2, 2) / 2;
            window.scrollTo(0, startY + distance * ease(progress));
            if (timeElapsed < duration && !isUserInteracted) {
                scrollAnimationFrame = requestAnimationFrame(animation);
            } else {
                scrollAnimationFrame = null;
            }
        }
        scrollAnimationFrame = requestAnimationFrame(animation);
    }

    function handleUserInteraction() {
        isUserInteracted = true;
        stopScroll();
    }

    function toggleMusic() {
        if (isMusicPlaying) {
            bgMusic.pause();
            musicBtn.classList.remove('spinning');
            musicIcon.classList.remove('fa-music');
            musicIcon.classList.add('fa-volume-mute');
        } else {
            bgMusic.play();
            musicBtn.classList.add('spinning');
            musicIcon.classList.remove('fa-volume-mute');
            musicIcon.classList.add('fa-music');
        }
        isMusicPlaying = !isMusicPlaying;
    }

    function playMusic() {
        bgMusic.play().then(() => {
            isMusicPlaying = true;
            musicBtn.classList.add('spinning');
        }).catch(() => {});
    }

    function initScrollAnimation() {
        const scrollElements = document.querySelectorAll('.animate-on-scroll');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                }
            });
        }, {
            threshold: 0.15
        });
        scrollElements.forEach(el => observer.observe(el));
    }

    function createHeart() {
        const heart = document.createElement('div');
        heart.classList.add('heart');
        heart.innerHTML = '❤';
        heart.style.left = Math.random() * 100 + 'vw';
        heart.style.animationDuration = Math.random() * 4 + 4 + 's';
        heart.style.fontSize = Math.random() * 1 + 0.8 + 'rem';
        document.getElementById('heart-container').appendChild(heart);
        setTimeout(() => {
            heart.remove();
        }, 8000);
    }

    window.addEventListener('load', function() {
        document.body.style.opacity = '1';
        musicBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            toggleMusic();
        });
        ['click', 'touchstart', 'scroll'].forEach(evt => {
            document.addEventListener(evt, function autoPlay() {
                playMusic();
                ['click', 'touchstart', 'scroll'].forEach(e => {
                    document.removeEventListener(e, autoPlay);
                });
            }, {
                once: true
            });
        });
    });

    document.addEventListener('visibilitychange', function() {
        if (document.hidden) {
            if (heartInterval) {
                clearInterval(heartInterval);
                heartInterval = null;
            }
        } else {
            if (!heartInterval && mobileWrapper.classList.contains('scrollable')) {
                heartInterval = setInterval(createHeart, 400);
            }
        }
    });

    window.addEventListener('scroll', function() {
        handleUserInteraction();
    });

    window.addEventListener('touchstart', function() {
        handleUserInteraction();
    });

    window.addEventListener('touchmove', function() {
        handleUserInteraction();
    });

    window.addEventListener('wheel', function() {
        handleUserInteraction();
    });

    window.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowUp' || e.key === 'ArrowDown' || e.key === 'PageUp' || e.key === 'PageDown' || e
            .key === 'Home' || e.key === 'End' || e.key === ' ') {
            handleUserInteraction();
        }
    });

    window.addEventListener('mousedown', function() {
        handleUserInteraction();
    });

    window.addEventListener('mousemove', function(e) {
        if (e.buttons === 1) {
            handleUserInteraction();
        }
    });
    </script>
</body>

</html>