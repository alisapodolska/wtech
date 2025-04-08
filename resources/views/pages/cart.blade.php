<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Aroma UA - Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Imperial+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/styles/cart-styles.css">
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
                <li class="nav-item"><a class="nav-link" href="catalog.blade.php">Shop</a></li>
                <li class="nav-item"><a class="nav-link" href="aboutUs.blade.php">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="myProfile.blade.php">Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="search.blade.php">Search</a></li>
                <li class="nav-item"><a class="nav-link" href="login.blade.php">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="cart.html">Bag</a></li>
            </ul>
        </div>
    </div>
</nav>


<section class="cart-section py-5">
    <div class="container">
        <h2>Your Cart</h2>
        <div class="cart-items">
            
            <div class="cart-item d-flex align-items-center justify-content-between border-bottom py-3">
                <div class="d-flex align-items-center">
                    <img src="https://i.postimg.cc/t7pNQLDB/prod1.jpg" alt="Wild Rose" class="item-image">
                    <div class="item-details ms-3">
                        <p class="mb-0">WILD ROSE: 60ml</p>
                        <div class="quantity d-flex align-items-center mt-2">
                            <span>Qty</span>
                            <button class="btn btn-sm btn-outline-secondary mx-2">-</button>
                            <span>1</span>
                            <button class="btn btn-sm btn-outline-secondary mx-2">+</button>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <p class="price mb-0">€130.00</p>
                    <button class="btn btn-sm btn-outline-secondary ms-3">×</button>
                </div>
            </div>
            
            <div class="cart-item d-flex align-items-center justify-content-between border-bottom py-3">
                <div class="d-flex align-items-center">
                    <img src="https://i.postimg.cc/JHrNNktf/prod2.jpg" alt="Neroli" class="item-image">
                    <div class="item-details ms-3">
                        <p class="mb-0">NEROLI: 60ml</p>
                        <div class="quantity d-flex align-items-center mt-2">
                            <span>Qty</span>
                            <button class="btn btn-sm btn-outline-secondary mx-2">-</button>
                            <span>1</span>
                            <button class="btn btn-sm btn-outline-secondary mx-2">+</button>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <p class="price mb-0">€130.00</p>
                    <button class="btn btn-sm btn-outline-secondary ms-3">×</button>
                </div>
            </div>
        </div>
        
        <div class="subtotal d-flex justify-content-between py-3">
            <h5>Subtotal</h5>
            <h5>€260.00</h5> 
        </div>
        
        <div class="cart-actions d-flex justify-content-between">
            <button class="btn btn-outline-secondary">Continue Shopping</button>
            <button class="btn btn-secondary">Checkout</button>
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
                    <li><a href="#">About Us</a></li>
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