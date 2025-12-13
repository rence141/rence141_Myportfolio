<?php
// Configuration
$main_portfolio = "portfolio.php"; 
$profile_image = "https://scontent.fmnl3-4.fna.fbcdn.net/v/t39.30808-6/475687044_1306906997102854_5197075266384357703_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=a5f93a&_nc_eui2=AeFZ7caDZEXQhVFX0RGVbvJSRYAWgSF3QiBFgBaBIXdCIOuAKBLpFTWkJp5Ie9ewoufhNdjNRPiidF633snSoay4&_nc_ohc=77RNBuqIJegQ7kNvwHwst1U&_nc_oc=AdkejvgpMoWfBk7zDMoKbegOkkpgaN-du_g3rCZpMRE4WZQt48QSc1hHevd9oJn05i4&_nc_zt=23&_nc_ht=scontent.fmnl3-4.fna&_nc_gid=3TIaa_tnnfb0dEM1jhJKjQ&oh=00_AfmQrZAj_ua5JtRSfxubSfmhgQ0mPBy5tFYm-TwmoI4oRA&oe=6942ABA8";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
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
            
            /* --- SIZES --- */
            --hero-font: clamp(3rem, 7vw, 8rem);
            --side-font: clamp(2rem, 4vw, 4rem);
            
            --anim-speed: 1s;
            --anim-ease: cubic-bezier(0.77, 0, 0.175, 1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-dark);
            color: var(--text-main);
            height: 100vh;
            height: 100dvh; /* Fix for mobile browsers */
            overflow: hidden;
            width: 100vw;
        }

        /* --- LAYOUT --- */
        .split-container {
            position: relative;
            width: 100%;
            height: 100%;
            display: flex;
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
            transform: translateX(-50px);
            transition: all 1s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .profile-card.active { opacity: 1; transform: translateX(0); }

        /* --- RIGHT ZONE (ANIMATION & CYCLER) --- */
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
            /* Smoother transitions for the morph */
            transition: width var(--anim-speed) var(--anim-ease), height var(--anim-speed) var(--anim-ease), border-radius 2s ease-in-out;
            border-radius: 0; /* Start Sharp */
        }

        /* Reach to 55% to cover UNIVERSE */
        .right-zone.enter { width: 55%; }
        .right-zone.full { width: 100%; }

        /* --- STEP A: THE MORPH (Smooth Melt) --- */
        /* This state bridges the gap between Rectangle and Puddle */
        .right-zone.morph-state {
            width: 50%; 
            /* Set the initial curve target here */
            border-radius: 30% 0 0 30% / 50% 0 0 50%;
            box-shadow: -10px 0 30px rgba(79, 70, 229, 0.3);
        }

        /* --- STEP B: THE WOBBLE (Infinite Animation) --- */
        .right-zone.wobble-state {
            animation: liquid-wall 6s ease-in-out infinite; 
        }

        @keyframes liquid-wall {
            0% { border-radius: 30% 0 0 30% / 50% 0 0 50%; }
            33% { border-radius: 50% 0 0 50% / 40% 0 0 60%; }
            66% { border-radius: 20% 0 0 20% / 60% 0 0 40%; }
            100% { border-radius: 30% 0 0 30% / 50% 0 0 50%; }
        }

        @keyframes liquid-drip-mobile {
            0% { border-radius: 0 0 50% 50% / 0 0 20% 20%; }
            50% { border-radius: 0 0 50% 50% / 0 0 40% 40%; }
            100% { border-radius: 0 0 50% 50% / 0 0 20% 20%; }
        }

        /* --- THE ANIMATED TEXT --- */
        .font-cycler-container {
            font-size: var(--hero-font);
            font-family: 'Space Grotesk', monospace;
            line-height: 1.1;
            font-weight: 700;
            text-align: center;
            opacity: 0;
            color: #000; 
            white-space: nowrap; 
            transition: 
                opacity 0.1s linear, 
                color 0.8s ease, 
                font-size var(--anim-speed) var(--anim-ease);
            position: relative;
            padding: 0 20px;
        }
        
        .font-cycler-container.show { opacity: 1; }
        
        /* --- DYNAMIC MODE (Revert state) --- */
        .font-cycler-container.glitch-mode {
            color: #ffffff; 
            mix-blend-mode: overlay; 
            opacity: 0.9;
            font-size: var(--side-font);
            white-space: normal; 
            word-wrap: break-word;
        }

        /* --- INTRO LOADER --- */
        .intro-loader {
            position: fixed; inset: 0; background: #000;
            z-index: 5; transition: opacity 0.8s ease;
        }
        .intro-loader.hidden { opacity: 0; pointer-events: none; }

        /* --- TYPING LAYERS --- */
        .type-text-base {
            font-family: 'Space Grotesk', monospace;
            font-size: var(--hero-font);
            font-weight: 700;
            line-height: 1.1;
            white-space: nowrap;
        }

        .text-layer-white {
            position: fixed; inset: 0;
            display: flex; align-items: center; justify-content: center;
            z-index: 30; color: white; pointer-events: none;
            transition: opacity 0.2s linear;
        }

        .text-layer-black-wrapper {
            position: fixed; inset: 0;
            display: flex; align-items: center; justify-content: center;
            z-index: 31; pointer-events: none;
            clip-path: inset(0 0 0 100%);
            transition: clip-path var(--anim-speed) var(--anim-ease), opacity 0.2s linear;
        }

        .text-layer-black-wrapper.enter { clip-path: inset(0 0 0 45%); }
        .text-layer-black-wrapper.full { clip-path: inset(0 0 0 0%); }

        .type-text-black { color: black; }
        
        .cursor-bar {
            display: inline-block; width: 5px; height: 1em;
            background: var(--primary); margin-left: 10px;
            animation: blinkCursor 0.75s step-end infinite;
        }
        
        .fade-out { opacity: 0 !important; }

        @keyframes blinkCursor { 50% { opacity: 0; } }

        /* --- ASSETS --- */
        .avatar { width: 120px; height: 120px; border-radius: 50%; border: 3px solid var(--primary); margin-bottom: 1.5rem; object-fit: cover; box-shadow: 0 0 20px var(--primary-glow); }
        .name { font-family: 'Space Grotesk', sans-serif; font-size: 2rem; font-weight: 700; margin-bottom: 0.5rem; background: linear-gradient(90deg, var(--text-main), var(--primary)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .role { color: var(--primary); font-weight: 600; background: rgba(79, 70, 229, 0.1); padding: 0.25rem 1rem; border-radius: 20px; display: inline-block; margin-bottom: 1.5rem; }
        .tech-stack { display: flex; justify-content: center; gap: 15px; margin-bottom: 2rem; font-size: 1.4rem; opacity: 0.8; }
        .cta-btn { display: inline-block; background: var(--primary); color: white; padding: 12px 30px; border-radius: 8px; text-decoration: none; font-weight: 600; transition: 0.3s; box-shadow: 0 4px 15px var(--primary-glow); }
        .cta-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 25px var(--primary-glow); }

        /* --- MOBILE RESPONSIVENESS --- */
        @media (max-width: 768px) {
            :root {
                --hero-font: 3rem; 
                --side-font: 1.5rem;
            }

            .split-container {
                flex-direction: column; 
            }

            .left-zone {
                width: 100%;
                height: 100%;
                padding-top: 30vh; 
                overflow-y: auto;
                align-items: flex-start; 
            }

            .profile-card {
                padding: 2rem 1.5rem;
                width: 90%;
                margin-top: 2rem;
                margin-bottom: 2rem;
                transform: translateY(30px);
            }
            .profile-card.active {
                transform: translateY(0);
            }

            .right-zone {
                width: 100%;
                height: 0%; 
                top: 0; 
                right: auto;
                left: 0;
            }

            .right-zone.enter { 
                width: 100%; 
                height: 30%; 
            }
            .right-zone.full { 
                width: 100%; 
                height: 100%; 
            }
            
            /* Mobile Puddle States */
            .right-zone.morph-state {
                width: 100%;
                height: 35%; 
                border-radius: 0 0 50% 50% / 0 0 20% 20%;
                box-shadow: 0 10px 30px rgba(79, 70, 229, 0.3);
            }
            .right-zone.wobble-state {
                animation: liquid-drip-mobile 5s ease-in-out infinite;
            }

            .text-layer-black-wrapper { clip-path: inset(0 0 100% 0); }
            .text-layer-black-wrapper.enter { clip-path: inset(0 0 70% 0); }
            .text-layer-black-wrapper.full { clip-path: inset(0 0 0 0); }
            
            .tech-stack { gap: 10px; font-size: 1.2rem; }
            .name { font-size: 1.5rem; }
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
            <div class="font-cycler-container" id="fontCycler">
            </div>
        </div>

        <div class="left-zone">
            <div class="profile-card" id="profileCard">
                <img src="<?php echo $profile_image; ?>" alt="Profile" class="avatar">
                <h1 class="name">Rence</h1>
                <div class="role">Full Stack Developer</div>
                <div class="tech-stack">
                    <i class="fab fa-php"></i><i class="fab fa-js"></i><i class="fab fa-laravel"></i><i class="fab fa-react"></i><i class="fas fa-database"></i>
                </div>
                <p style="margin-bottom: 1.5rem; opacity: 0.8; font-size: 0.95rem;">Crafting digital solutions with code. <br>Welcome to my universe.</p>
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
        
        // --- CONFIG ---
        const textToType = "Welcome to my UNIVERSE.";
        const fonts = ["'Space Grotesk'", "'Playfair Display'", "'VT323'", "'Permanent Marker'", "'Arial Black'", "'Courier New'"];
        let charIndex = 0;

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

            setTimeout(() => {
                rightRect.classList.add('enter');
                blackWrapper.classList.add('enter');
            }, 200);

            setTimeout(() => {
                rightRect.classList.add('full');
                blackWrapper.classList.add('full');
            }, 1400); 

            // THE HANDOFF sequence
            setTimeout(() => {
                // 1. Swap visibility
                fontCycler.classList.add('show');
                whiteLayer.classList.add('fade-out');
                blackWrapper.classList.add('fade-out');

                // 2. Revert to Side (or Top on Mobile)
                setTimeout(() => {
                    // Start Shrinking back to a RECTANGLE first
                    rightRect.classList.remove('full');
                    
                    // 3. THE SMOOTH MORPH TRICK:
                    // Wait 900ms (just before width finishes) to start smoothly bending the border
                    setTimeout(() => {
                        rightRect.classList.add('morph-state'); 
                    }, 900); 

                    // 4. THE WOBBLE START:
                    // Wait for the bend (morph) to fully finish (2.5s) before turning on the infinite loop
                    setTimeout(() => {
                        rightRect.classList.add('wobble-state');
                    }, 2900);


                    // Trigger DYNAMIC RESIZE + COLOR CHANGE
                    fontCycler.classList.add('glitch-mode'); 
                    
                    setInterval(cycleFonts, 150);

                    setTimeout(() => {
                        profileCard.classList.add('active');
                    }, 400); 
                }, 50); 
                
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
            setTimeout(type, 500);
        });
    </script>
</body>
</html>