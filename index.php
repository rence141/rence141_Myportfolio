<?php
// Simple redirect option (optional)
$main_portfolio = "portfolio.php"; // Path to your main portfolio file
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rence - Portfolio</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e293b;
            --accent-color: #f8fafc;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        [data-theme="dark"] {
            --primary-color: #3b82f6;
            --secondary-color: #0f172a;
            --accent-color: #1e293b;
            --text-primary: #f1f5f9;
            --text-secondary: #cbd5e1;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, var(--accent-color) 0%, #e2e8f0 100%);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
            transition: all 0.3s ease;
        }

        [data-theme="dark"] body {
            background: linear-gradient(135deg, var(--secondary-color) 0%, #1e293b 100%);
        }

        .container {
            max-width: 500px;
            width: 90%;
            text-align: center;
            padding: 2rem;
        }

        .logo {
            font-size: 3.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary-color), #1d4ed8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
            animation: fadeInUp 1s ease-out;
        }

        .subtitle {
            font-size: 1.2rem;
            color: var(--text-secondary);
            margin-bottom: 2rem;
            animation: fadeInUp 1s ease-out 0.2s both;
        }

        .profile-card {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            animation: fadeInUp 1s ease-out 0.4s both;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        [data-theme="dark"] .profile-card {
            background: var(--secondary-color);
            border-color: rgba(255, 255, 255, 0.1);
        }

        .profile-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin: 0 auto 1.5rem;
            border: 4px solid var(--primary-color);
            object-fit: cover;
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.2);
            transition: all 0.3s ease;
        }

        .profile-card:hover .avatar {
            transform: scale(1.05);
        }

        .name {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text-primary);
        }

        .title {
            color: var(--text-secondary);
            font-size: 1.1rem;
            margin-bottom: 1rem;
        }

        .cta-button {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            background: linear-gradient(135deg, var(--primary-color), #1d4ed8);
            color: white;
            padding: 1rem 2rem;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 500;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
            animation: fadeInUp 1s ease-out 0.6s both;
        }

        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.4);
            color: white;
            text-decoration: none;
        }

        .theme-toggle {
            position: fixed;
            top: 2rem;
            right: 2rem;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            z-index: 1000;
        }

        [data-theme="dark"] .theme-toggle {
            background: rgba(30, 41, 59, 0.9);
            color: var(--text-primary);
        }

        .theme-toggle:hover {
            transform: scale(1.1);
            background: var(--primary-color);
            color: white;
        }

        .loading-dots {
            display: inline-flex;
            gap: 0.25rem;
            margin-left: 0.5rem;
        }

        .loading-dots span {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.7);
            animation: loadingDots 1.4s infinite ease-in-out both;
        }

        .loading-dots span:nth-child(1) { animation-delay: -0.32s; }
        .loading-dots span:nth-child(2) { animation-delay: -0.16s; }

        @keyframes loadingDots {
            0%, 80%, 100% { transform: scale(0); }
            40% { transform: scale(1); }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .logo {
                font-size: 2.5rem;
            }
            
            .profile-card {
                padding: 2rem;
            }
            
            .theme-toggle {
                top: 1rem;
                right: 1rem;
                width: 45px;
                height: 45px;
            }
        }

        /* Floating background elements */
        .bg-element {
            position: absolute;
            opacity: 0.05;
            animation: float 6s ease-in-out infinite;
        }

        .bg-element:nth-child(1) {
            top: 20%;
            left: 10%;
            width: 100px;
            height: 100px;
            background: var(--primary-color);
            border-radius: 50%;
            animation-delay: 0s;
        }

        .bg-element:nth-child(2) {
            top: 60%;
            right: 15%;
            width: 60px;
            height: 60px;
            background: rgba(37, 99, 235, 0.3);
            border-radius: 30%;
            animation-delay: 2s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
    </style>
</head>
<body>
    <!-- Theme Toggle -->
    <button class="theme-toggle" id="themeToggle" aria-label="Toggle theme">
        <i class="fas fa-moon"></i>
    </button>

    <!-- Background Elements -->
    <div class="bg-element"></div>
    <div class="bg-element"></div>

    <div class="container">
        <h1 class="logo">Rence</h1>
        <p class="subtitle">Full Stack Developer</p>
        
        <div class="profile-card">
            <img src="https://scontent.fmnl3-4.fna.fbcdn.net/v/t39.30808-6/475687044_1306906997102854_5197075266384357703_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=a5f93a&_nc_eui2=AeFZ7caDZEXQhVFX0RGVbvJSRYAWgSF3QiBFgBaBIXdCIOuAKBLpFTWkJp5Ie9ewoufhNdjNRPiidF633snSoay4&_nc_ohc=CZhng25oJLsQ7kNvwHtTv-8&_nc_oc=AdlP46qr6Y28oTlmWYpAb_y2iDoNTjFYiepVLbVxdUv0V1iN3cHz79yAbdHaInpQ4Ik&_nc_zt=23&_nc_ht=scontent.fmnl3-4.fna&_nc_gid=b2UNYjCJ5bWwwwcW5m-3lQ&oh=00_AfeTlRpQoBU3Ovu0d1o02YTHZGs4aTW9spx-_2v0Y79m1Q&oe=69039BE8" 
                 alt="Rence Profile" class="avatar" 
                 loading="lazy">
            
            <h2 class="name">Lorenze Niño Prepotente</h2>
            <p class="title">
                <i class="fas fa-map-marker-alt"></i> Philippines | 
                <i class="fas fa-graduation-cap"></i> BS Information Systems
            </p>
            
            <a href="<?php echo $main_portfolio; ?>" class="cta-button">
                <i class="fas fa-arrow-right"></i>
                <span>Enter Portfolio</span>
                <div class="loading-dots" id="loadingDots" style="display: none;">
                    <span></span>
                    <span></span>
                </div>
            </a>
        </div>
    </div>

    <script>
        // Theme Toggle
        const themeToggle = document.getElementById('themeToggle');
        const html = document.documentElement;
        const icon = themeToggle.querySelector('i');

        // Load saved theme
        const savedTheme = localStorage.getItem('theme') || 'light';
        html.setAttribute('data-theme', savedTheme);
        updateThemeIcon(savedTheme);

        function updateThemeIcon(theme) {
            icon.className = theme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
        }

        themeToggle.addEventListener('click', () => {
            const current = html.getAttribute('data-theme');
            const newTheme = current === 'dark' ? 'light' : 'dark';
            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateThemeIcon(newTheme);
        });

        // CTA Button Animation
        const ctaButton = document.querySelector('.cta-button');
        const loadingDots = document.getElementById('loadingDots');

        ctaButton.addEventListener('click', (e) => {
            // Prevent default navigation
            e.preventDefault();
            
            // Show loading state
            const text = ctaButton.querySelector('span:not(.loading-dots)');
            loadingDots.style.display = 'inline-flex';
            text.style.opacity = '0.5';
            
            // Simulate loading
            setTimeout(() => {
                // Navigate to portfolio
                window.location.href = ctaButton.getAttribute('href');
            }, 800);
        });

        // Add subtle entrance animation
        window.addEventListener('load', () => {
            document.body.style.opacity = '1';
        });

        // Preload portfolio page
        ctaButton.addEventListener('mouseenter', () => {
            const link = document.createElement('link');
            link.rel = 'prefetch';
            link.href = ctaButton.getAttribute('href');
            document.head.appendChild(link);
        });
    </script>
</body>
</html>