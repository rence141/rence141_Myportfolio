<?php
// 1. TURN ON ERROR REPORTING (Remove these two lines when finished debugging)
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

/* ──────────────────────────────────────
   SIMPLE VISITOR TRACKING (DEBUG MODE)
   ────────────────────────────────────── */

// Define file paths
$base_dir = __DIR__ . '/messages';
$stats_file = $base_dir . '/visitor_stats.json';

// 2. CHECK/CREATE DIRECTORY
if (!is_dir($base_dir)) {
    // Attempt to create directory
    if (!mkdir($base_dir, 0755, true)) {
        echo "<div style='background:red;color:white;padding:10px;font-weight:bold;z-index:9999;position:fixed;top:0;left:0;width:100%;text-align:center;'>
                CRITICAL ERROR: PHP cannot create the 'messages' folder. <br>
                Please create a folder named <strong>messages</strong> manually in your file manager.
              </div>";
        die(); 
    }
}

// 3. LOAD CURRENT STATS
$stats = ['views' => 0]; // Simple structure for debugging
if (file_exists($stats_file)) {
    $content = file_get_contents($stats_file);
    $decoded = json_decode($content, true);
    if (is_array($decoded) && isset($decoded['views'])) {
        $stats = $decoded;
    }
}

// 4. INCREMENT COUNT (Removed IP check for testing)
$stats['views']++; 

// 5. SAVE FILE
$saved = file_put_contents($stats_file, json_encode($stats));

if ($saved === false) {
    echo "<div style='background:darkred;color:white;padding:10px;font-weight:bold;z-index:9999;position:fixed;top:0;left:0;width:100%;text-align:center;'>
            PERMISSION ERROR: PHP cannot write to '$stats_file'. <br>
            Fix: Right-click the 'messages' folder > Properties > Permissions > Set to 777 (or ensure Write is enabled).
          </div>";
}

$total_views = $stats['views'];

/* ──────────────────────────────────────
   CONFIGURATION 
   ────────────────────────────────────── */
$config = [
    'email_to'   => 'renceprepotente@gmail.com', 
    'full_name'  => 'Lorenze Fernandez Prepotente',
    'role'       => 'Full-Stack Developer',
    'location'   => 'Albay, Philippines',
    'socials'    => [
        'github'   => 'https://github.com/rence141',
        'facebook' => 'https://facebook.com',
        'linkedin' => '#' 
    ],
    'avatar'     => 'https://scontent.fmnl3-4.fna.fbcdn.net/v/t39.30808-6/475687044_1306906997102854_5197075266384357703_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=a5f93a&_nc_eui2=AeFZ7caDZEXQhVFX0RGVbvJSRYAWgSF3QiBFgBaBIXdCIOuAKBLpFTWkJp5Ie9ewoufhNdjNRPiidF633snSoay4&_nc_ohc=77RNBuqIJegQ7kNvwHwst1U&_nc_oc=AdkejvgpMoWfBk7zDMoKbegOkkpgaN-du_g3rCZpMRE4WZQt48QSc1hHevd9oJn05i4&_nc_zt=23&_nc_ht=scontent.fmnl3-4.fna&_nc_gid=3TIaa_tnnfb0dEM1jhJKjQ&oh=00_AfmQrZAj_ua5JtRSfxubSfmhgQ0mPBy5tFYm-TwmoI4oRA&oe=6942ABA8'
];

/* ──────────────────────────────────────
   BACKEND FORM LOGIC
   ────────────────────────────────────── */
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$toast_message = "";
$toast_type = ""; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die("Security violation");
    }
    if (!empty($_POST['website'])) die(); 

    $name    = htmlspecialchars(trim($_POST['name']));
    $email   = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST['message']));

    if (empty($name) || empty($email) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['flash'] = ['type' => 'danger', 'msg' => 'Please fill in all fields correctly.'];
    } else {
        // Log file path fix
        $log_file = $base_dir . "/contact_log.txt";
        $log_entry = "Date: " . date('Y-m-d H:i:s') . "\nName: $name\nEmail: $email\nMessage:\n$message\n-------------------\n";
        file_put_contents($log_file, $log_entry, FILE_APPEND);

        $subject = "Portfolio Contact: $name";
        $headers = "From: noreply@portfolio.local\r\nReply-To: $email\r\n";
        
        if (@mail($config['email_to'], $subject, $message, $headers)) {
            $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Message sent successfully!'];
        } else {
            $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Message saved to logs!'];
        }
    }
    header("Location: " . $_SERVER['PHP_SELF'] . "#contact");
    exit;
}

