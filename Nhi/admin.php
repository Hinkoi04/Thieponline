<?php
session_start();
require 'db.php';

// Mật khẩu vào Admin
$admin_password = "123456"; 

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: admin.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    if ($_POST['password'] === $admin_password) {
        $_SESSION['logged_in'] = true;
    } else {
        $login_error = "Mật khẩu không đúng!";
    }
}

// ================= XỬ LÝ XÓA DỮ LIỆU TỪ GET =================
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // Xóa Lịch trình
    if (isset($_GET['del_timeline'])) {
        $id = (int)$_GET['del_timeline'];
        $pdo->prepare("DELETE FROM timeline WHERE id=?")->execute([$id]);
        header("Location: admin.php?msg=deleted");
        exit;
    }
    // Xóa RSVP (Sổ lưu bút)
    if (isset($_GET['del_rsvp'])) {
        $id = (int)$_GET['del_rsvp'];
        $pdo->prepare("DELETE FROM rsvp_messages WHERE id=?")->execute([$id]);
        header("Location: admin.php?msg=deleted");
        exit;
    }
}

// FORM ĐĂNG NHẬP
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    ?>
    <!DOCTYPE html>
    <html lang="vi">
    <head>
        <meta charset="UTF-8">
        <title>Đăng nhập Quản trị</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body { font-family: Arial; display: flex; justify-content: center; align-items: center; height: 100vh; background: #f0f2f5; margin: 0;}
            .login-box { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); width: 300px; text-align: center;}
            input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;}
            button { width: 100%; padding: 10px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;}
        </style>
    </head>
    <body>
        <div class="login-box">
            <h2>Quản Trị Thiệp Mời</h2>
            <?php if(isset($login_error)) echo "<p style='color:red;'>$login_error</p>"; ?>
            <form method="POST">
                <input type="password" name="password" placeholder="Nhập mật khẩu..." required>
                <button type="submit" name="login">Đăng nhập</button>
            </form>
        </div>
    </body>
    </html>
    <?php
    exit;
}

// ================= CODE XỬ LÝ DỮ LIỆU POST ADMIN =================
$msg = '';
if (isset($_GET['msg']) && $_GET['msg'] == 'deleted') {
    $msg = "Đã xóa dữ liệu thành công!";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_info'])) {
    $name = $_POST['grad_name'];
    $date = $_POST['event_date'];
    $time = $_POST['event_time'];
    $location = $_POST['location_name'];
    $address = $_POST['address'];
    $quote = $_POST['quote'];
    $lat = $_POST['lat']; 
    $lng = $_POST['lng']; 
    
    $intro_text = $_POST['intro_text'];
    $album_text_1 = $_POST['album_text_1'];
    $album_text_2 = $_POST['album_text_2'];
    $rsvp_text = $_POST['rsvp_text'];

    $sql = "UPDATE page_info SET grad_name=?, event_date=?, event_time=?, location_name=?, address=?, quote=?, lat=?, lng=?, intro_text=?, album_text_1=?, album_text_2=?, rsvp_text=? WHERE id=1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $date, $time, $location, $address, $quote, $lat, $lng, $intro_text, $album_text_1, $album_text_2, $rsvp_text]);
    $msg = "Cập nhật thông tin thành công!";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['upload_images'])) {
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) { mkdir($target_dir, 0777, true); }

    $image_fields = ['hero_image', 'avatar_image', 'photo_1', 'photo_2', 'photo_3', 'album_1', 'album_2'];
    
    foreach($image_fields as $field) {
        if (!empty($_FILES[$field]["name"])) {
            $file_name = time() . '_' . basename($_FILES[$field]["name"]);
            $file_path = $target_dir . $file_name;
            
            if (move_uploaded_file($_FILES[$field]["tmp_name"], $file_path)) {
                $pdo->prepare("UPDATE page_info SET $field=? WHERE id=1")->execute([$file_path]);
            }
        }
    }
    $msg = "Cập nhật hình ảnh thành công!";
}

// Xử lý Thêm / Sửa Lịch trình
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save_timeline'])) {
    $time_str = $_POST['time_str'];
    $desc = $_POST['description'];
    $order = (int)$_POST['order_num'];
    
    if (!empty($_POST['tl_id'])) {
        // Nếu có ID thì là Cập nhật (Sửa)
        $pdo->prepare("UPDATE timeline SET time_str=?, description=?, order_num=? WHERE id=?")->execute([$time_str, $desc, $order, $_POST['tl_id']]);
        $msg = "Đã cập nhật Lịch trình!";
    } else {
        // Không có ID thì Thêm mới
        $pdo->prepare("INSERT INTO timeline (time_str, description, order_num) VALUES (?, ?, ?)")->execute([$time_str, $desc, $order]);
        $msg = "Đã thêm sự kiện vào lịch trình!";
    }
}

