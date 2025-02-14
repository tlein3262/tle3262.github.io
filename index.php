<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>Happy Valentine's Day</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Prompt', sans-serif;
            background: linear-gradient(135deg, #ffe6e6, #ffb3b3);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(255, 77, 109, 0.2);
            text-align: center;
            width: 90%;
            max-width: 500px;
            position: relative;
            z-index: 1;
        }

        .heart {
            color: #ff4d6d;
            font-size: 50px;
            animation: pulse 1.5s infinite;
        }

        .button {
            background: linear-gradient(45deg, #ff4d6d, #ff758c);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 25px;
            margin-top: 20px;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 16px;
            font-family: 'Prompt', sans-serif;
            box-shadow: 0 5px 15px rgba(255, 77, 109, 0.3);
        }

        .button:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 8px 20px rgba(255, 77, 109, 0.4);
        }

        .gallery-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #ffe6e6, #ffb3b3);
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.5s;
            z-index: 2;
        }

        .gallery-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        .gallery-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            padding: 20px;
            width: 90%;
            max-width: 1200px;
            max-height: 90vh;
            overflow-y: auto;
        }

        @media (max-width: 1200px) {
            .gallery-container {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 900px) {
            .gallery-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .gallery-container {
                grid-template-columns: 1fr;
            }
        }

        .photo-frame {
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transform: scale(0);
            opacity: 0;
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }

        .photo-frame.show {
            transform: scale(1);
            opacity: 1;
        }

        .photo-frame img {
            width: 100%;
            height: 300px;
            /* เพิ่มความสูงให้มากขึ้น */
            object-fit: cover;
            border-radius: 5px;
            transition: transform 0.3s ease;
        }

        .photo-frame:hover img {
            transform: scale(1.05);
        }

        .photo-caption {
            margin-top: 10px;
            color: #666;
            font-size: 0.9em;
            text-align: center;
        }

        .close-button {
            position: fixed;
            top: 20px;
            right: 20px;
            background: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: #ff4d6d;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 3;
            opacity: 0;
            transition: all 0.3s;
        }

        .close-button.show {
            opacity: 1;
        }

        .close-button:hover {
            transform: scale(1.1);
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.2) rotate(5deg);
            }

            100% {
                transform: scale(1);
            }
        }

        @keyframes frameEntry {
            0% {
                transform: scale(0) rotate(-180deg);
                opacity: 0;
            }

            50% {
                transform: scale(1.2) rotate(5deg);
                opacity: 0.5;
            }

            100% {
                transform: scale(1) rotate(0);
                opacity: 1;
            }
        }

        .sparkle {
            position: absolute;
            pointer-events: none;
            background: white;
            border-radius: 50%;
            box-shadow: 0 0 10px gold;
        }

        .explosion-particle {
            position: fixed;
            pointer-events: none;
            z-index: 100;
            font-size: 24px;
        }

        @keyframes explode {
            0% {
                transform: translate(0, 0) scale(1) rotate(0deg);
                opacity: 1;
            }

            100% {
                transform: translate(var(--tx), var(--ty)) scale(0.1) rotate(var(--rotation));
                opacity: 0;
            }
        }

        .floating-emoji {
            position: fixed;
            font-size: 24px;
            pointer-events: none;
            animation: floatEmoji var(--duration) linear forwards;
            opacity: 0;
        }

        @keyframes floatEmoji {
            0% {
                transform: translateY(100vh) scale(0.5);
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                transform: translateY(-20vh) scale(1.5);
                opacity: 0;
            }
        }
    </style>
</head>

