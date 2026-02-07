<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding RIN & THÚY | CineLove</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Dancing+Script:wght@400;500;600;700&family=Cormorant+Garamond:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --gold: #d4af37;
            --rose-gold: #b76e79;
            --ivory: #fffff0;
            --champagne: #f7e7ce;
            --dark-brown: #5d4037;
            --light-pink: #f8bbd9;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Cormorant Garamond', serif;
            background: linear-gradient(135deg, #fdf6e3 0%, #fffaf0 100%);
            color: var(--dark-brown);
            line-height: 1.8;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            overflow-x: hidden;
            position: relative;
        }

        /* Background Particles */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .particle {
            position: absolute;
            width: 3px;
            height: 3px;
            background: var(--gold);
            border-radius: 50%;
            opacity: 0.5;
            animation: floatParticle 20s infinite linear;
        }

        @keyframes floatParticle {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 0.7;
            }
            90% {
                opacity: 0.7;
            }
            100% {
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }

        .wedding-card {
            width: 100%;
            max-width: 450px;
            background: var(--ivory);
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 25px 60px rgba(139, 69, 19, 0.25);
            position: relative;
            z-index: 2;
            border: 1px solid rgba(212, 175, 55, 0.2);
        }

        /* Header with Parallax */
        .header {
            background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), 
                        url('https://images.unsplash.com/photo-1519225421980-715cb0215aed?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            padding: 40px 20px 30px;
            text-align: center;
            position: relative;
            min-height: 350px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .header-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, rgba(0,0,0,0.4), rgba(0,0,0,0.2));
            z-index: 1;
        }

        .header-content {
            position: relative;
            z-index: 2;
        }

        .wedding-title {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            font-weight: 700;
            letter-spacing: 4px;
            color: var(--ivory);
            margin-bottom: 15px;
            text-transform: uppercase;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
            animation: titleGlow 3s ease-in-out infinite alternate;
        }

        @keyframes titleGlow {
            from {
                text-shadow: 2px 2px 4px rgba(0,0,0,0.5), 0 0 10px rgba(212, 175, 55, 0.3);
            }
            to {
                text-shadow: 2px 2px 4px rgba(0,0,0,0.5), 0 0 20px rgba(212, 175, 55, 0.6);
            }
        }

        /* Main Photo Gallery */
        .photo-gallery {
            position: relative;
            padding: 20px;
        }

        .main-photo {
            width: 320px;
            height: 320px;
            margin: 0 auto 30px;
            border-radius: 50%;
            overflow: hidden;
            border: 8px solid var(--champagne);
            box-shadow: 0 15px 40px rgba(183, 110, 121, 0.3);
            position: relative;
            animation: photoFloat 6s ease-in-out infinite;
        }

        @keyframes photoFloat {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(1deg); }
        }

        .main-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .main-photo:hover img {
            transform: scale(1.1);
        }

        .photo-frame {
            position: absolute;
            width: 50px;
            height: 50px;
            border: 3px solid var(--gold);
            border-radius: 10px;
            background: white;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .photo-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .frame-1 { top: 20px; left: 20px; animation: frameFloat1 7s infinite; }
        .frame-2 { top: 20px; right: 20px; animation: frameFloat2 8s infinite; }
        .frame-3 { bottom: 20px; left: 20px; animation: frameFloat3 9s infinite; }
        .frame-4 { bottom: 20px; right: 20px; animation: frameFloat4 6.5s infinite; }

        @keyframes frameFloat1 {
            0%, 100% { transform: translateY(0) rotate(-5deg); }
            50% { transform: translateY(-10px) rotate(5deg); }
        }
        @keyframes frameFloat2 {
            0%, 100% { transform: translateY(0) rotate(5deg); }
            50% { transform: translateY(-10px) rotate(-5deg); }
        }
        @keyframes frameFloat3 {
            0%, 100% { transform: translateY(0) rotate(3deg); }
            50% { transform: translateY(-10px) rotate(-3deg); }
        }
        @keyframes frameFloat4 {
            0%, 100% { transform: translateY(0) rotate(-3deg); }
            50% { transform: translateY(-10px) rotate(3deg); }
        }

        .photo-frame:hover {
            transform: scale(1.3) rotate(15deg);
            z-index: 10;
        }

        .couple-info {
            text-align: center;
            padding: 20px;
            margin-top: 20px;
        }

        .couple-name {
            font-family: 'Dancing Script', cursive;
            font-size: 2.8rem;
            font-weight: 600;
            color: var(--rose-gold);
            margin: 15px 0;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
            animation: nameGlow 2s ease-in-out infinite alternate;
        }

        @keyframes nameGlow {
            from { text-shadow: 1px 1px 2px rgba(0,0,0,0.1); }
            to { text-shadow: 1px 1px 2px rgba(0,0,0,0.1), 0 0 15px rgba(183, 110, 121, 0.4); }
        }

        /* Timeline Section */
        .timeline-section {
            padding: 40px 20px;
            background: linear-gradient(to bottom, var(--ivory), #fffaf0);
        }

        .timeline {
            position: relative;
            max-width: 300px;
            margin: 0 auto;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 2px;
            height: 100%;
            background: linear-gradient(to bottom, var(--gold), var(--rose-gold), var(--gold));
        }

        .timeline-item {
            position: relative;
            margin-bottom: 40px;
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .timeline-item.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .timeline-item:nth-child(odd) {
            text-align: right;
            padding-right: 60px;
        }

        .timeline-item:nth-child(even) {
            text-align: left;
            padding-left: 60px;
        }

        .timeline-dot {
            position: absolute;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: var(--gold);
            border: 3px solid white;
            box-shadow: 0 0 10px var(--gold);
            top: 50%;
            transform: translateY(-50%);
        }

        .timeline-item:nth-child(odd) .timeline-dot {
            right: -9px;
        }

        .timeline-item:nth-child(even) .timeline-dot {
            left: -9px;
        }

        .timeline-content {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border: 1px solid rgba(212, 175, 55, 0.1);
            transition: transform 0.3s ease;
        }

        .timeline-content:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }

        .timeline-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            color: var(--dark-brown);
            margin-bottom: 10px;
            font-weight: 600;
        }

        .timeline-image {
            width: 100%;
            height: 150px;
            border-radius: 10px;
            overflow: hidden;
            margin: 15px 0;
        }

        .timeline-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .timeline-image:hover img {
            transform: scale(1.05);
        }

        /* Love Story Section */
        .love-story {
            padding: 40px 20px;
            background: linear-gradient(45deg, var(--light-pink) 0%, var(--champagne) 100%);
            position: relative;
            overflow: hidden;
        }

        .story-flower {
            position: absolute;
            font-size: 3rem;
            color: var(--rose-gold);
            opacity: 0.1;
            animation: flowerFloat 20s infinite linear;
        }

        @keyframes flowerFloat {
            0% { transform: translateY(100px) rotate(0deg); }
            100% { transform: translateY(-100px) rotate(360deg); }
        }

        .story-content {
            position: relative;
            z-index: 1;
            text-align: center;
            max-width: 600px;
            margin: 0 auto;
        }

        .story-title {
            font-family: 'Dancing Script', cursive;
            font-size: 3rem;
            color: var(--rose-gold);
            margin-bottom: 30px;
            font-weight: 700;
        }

        .story-images {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin: 30px 0;
        }

        .story-img {
            height: 120px;
            border-radius: 15px;
            overflow: hidden;
            position: relative;
            cursor: pointer;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .story-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .story-img:hover {
            transform: scale(1.1) rotate(5deg);
            z-index: 2;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }

        /* Invitation Card */
        .invitation-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            margin: 40px 20px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.15);
            border: 2px solid var(--gold);
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
            perspective: 1000px;
        }

        .invitation-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(212, 175, 55, 0.1), transparent);
            transform: rotate(45deg);
            animation: shine 3s infinite linear;
        }

        @keyframes shine {
            0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
        }

        .invitation-content {
            position: relative;
            z-index: 1;
        }

        .invitation-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            color: var(--dark-brown);
            text-align: center;
            margin-bottom: 25px;
            font-weight: 700;
            letter-spacing: 2px;
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin: 25px 0;
        }

        .detail-item {
            text-align: center;
            padding: 20px;
            background: var(--ivory);
            border-radius: 15px;
            border: 1px solid rgba(212, 175, 55, 0.2);
            transition: all 0.3s ease;
        }

        .detail-item:hover {
            background: linear-gradient(135deg, var(--champagne), var(--ivory));
            transform: translateY(-5px);
        }

        .detail-icon {
            font-size: 2.5rem;
            color: var(--gold);
            margin-bottom: 10px;
        }

        .detail-text {
            font-size: 1.1rem;
            color: var(--dark-brown);
            line-height: 1.6;
        }

        /* Interactive Elements */
        .interactive-section {
            padding: 40px 20px;
            text-align: center;
        }

        .wish-container {
            background: white;
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.1);
            border: 2px dashed var(--rose-gold);
        }

        .wish-input {
            width: 100%;
            min-height: 100px;
            padding: 15px;
            border: 2px solid var(--champagne);
            border-radius: 15px;
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.2rem;
            resize: vertical;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .wish-input:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.2);
        }

        .send-wish-btn {
            background: linear-gradient(135deg, var(--gold), var(--rose-gold));
            color: white;
            border: none;
            padding: 15px 40px;
            border-radius: 30px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Playfair Display', serif;
            letter-spacing: 1px;
        }

        .send-wish-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(183, 110, 121, 0.4);
            background: linear-gradient(135deg, var(--rose-gold), var(--gold));
        }

        /* Footer */
        .footer {
            padding: 40px 20px;
            background: linear-gradient(135deg, var(--dark-brown) 0%, #3e2723 100%);
            color: var(--champagne);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(to right, transparent, var(--gold), transparent);
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 30px 0;
        }

        .social-icon {
            width: 50px;
            height: 50px;
            background: rgba(212, 175, 55, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold);
            font-size: 1.5rem;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .social-icon:hover {
            background: var(--gold);
            color: var(--dark-brown);
            transform: translateY(-5px) rotate(10deg);
        }

        /* Music Player Enhanced */
        .music-player {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--gold), var(--rose-gold));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 1000;
            box-shadow: 0 10px 30px rgba(183, 110, 121, 0.4);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .music-player:hover {
            transform: scale(1.1) rotate(10deg);
            box-shadow: 0 15px 40px rgba(183, 110, 121, 0.6);
        }

        .music-icon {
            color: white;
            font-size: 1.5rem;
            animation: musicPulse 2s infinite;
        }

        .music-icon.playing {
            animation: rotate 5s linear infinite, musicPulse 2s infinite;
        }

        @keyframes musicPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .wedding-card {
                max-width: 95%;
                border-radius: 20px;
            }

            .main-photo {
                width: 250px;
                height: 250px;
            }

            .story-images {
                grid-template-columns: repeat(2, 1fr);
            }

            .details-grid {
                grid-template-columns: 1fr;
            }

            .timeline::before {
                left: 30px;
            }

            .timeline-item {
                padding-left: 60px;
                padding-right: 0;
                text-align: left;
            }

            .timeline-item:nth-child(odd),
            .timeline-item:nth-child(even) {
                padding-left: 60px;
                padding-right: 0;
                text-align: left;
            }

            .timeline-item:nth-child(odd) .timeline-dot,
            .timeline-item:nth-child(even) .timeline-dot {
                left: 21px;
                right: auto;
            }
        }

        @media (max-width: 480px) {
            .wedding-title {
                font-size: 2.5rem;
            }

            .couple-name {
                font-size: 2.2rem;
            }

            .story-images {
                grid-template-columns: 1fr;
            }

            .main-photo {
                width: 200px;
                height: 200px;
            }

            .photo-frame {
                width: 40px;
                height: 40px;
            }
        }
    </style>
