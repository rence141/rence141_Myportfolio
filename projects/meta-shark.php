<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>META SHARK - Project Details</title>
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

        .gallery-item {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            margin: 15px 0;
        }

        .gallery-item:hover {
            transform: translateY(-5px);
        }

        .gallery-item img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            display: block;
        }

        .gallery-item p {
            padding: 15px;
            margin: 0;
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
            <h1 class="display-4">META SHARK</h1>
            <p class="lead">Comprehensive E-Commerce Administration Dashboard</p>
        </div>
    </header>

    <!-- Project Details -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <img src="../ims/dashboard-overview.jpeg" alt="Dashboard Overview" class="img-fluid rounded mb-4">
                    
                    <h2 class="mb-4">Project Overview</h2>
                    <p>META SHARK is a comprehensive e-commerce administration dashboard designed to manage all aspects of an online marketplace. It provides real-time insights, inventory management, user control, order processing, and analytics.</p>

                    <h3 class="mt-5 mb-4">Key Features</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="feature-card">
                                <h4><i class="fas fa-chart-line text-primary"></i> Analytics Dashboard</h4>
                                <p>Real-time revenue tracking, order analytics, and sales performance metrics with interactive charts.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-card">
                                <h4><i class="fas fa-users text-primary"></i> User Management</h4>
                                <p>Complete user administration with roles, permissions, status monitoring, and activity tracking.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-card">
                                <h4><i class="fas fa-boxes text-primary"></i> Inventory Management</h4>
                                <p>Product catalog, stock tracking, pricing management, and category organization.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-card">
                                <h4><i class="fas fa-shopping-cart text-primary"></i> Order Processing</h4>
                                <p>Complete order lifecycle management with status tracking, fulfillment, and order history.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-card">
                                <h4><i class="fas fa-store text-primary"></i> Shop Management</h4>
                                <p>Seller management, shop performance metrics, and multi-vendor support capabilities.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-card">
                                <h4><i class="fas fa-flag text-primary"></i> Appeals System</h4>
                                <p>Handle user and seller appeals with resolution tracking and automated workflows.</p>
                            </div>
                        </div>
                    </div>

                    <h3 class="mt-5 mb-4">Technical Stack</h3>
                    <ul>
                        <li><strong>Backend:</strong> PHP with Laravel framework for robust application architecture</li>
                        <li><strong>Database:</strong> MySQL for efficient data management and complex queries</li>
                        <li><strong>Frontend:</strong> Bootstrap 5 for responsive and modern UI components</li>
                        <li><strong>Charts & Analytics:</strong> Chart.js and Apache ECharts for data visualization</li>
                        <li><strong>Features:</strong> Real-time data updates, advanced filtering, export capabilities</li>
                    </ul>

                    <div class="tech-stack">
                        <span><i class="fab fa-php"></i> PHP</span>
                        <span><i class="fab fa-laravel"></i> Laravel</span>
                        <span><i class="fas fa-database"></i> MySQL</span>
                        <span><i class="fab fa-bootstrap"></i> Bootstrap 5</span>
                        <span><i class="fas fa-chart-pie"></i> Chart.js</span>
                    </div>

                    <h3 class="mt-5 mb-4">Gallery</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="gallery-item">
                                <img src="../ims/dashboard-overview.jpeg" alt="Dashboard Overview" loading="lazy">
                                <p><strong>Dashboard Overview</strong> - Main analytics and KPI display</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="gallery-item">
                                <img src="../ims/user-management.jpeg" alt="User Management" loading="lazy">
                                <p><strong>User Management</strong> - Complete user administration interface</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="gallery-item">
                                <img src="../ims/shop-management.jpeg" alt="Shop Management" loading="lazy">
                                <p><strong>Shop Management</strong> - Seller and shop performance monitoring</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="gallery-item">
                                <img src="../ims/orders-management.jpeg" alt="Orders Management" loading="lazy">
                                <p><strong>Orders Management</strong> - Order processing and tracking</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="gallery-item">
                                <img src="../ims/product-management.jpeg" alt="Product Management" loading="lazy">
                                <p><strong>Product Management</strong> - Inventory and product catalog</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="gallery-item">
                                <img src="../ims/appeals.jpeg" alt="Appeals System" loading="lazy">
                                <p><strong>Appeals System</strong> - User and seller appeal management</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="gallery-item">
                                <img src="../ims/analytics-center.jpeg" alt="Analytics Center" loading="lazy">
                                <p><strong>Analytics Center</strong> - Comprehensive data analytics</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="gallery-item">
                                <img src="../ims/revenue-analysis.jpeg" alt="Revenue Analysis" loading="lazy">
                                <p><strong>Revenue Analysis</strong> - Financial performance metrics</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="gallery-item">
                                <img src="../ims/category-analytics.jpeg" alt="Category Analytics" loading="lazy">
                                <p><strong>Category Analytics</strong> - Product category insights</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="gallery-item">
                                <img src="../ims/geo-chart.jpeg" alt="Geographic Analysis" loading="lazy">
                                <p><strong>Geographic Analysis</strong> - Location-based sales data</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="gallery-item">
                                <img src="../ims/order-status.jpeg" alt="Order Status" loading="lazy">
                                <p><strong>Order Status</strong> - Order distribution and status breakdown</p>
                            </div>
                        </div>
                    </div>

                    <h3 class="mt-5 mb-4">Challenges & Solutions</h3>
                    <p class="mb-3"><strong>Challenge:</strong> Managing large datasets with multiple concurrent users accessing different sections.</p>
                    <p class="mb-4"><strong>Solution:</strong> Implemented database indexing, query optimization, and efficient caching strategies.</p>
                    
                    <p class="mb-3"><strong>Challenge:</strong> Creating an intuitive interface for complex e-commerce operations.</p>
                    <p class="mb-4"><strong>Solution:</strong> Developed modular components, comprehensive search filters, and contextual help systems.</p>

                    <div class="mt-5">
                        <a href="../portfolio.php" class="btn btn-primary btn-lg">
                            <i class="fas fa-arrow-left"></i> Back to Portfolio
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
