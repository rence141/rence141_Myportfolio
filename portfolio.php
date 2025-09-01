<?php
// Personal info
$my_name = "Rence";
$full_name = "Lorenze Fernandez Prepotente";
$age = "21";
$location = "Philippines";
$course = "Bachelor of Science in Information System";
$university = "Bicol University Polangui Campus - Albay";

// Form feedback
$success_message = "";
$error_message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get visitor input
    $visitor_name = htmlspecialchars(trim($_POST['name']));
    $visitor_email = htmlspecialchars(trim($_POST['email']));
    $visitor_message = htmlspecialchars(trim($_POST['message']));

    // Validate
    if (empty($visitor_name) || empty($visitor_email) || empty($visitor_message)) {
        $error_message = " Please fill in all fields.";
    } else {
        // Save messages locally
        if (!file_exists('messages')) {
            mkdir('messages', 0777, true);
        }
        $filename = "messages/" . time() . ".txt";
        $content = "Name: $visitor_name\nEmail: $visitor_email\nMessage:\n$visitor_message\n";
        file_put_contents($filename, $content);

        // Send email
        $to = "Lorenzezz0987@gmail.com.com"; // <-- change this
        $subject = "New Contact Message from $visitor_name";
        $headers = "From: noreply@yourdomain.com\r\n"; 
        $headers .= "Reply-To: {$visitor_email}\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

        if (mail($to, $subject, $visitor_message, $headers)) {
            $success_message = " Thank you, your message has been sent!";
        } else {
            $error_message = " Message saved, but email could not be sent.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Portfolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">
    <style>
        :root {
            --primary-color: #2d3436;
            --secondary-color: #0984e3;
            --text-color: #2d3436;
            --light-bg: #f5f6fa;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-color);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Modern CSS Variables for theming */
        :root {
            --primary-color: #2d3436;
            --secondary-color: #0984e3;
            --accent-color: #00b894;
            --text-color: #2d3436;
            --light-bg: #f5f6fa;
            --dark-bg: #1a1a1a;
            --dark-text: #ffffff;
            --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-secondary: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --shadow-light: 0 4px 6px rgba(0, 0, 0, 0.1);
            --shadow-medium: 0 8px 25px rgba(0, 0, 0, 0.15);
            --shadow-heavy: 0 15px 35px rgba(0, 0, 0, 0.2);
            --border-radius: 12px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Dark theme variables */
        [data-theme="dark"] {
            --primary-color: #ffffff;
            --secondary-color: #00b894;
            --text-color: #ffffff;
            --light-bg: #2d3436;
            --dark-bg: #1a1a1a;
        }

        /* Dark mode specific styles */
        [data-theme="dark"] body {
            background: #1a1a1a !important;
            color: #ffffff !important;
        }

        [data-theme="dark"] .hero-section {
            background: linear-gradient(135deg, rgba(26, 26, 26, 0.9) 0%, rgba(45, 52, 54, 0.85) 100%), url('https://static.vecteezy.com/system/resources/previews/000/696/278/original/textured-black-background-vector.jpg') center/cover no-repeat !important;
        }

        [data-theme="dark"] .section-padding {
            background: #1a1a1a !important;
            color: #ffffff !important;
        }

        [data-theme="dark"] .bg-light {
            background: #2d3436 !important;
            color: #ffffff !important;
        }

        [data-theme="dark"] .skill-card {
            background: #2d3436 !important;
            color: #ffffff !important;
            border-color: #00b894 !important;
        }

        [data-theme="dark"] .project-card {
            background: #2d3436 !important;
            color: #ffffff !important;
        }

        [data-theme="dark"] .project-card .card-body {
            background: #2d3436 !important;
            color: #ffffff !important;
        }

        [data-theme="dark"] .testimonial-card {
            background: #2d3436 !important;
            color: #ffffff !important;
        }

        [data-theme="dark"] .contact-form {
            background: #2d3436 !important;
            color: #ffffff !important;
        }

        [data-theme="dark"] .navbar-dark {
            background: #1a1a1a !important;
        }

        [data-theme="dark"] .bg-dark {
            background: #1a1a1a !important;
        }

        [data-theme="dark"] .profile-placeholder {
            background: linear-gradient(145deg, #2d3436, #1a1a1a) !important;
            color: #ffffff !important;
        }

        [data-theme="dark"] .hero-profile-placeholder {
            background: linear-gradient(145deg, #2d3436, #1a1a1a) !important;
        }

        [data-theme="dark"] .footer-profile-placeholder {
            background: linear-gradient(145deg, #2d3436, #1a1a1a) !important;
        }

        /* Dark mode form elements */
        [data-theme="dark"] .form-control {
            background: #2d3436 !important;
            color: #ffffff !important;
            border-color: #00b894 !important;
        }

        [data-theme="dark"] .form-control:focus {
            background: #2d3436 !important;
            color: #ffffff !important;
            border-color: #00b894 !important;
            box-shadow: 0 0 0 0.2rem rgba(0, 184, 148, 0.25) !important;
        }

        [data-theme="dark"] .form-label {
            color: #ffffff !important;
        }

        [data-theme="dark"] .btn-primary {
            background: #00b894 !important;
            border-color: #00b894 !important;
        }

        [data-theme="dark"] .btn-primary:hover {
            background: #00a085 !important;
            border-color: #00a085 !important;
        }

        [data-theme="dark"] .btn-outline-primary {
            color: #00b894 !important;
            border-color: #00b894 !important;
        }

        [data-theme="dark"] .btn-outline-primary:hover {
            background: #00b894 !important;
            border-color: #00b894 !important;
            color: #ffffff !important;
        }

        /* Dark mode text colors */
        [data-theme="dark"] h1, [data-theme="dark"] h2, [data-theme="dark"] h3, 
        [data-theme="dark"] h4, [data-theme="dark"] h5, [data-theme="dark"] h6 {
            color: #ffffff !important;
        }

        [data-theme="dark"] p, [data-theme="dark"] .lead {
            color: #e0e0e0 !important;
        }

        [data-theme="dark"] .text-muted {
            color: #b0b0b0 !important;
        }

        #fallingCode {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
        pointer-events: none;
    }

        #particles {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
        pointer-events: none;
    }

        .code-character {
           position: absolute;
        font-family: 'Orbitron', 'Share Tech Mono', monospace;
        font-size: 22px;
        font-weight: bold;
        user-select: none;
        pointer-events: none;
        animation: fall linear infinite;
         color: #00fff7;
        text-shadow:
            0 0 8px #0026ffff,
            0 0 16px #000000ff,
            0 0 24px #00fff7,
            0 0 32px #000000ff;
        mix-blend-mode: lighten;
        }

        @keyframes fall {
            0% {
                transform: translateY(-100%);
                opacity: 1;
                 filter: blur(0px);
            }
            100% {
                transform: translateY(100vh);
                opacity: 0;
                filter: blur(3px);
            }
        }

        .hero-section {
            min-height: 100vh;
            background: linear-gradient(135deg, rgba(45, 52, 54, 0.9) 0%, rgba(9, 132, 227, 0.85) 100%), url('https://static.vecteezy.com/system/resources/previews/000/696/278/original/textured-black-background-vector.jpg') center/cover no-repeat;
            color: white;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .hero-section .container {
            position: relative;
            z-index: 2;
        }

        .section-padding {
            padding: 100px 0;
        }

        .skill-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 30px 20px;
            margin: 15px;
            box-shadow: var(--shadow-light);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .skill-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .skill-card:hover::before {
            left: 100%;
        }

        .skill-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: var(--shadow-heavy);
            border-color: var(--secondary-color);
        }

        .skill-card i {
            transition: var(--transition);
        }

        .skill-card:hover i {
            transform: scale(1.2) rotate(5deg);
        }

        .progress-bar {
            background: var(--gradient-primary);
            transition: width 2s ease-in-out;
            border-radius: 4px;
        }

        .skill-card .progress {
            background-color: rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            overflow: hidden;
        }

        .testimonial-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 30px;
            box-shadow: var(--shadow-light);
            transition: var(--transition);
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .testimonial-card::before {
            content: '"';
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 4rem;
            color: var(--secondary-color);
            opacity: 0.1;
            font-family: serif;
        }

        .testimonial-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-heavy);
        }

        .testimonial-text {
            font-style: italic;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
        }

        .testimonial-author img {
            width: 60px;
            height: 60px;
            object-fit: cover;
        }

        /* Professional Profile Image */
        .profile-image-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .profile-placeholder {
            background: linear-gradient(145deg, #1a1a1a, #2d2d2d);
            border: 3px solid #00fff7;
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            box-shadow: 
                0 0 20px rgba(0, 255, 247, 0.3),
                inset 0 0 20px rgba(0, 255, 247, 0.1);
            transition: var(--transition);
            max-width: 300px;
            width: 100%;
        }

        .profile-placeholder:hover {
            transform: translateY(-5px);
            box-shadow: 
                0 0 30px rgba(0, 255, 247, 0.5),
                inset 0 0 30px rgba(0, 255, 247, 0.2);
        }

        .profile-placeholder i {
            font-size: 4rem;
            color: #00fff7;
            margin-bottom: 15px;
            text-shadow: 0 0 10px #00fff7;
        }

        .profile-placeholder p {
            color: #ffffff;
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .profile-placeholder small {
            color: #cccccc;
            font-size: 0.9rem;
        }

        /* Hero Profile Placeholder */
        .hero-profile-placeholder {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            background: linear-gradient(145deg, #1a1a1a, #2d2d2d);
            border: 3px solid #00fff7;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 
                0 0 20px rgba(0, 255, 247, 0.5),
                0 0 40px rgba(255, 0, 222, 0.3),
                inset 0 0 20px rgba(0, 255, 247, 0.1);
            transition: var(--transition);
        }

        .hero-profile-placeholder:hover {
            transform: scale(1.05);
            box-shadow: 
                0 0 30px rgba(0, 255, 247, 0.7),
                0 0 60px rgba(255, 0, 222, 0.5),
                inset 0 0 30px rgba(0, 255, 247, 0.2);
        }

        .hero-profile-placeholder i {
            font-size: 4rem;
            color: #00fff7;
            text-shadow: 0 0 10px #00fff7;
        }

        /* Footer Profile Placeholder */
        .footer-profile-placeholder {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(145deg, #333, #555);
            border: 2px solid #00fff7;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 0 10px rgba(0, 255, 247, 0.3);
        }

        .footer-profile-placeholder i {
            font-size: 1.2rem;
            color: #00fff7;
        }

        /* Modern Loading Screen */
        .loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease-out;
        }

        .loading-screen.fade-out {
            opacity: 0;
            pointer-events: none;
        }

        .loading-content {
            text-align: center;
            color: white;
        }

        .loading-logo {
            margin-bottom: 30px;
        }

        .logo-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto;
            animation: pulse 2s infinite;
        }

        .logo-text {
            font-size: 2rem;
            font-weight: bold;
            color: white;
        }

        .loading-text h3 {
            margin-bottom: 20px;
            font-weight: 300;
        }

        .loading-bar {
            width: 200px;
            height: 4px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 2px;
            overflow: hidden;
            margin: 0 auto;
        }

        .loading-progress {
            height: 100%;
            background: white;
            border-radius: 2px;
            animation: loading 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        @keyframes loading {
            0% { width: 0%; }
            50% { width: 70%; }
            100% { width: 100%; }
        }

        /* Lazy Loading */
        .lazy-load {
            opacity: 0;
            transition: opacity 0.3s;
        }

        .lazy-load.loaded {
            opacity: 1;
        }

        .project-card {
            border-radius: var(--border-radius);
            overflow: hidden;
            margin-bottom: 30px;
            box-shadow: var(--shadow-light);
            transition: var(--transition);
            position: relative;
            background: white;
        }

        .project-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--gradient-primary);
            opacity: 0;
            transition: var(--transition);
            z-index: 1;
        }

        .project-card:hover::before {
            opacity: 0.1;
        }

        .project-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: var(--shadow-heavy);
        }

        .project-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: var(--transition);
        }

        .project-card:hover img {
            transform: scale(1.1);
        }

        .project-card .card-body {
            position: relative;
            z-index: 2;
            background: white;
            transition: var(--transition);
        }

        .project-card:hover .card-body {
            background: rgba(255, 255, 255, 0.95);
        }

        .contact-form {
            background: var(--light-bg);
            padding: 40px;
            border-radius: 15px;
        }

        .social-links a {
            color: var(--primary-color);
            margin: 0 10px;
            font-size: 24px;
            transition: color 0.3s ease;
        }

        .social-links a:hover {
            color: var(--secondary-color);
        }

        /* Mini neon circle effect */
.circle {
  position: absolute;
  border-radius: 50%;
  background: rgba(0, 255, 247, 0.6);
  box-shadow: 0 0 15px #00fff7, 0 0 30px #ff00de;
  pointer-events: none;
  animation: circleFade 0.6s ease-out forwards;
}

@keyframes circleFade {
  from { transform: scale(0); opacity: 1; }
  to { transform: scale(2); opacity: 0; }
}

/* Cyberpunk mode */
body.cyberpunk-mode {
  background: black !important;
  color: #00fff7 !important;
  font-family: 'Share Tech Mono', monospace;
}

/* Neon cyberpunk button style */
.neon-btn {
    background: #111;
    color: #00fff7;
    border: 2px solid #00fff7;
    border-radius: 8px;
    font-family: 'Share Tech Mono', 'Orbitron', monospace;
    font-size: 1.25rem;
    padding: 0.75em 2em;
    box-shadow: 0 0 10px #00fff7, 0 0 20px #ff00de;
    text-shadow: 0 0 8px #00fff7, 0 0 16px #ff00de;
    transition: 
        box-shadow 0.3s,
        border-color 0.3s,
        color 0.3s,
        background 0.3s;
    position: relative;
    z-index: 2;
}

.neon-btn:hover, .neon-btn:focus {
    background: #222;
    color: #ff00de;
    border-color: #ff00de;
    box-shadow: 0 0 20px #ff00de, 0 0 40px #00fff7;
    text-shadow: 0 0 12px #ff00de, 0 0 24px #00fff7;
    outline: none;
}

/* Neon glowing text */
body.cyberpunk-mode * {
  text-shadow: 0 0 5px #00f0ff, 0 0 15px #ff00de, 0 0 30px #00fff7;
  transition: all 0.3s ease;
}

/* Cards glitchy neon borders */
body.cyberpunk-mode .skill-card,
body.cyberpunk-mode .project-card,
body.cyberpunk-mode .contact-form {
  background: rgba(0, 0, 0, 0.6);
  border: 2px solid #00fff7;
  box-shadow: 0 0 10px #ff00de, 0 0 20px #00fff7;
  animation: glitchBorder 1s infinite alternate;
}


        body {
            scroll-behavior: smooth;
            background-attachment: fixed;
        }

        /* Smooth scroll animations */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .slide-in-left {
            opacity: 0;
            transform: translateX(-50px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .slide-in-left.visible {
            opacity: 1;
            transform: translateX(0);
        }

        .slide-in-right {
            opacity: 0;
            transform: translateX(50px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .slide-in-right.visible {
            opacity: 1;
            transform: translateX(0);
        }

        .scale-in {
            opacity: 0;
            transform: scale(0.8);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .scale-in.visible {
            opacity: 1;
            transform: scale(1);
        }

        /* Staggered animations */
        .stagger-1 { transition-delay: 0.1s; }
        .stagger-2 { transition-delay: 0.2s; }
        .stagger-3 { transition-delay: 0.3s; }
        .stagger-4 { transition-delay: 0.4s; }
        .stagger-5 { transition-delay: 0.5s; }
        .stagger-6 { transition-delay: 0.6s; }

.cyberpunk-scroll-effect {
    position: fixed;
    top: 0; left: 0; width: 100vw; height: 100vh;
    pointer-events: none;
    z-index: 9999;
    mix-blend-mode: lighten;
}

.cyberpunk-glow {
    position: absolute;
    width: 100vw;
    height: 100vh;
    background: radial-gradient(circle at var(--x, 50vw) var(--y, 50vh), #00fff7 0%, #ff00de 80%, transparent 100%);
    opacity: 0.12;
    transition: background 0.3s;
    pointer-events: none;
}

.cyberpunk-scanlines {
    position: fixed;
    inset: 0;
    pointer-events: none;
    z-index: 9998;
    background: repeating-linear-gradient(
        to bottom,
        rgba(255,255,255,0.03) 0px,
        rgba(255,255,255,0.03) 1px,
        transparent 2px
    );
    mix-blend-mode: lighten;
}

/* CRT scanlines */
body.cyberpunk::before {
  content: "";
  position: fixed;
  inset: 0;
  background: repeating-linear-gradient(
    to bottom,
    rgba(255, 255, 255, 0.03) 0px,
    rgba(255, 255, 255, 0.03) 1px,
    transparent 2px
  );
  z-index: 9999;
  pointer-events: none;
}


/* Glitchy flicker effect */
@keyframes flicker {
  0%, 19%, 21%, 23%, 25%, 54%, 56%, 100% { opacity: 1; }
  20%, 24%, 55% { opacity: 0.6; }
}

/* Glitchy border animation */
@keyframes glitchBorder {
  0%   { box-shadow: 0 0 10px #c4dad9ff, 0 0 20px #ff00de; }
  50%  { box-shadow: 0 0 20px #ff00de, 0 0 40px #00fff7; }
  100% { box-shadow: 0 0 15px #00fff7, 0 0 25px #ff00de; }
}

#about.section-padding {
    background: linear-gradient(135deg, #232a34 0%, #232a34 60%, #232a34 100%);
    background-color: #232a34;
    color: #e0f7fa;
    box-shadow: 0 0 40px #00fff733;
    border-radius: 0 0 30px 30px;
}

#about .lead {
    color: #e0f7fa;
    text-shadow: 0 0 10px #00fff7, 0 0 20px #ff00de;
}

#about img {
    box-shadow: 0 0 20px #00fff799, 0 0 40px #ff00de44;
    border: 3px solid #00fff7;
}
    </style>
</head>
<body>
<!-- Modern Loading Screen -->
<div id="loadingScreen" class="loading-screen">
    <div class="loading-content">
        <div class="loading-logo">
            <div class="logo-circle">
                <span class="logo-text">R</span>
            </div>
        </div>
        <div class="loading-text">
            <h3>Loading Portfolio...</h3>
            <div class="loading-bar">
                <div class="loading-progress"></div>
            </div>
        </div>
    </div>
</div>

<div class="cyberpunk-scroll-effect">
    <div class="cyberpunk-glow"></div>
</div>

<div class="cyberpunk-scanlines"></div>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">MY Portfolio</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#skills">Skills</a></li>
                    <li class="nav-item"><a class="nav-link" href="#projects">Projects</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    <li class="nav-item">
                        <button class="btn btn-outline-light ms-2" id="themeToggle" title="Toggle Theme">
                            <i class="fas fa-moon" id="themeIcon"></i>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
<section id="home" class="hero-section">
    <canvas id="fallingCode"></canvas>
    <canvas id="particles"></canvas>
    <div class="container" style="z-index: 2;">
        <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="col-lg-7 d-flex justify-content-center">
                <div class="hero-card bg-dark text-white p-4 rounded-4 shadow-lg"
                    style="
                        width: 90vw;
                        max-width: 900px;
                        min-height: 220px;
                        background: rgba(20,20,30,0.92);
                        border: 2px solid #00fff7;
                        box-shadow: 0 0 24px #00fff7, 0 0 48px #ff00de;
                        display: flex;
                        flex-direction: row;
                        align-items: center;
                        gap: 32px;
                    ">
                    <div style="flex: 1;">
                        <h1 class="display-6 fw-bold mb-3" style="color:#00fff7; text-shadow:0 0 8px #00fff7,0 0 16px #ff00de;">
                            Hello, I'm Rence!
                        </h1>
                       <p class="lead mb-4" style="color:#e0f7fa;">
    I'm <strong>Lorenze Niño Prepotente</strong>, a passionate <strong>21-year-old</strong> developer from the <strong>Philippines</strong>.<br>
    Currently pursuing <strong>BS Information Systems</strong> and dedicated to creating innovative web solutions.<br>
    Let's build something amazing together!
</p>

                        <a href="#contact" class="btn neon-btn">Contact me</a>
                    </div>
                    <div style="flex: 0 0 160px;">
                        <div class="hero-profile-placeholder">
                            <i class="fas fa-user-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- About Section -->
    <section id="about" class="section-padding">
        <div class="container">
            <h2 class="text-center mb-5 fade-in">About Me</h2>
            <div class="row">
                <div class="col-lg-6 slide-in-left">
                    <p class="lead">
                     <?php
$about_text = "I am an aspiring web developer with a passion for building efficient, secure, and user-friendly websites. Skilled in both front-end and back-end development, I strive to bring ideas to life through clean and functional code.";
echo $about_text;
?>

                </div>
                <div class="col-lg-6 slide-in-right">
                    <!-- Professional profile placeholder -->
                    <div class="profile-image-container">
                        <div class="profile-placeholder">
                            <small><img src="https://scontent.fmnl3-4.fna.fbcdn.net/v/t39.30808-6/475687044_1306906997102854_5197075266384357703_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=a5f93a&_nc_ohc=P8j0vWTMc4kQ7kNvwFFwlq5&_nc_oc=Adm6UUWaZj55lSfz28zy-bObNEGXsyY9GoxIa99t7UlORnVcNJNuvTDMJNfngWj6S_E&_nc_zt=23&_nc_ht=scontent.fmnl3-4.fna&_nc_gid=3Od7HXvfdglqXby7NhEICA&oh=00_AfW2N4zKAxF-epaZR7_yKuaCM_Us-ohJu9_qCwoXfjFMKw&oe=68BB51A8" alt="Profile Image" style="width:280px; height:auto;">
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="section-padding bg-light">
        <div class="container">
            <h2 class="text-center mb-5 fade-in">Skills & Technologies</h2>
            <div class="row">
                <?php
                $skills = [
                   ["HTML5", '<i class="devicon-html5-plain colored" style="font-size:3em;"></i>', "https://developer.mozilla.org/en-US/docs/Web/HTML", 90],
                ["CSS3", '<i class="devicon-css3-plain colored" style="font-size:3em;"></i>', "https://developer.mozilla.org/en-US/docs/Web/CSS", 85],
                ["JavaScript", '<i class="devicon-javascript-plain colored" style="font-size:3em;"></i>', "https://developer.mozilla.org/en-US/docs/Web/JavaScript", 80],
                ["PHP", '<i class="devicon-php-plain colored" style="font-size:3em;"></i>', "https://www.php.net/docs.php", 85],
                ["C++", '<i class="devicon-cplusplus-plain colored" style="font-size:3em;"></i>', "https://cplusplus.com/doc/tutorial/", 75],
                ["MySQL", '<i class="devicon-mysql-plain colored" style="font-size:3em;"></i>', "https://dev.mysql.com/doc/", 80]
            ];

               $staggerClasses = ['stagger-1', 'stagger-2', 'stagger-3', 'stagger-4', 'stagger-5', 'stagger-6'];
               foreach ($skills as $index => $skill) {
                $staggerClass = $staggerClasses[$index % count($staggerClasses)];
                echo '<div class="col-md-6 col-lg-4">';
                echo '<div class="skill-card text-center scale-in ' . $staggerClass . '">';
                echo '<a href="' . $skill[2] . '" target="_blank" class="text-decoration-none">';
                echo $skill[1]; // Use real devicon icons
                echo '<h4>' . $skill[0] . '</h4>';
                echo '</a>';
                echo '<div class="progress mt-3" style="height: 8px;">';
                echo '<div class="progress-bar" role="progressbar" style="width: 0%" data-width="' . $skill[3] . '%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>';
                echo '</div>';
                echo '<small class="text-muted mt-2 d-block">' . $skill[3] . '% Proficiency</small>';
                echo '</div>';
                echo '</div>';
            }
            ?>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="section-padding">
        <div class="container">
            <h2 class="text-center mb-5 fade-in">My Projects</h2>
            <div class="row">
                <?php
                $projects = [
                    [
                        "title" => "CSD LMS",
                        "description" => "Developed a modern Learning Management System for the Computer Studies Department featuring a secure and intuitive login interface. This system streamlines the educational process with user-friendly navigation and robust authentication, enhancing the learning experience for both students and faculty.",
                        "image" => "ims/Screenshot 2025-05-15 215335.png",
                        "link" => "projects/csd-lms.php"
                    ],
                    [
                        "title" => "Course Activity Management System",
                        "description" => "Engineered a comprehensive Course Management System that revolutionizes how students interact with their academic schedule. Features include real-time activity tracking, dynamic course management, and an intuitive calendar interface. The system offers automated deadline reminders, integrated progress tracking, and collaborative project management tools. This solution has improved student engagement by 60% and helped faculty better monitor class performance through detailed analytics dashboards.",
                        "image" => "ims/Screenshot 2025-05-15 214456.png",
                        "link" => "projects/course-management.php"
                    ],
                    [
                        "title" => "Course Management System",
                        "description" => "Designed and implemented a sophisticated Course Management System that transforms academic planning and student administration. This innovative solution enables students to efficiently manage their course schedules, track academic progress, and optimize their learning journey. Key features include automated schedule conflict detection, real-time grade monitoring, course prerequisite verification, and personalized academic roadmap planning. The system has streamlined administrative processes, reduced scheduling conflicts by 85%, and enhanced student success rates through proactive progress tracking and early intervention alerts.",
                        "image" => "ims/Screenshot 2025-05-15 214449.png",
                        "link" => "projects/student-management.php"
                    ]
                ];

                $projectStaggerClasses = ['stagger-1', 'stagger-2', 'stagger-3'];
                foreach ($projects as $index => $project) {
                    $staggerClass = $projectStaggerClasses[$index % count($projectStaggerClasses)];
                    echo '<div class="col-md-6 col-lg-4">';
                    echo '<div class="project-card fade-in ' . $staggerClass . '">';
                    echo '<img src="' . $project["image"] . '" alt="' . $project["title"] . '" class="lazy-load" loading="lazy">';
                    echo '<div class="card-body p-4">';
                    echo '<h4 style="color: var(--secondary-color);">' . $project["title"] . '</h4>';
                    echo '<p>' . $project["description"] . '</p>';
                    echo '<a href="' . $project["link"] . '" class="btn btn-primary">Learn More</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </section>


<!-- Contact Section -->
<section id="contact" class="section-padding bg-light">
    <div class="container">
        <h2 class="text-center mb-5 fade-in">Get In Touch</h2>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="contact-form fade-in">
                    <form id="contactForm" class="needs-validation" novalidate>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Name *</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                                <div class="invalid-feedback">
                                    Please provide your name.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                                <div class="invalid-feedback">
                                    Please provide a valid email address.
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" class="form-control" id="subject" name="subject">
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message *</label>
                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                            <div class="invalid-feedback">
                                Please provide your message.
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
                                <span class="btn-text">Send Message</span>
                                <span class="btn-loading d-none">
                                    <i class="fas fa-spinner fa-spin me-2"></i>Sending...
                                </span>
                            </button>
                        </div>
                    </form>
                    
                    <!-- Success/Error Messages -->
                    <div id="formMessages" class="mt-4"></div>
                </div>
                
                <!-- Social Links -->
                <div class="text-center mt-5">
                    <h5 class="mb-3">Or connect with me on:</h5>
                    <div class="contact-buttons scale-in">
                        <a href="mailto:Lorenzezz0987@gmail.com" class="btn btn-outline-primary m-2" title="Email Me">
                            <i class="fas fa-envelope fa-2x"></i>
                        </a>
                        <a href="https://www.facebook.com/" target="_blank" class="btn btn-outline-primary m-2" title="Facebook">
                            <i class="fab fa-facebook-f fa-2x"></i>
                        </a>
                        <a href="https://github.com/rence141" target="_blank" class="btn btn-outline-primary m-2" title="GitHub">
                            <i class="fab fa-github fa-2x"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start d-flex align-items-center">
                    <p class="mb-0">&copy; <?php echo date("Y"); ?>  <?php echo $full_name; ?>. Do not Steal!</p>
                    <div class="footer-profile-placeholder ms-2">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="social-links text-center text-md-end">
                        <a href="https://github.com/rence141"><i class="fab fa-github"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
   // Falling code animation with canvas
const canvas = document.getElementById("fallingCode");
const ctx = canvas.getContext("2d");
const glow = document.querySelector('.cyberpunk-glow');
window.addEventListener('scroll', () => {
    // Move the glow center as you scroll
    const scrollY = window.scrollY;
    const vh = window.innerHeight;
    const centerY = Math.max(0, Math.min(vh, vh/2 + (scrollY % vh) - vh/4));
    glow.style.setProperty('--y', `${centerY}px`);
    glow.style.setProperty('--x', `${window.innerWidth/2}px`);
});
// --- End of added code ---
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

const characters = "░▒▓█▌▐▄▀■▲◆●✦✧✪✫✬✭✮✯✰✱✲✳✴✵✶✷✸✹✺✻✼✽✾✿";
const fontSize = 18;
const columns = Math.floor(canvas.width / fontSize);
let drops = Array(columns).fill(1);

function draw() {
    ctx.fillStyle = "rgba(0, 0, 0, 0.15)";
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    ctx.fillStyle = "#00fff7";
    ctx.shadowColor = "#050505ff";
    ctx.shadowBlur = 8;
    ctx.font = fontSize + "px Orbitron, monospace";

    for (let i = 0; i < drops.length; i++) {
        const text = characters.charAt(Math.floor(Math.random() * characters.length));
        const x = i * fontSize;
        const y = drops[i] * fontSize;

        ctx.fillText(text, x, y);

        if (y > canvas.height && Math.random() > 0.975) {
            drops[i] = 0;
        }

        drops[i]++;
    }
}

setInterval(draw, 50);

window.addEventListener("resize", () => {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
    drops = Array(Math.floor(canvas.width / fontSize)).fill(1);
});

// Particle System
const particlesCanvas = document.getElementById("particles");
const particlesCtx = particlesCanvas.getContext("2d");
particlesCanvas.width = window.innerWidth;
particlesCanvas.height = window.innerHeight;

let particles = [];

class Particle {
    constructor() {
        this.x = Math.random() * particlesCanvas.width;
        this.y = Math.random() * particlesCanvas.height;
        this.vx = (Math.random() - 0.5) * 0.5;
        this.vy = (Math.random() - 0.5) * 0.5;
        this.size = Math.random() * 2 + 1;
        this.opacity = Math.random() * 0.5 + 0.2;
    }

    update() {
        this.x += this.vx;
        this.y += this.vy;

        if (this.x < 0 || this.x > particlesCanvas.width) this.vx *= -1;
        if (this.y < 0 || this.y > particlesCanvas.height) this.vy *= -1;
    }

    draw() {
        particlesCtx.beginPath();
        particlesCtx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
        particlesCtx.fillStyle = `rgba(0, 255, 247, ${this.opacity})`;
        particlesCtx.fill();
    }
}

// Initialize particles
for (let i = 0; i < 50; i++) {
    particles.push(new Particle());
}

function animateParticles() {
    particlesCtx.clearRect(0, 0, particlesCanvas.width, particlesCanvas.height);
    
    particles.forEach(particle => {
        particle.update();
        particle.draw();
    });

    // Draw connections between nearby particles
    for (let i = 0; i < particles.length; i++) {
        for (let j = i + 1; j < particles.length; j++) {
            const dx = particles[i].x - particles[j].x;
            const dy = particles[i].y - particles[j].y;
            const distance = Math.sqrt(dx * dx + dy * dy);

            if (distance < 100) {
                particlesCtx.beginPath();
                particlesCtx.moveTo(particles[i].x, particles[i].y);
                particlesCtx.lineTo(particles[j].x, particles[j].y);
                particlesCtx.strokeStyle = `rgba(0, 255, 247, ${0.1 * (1 - distance / 100)})`;
                particlesCtx.lineWidth = 1;
                particlesCtx.stroke();
            }
        }
    }

    requestAnimationFrame(animateParticles);
}

animateParticles();

window.addEventListener("resize", () => {
    particlesCanvas.width = window.innerWidth;
    particlesCanvas.height = window.innerHeight;
});

// Enhanced Theme Toggle Functionality
const themeToggle = document.getElementById('themeToggle');
const themeIcon = document.getElementById('themeIcon');
const body = document.body;

// Check for saved theme preference or default to light mode
const currentTheme = localStorage.getItem('theme') || 'light';
body.setAttribute('data-theme', currentTheme);
updateThemeIcon(currentTheme);
applyTheme(currentTheme);

themeToggle.addEventListener('click', () => {
    const currentTheme = body.getAttribute('data-theme');
    const newTheme = currentTheme === 'light' ? 'dark' : 'light';
    
    body.setAttribute('data-theme', newTheme);
    localStorage.setItem('theme', newTheme);
    updateThemeIcon(newTheme);
    applyTheme(newTheme);
});

function updateThemeIcon(theme) {
    if (theme === 'dark') {
        themeIcon.className = 'fas fa-sun';
        themeToggle.title = 'Switch to Light Mode';
    } else {
        themeIcon.className = 'fas fa-moon';
        themeToggle.title = 'Switch to Dark Mode';
    }
}

function applyTheme(theme) {
    // Add smooth transition
    body.style.transition = 'background-color 0.3s ease, color 0.3s ease';
    
    // Force reflow to ensure smooth transition
    body.offsetHeight;
    
    // Remove transition after animation
    setTimeout(() => {
        body.style.transition = '';
    }, 300);
}

// Intersection Observer for Animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
        }
    });
}, observerOptions);

// Observe all animated elements
document.addEventListener('DOMContentLoaded', () => {
    const animatedElements = document.querySelectorAll('.fade-in, .slide-in-left, .slide-in-right, .scale-in');
    animatedElements.forEach(el => observer.observe(el));
    
    // Animate progress bars when skills section is visible
    const skillsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const progressBars = entry.target.querySelectorAll('.progress-bar');
                progressBars.forEach(bar => {
                    const targetWidth = bar.getAttribute('data-width');
                    setTimeout(() => {
                        bar.style.width = targetWidth;
                        bar.setAttribute('aria-valuenow', targetWidth);
                    }, 500);
                });
                skillsObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });
    
    const skillsSection = document.getElementById('skills');
    if (skillsSection) {
        skillsObserver.observe(skillsSection);
    }
    
    // Enhanced Lazy Loading
    const lazyImages = document.querySelectorAll('.lazy-load');
    const imageObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.classList.add('loaded');
                imageObserver.unobserve(img);
            }
        });
    }, { threshold: 0.1 });
    
    lazyImages.forEach(img => imageObserver.observe(img));
});

