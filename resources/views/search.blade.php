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
            <a class="navbar-brand" href="{{ route('main_page') }}">The Aroma UA</a>
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
        <form method="GET" action="{{ route('search') }}">
            <input type="text" name="query" id="search-box" placeholder="Search products..." value="{{ request('query') }}" autocomplete="off">
            <button type="submit" class="search-btn">Search</button>
        </form>

        <div id="suggestions" class="suggestions-box"></div>
    </div>
</header>

<script>
    const searchBox = document.getElementById('search-box');
    const suggestionsBox = document.getElementById('suggestions');

    searchBox.addEventListener('input', function () {
        const query = this.value;

        fetch(`/live-search?query=${encodeURIComponent(query)}`)
            .then(res => res.json())
            .then(products => {
                if (!products.length) {
                    suggestionsBox.innerHTML = '<div style="padding: 5px;">No matches</div>';
                    return;
                }

                // Create suggestion list
                suggestionsBox.innerHTML = products.map(product => `
                    <div style="padding: 5px; cursor: pointer;" onclick="location.href='/product/${product.id}'">
                        ${product.name}
                    </div>
                `).join('');
            });
    });
</script>

<nav class="filter-menu">
    <ul>
        <li class="{{ !request('type') ? 'active' : '' }}">
            <a href="{{ route('search', request()->except('type')) }}">
                All
            </a>
        </li>
        <li class="{{ request('type') == 'Eau de Parfum' ? 'active' : '' }}">
            <a href="{{ route('search', array_merge(request()->except('type'), ['type' => 'Eau de Parfum'])) }}">
                Eau de Parfum
            </a>
        </li>
        <li class="{{ request('type') == 'Eau de Toilette' ? 'active' : '' }}">
            <a href="{{ route('search', array_merge(request()->except('type'), ['type' => 'Eau de Toilette'])) }}">
                Eau de Toilette
            </a>
        </li>
        <li class="{{ request('type') == 'Body Lotions' ? 'active' : '' }}">
            <a href="{{ route('search', array_merge(request()->except('type'), ['type' => 'Body Lotions'])) }}">
                Body Lotions
            </a>
        </li>
        <li class="{{ request('type') == 'Castile Soaps' ? 'active' : '' }}">
            <a href="{{ route('search', array_merge(request()->except('type'), ['type' => 'Castile Soaps'])) }}">
                Castile Soaps
            </a>
        </li>
    </ul>
</nav>

