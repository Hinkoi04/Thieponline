document.addEventListener('DOMContentLoaded', () => {
    const envelopeContainer = document.getElementById('envelope-container');
    const introScreen = document.getElementById('intro-screen');
    const mainInvitation = document.getElementById('main-invitation');

    // 1. Xử lý mở phong bì và chuyển cảnh
    envelopeContainer.addEventListener('click', () => {
        // Thêm class mở phong bì
        envelopeContainer.classList.add('open');
        
        // Đợi 1.5 giây để chạy xong animation mở thư, sau đó chuyển cảnh
        setTimeout(() => {
            introScreen.classList.add('hidden'); // Mờ dần nền phong bì
            
            setTimeout(() => {
                introScreen.style.display = 'none'; // Ẩn hẳn
                mainInvitation.style.display = 'flex'; // Hiện thiệp cuộn dọc
                window.scrollTo(0, 0); // Đảm bảo bắt đầu cuộn từ trên cùng
            }, 1000); // Đợi CSS transition opacity chạy xong
        }, 1500);
    });

    // 2. Xử lý bộ đếm ngược (Countdown Timer)
    // Thiết lập ngày tốt nghiệp (Năm, Tháng (bắt đầu từ 0), Ngày, Giờ, Phút)
    // Tháng 5 trong JS là số 4 (0 = Tháng 1, 4 = Tháng 5)
    const graduationDate = new Date(2026, 4, 15, 8, 30, 0).getTime();

    const updateTimer = setInterval(() => {
        const now = new Date().getTime();
        const distance = graduationDate - now;

        if (distance < 0) {
            clearInterval(updateTimer);
            document.getElementById("timer").innerHTML = "Sự kiện đã diễn ra!";
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Thêm số 0 ở trước nếu số nhỏ hơn 10
        document.getElementById("days").innerText = days.toString().padStart(2, '0');
        document.getElementById("hours").innerText = hours.toString().padStart(2, '0');
        document.getElementById("minutes").innerText = minutes.toString().padStart(2, '0');
        document.getElementById("seconds").innerText = seconds.toString().padStart(2, '0');
    }, 1000);

    // Xử lý nút Submit rsvp cho khỏi load lại trang
    document.getElementById('rsvp-form').addEventListener('submit', (e) => {
        e.preventDefault();
        alert("Cảm ơn bạn đã xác nhận tham dự! (Dữ liệu này cần được nối với Backend hoặc Google Sheets để lưu trữ)");
    });
});