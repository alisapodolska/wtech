<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Aroma UA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Imperial+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/search-styles.css') }}">
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

<header class="section1">
    <div class="search-container">
        <input type="text" class="search-input" placeholder="Search...">
        <button class="search-button">Search</button>
    </div>
</header>

<nav class="filter-menu">
    <ul>
        <li class="active"><span class="icon">✖</span> All</li>
        <li>Fragrances</li>
        <li>Castile Soaps</li>
        <li>Body Lotions</li>
        <li>Gift Boxes</li>
        <li>Mid-size Gift Sets</li>
        <li>Gift Cards</li>
    </ul>
</nav>

<div class="container-fluid">
    <div class="row">
        
        <div class="col-lg-3 filter-sidebar">
            <div class="filter-container">
                <h5>SHOW FILTERS</h5>
                <hr>
                <table class="filter-table">
                    <tr>
                        <td>
                            <div class="filter-item">
                                <span class="filter-circle lost-garden"></span> LOST GARDEN
                            </div>
                        </td>
                        <td>
                            <div class="filter-item">
                                <span class="filter-circle woodland"></span> WOODLAND
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="filter-item">
                                <span class="filter-circle grassland"></span> GRASSLAND
                            </div>
                        </td>
                        <td>
                            <div class="filter-item">
                                <span class="filter-circle herb-garden"></span> HERB GARDEN
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="filter-item">
                                <span class="filter-circle atlantic-coast"></span> ATLANTIC COAST
                            </div>
                        </td>
                        <td></td>
                    </tr>
                </table>
                <div class="price-section">
                    <h6>Price (€)</h6>
                    <input type="range" class="form-range price-range" min="0" max="150" value="150">
                    <div class="text-end price-display">150.00</div>
                </div>
            </div>
        </div>

        
        <div class="col-lg-9">
            
            <button class="btn btn-outline-secondary show-filters-btn" type="button" data-bs-toggle="collapse" data-bs-target="#filtersCollapse" aria-expanded="false" aria-controls="filtersCollapse">
                Show Filters
            </button>

            <div class="collapse filters-mobile" id="filtersCollapse">
                <div class="filter-container">
                    <h5>SHOW FILTERS</h5>
                    <hr>
                    <table class="filter-table">
                        <tr>
                            <td>
                                <div class="filter-item">
                                    <span class="filter-circle lost-garden"></span> LOST GARDEN
                                </div>
                            </td>
                            <td>
                                <div class="filter-item">
                                    <span class="filter-circle woodland"></span> WOODLAND
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="filter-item">
                                    <span class="filter-circle grassland"></span> GRASSLAND
                                </div>
                            </td>
                            <td>
                                <div class="filter-item">
                                    <span class="filter-circle herb-garden"></span> HERB GARDEN
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="filter-item">
                                    <span class="filter-circle atlantic-coast"></span> ATLANTIC COAST
                                </div>
                            </td>
                            <td></td>
                        </tr>
                    </table>
                    <div class="price-section">
                        <h6>Price (€)</h6>
                        <input type="range" class="form-range price-range" min="0" max="150" value="150">
                        <div class="text-end price-display">150.00</div>
                    </div>
                </div>
            </div>

            
            <div class="product-grid">
                
                <div class="sort-container">
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Sort by Price
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                            <li><a class="dropdown-item" href="#" data-sort="asc">high to low</a></li>
                            <li><a class="dropdown-item" href="#" data-sort="desc">low to high</a></li>
                        </ul>
                    </div>
                </div>
                <h5 style="padding-top: 20px">Products</h5>
                <div class="row">
                    
                    <div class="col-12 col-md-4 mb-3 product-item">
                        <a href="{{ route('product-desc') }}" class="product-link">
                            <div class="product-image" style="background-image: url('../../../public/static/img/prod1.jpg');"></div>
                        </a>
                        <div class="product-overlay">
                            <div class="product-name">WILD ROSE</div>
                            <div class="product-subtitle">Eau de Parfum</div>
                            <div class="product-price">€130.00 / 50ml</div>
                            <span class="price">130.00</span>
                        </div>
                        <a class="add-to-bag" href="{{ route('cart') }}">Add to Bag</a>
                    </div>
                    <div class="col-12 col-md-4 mb-3 product-item">
                        <a href="{{ route('product-desc') }}" class="product-link">
                            <div class="product-image" style="background-image: url('../../../public/static/img/prod2.jpg');"></div>
                        </a>
                        <div class="product-overlay">
                            <div class="product-name">NEROLI</div>
                            <div class="product-subtitle">Eau de Parfum</div>
                            <div class="product-price">€130.00 / 50ml</div>
                            <span class="price">130.00</span>
                        </div>
                        <a class="add-to-bag" href="{{ route('cart') }}">Add to Bag</a>
                    </div>
                    <div class="col-12 col-md-4 mb-3 product-item">
                        <a href="{{ route('product-desc') }}" class="product-link">
                            <div class="product-image" style="background-image: url('../../../public/static/img/prod3.jpg');"></div>
                        </a>
                        <div class="product-overlay">
                            <div class="product-name">ILAUN</div>
                            <div class="product-subtitle">Eau de Parfum</div>
                            <div class="product-price">€60.00 / 50ml</div>
                            <span class="price">130.00</span>
                        </div>
                        <a class="add-to-bag" href="{{ route('cart') }}">Add to Bag</a>
                    </div>
                    <div class="col-12 col-md-4 mb-3 product-item">
                        <a href="{{ route('product-desc') }}" class="product-link">
                            <div class="product-image" style="background-image: url('../../../public/static/img/prod1.jpg');"></div>
                        </a>
                        <div class="product-overlay">
                            <div class="product-name">WILD ROSE</div>
                            <div class="product-subtitle">Eau de Parfum</div>
                            <div class="product-price">€130.00 / 50ml</div>
                            <span class="price">130.00</span>
                        </div>
                        <a class="add-to-bag" href="{{ route('cart') }}">Add to Bag</a>
                    </div>
                    <div class="col-12 col-md-4 mb-3 product-item">
                        <a href="{{ route('product-desc') }}" class="product-link">
                            <div class="product-image" style="background-image: url('../../../public/static/img/prod2.jpg');"></div>
                        </a>
                        <div class="product-overlay">
                            <div class="product-name">NEROLI</div>
                            <div class="product-subtitle">Eau de Parfum</div>
                            <div class="product-price">€130.00 / 50ml</div>
                            <span class="price">130.00</span>
                        </div>
                        <a class="add-to-bag" href="{{ route('cart') }}">Add to Bag</a>
                    </div>
                    <div class="col-12 col-md-4 mb-3 product-item">
                        <a href="{{ route('product-desc') }}" class="product-link">
                            <div class="product-image" style="background-image: url('../../../public/static/img/prod3.jpg');"></div>
                        </a>
                        <div class="product-overlay">
                            <div class="product-name">ILAUN</div>
                            <div class="product-subtitle">Eau de Parfum</div>
                            <div class="product-price">€60.00 / 50ml</div>
                            <span class="price">130.00</span>
                        </div>
                        <a class="add-to-bag" href="{{ route('cart') }}">Add to Bag</a>
                    </div>
                    <div class="col-12 col-md-4 mb-3 product-item">
                        <a href="{{ route('product-desc') }}" class="product-link">
                            <div class="product-image" style="background-image: url('../../../public/static/img/prod1.jpg');"></div>
                        </a>
                        <div class="product-overlay">
                            <div class="product-name">WILD ROSE</div>
                            <div class="product-subtitle">Eau de Parfum</div>
                            <div class="product-price">€130.00 / 50ml</div>
                            <span class="price">130.00</span>
                        </div>
                        <a class="add-to-bag" href="{{ route('cart') }}">Add to Bag</a>
                    </div>
                    <div class="col-12 col-md-4 mb-3 product-item">
                        <a href="{{ route('product-desc') }}" class="product-link">
                            <div class="product-image" style="background-image: url('../../../public/static/img/prod2.jpg');"></div>
                        </a>
                        <div class="product-overlay">
                            <div class="product-name">NEROLI</div>
                            <div class="product-subtitle">Eau de Parfum</div>
                            <div class="product-price">€130.00 / 50ml</div>
                            <span class="price">130.00</span>
                        </div>
                        <a class="add-to-bag" href="{{ route('cart') }}">Add to Bag</a>
                    </div>
                    <div class="col-12 col-md-4 mb-3 product-item">
                        <a href="{{ route('product-desc') }}" class="product-link">
                            <div class="product-image" style="background-image: url('../../../public/static/img/prod3.jpg');"></div>
                        </a>
                        <div class="product-overlay">
                            <div class="product-name">ILAUN</div>
                            <div class="product-subtitle">Eau de Parfum</div>
                            <div class="product-price">€60.00 / 50ml</div>
                            <span class="price">130.00</span>
                        </div>
                        <a class="add-to-bag" href="{{ route('cart') }}">Add to Bag</a>
                    </div>
                    <div class="col-12 col-md-4 mb-3 product-item">
                        <a href="{{ route('product-desc') }}" class="product-link">
                            <div class="product-image" style="background-image: url('../../../public/static/img/prod1.jpg');"></div>
                        </a>
                        <div class="product-overlay">
                            <div class="product-name">WILD ROSE</div>
                            <div class="product-subtitle">Eau de Parfum</div>
                            <div class="product-price">€130.00 / 50ml</div>
                            <span class="price">130.00</span>
                        </div>
                        <a class="add-to-bag" href="{{ route('cart') }}">Add to Bag</a>
                    </div>
                    <div class="col-12 col-md-4 mb-3 product-item">
                        <a href="{{ route('product-desc') }}" class="product-link">
                            <div class="product-image" style="background-image: url('../../../public/static/img/prod2.jpg');"></div>
                        </a>
                        <div class="product-overlay">
                            <div class="product-name">NEROLI</div>
                            <div class="product-subtitle">Eau de Parfum</div>
                            <div class="product-price">€130.00 / 50ml</div>
                            <span class="price">130.00</span>
                        </div>
                        <a class="add-to-bag" href="{{ route('cart') }}">Add to Bag</a>
                    </div>
                    <div class="col-12 col-md-4 mb-3 product-item">
                        <a href="{{ route('product-desc') }}" class="product-link">
                            <div class="product-image" style="background-image: url('../../../public/static/img/prod3.jpg');"></div>
                        </a>
                        <div class="product-overlay">
                            <div class="product-name">ILAUN</div>
                            <div class="product-subtitle">Eau de Parfum</div>
                            <div class="product-price">€60.00 / 50ml</div>
                            <span class="price">130.00</span>
                        </div>
                        <a class="add-to-bag" href="{{ route('cart') }}">Add to Bag</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer>
    <div class="footer-container">
        <div class="footer-logo">
            <h2>The Aroma UA</h2>
        </div>
        <div class="footer-links">
            <div class="footer-column">
                <h3>The Burren Perfumery</h3>
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


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<script>
    document.querySelectorAll('.price-range').forEach(slider => {
        slider.addEventListener('input', function() {
            this.nextElementSibling.textContent = this.value + '.00';
        });
    });
</script>
</body>
</html>