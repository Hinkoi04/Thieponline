<?php
session_start();
require 'db.php';

// --- MẬT KHẨU ĐĂNG NHẬP TRANG ADMIN ---
$admin_password = "123";

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: admin.php");
    exit;
}

$login_error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    if ($_POST['password'] === $admin_password) {
        $_SESSION['admin_logged_in'] = true;
    } else {
        $login_error = "Mật khẩu không chính xác!";
    }
}

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập · Quản Trị</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --gold: #b8965a;
            --gold-light: #d4b483;
            --gold-dark: #8a6535;
            --cream: #faf7f2;
            --dark: #1a1208;
            --muted: #7a6d5e;
            --border: rgba(184,150,90,0.2);
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse 80% 60% at 20% 10%, rgba(184,150,90,0.08) 0%, transparent 60%),
                radial-gradient(ellipse 60% 80% at 80% 90%, rgba(184,150,90,0.06) 0%, transparent 60%);
            pointer-events: none;
        }

        .ornament {
            position: fixed;
            font-size: 20rem;
            color: rgba(184,150,90,0.04);
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            line-height: 1;
            pointer-events: none;
            user-select: none;
        }
        .ornament-tl { top: -4rem; left: -4rem; }
        .ornament-br { bottom: -4rem; right: -4rem; }

        .login-card {
            position: relative;
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 2px;
            padding: 56px 48px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 20px 60px rgba(26,18,8,0.08), 0 4px 16px rgba(26,18,8,0.04);
            animation: fadeUp 0.6s ease both;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0; left: 50%;
            transform: translateX(-50%);
            width: 60px; height: 2px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
        }

        .login-icon {
            width: 56px; height: 56px;
            background: linear-gradient(135deg, var(--gold-light), var(--gold-dark));
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 24px;
            font-size: 1.4rem;
        }

        .login-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.8rem;
            font-weight: 300;
            color: var(--dark);
            text-align: center;
            letter-spacing: 0.02em;
            margin-bottom: 6px;
        }

        .login-sub {
            text-align: center;
            font-size: 0.8rem;
            color: var(--muted);
            letter-spacing: 0.12em;
            text-transform: uppercase;
            margin-bottom: 36px;
        }

        .error-msg {
            background: #fff5f5;
            border: 1px solid #fed7d7;
            color: #c53030;
            padding: 12px 16px;
            border-radius: 2px;
            font-size: 0.85rem;
            margin-bottom: 20px;
            text-align: center;
        }

        .field-wrap { position: relative; margin-bottom: 20px; }

        .field-label {
            display: block;
            font-size: 0.7rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 8px;
            font-weight: 500;
        }

        .field-input {
            width: 100%;
            padding: 14px 16px;
            background: var(--cream);
            border: 1px solid var(--border);
            border-radius: 2px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.95rem;
            color: var(--dark);
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .field-input:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(184,150,90,0.1);
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--gold-light) 0%, var(--gold-dark) 100%);
            color: #fff;
            border: none;
            border-radius: 2px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.8rem;
            font-weight: 500;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.1s;
            margin-top: 8px;
        }

        .btn-login:hover { opacity: 0.9; transform: translateY(-1px); }
        .btn-login:active { transform: translateY(0); }

        .divider-line {
            text-align: center;
            margin: 28px 0 0;
            color: var(--border);
            font-size: 1.2rem;
            letter-spacing: 0.5em;
        }
    </style>
</head>
<body>
    <span class="ornament ornament-tl">✦</span>
    <span class="ornament ornament-br">✦</span>

    <div class="login-card">
        <div class="login-icon">🔐</div>
        <h1 class="login-title">Quản Trị</h1>
        <p class="login-sub">Khu Vực Quản Lý Lời Chúc</p>

        <?php if($login_error): ?>
            <div class="error-msg">⚠ <?= htmlspecialchars($login_error) ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="field-wrap">
                <label class="field-label" for="pwd">Mật khẩu</label>
                <input class="field-input" type="password" name="password" id="pwd" placeholder="••••••••" required autofocus>
            </div>
            <button class="btn-login" type="submit" name="login">Đăng Nhập →</button>
        </form>

        <div class="divider-line">· · ·</div>
    </div>
