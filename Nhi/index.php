<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>Lễ Tốt Nghiệp - Trần Thị Tố Nhi</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,400&family=Pinyon+Script&family=Montserrat:wght@300;400;500;700;900&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box}
::-webkit-scrollbar{display:none}
html{-ms-overflow-style:none;scrollbar-width:none;scroll-behavior:smooth;-webkit-overflow-scrolling:touch}

:root{
  --gold:#c9a96e;
  --gold-light:#e8d5a3;
  --gold-dark:#8a6535;
  --cream:#f9f6f0;
  --dark:#1a1410;
  --charcoal:#2c2416;
  --text:#3d3020;
  --text-light:#7a6a50;
  --serif:'Cormorant Garamond',serif;
  --sans:'Montserrat',sans-serif;
  --script:'Pinyon Script',cursive;
}

body{
  background:#111;
  font-family:var(--serif);
  display:flex;
  justify-content:center;
  -webkit-font-smoothing:antialiased;
  overflow-x:hidden;
}
body.locked{overflow:hidden}

.wrapper{
  max-width:430px;
  width:100%;
  background:var(--cream);
  position:relative;
  overflow-x:hidden;
  min-height:100vh;
}

/* ========= PARTICLE CANVAS ========= */
#particles-canvas{
  position:fixed;
  top:0;left:50%;
  transform:translateX(-50%);
  width:430px;
  height:100vh;
  pointer-events:none;
  z-index:0;
  opacity:0;
  transition:opacity 1s ease;
}
#particles-canvas.active{opacity:1}

/* ========= INTRO OVERLAY ========= */
#intro-overlay{
  position:fixed;
  top:0;left:50%;
  transform:translateX(-50%);
  width:100%;max-width:430px;
  height:100vh;
  z-index:99999;
  cursor:pointer;
  overflow:hidden;
  display:flex;
  justify-content:center;
}

