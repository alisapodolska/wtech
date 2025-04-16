<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Aroma UA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Imperial+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/product-desc-styles.css') }}">
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


@php
    $typeClassMap = [
        'ATLANTIC COAST' => 'type1',
        'GRASSLAND' => 'type2',
        'HERB GARDEN' => 'type3',
        'LOST GARDEN' => 'type4',
        'WOODLAND' => 'type5',
    ];
    $bgClass = $typeClassMap[$product->scent] ?? 'type1';
@endphp

<div class="product-container {{ $bgClass }}">
    <div class="content">
        <div class="row">
            <div class="col-md-4 price" style="margin-top: 70px">
                <h3 class="product-name">{{ $product->name }}</h3>
                <p class="product-volume">{{ $product->type }} / {{ $product->volume }}ml</p>
                <h4 class="product-price">€{{ $product->price }}</h4>
                <label for="quantity" class="quantity-label">Quantity</label>
                <input type="number" id="quantity" class="form-control quantity-input" value="1" min="1">
                <button class="btn add-to-bag-btn mt-3">ADD TO BAG</button>
            </div>

            <div class="col-md-4 img">
                <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="img-container">
                                <img src="{{ asset($product->image1) }}" class="product-img" alt="{{ $product->name }}">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="img-container">
                                <img src="{{ asset($product->image2) }}" class="product-img" alt="{{ $product->name }}">
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

                <p class="tab-content description">{{ $product->description }}</p>
                <p class="tab-content ingredients" style="display: none;">{{ $product->ingredients }}</p>

                <p><strong>COSMOS Natural Certified:</strong> 100% natural ingredients, 77% organic of total.</p>
            </div>
        </div>
    </div>
</div>

<section class="scent-family-section">
    <div class="scent-description">
        <h2>More from the Scent Family</h2>
        <p>{{ $product->scent }}</p>
    </div>

    <div class="container">
        <div class="row scent-container justify-content-lg-center">
            @foreach ($relatedProducts as $related)
                <div class="col-12 col-md-3 mb-3 product-item">
                    <a href="{{ route('product-desc', ['id' => $related->id]) }}">
                        <div class="product-image" style="background-image: url('{{ asset($related->image1) }}');"></div>
                    </a>
                    <div class="product-overlay">
                        <div class="product-name">{{ $related->name }}</div>
                        <div class="product-subtitle">{{ $related->type }}</div>
                        <div class="product-price">€{{ $related->price }} / {{ $related->volume }}ml</div>
                        <span class="price">{{ str_replace('€', '', $related->price) }}</span>
                    </div>
                    <button class="add-to-bag" onclick="window.location.href='{{ route('cart') }}'">Add to Bag</button>
                </div>
            @endforeach
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
<script src="../../js/javascript/tabs.js" defer></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const tabs = document.querySelectorAll(".tab-link");
        const contents = document.querySelectorAll(".tab-content");

        console.log("Tabs found:", tabs.length);  // Debugging
        console.log("Contents found:", contents.length);  // Debugging

        if (tabs.length === 0 || contents.length === 0) {
            console.error("Tabs or contents not found. Check if they exist in HTML.");
            return;
        }

        tabs.forEach(tab => {
            tab.addEventListener("click", function (e) {
                e.preventDefault();

                // Remove "active" class from all tabs
                tabs.forEach(t => t.classList.remove("active"));
                this.classList.add("active");

                // Hide all content
                contents.forEach(content => content.style.display = "none");

                // Show the correct content
                const selectedTab = this.getAttribute("data-tab");
                document.querySelectorAll(`.${selectedTab}`).forEach(content => content.style.display = "block");
            });
        });
    });
</script>
</body>
</html>