</body>
</html>
<?php
    exit;
}

// Xử lý Xóa
$msg = '';
$msg_type = 'success';
if (isset($_GET['delete_id'])) {
    $del_id = (int)$_GET['delete_id'];
    try {
        $stmt = $pdo->prepare("DELETE FROM rsvp_messages WHERE id = ?");
        if ($stmt->execute([$del_id])) {
            $msg = "✓ Đã xóa lời chúc thành công.";
        }
    } catch (PDOException $e) {
        $msg = "✗ Lỗi khi xóa: " . $e->getMessage();
        $msg_type = 'error';
    }
}

// Lấy dữ liệu
try {
    $stmt = $pdo->query("SELECT * FROM rsvp_messages ORDER BY created_at DESC");
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $total = count($messages);
} catch (PDOException $e) {
    die("Lỗi truy vấn: " . $e->getMessage());
}

// Tính ngày gần nhất
$latest_date = $total > 0 ? date('d/m/Y', strtotime($messages[0]['created_at'])) : '—';

// Đếm hôm nay
$today_count = 0;
foreach ($messages as $m) {
    if (date('Y-m-d', strtotime($m['created_at'])) === date('Y-m-d')) $today_count++;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Lời Chúc · Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --gold: #b8965a;
            --gold-light: #d4b483;
            --gold-dim: rgba(184,150,90,0.15);
            --gold-dark: #8a6535;
            --cream: #faf7f2;
            --cream-dark: #f2ede4;
            --dark: #1a1208;
            --text: #2d2416;
            --muted: #7a6d5e;
            --border: rgba(184,150,90,0.18);
            --border-solid: #e8e0d4;
            --white: #ffffff;
            --red: #c0392b;
            --red-light: #fff5f5;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--text);
            min-height: 100vh;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            position: fixed;
            left: 0; top: 0; bottom: 0;
            width: 240px;
            background: var(--dark);
            display: flex;
            flex-direction: column;
            z-index: 100;
        }

        .sidebar-brand {
            padding: 32px 28px 24px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }

        .brand-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.25rem;
            font-weight: 400;
            color: var(--gold-light);
            letter-spacing: 0.04em;
            line-height: 1.3;
        }

        .brand-sub {
            font-size: 0.7rem;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.3);
            margin-top: 4px;
        }

        .sidebar-nav {
            flex: 1;
            padding: 20px 16px;
        }

        .nav-label {
            font-size: 0.62rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.25);
            padding: 0 12px;
            margin-bottom: 8px;
            margin-top: 16px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            border-radius: 4px;
            color: rgba(255,255,255,0.55);
            font-size: 0.875rem;
            font-weight: 400;
            text-decoration: none;
            transition: all 0.15s;
            cursor: pointer;
        }

        .nav-item:hover { background: rgba(255,255,255,0.05); color: rgba(255,255,255,0.85); }
        .nav-item.active { background: rgba(184,150,90,0.15); color: var(--gold-light); }
        .nav-icon { font-size: 1rem; width: 20px; text-align: center; }

        .sidebar-footer {
            padding: 16px;
            border-top: 1px solid rgba(255,255,255,0.06);
        }

        .btn-logout {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            padding: 10px 12px;
            background: transparent;
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 4px;
            color: rgba(255,255,255,0.4);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.8rem;
            letter-spacing: 0.05em;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.15s;
        }

        .btn-logout:hover { border-color: #c0392b; color: #e74c3c; background: rgba(192,57,43,0.08); }

        /* ── MAIN ── */
        .main {
            margin-left: 240px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            background: var(--white);
            border-bottom: 1px solid var(--border-solid);
            padding: 0 36px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .topbar-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.5rem;
            font-weight: 400;
            color: var(--dark);
            letter-spacing: 0.02em;
        }

        .topbar-date {
            font-size: 0.8rem;
            color: var(--muted);
            letter-spacing: 0.05em;
        }

        .content {
            flex: 1;
            padding: 32px 36px;
        }

        /* ── ALERT ── */
        .alert {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 20px;
            border-radius: 4px;
            margin-bottom: 28px;
            font-size: 0.875rem;
            animation: fadeUp 0.3s ease both;
        }
        .alert.success { background: #f0fff4; border: 1px solid #c6f6d5; color: #276749; }
        .alert.error { background: var(--red-light); border: 1px solid #fed7d7; color: var(--red); }

        /* ── STATS ── */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: var(--white);
            border: 1px solid var(--border-solid);
            border-radius: 4px;
            padding: 24px 28px;
            position: relative;
            overflow: hidden;
            animation: fadeUp 0.4s ease both;
        }

        .stat-card::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
        }

        .stat-card:nth-child(2) { animation-delay: 0.05s; }
        .stat-card:nth-child(3) { animation-delay: 0.1s; }

        .stat-label {
            font-size: 0.7rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 12px;
            font-weight: 500;
        }

        .stat-value {
            font-family: 'Cormorant Garamond', serif;
            font-size: 3rem;
            font-weight: 300;
            color: var(--dark);
            line-height: 1;
        }

        .stat-icon {
            position: absolute;
            top: 20px; right: 24px;
            font-size: 1.4rem;
            opacity: 0.3;
        }

        /* ── TABLE SECTION ── */
        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .section-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.2rem;
            font-weight: 400;
            color: var(--dark);
            letter-spacing: 0.02em;
        }

        .section-count {
            font-size: 0.75rem;
            color: var(--muted);
            background: var(--cream-dark);
            padding: 4px 12px;
            border-radius: 20px;
            letter-spacing: 0.05em;
        }

        /* ── TABLE ── */
        .table-card {
            background: var(--white);
            border: 1px solid var(--border-solid);
            border-radius: 4px;
            overflow: hidden;
            animation: fadeUp 0.5s ease 0.15s both;
        }

        .table-wrap { overflow-x: auto; }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead tr {
            background: var(--cream);
            border-bottom: 1px solid var(--border-solid);
        }

        th {
            padding: 14px 20px;
            text-align: left;
            font-size: 0.65rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--muted);
            font-weight: 600;
            white-space: nowrap;
        }

        tbody tr {
            border-bottom: 1px solid var(--border-solid);
            transition: background 0.12s;
        }

        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: #fdfaf6; }

        td { padding: 18px 20px; vertical-align: top; }

        .td-id {
            font-family: 'DM Sans', sans-serif;
            font-size: 0.75rem;
            color: rgba(184,150,90,0.5);
            font-weight: 500;
            white-space: nowrap;
        }

        .guest-avatar {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--gold-light), var(--gold-dark));
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.85rem;
            flex-shrink: 0;
        }

        .guest-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .guest-name {
            font-weight: 500;
            color: var(--dark);
            font-size: 0.95rem;
            white-space: nowrap;
        }

        .message-preview {
            color: var(--muted);
            font-size: 0.875rem;
            line-height: 1.6;
            max-width: 480px;
            white-space: pre-wrap;
            word-break: break-word;
        }

        .message-full {
            color: var(--text);
            font-size: 0.895rem;
            line-height: 1.65;
            white-space: pre-wrap;
            word-break: break-word;
            font-style: italic;
            font-family: 'Cormorant Garamond', serif;
            font-size: 1rem;
        }

        .quote-mark {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2rem;
            color: var(--gold-light);
            line-height: 0.5;
            vertical-align: -0.4em;
            margin-right: 2px;
        }

        .date-badge {
            display: inline-flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 2px;
        }

        .date-day {
            font-size: 0.85rem;
            color: var(--text);
            font-weight: 500;
        }

        .date-time-val {
            font-size: 0.75rem;
            color: var(--muted);
        }

        .btn-delete {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 14px;
            background: transparent;
            border: 1px solid var(--border-solid);
            border-radius: 3px;
            color: var(--muted);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.78rem;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.15s;
            white-space: nowrap;
        }

        .btn-delete:hover {
            background: var(--red-light);
            border-color: #fed7d7;
            color: var(--red);
        }

        /* ── EMPTY ── */
        .empty-state {
            padding: 80px 20px;
            text-align: center;
        }

        .empty-icon {
            font-size: 3rem;
            margin-bottom: 16px;
            opacity: 0.4;
        }

        .empty-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.4rem;
            font-weight: 300;
            color: var(--muted);
            margin-bottom: 6px;
        }

        .empty-sub {
            font-size: 0.8rem;
            color: rgba(122,109,94,0.6);
            letter-spacing: 0.05em;
        }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 900px) {
            .sidebar { width: 200px; }
            .main { margin-left: 200px; }
            .content { padding: 24px 20px; }
            .topbar { padding: 0 20px; }
            .stats-row { grid-template-columns: 1fr 1fr; }
        }

        @media (max-width: 640px) {
            .sidebar { display: none; }
            .main { margin-left: 0; }
            .stats-row { grid-template-columns: 1fr; }
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: var(--gold-dim); border-radius: 10px; }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-title">Lời Chúc<br>Cưới</div>
        <div class="brand-sub">Wedding Admin</div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-label">Quản lý</div>
        <a class="nav-item active" href="admin.php">
            <span class="nav-icon">💌</span>
            Lời Chúc
        </a>

        <div class="nav-label">Hệ thống</div>
        <a class="nav-item" href="admin.php">
            <span class="nav-icon">⚙️</span>
            Cài Đặt
        </a>
    </nav>

    <div class="sidebar-footer">
        <a href="admin.php?logout=1" class="btn-logout">
            <span>→</span> Đăng Xuất
        </a>
    </div>
