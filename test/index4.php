<?php
// GỌI KẾT NỐI DATABASE
require 'db.php';

$toast_msg = '';
$toast_class = '';
$toast_type = 'success';
$guest_name_url = isset($_GET['to']) ? htmlspecialchars(trim($_GET['to'])) : '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_rsvp'])) {
    $name = htmlspecialchars(trim($_POST['rsvp_name']));
    $message = htmlspecialchars(trim($_POST['rsvp_message']));

    if (!empty($name) && !empty($message)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO rsvp_messages (guest_name, message) VALUES (?, ?)");
            if ($stmt->execute([$name, $message])) {
                $toast_msg = "Trân trọng cảm ơn $name đã gửi lời chúc";
                $toast_class = "show";
                $toast_type = "success";
            }
        } catch (PDOException $e) {
            $toast_msg = "Lỗi hệ thống: " . $e->getMessage();
            $toast_class = "show";
            $toast_type = "error";
        }
    } else {
        $toast_msg = "Vui lòng điền đầy đủ tên và lời chúc";
        $toast_class = "show";
        $toast_type = "warning";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>Lễ Tốt Nghiệp — Đỗ Văn Hin</title>
<meta name="description" content="Trân trọng kính mời bạn đến dự lễ tốt nghiệp của Hin">
<meta property="og:title" content="Graduation Ceremony | Đỗ Văn Hin">
<meta property="og:description" content="Trân trọng kính mời bạn đến dự lễ tốt nghiệp của Hin">
<meta property="og:image" content="uploads/thumb_bright.jpg">
<meta name="theme-color" content="#1a1814">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,600&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500&family=Montserrat:wght@200;300;400;500;600;700&family=Great+Vibes&family=Italiana&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box}
::-webkit-scrollbar{display:none}
html{-ms-overflow-style:none;scrollbar-width:none;scroll-behavior:smooth;-webkit-overflow-scrolling:touch}

:root{
    --bg-page: #f6f2ea;
    --bg-card: #fffdf8;
    --bg-accent: #ede4d3;
    --bg-deep: #1a1814;
    --ivory: #faf6ec;
    --champagne: #e8d9b8;
    --text-dark: #1f1d18;
    --text-body: #4a463e;
    --text-light: #8c8578;
    --gold: #b8954d;
    --gold-dark: #8a6e35;
    --gold-light: #d4b97a;
    --bronze: #6b4f2a;
    --sage: #8a9c87;
    --rose: #c4a08a;

    --f-heading: 'Playfair Display', serif;
    --f-display: 'Italiana', serif;
    --f-body: 'Cormorant Garamond', serif;
    --f-sans: 'Montserrat', sans-serif;
    --f-sign: 'Great Vibes', cursive;

    --ease-luxe: cubic-bezier(0.77, 0, 0.175, 1);
    --ease-soft: cubic-bezier(0.2, 0.8, 0.2, 1);
    --ease-spring: cubic-bezier(0.34, 1.56, 0.64, 1);
}

