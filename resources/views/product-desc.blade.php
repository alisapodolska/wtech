<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Aroma UA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Imperial+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/styles/product-desc-styles.css">
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
                <li class="nav-item"><a class="nav-link" href="cart.blade.php">Bag</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="product-container">
    <div class="content">
        <div class="row">
            <div class="col-md-4 price" style="margin-top: 70px">
                <h3 class="product-name">Wild Rose</h3>
                <p class="product-volume">Eau de Parfum / 50ml</p>
                <h4 class="product-price">€130.00</h4>
                <label for="quantity" class="quantity-label">Quantity</label>
                <input type="number" id="quantity" class="form-control quantity-input" value="1" min="1">
                <button class="btn add-to-bag-btn mt-3">ADD TO BAG</button>
            </div>

            <div class="col-md-4 img">
                <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="img-container">
                                <img src="../../../public/static/img/prod1.jpg" class="product-img" alt="Wild Rose Box">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="img-container">
                                <img src="../../../public/static/img/prod1_1.jpg" class="product-img" alt="Wild Rose Angle 2">
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <div class="col-md-4 description-box">
                <div class="tab-menu mb-2">
                    <a href="#" class="tab-link active" data-tab="description">Description</a>
                    <a href="#" class="tab-link inactive" data-tab="ingredients">Ingredients</a>
                </div>

                <p class="tab-content description active">
                    We imagine daybreak in the Burren: the fresh delicacy of the Burnet Rose is slowly warmed by the rising sun,
                    revealing a soft rose petal heart grounded in fragrant Honey and Sandalwood notes.
                </p>
                <p class="tab-content description active">
                    Wild Rose opens at dawn with the sparkling notes of Pink Grapefruit and Bergamot, heralding the precious Grasse Rose
                    Centifolia - natural, delicate, velvety. As low sunlight warms the rose, the soft honey notes of Rosa Damascena blend
                    with the sensuous warm notes of Sandalwood, smooth Benzoin, Beeswax and a hint of Gaicwood is brushed by the green
                    freshness of Angelica. The fragile, rare touch of natural Ambrette Seed brings richness to the perfume but remains
                    discreet and delicate.
                </p>

                <p class="tab-content ingredients" style="display: none;">
                    Alcohol Denat.,Parfum, Aqua, Benzyl Alcohol, Benzyl Benzoate, Citral, Citronellol,
                    Eugenol, Farnesol, Geraniol, Hexyl Cinnamal, Isoeugenol, Linalool, Limonene. Allergens listed in italics.
                </p>
                <p><strong>COSMOS Natural Certified:</strong> 100% natural ingredients, 77% organic of total.</p>
            </div>
        </div>
    </div>
</div>

<section class="scent-family-section">
    <div class="scent-description">
        <h2>More from
            the Scent Family</h2>
        <p> Lost Garden </p>
    </div>

    <div class="scent-container">
        <div class="col-12 col-md-4 mb-3 product-item">
            <div class="product-image" style="background-image: url('../../../public/static/img/prod1.jpg');"></div>
            <div class="product-overlay">
                <div class="product-name">WILD ROSE</div>
                <div class="product-subtitle">Eau de Parfum</div>
                <div class="product-price">€130.00 / 50ml</div>
                <span class="price">130.00</span>
            </div>
            <button class="add-to-bag" onclick="window.location.href='cart.html'">Add to Bag</button>
        </div>
        <div class="col-12 col-md-4 mb-3 product-item">
            <div class="product-image" style="background-image: url('../../../public/static/img/prod2.jpg');"></div>
            <div class="product-overlay">
                <div class="product-name">NEROLI</div>
                <div class="product-subtitle">Eau de Parfum</div>
                <div class="product-price">€130.00 / 50ml</div>
                <span class="price">130.00</span>
            </div>
            <button class="add-to-bag">Add to Bag</button>
        </div>
        <div class="col-12 col-md-4 mb-3 product-item">
            <div class="product-image" style="background-image: url('../../../public/static/img/prod3.jpg');"></div>
            <div class="product-overlay">
                <div class="product-name">ILAUN</div>
                <div class="product-subtitle">Eau de Parfum</div>
                <div class="product-price">€60.00 / 50ml</div>
                <span class="price">130.00</span>
            </div>
            <button class="add-to-bag">Add to Bag</button>
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
<script src="../../js/javascript/tabs.js" defer></script>
</body>
</html>