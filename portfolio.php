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
            border-radius: 10px;
            padding: 20px;
            margin: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .skill-card:hover {
            transform: translateY(-5px);
        }

        .project-card {
            border-radius: 15px;
            overflow: hidden;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .project-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
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
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
<section id="home" class="hero-section">
    <canvas id="fallingCode"></canvas>
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
                            Hello, Guest from the Internet!
                        </h1>
                       <p class="lead mb-4" style="color:#e0f7fa;">
    My name is <strong>Lorenze Niño Prepotente</strong>, though I often go by <strong>Rence</strong>.<br>
    I am <strong>21 years old</strong> and currently reside in the <strong>Philippines</strong>.<br>
    I am pursuing a degree in <strong>BS Information Systems</strong>.<br>
    I am a dedicated and motivated individual with a passion for coding, committed to developing my skills and growing as a professional developer.
</p>

                        <a href="#contact" class="btn neon-btn">Contact me</a>
                    </div>
                    <div style="flex: 0 0 160px;">
                        <img src="https://th.bing.com/th/id/OIP.mPqg73O-_Ssyj2uCR9G1yAHaHa?cb=iwp2&rs=1&pid=ImgDetMain"
                             alt="Profile"
                             class="img-fluid rounded-circle"
                             style="width: 140px; height: 140px; object-fit: cover; box-shadow: 0 0 20px #00fff799, 0 0 40px #ff00de44; border: 3px solid #00fff7;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- About Section -->
    <section id="about" class="section-padding">
        <div class="container">
            <h2 class="text-center mb-5">About Me</h2>
            <div class="row">
                <div class="col-lg-6">
                    <p class="lead">
                     <?php
$about_text = "I am an aspiring web developer with a passion for building efficient, secure, and user-friendly websites. Skilled in both front-end and back-end development, I strive to bring ideas to life through clean and functional code.";
echo $about_text;
?>

                </div>
                <div class="col-lg-6">
                    <!-- Add your professional image here -->
                    <img src="https://th.bing.com/th/id/OIP.mPqg73O-_Ssyj2uCR9G1yAHaHa?cb=iwp2&rs=1&pid=ImgDetMain" alt="Profile" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="section-padding bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Skills & Technologies</h2>
            <div class="row">
                <?php
                $skills = [
                   ["HTML5", '<i class="devicon-html5-plain colored" style="font-size:3em;"></i>', "https://developer.mozilla.org/en-US/docs/Web/HTML"],
                ["CSS3", '<i class="devicon-css3-plain colored" style="font-size:3em;"></i>', "https://developer.mozilla.org/en-US/docs/Web/CSS"],
                ["JavaScript", '<i class="devicon-javascript-plain colored" style="font-size:3em;"></i>', "https://developer.mozilla.org/en-US/docs/Web/JavaScript"],
                ["PHP", '<i class="devicon-php-plain colored" style="font-size:3em;"></i>', "https://www.php.net/docs.php"],
                ["C++", '<i class="devicon-cplusplus-plain colored" style="font-size:3em;"></i>', "https://cplusplus.com/doc/tutorial/"],
                ["MySQL", '<i class="devicon-mysql-plain colored" style="font-size:3em;"></i>', "https://dev.mysql.com/doc/"]
            ];

               foreach ($skills as $skill) {
                echo '<div class="col-md-4 col-lg-3">';
                echo '<a href="' . $skill[2] . '" target="_blank" class="text-decoration-none">';
                echo '<div class="skill-card text-center">';
                echo $skill[1]; // Use real devicon icons
                echo '<h4>' . $skill[0] . '</h4>';
                echo '</div>';
                echo '</a>';
                echo '</div>';
            }
            ?>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="section-padding">
        <div class="container">
            <h2 class="text-center mb-5">My Projects</h2>
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

                foreach ($projects as $project) {
                    echo '<div class="col-md-6 col-lg-4">';
                    echo '<div class="project-card">';
                    echo '<img src="' . $project["image"] . '" alt="' . $project["title"] . '">';
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
        <h2 class="text-center mb-5">Get In Touch</h2>
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">

                <!-- Contact Buttons with Logos -->
                <div class="contact-buttons">
                    <a href="mailto:Lorenzezz0987@gmail.com" class="btn btn-outline-primary m-2" title="Email Me">
                        <i class="fas fa-envelope fa-2x"></i>
                    </a>
                    <a href="https://www.facebook.com/" target="_blank" class="btn btn-outline-primary m-2" title="Facebook">
                        <i class="fab fa-facebook-f fa-2x"></i>
                    </a>
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
                    <img src="https://th.bing.com/th/id/OIP.mPqg73O-_Ssyj2uCR9G1yAHaHa?cb=iwp2&rs=1&pid=ImgDetMain" alt="Profile" class="ms-2 rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
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
</script>

</body>
</html> 