<body>
    <div class="card" id="valentine-card">
        <div class="heart">❤️</div>
        <h1>สุขสันต์วันวาเลนไทน์</h1>
        <p id="random-message">รักเธอที่สุดในโลก ❤️</p>
        <button class="button" onclick="showGallery(event)">กดดูนี้ดิเจ้าหมู 🐷 🐽 🐖 ✨</button>
    </div>

    <div class="gallery-overlay" id="gallery-overlay">
        <button class="close-button" id="close-button" onclick="hideGallery()">×</button>
        <div class="gallery-container" id="gallery">
            <!-- กรอบรูปจะถูกเพิ่มด้วย JavaScript -->
        </div>
    </div>

    <script>
        const photos = [
            { src: "/docs/img3.jpg", caption: "ความทรงจำของเรา 1" },
            { src: "/docs/img2.jpg", caption: "ความทรงจำของเรา 2" },
            { src: "/docs/img4.jpg", caption: "ความทรงจำของเรา 3" },
            { src: "/docs/img5.jpg", caption: "ความทรงจำของเรา 4" },
            { src: "/docs/img6.jpg", caption: "ความทรงจำของเรา 5" },
            { src: "/docs/img7.jpg", caption: "ความทรงจำของเรา 6" },
            { src: "/docs/img1.jpg", caption: "ความทรงจำของเรา 7" },
            { src: "/docs/img8.jpg", caption: "ความทรงจำของเรา 8" }
        ];

        function createPhotoFrame(photo, index) {
            const frame = document.createElement('div');
            frame.className = 'photo-frame';
            frame.innerHTML = `
                <img src="${photo.src}" alt="Photo ${index + 1}">
                <p class="photo-caption">${photo.caption}</p>
            `;
            return frame;
        }

        function createExplosionParticle(x, y, emoji) {
            const particle = document.createElement('div');
            particle.className = 'explosion-particle';
            particle.textContent = emoji;
            particle.style.left = x + 'px';
            particle.style.top = y + 'px';

            const angle = Math.random() * Math.PI * 2;
            const distance = 100 + Math.random() * 150;
            const tx = Math.cos(angle) * distance;
            const ty = Math.sin(angle) * distance;
            const rotation = Math.random() * 720 - 360;

            particle.style.setProperty('--tx', `${tx}px`);
            particle.style.setProperty('--ty', `${ty}px`);
            particle.style.setProperty('--rotation', `${rotation}deg`);
            particle.style.animation = `explode ${0.5 + Math.random() * 0.5}s cubic-bezier(.17,.67,.83,.67) forwards`;

            document.body.appendChild(particle);
            setTimeout(() => particle.remove(), 1500);
        }

        function createSparkle(x, y) {
            const sparkle = document.createElement('div');
            sparkle.className = 'sparkle';
            sparkle.style.left = x + 'px';
            sparkle.style.top = y + 'px';
            sparkle.style.width = Math.random() * 10 + 'px';
            sparkle.style.height = sparkle.style.width;
            sparkle.style.animation = 'twinkle 0.8s linear forwards';

            document.body.appendChild(sparkle);
            setTimeout(() => sparkle.remove(), 800);
        }

        function showGallery(event) {
            const rect = event.target.getBoundingClientRect();
            const centerX = rect.left + rect.width / 2;
            const centerY = rect.top + rect.height / 2;

            // สร้างเอฟเฟกต์ระเบิด
            const emojis = ['✨', '💫', '⭐️', '🌟'];
            for (let i = 0; i < 30; i++) {
                setTimeout(() => {
                    const emoji = emojis[Math.floor(Math.random() * emojis.length)];
                    createExplosionParticle(centerX, centerY, emoji);
                    createSparkle(
                        centerX + (Math.random() - 0.5) * 400,
                        centerY + (Math.random() - 0.5) * 400
                    );
                }, i * 50);
            }

            // แสดง gallery
            const galleryOverlay = document.getElementById('gallery-overlay');
            const gallery = document.getElementById('gallery');
            const closeButton = document.getElementById('close-button');

            gallery.innerHTML = ''; // เคลียร์ gallery เดิม
            galleryOverlay.classList.add('show');
            closeButton.classList.add('show');

            // แสดงรูปภาพทีละรูป
            photos.forEach((photo, index) => {
                const frame = createPhotoFrame(photo, index);
                gallery.appendChild(frame);

                setTimeout(() => {
                    frame.style.animation = `frameEntry 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards`;
                    frame.classList.add('show');
                }, index * 200);
            });
        }

        function hideGallery() {
            const galleryOverlay = document.getElementById('gallery-overlay');
            const closeButton = document.getElementById('close-button');
            galleryOverlay.classList.remove('show');
            closeButton.classList.remove('show');
        }

        // เพิ่มเอฟเฟกต์ hover ให้การ์ด
        const card = document.getElementById('valentine-card');
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            const centerX = rect.width / 2;
            const centerY = rect.height / 2;

            const rotateX = (y - centerY) / 20;
            const rotateY = -(x - centerX) / 20;

            card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.02, 1.02, 1.02)`;
        });

        card.addEventListener('mouseleave', () => {
            card.style.transform = '';
        });

        // เพิ่มต่อจาก script เดิม
        const backgroundEmojis = ['❤️', '🐷', '🐽', '🐖', '💕', '💝', '💖', '✨'];

        function createFloatingEmoji() {
            const emoji = document.createElement('div');
            emoji.className = 'floating-emoji';
            emoji.textContent = backgroundEmojis[Math.floor(Math.random() * backgroundEmojis.length)];

            // สุ่มตำแหน่งแกน x
            const x = Math.random() * window.innerWidth;
            emoji.style.left = `${x}px`;

            // สุ่มความเร็วในการลอย
            const duration = 4 + Math.random() * 4;
            emoji.style.setProperty('--duration', `${duration}s`);

            document.body.appendChild(emoji);
            setTimeout(() => emoji.remove(), duration * 1000);
        }

        // เริ่มสร้างอิโมจิทุกๆ 1 วินาที
        setInterval(createFloatingEmoji, 1000);
    </script>
</body>

</html>
