<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSD LMS Login PAGE - Project Details</title>
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
            <h1 class="display-4">CSD Learning Management System</h1>
            <p class="lead">A modern and secure learning platform for the Computer Studies Department</p>
        </div>
    </header>

    <!-- Project Details -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <img src="../ims/Screenshot 2025-05-15 215335.png" alt="CSD LMS Screenshot" class="img-fluid rounded mb-4">
                    
                    <h2 class="mb-4">Project Overview</h2>
                    <p>The CSD Learning Management System is a comprehensive educational platform designed specifically for the Computer Studies Department. This system provides a secure and intuitive interface for both students and faculty members to manage their educational activities effectively.</p>

                    <h3 class="mt-5 mb-4">Key Features</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="feature-card">
                                <h4><i class="fas fa-lock text-primary"></i> Secure Authentication</h4>
                                <p>Robust login system with role-based access control for students and faculty.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-card">
                                <h4><i class="fas fa-users text-primary"></i> User Management</h4>
                                <p>Efficient user management system with different permission levels.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-card">
                                <h4><i class="fas fa-book text-primary"></i> Course Management</h4>
                                <p>Easy-to-use interface for managing courses and educational content.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-card">
                                <h4><i class="fas fa-chart-line text-primary"></i> Progress Tracking</h4>
                                <p>Comprehensive progress tracking and reporting system.</p>
                            </div>
                        </div>
                    </div>

                    <h3 class="mt-5 mb-4">Technical Details</h3>
                    <div class="tech-stack mb-4">
                        <h5>Technologies Used:</h5>
                        <span>PHP</span>
                        <span>MySQL</span>
                        <span>HTML5</span>
                        <span>CSS3</span>
                        <span>JavaScript</span>
                        <span>Bootstrap</span>
                    </div>

                    <h3 class="mt-5 mb-4">Development Process</h3>
                    <p>The development of the CSD LMS followed an agile methodology, with regular feedback from faculty members and students. The system was built with scalability and security in mind, implementing best practices for educational software.</p>

                    <h3 class="mt-5 mb-4">Results & Impact</h3>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success me-2"></i> Improved student engagement and participation</li>
                        <li><i class="fas fa-check text-success me-2"></i> Streamlined course management for faculty</li>
                        <li><i class="fas fa-check text-success me-2"></i> Enhanced learning experience through intuitive interface</li>
                        <li><i class="fas fa-check text-success me-2"></i> Reduced administrative overhead</li>
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
                                    3 months
                                </li>
                                <li class="mb-3">
                                    <strong>Role:</strong><br>
                                    Lead Developer
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