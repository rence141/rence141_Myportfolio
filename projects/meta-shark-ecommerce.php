<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>META SHARK — Project Showcase</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        :root {
            --primary-dark: #0f172a;
            --primary-light: #1e293b;
            --accent-color: #f97316;
            --text-main: #334155;
            --bg-light: #f1f5f9;
        }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            color: var(--text-main);
            background: var(--bg-light);
            line-height: 1.6;
        }

        /* --- Hero Section --- */
        .project-hero {
            background: linear-gradient(135deg, var(--primary-dark) 0%, #334155 100%);
            color: white;
            padding: 100px 0 60px;
            position: relative;
            overflow: hidden;
        }

        .project-hero::after {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: radial-gradient(circle at top right, rgba(249, 115, 22, 0.1), transparent 60%);
            pointer-events: none;
        }

        /* --- Tech Stack Banner --- */
        .tech-banner {
            background: white;
            padding: 20px 0;
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            margin-bottom: 50px;
        }
        .tech-icon {
            font-size: 1.5rem;
            margin: 0 15px;
            color: var(--primary-light);
            opacity: 0.7;
            transition: all 0.3s;
            cursor: default;
        }
        .tech-icon:hover {
            opacity: 1;
            color: var(--accent-color);
            transform: translateY(-2px);
        }

        /* --- UI Cards --- */
        .ui-card {
            background: white;
            border-radius: 12px;
            border: none;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
            position: relative;
            top: 0;
        }

        .ui-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .card-img-wrapper {
            position: relative;
            overflow: hidden;
            height: 200px;
            background: #f8fafc;
            cursor: pointer; /* Indicates clickable */
        }

        .card-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .ui-card:hover .card-img-wrapper img {
            transform: scale(1.05);
        }

        /* Overlay icon on hover */
        .hover-overlay {
            position: absolute;
            inset: 0;
            background: rgba(15, 23, 42, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s;
        }
        .ui-card:hover .hover-overlay { opacity: 1; }
        .hover-overlay i { font-size: 2rem; color: white; }

        .card-body { padding: 1.25rem; }

        /* --- Badges --- */
        .badge-pill {
            padding: 0.35em 0.8em;
            border-radius: 50rem;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        .bg-frontend { background-color: #e0f2fe; color: #0284c7; }
        .bg-backend { background-color: #f0fdf4; color: #16a34a; }
        .bg-utility { background-color: #f3f4f6; color: #4b5563; }

        /* --- Animation --- */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-up {
            animation: fadeUp 0.6s ease-out forwards;
            opacity: 0;
        }
        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }

        /* --- Custom Modal Styling --- */
        .modal-content {
            background-color: transparent;
            border: none;
            box-shadow: none;
        }
        .modal-body {
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }
        .modal-img {
            max-width: 100%;
            max-height: 85vh; /* Prevents image from being taller than screen */
            border-radius: 8px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            object-fit: contain;
        }
        .btn-close-custom {
            position: absolute;
            top: -40px;
            right: 0;
            color: white;
            font-size: 2rem;
            cursor: pointer;
            z-index: 1056;
            background: none;
            border: none;
            opacity: 0.8;
            transition: opacity 0.2s;
        }
        .btn-close-custom:hover { opacity: 1; transform: scale(1.1); }

        /* --- Mobile Optimizations --- */
        @media (max-width: 768px) {
            .project-hero { padding: 60px 0 40px; }
            .display-4 { font-size: 2rem; font-weight: 800; }
            .card-img-wrapper { height: 180px; }
            
            .tech-icon { margin: 0 10px; font-size: 1.2rem; }
            .tech-banner .d-flex { flex-wrap: wrap; justify-content: center; gap: 10px; }
            
            .btn-close-custom { top: -45px; right: 10px; }
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="../portfolio.php">
                <i class="fas fa-chevron-left me-2 text-warning"></i>Portfolio
            </a>
            <div class="ms-auto">
                <span class="badge bg-warning text-dark">E-Commerce Module</span>
            </div>
        </div>
    </nav>

    <header class="project-hero text-center">
        <div class="container">
            <span class="badge bg-white text-dark mb-3 bg-opacity-10 backdrop-blur">Full Stack Project</span>
            <h1 class="display-4 mb-3">META SHARK</h1>
            <p class="lead text-light opacity-75 mx-auto" style="max-width: 600px;">
                A multi-role e-commerce ecosystem featuring separate interfaces for Buyers, Sellers, and Administrators.
            </p>
            <div class="mt-4">
                <a href="#gallery" class="btn btn-outline-light rounded-pill px-4">View Screens</a>
            </div>
        </div>
    </header>

    <div class="tech-banner">
        <div class="container">
            <div class="d-flex justify-content-center align-items-center">
                <div class="tech-icon" title="Laravel"><i class="fab fa-laravel"></i> <span class="d-none d-md-inline ms-1 fs-6">Laravel</span></div>
                <div class="tech-icon" title="PHP"><i class="fab fa-php"></i> <span class="d-none d-md-inline ms-1 fs-6">PHP</span></div>
                <div class="tech-icon" title="JavaScript"><i class="fab fa-js"></i> <span class="d-none d-md-inline ms-1 fs-6">JavaScript</span></div>
                <div class="tech-icon" title="Bootstrap"><i class="fab fa-bootstrap"></i> <span class="d-none d-md-inline ms-1 fs-6">Bootstrap 5</span></div>
                <div class="tech-icon" title="MySQL"><i class="fas fa-database"></i> <span class="d-none d-md-inline ms-1 fs-6">MySQL</span></div>
            </div>
        </div>
    </div>

    <section class="pb-5" id="gallery">
        <div class="container">
            
            <div class="d-flex justify-content-between align-items-end mb-4">
                <div>
                    <h2 class="fw-bold text-dark mb-1">System Interface</h2>
                    <p class="text-muted mb-0">Click any image to expand view.</p>
                </div>
            </div>

            <div class="row g-4">
                
                <div class="col-12 col-sm-6 col-lg-3 animate-up delay-1">
                    <div class="ui-card">
                        <div class="card-img-wrapper">
                            <img src="../ims/landingpage.jpeg" alt="Landing Page">
                            <div class="hover-overlay"><i class="fas fa-expand-alt"></i></div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="fw-bold mb-0">Landing Page</h6>
                                <span class="badge-pill bg-frontend">Public</span>
                            </div>
                            <p class="small text-muted mb-0">The main entry point featuring dynamic product carousels and promos.</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-3 animate-up delay-1">
                    <div class="ui-card">
                        <div class="card-img-wrapper">
                            <img src="../ims/Phone.jpeg" alt="PDP">
                            <div class="hover-overlay"><i class="fas fa-expand-alt"></i></div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="fw-bold mb-0">Product Display</h6>
                                <span class="badge-pill bg-frontend">Buyer</span>
                            </div>
                            <p class="small text-muted mb-0">Detailed view with specs, reviews, and add-to-cart functionality.</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-3 animate-up delay-2">
                    <div class="ui-card">
                        <div class="card-img-wrapper">
                            <img src="../ims/ecom_login.jpeg" alt="Login">
                            <div class="hover-overlay"><i class="fas fa-expand-alt"></i></div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="fw-bold mb-0">Secure Login</h6>
                                <span class="badge-pill bg-utility">Auth</span>
                            </div>
                            <p class="small text-muted mb-0">Unified authentication gateway for Customers and Vendors.</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-3 animate-up delay-2">
                    <div class="ui-card">
                        <div class="card-img-wrapper">
                            <img src="../ims/notification.jpeg" alt="Notifications">
                            <div class="hover-overlay"><i class="fas fa-expand-alt"></i></div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="fw-bold mb-0">Notifications</h6>
                                <span class="badge-pill bg-utility">System</span>
                            </div>
                            <p class="small text-muted mb-0">Real-time alerts for order updates and price drops.</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-3 animate-up delay-3">
                    <div class="ui-card">
                        <div class="card-img-wrapper">
                            <img src="../ims/Seller-dasboard.jpeg" alt="Seller Dashboard">
                            <div class="hover-overlay"><i class="fas fa-expand-alt"></i></div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="fw-bold mb-0">Seller Dashboard</h6>
                                <span class="badge-pill bg-backend">Seller</span>
                            </div>
                            <p class="small text-muted mb-0">Overview of sales performance, revenue, and active listings.</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-3 animate-up delay-3">
                    <div class="ui-card">
                        <div class="card-img-wrapper">
                            <img src="../ims/SellerOrderStatus.jpeg" alt="Order Status">
                            <div class="hover-overlay"><i class="fas fa-expand-alt"></i></div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="fw-bold mb-0">Order Mgmt</h6>
                                <span class="badge-pill bg-backend">Seller</span>
                            </div>
                            <p class="small text-muted mb-0">Tools for sellers to update shipping status and manage returns.</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-3 animate-up delay-3">
                    <div class="ui-card">
                        <div class="card-img-wrapper">
                            <img src="../ims/checkout.jpeg" alt="Checkout">
                            <div class="hover-overlay"><i class="fas fa-expand-alt"></i></div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="fw-bold mb-0">Checkout Flow</h6>
                                <span class="badge-pill bg-frontend">Buyer</span>
                            </div>
                            <p class="small text-muted mb-0">Multi-step checkout process with payment integration.</p>
                        </div>
                    </div>
                </div>

            </div> <div class="row mt-5 pt-4 border-top">
                <div class="col-lg-8 mx-auto text-center">
                    <h3 class="fw-bold mb-4">Core Functionality</h3>
                    <div class="row text-start">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Multi-Vendor Architecture</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Real-time Inventory Tracking</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Responsive Mobile Design</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Secure Payment Gateways</span>
                            </div>
                        </div>
                    </div>

                    <a href="../portfolio.php" class="btn btn-dark mt-4 px-5 rounded-pill">
                        <i class="fas fa-arrow-left me-2"></i> Back to Portfolio
                    </a>
                </div>
            </div>

        </div>
    </section>

    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                    <img src="" class="modal-img" id="modalImage" alt="Expanded View">
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = new bootstrap.Modal(document.getElementById('imageModal'));
            const modalImage = document.getElementById('modalImage');
            const triggers = document.querySelectorAll('.card-img-wrapper');

            triggers.forEach(trigger => {
                trigger.addEventListener('click', function() {
                    const img = this.querySelector('img');
                    const src = img.getAttribute('src');
                    modalImage.setAttribute('src', src);
                    modal.show();
                });
            });
        });
    </script>
</body>
</html>