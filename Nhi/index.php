<?php
require 'db.php';

// ================= CACHE DỮ LIỆU =================
$cacheFile = __DIR__ . '/cache/invitation_cache.php';
$cacheTTL = 3600; // 1 giờ

if (file_exists($cacheFile) && (time() - filemtime($cacheFile)) < $cacheTTL) {
    $cached = unserialize(file_get_contents($cacheFile));
    $info = $cached['info'];
    $timelines = $cached['timelines'];
} else {
    $info = $pdo->query("SELECT * FROM page_info LIMIT 1")->fetch(PDO::FETCH_ASSOC);
    $timelines = $pdo->query("SELECT * FROM timeline ORDER BY order_num ASC")->fetchAll(PDO::FETCH_ASSOC);
    if (!is_dir(__DIR__ . '/cache')) mkdir(__DIR__ . '/cache', 0755, true);
    file_put_contents($cacheFile, serialize(['info' => $info, 'timelines' => $timelines]));
}

$guest_name_invite = '';
if (isset($_GET['to']) && trim($_GET['to']) !== '') {
    $guest_name_invite = htmlspecialchars(trim($_GET['to']));
}

$success_msg = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_rsvp'])) {
    $guest_name = htmlspecialchars($_POST['guest_name']);
    $message = htmlspecialchars($_POST['message']);
    $attendance = $_POST['attendance'];

    $sql = "INSERT INTO rsvp_messages (guest_name, message, attendance_status) VALUES (?, ?, ?)";
    $pdo->prepare($sql)->execute([$guest_name, $message, $attendance]);
    $success_msg = "Cảm ơn bạn đã gửi lời nhắn!";
    
    // Xóa cache để lần sau lấy dữ liệu mới (nếu có thay đổi)
    if (file_exists($cacheFile)) unlink($cacheFile);
}

$event_timestamp = strtotime($info['event_date'] ?? date('Y-m-d', strtotime('+1 month')));
$e_day = date('d', $event_timestamp); 
$e_month = date('m', $event_timestamp);
$e_year = date('Y', $event_timestamp);

$days_in_month = date('t', $event_timestamp);
$first_day_of_month = date('w', strtotime("$e_year-$e_month-01"));
$start_day = ($first_day_of_month == 0) ? 6 : $first_day_of_month - 1; 

$weekdays_vi = ['CHỦ NHẬT', 'THỨ HAI', 'THỨ BA', 'THỨ TƯ', 'THỨ NĂM', 'THỨ SÁU', 'THỨ BẢY'];
$weekday_name = $weekdays_vi[date('w', $event_timestamp)];

$map_lat = !empty($info['lat']) ? $info['lat'] : '21.028511';
$map_lng = !empty($info['lng']) ? $info['lng'] : '105.804817';

