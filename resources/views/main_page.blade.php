<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Aroma UA</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Imperial+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/main-styles.css') }}">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">
            <header class="logo">
                <a class="navbar-brand" href="#">The Aroma UA</a>
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
                    <li class="nav-item"><a class="nav-link" href="cart.blade.php">Bag</a></li>
                </ul>
            </div>
        </div>
    </nav>

    
    <header class="section1">
        <div class="container">
            <div class="text-box text-center">
                <h1>Uliana & Alisa</h1>
                <button class="btn btn-shop" >SHOP NOW</button>
            </div>
        </div>
    </header>

    
    <section class="about">
        <div class="container">
            <p>
                Two girls studying at FIIT Slovakia decided to turn their passion for fragrances into a small business, crafting unique perfumes that tell a story. Inspired by emotions, memories, and the art of scent, each perfume is carefully blended by hand in small batches.
            </p>
        </div>
    </section>

    
    <section class="products">
        <div class="container">
            <div class="left-section">
                <a href="product-desc.blade.php" class="product-link">
                    <div class="product">
                        <i class="fas fa-spray-can fa-3x"></i>
                        <h3>PERFUME BODY LOTIONS</h3>
                        <p>200ml</p>
                        <p class="price">€28.00</p>
                    </div>
                </a>
                <a href="product-desc.blade.php" class="product-link">
                    <div class="product">
                        <i class="fas fa-soap fa-3x"></i>
                        <h3>ORGANIC CASTILE SOAP</h3>
                        <p>200ml / Various Scents</p>
                        <p class="price">€18.00</p>
                    </div>
                </a>
            </div>
            <div class="right-section">
                <a href="product-desc.blade.php" class="product-link">
                    <div class="product">
                        <i class="fas fa-spray-can fa-3x"></i>
                        <h3>PERFUME BODY LOTIONS</h3>
                        <p>200ml</p>
                        <p class="price">€28.00</p>
                    </div>
                </a>
                <a href="product-desc.blade.php" class="product-link">
                    <div class="product">
                        <i class="fas fa-soap fa-3x"></i>
                        <h3>ORGANIC CASTILE SOAP</h3>
                        <p>200ml / Various Scents</p>
                        <p class="price">€18.00</p>
                    </div>
                </a>
            </div>
        </div>
    </section>

    
    <section class="section2">
        <div class="container">
            <img src="https://i.pinimg.com/736x/f4/28/a8/f428a8f8fcda2f0f5247f43acf1dea16.jpg" class="pic4" alt="Perfume Test Background">
            <div class="text-overlay">
                <p>Take a test to find the best perfume for you</p>
                <button class="btn perfume-test-btn" >Take the Test</button>
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