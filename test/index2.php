<?php
// GỌI KẾT NỐI DATABASE
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
                $toast_msg = "✨ Cảm ơn $name đã gửi lời chúc mừng! 🎓";
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
  <title>Lễ Tốt Nghiệp - Đỗ Văn Hin</title>
  <meta name="description" content="Trân trọng kính mời bạn đến dự lễ tốt nghiệp của Hin!">
  <meta property="og:title" content="Graduation Ceremony 🎓">
  <meta property="og:description" content="Trân trọng kính mời bạn đến dự lễ tốt nghiệp của Hin!">
  <meta property="og:image" content="uploads/thumb_grad.jpg">
  <meta property="og:url" content="">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Montserrat:wght@300;400;500;600;700&family=Pinyon+Script&display=swap" rel="stylesheet">
<style>
  *{margin:0;padding:0;box-sizing:border-box}
  ::-webkit-scrollbar{display:none}
  html{-ms-overflow-style:none;scrollbar-width:none;scroll-behavior:smooth;-webkit-overflow-scrolling:touch}

  :root{
    --navy: #0f172a;       /* Xanh đen học thuật */
    --navy-light: #1e293b;
    --gold: #d4af37;       /* Vàng kim loại */
    --gold-light: #f3e5ab; /* Vàng nhạt */
    --bg-light: #f8fafc;   /* Trắng ngà / xám nhạt */
    --text-main: #334155;
    --text-dark: #0f172a;
    --serif: 'Playfair Display', serif;
    --sans: 'Montserrat', sans-serif;
    --script: 'Pinyon Script', cursive;
  }
  body{ background:var(--navy); font-family:var(--serif); display:flex; justify-content:center; -webkit-font-smoothing:antialiased; overflow-x:hidden; }
  body.locked{overflow:hidden}

  .wrapper{ max-width:430px; width:100%; background:var(--bg-light); position:relative; overflow-x:hidden; min-height:100vh; margin: 0 auto; box-shadow: 0 0 30px rgba(0,0,0,0.5); }

  /* ================= UI CONTROLS ================= */
  #scroll-progress { position: fixed; top: 0; left: 50%; transform: translateX(-50%); width: min(430px, 100vw); height: 4px; background: rgba(212,175,55,0.2); z-index: 99999; }
  #scroll-progress-bar { height: 100%; background: linear-gradient(90deg, var(--gold-light), var(--gold)); width: 0%; border-radius: 0 2px 2px 0; transition: width 0.1s; }

  #music-btn { position: fixed; bottom: 30px; right: calc(50vw - 195px); z-index: 9999; width: 44px; height: 44px; background: rgba(15,23,42,0.9); border-radius: 50%; display: flex; justify-content: center; align-items: center; box-shadow: 0 4px 15px rgba(212,175,55,0.4); cursor: pointer; border: 1.5px solid var(--gold); animation: spinDisc 4s linear infinite; animation-play-state: paused; }
  @media (max-width: 430px) { #music-btn { right: 20px; } }
  #music-btn.playing { animation-play-state: running; }
  #music-btn::before { content: '🎵'; font-size: 1.2rem; filter: grayscale(100%) sepia(100%) hue-rotate(35deg) saturate(300%) brightness(1.2); }
  @keyframes spinDisc { 100% { transform: rotate(360deg); } }

  #toast { position: fixed; bottom: -100px; left: 50%; transform: translateX(-50%); background: rgba(15, 23, 42, 0.95); color: var(--gold-light); padding: 14px 28px; border-radius: 50px; font-family: var(--sans); font-size: 0.85rem; font-weight: 500; z-index: 999999; transition: bottom 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55); backdrop-filter: blur(10px); white-space: nowrap; box-shadow: 0 10px 30px rgba(0,0,0,0.5); border: 1px solid var(--gold); }
  #toast.show { bottom: 40px; }

  /* ========= CANVAS CONFETTI ========= */
  #confetti-canvas { position: fixed; top: 0; left: 50%; transform: translateX(-50%); width: min(430px, 100vw); height: 100vh; pointer-events: none; z-index: 999998; opacity: 0; transition: opacity 1s ease; }
  #confetti-canvas.active { opacity: 1; }

  /* ========= INTRO OVERLAY ========= */
  #intro-overlay{ position:fixed; top:0; left:50%; transform:translateX(-50%); width: min(430px, 100vw); height: 100vh; z-index: 99999; cursor:pointer; overflow:hidden; display:flex; flex-direction:column; justify-content:center; align-items: center; background: radial-gradient(circle at center, var(--navy-light) 0%, var(--navy) 100%); transition: opacity 1s ease, transform 1s ease; }
  .intro-border { position: absolute; inset: 15px; border: 1px solid rgba(212,175,55,0.3); z-index: 1; pointer-events: none; }
  .intro-border::before, .intro-border::after { content: ''; position: absolute; width: 30px; height: 30px; border: 2px solid var(--gold); }
  .intro-border::before { top: -2px; left: -2px; border-right: none; border-bottom: none; }
  .intro-border::after { bottom: -2px; right: -2px; border-left: none; border-top: none; }
  
  .intro-content { position: relative; z-index: 2; text-align: center; }
  .intro-cap { font-size: 3.5rem; margin-bottom: 20px; filter: drop-shadow(0 0 15px rgba(212,175,55,0.4)); animation: floatCap 3s ease-in-out infinite; }
  @keyframes floatCap { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-15px); } }
  
  .intro-title { font-family: var(--sans); font-size: 0.8rem; letter-spacing: 6px; color: var(--gold); text-transform: uppercase; margin-bottom: 15px; }
  .intro-name { font-family: var(--serif); font-size: 3rem; color: #fff; font-weight: 700; margin-bottom: 5px; line-height: 1.2; text-shadow: 0 4px 20px rgba(0,0,0,0.5); }
  .intro-sub { font-family: var(--script); font-size: 2.2rem; color: var(--gold-light); }

  .click-hint{ position:absolute; bottom:50px; left:50%; transform:translateX(-50%); z-index:6; font-family:var(--sans); font-size:.65rem; color:var(--gold-light); text-transform:uppercase; letter-spacing:4px; animation:pulseHint 2s ease-in-out infinite; white-space:nowrap; background: rgba(15,23,42,0.8); padding: 10px 20px; border-radius: 30px; border: 1px solid rgba(212,175,55,0.3); }
  @keyframes pulseHint{0%,100%{opacity:.6}50%{opacity:1; box-shadow: 0 0 20px rgba(212,175,55,0.4);}}

  /* ========= MAIN CONTENT ========= */
  #main-content{opacity:0; transition:opacity 1s ease}
  #main-content.visible{opacity:1}

  /* HERO SECTION */
  .hero{ height:100vh; position:relative; display:flex; flex-direction:column; justify-content:center; align-items:center; text-align:center; overflow:hidden; }
  .hero-bg-layer { position: absolute; inset: -20px; background-image:url('uploads/grad_hero.jpg'); background-size:cover; background-position:center; z-index: 0; filter: brightness(0.65) contrast(1.1); }
  .hero::before{ content:''; position:absolute; inset:0; background:linear-gradient(180deg, rgba(15,23,42,0.2) 0%, rgba(15,23,42,0.9) 100%); z-index:1; }

  .hero-content{position:relative; z-index:2; color:#fff; padding:0 20px; width:100%; top:25%;}
  @media (max-width: 768px) { .hero-content { top: 18%; } }

  .hero-badge{ font-family:var(--sans); font-size:.7rem; font-weight: 600; letter-spacing:5px; text-transform:uppercase; color:var(--gold); margin-bottom:20px; display:flex; align-items:center; justify-content:center; gap:15px; }
  .hero-badge::before,.hero-badge::after{ content:''; width:50px; height:1px; background:var(--gold); display:block; opacity: 0.5; }

  .hero h1{ font-family:var(--serif); font-size:clamp(2.5rem, 10vw, 4rem); font-weight:700; line-height:1.1; color:#fff; text-shadow:0 4px 20px rgba(0,0,0,0.8); margin:10px 0; text-transform: uppercase; }
  .hero h2{ font-family:var(--script); font-size:clamp(2.5rem, 8vw, 3.5rem); color:var(--gold-light); font-weight: normal; margin-top: 5px; }

  .invite-box{ margin-top:40px; padding:25px 40px; background:rgba(15,23,42,0.6); border:1px solid rgba(212,175,55,0.4); border-radius:4px; backdrop-filter:blur(10px); display:inline-block; max-width:90%; opacity:0; box-shadow:0 10px 30px rgba(0,0,0,0.5); }
  .invite-box.anim { animation:fadeInUp 1.2s cubic-bezier(0.2, 0.8, 0.2, 1) forwards; animation-delay: 1.5s; } 
  .invite-label{font-family:var(--sans); font-size:.65rem; font-weight: 600; text-transform:uppercase; letter-spacing:4px; color:var(--gold-light); margin-bottom:12px; opacity: 0.8;}
  .invite-name{ font-family:var(--serif); font-size:clamp(1.8rem,7vw,2.5rem); color:#fff; line-height:1.2; font-style: italic; }
  @keyframes fadeInUp{ 0%{opacity:0;transform:translateY(30px)} 100%{opacity:1;transform:translateY(0)} }

  .divider{ display:flex; align-items:center; gap:15px; padding:0 40px; margin:30px 0; }
  .divider-line{flex:1; height:1px; background:linear-gradient(90deg, transparent, var(--navy), transparent); opacity: 0.2;}
  .divider-icon{color:var(--navy); font-size:20px; font-family: var(--serif); opacity: 0.5;}

  /* TYPOGRAPHY & SECTIONS */
  .section{padding:70px 28px; text-align:center; position:relative; z-index:1}
  
  .title-sm{ font-family:var(--sans); font-size:.7rem; text-transform:uppercase; letter-spacing:5px; color:var(--gold); margin-bottom:15px; font-weight:700; }
  .title-lg{ font-family:var(--serif); font-size:clamp(2.5rem, 9vw, 3.5rem); color:var(--navy); line-height:1.1; margin:5px 0 30px; font-weight:700; }

  .quote-box { position: relative; padding: 40px 20px; }
  .quote-icon { font-size: 4rem; color: var(--gold); opacity: 0.2; position: absolute; top: -10px; left: 50%; transform: translateX(-50%); font-family: var(--serif); line-height: 1; }
  .text-desc{ font-family:var(--sans); font-size:.9rem; line-height:1.9; color:var(--text-main); text-align:center; font-weight:400; }

  /* BĂNG RÔN NAVY MỜI KHÁCH */
  .navy-band{ background: linear-gradient(135deg, var(--navy-light) 0%, var(--navy) 100%); padding:65px 28px; text-align:center; position:relative; overflow:hidden; border-top: 2px solid var(--gold); border-bottom: 2px solid var(--gold); box-shadow: 0 10px 30px rgba(0,0,0,0.2); }
  .navy-band .title-sm { color: var(--gold-light); opacity: 0.7; }
  .navy-band .title-lg { color: #fff; margin-bottom: 0; font-family: var(--script); font-weight: normal; font-size: clamp(3rem, 10vw, 4rem); }

  /* CALENDAR & LOCATION */
  .cal-wrap{ background:var(--bg-light); padding:70px 25px; text-align:center; }
  .date-block{ display:flex; justify-content:center; align-items:center; padding:35px 0; margin:25px 0; gap:30px; border-top:1px solid rgba(15,23,42,0.1); border-bottom:1px solid rgba(15,23,42,0.1); }
  .d-item{text-align:center; font-family:var(--sans)}
  .d-item span{display:block; font-size:.7rem; color:var(--text-main); letter-spacing:4px; margin-bottom:10px; text-transform:uppercase; font-weight: 600;}
  .d-item strong{font-size:1.8rem; font-weight:300; color:var(--navy)}
  .d-item.main strong{font-size:4.5rem; font-weight:700; color:var(--gold); line-height:1; font-family: var(--serif);}
  .date-sep{width:1px; height:60px; background:var(--gold); opacity: 0.3; transform: rotate(15deg);}

  .location-card{ background:#fff; border:1px solid rgba(212,175,55,0.3); padding:30px 25px; text-align:center; margin:35px 0 25px; box-shadow: 0 15px 35px rgba(15,23,42,0.05); position: relative; }
  .location-card::before { content:''; position:absolute; top:-5px; left:-5px; right:-5px; bottom:-5px; border: 1px solid rgba(212,175,55,0.1); pointer-events: none; }
  .loc-name{font-family:var(--serif); font-size:1.5rem; font-weight:700; color:var(--navy); margin-bottom:12px}
  .loc-addr{font-family:var(--sans); font-size:.85rem; color:var(--text-main); line-height: 1.6; margin-bottom:25px}
  
  .btn{ display:inline-block; padding:16px 35px; background:var(--navy); color:var(--gold-light); text-decoration:none; font-family:var(--sans); font-size:.75rem; font-weight: 600; text-transform:uppercase; letter-spacing:3px; transition:all .3s ease; border: 1px solid var(--navy); }
  .btn:hover{background:var(--gold); color:var(--navy); border-color: var(--gold); box-shadow: 0 10px 20px rgba(212,175,55,0.3); }

  /* TIMELINE */
  .timeline{ text-align:left; position: relative; padding: 20px 0 20px 20px; margin: 0 auto; width: 90%; border-left: 2px solid rgba(212,175,55,0.3); }
  .t-item{ position:relative; padding-bottom: 40px; padding-left: 25px; }
  .t-item:last-child { padding-bottom: 0; }
  .t-item::before { content:''; position:absolute; left:-33px; top:3px; width:16px; height:16px; background:var(--gold); border-radius:50%; box-shadow: 0 0 0 5px var(--bg-light), 0 0 15px rgba(212,175,55,0.5); }
  .t-time{font-family:var(--sans); font-weight:700; font-size:1rem; margin-bottom:8px; color:var(--navy); letter-spacing: 1px;}
  .t-desc{font-family:var(--serif); font-size:1.2rem; color:var(--text-main); font-style: italic;}

  /* RSVP FORM */
  .rsvp-wrap{background:var(--navy); padding:70px 28px; text-align: center; color: #fff; background-image: radial-gradient(circle at top right, rgba(212,175,55,0.1), transparent 50%); }
  .rsvp-wrap .title-lg { color: var(--gold-light); }
  .rsvp-wrap .text-desc { color: #cbd5e1; margin-bottom: 35px; }
  
  .form-control{ width:100%; padding:18px 20px; margin-bottom:18px; border:1px solid rgba(212,175,55,0.3); background:rgba(255,255,255,0.03); font-family:var(--sans); font-size:.9rem; color:#fff; outline:none; transition: all 0.3s; border-radius: 0; }
  .form-control::placeholder { color: rgba(255,255,255,0.5); }
  .form-control:focus{ background:rgba(255,255,255,0.08); border-color: var(--gold); }
  textarea.form-control{resize:vertical; min-height:120px}
  .btn-submit{ width:100%; padding:20px; background:var(--gold); color:var(--navy); border:none; font-family:var(--sans); font-size:.8rem; font-weight: 700; letter-spacing:4px; text-transform:uppercase; cursor:pointer; transition:all .3s; }
  .btn-submit:hover{background:#ebd57f; transform:translateY(-3px); box-shadow:0 15px 25px rgba(0,0,0,0.3)}

  /* COUNTDOWN & FOOTER */
  .thank-section{ padding:80px 28px; text-align:center; background:var(--bg-light); border-top: 1px solid rgba(15,23,42,0.1); }
  .countdown{display:flex; justify-content:center; gap:15px; font-family:var(--serif); margin:40px 0 60px;}
  .cd-item{text-align:center; min-width:65px; position: relative;}
  .cd-item:not(:last-child)::after { content: ':'; position: absolute; right: -12px; top: 0; font-size: 2.5rem; color: var(--gold); opacity: 0.5; font-family: var(--sans); font-weight: 300; }
  .cd-num{ font-size:2.8rem; font-weight:700; color:var(--navy); line-height:1; }
  .cd-label{font-family: var(--sans); font-size:.65rem; color:var(--text-main); font-weight:600; text-transform:uppercase; letter-spacing:3px; margin-top:10px}
  
  .footer-name{ font-family:var(--serif); font-size:clamp(2rem,7vw,3rem); font-weight: 700; color:var(--navy); line-height: 1.2; text-transform: uppercase;}
  
  /* Reveal Animations */
  .reveal{opacity:0; transform:translateY(40px); transition:opacity 1s cubic-bezier(0.2, 0.8, 0.2, 1), transform 1s cubic-bezier(0.2, 0.8, 0.2, 1)}
  .reveal.in{opacity:1; transform:translateY(0)}
  .reveal-scale{opacity:0; transform:scale(0.9); transition:opacity 1s ease,transform 1s ease}
  .reveal-scale.in{opacity:1; transform:scale(1)}
</style>
</head>
<body class="locked">

<div id="toast" class="<?= $toast_class ?>"><?= $toast_msg ?></div>

<!-- NÚT PHÁT NHẠC -->
<div id="music-btn" title="Bật/Tắt nhạc"></div>
<!-- Thay link nhạc vinh quang, truyền cảm hứng tại đây -->
<audio id="bg-music" src="uploads/graduation_song.mp3" loop preload="auto"></audio>

<canvas id="confetti-canvas"></canvas>

<!-- MÀN HÌNH CHỜ (SANG TRỌNG) -->
<div id="intro-overlay">
  <div class="intro-border"></div>
  <div class="intro-content">
    <div class="intro-cap">🎓</div>
    <div class="intro-title">Graduation Ceremony</div>
    <div class="intro-name">Đỗ Văn Hin</div>
    <div class="intro-sub">Class of 2026</div>
  </div>
  <div class="click-hint">Chạm để tham dự sự kiện</div>
</div>

<div id="scroll-progress"><div id="scroll-progress-bar"></div></div>

<div class="wrapper" id="main-content">

  <!-- HERO SECTION -->
  <div class="hero">
    <div class="hero-bg-layer" id="hero-bg"></div>
    <div class="hero-content" id="hero-text-layer">
      <div class="hero-badge">Lễ Trao Bằng Tốt Nghiệp</div>
      <h1 id="hero-name">Đỗ Văn Hin</h1>
      <h2>Cử Nhân IT</h2>

      <div class="invite-box" id="inviteBox" style="display:none">
        <p class="invite-label">Trân trọng kính mời</p>
        <p class="invite-name" id="guestNameDisplay"></p>
      </div>
    </div>
  </div>

  <div class="divider reveal"><div class="divider-line"></div><div class="divider-icon">♦</div><div class="divider-line"></div></div>

  <!-- ABOUT / QUOTE -->
  <div class="section reveal" style="padding-top:10px">
    <div class="quote-box">
      <div class="quote-icon">"</div>
      <p class="text-desc" style="font-size: 1.1rem; font-family: var(--serif); font-style: italic; color: var(--navy); font-weight: 600;">
        Giáo dục là vũ khí mạnh nhất mà bạn có thể dùng để thay đổi thế giới.
      </p>
      <p class="text-desc" style="margin-top: 15px;">
        Chặng đường thanh xuân rực rỡ tại giảng đường đại học đã chính thức khép lại. Ngày hôm nay không chỉ là đích đến, mà còn là vạch xuất phát cho những hoài bão lớn lao hơn. Sự hiện diện của bạn là niềm vinh hạnh và động lực to lớn đối với Hin trong cột mốc quan trọng này.
      </p>
    </div>
  </div>

  <!-- DYNAMIC INVITE HEADER (BĂNG RÔN) -->
  <div class="navy-band">
    <div class="reveal" id="dynamicInviteHeader" style="display:none">
      <div class="title-sm">Trân trọng kính mời</div>
      <div class="title-lg" id="guestNameText"></div>
      <div class="title-sm">Đến chung vui cùng gia đình</div>
    </div>
    <div class="reveal" id="defaultInviteHeader">
      <div class="title-sm">Trân trọng kính mời</div>
      <div class="title-lg">Quý Khách</div>
      <div class="title-sm">Đến chung vui cùng gia đình</div>
    </div>
  </div>

  <!-- CALENDAR & LOCATION -->
  <div class="cal-wrap">
    <div class="reveal">
      <div class="title-sm">Thời Gian Tổ Chức</div>
      <div class="title-lg">Tháng Chín</div>
    </div>

    <div class="date-block reveal-scale">
      <div class="d-item"><span>Thứ Sáu</span><strong>25</strong></div>
      <div class="date-sep"></div>
      <div class="d-item main"><span>Tháng 9</span><strong>09</strong></div>
      <div class="date-sep"></div>
      <div class="d-item"><span>Năm</span><strong>2026</strong></div>
    </div>

    <div class="location-card reveal">
      <div class="title-sm" style="margin-bottom: 20px;">Địa Điểm Tổ Chức</div>
      <div class="loc-name">Hội Trường Lớn STU</div>
      <div class="loc-addr">Trường Đại học Công Nghệ Sài Gòn<br>180 Cao Lỗ, Phường 4, Quận 8, TP.HCM</div>
      <a href="https://maps.google.com/?q=180+Cao+Lỗ,+Phường+4,+Quận+8,+TP.HCM" target="_blank" class="btn">Mở Bản Đồ</a>
    </div>
  </div>

  <!-- TIMELINE -->
  <div class="section reveal" style="background: #fff;">
    <div class="title-sm">Chương Trình</div>
    <div class="title-lg">Sự Kiện</div>
    
    <div class="timeline">
      <div class="t-item reveal"><div class="t-time">07:30 AM</div><div class="t-desc">Đón Khách & Ổn Định Chỗ Ngồi</div></div>
      <div class="t-item reveal"><div class="t-time">08:00 AM</div><div class="t-desc">Lễ Chào Cờ & Khai Mạc</div></div>
      <div class="t-item reveal"><div class="t-time">09:00 AM</div><div class="t-desc">Nghi Thức Trao Bằng Tốt Nghiệp</div></div>
      <div class="t-item reveal"><div class="t-time">11:00 AM</div><div class="t-desc">Chụp Ảnh Lưu Niệm & Bế Mạc</div></div>
    </div>
  </div>

  <!-- RSVP LỜI CHÚC -->
  <div class="rsvp-wrap" id="rsvp">
    <div class="reveal">
      <div class="title-sm">Sổ Lưu Bút</div>
      <div class="title-lg" style="margin-bottom: 20px;">Gửi Lời Chúc</div>
      <p class="text-desc">Những lời chúc tốt đẹp từ bạn sẽ là hành trang quý giá để Hin tự tin bước vào cánh cửa tương lai.</p>
    </div>
    <div class="reveal">
      <form method="POST" action="?<?= isset($_SERVER['QUERY_STRING']) ? htmlspecialchars($_SERVER['QUERY_STRING']) : '' ?>#rsvp">
          <input type="text" name="rsvp_name" class="form-control" placeholder="Tên của bạn..." value="<?= $guest_name_url ?>" required>
          <textarea name="rsvp_message" class="form-control" placeholder="Viết lời chúc mừng tốt nghiệp..." required></textarea>
          <button type="submit" name="submit_rsvp" class="btn-submit">Gửi Lời Chúc 🎓</button>
      </form>
    </div>
  </div>

  <!-- FOOTER & COUNTDOWN -->
  <div class="thank-section">
    <div class="reveal">
      <div class="title-sm">Đếm Ngược Thời Gian</div>
      <div class="title-lg" style="margin-bottom:0">Đến Ngày Trọng Đại</div>
    </div>
    
    <div class="countdown reveal-scale" id="countdown">
      <div class="cd-item"><div class="cd-num" id="days">00</div><div class="cd-label">Ngày</div></div>
      <div class="cd-item"><div class="cd-num" id="hours">00</div><div class="cd-label">Giờ</div></div>
      <div class="cd-item"><div class="cd-num" id="minutes">00</div><div class="cd-label">Phút</div></div>
      <div class="cd-item"><div class="cd-num" id="seconds">00</div><div class="cd-label">Giây</div></div>
    </div>

    <div class="divider reveal"><div class="divider-line"></div><div class="divider-icon">♦</div><div class="divider-line"></div></div>
    <div class="title-sm reveal" style="margin-top: 40px; color: var(--navy);">Trân Trọng Cảm Ơn</div>
    <div class="footer-name reveal">Đỗ Văn Hin</div>
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
      document.getElementById('confetti-canvas').classList.add('active');
      setTimeout(initReveal, 100);
      setTimeout(() => { if(typeof startConfetti === 'function') startConfetti(); }, 100);
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
  const target = new Date('2026-09-25T07:30:00').getTime(); 
  
  function updateCD(){
    const now = Date.now(), d = target - now;
    if(d < 0){
      document.getElementById('countdown').innerHTML='<div style="font-family:var(--serif); font-size:1.5rem; color:var(--navy); font-weight:700; letter-spacing:2px">Sự Kiện Đã Diễn Ra</div>';
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

  /* ---- HIỆU ỨNG PHÁO GIẤY (VÀNG KIM & XANH ĐEN) ---- */
  const canvas = document.getElementById('confetti-canvas');
  const ctx = canvas.getContext('2d');
  let particles = [];
  
  function resizeCanvas() { canvas.width = Math.min(430, window.innerWidth); canvas.height = window.innerHeight; }
  resizeCanvas(); window.addEventListener('resize', resizeCanvas);

  const colors = ['#d4af37', '#f3e5ab', '#0f172a', '#ffffff'];

  function createConfetti() {
    for (let i = 0; i < 60; i++) {
      particles.push({
        x: Math.random() * canvas.width,
        y: Math.random() * canvas.height - canvas.height,
        w: Math.random() * 10 + 5,
        h: Math.random() * 5 + 2,
        color: colors[Math.floor(Math.random() * colors.length)],
        speedY: Math.random() * 2 + 1,
        speedX: Math.random() * 2 - 1,
        rotation: Math.random() * 360,
        rotSpeed: Math.random() * 5 - 2.5
      });
    }
  }

  function startConfetti() {
    createConfetti();
    function animate() {
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      particles.forEach((p) => {
        ctx.save();
        ctx.translate(p.x + p.w / 2, p.y + p.h / 2);
        ctx.rotate((p.rotation * Math.PI) / 180);
        ctx.fillStyle = p.color;
        ctx.globalAlpha = 0.8;
        ctx.fillRect(-p.w / 2, -p.h / 2, p.w, p.h);
        ctx.restore();

        p.y += p.speedY;
        p.x += p.speedX;
        p.rotation += p.rotSpeed;

        if (p.y > canvas.height) {
          p.y = -20;
          p.x = Math.random() * canvas.width;
        }
      });
      requestAnimationFrame(animate);
    }
    animate();
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

  /* ---- MỞ THIỆP ---- */
  const intro = document.getElementById('intro-overlay');
  const main = document.getElementById('main-content');
  let opened = false;
  
  if(intro) {
      intro.addEventListener('click', function(){
        if(opened) return; opened = true;
        
        intro.style.transform = 'scale(1.1)';
        intro.style.opacity = '0';

        if(!userInteractedMusic && bgMusic) {
            bgMusic.play().then(()=>{ 
                if(musicBtn) musicBtn.classList.add('playing'); 
                isPlaying = true; 
            }).catch(e=>console.log("Autoplay blocked"));
        }

        setTimeout(()=>{
          intro.style.display = 'none';
          document.body.classList.remove('locked');
          main.classList.add('visible');
          canvas.classList.add('active');
          const invBox = document.getElementById('inviteBox');
          if(invBox) invBox.classList.add('anim'); 
          
          startConfetti(); 
          initReveal(); 
          
          setTimeout(smoothScrollToBottom, 1000); 
        }, 1000);
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