.intro-half{
  position:absolute;
  left:0;width:100%;
  /* Đã chỉnh hiệu ứng mở êm và mượt hơn */
  transition:transform 1.4s ease-in-out;
  will-change:transform;
}
.intro-top{
  top:0;height:52%;
  background:linear-gradient(160deg,#1a1208 0%,#2e1f08 60%,#1a1208 100%);
  clip-path:polygon(0 0,100% 0,100% 88%,50% 100%,0 88%);
  display:flex;flex-direction:column;
  align-items:center;justify-content:center;
  overflow:hidden;
  padding-bottom: 25px; /* Đẩy chữ lên để không bị cắt bởi góc nhọn */
}
.intro-bottom{
  bottom:0;top:auto;height:52%;
  background:linear-gradient(200deg,#c9a96e 0%,#e8d5a3 40%,#c9a96e 100%);
  clip-path:polygon(0 12%,50% 0,100% 12%,100% 100%,0 100%);
  display:flex;align-items:flex-end;justify-content:space-between;
  padding:0 28px 45px; /* Tăng padding dưới để an toàn trên mọi màn hình */
}

#intro-overlay.open .intro-top{transform:translateY(-100%)}
#intro-overlay.open .intro-bottom{transform:translateY(100%)}
#intro-overlay.open .tassel-wrap{transform:translate(-50%,-130vh)}

/* SCHOOL INFO */
.intro-school-info{color:#c9a96e;font-family:var(--sans);text-align:left;}
.intro-school-info .label{font-size:.65rem;font-weight:700;letter-spacing:3px;text-transform:uppercase;opacity:.8; white-space:nowrap;}
.intro-school-info .name{font-size:0.85rem;font-weight:800;line-height:1.3;margin-top:4px; white-space:nowrap;} /* Ép 1 dòng */
.intro-date-info{color:#1a1208;font-family:var(--sans);text-align:right;}
.intro-date-info .day{font-size:2.8rem;font-weight:900;line-height:1;letter-spacing:1px; white-space:nowrap;}
.intro-date-info .year{font-size:1.6rem;font-weight:300;opacity:.8; white-space:nowrap;}

/* GRADUATION CAP */
.cap-wrap{position:relative;display:flex;flex-direction:column;align-items:center;margin-bottom:10px}
.cap-board{
  width:110px;height:12px;
  background:linear-gradient(90deg,#8a6535,#e8d5a3,#8a6535);
  border-radius:2px;
  position:relative;
}
.cap-board::after{
  content:'';position:absolute;
  top:-30px;left:50%;transform:translateX(-50%);
  width:0;height:0;
  border-left:55px solid transparent;
  border-right:55px solid transparent;
  border-bottom:30px solid #e8d5a3;
}
.cap-top{
  position:absolute;top:-38px;left:50%;transform:translateX(-50%);
  width:16px;height:16px;
  background:#c9a96e;
  border-radius:50%;
  box-shadow:0 0 15px rgba(201,169,110,.8);
}

.cap-title{
  font-family:var(--sans);
  font-size:clamp(1rem,4vw,1.5rem);
  font-weight:900;
  letter-spacing:5px; /* Giảm spacing nhẹ để an toàn */
  color:#fff;
  text-shadow:0 0 30px rgba(201,169,110,.6);
  margin-bottom:6px;
  text-transform:uppercase;
  white-space:nowrap; /* Ép 1 dòng */
}
.cap-sub{
  font-family:var(--script);
  font-size:1.8rem;
  color:var(--gold-light);
  opacity:.9;
}

/* TASSEL */
.tassel-wrap{
  position:absolute;
  top:48%;left:50%;
  transform:translate(-50%,0);
  display:flex;flex-direction:column;align-items:center;
  z-index:5;
  transition:transform 1.4s ease-in-out;
  will-change:transform;
  animation:tasselSwing 2s ease-in-out infinite;
}
@keyframes tasselSwing{
  0%,100%{transform:translate(-50%,0) rotate(-3deg)}
  50%{transform:translate(-50%,0) rotate(3deg)}
}
#intro-overlay.open .tassel-wrap{animation:none}

.tassel-string{width:3px;height:90px;background:linear-gradient(180deg,#d4af37,#8a6535);border-radius:2px}
.tassel-knot{width:12px;height:12px;background:radial-gradient(circle,#ffd700,#b8860b);border-radius:50%;border:1.5px solid #ffd700;box-shadow:0 0 10px rgba(255,215,0,.5)}
.tassel-fringe{
  width:18px;height:55px;
  background:repeating-linear-gradient(90deg,#d4af37,#d4af37 2px,#b8860b 2px,#b8860b 4px);
  border-radius:0 0 4px 4px;
}

.click-hint{
  position:absolute;bottom:25px;left:50%;transform:translateX(-50%);
  z-index:6;font-family:var(--sans);font-size:.65rem;color:#fff;
  text-transform:uppercase;letter-spacing:3px;
  animation:pulseHint 2s ease-in-out infinite; /* Mượt hơn */
  white-space:nowrap;
}
@keyframes pulseHint{0%,100%{opacity:.4}50%{opacity:1}}

/* SHIMMER ON INTRO */
.intro-shimmer{
  position:absolute;
  top:-50%;left:-100%;width:60%;height:200%;
  background:linear-gradient(105deg,transparent 40%,rgba(255,255,255,.12) 50%,transparent 60%);
  animation:shimmerMove 3s ease-in-out infinite;
  pointer-events:none;
}
@keyframes shimmerMove{0%{left:-100%}100%{left:150%}}

/* ========= MAIN CONTENT ========= */
#main-content{opacity:0;transition:opacity 1.5s ease}
#main-content.visible{opacity:1}

/* HERO */
.hero{
  height:100vh;
  position:relative;
  background-image:url('uploads/hero_default.jpg');
  background-size:cover;
  background-position:center;
  display:flex;flex-direction:column;
  justify-content:center;align-items:center;
  text-align:center;
  overflow:hidden;
}
.hero::before{
  content:'';position:absolute;inset:0;
  background:linear-gradient(180deg,rgba(0,0,0,.05) 0%,rgba(10,5,0,.85) 100%);
  z-index:1;
}

/* FLOATING BOKEH */
.bokeh-wrap{position:absolute;inset:0;z-index:0;pointer-events:none;overflow:hidden}
.bokeh{
  position:absolute;
  border-radius:50%;
  background:radial-gradient(circle,rgba(201,169,110,.35) 0%,transparent 70%);
  animation:bokehFloat linear infinite;
  filter:blur(4px);
}
@keyframes bokehFloat{
  0%{transform:translateY(100vh) scale(0.8);opacity:0}
  10%{opacity:1}
  90%{opacity:.8}
  100%{transform:translateY(-20vh) scale(1.2);opacity:0}
}

.hero-content{position:relative;z-index:2;color:#fff;padding:0 20px;width:100%;top:8%}
.hero-badge{
  font-family:var(--sans);font-size:.6rem;letter-spacing:5px;
  text-transform:uppercase;color:var(--gold-light);
  margin-bottom:20px;opacity:.9;
  display:flex;align-items:center;justify-content:center;gap:12px;
}
.hero-badge::before,.hero-badge::after{
  content:'';width:40px;height:.5px;background:var(--gold);display:block;
}
.hero h1{
  font-family:var(--script);
  font-size:clamp(2.5rem,8vw,3.5rem); /* Đã giảm size để không tràn màn hình */
  font-weight:normal;
  line-height:1.2;
  text-shadow:0 2px 30px rgba(0,0,0,.5);
  margin:10px 0;
  animation:heroNameReveal 1.5s ease forwards;
  opacity:0;
  animation-delay:.3s;
  white-space: nowrap; /* Khóa dòng */
}
@keyframes heroNameReveal{
  0%{opacity:0;transform:translateY(20px)}
  100%{opacity:1;transform:translateY(0)}
}
.hero-date{
  font-family:var(--sans);font-size:.8rem;
  letter-spacing:4px;font-weight:300;
  margin:15px 0 25px;opacity:.85;
  color:var(--gold-light);
}
.hero-line{
  width:60px;height:1px;
  background:linear-gradient(90deg,transparent,var(--gold),transparent);
  margin:15px auto;
}

.invite-box{
  margin-top:25px;
  padding:18px 32px;
  background:rgba(0,0,0,.45);
  border:1px solid rgba(201,169,110,.3);
  border-radius:16px;
  backdrop-filter:blur(8px);
  display:inline-block;
  max-width:90%;
  animation:fadeInUp .8s ease forwards;
  animation-delay:.8s;
  opacity:0;
  box-shadow:0 8px 32px rgba(0,0,0,.3),inset 0 0 30px rgba(201,169,110,.05);
}
.invite-label{font-family:var(--sans);font-size:.65rem;text-transform:uppercase;letter-spacing:4px;color:#bbb;margin-bottom:8px}
.invite-name{
  font-family:var(--script);
  font-size:clamp(2rem,7vw,2.8rem);
  color:var(--gold);
  line-height:1.1;
  text-shadow:0 0 20px rgba(201,169,110,.4);
  white-space: nowrap;
}

@keyframes fadeInUp{
  0%{opacity:0;transform:translateY(15px)}
  100%{opacity:1;transform:translateY(0)}
}

/* DECORATIVE DIVIDER */
.divider{
  display:flex;align-items:center;gap:12px;
  padding:0 30px;margin:10px 0;
}
.divider-line{flex:1;height:.5px;background:linear-gradient(90deg,transparent,var(--gold),transparent)}
.divider-icon{color:var(--gold);font-size:14px;opacity:.7}

/* SECTION BASE */
.section{padding:55px 28px;text-align:center;position:relative;z-index:1}

/* QUOTE */
.quote-box{
  font-size:clamp(1rem,6vw,1.4rem);font-style:italic;
  color:var(--text-light);line-height:1.9;
  position:relative;padding:clamp(20px,5vw,40px) clamp(15px,8vw,35px);
  max-width:90%;margin:0 auto;
}
.quote-mark{
  font-family:var(--script);font-size:5rem;
  color:var(--gold);opacity:.2;
  position:absolute;line-height:1;
}
.quote-mark.open{top:-10px;left:0}
.quote-mark.close{bottom:-30px;right:0;transform:rotate(180deg)}

/* TYPOGRAPHY */
.title-sm{
  font-family:var(--sans);font-size:.65rem;
  text-transform:uppercase;letter-spacing:4px;
  color:var(--gold);margin-bottom:8px;
}
.title-script{
  font-family:var(--script);
  font-size:clamp(2.5rem,10vw,3.5rem);
  color:var(--text);line-height:1.2;margin:5px 0 20px;
  font-weight:normal;
}
.title-script-lg{
  font-family:var(--script);
  font-size:clamp(2.5rem,8vw,3.5rem); /* Đã giảm size */
  color:var(--text);line-height:1.2;margin:5px 0 20px;
  font-weight:normal;
  white-space: nowrap; /* Khóa dòng */
}

/* PHOTO ROW */
.photo-row{display:flex;gap:5px;margin:25px 0 35px}
.photo-row img{flex:1;width:33.33%;aspect-ratio:3/4;object-fit:cover;border-radius:3px;transition:transform .4s ease}
.photo-row img:hover{transform:scale(1.02)}

.text-desc{
  font-family:var(--sans);font-size:.82rem;
  line-height:1.9;color:var(--text-light);
  text-align:justify;font-weight:300;
}

/* GOLD BAND SECTION */
.gold-band{
  background:linear-gradient(135deg,var(--dark) 0%,var(--charcoal) 50%,var(--dark) 100%);
  padding:50px 28px;text-align:center;
  position:relative;overflow:hidden;
}
.gold-band::before,.gold-band::after{
  content:'';position:absolute;
  left:0;right:0;height:1px;
  background:linear-gradient(90deg,transparent,var(--gold),transparent);
}
.gold-band::before{top:0}
.gold-band::after{bottom:0}

/* CALENDAR */
.cal-wrap{background:var(--cream);padding:50px 25px;text-align:center}
.cal-table{width:100%;border-collapse:collapse;font-family:var(--sans);font-size:.78rem;font-weight:400;color:#555;margin-bottom:25px}
.cal-table th{padding:12px 0;color:#999;font-weight:600;font-size:.65rem;letter-spacing:2px;text-transform:uppercase}
.cal-table td{padding:10px 0;text-align:center;color:#888}
.cal-table td.empty{color:#ccc}
.day-active{
  display:inline-flex;justify-content:center;align-items:center;
  width:32px;height:32px;
  background:linear-gradient(135deg,var(--gold),var(--gold-dark));
  color:#fff;border-radius:50%;
  box-shadow:0 4px 15px rgba(201,169,110,.5);
  font-weight:600;font-size:.85rem;
  animation:pulseDot 2s ease-in-out infinite;
}
@keyframes pulseDot{
  0%,100%{box-shadow:0 4px 15px rgba(201,169,110,.5)}
  50%{box-shadow:0 4px 25px rgba(201,169,110,.8),0 0 0 6px rgba(201,169,110,.15)}
}

/* DATE BLOCK */
.date-block{
  display:flex;justify-content:center;align-items:center;
  padding:30px 0;margin:30px 0;gap:30px;
  border-top:.5px solid rgba(201,169,110,.3);
  border-bottom:.5px solid rgba(201,169,110,.3);
  position:relative;
}
.d-item{text-align:center;font-family:var(--sans)}
.d-item span{display:block;font-size:.6rem;color:#aaa;letter-spacing:3px;margin-bottom:10px;text-transform:uppercase}
.d-item strong{font-size:1.5rem;font-weight:300;color:var(--text)}
.d-item.main strong{font-size:3.5rem;font-weight:200;color:var(--gold);line-height:1}
.date-dot{width:4px;height:4px;background:var(--gold);border-radius:50%;opacity:.5}

/* LOCATION */
.location-card{
  background:#fff;
  border:.5px solid rgba(201,169,110,.2);
  border-radius:16px;
  padding:22px;
  text-align:left;
  box-shadow:0 8px 30px rgba(0,0,0,.06);
  margin:20px 0;
}
.loc-name{font-family:var(--sans);font-size:.85rem;font-weight:600;color:var(--text);margin-bottom:5px}
.loc-addr{font-family:var(--sans);font-size:.75rem;color:var(--text-light);margin-bottom:15px}
.map-container{border-radius:10px;overflow:hidden;border:.5px solid rgba(201,169,110,.2)}

/* BTN */
.btn{
  display:inline-block;padding:13px 28px;
  border:.5px solid var(--gold);
  color:var(--gold);
  text-decoration:none;
  font-family:var(--sans);font-size:.65rem;
  text-transform:uppercase;letter-spacing:2px;
  transition:all .3s ease;
  background:transparent;
  cursor:pointer;border-radius:50px;
  margin-top:18px;
  position:relative;overflow:hidden;
}
.btn::before{
  content:'';position:absolute;
  top:0;left:-100%;width:100%;height:100%;
  background:linear-gradient(90deg,transparent,rgba(201,169,110,.15),transparent);
  transition:left .5s ease;
}
.btn:hover{background:var(--gold);color:#fff;border-color:var(--gold)}
.btn:hover::before{left:100%}

/* TIMELINE */
.timeline{
  text-align:left;padding-left:20px;
  border-left:1px solid rgba(201,169,110,.3);
  margin-top:30px;margin-left:15px;
}
.t-item{position:relative;padding-bottom:35px;padding-left:25px}
.t-item:last-child{padding-bottom:0}
.t-item::before{
  content:'';position:absolute;left:-6px;top:3px;
  width:11px;height:11px;
  background:linear-gradient(135deg,var(--gold),var(--gold-dark));
  border-radius:50%;
  box-shadow:0 0 0 3px var(--cream),0 0 10px rgba(201,169,110,.4);
}
.t-time{font-family:var(--sans);font-weight:600;font-size:.9rem;margin-bottom:6px;color:var(--gold)}
.t-desc{font-family:var(--serif);font-size:1.1rem;color:var(--text-light)}

/* ALBUM GRID */
.album-grid{display:grid;grid-template-columns:1fr 1fr;gap:6px;padding:0 18px 20px}
.album-item{position:relative;aspect-ratio:1;overflow:hidden;border-radius:8px}
.album-item img{width:100%;height:100%;object-fit:cover;transition:transform .6s ease}
.album-item:hover img{transform:scale(1.07)}
.album-item::after{
  content:'';position:absolute;inset:0;
  background:linear-gradient(135deg,rgba(201,169,110,.1),transparent);
  pointer-events:none;
}
.album-text{
  background:#fff;display:flex;align-items:center;
  justify-content:center;padding:22px 18px;
  text-align:center;font-family:var(--sans);
  font-size:.75rem;line-height:1.7;color:var(--text-light);
  border-radius:8px;border:.5px solid rgba(201,169,110,.15);
}

/* RSVP */
/* Đã thêm text-align center để cân giữa toàn bộ nội dung khối RSVP */
.rsvp-wrap{background:#fff;padding:55px 28px;border-top:.5px solid rgba(201,169,110,.2); text-align: center;}
.form-control{
  width:100%;padding:15px 18px;margin-bottom:14px;
  border:.5px solid rgba(201,169,110,.3);background:#faf8f5;
  font-family:var(--sans);font-size:.82rem;
  box-sizing:border-box;outline:none;border-radius:10px;
  transition:border-color .3s,box-shadow .3s;color:var(--text);
}
.form-control:focus{border-color:var(--gold);box-shadow:0 0 0 3px rgba(201,169,110,.1)}
textarea.form-control{resize:vertical;min-height:90px}
.btn-submit{
  width:100%;padding:16px;
  background:linear-gradient(135deg,var(--gold),var(--gold-dark));
  color:#fff;border:none;
  font-family:var(--sans);font-size:.75rem;
  letter-spacing:2px;text-transform:uppercase;
  border-radius:50px;cursor:pointer;
  transition:all .3s;
  box-shadow:0 6px 20px rgba(201,169,110,.3);
}
.btn-submit:hover{transform:translateY(-2px);box-shadow:0 10px 25px rgba(201,169,110,.4)}
.btn-submit:active{transform:translateY(0)}

/* COUNTDOWN */
.countdown{display:flex;justify-content:center;gap:8px;font-family:var(--sans);margin:30px 0;align-items:center}
.cd-item{text-align:center;min-width:55px}
.cd-num{
  font-size:2.2rem;font-weight:200;color:var(--text);
  line-height:1;
  background:linear-gradient(135deg,var(--gold-dark),var(--gold));
  -webkit-background-clip:text;-webkit-text-fill-color:transparent;
  background-clip:text;
}
.cd-label{font-size:.6rem;color:#aaa;text-transform:uppercase;letter-spacing:2px;margin-top:6px}
.cd-sep{font-size:1.8rem;color:var(--gold);opacity:.4;font-weight:200;align-self:flex-start;padding-top:5px}

/* THANK YOU */
.thank-section{
  padding:60px 28px;text-align:center;
  background:linear-gradient(180deg,var(--cream),#fff);
}
.thank-you{
  font-family:var(--script);
  font-size:clamp(2.8rem,10vw,3rem);
  color:var(--text);line-height:1;
  margin:40px 0 20px;
}
.footer-name{
  font-family:var(--script);
  font-size:clamp(2rem,7vw,2.8rem);
  color:var(--gold);
}
.footer-line{width:80px;height:.5px;background:linear-gradient(90deg,transparent,var(--gold),transparent);margin:20px auto}

/* SCROLL TOP BTN */
#scrollTopBtn{
  position:fixed;bottom:28px;right:18px;z-index:9999;
  width:44px;height:44px;border-radius:50%;
  background:rgba(201,169,110,.9);
  color:#fff;border:1.5px solid rgba(255,255,255,.5);
  font-size:1.1rem;cursor:pointer;
  display:flex;align-items:center;justify-content:center;
  box-shadow:0 6px 20px rgba(0,0,0,.25);
  transition:all .4s ease;
  opacity:0;visibility:hidden;transform:translateY(20px) scale(.8);
}
#scrollTopBtn.show{opacity:1;visibility:visible;transform:translateY(0) scale(1)}
#scrollTopBtn:hover{background:var(--charcoal);transform:scale(1.1)}

/* REVEAL ANIMATIONS */
.reveal{opacity:0;transform:translateY(30px);transition:opacity .8s ease,transform .8s ease}
.reveal.in{opacity:1;transform:translateY(0)}
.reveal-left{opacity:0;transform:translateX(-30px);transition:opacity .8s ease,transform .8s ease}
.reveal-left.in{opacity:1;transform:translateX(0)}
.reveal-scale{opacity:0;transform:scale(.9);transition:opacity .8s ease,transform .8s ease}
.reveal-scale.in{opacity:1;transform:scale(1)}

/* STAGGER */
.stagger .t-item{opacity:0;transform:translateX(-20px);transition:opacity .6s ease,transform .6s ease}
.stagger .t-item.in{opacity:1;transform:translateX(0)}
</style>
</head>
<body class="locked">

<canvas id="particles-canvas"></canvas>

<div id="intro-overlay" class="intro-half">
  <div class="intro-top intro-half">
    <div class="intro-shimmer"></div>
    <div class="cap-wrap" style="margin-bottom:20px">
      <div class="cap-top"></div>
      <div class="cap-board"></div>
    </div>
    <div class="cap-title">Graduation</div>
    <div class="cap-sub">2026</div>
  </div>
  <div class="intro-bottom intro-half">
    <div class="intro-school-info">
      <div class="label">Trường Đại học</div>
      <div class="name">Nguyễn Tất Thành</div>
    </div>
    <div class="intro-date-info">
      <div class="day">22/04</div>
      <div class="year">2026</div>
    </div>
  </div>
  <div class="tassel-wrap">
    <div class="tassel-string"></div>
    <div class="tassel-knot"></div>
    <div class="tassel-fringe"></div>
  </div>
  <div class="click-hint">✦ Chạm để mở thiệp ✦</div>
</div>

<div class="wrapper" id="main-content">

  <div class="hero">
    <div class="bokeh-wrap" id="bokehWrap"></div>
    <div class="hero-content">
      <div class="hero-badge">Lễ Tốt Nghiệp</div>
      <h1>Trần Thị Tố Nhi</h1>
      <div class="hero-line"></div>
      <div class="hero-date">22 · 04 · 2026</div>
      <div class="invite-box" id="inviteBox" style="display:none">
        <p class="invite-label">Kính mời</p>
        <p class="invite-name" id="guestNameDisplay"></p>
      </div>
    </div>
  </div>

  <div class="section reveal">
    <div class="quote-box">
      <span class="quote-mark open">"</span>
      Mong những lời chúc phúc của bạn ngày chia tay là chiếc ô che nắng, che mưa cho tôi vượt mọi chông gai đời người.
      <span class="quote-mark close">"</span>
    </div>
  </div>

  <div class="divider reveal"><div class="divider-line"></div><div class="divider-icon">✦</div><div class="divider-line"></div></div>

  <div class="section reveal" style="padding-top:30px">
    <div class="title-sm">Tân Cử Nhân</div>
    <div class="title-script-lg">Trần Thị Tố Nhi</div>
    <div class="photo-row">
      <img src="uploads/avatar_default.jpg" loading="lazy" alt="Ảnh 1">
      <img src="uploads/hero_default.jpg" loading="lazy" alt="Ảnh 2">
      <img src="uploads/avatar_default.jpg" loading="lazy" alt="Ảnh 3">
    </div>
    <p class="text-desc">Tốt nghiệp là dấu mốc kết thúc một hành trình và mở ra một chặng đường mới. Tôi biết phía trước sẽ không dễ dàng, nhưng tôi tin vào bản thân, vào những gì mình đã học được. Cảm ơn thanh xuân vì đã rực rỡ đến thế! 🎓✨</p>
  </div>

  <div class="divider reveal"><div class="divider-line"></div><div class="divider-icon">✦</div><div class="divider-line"></div></div>

  <div class="gold-band">
    <div class="reveal" id="dynamicInviteHeader" style="display:none">
      <div class="title-sm" style="color:var(--gold-light)">Thân mời</div>
      <div style="font-family:var(--script);font-size:clamp(2.2rem,8vw,3.2rem);color:var(--gold-light);line-height:1.2;margin:10px 0;white-space:nowrap;" id="guestNameText"></div>
      <div class="title-sm" style="color:var(--gold-light)">Đến dự lễ tốt nghiệp</div>
    </div>
    <div class="reveal" id="defaultInviteHeader">
      <div class="title-sm" style="color:var(--gold-light)">Thân mời</div>
      <div class="title-script" style="color:var(--gold-light)">Bạn bè & Gia đình</div>
      <div class="title-sm" style="color:var(--gold-light)">Đến dự lễ tốt nghiệp</div>
    </div>
  </div>

  <div class="cal-wrap">
    <div class="reveal">
      <div class="title-sm">Thời Gian</div>
      <div class="title-script">Tháng 04 · 2026</div>
    </div>
    <table class="cal-table reveal">
      <tr><th>T2</th><th>T3</th><th>T4</th><th>T5</th><th>T6</th><th>T7</th><th>CN</th></tr>
      <tr><td class="empty">30</td><td class="empty">31</td><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td></tr>
      <tr><td>6</td><td>7</td><td>8</td><td>9</td><td>10</td><td>11</td><td>12</td></tr>
      <tr><td>13</td><td>14</td><td>15</td><td>16</td><td>17</td><td>18</td><td>19</td></tr>
      <tr><td>20</td><td>21</td><td><span class="day-active">22</span></td><td>23</td><td>24</td><td>25</td><td>26</td></tr>
      <tr><td>27</td><td>28</td><td>29</td><td>30</td><td class="empty">1</td><td class="empty">2</td><td class="empty">3</td></tr>
    </table>

    <div class="date-block reveal-scale">
      <div class="d-item"><span>Tháng</span><strong>04</strong></div>
      <div class="date-dot"></div>
      <div class="d-item main"><span>Thứ Tư</span><strong>22</strong></div>
      <div class="date-dot"></div>
      <div class="d-item"><span>Năm</span><strong>2026</strong></div>
    </div>

    <div class="title-sm" style="color:var(--charcoal);font-weight:700;margin:10px 0">Lễ Tốt Nghiệp Lúc 07:30 Sáng</div>

    <div class="location-card reveal">
      <div class="loc-name">Trường Đại học Nguyễn Tất Thành</div>
      <div class="loc-addr">📍 300A Nguyễn Tất Thành, Quận 4, TP.HCM</div>
      <div class="map-container">
        <iframe width="100%" height="180" frameborder="0" scrolling="no" loading="lazy"
          src="https://maps.google.com/maps?q=10.762622,106.660172&hl=vi&z=15&output=embed"></iframe>
      </div>
    </div>
    <a href="https://www.google.com/maps/dir/?api=1&destination=10.762622,106.660172" target="_blank" class="btn">✦ Chỉ Đường</a>
  </div>

  <div class="section" style="background:#fff">
    <div class="reveal">
      <div class="title-sm">Chương Trình</div>
      <div class="title-script">Sự Kiện</div>
    </div>
    <div class="timeline stagger" id="timeline">
      <div class="t-item"><div class="t-time">07:30</div><div class="t-desc">Đón khách & Ổn định chỗ ngồi</div></div>
      <div class="t-item"><div class="t-time">08:00</div><div class="t-desc">Bắt đầu Lễ Trao Bằng Tốt Nghiệp</div></div>
      <div class="t-item"><div class="t-time">10:30</div><div class="t-desc">Chụp ảnh lưu niệm & Chung vui</div></div>
    </div>
  </div>

  <div class="section reveal" style="padding-bottom:20px">
    <div class="title-sm">Kỷ Niệm</div>
    <div class="title-script">Album Tốt Nghiệp</div>
  </div>
  <div class="album-grid reveal">
    <div class="album-item"><img src="uploads/avatar_default.jpg" loading="lazy" alt="Album 1"></div>
    <div class="album-text">Cánh cửa đại học khép lại, mở ra vô vàn cơ hội mới.</div>
    <div class="album-text">Có những khoảnh khắc trôi qua rồi mới biết thế nào là vô giá.</div>
    <div class="album-item"><img src="uploads/hero_default.jpg" loading="lazy" alt="Album 2"></div>
  </div>

  <div class="rsvp-wrap" id="rsvp">
    <div class="reveal">
      <div class="title-sm">Gửi Lời Yêu Thương</div>
      <div class="title-script">Sổ Lưu Bút</div>
      <p class="text-desc" style="text-align:center;margin-bottom:28px">Sự hiện diện của bạn là niềm vinh hạnh cho buổi lễ tốt nghiệp của mình.</p>
    </div>
    <div class="reveal">
      <input type="text" id="rsvpNameInput" class="form-control" placeholder="Tên của bạn">
      <textarea class="form-control" placeholder="Gửi lời chúc mừng đến Nhi..."></textarea>
      <select class="form-control">
        <option value="den">✓ Mình chắc chắn sẽ đến</option>
        <option value="khong">✗ Xin lỗi mình bận rồi!</option>
      </select>
      <button class="btn-submit" onclick="alert('Cảm ơn bạn đã gửi lời chúc! 🎓')">Gửi Lời Nhắn ✦</button>
    </div>
  </div>

  <div class="thank-section">
    <div class="reveal">
      <div class="title-sm">Đếm Ngược</div>
      <div class="title-script">Thời Gian</div>
    </div>
    <div class="countdown reveal-scale" id="countdown">
      <div class="cd-item"><div class="cd-num" id="days">00</div><div class="cd-label">Ngày</div></div>
      <div class="cd-sep">:</div>
      <div class="cd-item"><div class="cd-num" id="hours">00</div><div class="cd-label">Giờ</div></div>
      <div class="cd-sep">:</div>
      <div class="cd-item"><div class="cd-num" id="minutes">00</div><div class="cd-label">Phút</div></div>
      <div class="cd-sep">:</div>
      <div class="cd-item"><div class="cd-num" id="seconds">00</div><div class="cd-label">Giây</div></div>
    </div>

    <div class="footer-line"></div>
    <div class="thank-you reveal">Trân trọng cảm ơn</div>
    <div class="footer-name reveal">Trần Thị Tố Nhi</div>
    <div class="footer-line"></div>
    <p style="font-family:var(--sans);font-size:.65rem;color:#bbb;letter-spacing:3px;margin-top:20px;text-transform:uppercase">22 · 04 · 2026</p>
  </div>

</div>

<button id="scrollTopBtn" title="Lên đầu trang">↑</button>

<script>
(function(){
  /* ---- URL PARAMS ---- */
  const urlParams=new URLSearchParams(window.location.search);
  const guestName=urlParams.get('to');
  if(guestName&&guestName.trim()){
    document.getElementById('inviteBox').style.display='inline-block';
    document.getElementById('guestNameDisplay').innerText=guestName;
    document.getElementById('defaultInviteHeader').style.display='none';
    document.getElementById('dynamicInviteHeader').style.display='block';
    document.getElementById('guestNameText').innerText=guestName;
    document.getElementById('rsvpNameInput').value=guestName;
  }

  /* ---- BOKEH ---- */
  const bw=document.getElementById('bokehWrap');
  for(let i=0;i<12;i++){
    const b=document.createElement('div');
    b.className='bokeh';
    const sz=20+Math.random()*60;
    b.style.cssText=`width:${sz}px;height:${sz}px;left:${Math.random()*100}%;bottom:-${sz}px;animation-duration:${6+Math.random()*8}s;animation-delay:${Math.random()*6}s;`;
    bw.appendChild(b);
  }

  /* ---- PARTICLES ---- */
  const canvas=document.getElementById('particles-canvas');
  const ctx=canvas.getContext('2d');
  canvas.width=430;canvas.height=window.innerHeight;
  const particles=[];
  for(let i=0;i<40;i++){
    particles.push({
      x:Math.random()*430,y:Math.random()*canvas.height,
      r:Math.random()*2+.5,
      vx:(Math.random()-.5)*.4,vy:-(Math.random()*.5+.2),
      alpha:Math.random()*.6+.2,
      color:`hsl(${38+Math.random()*10},70%,${60+Math.random()*20}%)`
    });
  }
  let raf;
  function animParticles(){
    ctx.clearRect(0,0,canvas.width,canvas.height);
    particles.forEach(p=>{
      ctx.beginPath();
      ctx.arc(p.x,p.y,p.r,0,Math.PI*2);
      ctx.fillStyle=p.color;
      ctx.globalAlpha=p.alpha;
      ctx.fill();
      p.x+=p.vx;p.y+=p.vy;
      if(p.y<-10){p.y=canvas.height+10;p.x=Math.random()*430;}
      if(p.x<0||p.x>430){p.vx*=-1;}
    });
    ctx.globalAlpha=1;
    raf=requestAnimationFrame(animParticles);
  }

  /* ---- INTRO ---- */
  const intro=document.getElementById('intro-overlay');
  const main=document.getElementById('main-content');
  let opened=false;
  intro.addEventListener('click',function(){
    if(opened)return;opened=true;
    intro.classList.add('open');
    setTimeout(()=>{main.classList.add('visible');},400);
    setTimeout(()=>{
      intro.style.display='none';
      document.body.classList.remove('locked');
      canvas.classList.add('active');
      animParticles();
      initReveal();
      initTimeline();
      startScroll();
    },1600);
  });

  /* ---- SMOOTH AUTO SCROLL ---- */
  let scrollPos=0,scrolling=false,scrollRAF;
  function startScroll(){
    scrollPos=window.scrollY;
    scrolling=true;
    function step(){
      if(!scrolling)return;
      scrollPos+=1.2;
      window.scrollTo(0,scrollPos);
      if((window.innerHeight+scrollPos)>=document.documentElement.scrollHeight-5){scrolling=false;return;}
      scrollRAF=requestAnimationFrame(step);
    }
    scrollRAF=requestAnimationFrame(step);
  }
  function stopScroll(){
    if(scrolling){scrolling=false;cancelAnimationFrame(scrollRAF);}
  }
  ['touchstart','touchmove','wheel','mousedown'].forEach(e=>window.addEventListener(e,stopScroll,{passive:true}));

  /* ---- INTERSECTION OBSERVER ---- */
  function initReveal(){
    const revEls=document.querySelectorAll('.reveal,.reveal-left,.reveal-scale');
    const obs=new IntersectionObserver(entries=>{
      entries.forEach(e=>{if(e.isIntersecting){e.target.classList.add('in');}});
    },{threshold:.12});
    revEls.forEach(el=>obs.observe(el));
  }

  function initTimeline(){
    const items=document.querySelectorAll('.stagger .t-item');
    const obs=new IntersectionObserver(entries=>{
      entries.forEach(e=>{
        if(e.isIntersecting){
          const idx=Array.from(items).indexOf(e.target);
          setTimeout(()=>e.target.classList.add('in'),idx*150);
        }
      });
    },{threshold:.1});
    items.forEach(el=>obs.observe(el));
  }

  /* ---- SCROLL TOP BTN ---- */
  const btn=document.getElementById('scrollTopBtn');
  window.addEventListener('scroll',()=>{
    const total=document.documentElement.scrollHeight-window.innerHeight;
    if(window.scrollY>total*.25)btn.classList.add('show');
    else btn.classList.remove('show');
  },{passive:true});
  btn.addEventListener('click',()=>{stopScroll();window.scrollTo({top:0,behavior:'smooth'});});

  /* ---- COUNTDOWN ---- */
  const target=new Date('2026-04-22T07:30:00').getTime();
  function updateCD(){
    const now=Date.now(),d=target-now;
    if(d<0){document.getElementById('countdown').innerHTML='<div style="font-family:var(--sans);font-size:1.1rem;color:var(--gold);font-weight:500;letter-spacing:2px">✦ Sự kiện đã diễn ra ✦</div>';return;}
    const pad=n=>String(n).padStart(2,'0');
    document.getElementById('days').innerText=pad(Math.floor(d/86400000));
    document.getElementById('hours').innerText=pad(Math.floor(d%86400000/3600000));
    document.getElementById('minutes').innerText=pad(Math.floor(d%3600000/60000));
    document.getElementById('seconds').innerText=pad(Math.floor(d%60000/1000));
  }
  updateCD();setInterval(updateCD,1000);
})();
</script>
</body>
</html>