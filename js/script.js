// Các element cần tương tác
const envelope = document.getElementById('envelope');
const mobileWrapper = document.querySelector('.mobile-wrapper');
const bgMusic = document.getElementById('bgMusic');
const musicBtn = document.getElementById('musicBtn');
const musicIcon = musicBtn.querySelector('i');

let isMusicPlaying = false;

// Hàm mở thiệp
function openInvitation() {
    // Thêm class để kích hoạt CSS transform (trượt lên/xuống)
    envelope.classList.add('is-open');
    
    // Sau khi mở 1 chút (0.5s), cho phép cuộn nội dung bên trong
    setTimeout(() => {
        mobileWrapper.classList.add('scrollable');
        envelope.style.visibility = 'hidden'; // Ẩn bì thư để không chặn click
    }, 1000);

    // Bật nhạc nền (Yêu cầu của hầu hết trình duyệt là user phải tương tác mới cho phát nhạc)
    playMusic();
}

// Hàm bật/tắt nhạc
function toggleMusic() {
    if (isMusicPlaying) {
        bgMusic.pause();
        musicBtn.classList.remove('spinning');
        // Đổi icon sang gạch chéo
        musicIcon.classList.remove('fa-music');
        musicIcon.classList.add('fa-volume-mute');
    } else {
        bgMusic.play();
        musicBtn.classList.add('spinning');
        // Đổi icon sang nốt nhạc
        musicIcon.classList.remove('fa-volume-mute');
        musicIcon.classList.add('fa-music');
    }
    isMusicPlaying = !isMusicPlaying;
}

// Hàm ép play nhạc
function playMusic() {
    bgMusic.play().then(() => {
        isMusicPlaying = true;
        musicBtn.classList.add('spinning');
    }).catch((error) => {
        console.log("Trình duyệt chặn autoplay âm thanh. Người dùng cần tự bấm nút loa.");
    });
}