body{
    background: linear-gradient(135deg, #d8d3c4 0%, #e8e2d3 50%, #d8d3c4 100%);
    font-family:var(--f-body);
    display:flex; justify-content:center;
    -webkit-font-smoothing:antialiased;
    overflow-x:hidden;
    color: var(--text-body);
    font-size: 1.1rem; line-height: 1.8;
    cursor: none;
}
body.locked{overflow:hidden}

.wrapper{
    max-width:450px; width:100%;
    background:var(--bg-page);
    position:relative; overflow-x:hidden;
    min-height:100vh; margin: 0 auto;
    box-shadow: 0 0 80px rgba(0,0,0,0.2), 0 0 0 1px rgba(184,149,77,0.08);
}

/* ===== FILM GRAIN ===== */
.noise-overlay{ position: fixed; inset: 0; z-index: 9999990; pointer-events: none; opacity: 0.05; mix-blend-mode: overlay; background-image: url('data:image/svg+xml;utf8,%3Csvg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg"%3E%3Cfilter id="n"%3E%3CfeTurbulence type="fractalNoise" baseFrequency="0.9" numOctaves="3" stitchTiles="stitch"/%3E%3C/filter%3E%3Crect width="100%25" height="100%25" filter="url(%23n)"/%3E%3C/svg%3E'); }

/* ===== VIGNETTE ===== */
.vignette{ position: fixed; inset: 0; z-index: 9999989; pointer-events: none; background: radial-gradient(ellipse at center, transparent 50%, rgba(26,24,20,0.25) 100%); }

/* ===== CUSTOM CURSOR ===== */
@media (pointer: fine){
    .cursor-dot{ position: fixed; top: 0; left: 0; width: 5px; height: 5px; background: var(--gold-dark); border-radius: 50%; transform: translate(-50%, -50%); pointer-events: none; z-index: 9999999; transition: width 0.25s, height 0.25s, background 0.25s; mix-blend-mode: difference;}
    .cursor-ring{ position: fixed; top: 0; left: 0; width: 38px; height: 38px; border: 1px solid var(--gold); border-radius: 50%; transform: translate(-50%, -50%); pointer-events: none; z-index: 9999998; transition: transform 0.18s var(--ease-soft), width 0.35s, height 0.35s, background 0.35s, border-color 0.35s, opacity 0.3s; }
    body.hovering .cursor-dot{ width: 0; height: 0; }
    body.hovering .cursor-ring{ width: 70px; height: 70px; background: rgba(184,149,77,0.12); border-color: var(--gold-light); backdrop-filter: blur(3px); }
    body.click-active .cursor-ring{ transform: translate(-50%, -50%) scale(0.8); }
}
@media (pointer: coarse){
    body{ cursor: auto; } .cursor-dot, .cursor-ring, .noise-overlay{ display: none; }
}

.magnetic{ display: inline-block; transition: transform 0.4s var(--ease-soft); will-change: transform; }

/* ===== 3D TILT + GLARE ===== */
.tilt-wrapper{ perspective: 1200px; transform-style: preserve-3d; }
.tilt-card{ transition: transform 0.12s var(--ease-soft); transform-style: preserve-3d; will-change: transform; position: relative; }
.tilt-card.reset{ transition: transform 0.6s var(--ease-soft); transform: perspective(1200px) rotateX(0) rotateY(0) scale3d(1,1,1) !important; }
.tilt-card .glare{ position: absolute; inset: 0; border-radius: inherit; background: radial-gradient(circle at var(--mx,50%) var(--my,50%), rgba(255,255,255,0.4) 0%, transparent 40%); opacity: 0; transition: opacity 0.3s; pointer-events: none; mix-blend-mode: overlay; z-index: 5; }
.tilt-card:hover .glare{ opacity: 1; }

/* ===== SPLIT TEXT ===== */
.split-word{ display: inline-block; overflow: hidden; vertical-align: top; line-height: 1.15; padding-bottom: 4px;}
.split-inner{ display: inline-block; transform: translateY(110%); transition: transform 1.1s var(--ease-luxe); will-change: transform; }
.split-text.in .split-inner{ transform: translateY(0); }

/* ===== IMAGE WIPE ===== */
.img-wipe{ position: relative; overflow: hidden; }
.img-wipe::after{ content: ''; position: absolute; inset: 0; background: linear-gradient(180deg, var(--bg-page) 0%, var(--bg-accent) 100%); z-index: 2; transform-origin: top; transition: transform 1.3s var(--ease-luxe);}
.img-wipe.in::after{ transform: scaleY(0); }
.img-wipe img{ transform: scale(1.35); transition: transform 2s var(--ease-soft); filter: brightness(0.95) saturate(0.95);}
.img-wipe.in img{ transform: scale(1); }
.img-wipe::before{ content: ''; position: absolute; inset: 8px; border: 1px solid rgba(255,255,255,0.4); z-index: 3; pointer-events: none; opacity: 0; transition: opacity 0.5s; }
.img-wipe:hover::before{ opacity: 1; }

/* ===== UI CONTROLS ===== */
#scroll-progress{ position: fixed; top: 0; left: 50%; transform: translateX(-50%); width: min(450px, 100vw); height: 2px; background: rgba(184,149,77,0.1); z-index: 99999; }
#scroll-progress-bar{ height: 100%; background: linear-gradient(90deg, var(--gold-light), var(--gold), var(--bronze)); width: 0%; transition: width 0.08s linear; box-shadow: 0 0 10px rgba(184,149,77,0.5); }

#chapter-indicator{ position: fixed; left: max(20px, calc(50vw - 215px)); top: 50%; transform: translateY(-50%); z-index: 9998; display: flex; flex-direction: column; gap: 14px; opacity: 0; transition: opacity 0.6s; pointer-events: none;}
#chapter-indicator.visible{ opacity: 1; pointer-events: auto;}
.chap-dot{ width: 6px; height: 6px; background: rgba(184,149,77,0.3); border-radius: 50%; cursor: none; transition: all 0.4s var(--ease-soft); position: relative;}
.chap-dot.active{ background: var(--gold); transform: scale(1.4); box-shadow: 0 0 12px var(--gold);}
.chap-dot::after{ content: attr(data-label); position: absolute; left: 18px; top: 50%; transform: translateY(-50%); font-family: var(--f-sans); font-size: 0.55rem; letter-spacing: 2px; text-transform: uppercase; color: var(--gold-dark); white-space: nowrap; opacity: 0; transition: opacity 0.3s; pointer-events: none;}
.chap-dot:hover::after, .chap-dot.active::after{ opacity: 1;}
@media (max-width: 500px){ #chapter-indicator{ display: none;} }

#music-btn{ position: fixed; bottom: 30px; right: max(20px, calc(50vw - 210px)); z-index: 9999; width: 52px; height: 52px; background: rgba(255,253,248,0.92); border-radius: 50%; display: flex; justify-content: center; align-items: center; box-shadow: 0 8px 30px rgba(184,149,77,0.3), 0 0 0 1px rgba(184,149,77,0.2); animation: spinDisc 5s linear infinite; animation-play-state: paused; backdrop-filter: blur(10px); cursor: none;}
#music-btn.playing{ animation-play-state: running; box-shadow: 0 8px 30px rgba(184,149,77,0.5), 0 0 0 1px var(--gold);}
#music-btn::before{ content: ''; width: 18px; height: 18px; background: var(--gold); border-radius: 50%; position: relative;}
#music-btn::after{ content: ''; position: absolute; width: 5px; height: 5px; background: var(--bg-card); border-radius: 50%;}
#music-btn .wave{ position: absolute; inset: -4px; border-radius: 50%; border: 1px solid var(--gold); opacity: 0;}
#music-btn.playing .wave{ animation: musicWave 2s ease-out infinite;}
@keyframes musicWave{ 0%{ transform: scale(1); opacity: 0.6;} 100%{ transform: scale(1.6); opacity: 0;} }
@keyframes spinDisc{ 100%{ transform: rotate(360deg);} }

/* ===== TOAST ===== */
#toast{ position: fixed; top: -100px; left: 50%; transform: translateX(-50%); z-index: 9999991; padding: 18px 30px 22px; background: var(--bg-deep); color: var(--ivory); font-family: var(--f-sans); font-size: 0.85rem; letter-spacing: 1px; border-radius: 4px; box-shadow: 0 20px 60px rgba(0,0,0,0.4); min-width: 280px; max-width: 90vw; text-align: center; transition: top 0.7s var(--ease-spring); border-top: 2px solid var(--gold);}
#toast.show{ top: 30px;}
#toast::before{ content: ''; position: absolute; bottom: 0; left: 0; height: 3px; background: var(--gold); width: 100%; transform-origin: right; animation: toastTimer 4s linear forwards;}
@keyframes toastTimer{ 0%{ transform: scaleX(1);} 100%{ transform: scaleX(0);} }

/* ===== ROTATING BADGE ===== */
.rot-badge{ position: absolute; right: 18px; top: 110px; width: 110px; height: 110px; animation: spinBadge 18s linear infinite; opacity: 0.5; z-index: 3; pointer-events: none; mix-blend-mode: multiply;}
@keyframes spinBadge{ 100%{ transform: rotate(360deg);} }

/* ===== INTRO OVERLAY ===== */
#intro-overlay{ position: fixed; top: 0; left: 50%; transform: translateX(-50%); width: min(450px, 100vw); height: 100vh; z-index: 99999; cursor: pointer; overflow: hidden; display: flex; flex-direction: column; justify-content: center; align-items: center; background: var(--bg-deep); }
#intro-overlay .curtain{ position: absolute; top: 0; width: 50%; height: 100%; background: linear-gradient(180deg, #1a1814 0%, #2a2620 50%, #1a1814 100%); transition: transform 1.4s var(--ease-luxe); z-index: 5;}
#intro-overlay .curtain-l{ left: 0; transform-origin: left;}
#intro-overlay .curtain-r{ right: 0; transform-origin: right;}
#intro-overlay.open .curtain-l{ transform: translateX(-100%);}
#intro-overlay.open .curtain-r{ transform: translateX(100%);}
#intro-overlay .curtain::after{ content: ''; position: absolute; top: 0; bottom: 0; width: 1px; background: linear-gradient(180deg, transparent, var(--gold), transparent); }
#intro-overlay .curtain-l::after{ right: 0;}
#intro-overlay .curtain-r::after{ left: 0;}

.intro-frame{ position: absolute; inset: 25px; border: 1px solid rgba(184,149,77,0.4); z-index: 6; pointer-events: none;}
.intro-frame::before, .intro-frame::after{ content:''; position:absolute; width: 50px; height: 50px; border: 1px solid var(--gold);}
.intro-frame::before{ top: -5px; left: -5px; border-right: none; border-bottom: none;}
.intro-frame::after{ bottom: -5px; right: -5px; border-left: none; border-top: none;}

.intro-content{ position: relative; z-index: 7; text-align: center; display: flex; flex-direction: column; align-items: center; color: var(--ivory);}
.intro-mono{ font-family: var(--f-sans); font-size: 0.6rem; letter-spacing: 6px; text-transform: uppercase; color: var(--gold-light); margin-bottom: 30px; opacity: 0.7;}
.intro-title{ font-family: var(--f-display); font-size: 3rem; color: var(--ivory); letter-spacing: 4px; margin-bottom: 8px;}
.intro-subtitle{ font-family: var(--f-sign); font-size: 2.2rem; color: var(--gold); margin-bottom: 50px;}

.progress-ring{ position: relative; width: 120px; height: 120px; margin-bottom: 25px;}
.progress-ring svg{ transform: rotate(-90deg);}
.progress-ring circle{ fill: none; stroke-width: 1.5;}
.progress-ring .ring-bg{ stroke: rgba(184,149,77,0.15);}
.progress-ring .ring-fill{ stroke: var(--gold); stroke-linecap: round; stroke-dasharray: 364; stroke-dashoffset: 364; transition: stroke-dashoffset 0.3s linear; filter: drop-shadow(0 0 4px var(--gold));}
.progress-ring .ring-num{ position: absolute; inset: 0; display: flex; justify-content: center; align-items: center; font-family: var(--f-sans); font-size: 1.6rem; font-weight: 300; color: var(--gold-light); letter-spacing: 1px;}
.progress-ring .ring-num span{ font-size: 0.7rem; margin-left: 2px; opacity: 0.6;}

.click-hint{ position: absolute; bottom: 70px; left: 50%; transform: translateX(-50%); z-index: 8; font-family: var(--f-sans); font-size: 0.6rem; color: var(--gold-light); text-transform: uppercase; letter-spacing: 5px; padding: 14px 32px; border: 1px solid rgba(184,149,77,0.5); border-radius: 50px; background: rgba(255,255,255,0.04); cursor: pointer; opacity: 0; pointer-events: none; transition: opacity 0.8s, background 0.4s, color 0.4s, letter-spacing 0.4s; backdrop-filter: blur(8px);}
.click-hint::before{ content: ''; position: absolute; inset: 0; border-radius: 50px; background: linear-gradient(120deg, transparent 30%, rgba(184,149,77,0.3) 50%, transparent 70%); background-size: 200% 100%; animation: shimmer 2.5s linear infinite; opacity: 0;}
.click-hint.show{ opacity: 1; pointer-events: auto;}
.click-hint.show::before{ opacity: 1;}
.click-hint:hover{ background: var(--gold); color: var(--bg-deep); letter-spacing: 7px;}
@keyframes shimmer{ 0%{ background-position: 200% 0;} 100%{ background-position: -200% 0;} }

/* ===== MAIN ===== */
#main-content{ opacity: 0; transition: opacity 0.6s; position: relative; z-index: 1;}
#main-content.visible{ opacity: 1;}

.hero{ height: 100vh; position: relative; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; overflow: hidden;}
.hero-bg-layer{ position: absolute; inset: -30px; background-image: url('uploads/grad_hero.jpg'); background-size: cover; background-position: center; z-index: 0; transform: scale(1.15); transition: transform 6s var(--ease-soft); filter: sepia(15%) contrast(1.08) brightness(1.02);}
#main-content.visible .hero-bg-layer{ transform: scale(1);}
.hero::before{ content: ''; position: absolute; inset: 0; background: linear-gradient(180deg, rgba(246,242,234,0.15) 0%, rgba(246,242,234,0.7) 60%, rgba(246,242,234,0.98) 100%); z-index: 1;}
.hero::after{ content: ''; position: absolute; inset: 0; background: radial-gradient(circle at 50% 30%, transparent 30%, rgba(26,24,20,0.15) 100%); z-index: 1; pointer-events: none;}

.hero-content{ position: relative; z-index: 2; color: var(--text-dark); padding: 0 25px; width: 100%; top: 18%;}
@media (max-width: 768px){ .hero-content{ top: 12%;} }

.hero-ornament{ width: 60px; height: 30px; margin: 0 auto 20px; opacity: 0; animation: fadeInDown 1.5s var(--ease-soft) 0.3s forwards;}
.hero-badge{ font-family: var(--f-sans); font-size: 0.65rem; font-weight: 500; letter-spacing: 8px; text-transform: uppercase; color: var(--gold-dark); margin-bottom: 28px; display: inline-block; padding: 6px 0; position: relative;}
.hero-badge::before, .hero-badge::after{ content: ''; position: absolute; top: 50%; width: 30px; height: 1px; background: var(--gold);}
.hero-badge::before{ right: calc(100% + 12px);}
.hero-badge::after{ left: calc(100% + 12px);}
.hero h1{ font-family: var(--f-display); font-size: clamp(3.8rem, 13vw, 5.5rem); font-weight: 400; line-height: 1; color: var(--text-dark); margin: 12px 0; letter-spacing: 1px;}
.hero h2{ font-family: var(--f-sign); font-size: clamp(2.6rem, 9.5vw, 4rem); color: var(--gold); font-weight: normal; margin-top: 8px; text-shadow: 0 2px 20px rgba(184,149,77,0.2);}

@keyframes fadeInDown{ 0%{ opacity: 0; transform: translateY(-20px);} 100%{ opacity: 1; transform: translateY(0);} }

/* INVITE BOX */
.invite-box{ margin-top: 55px; padding: 35px 40px; background: rgba(255,253,248,0.6); border: 1px solid rgba(255,255,255,0.7); border-radius: 22px; backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); display: inline-block; max-width: 90%; opacity: 0; box-shadow: 0 25px 50px rgba(0,0,0,0.08), inset 0 0 0 1px rgba(184,149,77,0.18); position: relative; overflow: hidden;}
.invite-box::before{ content: '✦'; position: absolute; top: 12px; left: 50%; transform: translateX(-50%); color: var(--gold); font-size: 14px; opacity: 0.5;}
.invite-box.anim{ animation: fadeInUp 1.6s var(--ease-soft) 1.2s forwards;}
.invite-label{ font-family: var(--f-sans); font-size: 0.6rem; font-weight: 600; text-transform: uppercase; letter-spacing: 6px; color: var(--text-light); margin-bottom: 15px;}
.invite-name{ font-family: var(--f-display); font-size: clamp(2.2rem, 8vw, 3rem); color: var(--gold-dark); line-height: 1.1; letter-spacing: 1px;}
@keyframes fadeInUp{ 0%{ opacity: 0; transform: translateY(50px);} 100%{ opacity: 1; transform: translateY(0);} }

/* SCROLL HINT */
.scroll-hint{ position: absolute; bottom: 40px; left: 50%; transform: translateX(-50%); z-index: 3; opacity: 0; animation: fadeInUp 1s ease 2.5s forwards;}
.scroll-hint .line{ width: 1px; height: 40px; background: linear-gradient(180deg, transparent, var(--gold), transparent); margin: 0 auto; position: relative; overflow: hidden;}
.scroll-hint .line::after{ content: ''; position: absolute; top: -100%; left: 0; width: 100%; height: 100%; background: var(--gold); animation: scrollLine 2s ease-in-out infinite;}
@keyframes scrollLine{ 0%{ top: -100%;} 100%{ top: 100%;} }
.scroll-hint .label{ font-family: var(--f-sans); font-size: 0.55rem; letter-spacing: 4px; color: var(--gold-dark); text-transform: uppercase; margin-top: 10px;}

/* ===== ORNAMENT DIVIDER ===== */
.ornament-divider{ padding: 50px 30px; background: var(--bg-card); position: relative; z-index: 2; text-align: center; overflow: hidden; border-top: 1px solid rgba(184,149,77,0.15); border-bottom: 1px solid rgba(184,149,77,0.15);}
.ornament-divider svg{ height: 24px; opacity: 0.7;}
.ornament-divider .orn-text{ font-family: var(--f-display); font-size: 1.4rem; color: var(--gold-dark); letter-spacing: 8px; margin: 0 25px; vertical-align: middle;}
.ornament-divider .orn-row{ display: flex; align-items: center; justify-content: center;}

/* ===== SECTIONS ===== */
.section{ padding: 90px 30px; text-align: center; position: relative; z-index: 2; background: var(--bg-page);}
.section-alt{ background: var(--bg-card);}
.title-wrapper{ margin-bottom: 50px; position: relative;}
.title-sm{ font-family: var(--f-sans); font-size: 0.65rem; text-transform: uppercase; letter-spacing: 7px; color: var(--gold); margin-bottom: 18px; font-weight: 500; display: inline-flex; align-items: center; gap: 12px;}
.title-sm::before, .title-sm::after{ content: ''; width: 18px; height: 1px; background: var(--gold);}
.title-lg{ font-family: var(--f-display); font-size: clamp(3rem, 11vw, 4.2rem); color: var(--text-dark); line-height: 1.05; font-weight: 400; letter-spacing: 1px;}

/* ===== LETTER ===== */
.letter-box{ position: relative; padding: 50px 30px 30px; text-align: left; background: linear-gradient(135deg, var(--bg-page) 0%, var(--ivory) 100%); border: 1px solid rgba(184,149,77,0.2); box-shadow: 0 25px 50px rgba(0,0,0,0.05); overflow: hidden;}
.letter-box::before{ content: 'H'; position: absolute; right: -30px; bottom: -60px; font-family: var(--f-display); font-size: 18rem; color: var(--gold); opacity: 0.06; line-height: 1; pointer-events: none; z-index: 0;}
.letter-stamp{ position: absolute; top: 20px; right: 20px; width: 70px; height: 70px; border: 2px solid var(--gold); border-radius: 50%; display: flex; justify-content: center; align-items: center; transform: rotate(-15deg); animation: stampWobble 4s ease-in-out infinite; z-index: 2; opacity: 0.7;}
.letter-stamp::before{ content: ''; position: absolute; inset: 4px; border: 1px dashed var(--gold); border-radius: 50%;}
.letter-stamp span{ font-family: var(--f-sans); font-size: 0.5rem; font-weight: 700; letter-spacing: 1px; color: var(--gold-dark); text-transform: uppercase; text-align: center; line-height: 1.3;}
@keyframes stampWobble{ 0%, 100%{ transform: rotate(-15deg);} 50%{ transform: rotate(-12deg);} }
.drop-cap{ float: left; font-family: var(--f-display); font-size: 5.5rem; line-height: 0.85; padding-top: 10px; padding-right: 14px; color: var(--gold); position: relative; z-index: 1;}
.letter-box p{ font-size: 1.18rem; color: var(--text-dark); margin-bottom: 22px; text-align: justify; position: relative; z-index: 1; font-weight: 400;}
.letter-sign{ font-family: var(--f-sign); font-size: 3.2rem; color: var(--gold-dark); text-align: right; margin-top: 30px; padding-top: 25px; border-top: 1px solid rgba(184,149,77,0.25); position: relative; z-index: 1;}

/* ===== JOURNEY ===== */
.journey-wrap{ position: relative; padding: 20px 0 0 30px; text-align: left;}
.j-line-bg{ position: absolute; left: 0; top: 30px; bottom: 20px; width: 1px; background: rgba(184,149,77,0.18);}
.j-line-fill{ position: absolute; left: 0; top: 30px; width: 1px; height: 0%; background: linear-gradient(180deg, var(--gold-light), var(--gold), var(--bronze)); transition: height 0.15s linear; z-index: 1; box-shadow: 0 0 8px var(--gold);}

.j-item{ position: relative; padding-bottom: 50px; z-index: 2;}
.j-item:last-child{ padding-bottom: 0;}
.j-item::before{ content: ''; position: absolute; left: -36px; top: 6px; width: 13px; height: 13px; background: var(--bg-card); border: 2px solid var(--gold); border-radius: 50%; box-shadow: 0 0 0 5px var(--bg-card), 0 4px 12px rgba(184,149,77,0.3); transition: all 0.5s var(--ease-spring);}
.j-item.active::before{ background: var(--gold); box-shadow: 0 0 0 5px var(--bg-card), 0 0 0 9px rgba(184,149,77,0.2), 0 4px 12px rgba(184,149,77,0.4); animation: dotPulse 2s infinite;}
@keyframes dotPulse{ 0%, 100%{ box-shadow: 0 0 0 5px var(--bg-card), 0 0 0 9px rgba(184,149,77,0.2);} 50%{ box-shadow: 0 0 0 5px var(--bg-card), 0 0 0 14px rgba(184,149,77,0.05);} }
.j-year{ font-family: var(--f-sans); font-size: 0.75rem; font-weight: 600; color: var(--gold); letter-spacing: 3px; margin-bottom: 8px; text-transform: uppercase;}
.j-title{ font-family: var(--f-display); font-size: 1.6rem; font-weight: 400; color: var(--text-dark); margin-bottom: 10px; line-height: 1.2; letter-spacing: 0.5px;}
.j-desc{ font-family: var(--f-body); font-size: 1.12rem; color: var(--text-body); line-height: 1.75;}

/* ===== GALLERY ===== */
.photo-grid{ display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; align-items: start;}
.col-left{ display: flex; flex-direction: column; gap: 16px; margin-top: 24px; transition: transform 0.1s linear;}
.col-right{ display: flex; flex-direction: column; gap: 16px; transition: transform 0.1s linear;}
.photo-item{ border-radius: 14px; background: var(--bg-accent); overflow: hidden; position: relative;}
.photo-item img{ width: 100%; height: 100%; display: block; object-fit: cover; cursor: none;}
.img-tall{ aspect-ratio: 3/4;}
.img-square{ aspect-ratio: 1/1;}

/* ===== CALENDAR ===== */
.cal-container{ background: linear-gradient(180deg, #fff 0%, var(--ivory) 100%); border-radius: 18px; overflow: hidden; box-shadow: 0 25px 60px rgba(0,0,0,0.08), 0 0 0 1px rgba(184,149,77,0.15); margin: 0 10px 45px;}
.cal-header{ background: linear-gradient(135deg, var(--bg-accent) 0%, var(--champagne) 100%); padding: 30px 0 25px; border-bottom: 1px solid rgba(184,149,77,0.25); position: relative; overflow: hidden;}
.cal-header::before, .cal-header::after{ content: ''; position: absolute; top: 50%; width: 40px; height: 1px; background: var(--gold);}
.cal-header::before{ left: 30px;}
.cal-header::after{ right: 30px;}
.cal-month{ font-family: var(--f-display); font-size: 2rem; color: var(--text-dark); font-weight: 400; letter-spacing: 4px;}
.cal-year{ font-family: var(--f-sans); font-size: 0.75rem; color: var(--gold-dark); letter-spacing: 4px; font-weight: 500; margin-top: 6px;}
.cal-body{ padding: 30px 22px;}
.cal-table{ width: 100%; border-collapse: collapse; font-family: var(--f-sans); font-size: 0.85rem;}
.cal-table th{ padding-bottom: 18px; color: var(--gold-dark); font-weight: 600; text-transform: uppercase; font-size: 0.6rem; letter-spacing: 1.5px;}
.cal-table td{ padding: 13px 0; color: var(--text-body); font-weight: 400; text-align: center;}
.cal-table td.muted{ color: #d4cebd;}
.day-highlight{ display: inline-flex; justify-content: center; align-items: center; width: 38px; height: 38px; background: linear-gradient(135deg, var(--gold) 0%, var(--bronze) 100%); color: #fff !important; border-radius: 50%; font-weight: 600; box-shadow: 0 8px 20px rgba(184,149,77,0.4); animation: pulseDate 2.5s infinite; position: relative;}
.day-highlight::before{ content: '★'; position: absolute; top: -12px; right: -8px; color: var(--gold); font-size: 14px; animation: starTwinkle 2s infinite alternate;}
@keyframes starTwinkle{ 0%{ opacity: 0.5; transform: scale(0.8);} 100%{ opacity: 1; transform: scale(1.1);} }
@keyframes pulseDate{ 0%, 100%{ box-shadow: 0 8px 20px rgba(184,149,77,0.4), 0 0 0 0 rgba(184,149,77,0.5);} 50%{ box-shadow: 0 8px 20px rgba(184,149,77,0.4), 0 0 0 12px rgba(184,149,77,0);} }

.location-card{ padding: 10px 20px; text-align: center;}
.loc-name{ font-family: var(--f-display); font-size: 1.8rem; font-weight: 400; color: var(--text-dark); margin-bottom: 18px; line-height: 1.3; letter-spacing: 0.5px;}
.loc-addr{ font-family: var(--f-body); font-size: 1.18rem; color: var(--text-body); line-height: 1.6; margin-bottom: 35px;}
.btn{ display: inline-block; padding: 18px 40px; background: var(--text-dark); color: var(--gold-light); text-decoration: none; font-family: var(--f-sans); font-size: 0.7rem; font-weight: 500; text-transform: uppercase; letter-spacing: 4px; transition: all 0.5s var(--ease-soft); border-radius: 50px; border: 1px solid var(--text-dark); cursor: none; position: relative; overflow: hidden;}
.btn::before{ content: ''; position: absolute; inset: 0; background: linear-gradient(90deg, var(--gold), var(--bronze)); transform: translateX(-100%); transition: transform 0.5s var(--ease-soft);}
.btn:hover{ color: #fff; border-color: var(--gold);}
.btn:hover::before{ transform: translateX(0);}
.btn span{ position: relative; z-index: 1;}

/* ===== RSVP ===== */
.rsvp-section{ position: relative; padding: 90px 30px; text-align: center; border-top: 1px solid rgba(184,149,77,0.15); overflow: hidden; background: linear-gradient(180deg, var(--bg-card) 0%, var(--bg-page) 100%); z-index: 2;}
.ambient-orb{ position: absolute; border-radius: 50%; filter: blur(50px); opacity: 0.5; animation: floatOrb 10s ease-in-out infinite alternate; z-index: 0; pointer-events: none;}
.orb-1{ width: 180px; height: 180px; background: var(--gold-light); top: -30px; left: -30px;}
.orb-2{ width: 200px; height: 200px; background: var(--rose); bottom: -40px; right: -40px; animation-delay: -5s; opacity: 0.35;}
.orb-3{ width: 120px; height: 120px; background: var(--sage); top: 40%; right: 10%; animation-delay: -2s; opacity: 0.25;}
@keyframes floatOrb{ 0%{ transform: translate(0, 0) scale(1);} 100%{ transform: translate(40px, 40px) scale(1.25);} }

.rsvp-glass{ background: rgba(255,253,248,0.65); backdrop-filter: blur(25px); -webkit-backdrop-filter: blur(25px); border: 1px solid rgba(255,255,255,0.6); border-radius: 28px; padding: 50px 25px; position: relative; z-index: 2; box-shadow: 0 25px 50px rgba(0,0,0,0.05), inset 0 0 0 1px rgba(184,149,77,0.1);}

.form-group{ position: relative; margin-bottom: 28px; text-align: left;}
.form-control{ width: 100%; padding: 20px 22px 14px; border: 1px solid rgba(184,149,77,0.3); background: rgba(255,255,255,0.7); font-family: var(--f-body); font-size: 1.12rem; color: var(--text-dark); outline: none; transition: all 0.4s var(--ease-soft); border-radius: 10px; cursor: none;}
.form-control:focus{ background: #fff; border-color: var(--gold); box-shadow: 0 8px 25px rgba(184,149,77,0.15);}
textarea.form-control{ resize: vertical; min-height: 130px; padding-top: 26px;}
.form-label{ position: absolute; left: 22px; top: 18px; font-family: var(--f-sans); font-size: 0.85rem; color: var(--text-light); pointer-events: none; transition: all 0.3s var(--ease-soft); letter-spacing: 0.5px;}
.form-control:focus + .form-label,
.form-control:not(:placeholder-shown) + .form-label{ top: 6px; font-size: 0.55rem; color: var(--gold-dark); letter-spacing: 2px; text-transform: uppercase;}

.btn-submit{ width: 100%; padding: 22px; background: linear-gradient(135deg, var(--gold) 0%, var(--bronze) 100%); color: #fff; border: none; font-family: var(--f-sans); font-size: 0.75rem; font-weight: 600; letter-spacing: 5px; text-transform: uppercase; cursor: none; transition: all 0.5s var(--ease-soft); border-radius: 50px; box-shadow: 0 12px 30px rgba(184,149,77,0.35); position: relative; overflow: hidden;}
.btn-submit::before{ content: ''; position: absolute; top: 0; left: -100%; width: 100%; height: 100%; background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent); transition: left 0.7s;}
.btn-submit:hover::before{ left: 100%;}
.btn-submit:hover{ transform: translateY(-3px); box-shadow: 0 18px 40px rgba(184,149,77,0.45);}

/* ===== THANK SECTION ===== */
.thank-section{ padding: 80px 28px 110px; text-align: center; background: linear-gradient(180deg, var(--bg-deep) 0%, #0f0d0a 100%); color: #fff; position: relative; overflow: hidden;}
.thank-section::before{ content: ''; position: absolute; top: 0; left: 0; right: 0; height: 200px; background: radial-gradient(ellipse at top, rgba(184,149,77,0.15) 0%, transparent 70%); pointer-events: none;}
.thank-section .title-sm{ color: var(--gold-light);}
.thank-section .title-sm::before, .thank-section .title-sm::after{ background: var(--gold-light);}
.thank-section .title-lg{ color: #fff;}

.countdown{ display: flex; justify-content: center; gap: 14px; margin: 50px 0 70px;}
.cd-item{ text-align: center; min-width: 65px; position: relative; padding: 18px 8px; border: 1px solid rgba(184,149,77,0.2); border-radius: 10px; background: rgba(255,255,255,0.02); backdrop-filter: blur(5px);}
.cd-num{ font-family: var(--f-display); font-size: 2.6rem; font-weight: 400; color: var(--gold-light); line-height: 1; transition: transform 0.3s; display: inline-block;}
.cd-num.flip{ animation: flipNum 0.6s var(--ease-soft);}
@keyframes flipNum{ 0%{ transform: rotateX(0);} 50%{ transform: rotateX(90deg); opacity: 0.3;} 100%{ transform: rotateX(0);} }
.cd-label{ font-family: var(--f-sans); font-size: 0.55rem; color: #a8a294; text-transform: uppercase; letter-spacing: 3px; margin-top: 14px; font-weight: 500;}

.footer-name{ font-family: var(--f-sign); font-size: clamp(3.8rem, 11vw, 5rem); color: var(--gold); line-height: 1; margin-top: 35px; text-shadow: 0 4px 30px rgba(184,149,77,0.3);}

/* ===== REVEAL ===== */
.reveal{ opacity: 0; transform: translateY(50px); transition: opacity 1.3s var(--ease-soft), transform 1.3s var(--ease-soft);}
.reveal.in{ opacity: 1; transform: translateY(0);}
.reveal-scale{ opacity: 0; transform: scale(0.92); transition: opacity 1.3s var(--ease-soft), transform 1.3s var(--ease-soft);}
.reveal-scale.in{ opacity: 1; transform: scale(1);}
.reveal-left{ opacity: 0; transform: translateX(-50px); transition: all 1.3s var(--ease-soft);}
.reveal-left.in{ opacity: 1; transform: translateX(0);}

/* ===== LIGHTBOX ===== */
#lightbox{ position: fixed; inset: 0; background: rgba(15,13,10,0.96); z-index: 9999999; display: flex; justify-content: center; align-items: center; opacity: 0; pointer-events: none; transition: opacity 0.5s; padding: 25px; cursor: none; backdrop-filter: blur(12px);}
#lightbox.active{ opacity: 1; pointer-events: auto;}
#lightbox img{ max-width: 100%; max-height: 88vh; object-fit: contain; border-radius: 4px; transform: scale(0.92) translateY(20px); transition: transform 0.6s var(--ease-spring); box-shadow: 0 30px 80px rgba(0,0,0,0.5);}
#lightbox.active img{ transform: scale(1) translateY(0);}
.lightbox-close{ position: absolute; top: 25px; right: 30px; color: var(--gold-light); font-size: 2.5rem; cursor: pointer; font-family: var(--f-sans); line-height: 1; font-weight: 200; transition: transform 0.3s, color 0.3s;}
.lightbox-close:hover{ color: #fff; transform: rotate(90deg);}

#sparks-canvas{ position: fixed; top: 0; left: 50%; transform: translateX(-50%); width: min(450px, 100vw); height: 100%; z-index: 1; pointer-events: none; opacity: 0; transition: opacity 1.5s;}
#sparks-canvas.active{ opacity: 1;}
</style>
</head>
<body class="locked">

<div class="noise-overlay"></div>
<div class="vignette"></div>

<div class="cursor-dot" id="cursor-dot"></div>
<div class="cursor-ring" id="cursor-ring"></div>

<div id="toast" class="<?= $toast_class ?>" data-type="<?= $toast_type ?>"><?= $toast_msg ?></div>

<div id="music-btn" class="magnetic" title="Bật/Tắt nhạc"><span class="wave"></span></div>
<audio id="bg-music" src="uploads/acoustic_bg.mp3" loop preload="auto"></audio>

<canvas id="sparks-canvas"></canvas>

<!-- CHAPTER INDICATOR -->
<div id="chapter-indicator">
    <div class="chap-dot" data-target="hero" data-label="Mở đầu"></div>
    <div class="chap-dot" data-target="letter" data-label="Tri ân"></div>
    <div class="chap-dot" data-target="journey" data-label="Hành trình"></div>
    <div class="chap-dot" data-target="memories" data-label="Ký ức"></div>
    <div class="chap-dot" data-target="date" data-label="Save the date"></div>
    <div class="chap-dot" data-target="rsvp" data-label="Lưu bút"></div>
</div>

<!-- INTRO -->
<div id="intro-overlay">
    <div class="curtain curtain-l"></div>
    <div class="curtain curtain-r"></div>
    <div class="intro-frame"></div>

    <div class="intro-content">
        <div class="intro-mono">— Class of 2026 —</div>
        <div class="intro-title">GRADUATION</div>
        <div class="intro-subtitle">Đỗ Văn Hin</div>

        <div class="progress-ring">
            <svg width="120" height="120">
                <circle class="ring-bg" cx="60" cy="60" r="58"/>
                <circle class="ring-fill" id="ring-fill" cx="60" cy="60" r="58"/>
            </svg>
            <div class="ring-num" id="intro-loader">0<span>%</span></div>
        </div>
    </div>

    <div class="click-hint magnetic" id="click-hint">Chạm để tham dự</div>
</div>

<div id="scroll-progress"><div id="scroll-progress-bar"></div></div>

<div class="wrapper" id="main-content">

<!-- ROTATING BADGE -->
<img src="data:image/svg+xml;utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 200'%3E%3Cpath id='c' d='M 100 100 m -75 0 a 75 75 0 1 1 150 0 a 75 75 0 1 1 -150 0' fill='none'/%3E%3Ctext fill='%23b8954d' font-family='Montserrat,sans-serif' font-weight='600' font-size='18' letter-spacing='6'%3E%3CtextPath href='%23c'%3E ✦ CLASS OF 2026 ✦ CỬ NHÂN IT ✦ %3C/textPath%3E%3C/text%3E%3C/svg%3E" class="rot-badge" alt="">

<!-- HERO -->
<div class="hero" id="sec-hero">
    <div class="hero-bg-layer" id="hero-bg"></div>

    <div class="tilt-wrapper invite-box" id="inviteBox" style="display:none">
        <div class="tilt-card">
            <div class="glare"></div>
            <p class="invite-label">Thân mời</p>
            <p class="invite-name" id="guestNameDisplay"></p>
        </div>
    </div>

    <div class="hero-content" id="hero-text-layer">
        <svg class="hero-ornament" viewBox="0 0 60 30" fill="none">
            <path d="M0 15 L25 15 M35 15 L60 15" stroke="#b8954d" stroke-width="0.8"/>
            <circle cx="30" cy="15" r="3" fill="none" stroke="#b8954d" stroke-width="0.8"/>
            <circle cx="30" cy="15" r="1" fill="#b8954d"/>
        </svg>
        <div class="hero-badge">The Graduation Day</div>
        <h1 id="hero-name" class="split-text">Đỗ Văn Hin</h1>
        <h2 class="split-text" style="margin-top:12px;">Cử Nhân IT</h2>
    </div>

    <div class="scroll-hint">
        <div class="line"></div>
        <div class="label">Cuộn xuống</div>
    </div>
</div>

<!-- ORNAMENT DIVIDER -->
<div class="ornament-divider">
    <div class="orn-row">
        <svg viewBox="0 0 60 24" width="60" height="24" fill="none">
            <path d="M0 12 L20 12" stroke="#b8954d"/>
            <path d="M20 12 Q26 6 32 12 T44 12" stroke="#b8954d" fill="none"/>
            <circle cx="50" cy="12" r="2" fill="#b8954d"/>
            <path d="M55 12 L60 12" stroke="#b8954d"/>
        </svg>
        <span class="orn-text">FOREVER</span>
        <svg viewBox="0 0 60 24" width="60" height="24" fill="none">
            <path d="M0 12 L5 12" stroke="#b8954d"/>
            <circle cx="10" cy="12" r="2" fill="#b8954d"/>
            <path d="M16 12 Q22 18 28 12 T40 12" stroke="#b8954d" fill="none"/>
            <path d="M40 12 L60 12" stroke="#b8954d"/>
        </svg>
    </div>
</div>

<!-- LETTER -->
<div class="section section-alt" id="sec-letter" style="padding-top:70px; padding-bottom:50px;">
    <div class="title-wrapper">
        <div class="title-sm reveal">Lời Tri Ân</div>
        <h2 class="title-lg split-text reveal">Dear Beloved,</h2>
    </div>

    <div class="tilt-wrapper reveal">
        <div class="tilt-card letter-box">
            <div class="glare"></div>
            <div class="letter-stamp"><span>Class<br>of<br>2026</span></div>
            <span class="drop-cap">N</span>
            <p>ăm tháng thanh xuân rực rỡ nhất tại giảng đường đại học đã khép lại, để lại trong mình biết bao kỷ niệm vô giá. Thành quả ngày hôm nay không chỉ là sự nỗ lực của bản thân, mà còn là kết tinh từ tình yêu thương của gia đình, sự tận tâm của thầy cô và sự đồng hành của bạn bè.</p>
            <p>Sự hiện diện của bạn trong ngày vui này chính là mảnh ghép hoàn hảo nhất, để cùng mình đánh dấu cột mốc đáng nhớ và mở ra những cánh cửa hy vọng mới.</p>
            <div class="letter-sign">Hin.</div>
        </div>
    </div>
</div>

<!-- JOURNEY -->
<div class="section" id="sec-journey" style="padding-top:70px; padding-bottom:40px;">
    <div class="title-wrapper">
        <div class="title-sm reveal">Chặng đường 4 năm</div>
        <h2 class="title-lg split-text reveal">The Journey</h2>
    </div>

    <div class="journey-wrap" id="journey-wrap">
        <div class="j-line-bg"></div>
        <div class="j-line-fill" id="j-line-fill"></div>

        <div class="j-item reveal-left">
            <div class="j-year">Năm 2022</div>
            <div class="j-title">Chạm ngõ STU</div>
            <div class="j-desc">Những ngày đầu bỡ ngỡ bước chân vào Đại học Công Nghệ Sài Gòn, làm quen với những dòng code cơ bản đầu tiên.</div>
        </div>
        <div class="j-item reveal-left">
            <div class="j-year">2024 — 2025</div>
            <div class="j-title">Đam mê & Thử thách</div>
            <div class="j-desc">Gắn bó với những đêm thức trắng cùng PHP, Laravel, React. Niềm đam mê lập trình Web lớn lên qua từng đồ án.</div>
        </div>
        <div class="j-item reveal-left">
            <div class="j-year">Năm 2026</div>
            <div class="j-title">Quả ngọt</div>
            <div class="j-desc">Bảo vệ thành công Đồ án Tốt nghiệp "Website Bán Laptop". Chính thức khép lại hành trình sinh viên để khoác lên mình chiếc áo Cử nhân.</div>
        </div>
    </div>
</div>

<!-- GALLERY -->
<div class="section section-alt" id="sec-memories" style="padding-top:70px;">
    <div class="title-wrapper">
        <div class="title-sm reveal">Lưu giữ thanh xuân</div>
        <h2 class="title-lg split-text reveal">Memories</h2>
    </div>

    <div class="photo-grid">
        <div class="col-left" id="gallery-col-1">
            <div class="tilt-wrapper"><div class="tilt-card photo-item img-wipe img-tall"><div class="glare"></div><img src="uploads/anh_ca_nhan_1.jpg" alt="Chân dung 1" class="zoomable"></div></div>
            <div class="tilt-wrapper"><div class="tilt-card photo-item img-wipe img-square"><div class="glare"></div><img src="uploads/anh_tot_nghiep_1.jpg" alt="Áo cử nhân" class="zoomable"></div></div>
        </div>
        <div class="col-right" id="gallery-col-2">
            <div class="tilt-wrapper"><div class="tilt-card photo-item img-wipe img-square"><div class="glare"></div><img src="uploads/anh_tap_the.jpg" alt="Kỷ yếu" class="zoomable"></div></div>
            <div class="tilt-wrapper"><div class="tilt-card photo-item img-wipe img-tall"><div class="glare"></div><img src="uploads/anh_ca_nhan_2.jpg" alt="Chân dung 2" class="zoomable"></div></div>
        </div>
    </div>
</div>

<!-- SAVE THE DATE -->
<div class="section" id="sec-date" style="padding-bottom:30px;">
    <div class="title-wrapper">
        <div class="title-sm reveal">Thời Gian & Địa Điểm</div>
        <h2 class="title-lg split-text reveal">Save The Date</h2>
    </div>

    <div class="tilt-wrapper reveal-scale">
        <div class="tilt-card cal-container">
            <div class="glare"></div>
            <div class="cal-header">
                <div class="cal-month">November</div>
                <div class="cal-year">2026</div>
            </div>
            <div class="cal-body">
                <table class="cal-table">
                    <tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>
                    <tr><td class="muted">1</td><td class="muted">2</td><td class="muted">3</td><td class="muted">4</td><td class="muted">5</td><td class="muted">6</td><td class="muted">7</td></tr>
                    <tr><td>8</td><td>9</td><td>10</td><td>11</td><td>12</td><td>13</td><td>14</td></tr>
                    <tr><td>15</td><td>16</td><td>17</td><td>18</td><td>19</td><td>20</td><td><span class="day-highlight">21</span></td></tr>
                    <tr><td>22</td><td>23</td><td>24</td><td>25</td><td>26</td><td>27</td><td>28</td></tr>
                    <tr><td>29</td><td>30</td><td class="muted">1</td><td class="muted">2</td><td class="muted">3</td><td class="muted">4</td><td class="muted">5</td></tr>
                </table>
            </div>
        </div>
    </div>

    <div class="location-card reveal">
        <div class="loc-name">Hội Trường Lớn STU</div>
        <div class="loc-addr">Đại học Công Nghệ Sài Gòn<br>180 Cao Lỗ, Phường 4, Quận 8, TP.HCM</div>
        <a href="https://maps.google.com/?q=180+Cao+Lỗ,+Phường+4,+Quận+8,+TP.HCM" target="_blank" class="btn magnetic"><span>Chỉ đường Map</span></a>
    </div>
</div>

<!-- RSVP -->
<div class="rsvp-section" id="rsvp">
    <div class="ambient-orb orb-1"></div>
    <div class="ambient-orb orb-2"></div>
    <div class="ambient-orb orb-3"></div>

    <div class="tilt-wrapper reveal-scale">
        <div class="tilt-card rsvp-glass">
            <div class="glare"></div>
            <div class="title-sm">Sổ Lưu Bút</div>
            <h2 class="title-lg split-text" style="font-size:3rem; margin-bottom:14px;">Gửi Lời Thương</h2>
            <p style="font-family:var(--f-sans); font-size:0.85rem; color:var(--text-body); margin-bottom:35px; font-weight:300; letter-spacing:1px; line-height:1.7;">
                Nếu không thể đến chung vui, đừng ngần ngại<br>gửi lại đây những lời chúc tốt lành nhất nhé.
            </p>

            <form method="POST" action="?<?= isset($_SERVER['QUERY_STRING']) ? htmlspecialchars($_SERVER['QUERY_STRING']) : '' ?>#rsvp">
                <div class="form-group">
                    <input type="text" id="rsvp_name" name="rsvp_name" class="form-control magnetic" placeholder=" " value="<?= $guest_name_url ?>" required>
                    <label for="rsvp_name" class="form-label">Tên của bạn</label>
                </div>
                <div class="form-group">
                    <textarea id="rsvp_msg" name="rsvp_message" class="form-control magnetic" placeholder=" " required></textarea>
                    <label for="rsvp_msg" class="form-label">Lời chúc tốt nghiệp</label>
                </div>
                <button type="submit" name="submit_rsvp" class="btn-submit magnetic">Gửi Lời Chúc ✦</button>
            </form>
        </div>
    </div>
</div>

<!-- THANK -->
<div class="thank-section">
    <div class="reveal">
        <div class="title-sm">Đếm Ngược Thời Gian</div>
        <h2 class="title-lg split-text">See You Soon</h2>
    </div>

    <div class="countdown reveal-scale" id="countdown">
        <div class="cd-item"><div class="cd-num" id="days">00</div><div class="cd-label">Ngày</div></div>
        <div class="cd-item"><div class="cd-num" id="hours">00</div><div class="cd-label">Giờ</div></div>
        <div class="cd-item"><div class="cd-num" id="minutes">00</div><div class="cd-label">Phút</div></div>
        <div class="cd-item"><div class="cd-num" id="seconds">00</div><div class="cd-label">Giây</div></div>
    </div>

    <div class="title-sm reveal" style="margin-top:30px; color:var(--text-light);">Trân Trọng Cảm Ơn</div>
    <div class="footer-name reveal">Đỗ Văn Hin</div>
</div>

</div>

<!-- LIGHTBOX -->
<div id="lightbox">
    <span class="lightbox-close magnetic">×</span>
    <img id="lightbox-img" src="" alt="">
</div>

<script>
(function(){
    /* SPLIT TEXT */
    document.querySelectorAll('.split-text').forEach(el => {
        const words = el.innerText.split(' ');
        el.innerHTML = '';
        words.forEach((word, i) => {
            const span = document.createElement('span');
            span.className = 'split-word';
            span.innerHTML = `<span class="split-inner" style="transition-delay:${i*0.08}s">${word}&nbsp;</span>`;
            el.appendChild(span);
        });
    });

    /* GUEST NAME */
    const urlParams = new URLSearchParams(window.location.search);
    const guestName = urlParams.get('to');
    if(guestName && guestName.trim()){
        document.getElementById('inviteBox').style.display = 'inline-block';
        document.getElementById('guestNameDisplay').innerText = guestName;
    }

    /* CURSOR + MAGNETIC + GLARE */
    const cursorDot = document.getElementById('cursor-dot');
    const cursorRing = document.getElementById('cursor-ring');
    const isFine = window.matchMedia("(pointer: fine)").matches;

    if(isFine){
        let mx = 0, my = 0, rx = 0, ry = 0;
        document.addEventListener('mousemove', e => {
            mx = e.clientX; my = e.clientY;
            cursorDot.style.left = mx + 'px';
            cursorDot.style.top = my + 'px';
        });
        function ringLoop(){
            rx += (mx - rx) * 0.18;
            ry += (my - ry) * 0.18;
            cursorRing.style.left = rx + 'px';
            cursorRing.style.top = ry + 'px';
            requestAnimationFrame(ringLoop);
        }
        ringLoop();

        document.addEventListener('mousedown', () => document.body.classList.add('click-active'));
        document.addEventListener('mouseup', () => document.body.classList.remove('click-active'));

        document.querySelectorAll('.magnetic, .zoomable, input, textarea, button, a, .chap-dot').forEach(el => {
            el.addEventListener('mouseenter', () => document.body.classList.add('hovering'));
            el.addEventListener('mouseleave', () => {
                document.body.classList.remove('hovering');
                if(el.classList.contains('magnetic')) el.style.transform = '';
            });
            if(el.classList.contains('magnetic')){
                el.addEventListener('mousemove', e => {
                    const r = el.getBoundingClientRect();
                    const x = e.clientX - r.left - r.width/2;
                    const y = e.clientY - r.top - r.height/2;
                    el.style.transform = `translate(${x*0.35}px, ${y*0.35}px) rotate(${x*0.05}deg)`;
                });
            }
        });
    }

    /* TILT + GLARE */
    if(isFine){
        document.querySelectorAll('.tilt-card').forEach(card => {
            const glare = card.querySelector('.glare');
            card.addEventListener('mousemove', e => {
                card.classList.remove('reset');
                const r = card.getBoundingClientRect();
                const x = e.clientX - r.left;
                const y = e.clientY - r.top;
                const rx = ((y - r.height/2) / (r.height/2)) * -7;
                const ry = ((x - r.width/2) / (r.width/2)) * 7;
                card.style.transform = `perspective(1200px) rotateX(${rx}deg) rotateY(${ry}deg) scale3d(1.02,1.02,1.02)`;
                if(glare){
                    glare.style.setProperty('--mx', (x/r.width*100) + '%');
                    glare.style.setProperty('--my', (y/r.height*100) + '%');
                }
            });
            card.addEventListener('mouseleave', () => card.classList.add('reset'));
        });
    }

    /* PRELOADER — REAL PROGRESS */
    let loadProgress = 0;
    const loaderEl = document.getElementById('intro-loader');
    const ringFill = document.getElementById('ring-fill');
    const hintEl = document.getElementById('click-hint');
    const RING_LEN = 364;

    const loadInterval = setInterval(() => {
        loadProgress += Math.random() * 2.5 + 0.8;
        if(loadProgress >= 100){
            loadProgress = 100;
            clearInterval(loadInterval);
            setTimeout(() => hintEl.classList.add('show'), 400);
        }
        const p = Math.floor(loadProgress);
        loaderEl.innerHTML = p + '<span>%</span>';
        ringFill.style.strokeDashoffset = RING_LEN - (RING_LEN * loadProgress / 100);
    }, 60);

    /* TOAST AUTO-HIDE + SKIP INTRO */
    const toast = document.getElementById('toast');
    if(toast && toast.classList.contains('show')){
        setTimeout(() => toast.classList.remove('show'), 4000);
        document.getElementById('intro-overlay').style.display = 'none';
        document.body.classList.remove('locked');
        document.getElementById('main-content').classList.add('visible');
        document.getElementById('sparks-canvas').classList.add('active');
        clearInterval(loadInterval);
        setTimeout(initReveal, 100);
        setTimeout(() => { if(typeof animSparks === 'function') animSparks(); }, 100);
        document.querySelectorAll('.split-text, .img-wipe').forEach(m => m.classList.add('in'));
    }

    /* MUSIC */
    const musicBtn = document.getElementById('music-btn');
    const bgMusic = document.getElementById('bg-music');
    let isPlaying = false, userInteractedMusic = false;

    if(musicBtn && bgMusic){
        musicBtn.addEventListener('click', () => {
            userInteractedMusic = true;
            if(isPlaying){ bgMusic.pause(); musicBtn.classList.remove('playing'); }
            else{ bgMusic.play(); musicBtn.classList.add('playing'); }
            isPlaying = !isPlaying;
        });
    }

    /* COUNTDOWN with FLIP */
    const target = new Date('2026-11-21T07:30:00').getTime();
    const lastVals = { days:'', hours:'', minutes:'', seconds:'' };
    function updateCD(){
        const d = target - Date.now();
        if(d < 0){
            document.getElementById('countdown').innerHTML = '<div style="font-family:var(--f-sans); font-size:1.1rem; color:var(--gold-light); font-weight:500; letter-spacing:4px; text-transform:uppercase;">— Sự Kiện Đã Diễn Ra —</div>';
            return;
        }
        const pad = n => String(n).padStart(2,'0');
        const vals = {
            days: pad(Math.floor(d/86400000)),
            hours: pad(Math.floor(d%86400000/3600000)),
            minutes: pad(Math.floor(d%3600000/60000)),
            seconds: pad(Math.floor(d%60000/1000))
        };
        Object.keys(vals).forEach(k => {
            if(vals[k] !== lastVals[k]){
                const el = document.getElementById(k);
                if(el){
                    el.classList.remove('flip');
                    void el.offsetWidth;
                    el.classList.add('flip');
                    el.innerText = vals[k];
                }
                lastVals[k] = vals[k];
            }
        });
    }
    updateCD(); setInterval(updateCD, 1000);

    /* SPARKS */
    const canvas = document.getElementById('sparks-canvas');
    const ctx = canvas.getContext('2d');
    let particles = [];
    function resizeCanvas(){ canvas.width = Math.min(450, window.innerWidth); canvas.height = window.innerHeight; }
    resizeCanvas(); window.addEventListener('resize', resizeCanvas);

    function createSparks(){
        for(let i=0;i<45;i++){
            particles.push({
                x: Math.random()*canvas.width, y: Math.random()*canvas.height,
                r: Math.random()*1.8 + 0.4,
                color: `rgba(184,149,77,${Math.random()*0.5 + 0.1})`,
                speedY: Math.random()*-0.7 - 0.15,
                speedX: Math.random()*0.8 - 0.4,
                twinkle: Math.random()*Math.PI*2
            });
        }
    }
    function animSparks(){
        if(particles.length === 0) createSparks();
        ctx.clearRect(0,0,canvas.width,canvas.height);
        particles.forEach(p => {
            p.twinkle += 0.05;
            const op = (Math.sin(p.twinkle)+1)/2 * 0.7 + 0.3;
            ctx.beginPath();
            ctx.arc(p.x, p.y, p.r, 0, Math.PI*2);
            ctx.fillStyle = p.color.replace(/[\d.]+\)$/, op*0.5 + ')');
            ctx.shadowBlur = 8; ctx.shadowColor = '#b8954d';
            ctx.fill();
            p.y += p.speedY; p.x += p.speedX;
            if(p.y < -10){ p.y = canvas.height + 10; p.x = Math.random()*canvas.width; }
        });
        ctx.shadowBlur = 0;
        requestAnimationFrame(animSparks);
    }

    /* AUTO SCROLL */
    let scrollAnimId = null, isAutoScrolling = false, currentY = 0;
    function smoothScrollToBottom(){
        isAutoScrolling = true;
        currentY = window.scrollY;
        document.documentElement.style.scrollBehavior = 'auto';
        function loop(){
            if(!isAutoScrolling) return;
            currentY += 1.0;
            window.scrollTo(0, currentY);
            const max = document.documentElement.scrollHeight - window.innerHeight;
            if(window.scrollY < max - 5) scrollAnimId = requestAnimationFrame(loop);
            else stopAutoScroll();
        }
        scrollAnimId = requestAnimationFrame(loop);
    }
    function stopAutoScroll(){
        if(isAutoScrolling){
            isAutoScrolling = false;
            if(scrollAnimId){ cancelAnimationFrame(scrollAnimId); scrollAnimId = null; }
            document.documentElement.style.scrollBehavior = 'smooth';
        }
    }
    ['wheel','touchmove','mousedown','keydown'].forEach(e => window.addEventListener(e, stopAutoScroll, { passive: true }));

    /* OPEN INTRO */
    const intro = document.getElementById('intro-overlay');
    const main = document.getElementById('main-content');
    const chapInd = document.getElementById('chapter-indicator');
    let opened = false;

    if(intro){
        intro.addEventListener('click', () => {
            if(loadProgress < 100 || opened) return;
            opened = true;

            if(!userInteractedMusic && bgMusic){
                bgMusic.play().then(() => {
                    if(musicBtn) musicBtn.classList.add('playing');
                    isPlaying = true;
                }).catch(()=>{});
            }

            intro.classList.add('open');
            setTimeout(() => main.classList.add('visible'), 300);

            setTimeout(() => {
                intro.style.display = 'none';
                document.body.classList.remove('locked');
                canvas.classList.add('active');
                chapInd.classList.add('visible');
                const inv = document.getElementById('inviteBox');
                if(inv) inv.classList.add('anim');

                animSparks();
                initReveal();
                document.querySelectorAll('.hero .split-text').forEach(m => m.classList.add('in'));
                setTimeout(smoothScrollToBottom, 1800);
            }, 1500);
        });
    }

    /* REVEAL OBSERVER */
    function initReveal(){
        const els = document.querySelectorAll('.reveal, .reveal-scale, .reveal-left, .split-text, .img-wipe');
        const obs = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if(e.isIntersecting){
                    e.target.classList.add('in');
                    if(e.target.classList.contains('j-item')) e.target.classList.add('active');
                }
            });
        }, { threshold: 0.15 });
        els.forEach(el => obs.observe(el));
    }

    /* SCROLL EFFECTS */
    const progressBar = document.getElementById('scroll-progress-bar');
    const heroBg = document.getElementById('hero-bg');
    const heroText = document.getElementById('hero-text-layer');
    const galleryCol2 = document.getElementById('gallery-col-2');
    const journeyWrap = document.getElementById('journey-wrap');
    const jLineFill = document.getElementById('j-line-fill');
    const chapDots = document.querySelectorAll('.chap-dot');
    const sectionMap = ['sec-hero','sec-letter','sec-journey','sec-memories','sec-date','rsvp'];

    let ticking = false;
    window.addEventListener('scroll', () => {
        if(!ticking){
            requestAnimationFrame(() => {
                const st = window.scrollY;
                const dh = document.documentElement.scrollHeight - window.innerHeight;
                progressBar.style.width = (st/dh)*100 + '%';

                if(st < window.innerHeight){
                    if(heroBg) heroBg.style.transform = `scale(${1 + st*0.0003}) translateY(${st*0.35}px)`;
                    if(heroText) heroText.style.transform = `translateY(${st*0.18}px)`;
                    if(heroText) heroText.style.opacity = Math.max(0, 1 - st/window.innerHeight*1.2);
                }

                if(journeyWrap && jLineFill){
                    const r = journeyWrap.getBoundingClientRect();
                    if(r.top < window.innerHeight && r.bottom > 0){
                        const sc = window.innerHeight - r.top - 100;
                        let p = (sc/r.height)*100;
                        p = Math.max(0, Math.min(100, p));
                        jLineFill.style.height = p + '%';
                    }
                }

                if(galleryCol2 && window.matchMedia("(min-width: 768px)").matches){
                    const r = galleryCol2.parentElement.getBoundingClientRect();
                    if(r.top < window.innerHeight && r.bottom > 0){
                        galleryCol2.style.transform = `translateY(-${(window.innerHeight - r.top)*0.12}px)`;
                    }
                }

                /* Chapter active */
                let activeIdx = 0;
                sectionMap.forEach((id, i) => {
                    const s = document.getElementById(id);
                    if(s && s.getBoundingClientRect().top < window.innerHeight*0.5) activeIdx = i;
                });
                chapDots.forEach((d, i) => d.classList.toggle('active', i === activeIdx));

                ticking = false;
            });
            ticking = true;
        }
    }, { passive: true });

    /* CHAPTER NAV CLICK */
    chapDots.forEach(dot => {
        dot.addEventListener('click', () => {
            const target = document.getElementById(dot.dataset.target);
            if(target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    });

    /* LIGHTBOX */
    const lightbox = document.getElementById('lightbox');
    const lbImg = document.getElementById('lightbox-img');
    document.querySelectorAll('.zoomable').forEach(img => {
        img.addEventListener('click', () => {
            lbImg.src = img.src;
            lightbox.classList.add('active');
            document.body.classList.add('hovering');
        });
    });
    if(lightbox) lightbox.addEventListener('click', () => {
        lightbox.classList.remove('active');
        document.body.classList.remove('hovering');
    });
})();
</script>
</body>
</html>