// Lấy data để Edit Timeline
$edit_tl = null;
if (isset($_GET['edit_timeline'])) {
    $stmt_tl = $pdo->prepare("SELECT * FROM timeline WHERE id=?");
    $stmt_tl->execute([(int)$_GET['edit_timeline']]);
    $edit_tl = $stmt_tl->fetch(PDO::FETCH_ASSOC);
}

$info = $pdo->query("SELECT * FROM page_info LIMIT 1")->fetch(PDO::FETCH_ASSOC);
$timelines_admin = $pdo->query("SELECT * FROM timeline ORDER BY order_num ASC")->fetchAll(PDO::FETCH_ASSOC);
$rsvps = $pdo->query("SELECT * FROM rsvp_messages ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);

$current_lat = !empty($info['lat']) ? $info['lat'] : '21.028511';
$current_lng = !empty($info['lng']) ? $info['lng'] : '105.804817';
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảng Điều Khiển</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; max-width: 900px; margin: auto; background: #f0f2f5;}
        .header { display: flex; justify-content: space-between; align-items: center;}
        .btn-logout { background: #dc3545; color: white; padding: 8px 15px; text-decoration: none; border-radius: 4px; font-weight: bold;}
        .card { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 20px; }
        input, textarea, button { width: 100%; padding: 10px; margin-bottom: 15px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;}
        button { background: #007bff; color: white; border: none; cursor: pointer; font-weight: bold; font-size: 1.1rem; padding: 12px;}
        button:hover { background: #0056b3; }
        .table-responsive { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px;}
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f8f9fa; }
        .alert { padding: 10px; background: #d4edda; color: #155724; border-radius: 4px; margin-bottom: 20px;}
        
        /* Chỉnh CSS các nút bấm nhỏ */
        .btn-sm { padding: 6px 12px; font-size: 0.85rem; margin-right: 5px; text-decoration: none; border-radius: 3px; color: white; display: inline-block; text-align: center;}
        .btn-edit { background-color: #ffc107; color: #000; font-weight: bold;}
        .btn-del { background-color: #dc3545; font-weight: bold;}
        .btn-edit:hover { background-color: #e0a800; }
        .btn-del:hover { background-color: #c82333; }

        .img-group { border: 1px dashed #ccc; padding: 15px; border-radius: 5px; margin-bottom: 15px; background: #fafafa;}
        .img-group h3 { margin-top: 0; font-size: 1.1rem; color: #333;}
        .file-upload-row { display: flex; align-items: center; gap: 15px; margin-bottom: 15px; }
        .file-preview { width: 60px; height: 60px; object-fit: cover; border-radius: 5px; border: 2px solid #ddd; background: #fff; flex-shrink: 0;}
        .file-input-wrap { flex-grow: 1; }
        .file-input-wrap label { display: block; font-size: 0.9rem; font-weight: bold; margin-bottom: 5px; color: #444;}
        .file-input-wrap input { margin-bottom: 0; padding: 8px;}
        
        #mapPicker { height: 350px; width: 100%; margin-bottom: 15px; border-radius: 4px; border: 1px solid #ccc; z-index: 1;}
        .map-hint { font-size: 0.9rem; color: #d9534f; margin-bottom: 5px; font-weight: bold;}
    </style>
</head>
<body>

<div class="header">
    <h1>Quản lý Thiệp Tốt Nghiệp</h1>
    <a href="admin.php?logout=1" class="btn-logout">Đăng xuất</a>
</div>

<?php if($msg) echo "<div class='alert'><b>$msg</b></div>"; ?>

<div class="card">
    <h2>1. Đổi Hình Ảnh (Có xem trước)</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="img-group">
            <h3>🔹 Ảnh Chính</h3>
            <div class="file-upload-row">
                <img src="<?= htmlspecialchars($info['hero_image'] ?? '') ?>" class="file-preview">
                <div class="file-input-wrap"><label>Ảnh bìa (Background lúc mới vào):</label><input type="file" name="hero_image" accept="image/*"></div>
            </div>
            
            <div class="file-upload-row">
                <img src="<?= htmlspecialchars($info['avatar_image'] ?? '') ?>" class="file-preview">
                <div class="file-input-wrap"><label>Ảnh đại diện (Khối giới thiệu bản thân):</label><input type="file" name="avatar_image" accept="image/*"></div>
            </div>
        </div>

        <div class="img-group">
            <h3>🔹 Bộ 3 ảnh nối tiếp</h3>
            <div class="file-upload-row"><img src="<?= htmlspecialchars($info['photo_1'] ?? '') ?>" class="file-preview"><div class="file-input-wrap"><label>Ảnh 1 (Bên trái):</label><input type="file" name="photo_1" accept="image/*"></div></div>
            <div class="file-upload-row"><img src="<?= htmlspecialchars($info['photo_2'] ?? '') ?>" class="file-preview"><div class="file-input-wrap"><label>Ảnh 2 (Ở giữa):</label><input type="file" name="photo_2" accept="image/*"></div></div>
            <div class="file-upload-row"><img src="<?= htmlspecialchars($info['photo_3'] ?? '') ?>" class="file-preview"><div class="file-input-wrap"><label>Ảnh 3 (Bên phải):</label><input type="file" name="photo_3" accept="image/*"></div></div>
        </div>

        <div class="img-group">
            <h3>🔹 Album Lưới (Cuối trang)</h3>
            <div class="file-upload-row"><img src="<?= htmlspecialchars($info['album_1'] ?? '') ?>" class="file-preview"><div class="file-input-wrap"><label>Ảnh Album 1 (Bên trên):</label><input type="file" name="album_1" accept="image/*"></div></div>
            <div class="file-upload-row"><img src="<?= htmlspecialchars($info['album_2'] ?? '') ?>" class="file-preview"><div class="file-input-wrap"><label>Ảnh Album 2 (Bên dưới):</label><input type="file" name="album_2" accept="image/*"></div></div>
        </div>
        
        <button type="submit" name="upload_images">Tải Các Ảnh Lên</button>
    </form>
</div>

<div class="card">
    <h2>2. Thông Tin Chung & Soạn Văn Bản</h2>
    <form method="POST">
        <label>Họ và Tên (Hiển thị đầy đủ):</label>
        <input type="text" name="grad_name" value="<?= htmlspecialchars($info['grad_name'] ?? '') ?>" required>
        
        <label>Câu nói tâm đắc / Câu Quote (Phía trên tên):</label>
        <textarea name="quote" rows="2"><?= htmlspecialchars($info['quote'] ?? '') ?></textarea>

        <label>Đoạn tự sự dưới bộ 3 ảnh:</label>
        <textarea name="intro_text" rows="3"><?= htmlspecialchars($info['intro_text'] ?? '') ?></textarea>

        <label>Văn bản Album 1 (Ô chữ nằm giữa hình lưới):</label>
        <textarea name="album_text_1" rows="2"><?= htmlspecialchars($info['album_text_1'] ?? '') ?></textarea>

        <label>Văn bản Album 2 (Ô chữ nằm giữa hình lưới):</label>
        <textarea name="album_text_2" rows="2"><?= htmlspecialchars($info['album_text_2'] ?? '') ?></textarea>
        
        <label>Lời kêu gọi viết sổ lưu bút (RSVP):</label>
        <textarea name="rsvp_text" rows="2"><?= htmlspecialchars($info['rsvp_text'] ?? '') ?></textarea>

        <hr style="border: 0; border-top: 1px solid #ddd; margin: 20px 0;">
        
        <label>Ngày tổ chức:</label>
        <input type="date" name="event_date" value="<?= $info['event_date'] ?? '' ?>" required>
        <label>Giờ bắt đầu:</label>
        <input type="time" name="event_time" value="<?= $info['event_time'] ?? '' ?>" required>
        <label>Tên địa điểm (Hội trường / Nhà hàng):</label>
        <input type="text" name="location_name" value="<?= htmlspecialchars($info['location_name'] ?? '') ?>" required>
        <label>Địa chỉ văn bản:</label>
        <input type="text" name="address" value="<?= htmlspecialchars($info['address'] ?? '') ?>" required>

        <div class="map-hint">📍 Kéo thả Ghim Đỏ trên bản đồ dưới đây để chọn vị trí lấy tọa độ:</div>
        <div id="mapPicker"></div>
        <input type="hidden" name="lat" id="lat" value="<?= $current_lat ?>">
        <input type="hidden" name="lng" id="lng" value="<?= $current_lng ?>">

        <button type="submit" name="update_info" style="background: #28a745;">Lưu Tất Cả Văn Bản</button>
    </form>
</div>

<div class="card">
    <h2>3. Quản lý Lịch Trình (Timeline)</h2>
    
    <div style="background: #f9f9f9; padding: 15px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #eee;">
        <h3 style="margin-top: 0;"><?= $edit_tl ? '✏️ Cập nhật Sự kiện' : '➕ Thêm Sự kiện Mới' ?></h3>
        <form method="POST">
            <input type="hidden" name="tl_id" value="<?= $edit_tl['id'] ?? '' ?>">
            <label>Giờ (VD: 07:30):</label>
            <input type="text" name="time_str" value="<?= htmlspecialchars($edit_tl['time_str'] ?? '') ?>" required>
            <label>Nội dung sự kiện:</label>
            <input type="text" name="description" value="<?= htmlspecialchars($edit_tl['description'] ?? '') ?>" required>
            <label>Thứ tự hiển thị (Số nhỏ xếp trước):</label>
            <input type="number" name="order_num" value="<?= $edit_tl['order_num'] ?? '1' ?>" required>
            
            <button type="submit" name="save_timeline" style="background: <?= $edit_tl ? '#ffc107' : '#007bff' ?>; color: <?= $edit_tl ? '#000' : '#fff' ?>;">
                <?= $edit_tl ? 'Lưu Cập Nhật' : 'Thêm Vào Lịch Trình' ?>
            </button>
            <?php if($edit_tl): ?>
                <a href="admin.php" style="display: block; text-align: center; color: #666; margin-top: 10px;">Hủy chỉnh sửa</a>
            <?php endif; ?>
        </form>
    </div>

    <div class="table-responsive">
        <table>
            <tr>
                <th>Giờ</th>
                <th>Sự kiện</th>
                <th>Thứ tự</th>
                <th>Hành động</th>
            </tr>
            <?php foreach ($timelines_admin as $tl): ?>
            <tr>
                <td><strong><?= htmlspecialchars($tl['time_str']) ?></strong></td>
                <td><?= htmlspecialchars($tl['description']) ?></td>
                <td><?= $tl['order_num'] ?></td>
                <td>
                    <a href="admin.php?edit_timeline=<?= $tl['id'] ?>" class="btn-sm btn-edit">Sửa</a>
                    <a href="admin.php?del_timeline=<?= $tl['id'] ?>" class="btn-sm btn-del" onclick="return confirm('Bạn có chắc muốn xóa lịch trình này?');">Xóa</a>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php if(empty($timelines_admin)): ?>
            <tr><td colspan="4" style="text-align:center; color:#999;">Chưa có lịch trình nào.</td></tr>
            <?php endif; ?>
        </table>
    </div>
</div>

<div class="card">
    <h2>4. Danh sách Khách Phản Hồi (Sổ lưu bút)</h2>
    <div class="table-responsive">
        <table>
            <tr>
                <th>Tên khách</th>
                <th>Lời nhắn</th>
                <th>Xác nhận</th>
                <th>Ngày gửi</th>
                <th>Hành động</th>
            </tr>
            <?php foreach ($rsvps as $rsvp): ?>
            <tr>
                <td><strong><?= htmlspecialchars($rsvp['guest_name']) ?></strong></td>
                <td><?= nl2br(htmlspecialchars($rsvp['message'])) ?></td>
                <td>
                    <?php if($rsvp['attendance_status'] == 'Sẽ đến'): ?>
                        <span style="color: green; font-weight: bold;">✔ Sẽ đến</span>
                    <?php else: ?>
                        <span style="color: red;">❌ Không đến</span>
                    <?php endif; ?>
                </td>
                <td><?= date('d/m/Y H:i', strtotime($rsvp['created_at'])) ?></td>
                <td>
                    <a href="admin.php?del_rsvp=<?= $rsvp['id'] ?>" class="btn-sm btn-del" onclick="return confirm('Bạn có chắc muốn xóa lời nhắn của khách này?');">Xóa</a>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php if(empty($rsvps)): ?>
            <tr><td colspan="5" style="text-align:center; color:#999;">Chưa có phản hồi nào.</td></tr>
            <?php endif; ?>
        </table>
    </div>
</div>

<script>
    var currentLat = <?= $current_lat ?>;
    var currentLng = <?= $current_lng ?>;
    var map = L.map('mapPicker').setView([currentLat, currentLng], 15);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '© OpenStreetMap contributors' }).addTo(map);
    var marker = L.marker([currentLat, currentLng], {draggable: true}).addTo(map);
    marker.on('dragend', function(event){
        var position = event.target.getLatLng();
        document.getElementById('lat').value = position.lat;
        document.getElementById('lng').value = position.lng;
    });
    map.on('click', function(e) {
        marker.setLatLng(e.latlng);
        document.getElementById('lat').value = e.latlng.lat;
        document.getElementById('lng').value = e.latlng.lng;
    });
</script>

</body>
</html>