</aside>

<!-- MAIN -->
<main class="main">
    <div class="topbar">
        <h1 class="topbar-title">Danh Sách Lời Chúc</h1>
        <span class="topbar-date"><?= date('d/m/Y — H:i') ?></span>
    </div>

    <div class="content">

        <?php if ($msg): ?>
            <div class="alert <?= $msg_type ?>"><?= $msg ?></div>
        <?php endif; ?>

        <!-- STATS -->
        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-icon">💌</div>
                <div class="stat-label">Tổng Lời Chúc</div>
                <div class="stat-value"><?= $total ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">📅</div>
                <div class="stat-label">Hôm Nay</div>
                <div class="stat-value"><?= $today_count ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🕐</div>
                <div class="stat-label">Mới Nhất</div>
                <div class="stat-value" style="font-size:1.6rem; padding-top:8px;"><?= $latest_date ?></div>
            </div>
        </div>

        <!-- TABLE -->
        <div class="section-header">
            <h2 class="section-title">Khách Mời Đã Phản Hồi</h2>
            <span class="section-count"><?= $total ?> lời chúc</span>
        </div>

        <div class="table-card">
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="20%">Khách Mời</th>
                            <th>Lời Chúc</th>
                            <th width="14%">Thời Gian</th>
                            <th width="9%">Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($total > 0): ?>
                            <?php foreach ($messages as $i => $row):
                                $first_char = mb_strtoupper(mb_substr($row['guest_name'], 0, 1, 'UTF-8'), 'UTF-8');
                            ?>
                            <tr style="animation: fadeUp 0.3s ease <?= $i * 0.03 ?>s both;">
                                <td class="td-id">#<?= str_pad($row['id'], 3, '0', STR_PAD_LEFT) ?></td>
                                <td>
                                    <div class="guest-cell">
                                        <div class="guest-avatar"><?= $first_char ?></div>
                                        <span class="guest-name"><?= htmlspecialchars($row['guest_name']) ?></span>
                                    </div>
                                </td>
                                <td>
                                    <span class="quote-mark">"</span><span class="message-full"><?= htmlspecialchars($row['message']) ?></span>
                                </td>
                                <td>
                                    <div class="date-badge">
                                        <span class="date-day"><?= date('d/m/Y', strtotime($row['created_at'])) ?></span>
                                        <span class="date-time-val"><?= date('H:i', strtotime($row['created_at'])) ?></span>
                                    </div>
                                </td>
                                <td>
                                    <a href="admin.php?delete_id=<?= $row['id'] ?>" class="btn-delete"
                                       onclick="return confirm('Xóa lời chúc của <?= htmlspecialchars($row['guest_name'], ENT_QUOTES) ?>?');">
                                        🗑 Xóa
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <div class="empty-icon">📭</div>
                                        <div class="empty-title">Chưa có lời chúc nào</div>
                                        <div class="empty-sub">Khách mời chưa gửi phản hồi</div>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div><!-- /content -->
</main>

</body>
</html>