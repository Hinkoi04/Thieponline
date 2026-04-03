<?php
require 'db.php';

$info = $pdo->query("SELECT * FROM page_info LIMIT 1")->fetch(PDO::FETCH_ASSOC);
$timelines = $pdo->query("SELECT * FROM timeline ORDER BY order_num ASC")->fetchAll(PDO::FETCH_ASSOC);

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
}

$event_timestamp = strtotime($info['event_date'] ?? date('Y-m-d', strtotime('+1 month')));
$e_day = date('j', $event_timestamp); 
$e_month = date('n', $event_timestamp);
$e_year = date('Y', $event_timestamp);

$days_in_month = date('t', $event_timestamp);
$first_day_of_month = date('w', strtotime("$e_year-$e_month-01"));
$start_day = ($first_day_of_month == 0) ? 6 : $first_day_of_month - 1; 

$weekdays_vi = ['CHỦ NHẬT', 'THỨ HAI', 'THỨ BA', 'THỨ TƯ', 'THỨ NĂM', 'THỨ SÁU', 'THỨ BẢY'];
$weekday_name = $weekdays_vi[date('w', $event_timestamp)];

$map_lat = !empty($info['lat']) ? $info['lat'] : '21.028511';
$map_lng = !empty($info['lng']) ? $info['lng'] : '105.804817';
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Lễ Tốt Nghiệp - <?= htmlspecialchars($info['grad_name'] ?? 'Tên của bạn') ?></title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&family=Great+Vibes&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
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

        /* ẨN THANH CUỘN MƯỢT MÀ */
        ::-webkit-scrollbar { display: none; }
        html, body { -ms-overflow-style: none; scrollbar-width: none; background: #111; margin: 0; padding: 0;}
        
        /* KHI MÀN HÌNH INTRO CHƯA MỞ, KHÓA CUỘN TRANG */
        body.locked { overflow: hidden; }

        body { font-family: var(--font-serif); color: var(--text-main); display: flex; justify-content: center; -webkit-font-smoothing: antialiased; }
        .wrapper { max-width: 450px; width: 100%; background: var(--bg-card); position: relative; box-shadow: 0 0 30px rgba(0,0,0,0.5); overflow-x: hidden; min-height: 100vh;}
        
        /* =======================================================
           MÀN HÌNH INTRO (MŨ CỬ NHÂN)
           ======================================================= */
        #intro-overlay {
            position: fixed; inset: 0; background: #e9ecef; z-index: 99999;
            display: flex; flex-direction: column; cursor: pointer;
            transition: transform 0.8s cubic-bezier(0.5, 0, 0.2, 1);
        }
        .cap-bg {
            position: absolute; top: 0; left: 50%; transform: translateX(-50%);
            width: 150vw; height: 35vh; background: #111;
            clip-path: polygon(0 0, 100% 0, 100% 65%, 50% 100%, 0 65%);
            display: flex; justify-content: center; align-items: center; z-index: 2;
            transition: transform 0.3s ease;
        }
        .cap-text {
            color: #fff; font-family: var(--font-sans); font-size: 2.2rem; font-weight: 700; 
            letter-spacing: 5px; margin-top: -8vh; text-shadow: 0 4px 10px rgba(0,0,0,0.5);
        }
        .tassel-container {
            position: absolute; top: 35vh; left: 50%; transform: translateX(-50%);
            display: flex; flex-direction: column; align-items: center; z-index: 1;
            transition: transform 0.3s ease;
        }
        .tassel-string { width: 4px; height: 130px; background: #d4af37; box-shadow: 2px 2px 5px rgba(0,0,0,0.2); }
        .tassel-knot { width: 14px; height: 14px; background: #b8860b; border-radius: 50%; border: 2px solid #ffd700; box-shadow: 2px 2px 5px rgba(0,0,0,0.2); }
        .tassel-fringe { width: 18px; height: 80px; background: repeating-linear-gradient(90deg, #d4af37, #d4af37 2px, #b8860b 2px, #b8860b 4px); border-radius: 0 0 5px 5px; box-shadow: 2px 2px 5px rgba(0,0,0,0.2); }

        .intro-details {
            position: absolute; top: 60vh; width: 100%; padding: 0 35px; box-sizing: border-box;
            display: flex; justify-content: space-between; align-items: center;
        }
        .intro-school { font-family: var(--font-sans); font-weight: 700; font-size: 1rem; color: #555; text-transform: uppercase; max-width: 50%; line-height: 1.4; text-shadow: 1px 1px 0 #fff;}
        .intro-date { font-family: var(--font-sans); font-weight: 700; font-size: 3rem; color: var(--accent); line-height: 1; text-align: right; text-shadow: 1px 1px 0 #fff;}
        .intro-date span { display: block; font-size: 2rem; color: #555; }

        .click-hint {
            position: absolute; bottom: 30px; left: 50%; transform: translateX(-50%);
            font-family: var(--font-sans); font-size: 0.8rem; color: #666; text-transform: uppercase; letter-spacing: 2px;
            animation: pulseHint 1.5s infinite;
        }
        @keyframes pulseHint { 0%, 100% { opacity: 0.4; transform: translateX(-50%) translateY(0); } 50% { opacity: 1; transform: translateX(-50%) translateY(5px); } }

        /* Animation khi ấn vào mũ */
        #intro-overlay.pull-active .cap-bg { transform: translate(-50%, 30px); }
        #intro-overlay.pull-active .tassel-container { transform: translate(-50%, 30px); }
        #intro-overlay.slide-down-active { transform: translateY(100vh); }


        /* =======================================================
           GIAO DIỆN THIỆP CHÍNH
           ======================================================= */
        .hero { 
            height: 100vh; position: relative;
            background-image: url('<?= htmlspecialchars($info['hero_image'] ?? 'uploads/hero_default.jpg') ?>');
            background-size: cover; background-position: center; 
            background-attachment: fixed;
            display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;
        }
        .hero::before { content: ''; position: absolute; inset: 0; background: linear-gradient(180deg, rgba(0,0,0,0.2) 0%, rgba(0,0,0,0.8) 100%); z-index: 1; }
        .hero-content { position: relative; z-index: 2; color: #fff; padding: 0 15px; width: 100%; box-sizing: border-box; top: 10%;}
        
        /* CHỮ TÊN ÉP TRÊN 1 DÒNG VÀ CO GIÃN TỰ ĐỘNG */
        .hero h1 { 
            font-family: var(--font-script); 
            font-size: clamp(2rem, 11vw, 3.8rem);
            font-weight: 400; 
            margin: 0; 
            text-shadow: 2px 4px 8px rgba(0,0,0,0.6); 
            line-height: 1.2; 
            white-space: nowrap; 
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .hero .subtitle { font-family: var(--font-sans); font-size: 0.75rem; font-weight: 500; letter-spacing: 4px; margin: 15px 0 10px; opacity: 0.9; text-transform: uppercase;}
        .hero .date { font-family: var(--font-sans); font-size: 1.1rem; letter-spacing: 2px; font-weight: 400; margin-bottom: 30px;}

        .invite-box {
            margin-top: 20px;
            padding: 15px 30px;
            background: rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            backdrop-filter: blur(4px);
            display: inline-block;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        }
        .invite-label { font-family: var(--font-sans); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 3px; margin: 0 0 5px 0; color: #ddd; }
        .invite-name { font-family: var(--font-script); font-size: clamp(2rem, 8vw, 3rem); margin: 0; color: var(--accent); text-shadow: 1px 1px 2px rgba(0,0,0,0.5); line-height: 1; }

        .section { padding: 50px 25px; text-align: center; }
        .quote-box { font-size: 1.2rem; font-style: italic; color: var(--text-light); line-height: 1.7; position: relative; padding: 20px;}
        .quote-box::before, .quote-box::after { content: ''; position: absolute; width: 30px; height: 1px; background: #ddd; left: 50%; transform: translateX(-50%); }
        .quote-box::before { top: 0; } .quote-box::after { bottom: 0; }

        .title-sm { font-family: var(--font-sans); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 3px; color: var(--text-light); margin-bottom: 5px; }
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
        .thank-you { font-family: var(--font-script); font-size: 3.5rem; color: var(--text-main); line-height: 1; margin: 40px 0 20px;}
        
        .map-container { border-radius: 8px; overflow: hidden; margin-top: 15px; border: 1px solid #eee;}
    </style>
</head>
<body class="locked">

<?php if($_SERVER["REQUEST_METHOD"] != "POST"): ?>
<div id="intro-overlay">
    <div class="cap-bg">
        <div class="cap-text">GRADUATION</div>
    </div>
    <div class="tassel-container">
        <div class="tassel-string"></div>
        <div class="tassel-knot"></div>
        <div class="tassel-fringe"></div>
    </div>
    
    <div class="intro-details">
        <div class="intro-school"><?= htmlspecialchars($info['location_name'] ?? 'ĐẠI HỌC CỦA BẠN') ?></div>
        <div class="intro-date">
            <?= date('d/m', $event_timestamp) ?>
            <span><?= date('Y', $event_timestamp) ?></span>
        </div>
    </div>
    
    <div class="click-hint">Chạm để mở thiệp</div>
</div>
<?php endif; ?>

<div class="wrapper" id="main-content" style="<?= ($_SERVER["REQUEST_METHOD"] == "POST") ? 'display:block;' : 'display:none;' ?>">

    <div class="hero">
        <div class="hero-content" data-aos="fade-in" data-aos-duration="2000">
            <h1><?= htmlspecialchars($info['grad_name'] ?? 'Tên Của Bạn') ?></h1>
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
        <?php $name_parts = explode(' ', trim($info['grad_name'])); $first_name = end($name_parts); ?>
        <div class="title-script"><?= htmlspecialchars($first_name) ?></div>
        
        <div class="photo-row">
            <img src="<?= htmlspecialchars($info['photo_1'] ?? 'uploads/avatar_default.jpg') ?>">
            <img src="<?= htmlspecialchars($info['photo_2'] ?? 'uploads/hero_default.jpg') ?>">
            <img src="<?= htmlspecialchars($info['photo_3'] ?? 'uploads/avatar_default.jpg') ?>">
        </div>

        <div class="text-desc">
            Tốt nghiệp là dấu mốc kết thúc một hành trình và mở ra một chặng đường mới. Tôi biết phía trước sẽ không dễ dàng, nhưng tôi tin vào bản thân, vào những gì mình đã học được. Cảm ơn thanh xuân vì đã rực rỡ đến thế! 🎓✨
        </div>
    </div>

    <div class="section calendar-wrap" data-aos="fade-up">
        <div class="title-script" style="font-size: 3rem;">Thân mời</div>
        <div class="title-sm" style="color: #222; font-weight: 600;">CÔ, CHÚ, ANH, CHỊ ĐẾN DỰ LỄ TỐT NGHIỆP</div>
        <div class="title-script" style="font-size: 3.5rem; margin: 30px 0 10px;">Tháng <?= $e_month ?></div>

        <table class="cal-table">
            <tr><th>T2</th><th>T3</th><th>T4</th><th>T5</th><th>T6</th><th>T7</th><th>CN</th></tr>
            <tr>
            <?php
            $day_count = 1;
            for ($i = 0; $i < $start_day; $i++) { echo "<td></td>"; }
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
                    } else {
                        echo "<td></td>";
                    }
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
            <iframe 
                width="100%" height="200" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" 
                src="https://maps.google.com/maps?q=<?= $map_lat ?>,<?= $map_lng ?>&hl=vi&z=15&output=embed">
            </iframe>
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
        <div class="album-item"><img src="<?= htmlspecialchars($info['album_1'] ?? 'uploads/avatar_default.jpg') ?>"></div>
        <div class="album-text">Cánh cửa đại học khép lại, mở ra vô vàn cơ hội và thách thức mới.</div>
        <div class="album-text">Có những khoảnh khắc trôi qua rồi mới biết thế nào là vô giá. Trân trọng!</div>
        <div class="album-item"><img src="<?= htmlspecialchars($info['album_2'] ?? 'uploads/hero_default.jpg') ?>"></div>
    </div>

    <div class="rsvp-wrap" id="rsvp">
        <div class="title-script" style="font-size: 3.5rem; text-align: center;">Sổ lưu bút</div>
        <p class="text-desc" style="text-align: center; margin-bottom: 25px;">Sự hiện diện của bạn là niềm vinh hạnh cho buổi lễ tốt nghiệp của mình.</p>
        
        <?php if($success_msg): ?>
            <div style="color: #28a745; font-family: var(--font-sans); font-size: 0.85rem; text-align: center; margin-bottom: 15px; border: 1px solid #28a745; padding: 10px; border-radius: 4px;"><?= $success_msg ?></div>
        <?php endif; ?>

        <form method="POST" action="#rsvp" data-aos="fade-up">
            <input type="text" name="guest_name" class="form-control" placeholder="Tên của bạn" value="<?= $guest_name_invite ?>" required>
            <textarea name="message" class="form-control" placeholder="Gửi lời nhắn đến <?= htmlspecialchars($first_name) ?>..." required></textarea>
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

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    <?php if($_SERVER["REQUEST_METHOD"] != "POST"): ?>
        const introOverlay = document.getElementById('intro-overlay');
        const mainContent = document.getElementById('main-content');
        
        introOverlay.addEventListener('click', function() {
            // Bước 1: Ấn vào giật mũ xuống 1 chút
            introOverlay.classList.add('pull-active');
            document.querySelector('.click-hint').style.display = 'none';
            
            // Bước 2: Kéo tuột màn hình xuống để lộ thiệp
            setTimeout(() => {
                introOverlay.classList.add('slide-down-active');
                
                // Bước 3: Hiện nội dung chính và Mở khóa cuộn trang
                setTimeout(() => {
                    introOverlay.style.display = 'none';
                    mainContent.style.display = 'block';
                    document.body.classList.remove('locked');
                    
                    // Khởi tạo hiệu ứng xuất hiện sau khi mở thiệp
                    AOS.init({ once: true, offset: 60, duration: 800, easing: 'ease-out-cubic' });
                }, 800);
            }, 300);
        });
    <?php else: ?>
        // Nếu vừa điền Sổ lưu bút thì bỏ qua Intro và mở khóa luôn
        document.body.classList.remove('locked');
        AOS.init({ once: true, offset: 60, duration: 800, easing: 'ease-out-cubic' });
    <?php endif; ?>

    // Xử lý đếm ngược
    const eventDateStr = "<?= date('Y-m-d', $event_timestamp) ?>T<?= ($info['event_time'] ?? '00:00') ?>:00";
    const countDownDate = new Date(eventDateStr).getTime();

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