<?php
// Personal information variables
$name = "Rence";
$full_name = "Lorenze Fernandez Prepotente";
$age = "20";
$location = "Philippines";
$course = "Bachelor of Science in Information System";

// Contact form processing
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $visitor_name = strip_tags($_POST['name'] ?? '');
    $visitor_email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $message = strip_tags($_POST['message'] ?? '');
    
    // Create message content
    $message_content = "
Date: " . date('Y-m-d H:i:s') . "
From: {$visitor_name}
Email: {$visitor_email}
Message:
{$message}
----------------------------------------
";
    
    // Save to messages file
    $file = 'messages/contact_messages.txt';
    
    // Create messages directory if it doesn't exist
    if (!file_exists('messages')) {
        mkdir('messages', 0777, true);
    }
    
    // Try to save the message
    if(file_put_contents($file, $message_content, FILE_APPEND | LOCK_EX)) {
        $success_message = "Thank you for your message! I'll get back to you soon.";
        
        // Optional: Send notification to your email about new message
        $notification = "New message received from your portfolio contact form. Check messages/contact_messages.txt";
        error_log($notification);
    } else {
        $error_message = "Sorry, there was an error saving your message. Please try again.";
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

        .falling-code {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            overflow: hidden;
            z-index: 1;
        }

        .code-character {
            position: absolute;
            color: rgba(204, 210, 220, 0.5);
            font-family: monospace;
            font-size: 20px;
            user-select: none;
            pointer-events: none;
            animation: fall linear infinite;
        }

        @keyframes fall {
            0% {
                transform: translateY(-100%);
                opacity: 1;
            }
            100% {
                transform: translateY(100vh);
                opacity: 0;
            }
        }

        .hero-section {
            min-height: 100vh;
            background: linear-gradient(135deg, rgba(45, 52, 54, 0.9) 0%, rgba(9, 132, 227, 0.85) 100%), url('https://images.unsplash.com/photo-1517694712202-14dd9538aa97?q=80&w=2070&auto=format&fit=crop') center/cover no-repeat;
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
    </style>
</head>
<body>
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
        <div class="falling-code" id="fallingCode"></div>
        <div class="container" style="z-index: 2;">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Hello, I'm <?php echo $name; ?></h1>
                    <p class="lead mb-4">Hello I'm <?php echo $full_name; ?> but you can call me <?php echo $name; ?> in short 
                        I'm <?php echo $age; ?> years old and I live in the <?php echo $location; ?> 
                        I'm a student of <?php echo $course; ?> 
                        I'm a very simple person and I like to enjoy life coding is my passion to be a good developer.  
                    </p>
                    <a href="#contact" class="btn btn-light btn-lg">Contact me</a>
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
                        $about_text = "I'm a starting web developer with a passion for creating efficient, Protective-base, functional, and user-friendly websites. With expertise in both front-end and back-end development, I bring ideas to life through code.";
                        echo $about_text;
                        ?>
                    </p>
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
                    ["HTML5", "fab fa-html5", "https://developer.mozilla.org/en-US/docs/Web/HTML"],
                    ["CSS3", "fab fa-css3-alt", "https://developer.mozilla.org/en-US/docs/Web/CSS"],
                    ["JavaScript", "fab fa-js", "https://developer.mozilla.org/en-US/docs/Web/JavaScript"],
                    ["PHP", "fab fa-php", "https://www.php.net/docs.php"],
                    ["C++", "devicon-cplusplus-plain colored", "https://cplusplus.com/doc/tutorial/"],
                    ["MySQL", "fas fa-database", "https://dev.mysql.com/doc/"]
                ];

                foreach ($skills as $skill) {
                    echo '<div class="col-md-4 col-lg-3">';
                    echo '<a href="' . $skill[2] . '" target="_blank" class="text-decoration-none">';
                    echo '<div class="skill-card text-center">';
                    echo '<i class="' . $skill[1] . ' fa-3x mb-3"></i>';
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
                        "title" => "Student Management System",
                        "description" => "Designed and implemented a sophisticated Student Management System that transforms academic planning and student administration. This innovative solution enables students to efficiently manage their course schedules, track academic progress, and optimize their learning journey. Key features include automated schedule conflict detection, real-time grade monitoring, course prerequisite verification, and personalized academic roadmap planning. The system has streamlined administrative processes, reduced scheduling conflicts by 85%, and enhanced student success rates through proactive progress tracking and early intervention alerts.",
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
                <div class="col-lg-8">
                    <?php if (isset($success_message)): ?>
                        <div class="alert alert-success text-center mb-4">
                            <?php echo $success_message; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($error_message)): ?>
                        <div class="alert alert-danger text-center mb-4">
                            <?php echo $error_message; ?>
                        </div>
                    <?php endif; ?>
                    <div class="contact-form">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>#contact" method="POST">
                            <div class="mb-3">
                                <input type="text" class="form-control" name="name" placeholder="Your Name" required>
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" name="message" rows="5" placeholder="Your Message" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Send Message</button>
                        </form>
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
    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Falling code animation
        const codeCharacters = '{}[]()<>/*-+=0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        const fallingCodeContainer = document.getElementById('fallingCode');

        function createCodeCharacter() {
            const character = document.createElement('span');
            character.className = 'code-character';
            character.textContent = codeCharacters[Math.floor(Math.random() * codeCharacters.length)];
            character.style.left = Math.random() * 100 + 'vw';
            character.style.animationDuration = (Math.random() * 3 + 2) + 's';
            character.style.opacity = Math.random();
            fallingCodeContainer.appendChild(character);

            // Remove the character after animation
            character.addEventListener('animationend', () => {
                character.remove();
            });
        }

        // Create initial characters
        for (let i = 0; i < 50; i++) {
            setTimeout(createCodeCharacter, Math.random() * 3000);
        }

        // Continue creating characters
        setInterval(createCodeCharacter, 100);
    </script>
</body>
</html> 