<div class="container-fluid">
    <div class="row">

        <div class="col-lg-3 filter-sidebar">
            <form method="GET" action="{{ url()->current() }}">
                <div class="filter-container">
                    <h5>SHOW FILTERS</h5>
                    <hr>
                    <table class="filter-table">
                        <tr>
                            <td>
                                <label class="circle-checkbox">
                                    <input type="checkbox" name="category[]" value="LOST GARDEN" id="lost-garden"
                                            {{ in_array('LOST GARDEN', request()->input('category', [])) ? 'checked' : '' }}>
                                    <span class="filter-circle lost-garden"></span> LOST GARDEN
                                </label>
                            </td>
                            <td>
                                <label class="circle-checkbox">
                                    <input type="checkbox" name="category[]" value="WOODLAND" id="woodland"
                                            {{ in_array('WOODLAND', request()->input('category', [])) ? 'checked' : '' }}>
                                    <span class="filter-circle woodland"></span> WOODLAND
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="circle-checkbox">
                                    <input type="checkbox" name="category[]" value="GRASSLAND" id="grassland"
                                            {{ in_array('GRASSLAND', request()->input('category', [])) ? 'checked' : '' }}>
                                    <span class="filter-circle grassland"></span> GRASSLAND
                                </label>
                            </td>
                            <td>
                                <label class="circle-checkbox">
                                    <input type="checkbox" name="category[]" value="HERB GARDEN" id="herb-garden"
                                            {{ in_array('HERB GARDEN', request()->input('category', [])) ? 'checked' : '' }}>
                                    <span class="filter-circle herb-garden"></span> HERB GARDEN
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="circle-checkbox">
                                    <input type="checkbox" name="category[]" value="ATLANTIC COAST" id="atlantic-coast"
                                            {{ in_array('ATLANTIC COAST', request()->input('category', [])) ? 'checked' : '' }}>
                                    <span class="filter-circle atlantic-coast"></span> ATLANTIC COAST
                                </label>
                            </td>
                            <td></td>
                        </tr>
                    </table>

                    <div class="price-section mt-3">
                        <h6>Price (€)</h6>
                        <input type="range" class="form-range price-range" name="price" min="0" max="150" value="{{ request('price', 150) }}">
                        <div class="text-end price-display">{{ request('price', 150) }}.00</div>
                    </div>

                    <div class="volume-section mt-3">
                        <h6>Volume (ml)</h6>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="volume[]" value="30" id="volume30"
                                    {{ in_array('30', request()->input('volume', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="volume30">30ml</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="volume[]" value="50" id="volume50"
                                    {{ in_array('50', request()->input('volume', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="volume50">50ml</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="volume[]" value="100" id="volume100"
                                    {{ in_array('100', request()->input('volume', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="volume100">100ml</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-pink mt-3">Apply Filters</button>
                </div>
            </form>
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
                                <label class="circle-checkbox">
                                    <input type="checkbox" name="category[]" value="LOST GARDEN" id="lost-garden"
                                            {{ in_array('LOST GARDEN', request()->input('category', [])) ? 'checked' : '' }}>
                                    <span class="filter-circle lost-garden"></span> LOST GARDEN
                                </label>
                            </td>
                            <td>
                                <label class="circle-checkbox">
                                    <input type="checkbox" name="category[]" value="WOODLAND" id="woodland"
                                            {{ in_array('WOODLAND', request()->input('category', [])) ? 'checked' : '' }}>
                                    <span class="filter-circle woodland"></span> WOODLAND
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="circle-checkbox">
                                    <input type="checkbox" name="category[]" value="GRASSLAND" id="grassland"
                                            {{ in_array('GRASSLAND', request()->input('category', [])) ? 'checked' : '' }}>
                                    <span class="filter-circle grassland"></span> GRASSLAND
                                </label>
                            </td>
                            <td>
                                <label class="circle-checkbox">
                                    <input type="checkbox" name="category[]" value="HERB GARDEN" id="herb-garden"
                                            {{ in_array('HERB GARDEN', request()->input('category', [])) ? 'checked' : '' }}>
                                    <span class="filter-circle herb-garden"></span> HERB GARDEN
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="circle-checkbox">
                                    <input type="checkbox" name="category[]" value="ATLANTIC COAST" id="atlantic-coast"
                                            {{ in_array('ATLANTIC COAST', request()->input('category', [])) ? 'checked' : '' }}>
                                    <span class="filter-circle atlantic-coast"></span> ATLANTIC COAST
                                </label>
                            </td>
                            <td></td>
                        </tr>
                    </table>

                    <div class="price-section mt-3">
                        <h6>Price (€)</h6>
                        <input type="range" class="form-range price-range" name="price" min="0" max="150" value="{{ request('price', 150) }}">
                        <div class="text-end price-display">{{ request('price', 150) }}.00</div>
                    </div>

                    <div class="volume-section mt-3">
                        <h6>Volume (ml)</h6>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="volume[]" value="30" id="volume30"
                                    {{ in_array('30', request()->input('volume', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="volume30">30ml</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="volume[]" value="50" id="volume50"
                                    {{ in_array('50', request()->input('volume', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="volume50">50ml</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="volume[]" value="100" id="volume100"
                                    {{ in_array('100', request()->input('volume', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="volume100">100ml</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Apply Filters</button>
                </div>
                </form>
            </div>


            <div class="product-grid">
                <div class="sort-container">
                    <div class="dropdown">
                        <button class="btn sort-button btn-outline-secondary dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Sort by Price
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                            <li><a class="dropdown-item {{ $sort == 'desc' ? 'active' : '' }}" href="{{ route('search', array_merge(request()->query(), ['sort' => 'asc'])) }}">Low to High</a></li>
                            <li><a class="dropdown-item {{ $sort == 'asc' ? 'active' : '' }}" href="{{ route('search', array_merge(request()->query(), ['sort' => 'desc'])) }}">High to Low</a></li>
                        </ul>
                    </div>
                </div>
                <h5 style="padding-top: 20px">Products</h5>
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-12 col-md-4 mb-3 product-item">
                            <a href="{{ route('product-desc', ['id' => $product->id]) }}" class="product-link">
                                <div class="product-image" style="background-image: url('{{ $product['image1'] }}');"></div>
                            </a>
                            <div class="product-overlay">
                                <div class="product-name">{{ $product->name }}</div>
                                <div class="product-subtitle">{{ $product->type }}</div>
                                <div class="product-price">€{{ $product->price }} / {{ $product->volume }}ml</div>
                                <span class="price">{{ str_replace('€', '', $product->price) }}</span>
                            </div>
                            <form method="POST" action="{{ route('cart.add', $product->id) }}" class="add-to-bag-form">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="add-to-bag">Add to Bag</button>
                            </form>
                        </div>
                    @endforeach
                </div>
                <nav role="navigation" aria-label="Pagination Navigation" class="custom-pagination">
                    {{ $products->links() }}
                </nav>
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

<div id="cart-toast" class="cart-toast">Product added to cart!</div>

<script>
    document.querySelectorAll('.add-to-bag-form').forEach(form => {
        form.addEventListener('submit', async function (e) {
            e.preventDefault();

            const formData = new FormData(form);
            const action = form.getAttribute('action');
            const token = form.querySelector('input[name="_token"]').value;

            try {
                const response = await fetch(action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json',
                    },
                    body: formData
                });

                if (!response.ok) throw new Error('Something went wrong');

                const data = await response.json();
                showToast(data.message); // 👈 replace alert
            } catch (error) {
                console.error('Error:', error);
                showToast('Could not add product to cart.', true);
            }
        });
    });

    function showToast(message, isError = false) {
        const toast = document.getElementById('cart-toast');
        toast.textContent = message;
        toast.style.backgroundColor = isError ? '#dc3545' : '#28a745';
        toast.style.display = 'block';

        setTimeout(() => {
            toast.style.display = 'none';
        }, 2500);
    }
</script>
<script>
    document.querySelectorAll('.price-range').forEach(slider => {
        slider.addEventListener('input', function() {
            this.nextElementSibling.textContent = this.value + '.00';
        });
    });
</script>
</body>
</html>