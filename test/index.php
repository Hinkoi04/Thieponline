<?php
// GỌI KẾT NỐI DATABASE (Đảm bảo file db.php đã sẵn sàng)
require 'db.php';

$toast_msg = '';
$toast_class = '';
$guest_name_url = isset($_GET['to']) ? htmlspecialchars(trim($_GET['to'])) : '';

// XỬ LÝ LỜI CHÚC
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_rsvp'])) {
    $name = htmlspecialchars(trim($_POST['rsvp_name']));
    $message = htmlspecialchars(trim($_POST['rsvp_message']));
    
    if (!empty($name) && !empty($message)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO rsvp_messages (guest_name, message) VALUES (?, ?)");
            if ($stmt->execute([$name, $message])) {
                $toast_msg = "✨ Cảm ơn $name đã gửi lời chúc phúc! ❤️";
                $toast_class = "show";
            }
        } catch (PDOException $e) {
            $toast_msg = "❌ Lỗi Database: " . $e->getMessage();
            $toast_class = "show";
        }
    } else {
        $toast_msg = "⚠️ Vui lòng nhập đầy đủ thông tin!";
        $toast_class = "show";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>Thiệp Cưới - Hoàng Rin & Thanh Thủy</title>
  <meta name="description" content="Trân trọng kính mời bạn đến dự tiệc cưới của chúng mình!">
  <meta property="og:title" content="Save The Date | Hoàng Rin ❤️ Thanh Thủy">
  <meta property="og:description" content="Trân trọng kính mời bạn đến dự tiệc cưới của chúng mình!">
  <meta property="og:image" content="https://dovanhin04.id.vn/Wedding/uploads/thumb.jpg">
  <meta property="og:url" content="https://dovanhin04.id.vn/Wedding/">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,400&family=Pinyon+Script&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
  *{margin:0;padding:0;box-sizing:border-box}
  ::-webkit-scrollbar{display:none}
  html{-ms-overflow-style:none;scrollbar-width:none;scroll-behavior:smooth;-webkit-overflow-scrolling:touch}

  :root{
    --rose: #d69f8c;       /* Hồng nhạt / Rose Gold */
    --blush: #fdf6f5;      /* Nền trắng hồng */
    --wine: #722f37;       /* Đỏ rượu vang */
    --text-main: #4a3b32;  /* Nâu xám mềm mại */
    --text-light: #8c7b70; 
    --white: #ffffff;
    --serif: 'Cormorant Garamond', serif;
    --sans: 'Montserrat', sans-serif;
    --script: 'Pinyon Script', cursive;
  }
  body{ background:#f5ebe9; font-family:var(--serif); display:flex; justify-content:center; -webkit-font-smoothing:antialiased; overflow-x:hidden; }
  body.locked{overflow:hidden}

  .wrapper{ max-width:430px; width:100%; background:var(--blush); position:relative; overflow-x:hidden; min-height:100vh; margin: 0 auto; box-shadow: 0 0 30px rgba(0,0,0,0.05); }

  /* ================= UI CAO CẤP ================= */
  #scroll-progress { position: fixed; top: 0; left: 50%; transform: translateX(-50%); width: min(430px, 100vw); height: 4px; background: rgba(214,159,140,0.2); z-index: 99999; }
  #scroll-progress-bar { height: 100%; background: linear-gradient(90deg, #f8e1e7, var(--rose)); width: 0%; border-radius: 0 2px 2px 0; transition: width 0.1s; }

  #music-btn { position: fixed; bottom: 30px; right: calc(50vw - 195px); z-index: 9999; width: 42px; height: 42px; background: rgba(255,255,255,0.9); border-radius: 50%; display: flex; justify-content: center; align-items: center; box-shadow: 0 4px 15px rgba(214,159,140,0.3); cursor: pointer; backdrop-filter: blur(5px); border: 1px solid rgba(214,159,140,0.3); animation: spinDisc 4s linear infinite; animation-play-state: paused; }
  @media (max-width: 430px) { #music-btn { right: 20px; } }
  #music-btn.playing { animation-play-state: running; }
  #music-btn::before { content: '🎵'; font-size: 1.1rem; }
  @keyframes spinDisc { 100% { transform: rotate(360deg); } }

  #toast { position: fixed; bottom: -100px; left: 50%; transform: translateX(-50%); background: rgba(114, 47, 55, 0.95); color: #fff; padding: 12px 25px; border-radius: 50px; font-family: var(--sans); font-size: 0.8rem; z-index: 999999; transition: bottom 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55); backdrop-filter: blur(10px); white-space: nowrap; box-shadow: 0 10px 30px rgba(114,47,55,0.4); }
  #toast.show { bottom: 40px; }

  /* ========= CANVAS HOA RƠI ========= */
  #hearts-canvas { position: fixed; top: 0; left: 50%; transform: translateX(-50%); width: min(430px, 100vw); height: 100vh; pointer-events: none; z-index: 0; opacity: 0; transition: opacity 1.5s ease; }
  #hearts-canvas.active { opacity: 1; }

  /* ========= INTRO OVERLAY (Mở phong bì) ========= */
  #intro-overlay{ position:fixed; top:0; left:50%; transform:translateX(-50%); width: min(430px, 100vw); height: 100vh; z-index: 99999; cursor:pointer; overflow:hidden; display:flex; justify-content:center; align-items: center; background: #fffdfb; transition: opacity 1.5s ease; }
  .envelope-flap { position: absolute; top: 0; left: 0; width: 100%; height: 50%; background: linear-gradient(135deg, #fdf6f5 0%, #f6e8e5 100%); clip-path: polygon(0 0, 100% 0, 50% 100%); z-index: 3; transition: transform 1.2s cubic-bezier(0.6, -0.28, 0.735, 0.045); transform-origin: top; border-bottom: 2px solid rgba(214,159,140,0.2); }
  .envelope-body { position: absolute; bottom: 0; left: 0; width: 100%; height: 100%; background: #fdf6f5; z-index: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; padding-top: 10vh; }
  
  .intro-names { font-family: var(--script); font-size: 3.5rem; color: var(--wine); margin-bottom: 10px; opacity: 0.9; }
  .intro-date { font-family: var(--sans); font-size: 0.75rem; letter-spacing: 4px; color: var(--rose); text-transform: uppercase; }
  .wax-seal { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 70px; height: 70px; background: radial-gradient(circle, #8a3843 0%, var(--wine) 100%); border-radius: 50%; z-index: 4; display: flex; justify-content: center; align-items: center; color: #fff; font-family: var(--script); font-size: 1.8rem; box-shadow: 0 4px 10px rgba(114,47,55,0.4), inset 0 0 10px rgba(0,0,0,0.3); transition: opacity 0.5s ease, transform 1s ease; border: 2px solid #a34e5a; }
  
  #intro-overlay.open .envelope-flap { transform: rotateX(180deg); }
  #intro-overlay.open .wax-seal { opacity: 0; transform: translate(-50%, -50%) scale(1.5); }
  #intro-overlay.open .envelope-body { transform: scale(1.05); opacity: 0; transition: all 1.5s ease 0.5s; }

  .click-hint{ position:absolute; bottom:40px; left:50%; transform:translateX(-50%); z-index:6; font-family:var(--sans); font-size:.65rem; color:var(--text-light); text-transform:uppercase; letter-spacing:3px; animation:pulseHint 2s ease-in-out infinite; white-space:nowrap; }
  @keyframes pulseHint{0%,100%{opacity:.4}50%{opacity:1}}

  /* ========= MAIN CONTENT ========= */
  #main-content{opacity:0; transition:opacity 1.5s ease}
  #main-content.visible{opacity:1}

  .hero{ height:100vh; position:relative; display:flex; flex-direction:column; justify-content:center; align-items:center; text-align:center; overflow:hidden; }
  .hero-bg-layer { position: absolute; inset: -20px; background-image:url('uploads/wedding_bg.jpg'); background-size:cover; background-position:center; z-index: 0; will-change: transform; filter: brightness(0.85); }
  .hero::before{ content:''; position:absolute; inset:0; background:linear-gradient(180deg, rgba(255,253,251,0.2) 0%, rgba(253,246,245,0.9) 100%); z-index:1; }

  .hero-content{position:relative; z-index:2; color:var(--text-main); padding:0 20px; width:100%; top:25%; will-change: transform;}
  @media (max-width: 768px) { .hero-content { top: 15%; padding: 0 15px; } }

  .hero-badge{ font-family:var(--sans); font-size:.6rem; letter-spacing:5px; text-transform:uppercase; color:var(--wine); margin-bottom:20px; display:flex; align-items:center; justify-content:center; gap:12px; }
  .hero-badge::before,.hero-badge::after{ content:''; width:40px; height:1px; background:var(--rose); display:block; }

  .hero h1{ font-family:var(--script); font-size:clamp(3rem, 12vw, 4.5rem); font-weight:normal; line-height:1; color:var(--wine); text-shadow:0 2px 15px rgba(255,255,255,0.8); margin:10px 0; }
  .hero-date{ font-family:var(--sans); font-size:.85rem; letter-spacing:3px; font-weight:400; margin:20px 0; color:var(--text-main); }

  .invite-box{ margin-top:30px; padding:20px 35px; background:rgba(255,255,255,0.7); border:1px solid rgba(214,159,140,0.5); border-radius:12px; backdrop-filter:blur(10px); display:inline-block; max-width:90%; opacity:0; box-shadow:0 10px 30px rgba(214,159,140,0.15); }
  .invite-box.anim { animation:fadeInUp 1s ease forwards; animation-delay: 1.5s; } 
  .invite-label{font-family:var(--sans); font-size:.65rem; text-transform:uppercase; letter-spacing:3px; color:var(--text-light); margin-bottom:8px}
  .invite-name{ font-family:var(--script); font-size:clamp(2rem,8vw,3rem); color:var(--wine); line-height:1.2; }
  @keyframes fadeInUp{ 0%{opacity:0;transform:translateY(20px)} 100%{opacity:1;transform:translateY(0)} }

  .divider{ display:flex; align-items:center; gap:15px; padding:0 40px; margin:20px 0; }
  .divider-line{flex:1; height:1px; background:linear-gradient(90deg, transparent, var(--rose), transparent)}
  .divider-icon{color:var(--rose); font-size:18px; opacity:.8}

  .section{padding:60px 28px; text-align:center; position:relative; z-index:1}
  
  .title-sm{ font-family:var(--sans); font-size:.65rem; text-transform:uppercase; letter-spacing:4px; color:var(--rose); margin-bottom:10px; font-weight:600; }
  .title-script-lg{ font-family:var(--script); font-size:clamp(3rem, 10vw, 4rem); color:var(--wine); line-height:1.1; margin:5px 0 25px; font-weight:normal; }

  .photo-frame { border-radius: 200px 200px 0 0; overflow: hidden; border: 4px solid var(--white); box-shadow: 0 15px 40px rgba(214,159,140,0.2); margin: 0 auto 30px; width: 85%; aspect-ratio: 3/4; position: relative; }
  .photo-frame img { width: 100%; height: 100%; object-fit: cover; transition: transform 1s ease; }
  .photo-frame:hover img { transform: scale(1.05); }

  .text-desc{ font-family:var(--sans); font-size:.85rem; line-height:2; color:var(--text-main); text-align:center; font-weight:300; padding: 0 10px; }

  .rose-band{ background: var(--wine); padding:55px 28px; text-align:center; position:relative; overflow:hidden; }
  .rose-band::before { content: ''; position: absolute; inset: 0; background: url('https://www.transparenttextures.com/patterns/stardust.png'); opacity: 0.1; }
  .rose-band .title-sm { color: #fdf6f5; opacity: 0.8; }
  .rose-band .title-script-lg { color: #fff; margin-bottom: 0; }

  .cal-wrap{ background:var(--white); padding:60px 25px; text-align:center; border-radius: 20px; margin: -20px 20px 0; position: relative; z-index: 5; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
  .date-block{ display:flex; justify-content:center; align-items:center; padding:30px 0; margin:20px 0; gap:25px; border-top:1px solid rgba(214,159,140,0.2); border-bottom:1px solid rgba(214,159,140,0.2); }
  .d-item{text-align:center; font-family:var(--sans)}
  .d-item span{display:block; font-size:.65rem; color:var(--text-light); letter-spacing:3px; margin-bottom:8px; text-transform:uppercase}
  .d-item strong{font-size:1.6rem; font-weight:400; color:var(--text-main)}
  .d-item.main strong{font-size:3.8rem; font-weight:300; color:var(--wine); line-height:1}
  .date-dot{width:5px; height:5px; background:var(--rose); border-radius:50%; transform: rotate(45deg); }

  .location-card{ background:#fdf6f5; border:1px solid rgba(214,159,140,0.3); border-radius:12px; padding:25px; text-align:center; margin:25px 0; }
  .loc-name{font-family:var(--serif); font-size:1.4rem; font-weight:600; color:var(--wine); margin-bottom:8px}
  .loc-addr{font-family:var(--sans); font-size:.8rem; color:var(--text-light); line-height: 1.6; margin-bottom:20px}
  
  .btn{ display:inline-block; padding:14px 30px; border:1px solid var(--rose); color:var(--wine); text-decoration:none; font-family:var(--sans); font-size:.7rem; text-transform:uppercase; letter-spacing:2px; transition:all .3s ease; background:transparent; border-radius:50px; position:relative; overflow:hidden; font-weight: 500; }
  .btn:hover{background:var(--rose); color:#fff;}

  .timeline{ text-align:left; position: relative; padding: 20px 0; margin: 0 auto; width: 80%; }
  .timeline::before { content:''; position: absolute; left: 50%; top: 0; bottom: 0; width: 1px; background: rgba(214,159,140,0.4); transform: translateX(-50%); }
  .t-item{ position:relative; width: 50%; margin-bottom: 30px; }
  .t-item:nth-child(odd) { float: left; clear: right; text-align: right; padding-right: 25px; }
  .t-item:nth-child(even) { float: right; clear: left; left: 50%; text-align: left; padding-left: 25px; }
  .t-item::after { content:''; position:absolute; top:5px; width:12px; height:12px; background:var(--wine); border-radius:50%; box-shadow: 0 0 0 4px var(--blush); }
  .t-item:nth-child(odd)::after { right: -6px; }
  .t-item:nth-child(even)::after { left: -6px; }
  .t-time{font-family:var(--sans); font-weight:600; font-size:.9rem; margin-bottom:4px; color:var(--rose)}
  .t-desc{font-family:var(--serif); font-size:1.1rem; color:var(--text-main)}
  .clearfix::after { content: ""; clear: both; display: table; }

  .rsvp-wrap{background:var(--wine); padding:60px 28px; text-align: center; color: #fff; }
  .rsvp-wrap .title-sm { color: var(--rose); }
  .rsvp-wrap .title-script-lg { color: #fff; }
  .rsvp-wrap .text-desc { color: #fdf6f5; opacity: 0.9; margin-bottom: 30px; }
  
  .form-control{ width:100%; padding:16px 20px; margin-bottom:15px; border:none; background:rgba(255,255,255,0.1); font-family:var(--sans); font-size:.85rem; color:#fff; border-radius:8px; outline:none; transition: background 0.3s; }
  .form-control::placeholder { color: rgba(255,255,255,0.6); }
  .form-control:focus{ background:rgba(255,255,255,0.2); }
  textarea.form-control{resize:vertical; min-height:100px}
  .btn-submit{ width:100%; padding:18px; background:var(--rose); color:#fff; border:none; font-family:var(--sans); font-size:.75rem; letter-spacing:3px; text-transform:uppercase; border-radius:8px; cursor:pointer; font-weight: 600; transition:all .3s; }
  .btn-submit:hover{background:#c08570; transform:translateY(-2px); box-shadow:0 10px 20px rgba(0,0,0,0.2)}

  .thank-section{ padding:70px 28px; text-align:center; background:var(--blush); }
  .countdown{display:flex; justify-content:center; gap:12px; font-family:var(--sans); margin:30px 0 50px;}
  .cd-item{text-align:center; min-width:60px; background: #fff; padding: 15px 10px; border-radius: 12px; box-shadow: 0 5px 15px rgba(214,159,140,0.15); border: 1px solid rgba(214,159,140,0.2); }
  .cd-num{ font-size:2rem; font-weight:400; color:var(--wine); line-height:1; }
  .cd-label{font-size:.6rem; color:var(--text-light); text-transform:uppercase; letter-spacing:2px; margin-top:8px}
  
  .footer-name{ font-family:var(--script); font-size:clamp(2.5rem,8vw,3.5rem); color:var(--wine); line-height: 1.2;}
  
  /* Reveal Animations */
  .reveal{opacity:0; transform:translateY(30px); transition:opacity 1s ease,transform 1s ease}
  .reveal.in{opacity:1; transform:translateY(0)}
  .reveal-scale{opacity:0; transform:scale(0.9); transition:opacity 1s ease,transform 1s ease}
  .reveal-scale.in{opacity:1; transform:scale(1)}
</style>
</head>
<body class="locked">

<div id="toast" class="<?= $toast_class ?>"><?= $toast_msg ?></div>

<!-- NÚT PHÁT NHẠC (Sử dụng nhạc cưới nhẹ nhàng) -->
<div id="music-btn" title="Bật/Tắt nhạc"></div>
<audio id="bg-music" src="uploads/wedding_song.mp3" loop preload="auto"></audio>

<canvas id="hearts-canvas"></canvas>

<div id="intro-overlay">
  <div class="envelope-flap"></div>
  <div class="envelope-body">
    <div class="intro-date">Save The Date</div>
    <div class="intro-names">Hoàng Rin <br>& Thanh Thủy</div>
    <div class="click-hint">Mở Thiệp ❤️</div>
  </div>
  <div class="wax-seal">R&T</div>
</div>

<div id="scroll-progress"><div id="scroll-progress-bar"></div></div>

<div class="wrapper" id="main-content">

  <!-- HERO SECTION -->
  <div class="hero">
    <div class="hero-bg-layer" id="hero-bg"></div>
    <div class="hero-content" id="hero-text-layer">
      <div class="hero-badge">Lễ Thành Hôn</div>
      <h1 id="hero-name">Hoàng Rin <br> Thanh Thủy</h1>
      <div class="hero-date">15 . 08 . 2026</div>

      <div class="invite-box" id="inviteBox" style="display:none">
        <p class="invite-label">Trân trọng kính mời</p>
        <p class="invite-name" id="guestNameDisplay"></p>
      </div>
    </div>
  </div>

  <div class="divider reveal"><div class="divider-line"></div><div class="divider-icon">❦</div><div class="divider-line"></div></div>

  <!-- ABOUT SECTION -->
  <div class="section reveal" style="padding-top:20px">
    <div class="title-sm">Câu Chuyện Tình Yêu</div>
    <div class="title-script-lg">Love Story</div>
    
    <div class="photo-frame">
      <!-- Thay ảnh Pre-wedding của bạn vào đây -->
      <img src="uploads/couple_photo.jpg" alt="Ảnh Cưới">
    </div>
    
    <p class="text-desc">Tình yêu không phải là tìm thấy một người hoàn hảo, mà là học cách nhìn nhận một người không hoàn hảo một cách tuyệt vời nhất. Cảm ơn vì đã luôn ở đây, cùng nhau viết tiếp hành trình mới.</p>
  </div>

  <!-- DYNAMIC INVITE HEADER -->
  <div class="rose-band">
    <div class="reveal" id="dynamicInviteHeader" style="display:none">
      <div class="title-sm">Trân trọng kính mời</div>
      <div style="font-family:var(--script); font-size:clamp(2.5rem,8vw,3.5rem); color:#fff; line-height:1.2; margin:10px 0;" id="guestNameText"></div>
      <div class="title-sm">Đến dự tiệc chung vui cùng gia đình</div>
    </div>
    <div class="reveal" id="defaultInviteHeader">
      <div class="title-sm">Trân trọng kính mời</div>
      <div class="title-script-lg">Bạn bè & Người thân</div>
      <div class="title-sm">Đến dự tiệc chung vui cùng gia đình</div>
    </div>
  </div>

  <!-- CALENDAR & LOCATION -->
  <div class="cal-wrap">
    <div class="reveal">
      <div class="title-sm">Thời Gian Tổ Chức</div>
      <div class="title-script-lg" style="color:var(--wine); margin-bottom: 0;">Tháng Tám</div>
    </div>

    <div class="date-block reveal-scale">
      <div class="d-item"><span>Thứ 7</span><strong>15</strong></div>
      <div class="date-dot"></div>
      <div class="d-item main"><span>Tháng 8</span><strong>08</strong></div>
      <div class="date-dot"></div>
      <div class="d-item"><span>Năm</span><strong>2026</strong></div>
    </div>

    <div class="location-card reveal">
      <div class="title-sm" style="margin-bottom: 15px;">Địa Điểm Tổ Chức</div>
      <div class="loc-name">Trung Tâm Tiệc Cưới Sola Wedding</div>
      <div class="loc-addr">Số 123 Đường Tình Yêu, Quận Hạnh Phúc, TP. Hồ Chí Minh</div>
      <a href="https://maps.google.com" target="_blank" class="btn">Chỉ Đường Google Maps</a>
    </div>
  </div>

  <div class="section reveal" style="margin-top: 20px;">
    <div class="title-sm">Lịch Trình</div>
    <div class="title-script-lg">Sự Kiện</div>
    
    <div class="timeline clearfix">
      <div class="t-item reveal"><div class="t-time">17:00</div><div class="t-desc">Đón Khách</div></div>
      <div class="t-item reveal"><div class="t-time">18:00</div><div class="t-desc">Cử Hành Hôn Lễ</div></div>
      <div class="t-item reveal"><div class="t-time">18:30</div><div class="t-desc">Khai Tiệc</div></div>
      <div class="t-item reveal"><div class="t-time">20:00</div><div class="t-desc">Cắt Bánh & Nhảy Múa</div></div>
    </div>
  </div>

  <!-- RSVP LỜI CHÚC -->
  <div class="rsvp-wrap" id="rsvp">
    <div class="reveal">
      <div class="title-sm">Sổ Lưu Bút</div>
      <div class="title-script-lg">Gửi Lời Chúc Phúc</div>
      <p class="text-desc">Sự hiện diện của bạn là món quà tuyệt vời nhất đối với chúng mình. Nếu không thể tham dự, hãy gửi những lời chúc tốt đẹp nhất đến cô dâu chú rể nhé! ❤️</p>
    </div>
    <div class="reveal">
      <form method="POST" action="?<?= isset($_SERVER['QUERY_STRING']) ? htmlspecialchars($_SERVER['QUERY_STRING']) : '' ?>#rsvp">
          <input type="text" name="rsvp_name" class="form-control" placeholder="Tên của bạn..." value="<?= $guest_name_url ?>" required>
          <textarea name="rsvp_message" class="form-control" placeholder="Viết lời chúc mừng..." required></textarea>
          <button type="submit" name="submit_rsvp" class="btn-submit">Gửi Lời Chúc Mừng</button>
      </form>
    </div>
  </div>

  <!-- FOOTER & COUNTDOWN -->
  <div class="thank-section">
    <div class="reveal">
      <div class="title-sm">Đếm Ngược Thời Gian</div>
      <div class="title-script-lg" style="margin-bottom:0">Hẹn Gặp Lại</div>
    </div>
    
    <div class="countdown reveal-scale" id="countdown">
      <div class="cd-item"><div class="cd-num" id="days">00</div><div class="cd-label">Ngày</div></div>
      <div class="cd-item"><div class="cd-num" id="hours">00</div><div class="cd-label">Giờ</div></div>
      <div class="cd-item"><div class="cd-num" id="minutes">00</div><div class="cd-label">Phút</div></div>
      <div class="cd-item"><div class="cd-num" id="seconds">00</div><div class="cd-label">Giây</div></div>
    </div>

    <div class="divider reveal"><div class="divider-line"></div><div class="divider-icon">❦</div><div class="divider-line"></div></div>
    <div class="title-sm reveal" style="margin-top: 30px;">Trân Trọng Cảm Ơn</div>
    <div class="footer-name reveal">Hoàng Rin & Thanh Thủy</div>
    
    <!-- Bạn có thể đổi tên team thiết kế ở đây -->
    <p style="font-family:var(--sans); font-size:.6rem; color:var(--text-light); letter-spacing:2px; margin-top:40px; text-transform:uppercase">Design by Sola Wedding Team</p>
  </div>

</div>

<script>
(function(){
  /* ---- XỬ LÝ URL GUEST NAME ---- */
  const urlParams=new URLSearchParams(window.location.search);
  const guestName=urlParams.get('to');
  
  if(guestName && guestName.trim()){
    document.getElementById('inviteBox').style.display='inline-block';
    document.getElementById('guestNameDisplay').innerText=guestName;
    document.getElementById('defaultInviteHeader').style.display='none';
    document.getElementById('dynamicInviteHeader').style.display='block';
    document.getElementById('guestNameText').innerText=guestName;
  }

  /* ---- TẮT TOAST PHP ---- */
  const toast = document.getElementById('toast');
  if(toast && toast.classList.contains('show')) {
      setTimeout(() => toast.classList.remove('show'), 4000);
      document.getElementById('intro-overlay').style.display = 'none';
      document.body.classList.remove('locked');
      document.getElementById('main-content').classList.add('visible');
      document.getElementById('hearts-canvas').classList.add('active');
      setTimeout(initReveal, 100);
      setTimeout(animHearts, 100);
  }

  /* ---- MUSIC PLAYER ---- */
  const musicBtn = document.getElementById('music-btn');
  const bgMusic = document.getElementById('bg-music');
  let isPlaying = false;
  let userInteractedMusic = false;

  if(musicBtn && bgMusic) {
      musicBtn.addEventListener('click', () => {
          userInteractedMusic = true;
          if(isPlaying) { bgMusic.pause(); musicBtn.classList.remove('playing'); } 
          else { bgMusic.play(); musicBtn.classList.add('playing'); }
          isPlaying = !isPlaying;
      });
  }

  /* ---- COUNTDOWN DATE ---- */
  const target = new Date('2026-08-15T17:00:00').getTime(); // Đổi lại ngày cưới thực tế
  
  function updateCD(){
    const now = Date.now(), d = target - now;
    if(d < 0){
      document.getElementById('countdown').innerHTML='<div style="font-family:var(--sans); font-size:1rem; color:var(--wine); font-weight:500; letter-spacing:2px">Sự kiện đã diễn ra</div>';
      return;
    }
    const days = Math.floor(d/86400000);
    const pad = n => String(n).padStart(2,'0');
    document.getElementById('days').innerText = pad(days);
    document.getElementById('hours').innerText = pad(Math.floor(d%86400000/3600000));
    document.getElementById('minutes').innerText = pad(Math.floor(d%3600000/60000));
    document.getElementById('seconds').innerText = pad(Math.floor(d%60000/1000));
  }
  updateCD(); setInterval(updateCD,1000);

  /* ---- HIỆU ỨNG TRÁI TIM RƠI (CANVAS JS) ---- */
  const canvas = document.getElementById('hearts-canvas');
  const ctx = canvas.getContext('2d');
  function resizeCanvas() { canvas.width = Math.min(430, window.innerWidth); canvas.height = window.innerHeight; }
  resizeCanvas(); window.addEventListener('resize', resizeCanvas);
  
  const hearts = [];
  for(let i=0; i<30; i++){
    hearts.push({
      x: Math.random() * canvas.width, 
      y: Math.random() * canvas.height,
      size: Math.random() * 8 + 4, 
      speedY: Math.random() * 1 + 0.5,
      speedX: (Math.random() - 0.5) * 0.5,
      opacity: Math.random() * 0.5 + 0.2,
      rotation: Math.random() * 360,
      rotSpeed: (Math.random() - 0.5) * 2
    });
  }

  function drawHeart(ctx, x, y, size, opacity, rotation) {
    ctx.save();
    ctx.translate(x, y);
    ctx.rotate(rotation * Math.PI / 180);
    ctx.globalAlpha = opacity;
    ctx.fillStyle = "#d69f8c"; // Màu rose gold
    ctx.beginPath();
    ctx.moveTo(0, size/4);
    ctx.bezierCurveTo(0, 0, -size/2, 0, -size/2, size/4);
    ctx.bezierCurveTo(-size/2, size/2.5, 0, size*0.8, 0, size);
    ctx.bezierCurveTo(0, size*0.8, size/2, size/2.5, size/2, size/4);
    ctx.bezierCurveTo(size/2, 0, 0, 0, 0, size/4);
    ctx.fill();
    ctx.restore();
  }

  function animHearts(){
    ctx.clearRect(0,0,canvas.width,canvas.height);
    hearts.forEach(h => {
      drawHeart(ctx, h.x, h.y, h.size, h.opacity, h.rotation);
      h.y += h.speedY;
      h.x += h.speedX;
      h.rotation += h.rotSpeed;
      if(h.y > canvas.height + 20) {
        h.y = -20;
        h.x = Math.random() * canvas.width;
      }
    });
    requestAnimationFrame(animHearts);
  }

  /* ---- AUTO SCROLL (CHUẨN CROSS-PLATFORM) ---- */
  let scrollAnimationId = null; 
  let isAutoScrolling = false; 
  let currentY = 0; 

  function smoothScrollToBottom() {
      isAutoScrolling = true;
      currentY = window.scrollY;
      document.documentElement.style.scrollBehavior = 'auto';

      function animation() {
          if (!isAutoScrolling) return;
          currentY += 1.5; 
          window.scrollTo(0, currentY);
          const maxScroll = document.documentElement.scrollHeight - window.innerHeight;
          if (window.scrollY < maxScroll - 5) {
              scrollAnimationId = requestAnimationFrame(animation);
          } else {
              stopAutoScroll(); 
          }
      }
      scrollAnimationId = requestAnimationFrame(animation);
  }

  function stopAutoScroll() {
      if (isAutoScrolling) {
          isAutoScrolling = false;
          if (scrollAnimationId) {
              cancelAnimationFrame(scrollAnimationId);
              scrollAnimationId = null;
          }
          document.documentElement.style.scrollBehavior = 'smooth';
      }
  }
  ['wheel', 'touchmove', 'mousedown'].forEach(e => window.addEventListener(e, stopAutoScroll, { passive: true }));

  /* ---- MỞ PHONG BÌ & KÍCH HOẠT THIỆP ---- */
  const intro = document.getElementById('intro-overlay');
  const main = document.getElementById('main-content');
  let opened = false;
  
  if(intro) {
      intro.addEventListener('click', function(){
        if(opened) return; opened = true;
        
        intro.classList.add('open');

        if(!userInteractedMusic && bgMusic) {
            bgMusic.play().then(()=>{ 
                if(musicBtn) musicBtn.classList.add('playing'); 
                isPlaying = true; 
            }).catch(e=>console.log("Autoplay blocked"));
        }

        setTimeout(()=>{
          intro.style.opacity = '0';
          main.classList.add('visible');
        }, 1200);
        
        setTimeout(()=>{
          intro.style.display = 'none';
          document.body.classList.remove('locked');
          canvas.classList.add('active');
          const invBox = document.getElementById('inviteBox');
          if(invBox) invBox.classList.add('anim'); 
          animHearts(); initReveal(); 
          
          // Trễ 1 giây sau khi thiệp hiện rõ mới bắt đầu cuộn
          setTimeout(smoothScrollToBottom, 1000); 
        }, 2700);
      });
  }

  /* ---- INTERSECTION OBSERVER ---- */
  function initReveal(){
    const revEls=document.querySelectorAll('.reveal, .reveal-scale');
    const obs=new IntersectionObserver(entries=>{
      entries.forEach(e=>{if(e.isIntersecting){e.target.classList.add('in');}});
    },{threshold:.1});
    revEls.forEach(el=>obs.observe(el));
  }

  /* ---- PROGRESS BAR & PARALLAX HERO ---- */
  const progressBar = document.getElementById('scroll-progress-bar');
  const heroBg = document.getElementById('hero-bg');
  const heroText = document.getElementById('hero-text-layer');
  let ticking = false;

  window.addEventListener('scroll',()=>{
    if(!ticking) {
      window.requestAnimationFrame(() => {
        const scrollTop = window.scrollY;
        const docHeight = document.documentElement.scrollHeight - window.innerHeight;
        progressBar.style.width = (scrollTop / docHeight) * 100 + "%";

        if(scrollTop < window.innerHeight) {
          if(heroBg) heroBg.style.transform = `translateY(${scrollTop * 0.4}px)`;
          if(heroText) heroText.style.transform = `translateY(${scrollTop * 0.25}px)`;
        }
        ticking = false;
      });
      ticking = true;
    }
  },{passive:true});

})();
</script>
</body>
</html>