if (isset($_SESSION['flash'])) {
    $toast_message = $_SESSION['flash']['msg'];
    $toast_type    = $_SESSION['flash']['type'];
    unset($_SESSION['flash']);
}
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="Portfolio of <?= $config['full_name'] ?>, a Full-Stack Developer">
    <title>Rence | <?= $config['role'] ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Space+Grotesk:wght@700&display=swap" rel="stylesheet">
    
    <style>
    /* ──────────────────────────────────────
       CORE VARIABLES & THEME
       ────────────────────────────────────── */
    :root {
        --primary: #362cf0ff;
        --primary-glow: rgba(79, 70, 229, 0.4);
        --secondary: #ec4899;
        --bg-body: #f8fafc;
        --text-main: #1e293b;
        --text-muted: #64748b;
        --glass-bg: rgba(255, 255, 255, 0.85);
        --glass-border: rgba(255, 255, 255, 0.5);
        --card-bg: #ffffff;
        --radius: 16px;
        --shadow: 0 10px 30px -10px rgba(0,0,0,0.1);
        --hero-text-size: clamp(2.5rem, 5vw, 4rem);
    }

    [data-theme="dark"] {
        --primary: #6366f1;
        --primary-glow: rgba(99, 102, 241, 0.4);
        --secondary: #f472b6;
        --bg-body: #0f172a;
        --text-main: #f1f5f9;
        --text-muted: #cbd5e1;
        --glass-bg: rgba(15, 23, 42, 0.85);
        --glass-border: rgba(255, 255, 255, 0.08);
        --card-bg: #1e293b;
        --shadow: 0 10px 40px -10px rgba(0,0,0,0.5);
    }

    * { box-sizing: border-box; }
    html { scroll-behavior: smooth; }
    
    body {
        font-family: 'Outfit', sans-serif;
        background: var(--bg-body);
        color: var(--text-main);
        transition: background 0.3s ease, color 0.3s ease;
        overflow-x: hidden;
    }

    h1, h2, h3, h4 { font-family: 'Space Grotesk', sans-serif; color: var(--text-main); }
    p { color: var(--text-muted); line-height: 1.7; }
    a { color: var(--primary); text-decoration: none; }
    [data-theme="dark"] a { color: var(--primary); }
    .text-muted { color: var(--text-muted) !important; }
    [data-theme="dark"] .text-muted { color: var(--text-muted) !important; }
    
    [data-theme="dark"] .devicon-github-original, 
    [data-theme="dark"] .devicon-linkedin-plain, 
    [data-theme="dark"] .devicon-facebook-plain { color: var(--text-muted) !important; }
    
    [data-theme="dark"] .text-primary { color: var(--primary) !important; }
    [data-theme="dark"] .text-success { color: #10b981 !important; }
    [data-theme="dark"] .text-danger { color: #ef4444 !important; }
    
    /* ──────────────────────────────────────
       COMPONENTS
       ────────────────────────────────────── */
    .glass {
        background: var(--glass-bg);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border-bottom: 1px solid var(--glass-border);
    }

    .btn-unique {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border: none;
        color: white !important;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px var(--primary-glow);
    }
    .btn-unique:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px var(--primary-glow);
        color: white;
    }

    .section-title {
        font-size: clamp(2rem, 4vw, 2.5rem);
        font-weight: 700;
        margin-bottom: 3rem;
        position: relative;
        display: inline-block;
    }
    .section-title::after {
        content: '';
        display: block;
        width: 60px;
        height: 6px;
        background: var(--primary);
        margin: 10px auto 0;
        border-radius: 3px;
    }

    /* ──────────────────────────────────────
       NAVBAR
       ────────────────────────────────────── */
    .navbar {
        transition: all 0.3s ease;
        padding: 15px 0;
    }
    .navbar.scrolled {
        padding: 10px 0;
        box-shadow: var(--shadow);
    }
    .nav-link {
        font-weight: 500;
        color: var(--text-main) !important;
        margin: 0 8px;
        position: relative;
    }
    .nav-link::after {
        content: '';
        position: absolute; width: 0; height: 2px;
        bottom: 0; left: 50%; background: var(--primary);
        transition: all 0.3s;
    }
    .nav-link:hover::after, .nav-link.active::after {
        width: 100%; left: 0;
    }

    #navbar-brand-text {
        border-right: 2px solid var(--primary);
        animation: blinkBrand 0.75s step-end infinite;
    }
    @keyframes blinkBrand { 50% { border-color: transparent; } }


    /* ──────────────────────────────────────
       HERO
       ────────────────────────────────────── */
    .hero {
        min-height: 100vh;
        display: flex;
        align-items: center;
        position: relative;
        padding-top: 80px; 
        padding-bottom: 50px;
        background: radial-gradient(circle at 10% 20%, rgba(79, 70, 229, 0.1) 0%, transparent 40%),
                    radial-gradient(circle at 90% 80%, rgba(236, 72, 153, 0.1) 0%, transparent 40%);
    }
    
    .hero-title {
        font-size: var(--hero-text-size);
        line-height: 1.2;
    }

    .hero-img-container {
        position: relative;
        z-index: 2;
    }
    .hero-img {
        width: 280px; height: 280px;
        border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
        object-fit: cover;
        border: 4px solid var(--card-bg);
        box-shadow: var(--shadow);
        animation: morph 8s ease-in-out infinite;
    }
    .hero-blob {
        position: absolute;
        top: -20px; left: -20px; right: -20px; bottom: -20px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
        z-index: -1;
        opacity: 0.3;
        filter: blur(20px);
        animation: morph 8s ease-in-out infinite reverse;
    }

    @keyframes morph {
        0% { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
        50% { border-radius: 30% 60% 70% 40% / 50% 60% 30% 60%; }
        100% { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
    }

    .typewriter span {
        color: var(--primary);
        font-weight: 700;
        border-right: 3px solid var(--text-main);
        animation: blink 0.75s step-end infinite;
    }
    @keyframes blink { 50% { border-color: transparent; } }

    /* ──────────────────────────────────────
       CARDS (Skills & Projects)
       ────────────────────────────────────── */
    .custom-card {
        background: var(--card-bg);
        border-radius: var(--radius);
        padding: 2rem;
        height: 100%;
        transition: transform 0.3s, box-shadow 0.3s;
        border: 1px solid var(--glass-border);
    }
    .custom-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px var(--primary-glow);
    }
    
    .badge-tech {
        background: rgba(79, 70, 229, 0.1);
        color: var(--primary);
        font-size: 0.75rem;
        padding: 5px 10px;
        border-radius: 6px;
        font-weight: 600;
        display: inline-block;
        margin-bottom: 4px;
    }

    /* ──────────────────────────────────────
       TIMELINE
       ────────────────────────────────────── */
    .timeline {
        position: relative;
        padding-left: 30px;
        border-left: 2px solid var(--glass-border);
    }
    .timeline-item {
        margin-bottom: 30px;
        position: relative;
    }
    .timeline-item::before {
        content: '';
        position: absolute;
        left: -36px; top: 0;
        width: 14px; height: 14px;
        border-radius: 50%;
        background: var(--primary);
        border: 3px solid var(--bg-body);
    }
    
    /* ──────────────────────────────────────
       TOAST
       ────────────────────────────────────── */
    .toast-container {
        position: fixed; bottom: 20px; right: 20px; z-index: 1050;
    }
    .custom-toast {
        background: var(--card-bg);
        color: var(--text-main);
        padding: 15px 20px;
        border-radius: 12px;
        box-shadow: var(--shadow);
        border-left: 5px solid var(--primary);
        display: flex; align-items: center; gap: 15px;
        transform: translateX(120%);
        transition: transform 0.4s cubic-bezier(0.68, -0.55, 0.27, 1.55);
    }
    .custom-toast.show { transform: translateX(0); }
    .custom-toast.danger { border-left-color: #ef4444; }

    /* FORM */
    .form-control {
        background: var(--bg-body) !important;
        color: var(--text-main) !important;
        border: none !important;
    }
    .form-control::placeholder {
        color: var(--text-muted) !important;
    }
    [data-theme="dark"] .form-control {
        background: rgba(255, 255, 255, 0.08) !important;
        border: 1px solid var(--glass-border) !important;
    }

    .theme-switch {
        cursor: pointer;
        width: 45px; height: 45px;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        background: var(--bg-body);
        box-shadow: var(--shadow);
        font-size: 1.2rem;
        border: 1px solid var(--glass-border);
        transition: transform 0.2s;
    }
    .theme-switch:active { transform: scale(0.9); }

    /* ──────────────────────────────────────
       MOBILE SPECIFIC OPTIMIZATIONS
       ────────────────────────────────────── */
    @media (max-width: 991px) {
        .navbar-collapse {
            background: var(--card-bg);
            padding: 20px;
            border-radius: 16px;
            box-shadow: var(--shadow);
            margin-top: 15px;
        }
    }

    @media (max-width: 768px) {
        .hero { 
            text-align: center; 
            padding-top: 100px;
        }
        
        .hero-img { 
            width: 220px; 
            height: 220px; 
        }
        
        .hero-blob {
            top: -10px; bottom: -10px; left: -10px; right: -10px;
        }
        
        .hero-img-container { 
            margin: 0 auto 40px; 
        }

        .hero .d-flex.gap-3 {
            flex-wrap: wrap;
            justify-content: center;
        }
        
        .toast-container {
            right: 0; left: 0; bottom: 20px;
            display: flex; justify-content: center;
            width: 100%;
            pointer-events: none;
        }
        .custom-toast {
            width: 90%;
            pointer-events: auto;
            transform: translateY(150%);
        }
        .custom-toast.show {
            transform: translateY(0);
        }
    }

    /* Pulse Animation for the Live Dot */
    @keyframes ping {
        75%, 100% { transform: scale(2); opacity: 0; }
    }
    .animate-ping {
        animation: ping 1.5s cubic-bezier(0, 0, 0.2, 1) infinite;
    }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg fixed-top glass">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#" style="font-family:'Space Grotesk'; font-size:1.5rem;">
                <span id="navbar-brand-text" style="color:var(--primary)"></span>
            </a>
            <div class="d-flex align-items-center gap-3">
                <div class="theme-switch d-lg-none" id="themeToggleMobile">
                    <i class="fa-solid fa-moon"></i>
                </div>

                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon" style="filter: invert(var(--invert));"></span>
                </button>
            </div>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center text-center text-lg-start">
                    <li class="nav-item"><a class="nav-link active" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#projects">Projects</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    <li class="nav-item ms-3 d-none d-lg-block">
                        <div class="theme-switch" id="themeToggle">
                            <i class="fa-solid fa-moon"></i>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="home" class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-2 order-lg-1 fade-up text-center text-lg-start">
                    <p class="mb-2" style="color:var(--primary); font-weight:600;">👋 Welcome to my portfolio</p>
                    <h1 class="hero-title fw-bold mb-3">I'm <?= explode(' ', $config['full_name'])[0] ?></h1>
                    <h2 class="h3 mb-4 text-muted typewriter">I am a <span id="typing-text"></span></h2>
                    <p class="lead mb-5">
                        Passionate about building scalable web applications and intuitive user experiences. 
                        Turning complex problems into elegant solutions.
                    </p>
                    <div class="d-flex gap-3 justify-content-center justify-content-lg-start">
                        <a href="#projects" class="btn btn-unique">View Work</a>
                        <a href="#contact" class="btn btn-outline-secondary rounded-pill px-4 py-2 fw-bold" style="border:2px solid var(--text-muted); color:var(--text-main);" onmouseover="this.style.background='rgba(79,70,229,0.1)'" onmouseout="this.style.background='transparent'">Contact Me</a>
                    </div>
                    <div class="mt-5 d-flex gap-3 justify-content-center justify-content-lg-start">
                        <a href="<?= $config['socials']['github'] ?>" class="text-muted fs-4"><i class="devicon-github-original"></i></a>
                        <a href="<?= $config['socials']['linkedin'] ?>" class="text-muted fs-4"><i class="devicon-linkedin-plain"></i></a>
                        <a href="<?= $config['socials']['facebook'] ?>" class="text-muted fs-4"><i class="devicon-facebook-plain"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 text-center fade-up" style="animation-delay: 0.2s;">
                    <div class="hero-img-container d-inline-block">
                        <div class="hero-blob"></div>
                        <img src="<?= $config['avatar'] ?>" alt="Profile" class="hero-img">
                    </div>
                </div>
            </div>
        </div>
    </section>

   <section id="about" class="py-5">
        <div class="container py-4">
            <div class="text-center">
                <h2 class="section-title">About Me</h2>
            </div>
            <div class="row g-5">
                <div class="col-lg-6 fade-up">
                    <div class="custom-card h-100 d-flex flex-column justify-content-between">
                        <div>
                            <h3>Who am I?</h3>
                            <p class="mt-3">
                                I am <strong><?= $config['full_name'] ?></strong>, a 21-year-old developer based in <?= $config['location'] ?>. 
                                Currently pursuing a <strong>BS in Information Systems</strong> at Bicol University.
                            </p>
                            <p>
                                I specialize in backend development with PHP and database management, but I also love crafting beautiful front-end interfaces.
                            </p>
                            
                            <h4 class="mt-4 mb-3">Tech Stack</h4>
                            <div class="d-flex flex-wrap gap-2 mb-4">
                                <?php 
                                $stack = ['PHP', 'MySQL', 'Laravel', 'Bootstrap', 'JavaScript', 'Git', 'C++'];
                                foreach($stack as $tech) echo "<span class='badge-tech'>$tech</span>";
                                ?>
                            </div>
                        </div>

                        <div class="p-3 rounded-4 border d-flex align-items-center justify-content-between mt-auto"
                             style="background: var(--bg-body); border-color: var(--glass-border) !important;">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center"
                                     style="width:50px; height:50px; background: rgba(79, 70, 229, 0.1); color: var(--primary);">
                                    <i class="fa-solid fa-users-viewfinder fs-4"></i>
                                </div>
                                <div>
                                    <h3 class="fw-bold mb-0" style="line-height: 1;"><?= number_format($total_views) ?></h3>
                                    <small class="text-muted fw-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">Portfolio Visits</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2 px-3 py-1 rounded-pill" style="background: rgba(16, 185, 129, 0.1);">
                                <span class="position-relative d-flex" style="width: 10px; height: 10px;">
                                  <span class="position-absolute w-100 h-100 rounded-circle bg-success opacity-75 animate-ping"></span>
                                  <span class="position-relative w-100 h-100 rounded-circle bg-success"></span>
                                </span>
                                <span class="small text-success fw-bold" style="font-size: 0.75rem;">Online</span>
                            </div>
                        </div>
                        </div>
                </div>

                <div class="col-lg-6 fade-up" style="animation-delay: 0.2s;">
                    <div class="h-100 d-flex flex-column justify-content-center">
                        <h3 class="mb-4 ps-lg-4 text-center text-lg-start">Education & Experience</h3>
                        <div class="timeline ms-lg-4">
                            <div class="timeline-item">
                                <span class="text-muted small">2021 - Present</span>
                                <h5 class="mt-1">BS Information Systems</h5>
                                <p class="mb-0 text-primary">Bicol University Polangui Campus</p>
                                <small class="text-muted">Dean's Lister • System Analysis Focus</small>
                            </div>
                            <div class="timeline-item">
                                <span class="text-muted small">2023</span>
                                <h5 class="mt-1">Freelance Web Developer</h5>
                                <p class="mb-0 text-primary">Remote</p>
                                <small class="text-muted">Developed custom CMS solutions and landing pages for local businesses.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="projects" class="py-5" style="background: rgba(0,0,0,0.02);">
        <div class="container py-4">
            <div class="text-center">
                <h2 class="section-title">Featured Projects</h2>
                <p class="mb-5 mx-auto" style="max-width: 600px;">Here are some of the systems I've developed during my academic and freelance journey.</p>
            </div>
            <div class="row g-4">
                <?php
                $projects = [
                    ["E-Commerce", "Full-featured online shopping platform with secure payment integration.", "devicon-html5-plain", ["PHP", "MySQL", "E-Commerce"], "projects/meta-shark-ecommerce.php"],
                    ["CSD LMS", "Secure Learning Management System for tracking student progress.", "devicon-moodle-plain", ["PHP", "MySQL", "Security"], "projects/csd-lms.php"],
                    ["Meta Shark", "E-commerce admin dashboard with real-time inventory analytics.", "devicon-react-original", ["Dashboard", "Analytics", "UI/UX"], "projects/meta-shark.php"],
                    ["Student Mgmt", "Automated scheduling and grading system for university faculties.", "devicon-php-plain", ["Automation", "Database"], "projects/student-management.php"],
                    ["Course Tracker", "Real-time activity tracking and deadline reminder system.", "devicon-html5-plain", ["JS", "LocalStore"], "projects/course-management.php"]
                ];
                foreach ($projects as $idx => $p) {
                    $tags = "";
                    foreach($p[3] as $t) $tags .= "<span class='badge-tech me-1'>$t</span>";
                    echo "
                    <div class='col-md-6 col-lg-3 fade-up' style='animation-delay: ".(0.1 * $idx)."s'>
                        <div class='custom-card d-flex flex-column'>
                            <div class='mb-3 text-primary'><i class='{$p[2]}' style='font-size: 2.5rem;'></i></div>
                            <h5 class='fw-bold'>{$p[0]}</h5>
                            <p class='small text-muted flex-grow-1'>{$p[1]}</p>
                            <div class='mb-3'>$tags</div>
                            <a href='{$p[4]}' class='btn btn-sm btn-outline-primary rounded-pill'>View Details</a>
                        </div>
                    </div>";
                }
                ?>
            </div>
        </div>
    </section>

    <section id="contact" class="py-5">
        <div class="container py-4">
            <div class="row justify-content-center">
                <div class="col-lg-8 fade-up">
                    <div class="custom-card glass text-center">
                        <h2 class="fw-bold mb-4">Let's Work Together</h2>
                        <p class="mb-4">Have a project in mind or just want to say hi? Send me a message!</p>
                        
                        <form method="POST" action="" class="text-start">
                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                            <input type="text" name="website" style="display:none;">

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-uppercase text-muted">Your Name</label>
                                    <input type="text" name="name" class="form-control form-control-lg" placeholder="Full-Name" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-uppercase text-muted">Email Address</label>
                                    <input type="email" name="email" class="form-control form-control-lg" placeholder="@example.com" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-bold text-uppercase text-muted">Message</label>
                                    <textarea name="message" rows="5" class="form-control form-control-lg" placeholder="Tell me about your project..." required></textarea>
                                </div>
                                <div class="col-12 text-center mt-4">
                                    <button type="submit" class="btn btn-unique px-5 w-100 w-md-auto">Send Message <i class="fa-solid fa-paper-plane ms-2"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-5 text-center text-muted small position-relative">
        <div class="container">
            <p class="mb-2">&copy; <?= date("Y") ?> Rence. Built with PHP & Bootstrap 5.</p>
        </div>
    </footer>

    <div class="toast-container">
        <div id="liveToast" class="custom-toast <?= $toast_type === 'danger' ? 'danger' : '' ?>">
            <i class="fa-solid <?= $toast_type === 'danger' ? 'fa-circle-exclamation text-danger' : 'fa-check-circle text-success' ?> fs-4"></i>
            <div>
                <strong class="d-block mb-1"><?= $toast_type === 'danger' ? 'Error' : 'Success' ?></strong>
                <span class="small opacity-75"><?= htmlspecialchars($toast_message) ?></span>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // 1. Theme Logic
        const html = document.documentElement;
        
        // Handle both Desktop and Mobile toggles
        const toggleBtn = document.getElementById('themeToggle');
        const toggleBtnMobile = document.getElementById('themeToggleMobile');
        
        function updateIcons(theme) {
            const iconClass = theme === 'dark' ? 'fa-solid fa-sun' : 'fa-solid fa-moon';
            if(toggleBtn) toggleBtn.querySelector('i').className = iconClass;
            if(toggleBtnMobile) toggleBtnMobile.querySelector('i').className = iconClass;
        }

        function setTheme(theme) {
            html.setAttribute('data-theme', theme);
            localStorage.setItem('theme', theme);
            updateIcons(theme);
            html.style.setProperty('--invert', theme === 'dark' ? '1' : '0');
        }

        const currentTheme = localStorage.getItem('theme') || 'light';
        setTheme(currentTheme);

        const toggleTheme = () => {
            const theme = html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
            setTheme(theme);
        };

        if(toggleBtn) toggleBtn.addEventListener('click', toggleTheme);
        if(toggleBtnMobile) toggleBtnMobile.addEventListener('click', toggleTheme);

        // 2a. Typing Effect (Hero)
        const textElement = document.getElementById('typing-text');
        const texts = ["Full-Stack Developer", "PHP Enthusiast", "System Analyst"];
        let textIndex = 0;
        let charIndex = 0;
        let isDeleting = false;

        function type() {
            const current = texts[textIndex];
            if (isDeleting) {
                textElement.textContent = current.substring(0, charIndex - 1);
                charIndex--;
            } else {
                textElement.textContent = current.substring(0, charIndex + 1);
                charIndex++;
            }

            if (!isDeleting && charIndex === current.length) {
                isDeleting = true;
                setTimeout(type, 2000); // Pause at end
            } else if (isDeleting && charIndex === 0) {
                isDeleting = false;
                textIndex = (textIndex + 1) % texts.length;
                setTimeout(type, 500);
            } else {
                setTimeout(type, isDeleting ? 50 : 100);
            }
        }
        type();

        // 2b. Typing Effect (Navbar Brand)
        const brandElement = document.getElementById('navbar-brand-text');
        const brandText = "Rence.";
        let brandIndex = 0;
        let isBrandDeleting = false;

        function typeBrand() {
            if (isBrandDeleting) {
                brandElement.textContent = brandText.substring(0, brandIndex - 1);
                brandIndex--;
            } else {
                brandElement.textContent = brandText.substring(0, brandIndex + 1);
                brandIndex++;
            }

            if (!isBrandDeleting && brandIndex === brandText.length) {
                isBrandDeleting = true;
                setTimeout(typeBrand, 5000); // Wait 5 seconds before retyping
            } else if (isBrandDeleting && brandIndex === 0) {
                isBrandDeleting = false;
                setTimeout(typeBrand, 500);
            } else {
                setTimeout(typeBrand, isBrandDeleting ? 100 : 150);
            }
        }
        typeBrand();


        // 3. Toast Notification
        <?php if ($toast_message): ?>
        setTimeout(() => {
            document.getElementById('liveToast').classList.add('show');
            setTimeout(() => {
                document.getElementById('liveToast').classList.remove('show');
            }, 5000);
        }, 500);
        <?php endif; ?>

        // 4. Scroll Animations (Intersection Observer)
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = 1;
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        });

        document.querySelectorAll('.fade-up').forEach((el) => {
            el.style.opacity = 0;
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'all 0.8s cubic-bezier(0.5, 0, 0, 1)';
            observer.observe(el);
        });
        
        // 5. Active Nav Link on Scroll
        const sections = document.querySelectorAll('section');
        const navLi = document.querySelectorAll('.nav-link');
        
        // Close mobile menu when link is clicked
        const navCollapse = document.getElementById('navbarNav');
        const bsCollapse = new bootstrap.Collapse(navCollapse, {toggle: false});
        navLi.forEach((li) => {
            li.addEventListener('click', () => { 
                if(window.innerWidth < 992) bsCollapse.hide(); 
            });
        });

        window.onscroll = () => {
            var current = "";
            sections.forEach((section) => {
                const sectionTop = section.offsetTop;
                if (pageYOffset >= sectionTop - 100) {
                    current = section.getAttribute("id");
                }
            });
            navLi.forEach((li) => {
                li.classList.remove("active");
                if (li.getAttribute("href").includes(current)) {
                    li.classList.add("active");
                }
            });
            
            // Navbar Scrolled Effect
            const nav = document.querySelector('.navbar');
            if(window.scrollY > 50) nav.classList.add('scrolled');
            else nav.classList.remove('scrolled');
        };
    </script>
</body>
</html>