</head>
<body>
    <!-- Background Particles -->
    <div class="particles" id="particles"></div>

    <!-- Music Player -->
    <div class="music-player" id="musicPlayer">
        <i class="fas fa-music music-icon" id="musicIcon"></i>
    </div>

    <div class="wedding-card">
        <!-- Header -->
        <div class="header">
            <div class="header-overlay"></div>
            <div class="header-content">
                <h1 class="wedding-title">WEDDING</h1>
                <div class="date-large" style="color: var(--ivory); font-size: 2rem; margin-bottom: 10px;">
                    20/03/2026
                </div>
                <div class="lunar-date" style="color: var(--champagne); font-size: 1.2rem;">
                    (02/02/2026 Âm lịch)
                </div>
            </div>
        </div>

        <!-- Photo Gallery -->
        <div class="photo-gallery">
            <div class="main-photo">
                <img src="https://img.cinelove.me/uploads/3eec4509-4df7-491a-9d7f-62d3acc79d9e/e0a3fb6a-d035-4dac-ba61-2b02544e8971.jpg?resize=1000x" 
                     alt="Hoàng Rin & Thanh Thúy">
                
                <!-- Decorative Photo Frames -->
                <div class="photo-frame frame-1">
                    <img src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80" alt="Memory 1">
                </div>
                <div class="photo-frame frame-2">
                    <img src="https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80" alt="Memory 2">
                </div>
                <div class="photo-frame frame-3">
                    <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80" alt="Memory 3">
                </div>
                <div class="photo-frame frame-4">
                    <img src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80" alt="Memory 4">
                </div>
            </div>

            <div class="couple-info">
                <h2 class="couple-name">Hoàng Rin ❤️ Thanh Thúy</h2>
                <div class="invitation-label" style="background: linear-gradient(135deg, var(--gold), var(--rose-gold)); color: white; padding: 12px 40px; border-radius: 30px; font-size: 1.3rem; letter-spacing: 2px; display: inline-block;">
                    WEDDING INVITATION
                </div>
            </div>
        </div>

        <!-- Timeline -->
        <div class="timeline-section">
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h3 class="timeline-title">Lễ Thành Hôn</h3>
                        <p style="color: var(--dark-brown); margin-bottom: 15px;">
                            ⏰ 10:30 Sáng<br>
                            📅 Thứ Sáu, 20/03/2026<br>
                            🏠 Tư Gia Nhà Trai
                        </p>
                        <div class="timeline-image">
                            <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80" alt="Venue">
                        </div>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h3 class="timeline-title">Tiệc Cưới</h3>
                        <p style="color: var(--dark-brown); margin-bottom: 15px;">
                            ⏰ 18:30 Tối<br>
                            📅 Thứ Sáu, 20/03/2026<br>
                            🏨 Nhà Hàng Royal Palace
                        </p>
                        <div class="timeline-image">
                            <img src="https://images.unsplash.com/photo-1519167758481-83f550bb49b3?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80" alt="Reception">
                        </div>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h3 class="timeline-title">Yêu</h3>
                        <p style="color: var(--dark-brown); font-style: italic; font-size: 1.2rem;">
                            "Môi hôn ngọt ngào, như hoa nở,<br>
                            Trái tim rộn ràng, nhịp yêu vương."
                        </p>
                        <div class="timeline-image">
                            <img src="https://images.unsplash.com/photo-1511988617509-a57c8a288659?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80" alt="Love">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Love Story -->
        <div class="love-story">
            <!-- Floating Flowers -->
            <div class="story-flower" style="top: 10%; left: 5%;">🌸</div>
            <div class="story-flower" style="top: 20%; right: 10%;">🌺</div>
            <div class="story-flower" style="bottom: 30%; left: 15%;">🌹</div>
            <div class="story-flower" style="bottom: 10%; right: 20%;">💐</div>

            <div class="story-content">
                <h2 class="story-title">Câu Chuyện Tình Yêu</h2>
                
                <p style="color: var(--dark-brown); font-size: 1.3rem; margin-bottom: 30px; line-height: 2;">
                    Hôm nay anh học toán hình,<br>
                    Tròn vuông chẳng có, toàn hình bóng em...
                </p>

                <div class="story-images">
                    <div class="story-img">
                        <img src="https://images.unsplash.com/photo-1511988617509-a57c8a288659?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80" alt="Love Story 1">
                    </div>
                    <div class="story-img">
                        <img src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?ixlib=rb-1.2.1&auto=format&fit=crop&w-400&q=80" alt="Love Story 2">
                    </div>
                    <div class="story-img">
                        <img src="https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80" alt="Love Story 3">
                    </div>
                </div>

                <p style="color: var(--dark-brown); font-size: 1.3rem; margin-top: 30px; font-style: italic;">
                    Thương anh mấy núi cũng trèo,<br>
                    Mấy sông cũng lội, mấy đèo cũng qua.<br>
                    Thương anh không quản chi xa,<br>
                    Đá vàng cũng quyết, phong ba cũng liều.
                </p>
            </div>
        </div>

        <!-- Invitation Card -->
        <div class="invitation-card">
            <div class="invitation-content">
                <h2 class="invitation-title">Thông Tin Chi Tiết</h2>
                
                <div class="details-grid">
                    <div class="detail-item">
                        <div class="detail-icon">📅</div>
                        <div class="detail-text">
                            <strong>Ngày Cưới</strong><br>
                            20/03/2026<br>
                            (02/02/2026 ÂL)
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-icon">⏰</div>
                        <div class="detail-text">
                            <strong>Giờ Tổ Chức</strong><br>
                            10:30 - Lễ Thành Hôn<br>
                            18:30 - Tiệc Cưới
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-icon">📍</div>
                        <div class="detail-text">
                            <strong>Địa Điểm</strong><br>
                            Tư Gia Nhà Trai<br>
                            Nhà Hàng Royal Palace
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-icon">👰‍♀️🤵‍♂️</div>
                        <div class="detail-text">
                            <strong>Cặp Đôi</strong><br>
                            Hoàng Rin<br>
                            &<br>
                            Thanh Thúy
                        </div>
                    </div>
                </div>

                <div style="text-align: center; margin-top: 30px;">
                    <div style="font-size: 1.8rem; color: var(--rose-gold); margin-bottom: 15px;">
                        Rất hi vọng bạn sẽ có mặt
                    </div>
                    <p style="color: var(--dark-brown); font-size: 1.2rem;">
                        trong ngày trọng đại này của chúng mình nha!
                    </p>
                    <div style="font-size: 2rem; color: var(--gold); margin-top: 20px; font-family: 'Dancing Script', cursive;">
                        Thương nhiều!
                    </div>
                </div>
            </div>
        </div>

        <!-- Interactive Section -->
        <div class="interactive-section">
            <div class="wish-container">
                <h2 style="color: var(--dark-brown); margin-bottom: 25px; font-family: 'Playfair Display', serif;">
                    Gửi Lời Chúc Đến Đôi Trẻ
                </h2>
                <textarea class="wish-input" placeholder="Viết lời chúc của bạn ở đây..."></textarea>
                <button class="send-wish-btn">
                    <i class="fas fa-paper-plane"></i> Gửi Lời Chúc
                </button>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div style="margin-bottom: 30px;">
                <div style="font-size: 1.5rem; color: var(--gold); margin-bottom: 15px;">
                    Chia Sẻ Khoảnh Khắc
                </div>
                <div class="social-links">
                    <div class="social-icon">
                        <i class="fab fa-facebook-f"></i>
                    </div>
                    <div class="social-icon">
                        <i class="fab fa-instagram"></i>
                    </div>
                    <div class="social-icon">
                        <i class="fab fa-tiktok"></i>
                    </div>
                    <div class="social-icon">
                        <i class="fas fa-camera"></i>
                    </div>
                </div>
            </div>

            <div style="color: var(--champagne); font-size: 1rem; opacity: 0.8;">
                Made with <i class="fas fa-heart" style="color: var(--rose-gold); margin: 0 5px;"></i> by CineLove
            </div>
        </div>
    </div>

    <!-- Audio -->
    <audio id="backgroundMusic" loop autoplay>
        <source src="assets/nhac.mp3" type="audio/mpeg">
    </audio>

    <script>
        // Create Particles
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 50;
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                
                // Random position
                particle.style.left = Math.random() * 100 + 'vw';
                particle.style.animationDelay = Math.random() * 20 + 's';
                
                // Random size
                const size = Math.random() * 4 + 1;
                particle.style.width = size + 'px';
                particle.style.height = size + 'px';
                
                // Random opacity
                particle.style.opacity = Math.random() * 0.6 + 0.1;
                
                particlesContainer.appendChild(particle);
            }
        }

        // Timeline Animation
        function animateTimeline() {
            const timelineItems = document.querySelectorAll('.timeline-item');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, {
                threshold: 0.2
            });
            
            timelineItems.forEach(item => observer.observe(item));
        }

        // Music Player with Autoplay
        const musicPlayer = document.getElementById('musicPlayer');
        const musicIcon = document.getElementById('musicIcon');
        const audio = document.getElementById('backgroundMusic');
        let isPlaying = false;

        // Enhanced autoplay with multiple triggers
        function playMusic() {
            if (!isPlaying) {
                audio.play().then(() => {
                    isPlaying = true;
                    musicIcon.classList.add('playing');
                    removeListeners();
                }).catch(error => {
                    console.log("Waiting for interaction to play music...");
                });
            }
        }

        function triggerPlay() { playMusic(); }
        function removeListeners() {
            document.removeEventListener('click', triggerPlay);
            document.removeEventListener('touchstart', triggerPlay);
            document.removeEventListener('scroll', triggerPlay);
            document.removeEventListener('mousemove', triggerPlay);
            document.removeEventListener('keydown', triggerPlay);
        }

        // Multiple interaction triggers
        document.addEventListener('click', triggerPlay);
        document.addEventListener('touchstart', triggerPlay);
        document.addEventListener('scroll', triggerPlay);
        document.addEventListener('mousemove', triggerPlay);
        document.addEventListener('keydown', triggerPlay);

        // Music player click handler
        musicPlayer.addEventListener('click', function(e) {
            e.stopPropagation();
            if (isPlaying) {
                audio.pause();
                musicIcon.classList.remove('playing');
                isPlaying = false;
            } else {
                audio.play();
                musicIcon.classList.add('playing');
                isPlaying = true;
            }
        });

        // Enhanced falling hearts effect
        function createFallingHeart() {
            const heart = document.createElement('div');
            heart.innerHTML = '<i class="fas fa-heart"></i>';
            
            heart.style.position = 'fixed';
            heart.style.top = '-50px';
            heart.style.left = Math.random() * 100 + 'vw';
            
            const colors = ['#e6a4a4', '#ffb6c1', '#f08080', '#ffc0cb', '#d8b089', '#ff9999'];
            heart.style.color = colors[Math.floor(Math.random() * colors.length)];
            
            heart.style.opacity = Math.random() * 0.8 + 0.2;
            heart.style.fontSize = Math.random() * 25 + 12 + 'px';
            heart.style.zIndex = '999';
            heart.style.pointerEvents = 'none';
            heart.style.textShadow = '0 2px 10px rgba(0,0,0,0.2)';
            
            const duration = Math.random() * 4 + 3;
            heart.style.transition = `all ${duration}s cubic-bezier(0.4, 0, 0.2, 1)`;
            
            document.body.appendChild(heart);

            setTimeout(() => {
                const sideMovement = Math.random() * 200 - 100;
                heart.style.transform = `translateY(120vh) translateX(${sideMovement}px) rotate(${Math.random() * 720}deg) scale(${Math.random() * 0.5 + 0.5})`;
                heart.style.opacity = '0';
            }, 50);

            setTimeout(() => { heart.remove(); }, duration * 1000);
        }

        // Create falling hearts continuously
        setInterval(createFallingHeart, 200);

        // Interactive heart button
        document.querySelector('.send-wish-btn').addEventListener('click', function() {
            const wishInput = document.querySelector('.wish-input');
            if (wishInput.value.trim()) {
                // Create celebration hearts
                for (let i = 0; i < 30; i++) {
                    setTimeout(createFallingHeart, i * 100);
                }
                
                // Show confirmation
                alert('Cảm ơn bạn đã gửi lời chúc đến Hoàng Rin & Thanh Thúy! ❤️');
                wishInput.value = '';
                
                // Add confetti effect
                createConfetti();
            } else {
                alert('Vui lòng nhập lời chúc của bạn!');
            }
        });

        // Confetti effect
        function createConfetti() {
            const colors = ['#e6a4a4', '#ffb6c1', '#f08080', '#d4af37', '#b76e79'];
            for (let i = 0; i < 50; i++) {
                setTimeout(() => {
                    const confetti = document.createElement('div');
                    confetti.innerHTML = ['✨', '🎉', '🎊', '💖', '🌸'][Math.floor(Math.random() * 5)];
                    confetti.style.position = 'fixed';
                    confetti.style.top = '50%';
                    confetti.style.left = '50%';
                    confetti.style.fontSize = Math.random() * 20 + 15 + 'px';
                    confetti.style.color = colors[Math.floor(Math.random() * colors.length)];
                    confetti.style.zIndex = '1000';
                    confetti.style.pointerEvents = 'none';
                    confetti.style.transform = 'translate(-50%, -50%)';
                    
                    document.body.appendChild(confetti);
                    
                    const angle = Math.random() * Math.PI * 2;
                    const velocity = 2 + Math.random() * 3;
                    const gravity = 0.05;
                    let vx = Math.cos(angle) * velocity;
                    let vy = Math.sin(angle) * velocity;
                    let x = 50;
                    let y = 50;
                    
                    function animate() {
                        x += vx;
                        y += vy;
                        vy += gravity;
                        
                        confetti.style.left = x + '%';
                        confetti.style.top = y + '%';
                        confetti.style.opacity = 1 - (y / 100);
                        
                        if (y < 100) {
                            requestAnimationFrame(animate);
                        } else {
                            confetti.remove();
                        }
                    }
                    
                    animate();
                }, i * 50);
            }
        }

        // Image hover zoom effect
        document.querySelectorAll('.story-img').forEach(img => {
            img.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.2) rotate(3deg)';
            });
            img.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1) rotate(0deg)';
            });
        });

        // Initialize everything
        window.addEventListener('load', function() {
            createParticles();
            animateTimeline();
            playMusic(); // Try to play music on load
            
            // Add smooth scroll to timeline
            document.querySelectorAll('.timeline-item').forEach((item, index) => {
                item.style.transitionDelay = (index * 0.2) + 's';
            });
            
            // Add page load animation
            document.querySelector('.wedding-card').style.animation = 'cardAppear 1s ease-out';
            const style = document.createElement('style');
            style.textContent = `
                @keyframes cardAppear {
                    from {
                        opacity: 0;
                        transform: translateY(50px) scale(0.9);
                    }
                    to {
                        opacity: 1;
                        transform: translateY(0) scale(1);
                    }
                }
            `;
            document.head.appendChild(style);
        });

        // Social icons interaction
        document.querySelectorAll('.social-icon').forEach(icon => {
            icon.addEventListener('click', function() {
                this.style.animation = 'socialBounce 0.5s ease';
                setTimeout(() => {
                    this.style.animation = '';
                }, 500);
            });
        });

        // Add bounce animation for social icons
        const bounceStyle = document.createElement('style');
        bounceStyle.textContent = `
            @keyframes socialBounce {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-10px); }
            }
        `;
        document.head.appendChild(bounceStyle);
    </script>
</body>
</html>