<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Activity Management System - Project Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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

        .project-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 100px 0 50px;
        }

        .feature-card {
            border-radius: 10px;
            padding: 20px;
            margin: 15px 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }

        .tech-stack span {
            background: var(--light-bg);
            padding: 5px 15px;
            border-radius: 20px;
            margin: 5px;
            display: inline-block;
        }

        .stats-card {
            background: var(--light-bg);
            border-radius: 10px;
            padding: 20px;
            margin: 10px 0;
            text-align: center;
        }

        .stats-card h3 {
            color: var(--secondary-color);
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="../portfolio.php">Back to Portfolio</a>
        </div>
    </nav>

    <!-- Project Header -->
    <header class="project-header">
        <div class="container">
            <h1 class="display-4">Course Activity Management System</h1>
            <p class="lead">A comprehensive solution for managing academic activities and schedules</p>
        </div>
    </header>

    <!-- Project Details -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <img src="../ims/screenshot-214449.png" alt="Course Management System Screenshot" class="img-fluid rounded mb-4">
                    
                    <h2 class="mb-4">Project Overview</h2>
                    <p>The Course Activity Management System revolutionizes how students and faculty interact with academic schedules and activities. This innovative platform provides real-time tracking, dynamic course management, and an intuitive calendar interface that has significantly improved student engagement and academic planning efficiency.</p>

                    <div class="row mt-5">
                        <div class="col-md-4">
                            <div class="stats-card">
                                <h3>60%</h3>
                                <p>Increase in Student Engagement</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stats-card">
                                <h3>45%</h3>
                                <p>Reduction in Schedule Conflicts</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stats-card">
                                <h3>80%</h3>
                                <p>Faculty Satisfaction Rate</p>
                            </div>
                        </div>
                    </div>

                    <h3 class="mt-5 mb-4">Key Features</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="feature-card">
                                <h4><i class="fas fa-clock text-primary"></i> Real-time Activity Tracking</h4>
                                <p>Monitor and track academic activities as they happen with instant updates.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-card">
                                <h4><i class="fas fa-calendar-alt text-primary"></i> Dynamic Calendar</h4>
                                <p>Interactive calendar interface for easy schedule management and planning.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-card">
                                <h4><i class="fas fa-bell text-primary"></i> Automated Reminders</h4>
                                <p>Smart notification system for deadlines and important events.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-card">
                                <h4><i class="fas fa-chart-bar text-primary"></i> Analytics Dashboard</h4>
                                <p>Comprehensive analytics for tracking performance and engagement.</p>
                            </div>
                        </div>
                    </div>

                    <h3 class="mt-5 mb-4">Technical Details</h3>
                    <div class="tech-stack mb-4">
                        <h5>Technologies Used:</h5>
                        <span>PHP</span>
                        <span>MySQL</span>
                        <span>JavaScript</span>
                        <span>HTML5</span>
                        <span>CSS3</span>
                        <span>Bootstrap</span>
                        <span>AJAX</span>
                    </div>

                    <h3 class="mt-5 mb-4">Development Approach</h3>
                    <p>The system was developed using an iterative approach, with continuous feedback from students and faculty. Key focus areas included:</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success me-2"></i> User-centered design methodology</li>
                        <li><i class="fas fa-check text-success me-2"></i> Responsive and mobile-first approach</li>
                        <li><i class="fas fa-check text-success me-2"></i> Real-time data synchronization</li>
                        <li><i class="fas fa-check text-success me-2"></i> Scalable architecture</li>
                    </ul>
                </div>

                <div class="col-lg-4">
                    <div class="card sticky-top" style="top: 100px">
                        <div class="card-body">
                            <h4 class="card-title">Project Details</h4>
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <strong>Client:</strong><br>
                                    Computer Studies Department
                                </li>
                                <li class="mb-3">
                                    <strong>Duration:</strong><br>
                                    4 months
                                </li>
                                <li class="mb-3">
                                    <strong>Role:</strong><br>
                                    Full Stack Developer
                                </li>
                                <li class="mb-3">
                                    <strong>Status:</strong><br>
                                    <span class="badge bg-success">Completed</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 