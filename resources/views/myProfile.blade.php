<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Aroma UA - My Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Imperial+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/myProfile-styles.css') }}">
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
        <header class="logo">
            <a class="navbar-brand" href="main_page.blade.php">The Aroma UA</a>
        </header>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('catalog') }}">Shop</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('about-us') }}">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('profile') }}">Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('search') }}">Search</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('cart') }}">Bag</a></li>
            </ul>
        </div>
    </div>
</nav>


<section class="profile-header py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <h2 class="profile-title">My Profile</h2>
        <div class="profile-actions">
            <button class="btn btn-outline-danger">Log Out</button>
        </div>
    </div>
</section>


<section class="profile-info py-5">
    <div class="container">
        <div class="user-details text-center">
        <h3 class="user-name">{{ $user->name }}</h3>
        </div>

        
        <div class="orders-list mt-5">
            <h4 class="orders-title">Your Orders</h4>
            
            <div class="order-item d-flex align-items-center justify-content-between border-bottom py-3">
                <div class="d-flex align-items-center">
                    <img src="https://i.postimg.cc/t7pNQLDB/prod1.jpg" alt="Wild Rose" class="item-image">
                    <div class="order-details ms-3">
                        <p class="mb-0">WILD ROSE: 50ml</p>
                        <p class="mb-0 text-muted">Order #12345 - Delivered on March 15, 2025</p>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <p class="price mb-0">€130.00</p>
                    <button class="btn btn-sm btn-outline-primary ms-3">View Details</button>
                </div>
            </div>
            
            <div class="order-item d-flex align-items-center justify-content-between border-bottom py-3">
                <div class="d-flex align-items-center">
                    <img src="https://i.postimg.cc/JHrNNktf/prod2.jpg" alt="Neroli" class="item-image">
                    <div class="order-details ms-3">
                        <p class="mb-0">NEROLI: 50ml</p>
                        <p class="mb-0 text-muted">Order #12346 - Shipped on March 20, 2025</p>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <p class="price mb-0">€130.00</p>
                    <button class="btn btn-sm btn-outline-primary ms-3">View Details</button>
                </div>
            </div>
            
            <div class="order-item d-flex align-items-center justify-content-between border-bottom py-3">
                <div class="d-flex align-items-center">
                    <img src="https://i.postimg.cc/0rnd8cBP/prod3.jpg" alt="Ilaun" class="item-image">
                    <div class="order-details ms-3">
                        <p class="mb-0">ILAUN: 50ml</p>
                        <p class="mb-0 text-muted">Order #12347 - Processing</p>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <p class="price mb-0">€60.00</p>
                    <button class="btn btn-sm btn-outline-primary ms-3">View Details</button>
                </div>
            </div>
        </div>
    </div>
</section>


<footer>
    <div class="footer-container">
        <div class="footer-logo">
            <h2>The Aroma UA</h2>
        </div>
        <div class="footer-links">
            <div class="footer-column">
                <h3>The Aroma UA</h3>
                <ul>
                    <li><a href="{{ route('about-us') }}">About Us</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Our Philosophy</h3>
                <p>We make perfumes and cosmetics using natural and organic ingredients. We take our inspiration from the landscape around us. Everything is made by hand, on site, in the Burren.</p>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>© The Aroma UA 2025<br>All rights reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>