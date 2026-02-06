<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding RIN & THÚY | CineLove</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background-color: #f8f1e9;
            color: #5a3921;
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .wedding-card {
            width: 100%;
            max-width: 420px;
            background-color: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(139, 69, 19, 0.15);
            position: relative;
        }

        /* Header section */
        .header {
            background: linear-gradient(135deg, #e6d1b8 0%, #d4b089 100%);
            padding: 30px 20px 20px;
            text-align: center;
            position: relative;
        }

        .wedding-title {
            font-size: 2.8rem;
            font-weight: 300;
            letter-spacing: 3px;
            color: #7a4a21;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .date-large {
            font-size: 2.2rem;
            color: #5a3921;
            font-weight: 300;
            margin-bottom: 5px;
        }

        .lunar-date {
            font-size: 1.2rem;
            color: #8b5a2b;
            margin-bottom: 15px;
        }

        .couple-name {
            font-size: 1.5rem;
            font-weight: 500;
            color: #7a4a21;
            margin: 15px 0;
            letter-spacing: 1px;
        }

        .invitation-label {
            display: inline-block;
            background-color: #b88a5c;
            color: white;
            padding: 8px 25px;
            border-radius: 30px;
            font-size: 1.1rem;
            letter-spacing: 1px;
            margin-top: 10px;
        }

        /* VỊ TRÍ 1: Ảnh cặp đôi chính - CSS */
        .couple-photo-container {
            width: 300px;
            height: 350px;
            margin: 15px auto;
            border-radius: 10%;
            overflow: hidden;
            border: 5px solid #d4b089;
            box-shadow: 0 5px 20px rgba(139, 69, 19, 0.3);
        }

        .couple-photo {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .couple-photo:hover {
            transform: scale(1.03);
        }

        /* VỊ TRÍ 2: Ảnh nền trang trí - CSS */
        .decoration-image {
            margin: 10px 0;
            text-align: center;
            opacity: 0.7;
        }

        /* VỊ TRÍ 3, 4, 5: Các ảnh khác - CSS */
        .poem-image, .location-image, .final-image {
            text-align: center;
            margin: 20px 0;
        }

        .poem-image img, .location-image img, .final-image img {
            width: 90%;
            border-radius: 8px;
            margin: 10px auto;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .location-image img:hover {
            transform: scale(1.02);
        }

        /* Poem section */
        .poem-section {
            padding: 30px 25px 25px;
            text-align: center;
            background-color: #fffaf3;
            position: relative;
        }

        .poem {
            font-size: 1.3rem;
            font-style: italic;
            color: #8b5a2b;
            margin-bottom: 20px;
            line-height: 1.8;
        }

        .dots {
            color: #b88a5c;
            font-size: 1.5rem;
            letter-spacing: 5px;
            margin: 10px 0;
        }

        /* Calendar section */
        .calendar-section {
            padding: 20px;
            background-color: white;
            text-align: center;
        }

        .year-month {
            font-size: 1.5rem;
            color: #7a4a21;
            margin-bottom: 15px;
            font-weight: 500;
        }

        .calendar {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 8px;
            margin-bottom: 25px;
        }

        .calendar-day {
            font-size: 0.85rem;
            color: #b88a5c;
            font-weight: 500;
            padding: 5px 0;
        }

        .calendar-date {
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            border-radius: 50%;
            color: #5a3921;
        }

        .calendar-date.wedding-day {
            background-color: #b88a5c;
            color: white;
            font-weight: bold;
        }

        .calendar-date.other-month {
            color: #d4b089;
        }

        /* Love section */
        .love-section {
            padding: 30px 25px;
            background-color: #fffaf3;
            text-align: center;
        }

        .fall-in-love {
            font-size: 1.8rem;
            color: #9c5d2c;
            font-weight: 300;
            margin-bottom: 25px;
            letter-spacing: 2px;
        }

        .love-word {
            font-size: 4.5rem;
            color: #b88a5c;
            font-weight: 300;
            line-height: 1;
            margin: 20px 0;
            letter-spacing: 5px;
        }

        .love-poem {
            font-size: 1.2rem;
            color: #8b5a2b;
            font-style: italic;
            line-height: 1.8;
            margin: 25px 0;
        }

        .quote {
            font-size: 1.1rem;
            color: #9c5d2c;
            font-style: italic;
            margin: 30px 0;
            padding: 0 10px;
            line-height: 1.7;
        }

        /* Wedding details */
        .details-section {
            padding: 30px 25px;
            background-color: white;
        }

        .details-title {
            font-size: 1.8rem;
            color: #7a4a21;
            text-align: center;
            margin-bottom: 25px;
            font-weight: 400;
            letter-spacing: 2px;
        }

        .time-date {
            background-color: #f8f1e9;
            border-radius: 15px;
            padding: 25px 20px;
            margin-bottom: 20px;
            text-align: center;
        }

        .time {
            font-size: 1.8rem;
            color: #b88a5c;
            margin-bottom: 10px;
        }

        .date-details {
            font-size: 1.4rem;
            color: #5a3921;
            margin-bottom: 8px;
        }

        .location {
            font-size: 1.3rem;
            color: #7a4a21;
            margin-top: 15px;
        }

        /* Hope message */
        .hope-message {
            padding: 30px 25px;
            background-color: #fffaf3;
            text-align: center;
            font-size: 1.3rem;
            color: #8b5a2b;
            line-height: 1.8;
        }

        /* Footer */
        .footer {
            padding: 25px 20px;
            background-color: #f8f1e9;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .send-wishes {
            background-color: #b88a5c;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 30px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .send-wishes:hover {
            background-color: #9c734c;
        }

        .heart-button {
            background-color: #e6a4a4;
            color: white;
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            font-size: 1.5rem;
            cursor: pointer;
            transition: transform 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .heart-button:hover {
            transform: scale(1.1);
        }

        .made-by {
            text-align: center;
            padding: 15px;
            background-color: #fffaf3;
            color: #b88a5c;
            font-size: 1rem;
        }

        .made-by span {
            color: #9c5d2c;
            font-weight: 500;
        }

        /* Decorative elements */
        .love-letter {
            font-size: 1.8rem;
            color: #b88a5c;
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }

        .love-letter span {
            margin: 0 5px;
            display: inline-block;
            transform: translateY(0);
            animation: float 3s ease-in-out infinite;
        }

        .love-letter span:nth-child(2) { animation-delay: 0.2s; }
        .love-letter span:nth-child(3) { animation-delay: 0.4s; }
        .love-letter span:nth-child(4) { animation-delay: 0.6s; }
        .love-letter span:nth-child(5) { animation-delay: 0.8s; }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .floral-border {
            height: 20px;
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='20' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M10,10 Q15,5 20,10 T30,10 T40,10 T50,10 T60,10 T70,10 T80,10 T90,10 T100,10' stroke='%23b88a5c' fill='transparent' stroke-width='1'/%3E%3C/svg%3E");
            background-repeat: repeat-x;
            opacity: 0.6;
            margin: 10px 0;
        }

        /* Music player */
        .music-player {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .music-icon {
            color: #b88a5c;
            font-size: 1.2rem;
        }

        .music-icon.playing {
            animation: rotate 5s linear infinite;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Responsive adjustments */
        @media (max-width: 480px) {
            .wedding-card {
                border-radius: 15px;
            }
            
            .wedding-title {
                font-size: 2.2rem;
            }
            
            .date-large {
                font-size: 1.8rem;
            }
            
            .couple-name {
                font-size: 1.5rem;
            }
            
            .love-word {
                font-size: 3.5rem;
            }
            
            .calendar-date {
                height: 30px;
                font-size: 0.9rem;
            }
            
            .couple-photo-container {
                width: 150px;
                height: 150px;
            }
        }
    </style>
</head>
<body>
    <div class="wedding-card">
        <!-- Music Player -->
        <div class="music-player" id="musicPlayer">
            <i class="fas fa-music music-icon" id="musicIcon"></i>
        </div>
        
        <!-- Header -->
        <div class="header">
            <h1 class="wedding-title">WEDDING</h1>
            <div class="date-large">20/03/2026</div>
            <div class="lunar-date">Nhằm ngày (02/02/2026)</div>
            
            <!-- VỊ TRÍ 1: Ảnh cặp đôi chính -->
            <div class="couple-photo-container">
                <!-- THAY ĐỔI LINK ẢNH TẠI ĐÂY -->
                <img src="https://img.cinelove.me/uploads/3eec4509-4df7-491a-9d7f-62d3acc79d9e/e0a3fb6a-d035-4dac-ba61-2b02544e8971.jpg?resize=1000x" 
                     alt="Hoàng Rin & Thanh Thúy" class="couple-photo">
            </div>
            
            <div class="couple-name">HOÀNG RIN ❤️ THANH THÚY</div>
            <div class="invitation-label">WEDDING INVITATION</div>
        </div>
        
        <!-- VỊ TRÍ 2: Ảnh nền trang trí -->
        <div class="decoration-image">
            <!-- THAY ĐỔI LINK ẢNH TẠI ĐÂY -->
            <img src="https://img.cinelove.me/uploads/3eec4509-4df7-491a-9d7f-62d3acc79d9e/e0a3fb6a-d035-4dac-ba61-2b02544e8971.jpg?resize=1000x" 
                 alt="Trang trí hoa" style="width: 100%; opacity: 0.1;">
        </div>
        
        <!-- Poem 1 -->
        <div class="poem-section">
            <div class="poem">
                Hôm nay anh học toán hình,<br>
                Tròn vuông chẳng có, toàn hình bóng em
            </div>
            <div class="dots">. . .</div>
            <div class="date-large" style="font-size: 1.8rem; margin-top: 10px;">2026.3</div>
            <div style="font-size: 3rem; color: #b88a5c; margin: 10px 0;">20</div>
            <div style="font-size: 1.5rem; color: #8b5a2b; margin-bottom: 20px;">Friday</div>
            
            <!-- VỊ TRÍ 3: Ảnh bên cạnh bài thơ -->
            <div class="poem-image">
                <!-- THAY ĐỔI LINK ẢNH TẠI ĐÂY -->
                <img src="https://img.cinelove.me/uploads/3eec4509-4df7-491a-9d7f-62d3acc79d9e/e0a3fb6a-d035-4dac-ba61-2b02544e8971.jpg?resize=1000x" 
                     alt="Hình ảnh tình yêu">
            </div>
        </div>
        
        <!-- Love Word -->
        <div class="love-letter">
            <span>Y</span><span>Ê</span><span>U</span>
        </div>
        
        <!-- Fall in Love -->
        <div class="love-section">
            <div class="fall-in-love">Fall in love with you</div>
            <div class="floral-border"></div>
            <div class="love-poem">
                Thương anh mấy núi cũng trèo,<br>
                Mấy sông cũng lội, mấy đèo cũng qua.<br>
                Thương anh không quản chi xa,<br>
                Đá vàng cũng quyết, phong ba cũng liều.
            </div>
            <div class="floral-border"></div>
            <div class="fall-in-love" style="margin-top: 30px;">FALL IN LOVE WITH YOU</div>
        </div>
        
        <!-- Wedding & Love -->
        <div class="poem-section" style="padding-top: 20px;">
            <div class="wedding-title" style="font-size: 2.2rem; margin-bottom: 10px;">WEDDING & LOVE</div>
            <div class="quote">
                "Môi hôn ngọt ngào, như hoa nở,<br>
                Trái tim rộn ràng, nhịp yêu vương."
            </div>
            <div class="love-word">20/3</div>
            <div class="love-letter" style="font-size: 1.5rem; margin: 10px 0;">
                <span>L</span><span>o</span><span>v</span><span>e</span>
            </div>
            <div style="color: #b88a5c; margin-top: 15px;">b gan</div>
        </div>
        
        <!-- Wedding Details -->
        <div class="details-section">
            <div class="details-title">WEDDING INVITATION</div>
            <div class="time-date">
                <div class="time">10h30p</div>
                <div class="date-details">Thứ 6, ngày 20 tháng 3 năm 2026</div>
                <div class="lunar-date">(nhằm ngày 2/2/2026 âm lịch)</div>
                <div class="location">Tại Tư Gia Nhà Trai</div>
                
                <!-- VỊ TRÍ 4: Ảnh địa điểm tổ chức -->
                <div class="location-image" style="margin-top: 20px;">
                    <!-- THAY ĐỔI LINK ẢNH TẠI ĐÂY -->
                    <img src="https://img.cinelove.me/uploads/3eec4509-4df7-491a-9d7f-62d3acc79d9e/e0a3fb6a-d035-4dac-ba61-2b02544e8971.jpg?resize=1000x" 
                         alt="Địa điểm tổ chức">
                </div>
            </div>
            <div class="details-title">WEDDING TIME</div>
            
            <!-- Calendar -->
            <div class="calendar-section">
                <div class="year-month">3.2026</div>
                <div class="calendar">
                    <div class="calendar-day">MON</div>
                    <div class="calendar-day">TUE</div>
                    <div class="calendar-day">WED</div>
                    <div class="calendar-day">THU</div>
                    <div class="calendar-day">FRI</div>
                    <div class="calendar-day">SAT</div>
                    <div class="calendar-day">SUN</div>
                    
                    <!-- March 2026 calendar dates -->
                    <div class="calendar-date other-month">1</div>
                    <div class="calendar-date other-month">2</div>
                    <div class="calendar-date other-month">3</div>
                    <div class="calendar-date other-month">4</div>
                    <div class="calendar-date other-month">5</div>
                    <div class="calendar-date other-month">6</div>
                    <div class="calendar-date">7</div>
                    <div class="calendar-date">8</div>
                    <div class="calendar-date">9</div>
                    <div class="calendar-date">10</div>
                    <div class="calendar-date">11</div>
                    <div class="calendar-date">12</div>
                    <div class="calendar-date">13</div>
                    <div class="calendar-date">14</div>
                    <div class="calendar-date">15</div>
                    <div class="calendar-date">16</div>
                    <div class="calendar-date">17</div>
                    <div class="calendar-date">18</div>
                    <div class="calendar-date">19</div>
                    <div class="calendar-date wedding-day">20</div>
                    <div class="calendar-date">21</div>
                    <div class="calendar-date">22</div>
                    <div class="calendar-date">23</div>
                    <div class="calendar-date">24</div>
                    <div class="calendar-date">25</div>
                    <div class="calendar-date">26</div>
                    <div class="calendar-date">27</div>
                    <div class="calendar-date">28</div>
                    <div class="calendar-date">29</div>
                    <div class="calendar-date">30</div>
                    <div class="calendar-date">31</div>
                </div>
                <div style="color: #9c5d2c; font-size: 1.2rem; margin-top: 10px;">2026</div>
            </div>
        </div>
        
        <!-- Hope Message -->
        <div class="hope-message">
            Rất hi vọng cậu sẽ có mặt<br>
            trong ngày trọng đại này của chúng mình nha<br><br>
            <div style="font-size: 1.8rem; color: #b88a5c; margin-top: 15px;">THƯƠNG</div>
        </div>
        
        <!-- VỊ TRÍ 5: Ảnh cuối trang -->
        <div class="final-image">
            <!-- THAY ĐỔI LINK ẢNH TẠI ĐÂY -->
            <img src="https://img.cinelove.me/uploads/3eec4509-4df7-491a-9d7f-62d3acc79d9e/e0a3fb6a-d035-4dac-ba61-2b02544e8971.jpg?resize=1000x" 
                 alt="Kết thúc đẹp">
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <button class="send-wishes">Gửi lời chúc...</button>
            <button class="heart-button">
                <i class="fas fa-heart"></i>
            </button>
        </div>
        
        <div class="made-by">
            Made with <span>Cinelove</span>
        </div>
    </div>
    
    <!-- Audio element for background music -->
    <audio id="backgroundMusic" loop autoplay>
        <source src="assets/nhac.mp3" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
    
    <script>
    const musicPlayer = document.getElementById('musicPlayer');
    const musicIcon = document.getElementById('musicIcon');
    const audio = document.getElementById('backgroundMusic');
    let isPlaying = false;

    // --- XỬ LÝ NHẠC TỰ ĐỘNG ---
    function playMusic() {
        if (!isPlaying) {
            audio.play().then(() => {
                isPlaying = true;
                musicIcon.classList.add('playing');
                removeListeners();
            }).catch(error => {
                console.log("Chờ tương tác để phát nhạc...");
            });
        }
    }

    function triggerPlay() { playMusic(); }
    function removeListeners() {
        document.removeEventListener('click', triggerPlay);
        document.removeEventListener('touchstart', triggerPlay);
        document.removeEventListener('scroll', triggerPlay);
    }

    document.addEventListener('click', triggerPlay);
    document.addEventListener('touchstart', triggerPlay);
    document.addEventListener('scroll', triggerPlay);

    musicPlayer.addEventListener('click', function(e) {
        e.stopPropagation();
        if (isPlaying) {
            audio.pause();
            musicIcon.classList.remove('playing');
            isPlaying = false;
        } else {
            audio.play();
            musicIcon.classList.add('playing');
            isPlaying = true;
        }
    });

    // --- HIỆU ỨNG TRÁI TIM RƠI DÀY ĐẶC ---
    function createFallingHeart() {
        const heart = document.createElement('div');
        heart.innerHTML = '<i class="fas fa-heart"></i>';
        
        // Cấu hình CSS cho trái tim
        heart.style.position = 'fixed';
        heart.style.top = '-20px'; 
        heart.style.left = Math.random() * 100 + 'vw'; 
        
        // Ngẫu nhiên màu sắc (các tông hồng và đỏ nhạt)
        const colors = ['#e6a4a4', '#ffb6c1', '#f08080', '#ffc0cb', '#d8b089'];
        heart.style.color = colors[Math.floor(Math.random() * colors.length)];
        
        heart.style.opacity = Math.random() * 0.8 + 0.2; 
        heart.style.fontSize = Math.random() * 18 + 8 + 'px'; 
        heart.style.zIndex = '999';
        heart.style.pointerEvents = 'none';
        
        // Tốc độ rơi ngẫu nhiên để tạo sự tự nhiên
        const duration = Math.random() * 4 + 3; 
        heart.style.transition = `transform ${duration}s linear, opacity ${duration}s ease-out`;
        
        document.body.appendChild(heart);

        // Kích hoạt hiệu ứng rơi
        setTimeout(() => {
            const sideMovement = Math.random() * 150 - 75; // Lắc lư sang hai bên
            heart.style.transform = `translateY(110vh) translateX(${sideMovement}px) rotate(${Math.random() * 720}deg)`;
            heart.style.opacity = '0';
        }, 50);

        // Xóa tim sau khi rơi xong
        setTimeout(() => { heart.remove(); }, duration * 1000);
    }

    // TĂNG MẬT ĐỘ: Cứ mỗi 150ms tạo một trái tim mới
    setInterval(createFallingHeart, 150);

    // NÚT THẢ TIM THỦ CÔNG: Nhấn vào là tung ra cả "cơn mưa" tim
    document.querySelector('.heart-button').addEventListener('click', function() {
        for (let i = 0; i < 20; i++) {
            setTimeout(createFallingHeart, i * 50);
        }
    });

    window.addEventListener('load', playMusic);
</script>
</body>
</html>