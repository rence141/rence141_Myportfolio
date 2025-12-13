<?php
// Configuration
$main_portfolio = "portfolio.php"; 
$profile_image = "https://scontent.fmnl3-2.fna.fbcdn.net/v/t39.30808-6/475635881_1306306950496192_645015941813715254_n.jpg?_nc_cat=105&ccb=1-7&_nc_sid=a5f93a&_nc_eui2=AeFrQXcu6hzt4SCwnsa0-8nIL9x1e9THidIv3HV71MeJ0lM6PCYyzK7G3--lvXqnEtJzD5faR2XF33rruoUfxESo&_nc_ohc=dfJLvhuTeowQ7kNvwGjZruW&_nc_oc=Adl9J_hLWcsOLauWgAeQrTURhXoXRfRoTJhWhaGbm9GLX4K5q6QdY5bplJi88BaPYcE&_nc_zt=23&_nc_ht=scontent.fmnl3-2.fna&_nc_gid=1bnrjZPJPDKanq2REEsXNQ&oh=00_Afkq_TvNwqXke9GN-7e7Gl-xtIXrhYlJDQVZrZDq8YdpbA&oe=69420562";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rence | Full Stack Developer</title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;700;900&family=Inter:wght@400;600&family=Playfair+Display:ital@1&family=VT323&family=Permanent+Marker&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --primary: #4F46E5;
            --primary-glow: rgba(79, 70, 229, 0.4);
            --bg-dark: #020617;
            --text-main: #f1f5f9;
            --glass: rgba(15, 23, 42, 0.6);
            --border: rgba(255, 255, 255, 0.08);
            --gradient-main: linear-gradient(135deg, #4f46e5, #9333ea);
            
            /* --- TYPOGRAPHY --- */
            --hero-font: clamp(2.5rem, 8vw, 6rem); 
            --side-font: clamp(1.5rem, 5vw, 4rem);
            
            --anim-speed: 1s;
            --anim-ease: cubic-bezier(0.77, 0, 0.175, 1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        html, body {
            width: 100%;
            height: 100%;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-dark);
            color: var(--text-main);
            /* Allow vertical scrolling */
            overflow-x: hidden; 
            overflow-y: auto; 
        }

        /* --- LAYOUT CONTAINER --- */
        .split-container {
            position: relative;
            width: 100%;
            height: 100vh; /* Default to viewport height on desktop */
            display: flex;
            overflow: hidden; /* Desktop: keep hidden, internal scroll handled differently */
        }

        /* --- LEFT ZONE (PROFILE) --- */
        .left-zone {
            width: 60%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 10;
        }

        .profile-card {
            background: var(--glass);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 3rem;
            width: 85%;
            max-width: 450px;
            text-align: center;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            opacity: 0;
            transform: translateX(-30px);
            transition: all 1s cubic-bezier(0.34, 1.56, 0.64, 1);
            position: relative;
            z-index: 60;
        }

        .profile-card.active { opacity: 1; transform: translateX(0); }

        /* --- RIGHT ZONE (ANIMATION BANNER) --- */
        .right-zone {
            position: absolute;
            right: 0;
            top: 0;
            height: 100%;
            width: 0%; 
            background: var(--gradient-main);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 20;
            overflow: hidden; 
            transition: all var(--anim-speed) var(--anim-ease);
        }

        /* Desktop Animation States */
        .right-zone.enter { width: 40%; }
        .right-zone.full { width: 100%; }

        /* --- ANIMATED TEXT --- */
        .font-cycler-container {
            font-size: var(--hero-font);
            font-family: 'Space Grotesk', monospace;
            line-height: 1.1;
            font-weight: 700;
            text-align: center;
            opacity: 0;
            color: #000; 
            white-space: nowrap; 
            transition: opacity 0.1s linear, color 0.8s ease;
            position: relative;
            padding: 0 20px;
            max-width: 100%;
        }
        
        .font-cycler-container.show { opacity: 1; }
        
        .font-cycler-container.glitch-mode {
            color: #ffffff; 
            mix-blend-mode: overlay; 
            opacity: 0.9;
            font-size: var(--side-font);
            white-space: normal; 
            word-wrap: break-word;
        }

        /* --- LOADER & LAYERS --- */
        .intro-loader { position: fixed; inset: 0; background: #000; z-index: 5; transition: opacity 0.8s ease; pointer-events: none; }
        .intro-loader.hidden { opacity: 0; }

        .type-text-base {
            font-family: 'Space Grotesk', monospace;
            font-size: var(--hero-font);
            font-weight: 700;
            line-height: 1.1;
            white-space: nowrap;
        }

        .text-layer-white {
            position: fixed; inset: 0; z-index: 30; color: white; pointer-events: none;
            display: flex; align-items: center; justify-content: center;
            transition: opacity 0.2s linear;
        }

        .text-layer-black-wrapper {
            position: fixed; inset: 0; z-index: 31; pointer-events: none;
            display: flex; align-items: center; justify-content: center;
            /* Desktop Wipe: Right to Left */
            clip-path: inset(0 0 0 100%);
            transition: clip-path var(--anim-speed) var(--anim-ease), opacity 0.2s linear;
        }
        
        .text-layer-black-wrapper.enter { clip-path: inset(0 0 0 60%); }
        .text-layer-black-wrapper.full { clip-path: inset(0 0 0 0%); }
        
        .type-text-black { color: black; }
        .cursor-bar { display: inline-block; width: 5px; height: 1em; background: var(--primary); margin-left: 10px; animation: blinkCursor 0.75s step-end infinite; }
        .fade-out { opacity: 0 !important; }
        @keyframes blinkCursor { 50% { opacity: 0; } }

        /* Scroll Down Indicator (Hidden on Desktop) */
        .scroll-down {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            color: white;
            font-size: 2rem;
            animation: bounce 2s infinite;
            display: none; /* Desktop hidden */
            z-index: 100;
            opacity: 0;
            transition: opacity 1s ease;
        }
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {transform: translateX(-50%) translateY(0);}
            40% {transform: translateX(-50%) translateY(-20px);}
            60% {transform: translateX(-50%) translateY(-10px);}
        }

        /* --- ASSETS --- */
        .avatar { width: 120px; height: 120px; border-radius: 50%; border: 3px solid var(--primary); margin-bottom: 1.5rem; object-fit: cover; box-shadow: 0 0 20px var(--primary-glow); }
        .name { font-family: 'Space Grotesk', sans-serif; font-size: 2rem; font-weight: 700; margin-bottom: 0.5rem; background: linear-gradient(90deg, var(--text-main), var(--primary)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .role { color: var(--primary); font-weight: 600; background: rgba(79, 70, 229, 0.1); padding: 0.25rem 1rem; border-radius: 20px; display: inline-block; margin-bottom: 1.5rem; }
        .tech-stack { display: flex; justify-content: center; gap: 15px; margin-bottom: 2rem; font-size: 1.4rem; opacity: 0.8; }
        .cta-btn { display: inline-block; background: var(--primary); color: white; padding: 12px 30px; border-radius: 8px; text-decoration: none; font-weight: 600; transition: 0.3s; box-shadow: 0 4px 15px var(--primary-glow); }
        .cta-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 25px var(--primary-glow); }

        /* =========================================
           MOBILE OPTIMIZATIONS (Max Width 768px)
           ========================================= */
        @media (max-width: 768px) {
            
            /* 1. Layout Stack - Switch to Block Flow */
            .split-container {
                display: block; /* Standard vertical block layout */
                height: auto;
                overflow: visible;
            }

            /* 2. Top Zone ("Hello World" Section) */
            .right-zone {
                /* Position relative allows it to sit at the top naturally */
                position: relative; 
                width: 100% !important; /* Force full width */
                /* Force full viewport height so it's a cover page */
                height: 100dvh; 
                clip-path: none !important;
                /* Reset standard properties */
                top: auto; right: auto; left: auto;
            }

            /* 3. Bottom Zone (Profile Section) */
            .left-zone {
                width: 100%;
                /* At least full height so it feels like a second section */
                min-height: 100dvh; 
                padding: 4rem 1rem;
                background: var(--bg-dark); /* Ensure background covers */
            }

            .profile-card {
                width: 100%;
                transform: translateY(50px);
                margin: 0 auto;
            }

            /* 4. Text Wipe Direction (Bottom Up) */
            .text-layer-black-wrapper { clip-path: inset(100% 0 0 0); }
            .text-layer-black-wrapper.enter { clip-path: inset(0 0 0 0); }
            .text-layer-black-wrapper.full { clip-path: inset(0 0 0 0); }

            /* 5. Scroll Indicator */
            .scroll-down { display: block; }
            .scroll-down.show { opacity: 1; }

            /* 6. Typography adjustments */
            .font-cycler-container.glitch-mode {
                font-size: 3rem; /* Bigger on mobile for impact */
            }
        }
    </style>
</head>
<body>

    <div class="intro-loader" id="introLoader"></div>

    <div class="text-layer-white" id="whiteTextLayer">
        <div class="type-text-base">
            <span id="typeTargetWhite"></span><span class="cursor-bar"></span>
        </div>
    </div>

    <div class="text-layer-black-wrapper" id="blackTextWrapper">
        <div class="type-text-base type-text-black">
            <span id="typeTargetBlack"></span><span class="cursor-bar" style="background:black"></span>
        </div>
    </div>

    <div class="split-container">
        
        <div class="right-zone" id="rightRectangle">
            <div class="font-cycler-container" id="fontCycler"></div>
            <div class="scroll-down" id="scrollArrow">
                <i class="fas fa-chevron-down"></i>
            </div>
        </div>

        <div class="left-zone">
            <div class="profile-card" id="profileCard">
                <img src="<?php echo $profile_image; ?>" alt="Profile" class="avatar">
                <h1 class="name">Lorenze Niño Prepotente</h1>
                <div class="role">Full Stack Developer</div>
                <div class="tech-stack">
                    <i class="fab fa-php"></i><i class="fab fa-js"></i><i class="fab fa-laravel"></i><i class="fab fa-react"></i><i class="fas fa-database"></i>
                </div>
                <p style="margin-bottom: 1.5rem; opacity: 0.8; font-size: 0.95rem; line-height: 1.6;">
                    Crafting digital solutions with code. <br>Welcome to my universe.
                </p>
                <a href="<?php echo $main_portfolio; ?>" class="cta-btn">Enter Portfolio</a>
            </div>
        </div>

    </div>

    <script>
        // --- ELEMENTS ---
        const loader = document.getElementById('introLoader');
        const whiteLayer = document.getElementById('whiteTextLayer');
        const blackWrapper = document.getElementById('blackTextWrapper');
        const targetWhite = document.getElementById('typeTargetWhite');
        const targetBlack = document.getElementById('typeTargetBlack');
        const profileCard = document.getElementById('profileCard');
        const rightRect = document.getElementById('rightRectangle');
        const fontCycler = document.getElementById('fontCycler');
        const scrollArrow = document.getElementById('scrollArrow');
        
        // --- CONFIG ---
        const textToType = "Hello, World.";
        const fonts = ["'Space Grotesk'", "'Playfair Display'", "'VT323'", "'Permanent Marker'", "'Arial Black'", "'Courier New'"];
        let charIndex = 0;
        const isMobile = window.matchMedia('(max-width: 768px)').matches;

        // --- STEP 1: TYPE ---
        function type() {
            if (charIndex < textToType.length) {
                const char = textToType.charAt(charIndex);
                targetWhite.textContent += char;
                targetBlack.textContent += char;
                charIndex++;
                setTimeout(type, 100);
            } else {
                fontCycler.textContent = textToType;
                setTimeout(startTransition, 800);
            }
        }

        // --- STEP 2: TRANSITION ---
        function startTransition() {
            loader.classList.add('hidden'); 

            // Start Expanding
            setTimeout(() => {
                rightRect.classList.add('enter');
                blackWrapper.classList.add('enter');
            }, 200);

            // Full Screen Fill
            setTimeout(() => {
                rightRect.classList.add('full');
                blackWrapper.classList.add('full');
            }, 1400); 

            // THE HANDOFF
            setTimeout(() => {
                // 1. Show the cycler text, hide the typewriter layers
                fontCycler.classList.add('show');
                whiteLayer.classList.add('fade-out');
                blackWrapper.classList.add('fade-out');

                // 2. Logic Split: Desktop vs Mobile
                
                if (!isMobile) {
                    // --- DESKTOP LOGIC (Sidebar Effect) ---
                    setTimeout(() => {
                        rightRect.classList.remove('full');
                        fontCycler.classList.add('glitch-mode'); 
                        setInterval(cycleFonts, 150);
                        setTimeout(() => {
                            profileCard.classList.add('active');
                        }, 400); 
                    }, 50); 
                } else {
                    // --- MOBILE LOGIC (Scroll Effect) ---
                    // Don't shrink the rightRect! Keep it full screen (100dvh).
                    fontCycler.classList.add('glitch-mode'); 
                    scrollArrow.classList.add('show'); // Show arrow
                    
                    // Reveal the profile card immediately (it's below the fold now)
                    profileCard.classList.add('active');

                    // Optional: Auto-cycle fonts on mobile too, but slower
                    setInterval(cycleFonts, 2000); 
                }
                
            }, 3000); 
        }

        function cycleFonts() {
            const randomFont = fonts[Math.floor(Math.random() * fonts.length)];
            const randomWeight = Math.random() > 0.5 ? '700' : '300';
            const randomScale = 0.95 + Math.random() * 0.1; 
            
            fontCycler.style.fontFamily = randomFont;
            fontCycler.style.fontWeight = randomWeight;
            fontCycler.style.transform = `scale(${randomScale})`;
        }

        window.addEventListener('load', () => {
            // Force scroll to top on refresh
            window.scrollTo(0, 0);
            setTimeout(type, 500);
        });
    </script>
</body>
</html>