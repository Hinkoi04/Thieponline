// ==========================================
// 1. KHAI BÁO CÁC BIẾN & ELEMENT
// ==========================================
const envelope = document.getElementById('envelope');
const mobileWrapper = document.querySelector('.mobile-wrapper');
const bgMusic = document.getElementById('bgMusic');
const musicBtn = document.getElementById('musicBtn');
const musicIcon = musicBtn.querySelector('i');

let isMusicPlaying = false;
let heartInterval; // Biến lưu vòng lặp tạo trái tim

// ==========================================
// 2. HÀM XỬ LÝ MỞ BÌ THƯ
// ==========================================
function openInvitation() {
    // Thêm class để CSS kích hoạt hiệu ứng trượt bì thư lên/xuống
    envelope.classList.add('is-open');
    
    // Đợi 1 giây cho bì thư xé ra rồi mới hiển thị nội dung & chạy hiệu ứng
    setTimeout(() => {
        // Cho phép cuộn trang
        mobileWrapper.classList.add('scrollable');
        // Ẩn hẳn bì thư để không chặn click chuột của người dùng
        envelope.style.visibility = 'hidden';

        // Khởi động các hiệu ứng
        initScrollAnimation();
        
        // Cứ 0.4s sẽ tạo ra 1 trái tim rơi
        heartInterval = setInterval(createHeart, 400); 

    }, 1000);

    // Tự động phát nhạc khi người dùng tương tác (mở thiệp)
    playMusic();
}

// ==========================================
// 3. HÀM XỬ LÝ ÂM THANH
// ==========================================
function toggleMusic() {
    if (isMusicPlaying) {
        bgMusic.pause();
        musicBtn.classList.remove('spinning'); // Dừng xoay
        musicIcon.classList.remove('fa-music');
        musicIcon.classList.add('fa-volume-mute'); // Đổi icon tắt tiếng
    } else {
        bgMusic.play();
        musicBtn.classList.add('spinning'); // Xoay đĩa nhạc
        musicIcon.classList.remove('fa-volume-mute');
        musicIcon.classList.add('fa-music'); // Đổi icon nốt nhạc
    }
    isMusicPlaying = !isMusicPlaying;
}

function playMusic() {
    bgMusic.play().then(() => {
        isMusicPlaying = true;
        musicBtn.classList.add('spinning');
    }).catch((error) => {
        console.log("Trình duyệt chặn autoplay. Người dùng cần bấm trực tiếp vào nút loa.");
    });
}

// ==========================================
// 4. HÀM HIỆU ỨNG LƯỚT XUỐNG (SCROLL REVEAL)
// ==========================================
function initScrollAnimation() {
    const scrollElements = document.querySelectorAll('.animate-on-scroll');
    
    // Sử dụng Intersection Observer để theo dõi phần tử khi cuộn trang
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            // Khi phần tử lọt vào tầm nhìn của màn hình
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible'); // Thêm class để hiện ra
                
                // Bỏ comment dòng dưới nếu bạn muốn cuộn lên cuộn xuống nó không lặp lại hiệu ứng nữa
                // observer.unobserve(entry.target); 
            }
        });
    }, { 
        threshold: 0.15 // 15% diện tích phần tử xuất hiện là bắt đầu chạy hiệu ứng
    }); 

    scrollElements.forEach(el => observer.observe(el));
}

// ==========================================
// 5. HÀM HIỆU ỨNG MƯA TRÁI TIM
// ==========================================
function createHeart() {
    const heart = document.createElement('div');
    heart.classList.add('heart');
    
    // Ký tự trái tim
    heart.innerHTML = '❤';

    // Random vị trí xuất hiện theo chiều ngang (0 đến 100% chiều rộng màn hình)
    heart.style.left = Math.random() * 100 + 'vw';
    
    // Random thời gian rơi (Rơi từ 4 giây đến 8 giây cho tự nhiên)
    heart.style.animationDuration = Math.random() * 4 + 4 + 's';
    
    // Random kích thước trái tim (từ 0.8rem đến 1.8rem)
    heart.style.fontSize = Math.random() * 1 + 0.8 + 'rem';

    // Đưa trái tim vào màn hình
    document.getElementById('heart-container').appendChild(heart);

    // XÓA trái tim sau 8 giây (khi nó rơi khỏi màn hình) để web không bị nặng/lag memory leak
    setTimeout(() => {
        heart.remove();
    }, 8000);
}