// Preload critical assets
$heroImage = htmlspecialchars($info['hero_image'] ?? 'uploads/hero_default.jpg');
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Lễ Tốt Nghiệp - <?= htmlspecialchars($info['grad_name'] ?? '') ?></title>
    
    <!-- Preconnect & Preload cho Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&family=Great+Vibes&family=Montserrat:wght@300;400;500;700;900&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&family=Great+Vibes&family=Montserrat:wght@300;400;500;700;900&display=swap" rel="stylesheet"></noscript>
    
    <!-- Preload hero background image -->
    <link rel="preload" href="<?= $heroImage ?>" as="image" fetchpriority="high">
    
    <!-- AOS CSS tải sau (non-blocking) -->
    <link rel="preload" href="https://unpkg.com/aos@2.3.1/dist/aos.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"></noscript>

    <style>
        /* ========== CRITICAL CSS (inline) ========== */
        :root {
            --font-serif: 'Cormorant Garamond', serif;
            --font-sans: 'Montserrat', sans-serif;
            --font-script: 'Great Vibes', cursive;
            --text-main: #222;
            --text-light: #666;
            --accent: #a87b51; 
            --bg-body: #ececec;
            --bg-card: #ffffff;
        }
        ::-webkit-scrollbar { display: none; }
        html { scroll-behavior: smooth; }
        html, body { -ms-overflow-style: none; scrollbar-width: none; background: #111; margin: 0; padding: 0;}
        body.locked { overflow: hidden; }
        body { font-family: var(--font-serif); color: var(--text-main); display: flex; justify-content: center; -webkit-font-smoothing: antialiased; }
        .wrapper { max-width: 450px; width: 100%; background: var(--bg-card); position: relative; box-shadow: 0 0 30px rgba(0,0,0,0.5); overflow-x: hidden; min-height: 100vh;}
        #intro-overlay { position: fixed; top: 0; left: 50%; transform: translateX(-50%); width: 100%; max-width: 450px; height: 100vh; z-index: 99999; cursor: pointer; overflow: hidden; display: flex; justify-content: center; box-shadow: 0 0 40px rgba(0,0,0,0.8);}
        .intro-bottom { position: absolute; top: 0; left: 0; width: 100%; height: 100vh; background: #dcdcdc; transition: transform 2s cubic-bezier(0.68, -0.05, 0.27, 1); z-index: 2;}
        .intro-bottom-content { position: absolute; top: 55%; left: 0; width: 100%; display: flex; justify-content: space-between; align-items: flex-start; padding: 0 25px; box-sizing: border-box;}
        .intro-school { font-family: var(--font-sans); font-weight: 800; color: #fff; text-transform: uppercase; width: 50%; line-height: 1.2; text-align: left; text-shadow: 2px 2px 8px rgba(0,0,0,0.6); letter-spacing: 1px;}
        .intro-school .school-label { font-size: 0.9rem; }
        .intro-school .school-name { font-size: 0.85rem; display: block; }
        .intro-date-box { text-align: right; color: #fff; font-family: var(--font-sans); font-weight: 800; text-shadow: 2px 2px 8px rgba(0,0,0,0.6); }
        .intro-date-day { font-size: 3rem; line-height: 1; letter-spacing: 2px;}
        .intro-date-year { font-size: 2.2rem; line-height: 1; margin-top: 5px; color: #fff;}
        .intro-top { position: absolute; top: 0; left: 0; width: 100%; height: 100vh; background: #111; clip-path: polygon(0 0, 100% 0, 100% 45%, 50% 50%, 0 45%); transition: transform 2s cubic-bezier(0.68, -0.05, 0.27, 1); z-index: 3;}
        .cap-text { position: absolute; top: 20%; left: 50%; transform: translateX(-50%); color: #fff; font-family: var(--font-sans); font-size: 2rem; font-weight: 800; letter-spacing: 5px; text-shadow: 0 4px 10px rgba(0,0,0,0.8); width: 100%; text-align: center;}
        .tassel-wrapper { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -2px); display: flex; flex-direction: column; align-items: center; z-index: 4; transition: transform 2s cubic-bezier(0.68, -0.05, 0.27, 1);}
        .tassel-line { width: 4px; height: 110px; background: #d4af37; box-shadow: 2px 2px 5px rgba(0,0,0,0.3); }
        .tassel-knot { width: 14px; height: 14px; background: #b8860b; border-radius: 50%; border: 2px solid #ffd700; box-shadow: 2px 2px 5px rgba(0,0,0,0.3);}
        .tassel-fringe { width: 20px; height: 70px; background: repeating-linear-gradient(90deg, #d4af37, #d4af37 2px, #b8860b 2px, #b8860b 4px); border-radius: 0 0 5px 5px; box-shadow: 2px 2px 5px rgba(0,0,0,0.3);}
        .click-hint { position: absolute; bottom: 30px; left: 50%; transform: translateX(-50%); z-index: 5; font-family: var(--font-sans); font-size: 0.7rem; color: #fff; text-shadow: 1px 1px 3px #000; text-transform: uppercase; letter-spacing: 2px; animation: pulseHint 1.5s infinite; }
        @keyframes pulseHint { 0%, 100% { opacity: 0.3; } 50% { opacity: 1; } }
        #intro-overlay.open .intro-top { transform: translateY(-100%); }
        #intro-overlay.open .tassel-wrapper { transform: translate(-50%, -100vh); } 
        #intro-overlay.open .intro-bottom { transform: translateY(100%); }
        #main-content { opacity: 0; transition: opacity 2s ease-in-out; }
        #main-content.visible { opacity: 1; }
        .hero { height: 100vh; position: relative; background-image: url('<?= $heroImage ?>'); background-size: cover; background-position: center; background-attachment: fixed; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;}
        .hero::before { content: ''; position: absolute; inset: 0; background: linear-gradient(180deg, rgba(0,0,0,0.2) 0%, rgba(0,0,0,0.8) 100%); z-index: 1; }
        .hero-content { position: relative; z-index: 2; color: #fff; padding: 0 15px; width: 100%; box-sizing: border-box; top: 10%;}
        .hero h1 { font-family: var(--font-script); font-size: clamp(2rem, 11vw, 3.8rem); font-weight: 400; margin: 0; text-shadow: 2px 4px 8px rgba(0,0,0,0.6); line-height: 1.2; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .hero .subtitle { font-family: var(--font-sans); font-size: 0.75rem; font-weight: 500; letter-spacing: 4px; margin: 15px 0 10px; opacity: 0.9; text-transform: uppercase;}
        .hero .date { font-family: var(--font-sans); font-size: 1.1rem; letter-spacing: 2px; font-weight: 400; margin-bottom: 30px;}
        .invite-box { margin-top: 20px; padding: 15px 30px; background: rgba(0, 0, 0, 0.4); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 12px; backdrop-filter: blur(4px); display: inline-block; box-shadow: 0 4px 15px rgba(0,0,0,0.3); }
        .invite-label { font-family: var(--font-sans); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 3px; margin: 0 0 5px 0; color: #ddd; }
        .invite-name { font-family: var(--font-script); font-size: clamp(2rem, 8vw, 3rem); margin: 0; color: var(--accent); text-shadow: 1px 1px 2px rgba(0,0,0,0.5); line-height: 1; }
        #scrollTopBtn { position: fixed; bottom: 30px; right: 20px; z-index: 9999; width: 45px; height: 45px; border-radius: 50%; background: rgba(168, 123, 81, 0.85); color: #fff; border: 2px solid #fff; font-size: 1.5rem; cursor: pointer; box-shadow: 0 4px 10px rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center; transition: all 0.3s ease; opacity: 0; visibility: hidden; transform: translateY(20px);}
        #scrollTopBtn.show { opacity: 1; visibility: visible; transform: translateY(0);}
    </style>
    
    <!-- Phần CSS còn lại sẽ được tải async -->
    <link rel="preload" href="data:text/css;charset=utf-8,<?= rawurlencode('
        .section { padding: 50px 25px; text-align: center; }
        .quote-box { font-size: 1.2rem; font-style: italic; color: var(--text-light); line-height: 1.7; position: relative; padding: 20px;}
        .quote-box::before, .quote-box::after { content: ""; position: absolute; width: 30px; height: 1px; background: #ddd; left: 50%; transform: translateX(-50%); }
        .quote-box::before { top: 0; } .quote-box::after { bottom: 0; }
        .title-sm { font-family: var(--font-sans); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 3px; color: var(--text-light); margin-bottom: 5px; }
        .title-script-full { font-family: var(--font-script); font-size: clamp(2.5rem, 8vw, 3.5rem); color: var(--text-main); margin: -10px 0 15px; font-weight: 400; line-height: 1.2;}
        .title-script { font-family: var(--font-script); font-size: 3.5rem; color: var(--text-main); margin: -10px 0 15px; font-weight: 400;}
        .text-desc { font-family: var(--font-sans); font-size: 0.85rem; line-height: 1.8; color: #555; text-align: justify; font-weight: 300;}
        .photo-row { display: flex; gap: 4px; margin: 10px 0 40px; }
        .photo-row img { flex: 1; width: 33.33%; aspect-ratio: 3/4; object-fit: cover; border-radius: 2px;}
        .calendar-wrap { padding: 30px 15px; }
        .cal-table { width: 100%; border-collapse: collapse; font-family: var(--font-sans); font-size: 0.8rem; font-weight: 400; color: #444; margin-bottom: 25px;}
        .cal-table th { padding: 12px 0; color: #000; font-weight: 600; font-size: 0.75rem; letter-spacing: 1px;}
        .cal-table td { padding: 10px 0; text-align: center; }
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
        .t-item::before { content: ""; position: absolute; left: -5px; top: 2px; width: 9px; height: 9px; background: var(--accent); border-radius: 50%; box-shadow: 0 0 0 3px #fff;}
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
        .thank-you { font-family: var(--font-script); font-size: 3.5rem; color: var(--text-main); line-height: 1; margin: 40px 0 20px;}
        .map-container { border-radius: 8px; overflow: hidden; margin-top: 15px; border: 1px solid #eee;}
    ') ?>" as="style" onload="this.rel='stylesheet'">
</head>

<?php if($_SERVER["REQUEST_METHOD"] != "POST"): ?>
<body class="locked">
    <div id="intro-overlay">
        <div class="intro-bottom">
            <div class="intro-bottom-content">
                <div class="intro-school">
                    <span class="school-name"><?= htmlspecialchars($info['location_name'] ?? 'NGUYỄN TẤT THÀNH') ?></span>
                </div>
                <div class="intro-date-box">
                    <div class="intro-date-day"><?= sprintf("%02d/%02d", $e_day, $e_month) ?></div>
                    <div class="intro-date-year"><?= $e_year ?></div>
                </div>
            </div>
        </div>
        <div class="intro-top"><div class="cap-text">GRADUATION</div></div>
        <div class="tassel-wrapper"><div class="tassel-line"></div><div class="tassel-knot"></div><div class="tassel-fringe"></div></div>
        <div class="click-hint">Chạm để mở thiệp</div>
    </div>
<?php else: ?>
<body>
<?php endif; ?>

<div class="wrapper <?= ($_SERVER["REQUEST_METHOD"] == "POST") ? 'visible' : '' ?>" id="main-content">
    <div class="hero">
        <div class="hero-content" data-aos="fade-in" data-aos-duration="2000">
            <h1><?= htmlspecialchars($info['grad_name'] ?? '') ?></h1>
            <div class="subtitle">Lễ Tốt Nghiệp</div>
            <div class="date"><?= date('d.m.Y', $event_timestamp) ?></div>
            <?php if($guest_name_invite): ?>
                <div class="invite-box" data-aos="zoom-in" data-aos-delay="500" data-aos-duration="1500">
                    <p class="invite-label">Kính mời</p>
                    <p class="invite-name"><?= $guest_name_invite ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="section" data-aos="fade-up">
        <div class="quote-box">"<?= nl2br(htmlspecialchars($info['quote'] ?? 'Mong những lời chúc phúc...')) ?>"</div>
    </div>

    <div class="section" style="padding-top: 0;" data-aos="fade-up">
        <div class="title-sm">Tân cử nhân</div>
        <div class="title-script-full"><?= htmlspecialchars($info['grad_name'] ?? '') ?></div>
        <div class="photo-row">
            <img loading="lazy" src="<?= htmlspecialchars($info['photo_1'] ?? 'uploads/avatar_default.jpg') ?>" alt="photo">
            <img loading="lazy" src="<?= htmlspecialchars($info['photo_2'] ?? 'uploads/hero_default.jpg') ?>" alt="photo">
            <img loading="lazy" src="<?= htmlspecialchars($info['photo_3'] ?? 'uploads/avatar_default.jpg') ?>" alt="photo">
        </div>
        <div class="text-desc"><?= nl2br(htmlspecialchars($info['intro_text'] ?? 'Tốt nghiệp là dấu mốc kết thúc một hành trình và mở ra một chặng đường mới...')) ?></div>
    </div>

    <div class="section calendar-wrap" data-aos="fade-up">
        <?php if($guest_name_invite): ?>
            <div class="title-sm" style="color: #222; font-weight: 600;">THÂN MỜI</div>
            <div style="font-family: var(--font-script); font-size: 3.5rem; color: var(--accent); line-height: 1.2; margin: 15px 0;"><?= $guest_name_invite ?></div>
            <div class="title-sm" style="color: #222; font-weight: 600;">ĐẾN DỰ LỄ TỐT NGHIỆP CỦA MÌNH</div>
        <?php else: ?>
            <div class="title-script" style="font-size: 3rem;">Thân mời</div>
            <div class="title-sm" style="color: #222; font-weight: 600;">CÔ, CHÚ, ANH, CHỊ ĐẾN DỰ LỄ TỐT NGHIỆP</div>
        <?php endif; ?>
        <div class="title-script" style="font-size: 3.5rem; margin: 30px 0 10px;">Tháng <?= sprintf("%02d", $e_month) ?></div>
        <table class="cal-table">
            <tr><th>T2</th><th>T3</th><th>T4</th><th>T5</th><th>T6</th><th>T7</th><th>CN</th></tr>
            <?php
            $day_count = 1;
            for ($i = 0; $i < $start_day; $i++) echo "<td></td>";
            for ($i = $start_day; $i < 7; $i++) {
                $class = ($day_count == $e_day) ? "class='day-active'" : "";
                echo "<td><span $class>$day_count</span></td>";
                $day_count++;
            }
            echo "</tr>";
            while ($day_count <= $days_in_month) {
                echo "<tr>";
                for ($i = 0; $i < 7; $i++) {
                    if ($day_count <= $days_in_month) {
                        $class = ($day_count == $e_day) ? "class='day-active'" : "";
                        echo "<td><span $class>$day_count</span></td>";
                        $day_count++;
                    } else echo "<td></td>";
                }
                echo "</tr>";
            }
            ?>
        </table>
        <div class="title-sm" style="color:#000; letter-spacing: 1px;">LỄ TỐT NGHIỆP ĐƯỢC TỔ CHỨC<br>VÀO LÚC <?= htmlspecialchars($info['event_time'] ?? '07:30') ?> PHÚT</div>
        <div class="date-block">
            <div class="d-item"><span>THÁNG</span><strong><?= sprintf("%02d", $e_month) ?></strong></div>
            <div class="d-item main"><span><?= $weekday_name ?></span><strong><?= sprintf("%02d", $e_day) ?></strong></div>
            <div class="d-item"><span>NĂM</span><strong><?= $e_year ?></strong></div>
        </div>
        <h3 style="font-family: var(--font-sans); font-size: 1rem; font-weight: 600; margin: 0 0 5px; text-transform: uppercase;"><?= htmlspecialchars($info['location_name'] ?? 'Hội trường') ?></h3>
        <p style="font-family: var(--font-sans); font-size: 0.8rem; color: #666; margin-bottom: 5px;">📍 <?= htmlspecialchars($info['address'] ?? 'Địa chỉ') ?></p>
        <div class="map-container">
            <iframe loading="lazy" width="100%" height="200" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=<?= $map_lat ?>,<?= $map_lng ?>&hl=vi&z=15&output=embed"></iframe>
        </div>
        <a href="https://www.google.com/maps/dir/?api=1&destination=<?= $map_lat ?>,<?= $map_lng ?>" target="_blank" class="btn">Chỉ đường Map</a>
    </div>

    <div class="section" data-aos="fade-up">
        <div class="title-sm">Sự kiện</div>
        <div style="font-family: var(--font-sans); font-size: 1.2rem; font-weight: 500; letter-spacing: 4px; text-transform: uppercase;">Quan trọng</div>
        <div class="timeline">
            <?php if(!empty($timelines)): foreach ($timelines as $item): ?>
                <div class="t-item" data-aos="fade-up" data-aos-offset="50">
                    <div class="t-time"><?= htmlspecialchars($item['time_str']) ?></div>
                    <div class="t-desc"><?= htmlspecialchars($item['description']) ?></div>
                </div>
            <?php endforeach; else: ?>
                <div class="t-item"><div class="t-time">07:30</div><div class="t-desc">Làm lễ tại hội trường</div></div>
                <div class="t-item"><div class="t-time">10:30</div><div class="t-desc">Chụp ảnh lưu niệm</div></div>
            <?php endif; ?>
        </div>
    </div>

    <div class="section" style="padding-bottom: 20px;" data-aos="fade-up">
        <div class="title-script" style="font-size: 3rem; text-align: left; padding-left: 10px;">Album Tốt nghiệp</div>
    </div>
    <div class="album-grid" data-aos="fade-up">
        <div class="album-item"><img loading="lazy" src="<?= htmlspecialchars($info['album_1'] ?? 'uploads/avatar_default.jpg') ?>" alt="album"></div>
        <div class="album-text"><?= htmlspecialchars($info['album_text_1'] ?? 'Cánh cửa đại học khép lại, mở ra vô vàn cơ hội mới.') ?></div>
        <div class="album-text"><?= htmlspecialchars($info['album_text_2'] ?? 'Có những khoảnh khắc trôi qua rồi mới biết thế nào là vô giá.') ?></div>
        <div class="album-item"><img loading="lazy" src="<?= htmlspecialchars($info['album_2'] ?? 'uploads/hero_default.jpg') ?>" alt="album"></div>
    </div>

    <div class="rsvp-wrap" id="rsvp">
        <div class="title-script" style="font-size: 3.5rem; text-align: center;">Sổ lưu bút</div>
        <p class="text-desc" style="text-align: center; margin-bottom: 25px;"><?= htmlspecialchars($info['rsvp_text'] ?? 'Sự hiện diện của bạn là niềm vinh hạnh cho buổi lễ tốt nghiệp của mình.') ?></p>
        <?php if($success_msg): ?>
            <div style="color: #28a745; font-family: var(--font-sans); font-size: 0.85rem; text-align: center; margin-bottom: 15px; border: 1px solid #28a745; padding: 10px; border-radius: 4px;"><?= $success_msg ?></div>
        <?php endif; ?>
        <form method="POST" action="#rsvp" data-aos="fade-up">
            <input type="text" name="guest_name" class="form-control" placeholder="Tên của bạn" value="<?= $guest_name_invite ?>" required>
            <textarea name="message" class="form-control" placeholder="Gửi lời chúc mừng đến <?= htmlspecialchars(explode(' ', trim($info['grad_name']))[count(explode(' ', trim($info['grad_name']))) - 1]) ?>..." required></textarea>
            <select name="attendance" class="form-control" required>
                <option value="Sẽ đến">Mình chắc chắn sẽ đến</option>
                <option value="Không đến">Xin lỗi mình bận rồi!</option>
            </select>
            <button type="submit" name="submit_rsvp" class="btn" style="width: 100%; background: var(--text-main); color: #fff; border:none; padding: 15px;">Gửi Lời Nhắn</button>
        </form>
    </div>

    <div class="section" style="padding-top: 50px;">
        <div class="title-sm" style="color: #222;">Cảm ơn bạn rất nhiều vì đã gửi lời chúc mừng!</div>
        <div class="title-script" style="font-size: 3rem; margin-top: 20px;">Thời gian</div>
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

<!-- Tất cả JavaScript được defer và đặt cuối body -->
<script defer src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script defer>
    // Khởi tạo AOS sau khi trang load
    window.addEventListener('load', function() {
        AOS.init({ once: false, offset: 60, duration: 1000, easing: 'ease-out-cubic' });
    });

    // ========== AUTO SCROLL NHẸ ==========
    let autoScrollReq, isAutoScrolling = false, scrollPos = 0;
    function autoScroll() {
        if (!isAutoScrolling) return;
        scrollPos += 0.8;
        window.scrollTo(0, scrollPos);
        if ((window.innerHeight + window.scrollY) >= document.documentElement.scrollHeight - 10) isAutoScrolling = false;
        else autoScrollReq = requestAnimationFrame(autoScroll);
    }
    function stopAutoScroll() { if (isAutoScrolling) { isAutoScrolling = false; cancelAnimationFrame(autoScrollReq); } }
    window.addEventListener('touchstart', stopAutoScroll, {passive: true});
    window.addEventListener('touchmove', stopAutoScroll, {passive: true});
    window.addEventListener('wheel', stopAutoScroll, {passive: true});
    window.addEventListener('mousedown', stopAutoScroll);

    // ========== MỞ THIỆP ==========
    <?php if($_SERVER["REQUEST_METHOD"] != "POST"): ?>
    const introOverlay = document.getElementById('intro-overlay');
    const mainContent = document.getElementById('main-content');
    introOverlay.addEventListener('click', function() {
        introOverlay.classList.add('open');
        setTimeout(() => { mainContent.classList.add('visible'); }, 400);
        setTimeout(() => {
            introOverlay.style.display = 'none';
            document.body.classList.remove('locked');
            scrollPos = window.scrollY;
            isAutoScrolling = true;
            autoScroll();
        }, 1500);
    });
    <?php else: ?>
    document.body.classList.remove('locked');
    <?php endif; ?>

    // ========== NÚT LÊN ĐẦU TRANG ==========
    const scrollTopBtn = document.getElementById("scrollTopBtn");
    window.addEventListener('scroll', function() {
        const scrollableHeight = document.documentElement.scrollHeight - window.innerHeight;
        if (window.scrollY > scrollableHeight * 0.3) scrollTopBtn.classList.add("show");
        else scrollTopBtn.classList.remove("show");
    });
    scrollTopBtn.addEventListener('click', function() {
        stopAutoScroll();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    // ========== ĐẾM NGƯỢC ==========
    const eventDateStr = "<?= date('Y-m-d', $event_timestamp) ?>T<?= ($info['event_time'] ?? '00:00') ?>:00";
    const countDownDate = new Date(eventDateStr).getTime();
    const countdownInterval = setInterval(function() {
        const now = new Date().getTime();
        const distance = countDownDate - now;
        if (distance < 0) {
            clearInterval(countdownInterval);
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