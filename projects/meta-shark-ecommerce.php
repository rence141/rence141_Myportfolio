<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>META SHARK — E-Commerce Storefront</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        :root {
            --primary-color: #2d3436;
            --accent-color: #ff7a59;
            --text-color: #2d3436;
            --light-bg: #f8f9fa;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-color);
            background: var(--light-bg);
            line-height: 1.6;
        }

        .store-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
            color: white;
            padding: 80px 0 40px;
        }

        .product-card {
            border-radius: 8px;
            padding: 0;
            overflow: hidden;
            box-shadow: 0 6px 18px rgba(0,0,0,0.08);
            background: white;
        }

        .product-card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            display: block;
        }

        .badge-price {
            background: var(--accent-color);
            color: white;
            border-radius: 20px;
            padding: 6px 12px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="../portfolio.php">Back to Portfolio</a>
            <div class="ms-auto">
                <a class="btn btn-outline-light btn-sm" href="#shop"><i class="fas fa-store"></i> Shop</a>
            </div>
        </div>
    </nav>

    <header class="store-header">
        <div class="container text-center">
            <h1 class="display-4">META SHARK</h1>
            <p class="lead">Responsive E-Commerce Storefront — Products, Cart, Checkout</p>
        </div>
    </header>

    <section class="py-5" id="shop">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-8">
                    <h2>Featured Products</h2>
                    <p class="text-muted">A small sample of how product cards and listings will appear for customers.</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="#" class="btn btn-primary"><i class="fas fa-shopping-cart"></i> View Cart</a>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="product-card">
                        <img src="../ims/product-management.jpeg" alt="Product 1">
                        <div class="p-3">
                            <h5 class="mb-1">Classic Watch</h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-muted small">Leather strap • Unisex</div>
                                <div class="badge-price">$79</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="product-card">
                        <img src="../ims/dashboard-overview.jpeg" alt="Product 2">
                        <div class="p-3">
                            <h5 class="mb-1">Wireless Headphones</h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-muted small">Noise-cancelling</div>
                                <div class="badge-price">$129</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="product-card">
                        <img src="../ims/user-management.jpeg" alt="Product 3">
                        <div class="p-3">
                            <h5 class="mb-1">Minimal Backpack</h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-muted small">Durable • 20L</div>
                                <div class="badge-price">$49</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="product-card">
                        <img src="../ims/product-management.jpeg" alt="Product 4">
                        <div class="p-3">
                            <h5 class="mb-1">Smart Lamp</h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-muted small">Wi‑Fi • App Control</div>
                                <div class="badge-price">$39</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-5">

            <div class="row">
                <div class="col-lg-8">
                    <h3>Store Features</h3>
                    <ul>
                        <li>Product catalog with categories and filters</li>
                        <li>Product detail pages with images and reviews</li>
                        <li>Shopping cart and secure checkout integration</li>
                        <li>Responsive design with optimized mobile experience</li>
                        <li>Promotions, coupons, and order history</li>
                    </ul>

                    <h4 class="mt-4">Technical Notes</h4>
                    <p class="text-muted">Frontend uses Bootstrap 5 for layout and components. Backend is designed for PHP (Laravel or plain PHP) with MySQL for product data; integrate payment gateway as needed.</p>

                    <a href="../portfolio.php" class="btn btn-outline-secondary mt-3"><i class="fas fa-arrow-left"></i> Back to Portfolio</a>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