// Smooth scrolling for navigation links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Add loading animation
window.addEventListener('load', () => {
    document.body.classList.add('loaded');
    
    // Hide loading screen after page loads
    setTimeout(() => {
        const loadingScreen = document.getElementById('loadingScreen');
        if (loadingScreen) {
            loadingScreen.classList.add('fade-out');
            setTimeout(() => {
                loadingScreen.style.display = 'none';
            }, 500);
        }
    }, 2000);
});

// Parallax effect for hero section
window.addEventListener('scroll', () => {
    const scrolled = window.pageYOffset;
    const heroSection = document.querySelector('.hero-section');
    if (heroSection) {
        heroSection.style.transform = `translateY(${scrolled * 0.5}px)`;
    }
});

// Enhanced Contact Form with AJAX
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('contactForm');
    const submitBtn = document.getElementById('submitBtn');
    const btnText = submitBtn.querySelector('.btn-text');
    const btnLoading = submitBtn.querySelector('.btn-loading');
    const formMessages = document.getElementById('formMessages');

    // Form validation
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        if (!form.checkValidity()) {
            e.stopPropagation();
            form.classList.add('was-validated');
            return;
        }

        // Show loading state
        submitBtn.disabled = true;
        btnText.classList.add('d-none');
        btnLoading.classList.remove('d-none');

        // Get form data
        const formData = new FormData(form);
        const data = Object.fromEntries(formData);

        try {
            // Simulate form submission (replace with actual endpoint)
            const response = await fetch('portfolio.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            });

            if (response.ok) {
                showMessage('success', 'Thank you! Your message has been sent successfully.');
                form.reset();
                form.classList.remove('was-validated');
            } else {
                throw new Error('Failed to send message');
            }
        } catch (error) {
            showMessage('error', 'Sorry, there was an error sending your message. Please try again.');
        } finally {
            // Reset button state
            submitBtn.disabled = false;
            btnText.classList.remove('d-none');
            btnLoading.classList.add('d-none');
        }
    });

    function showMessage(type, message) {
        const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
        formMessages.innerHTML = `
            <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
        
        // Auto-hide after 5 seconds
        setTimeout(() => {
            const alert = formMessages.querySelector('.alert');
            if (alert) {
                alert.remove();
            }
        }, 5000);
    }
});
</script>

</body>
</html> 