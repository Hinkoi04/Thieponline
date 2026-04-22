<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Lễ Tốt Nghiệp - Trần Thị Tố Nhi</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&family=Pinyon+Script&family=Montserrat:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --font-serif: 'Cormorant Garamond', serif;
            --font-sans: 'Montserrat', sans-serif;
            --font-script: 'Pinyon Script', cursive; 
            --text-main: #222;
            --text-light: #666;
            --accent: #a87b51; 
            --bg-body: #ececec;
            --bg-card: #ffffff;
        }

        /* ẨN THANH CUỘN & TỐI ƯU CUỘN MƯỢT TRÊN MOBILE */
        ::-webkit-scrollbar { display: none; }
        html { 
            -ms-overflow-style: none; scrollbar-width: none; 
            scroll-behavior: smooth; 
            -webkit-overflow-scrolling: touch; 
        }
        body { background: #111; margin: 0; padding: 0; font-family: var(--font-serif); color: var(--text-main); display: flex; justify-content: center; -webkit-font-smoothing: antialiased; }
        body.locked { overflow: hidden; }

        /* TỐI ƯU HIỆU NĂNG RENDER */
        .wrapper { max-width: 450px; width: 100%; background: var(--bg-card); position: relative; box-shadow: 0 0 30px rgba(0,0,0,0.5); overflow-x: hidden; min-height: 100vh; will-change: transform;}
        img { max-width: 100%; height: auto; }

        /* =======================================================
           MÀN HÌNH INTRO (MŨ TÁCH)
           ======================================================= */
        #intro-overlay { position: fixed; top: 0; left: 50%; transform: translateX(-50%); width: 100%; max-width: 450px; height: 100vh; z-index: 99999; cursor: pointer; overflow: hidden; display: flex; justify-content: center; box-shadow: 0 0 40px rgba(0,0,0,0.8); }
        .intro-bottom { position: absolute; top: 0; left: 0; width: 100%; height: 100vh; background: #dcdcdc; transition: transform 2s cubic-bezier(0.68, -0.05, 0.27, 1); z-index: 2; will-change: transform; }
        .intro-bottom-content { position: absolute; top: 55%; left: 0; width: 100%; display: flex; justify-content: space-between; align-items: flex-start; padding: 0 25px; box-sizing: border-box; }
        .intro-school { font-family: var(--font-sans); font-weight: 800; color: #fff; text-transform: uppercase; width: 50%; line-height: 1.2; text-align: left; text-shadow: 2px 2px 8px rgba(0,0,0,0.6); letter-spacing: 1px; }
        .intro-school .school-label { font-size: 0.9rem; }
        .intro-school .school-name { font-size: 0.85rem; display: block; }
        .intro-date-box { text-align: right; color: #fff; font-family: var(--font-sans); font-weight: 800; text-shadow: 2px 2px 8px rgba(0,0,0,0.6); }
        .intro-date-day { font-size: 3rem; line-height: 1; letter-spacing: 2px;}
        .intro-date-year { font-size: 2.2rem; line-height: 1; margin-top: 5px; color: #fff;}
        
        .intro-top { position: absolute; top: 0; left: 0; width: 100%; height: 100vh; background: #111; clip-path: polygon(0 0, 100% 0, 100% 45%, 50% 50%, 0 45%); transition: transform 2s cubic-bezier(0.68, -0.05, 0.27, 1); z-index: 3; will-change: transform; }
        .cap-text { position: absolute; top: 20%; left: 50%; transform: translateX(-50%); color: #fff; font-family: var(--font-sans); font-size: 2rem; font-weight: 800; letter-spacing: 5px; text-shadow: 0 4px 10px rgba(0,0,0,0.8); width: 100%; text-align: center; }
        
        .tassel-wrapper { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -2px); display: flex; flex-direction: column; align-items: center; z-index: 4; transition: transform 2s cubic-bezier(0.68, -0.05, 0.27, 1); will-change: transform; }
        .tassel-line { width: 4px; height: 110px; background: #d4af37; box-shadow: 2px 2px 5px rgba(0,0,0,0.3); }
        .tassel-knot { width: 14px; height: 14px; background: #b8860b; border-radius: 50%; border: 2px solid #ffd700; box-shadow: 2px 2px 5px rgba(0,0,0,0.3);}
        .tassel-fringe { width: 20px; height: 70px; background: repeating-linear-gradient(90deg, #d4af37, #d4af37 2px, #b8860b 2px, #b8860b 4px); border-radius: 0 0 5px 5px; box-shadow: 2px 2px 5px rgba(0,0,0,0.3);}
        
        .click-hint { position: absolute; bottom: 30px; left: 50%; transform: translateX(-50%); z-index: 5; font-family: var(--font-sans); font-size: 0.7rem; color: #fff; text-shadow: 1px 1px 3px #000; text-transform: uppercase; letter-spacing: 2px; animation: pulseHint 1.5s infinite; }
        @keyframes pulseHint { 0%, 100% { opacity: 0.3; } 50% { opacity: 1; } }

        #intro-overlay.open .intro-top { transform: translateY(-100%); }
        #intro-overlay.open .tassel-wrapper { transform: translate(-50%, -100vh); } 
        #intro-overlay.open .intro-bottom { transform: translateY(100%); }

        /* ================== GIAO DIỆN CHÍNH THIỆP MỜI ================== */
        #main-content { opacity: 0; transition: opacity 2s ease-in-out; }
        #main-content.visible { opacity: 1; }

        .hero { height: 100vh; position: relative; background-image: url('uploads/hero_default.jpg'); background-size: cover; background-position: center; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; } 
        .hero::before { content: ''; position: absolute; inset: 0; background: linear-gradient(180deg, rgba(0,0,0,0.2) 0%, rgba(0,0,0,0.8) 100%); z-index: 1; }
        .hero-content { position: relative; z-index: 2; color: #fff; padding: 0 15px; width: 100%; box-sizing: border-box; top: 10%;}
        
        /* CHỈNH FONT RESPONSIVE: ÉP TRÊN 1 HÀNG KHÔNG BỊ TRÀN */
        .hero h1 { 
            font-family: var(--font-script); 
            font-size: clamp(2.2rem, 9vw, 3.2rem); /* Giới hạn max 3.2rem để ko to trên PC */
            font-weight: normal; margin: 0; padding: 10px 0;
            text-shadow: 2px 4px 8px rgba(0,0,0,0.6); line-height: 1.2; 
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: 100%;
        }
        .hero .subtitle { font-family: var(--font-sans); font-size: 0.75rem; font-weight: 500; letter-spacing: 4px; margin: 15px 0 10px; opacity: 0.9; text-transform: uppercase;}
        .hero .date { font-family: var(--font-sans); font-size: 1.1rem; letter-spacing: 2px; font-weight: 400; margin-bottom: 30px;}

        .invite-box { margin-top: 20px; padding: 15px 30px; background: rgba(0, 0, 0, 0.4); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 12px; backdrop-filter: blur(4px); display: inline-block; box-shadow: 0 4px 15px rgba(0,0,0,0.3); max-width: 90%;}
        .invite-label { font-family: var(--font-sans); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 3px; margin: 0 0 5px 0; color: #ddd; }
        .invite-name { 
            font-family: var(--font-script); 
            font-size: clamp(1.8rem, 8vw, 2.8rem); 
            margin: 0; padding: 5px 0; color: var(--accent); 
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5); line-height: 1; 
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: 100%;
        }

        .section { padding: 50px 25px; text-align: center; }
        .quote-box { font-size: 1.2rem; font-style: italic; color: var(--text-light); line-height: 1.7; position: relative; padding: 20px;}
        .quote-box::before, .quote-box::after { content: ''; position: absolute; width: 30px; height: 1px; background: #ddd; left: 50%; transform: translateX(-50%); }
        .quote-box::before { top: 0; } .quote-box::after { bottom: 0; }

        .title-sm { font-family: var(--font-sans); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 3px; color: var(--text-light); margin-bottom: 5px; }
        
        .title-script-full { 
            font-family: var(--font-script); 
            font-size: clamp(2.2rem, 9vw, 3.2rem); 
            color: var(--text-main); margin: 0 0 15px; padding: 5px 0;
            font-weight: normal; line-height: 1.2; 
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: 100%;
        }
        .title-script { 
            font-family: var(--font-script); 
            font-size: clamp(2.5rem, 10vw, 3.5rem); 
            color: var(--text-main); margin: 0 0 15px; padding: 5px 0; font-weight: normal; 
        }

        .text-desc { font-family: var(--font-sans); font-size: 0.85rem; line-height: 1.8; color: #555; text-align: justify; font-weight: 300;}

        .photo-row { display: flex; gap: 4px; margin: 10px 0 40px; }
        .photo-row img { flex: 1; width: 33.33%; aspect-ratio: 3/4; object-fit: cover; border-radius: 2px;}

        .calendar-wrap { padding: 30px 15px; }
        .cal-table { width: 100%; border-collapse: collapse; font-family: var(--font-sans); font-size: 0.8rem; font-weight: 400; color: #444; margin-bottom: 25px;}
        .cal-table th { padding: 12px 0; color: #000; font-weight: 600; font-size: 0.75rem; letter-spacing: 1px;}
        .cal-table td { padding: 10px 0; text-align: center; }
        .cal-table td.empty { color: #ccc; }
        .day-active { display: inline-flex; justify-content: center; align-items: center; width: 28px; height: 28px; background: var(--accent); color: #fff; border-radius: 50%; box-shadow: 0 4px 10px rgba(168,123,81,0.4); font-weight: 600;}

        .date-block { display: flex; justify-content: center; align-items: center; border-top: 1px solid #eee; border-bottom: 1px solid #eee; padding: 25px 0; margin: 30px 0; gap: 30px;}
        .d-item { text-align: center; font-family: var(--font-sans); }
        .d-item span { display: block; font-size: 0.7rem; color: #999; letter-spacing: 2px; margin-bottom: 8px;}
        .d-item strong { font-size: 1.4rem; font-weight: 400; color: #333;}
        .d-item.main strong { font-size: 3.2rem; font-weight: 500; color: var(--accent); line-height: 1;}

        .btn { display: inline-block; padding: 12px 25px; border: 1px solid var(--text-main); color: var(--text-main); text-decoration: none; font-family: var(--font-sans); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; transition: 0.3s; background: transparent; cursor: pointer; border-radius: 4px; margin-top: 15px;}
        .btn:hover { background: var(--text-main); color: #fff; }

        .timeline { text-align: left; padding-left: 20px; border-left: 1px solid #ccc; margin-top: 30px; margin-left: 10px;}
        .t-item { position: relative; padding-bottom: 30px; padding-left: 20px;}
        .t-item:last-child { padding-bottom: 0; border-left: 1px solid #fff; margin-left: -1px;}
        .t-item::before { content: ''; position: absolute; left: -5px; top: 2px; width: 9px; height: 9px; background: var(--accent); border-radius: 50%; box-shadow: 0 0 0 3px #fff;}
        .t-time { font-family: var(--font-sans); font-weight: 600; font-size: 0.9rem; margin-bottom: 5px; color: #000;}
        .t-desc { font-family: var(--font-serif); font-size: 1.1rem; color: #555;}

        .album-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; padding: 0 15px;}
        .album-item { position: relative; aspect-ratio: 1/1; overflow: hidden; }
        .album-item img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;}
        .album-item:hover img { transform: scale(1.05); }
        .album-text { background: #f8f8f8; display: flex; align-items: center; justify-content: center; padding: 20px; text-align: center; font-family: var(--font-sans); font-size: 0.75rem; line-height: 1.6; color: #666;}

        .rsvp-wrap { background: #fbfbfb; padding: 50px 25px; border-top: 1px solid #eee;}
        .form-control { width: 100%; padding: 15px; margin-bottom: 15px; border: 1px solid #ddd; background: #fff; font-family: var(--font-sans); font-size: 0.85rem; box-sizing: border-box; outline: none; border-radius: 4px;}
        textarea.form-control { resize: vertical; min-height: 80px;}

        .countdown { display: flex; justify-content: center; gap: 10px; font-family: var(--font-sans); margin: 30px 0;}
        .cd-item { text-align: center; min-width: 50px;}
        .cd-num { font-size: 2rem; font-weight: 300; color: #000; line-height: 1;}
        .cd-label { font-size: 0.65rem; color: #999; text-transform: uppercase; letter-spacing: 1px; margin-top: 5px;}
        
        .thank-you { font-family: var(--font-script); font-size: clamp(2.8rem, 10vw, 4rem); color: var(--text-main); line-height: 1; margin: 40px 0 20px;}
        
        .map-container { border-radius: 8px; overflow: hidden; margin-top: 15px; border: 1px solid #eee;}

        /* NÚT CUỘN LÊN ĐẦU TRANG */
        #scrollTopBtn {
            position: fixed; bottom: 30px; right: 20px; z-index: 9999;
            width: 45px; height: 45px; border-radius: 50%;
            background: rgba(168, 123, 81, 0.85); color: #fff; border: 2px solid #fff;
            font-size: 1.5rem; cursor: pointer; display: flex; align-items: center; justify-content: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3); transition: all 0.3s ease;
            opacity: 0; visibility: hidden; transform: translateY(20px);
        }
        #scrollTopBtn.show { opacity: 1; visibility: visible; transform: translateY(0); }
        #scrollTopBtn:hover { background: #111; transform: scale(1.1); }
    </style>
</head>

<body class="locked">
    <div id="intro-overlay">
        <div class="intro-bottom">
            <div class="intro-bottom-content">
                <div class="intro-school">
                    <span class="school-label">TRƯỜNG ĐẠI HỌC</span><br>
                    <span class="school-name">NGUYỄN TẤT THÀNH</span>
                </div>
                <div class="intro-date-box">
                    <div class="intro-date-day">22/04</div>
                    <div class="intro-date-year">2026</div>
                </div>
            </div>
        </div>

        <div class="intro-top">
            <div class="cap-text">GRADUATION</div>
        </div>

        <div class="tassel-wrapper">
            <div class="tassel-line"></div>
            <div class="tassel-knot"></div>
            <div class="tassel-fringe"></div>
        </div>

        <div class="click-hint">Chạm để mở thiệp</div>
    </div>

<div class="wrapper" id="main-content">

    <div class="hero">
        <div class="hero-content" data-aos="fade-in" data-aos-duration="2000">
            <h1>Trần Thị Tố Nhi</h1>
            <div class="subtitle">Lễ Tốt Nghiệp</div>
            <div class="date">22.04.2026</div>

            <div class="invite-box" id="inviteBox" style="display: none;" data-aos="zoom-in" data-aos-delay="500" data-aos-duration="1500">
                <p class="invite-label">Kính mời</p>
                <p class="invite-name" id="guestNameDisplay"></p>
            </div>
        </div>
    </div>

    <div class="section" data-aos="fade-up">
        <div class="quote-box">"Mong những lời chúc phúc của bạn ngày chia tay là chiếc ô che nắng, che mưa cho tôi vượt mọi chông gai đời người."</div>
    </div>

    <div class="section" style="padding-top: 0;" data-aos="fade-up">
        <div class="title-sm">Tân cử nhân</div>
        <div class="title-script-full">Trần Thị Tố Nhi</div>
        
        <div class="photo-row">
            <img src="uploads/avatar_default.jpg" loading="lazy" alt="Ảnh trái">
            <img src="uploads/hero_default.jpg" loading="lazy" alt="Ảnh giữa">
            <img src="uploads/avatar_default.jpg" loading="lazy" alt="Ảnh phải">
        </div>

        <div class="text-desc">
            Tốt nghiệp là dấu mốc kết thúc một hành trình và mở ra một chặng đường mới. Tôi biết phía trước sẽ không dễ dàng, nhưng tôi tin vào bản thân, vào những gì mình đã học được. Cảm ơn thanh xuân vì đã rực rỡ đến thế! 🎓✨
        </div>
    </div>

    <div class="section calendar-wrap" data-aos="fade-up">
        
        <div id="dynamicInviteHeader" style="display: none;">
            <div class="title-sm" style="color: #222; font-weight: 600;">THÂN MỜI</div>
            <div style="font-family: var(--font-script); font-size: clamp(2.5rem, 10vw, 3.5rem); color: var(--accent); line-height: 1.2; margin: 10px 0; padding: 10px 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: 100%;" id="guestNameText">
                </div>
            <div class="title-sm" style="color: #222; font-weight: 600;">ĐẾN DỰ LỄ TỐT NGHIỆP CỦA MÌNH</div>
        </div>

        <div id="defaultInviteHeader">
            <div class="title-script">Thân mời</div>
            <div class="title-sm" style="color: #222; font-weight: 600;">CÔ, CHÚ, ANH, CHỊ ĐẾN DỰ LỄ TỐT NGHIỆP</div>
        </div>

        <div class="title-script" style="margin: 30px 0 10px;">Tháng 04</div>

        <table class="cal-table">
            <tr><th>T2</th><th>T3</th><th>T4</th><th>T5</th><th>T6</th><th>T7</th><th>CN</th></tr>
            <tr>
                <td class="empty">30</td><td class="empty">31</td>
                <td><span>1</span></td><td><span>2</span></td><td><span>3</span></td><td><span>4</span></td><td><span>5</span></td>
            </tr>
            <tr>
                <td><span>6</span></td><td><span>7</span></td><td><span>8</span></td><td><span>9</span></td><td><span>10</span></td><td><span>11</span></td><td><span>12</span></td>
            </tr>
            <tr>
                <td><span>13</span></td><td><span>14</span></td><td><span>15</span></td><td><span>16</span></td><td><span>17</span></td><td><span>18</span></td><td><span>19</span></td>
            </tr>
            <tr>
                <td><span>20</span></td><td><span>21</span></td>
                <td><span class="day-active">22</span></td> <td><span>23</span></td><td><span>24</span></td><td><span>25</span></td><td><span>26</span></td>
            </tr>
            <tr>
                <td><span>27</span></td><td><span>28</span></td><td><span>29</span></td><td><span>30</span></td>
                <td class="empty">1</td><td class="empty">2</td><td class="empty">3</td>
            </tr>
        </table>

        <div class="title-sm" style="color:#000; letter-spacing: 1px;">LỄ TỐT NGHIỆP ĐƯỢC TỔ CHỨC<br>VÀO LÚC 07:30 PHÚT</div>

        <div class="date-block">
            <div class="d-item"><span>THÁNG</span><strong>04</strong></div>
            <div class="d-item main"><span>THỨ TƯ</span><strong>22</strong></div>
            <div class="d-item"><span>NĂM</span><strong>2026</strong></div>
        </div>

        <h3 style="font-family: var(--font-sans); font-size: 1rem; font-weight: 600; margin: 0 0 5px; text-transform: uppercase;">Trường Đại học Nguyễn Tất Thành</h3>
        <p style="font-family: var(--font-sans); font-size: 0.8rem; color: #666; margin-bottom: 5px;">📍 Địa chỉ khuôn viên trường</p>
        
        <div class="map-container">
            <iframe 
                width="100%" height="200" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" loading="lazy"
                src="https://maps.google.com/maps?q=10.762622,106.660172&hl=vi&z=15&output=embed">
            </iframe>
        </div>

        <a href="https://www.google.com/maps/dir/?api=1&destination=10.762622,106.660172" target="_blank" class="btn">Chỉ đường Map</a>
    </div>

    <div class="section" data-aos="fade-up">
        <div class="title-sm">Sự kiện</div>
        <div style="font-family: var(--font-sans); font-size: 1.2rem; font-weight: 500; letter-spacing: 4px; text-transform: uppercase;">Quan trọng</div>
        
        <div class="timeline">
            <div class="t-item" data-aos="fade-up" data-aos-offset="50">
                <div class="t-time">07:30</div>
                <div class="t-desc">Đón khách & Ổn định chỗ ngồi</div>
            </div>
            <div class="t-item" data-aos="fade-up" data-aos-offset="50">
                <div class="t-time">08:00</div>
                <div class="t-desc">Bắt đầu Lễ Trao Bằng</div>
            </div>
            <div class="t-item" data-aos="fade-up" data-aos-offset="50">
                <div class="t-time">10:30</div>
                <div class="t-desc">Chụp ảnh lưu niệm & Chung vui</div>
            </div>
        </div>
    </div>

    <div class="section" style="padding-bottom: 20px;" data-aos="fade-up">
        <div class="title-script" style="text-align: left; padding-left: 10px;">Album Tốt nghiệp</div>
    </div>
    <div class="album-grid" data-aos="fade-up">
        <div class="album-item"><img src="uploads/avatar_default.jpg" loading="lazy" alt="Album 1"></div>
        <div class="album-text">Cánh cửa đại học khép lại, mở ra vô vàn cơ hội mới.</div>
        <div class="album-text">Có những khoảnh khắc trôi qua rồi mới biết thế nào là vô giá. Trân trọng!</div>
        <div class="album-item"><img src="uploads/hero_default.jpg" loading="lazy" alt="Album 2"></div>
    </div>

    <div class="rsvp-wrap" id="rsvp">
        <div class="title-script" style="text-align: center;">Sổ lưu bút</div>
        <p class="text-desc" style="text-align: center; margin-bottom: 25px;">
            Sự hiện diện của bạn là niềm vinh hạnh cho buổi lễ tốt nghiệp của mình.
        </p>

        <form onsubmit="alert('Xin chào! Form này hiện chỉ để hiển thị giao diện vì trang web đang chạy ở chế độ tĩnh (không dùng database).'); return false;" data-aos="fade-up">
            <input type="text" id="rsvpNameInput" class="form-control" placeholder="Tên của bạn" required>
            <textarea class="form-control" placeholder="Gửi lời chúc mừng đến Nhi..." required></textarea>
            <select class="form-control" required>
                <option value="Sẽ đến">Mình chắc chắn sẽ đến</option>
                <option value="Không đến">Xin lỗi mình bận rồi!</option>
            </select>
            <button type="submit" class="btn" style="width: 100%; background: var(--text-main); color: #fff; border:none; padding: 15px;">Gửi Lời Nhắn</button>
        </form>
    </div>

    <div class="section" style="padding-top: 50px;">
        <div class="title-sm" style="color: #222;">Cảm ơn bạn rất nhiều vì đã gửi lời chúc mừng!</div>
        <div class="title-script" style="margin-top: 20px;">Thời gian</div>
        
        <div class="countdown" id="countdown" data-aos="zoom-in">
            <div class="cd-item"><div class="cd-num" id="days">00</div><div class="cd-label">Ngày</div></div><div class="cd-num" style="color:#ccc;">:</div>
            <div class="cd-item"><div class="cd-num" id="hours">00</div><div class="cd-label">Giờ</div></div><div class="cd-num" style="color:#ccc;">:</div>
            <div class="cd-item"><div class="cd-num" id="minutes">00</div><div class="cd-label">Phút</div></div><div class="cd-num" style="color:#ccc;">:</div>
            <div class="cd-item"><div class="cd-num" id="seconds">00</div><div class="cd-label">Giây</div></div>
        </div>

        <div class="thank-you" data-aos="fade-up">Trân trọng cảm ơn</div>
    </div>

</div>

<button id="scrollTopBtn" title="Lên đầu trang">↑</button>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    // Lấy tên khách từ URL
    const urlParams = new URLSearchParams(window.location.search);
    const guestName = urlParams.get('to');
    
    if (guestName && guestName.trim() !== '') {
        document.getElementById('inviteBox').style.display = 'inline-block';
        document.getElementById('guestNameDisplay').innerText = guestName;
        
        document.getElementById('defaultInviteHeader').style.display = 'none';
        document.getElementById('dynamicInviteHeader').style.display = 'block';
        document.getElementById('guestNameText').innerText = guestName;
        
        document.getElementById('rsvpNameInput').value = guestName;
    }

    // Cuộn tự động mượt mà
    let autoScrollReq;
    let isAutoScrolling = false;
    let scrollPos = 0;

    function autoScroll() {
        if (!isAutoScrolling) return;
        scrollPos += 1.5; 
        window.scrollTo(0, scrollPos);
        
        if ((window.innerHeight + window.scrollY) >= document.documentElement.scrollHeight - 10) {
            isAutoScrolling = false;
            return;
        }
        autoScrollReq = requestAnimationFrame(autoScroll);
    }

    function stopAutoScroll() {
        if (isAutoScrolling) {
            isAutoScrolling = false;
            cancelAnimationFrame(autoScrollReq);
        }
    }

    window.addEventListener('touchstart', stopAutoScroll, {passive: true});
    window.addEventListener('touchmove', stopAutoScroll, {passive: true});
    window.addEventListener('wheel', stopAutoScroll, {passive: true});
    window.addEventListener('mousedown', stopAutoScroll);

    // Mở Intro tách 2 phần Mũ và Nền xám
    const introOverlay = document.getElementById('intro-overlay');
    const mainContent = document.getElementById('main-content');
    const clickHint = document.querySelector('.click-hint');
    
    introOverlay.addEventListener('click', function() {
        introOverlay.classList.add('open');
        clickHint.style.display = 'none'; 
        
        setTimeout(() => { mainContent.classList.add('visible'); }, 400); 
        
        setTimeout(() => {
            introOverlay.style.display = 'none';
            document.body.classList.remove('locked');
            AOS.init({ once: false, offset: 50, duration: 800, easing: 'ease-out-cubic' });

            scrollPos = window.scrollY;
            isAutoScrolling = true;
            autoScroll();
        }, 2000); 
    });

    // Nút cuộn lên đầu
    const scrollTopBtn = document.getElementById("scrollTopBtn");
    window.addEventListener('scroll', function() {
        const scrollableHeight = document.documentElement.scrollHeight - window.innerHeight;
        const scrolled = window.scrollY;
        if (scrolled > (scrollableHeight * 0.3)) {
            scrollTopBtn.classList.add("show");
        } else {
            scrollTopBtn.classList.remove("show");
        }
    });

    scrollTopBtn.addEventListener('click', function() {
        stopAutoScroll();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    // Đếm ngược
    const countDownDate = new Date("2026-04-22T07:30:00").getTime();

    const x = setInterval(function() {
        const now = new Date().getTime();
        const distance = countDownDate - now;

        if (distance < 0) {
            clearInterval(x);
            document.getElementById("countdown").innerHTML = "<div style='font-family: var(--font-sans); font-size:1.2rem; color:#a87b51; font-weight:500;'>Sự kiện đã diễn ra</div>";
            return;
        }

        document.getElementById("days").innerText = Math.floor(distance / (1000 * 60 * 60 * 24)).toString().padStart(2, '0');
        document.getElementById("hours").innerText = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)).toString().padStart(2, '0');
        document.getElementById("minutes").innerText = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)).toString().padStart(2, '0');
        document.getElementById("seconds").innerText = Math.floor((distance % (1000 * 60)) / 1000).toString().padStart(2, '0');
    }, 1000);
</script>

</body>
</html>