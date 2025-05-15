<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System - Project Details</title>
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

        .impact-card {
            background: var(--light-bg);
            border-radius: 10px;
            padding: 20px;
            margin: 10px 0;
            border-left: 4px solid var(--secondary-color);
        }

        .metric-card {
            text-align: center;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .metric-card .value {
            font-size: 2.5rem;
            color: var(--secondary-color);
            font-weight: bold;
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
            <h1 class="display-4">Student Management System</h1>
            <p class="lead">A comprehensive solution for academic planning and student administration</p>
        </div>
    </header>

    <!-- Project Details -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <img src="../ims/Screenshot 2025-05-15 214449.png" alt="Student Management System Screenshot" class="img-fluid rounded mb-4">
                    
                    <h2 class="mb-4">Project Overview</h2>
                    <p>The Student Management System is a sophisticated platform that transforms academic planning and student administration. This innovative solution enables efficient course schedule management, academic progress tracking, and personalized learning journey optimization.</p>

                    <div class="row mt-5">
                        <div class="col-md-4">
                            <div class="metric-card">
                                <div class="value">85%</div>
                                <p>Reduction in Scheduling Conflicts</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="metric-card">
                                <div class="value">95%</div>
                                <p>Student Satisfaction Rate</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="metric-card">
                                <div class="value">70%</div>
                                <p>Improved Academic Performance</p>
                            </div>
                        </div>
                    </div>

                    <h3 class="mt-5 mb-4">Key Features</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="feature-card">
                                <h4><i class="fas fa-robot text-primary"></i> Automated Schedule Conflict Detection</h4>
                                <p>Advanced algorithm that prevents scheduling conflicts before they occur.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-card">
                                <h4><i class="fas fa-chart-line text-primary"></i> Real-time Grade Monitoring</h4>
                                <p>Live tracking of academic performance with instant updates.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-card">
                                <h4><i class="fas fa-check-circle text-primary"></i> Course Prerequisite Verification</h4>
                                <p>Automated system to ensure proper course sequencing.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-card">
                                <h4><i class="fas fa-road text-primary"></i> Academic Roadmap Planning</h4>
                                <p>Personalized academic journey planning and tracking.</p>
                            </div>
                        </div>
                    </div>

                    <h3 class="mt-5 mb-4">Technical Implementation</h3>
                    <div class="tech-stack mb-4">
                        <h5>Technologies Used:</h5>
                        <span>PHP</span>
                        <span>MySQL</span>
                        <span>JavaScript</span>
                        <span>HTML5</span>
                        <span>CSS3</span>
                        <span>Bootstrap</span>
                        <span>jQuery</span>
                        <span>AJAX</span>
                    </div>

                    <h3 class="mt-5 mb-4">System Impact</h3>
                    <div class="impact-card mb-3">
                        <h5>Academic Excellence</h5>
                        <p>The system has contributed to a significant improvement in student academic performance through better planning and monitoring.</p>
                    </div>
                    <div class="impact-card mb-3">
                        <h5>Administrative Efficiency</h5>
                        <p>Reduced administrative workload by automating routine tasks and streamlining processes.</p>
                    </div>
                    <div class="impact-card">
                        <h5>Student Success</h5>
                        <p>Early intervention alerts and progress tracking have led to improved student retention and success rates.</p>
                    </div>
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
                                    6 months
                                </li>
                                <li class="mb-3">
                                    <strong>Role:</strong><br>
                                    Lead Developer & System Architect
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