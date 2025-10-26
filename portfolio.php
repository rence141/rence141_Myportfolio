<?php
/* ──────────────────────────────────────
   Personal Info & Contact Form
   ────────────────────────────────────── */
$full_name = "Lorenze Fernandez Prepotente";
$age       = "21";
$location  = "Philippines";
$course    = "Bachelor of Science in Information Systems";
$university= "Bicol University Polangui Campus - Albay";

$success_message = $error_message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $visitor_name    = htmlspecialchars(trim($_POST['name']));
    $visitor_email   = htmlspecialchars(trim($_POST['email']));
    $visitor_message = htmlspecialchars(trim($_POST['message']));

    if (empty($visitor_name) || empty($visitor_email) || empty($visitor_message)) {
        $error_message = "Please fill in all required fields.";
    } else {
        if (!is_dir('messages')) mkdir('messages', 0777, true);
        $filename = "messages/".time().".txt";
        $content  = "Name: $visitor_name\nEmail: $visitor_email\nMessage:\n$visitor_message\n\n";
        file_put_contents($filename, $content);

        $to      = "Lorenzezz0987@gmail.com";
        $subject = "New Portfolio Message from $visitor_name";
        $headers = "From: noreply@portfolio.local\r\nReply-To: $visitor_email\r\nX-Mailer: PHP/".phpversion();

        if (mail($to, $subject, $visitor_message, $headers)) {
            $success_message = "Thank you! Your message has been sent.";
        } else {
            $error_message = "Message saved locally, but email failed.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rence | Portfolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
    :root{
        --primary:#4361ee;--primary-dark:#3a56d4;--secondary:#7209b7;--success:#06d6a0;
        --light:#f8f9fa;--dark:#212529;--gray:#6c757d;--border:#dee2e6;
        --shadow:0 4px 12px rgba(0,0,0,.1);--radius:12px;--transition:all .3s ease;

        /* Text Colors */
        --text-primary:#212529;
        --text-secondary:#495057;
        --text-muted:#6c757d;
    }
    [data-theme="dark"]{
        --light:#212529;--dark:#f8f9fa;--border:#343a40;
        --primary:#5e81ff;--secondary:#a855f7;

        /* Dark Mode Text Colors */
        --text-primary:#e9ecef;
        --text-secondary:#ced4da;
        --text-muted:#adb5bd;
    }

    *{margin:0;padding:0;box-sizing:border-box;}
    body{
        font-family:'Inter',sans-serif;background:var(--light);color:var(--text-primary);
        line-height:1.7;transition:var(--transition);
    }
    [data-theme="dark"] body{background:#121212;color:var(--text-primary);}

    /* Headings */
    h1, h2, h3, h4, h5, h6 {
        color: var(--text-primary);
        font-weight: 700;
    }
    h1 { font-size: 3.5rem; }
    h2 { font-size: 2.25rem; }
    h5 { font-size: 1.25rem; }

    /* Paragraphs & Text */
    p, .lead, .text-muted, small {
        color: var(--text-secondary);
    }
    .text-muted, small {
        color: var(--text-muted) !important;
    }

    /* ---------- Navbar ---------- */
    .navbar{
        backdrop-filter:blur(10px);
        background:rgba(255,255,255,.9)!important;
        border-bottom:1px solid var(--border);
    }
    [data-theme="dark"] .navbar{background:rgba(33,37,41,.95)!important;}
    .navbar-brand{font-weight:700;color:var(--primary)!important;}
    .nav-link { color: var(--text-primary) !important; }
    .nav-link:hover { color: var(--primary) !important; }

    /* ---------- Hero ---------- */
    .hero{
        min-height:100vh;display:flex;align-items:center;
        background:linear-gradient(135deg,#667eea,#764ba2);color:#fff;
        position:relative;overflow:hidden;
    }
    .hero::before{
        content:'';position:absolute;inset:0;
        background:rgba(0,0,0,.3);z-index:1;
    }
    .hero .container{position:relative;z-index:2;}
    .hero h1, .hero p { color: #fff; }
    .hero .lead { opacity: 0.95; }
    .profile-img{
        width:180px;height:180px;border-radius:50%;
        border:6px solid rgba(255,255,255,.3);object-fit:cover;
        box-shadow:0 10px 30px rgba(0,0,0,.3);
    }

    /* ---------- Sections ---------- */
    .section{padding:100px 0;}
    .section.bg-white{background:var(--light);}
    .section.bg-light{background:#f1f3f5;}
    [data-theme="dark"] .section.bg-white,
    [data-theme="dark"] .section.bg-light{
        background:#1e1e1e !important;
    }

    .section-title{
        font-weight:700;margin-bottom:3rem;position:relative;display:inline-block;
        color: var(--text-primary);
    }
    .section-title::after{
        content:'';position:absolute;bottom:-10px;left:0;
        width:60px;height:4px;background:var(--primary);border-radius:2px;
    }

    /* ---------- Skills ---------- */
    .skill-card{
        background:#fff;padding:1.8rem;border-radius:var(--radius);
        box-shadow:var(--shadow);transition:var(--transition);text-align:center;
    }
    [data-theme="dark"] .skill-card{background:#2d2d2d;border:1px solid #444;}
    .skill-card:hover{transform:translateY(-8px);box-shadow:0 12px 25px rgba(0,0,0,.15);}
    .skill-card i{font-size:2.8rem;color:var(--primary);margin-bottom:1rem;}
    .skill-card h5 { color: var(--text-primary); }
    .progress{height:8px;background:#e9ecef;border-radius:4px;overflow:hidden;margin-top:1rem;}
    [data-theme="dark"] .progress{background:#333;}
    .progress-bar{background:var(--primary);transition:width 1.5s ease;}

    /* ---------- Projects ---------- */
    .project-card{
        background:#fff;border-radius:var(--radius);overflow:hidden;
        box-shadow:var(--shadow);transition:var(--transition);
    }
    [data-theme="dark"] .project-card{background:#2d2d2d;}
    .project-card:hover{transform:translateY(-10px);box-shadow:0 15px 30px rgba(0,0,0,.2);}
    .project-card img{height:220px;object-fit:cover;transition:transform .4s ease;}
    .project-card:hover img{transform:scale(1.05);}
    .project-card h5, .project-card p { color: var(--text-primary); }

    /* ---------- Contact ---------- */
    .contact-form{
        background:#fff;padding:2.5rem;border-radius:var(--radius);
        box-shadow:var(--shadow);
    }
    [data-theme="dark"] .contact-form{background:#2d2d2d;}
    .form-control,.form-select{
        border-radius:8px;padding:.75rem;border:1px solid var(--border);
        background: var(--light); color: var(--text-primary);
    }
    [data-theme="dark"] .form-control,
    [data-theme="dark"] .form-select {
        background: #333; color: #e9ecef;
    }
    .form-control::placeholder { color: var(--text-muted); opacity: 0.7; }

    .btn-primary{
        background:var(--primary);border:none;padding:.75rem 2rem;
        border-radius:8px;font-weight:600;color:#fff;
    }
    .btn-primary:hover{
        background:var(--primary-dark);transform:translateY(-2px);
    }

    /* ---------- Footer ---------- */
    footer{
        background:var(--dark);color:#fff;padding:3rem 0;
    }
    footer p { color: #ddd; }

    /* ---------- Animations ---------- */
    .fade-in{
        opacity:0;transform:translateY(30px);
        transition:all .8s ease;
    }
    .fade-in.visible{opacity:1;transform:translateY(0);}

    /* ---------- Theme Toggle ---------- */
    .theme-toggle{
        background:none;border:1px solid var(--border);
        width:40px;height:40px;border-radius:50%;
        display:flex;align-items:center;justify-content:center;
        cursor:pointer;transition:var(--transition);color:var(--text-primary);
    }
    .theme-toggle:hover{
        background:var(--primary);color:#fff;border-color:var(--primary);
    }
</style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Rence</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#skills">Skills</a></li>
                    <li class="nav-item"><a class="nav-link" href="#projects">Projects</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    <li class="nav-item ms-3">
                        <button class="theme-toggle" id="themeToggle" aria-label="Toggle dark mode">
                            <i class="fa-solid fa-moon"></i>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section id="home" class="hero">
        <div class="container">
            <div class="row align-items-center text-center text-lg-start">
                <div class="col-lg-6 fade-in">
                    <h1>Hello, I'm <span style="color:#fff;">Rence</span></h1>
                    <p class="lead mb-4">
                        I'm <strong>Lorenze Niño Prepotente</strong>, a 21-year-old developer from the Philippines.
                        Passionate about building modern, efficient, and user-friendly web applications.
                    </p>
                    <a href="#contact" class="btn btn-light btn-lg">Get in Touch</a>
                </div>
                <div class="col-lg-6 text-center mt-5 mt-lg-0 fade-in">
                    <img src="https://scontent.fmnl3-4.fna.fbcdn.net/v/t39.30808-6/475687044_1306906997102854_5197075266384357703_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=a5f93a&_nc_eui2=AeFZ7caDZEXQhVFX0RGVbvJSRYAWgSF3QiBFgBaBIXdCIOuAKBLpFTWkJp5Ie9ewoufhNdjNRPiidF633snSoay4&_nc_ohc=CZhng25oJLsQ7kNvwHtTv-8&_nc_oc=AdlP46qr6Y28oTlmWYpAb_y2iDoNTjFYiepVLbVxdUv0V1iN3cHz79yAbdHaInpQ4Ik&_nc_zt=23&_nc_ht=scontent.fmnl3-4.fna&_nc_gid=b2UNYjCJ5bWwwwcW5m-3lQ&oh=00_AfeTlRpQoBU3Ovu0d1o02YTHZGs4aTW9spx-_2v0Y79m1Q&oe=69039BE8"
                         alt="Rence" class="profile-img">
                </div>
            </div>
        </div>
    </section>

    <!-- About -->
    <section id="about" class="section bg-white">
        <div class="container">
            <h2 class="section-title text-center">About Me</h2>
            <div class="row align-items-center">
                <div class="col-lg-6 fade-in">
                    <p class="lead">
                        I am an aspiring <strong>Full-Stack Developer</strong> and <strong>Network Engineer</strong> with a solid foundation in web technologies and backend development. 
                        Currently pursuing a <strong>Bachelor of Science in Information Systems</strong> at 
                        <em>Bicol University Polangui Campus</em>.
                    </p>
                    <p>
                        I’m passionate about creating efficient, secure, and user-centered digital solutions. 
                        I enjoy transforming complex challenges into clean, functional, and visually appealing designs that make a real impact.
                    </p>
                </div>
                <div class="col-lg-6 text-center fade-in">
                    <img src="https://scontent.fmnl3-4.fna.fbcdn.net/v/t39.30808-6/475640551_1306896380437249_6281412629429202218_n.jpg?_nc_cat=104&ccb=1-7&_nc_sid=a5f93a&_nc_eui2=AeFMlh8D9aMN4nntzZONBtd2-Z9-tiQRb775n362JBFvvt4xuJjfOPjEaVABxT2ZG19r1GQMdZLOTQ0qtAiYSe-P&_nc_ohc=3i8Z-_8SM2AQ7kNvwFE-pLy&_nc_oc=AdkxRM0wcxss8SSv_jT40Ri4nvoY6L3rP7K0SWNy5o0UUW1yMwEQlN4-8dRexYkR_QU&_nc_zt=23&_nc_ht=scontent.fmnl3-4.fna&_nc_gid=h8Romih5Vnraf0DANa3LMg&oh=00_AffT0ynNRhESwaclBpgrQFftQlUs6c6ZI3z29yqRBzYZyA&oe=6903A06B"
                         alt="About" class="img-fluid rounded shadow" style="max-height:350px;">
                </div>
            </div>
        </div>
    </section>

    <!-- Skills -->
    <section id="skills" class="section bg-light">
        <div class="container">
            <h2 class="section-title text-center">Skills & Technologies</h2>
            <div class="row g-4">
                <?php
                $skills = [
                    ["HTML5",95,"devicon-html5-plain"],
                    ["CSS3",90,"devicon-css3-plain"],
                    ["JavaScript",85,"devicon-javascript-plain"],
                    ["PHP",80,"devicon-php-plain"],
                    ["MySQL",75,"devicon-mysql-plain"],
                    ["C++",70,"devicon-cplusplus-plain"]
                ];
                foreach ($skills as $i=>$s){
                    echo "<div class='col-md-6 col-lg-4 fade-in' style='animation-delay:".($i*0.1)."s'>
                        <div class='skill-card'>
                            <i class='{$s[2]} colored' style='font-size:3rem;'></i>
                            <h5 class='mt-3'>{$s[0]}</h5>
                            <div class='progress'>
                                <div class='progress-bar' style='width:0%' data-width='{$s[1]}%'></div>
                            </div>
                            <small class='text-muted'>{$s[1]}%</small>
                        </div>
                    </div>";
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Projects -->
    <section id="projects" class="section bg-white">
        <div class="container">
            <h2 class="section-title text-center">My Projects</h2>
            <div class="row g-4">
                <?php
                $projects = [
                    ["CSD LMS","A modern Learning Management System with secure authentication and intuitive UI for students and faculty.","ims/Screenshot 2025-05-15 215335.png","projects/csd-lms.php"],
                    ["Course Activity Management","Real-time activity tracking, deadline reminders, and collaborative tools for academic success.","ims/Screenshot 2025-05-15 214456.png","projects/course-management.php"],
                    ["Student Management System","Automated scheduling, grade monitoring, and personalized academic planning dashboard.","ims/Screenshot 2025-05-15 214449.png","projects/student-management.php"]
                ];
                foreach ($projects as $i=>$p){
                    echo "<div class='col-md-6 col-lg-4 fade-in' style='animation-delay:".($i*0.15)."s'>
                        <div class='project-card h-100'>
                            <img src='{$p[2]}' alt='{$p[0]}' class='img-fluid'>
                            <div class='p-4'>
                                <h5>{$p[0]}</h5>
                                <p class='text-muted small'>{$p[1]}</p>
                                <a href='{$p[3]}' class='btn btn-outline-primary btn-sm'>View Project</a>
                            </div>
                        </div>
                    </div>";
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Contact -->
    <section id="contact" class="section bg-light">
        <div class="container">
            <h2 class="section-title text-center">Get In Touch</h2>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="contact-form">
                        <?php if($success_message):?>
                            <div class="alert alert-success"><?=$success_message?></div>
                        <?php elseif($error_message):?>
                            <div class="alert alert-danger"><?=$error_message?></div>
                        <?php endif;?>

                        <form method="POST" novalidate>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Name *</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email *</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Message *</label>
                                <textarea name="message" rows="5" class="form-control" required></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Send Message</button>
                            </div>
                        </form>

                        <div class="text-center mt-4">
                            <a href="mailto:Lorenzezz0987@gmail.com" class="btn btn-outline-primary mx-1"><i class="fas fa-envelope"></i></a>
                            <a href="https://github.com/rence141" target="_blank" class="btn btn-outline-primary mx-1"><i class="fab fa-github"></i></a>
                            <a href="https://facebook.com" target="_blank" class="btn btn-outline-primary mx-1"><i class="fab fa-facebook"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <p>© <?=date("Y")?> <?=$full_name?>. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        /* ───── Theme Toggle ───── */
        const html      = document.documentElement;
        const toggleBtn = document.getElementById('themeToggle');
        const icon      = toggleBtn.querySelector('i');

        const saved = localStorage.getItem('theme') || 'light';
        html.setAttribute('data-theme', saved);
        icon.className = saved === 'dark' ? 'fa-solid fa-sun' : 'fa-solid fa-moon';

        toggleBtn.addEventListener('click', () => {
            const cur = html.getAttribute('data-theme');
            const nxt = cur === 'dark' ? 'light' : 'dark';
            html.setAttribute('data-theme', nxt);
            localStorage.setItem('theme', nxt);
            icon.className = nxt === 'dark' ? 'fa-solid fa-sun' : 'fa-solid fa-moon';
        });

        /* ───── Scroll Animations ───── */
        const observer = new IntersectionObserver(e=>e.forEach(en=>en.isIntersecting && en.target.classList.add('visible')), {threshold:.1});
        document.querySelectorAll('.fade-in').forEach(el=>observer.observe(el));

        /* ───── Progress Bars ───── */
        const progObs = new IntersectionObserver(e=>e.forEach(en=>{
            if(en.isIntersecting){
                document.querySelectorAll('.progress-bar').forEach(b=>setTimeout(()=>b.style.width=b.dataset.width,300));
                progObs.unobserve(en.target);
            }
        }), {threshold:.5});
        const skillsSec = document.getElementById('skills');
        if(skillsSec) progObs.observe(skillsSec);

        /* ───── Smooth Scroll ───── */
        document.querySelectorAll('a[href^="#"]').forEach(a=>a.addEventListener('click',e=>{
            e.preventDefault();
            document.querySelector(a.getAttribute('href'))?.scrollIntoView({behavior:'smooth'});
        }));
    </script>
</body>
</html>