<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>The Aroma UA - Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Imperial+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/cart-styles.css') }}">
</head>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const debounce = (func, delay) => {
            let timer;
            return (...args) => {
                clearTimeout(timer);
                timer = setTimeout(() => func(...args), delay);
            };
        };

        const updateCart = debounce(async (input) => {
            const id = input.dataset.id;
            let qty = parseInt(input.value);

            if (isNaN(qty) || qty < 1) qty = 1;
            if (qty > 20) qty = 20;
            input.value = qty;

            try {
                const response = await fetch(`/cart/update/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ quantity: qty })
                });

                const data = await response.json();

                if (data.success) {
                    const item = input.closest('.cart-item');
                    item.querySelector('.price').textContent = `€${data.newPrice}`;

                    const subtotalElem = document.querySelector('.subtotal h5:last-child');
                    if (subtotalElem) subtotalElem.textContent = `€${data.subtotal}`;
                }
            } catch (err) {
                console.error('Cart update failed:', err);
            }
        }, 300); // debounce time (ms)

        document.querySelectorAll('.cart-qty').forEach(input => {
            input.addEventListener('input', () => updateCart(input));
        });
    });
</script>
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

<section class="cart-section py-5">
    <div class="container">
        <h2>Your Cart</h2>
        <div class="cart-items">
            @php
                $subtotal = 0;
            @endphp

            @forelse ($cart as $id => $item)
                @php $subtotal += $item['price'] * $item['quantity']; @endphp
                <div class="cart-item d-flex align-items-center justify-content-between border-bottom py-3">
                    <div class="d-flex align-items-center">
                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="item-image">
                        <div class="item-details ms-3">
                            <p class="mb-0">{{ $item['name'] }}: {{ isset($item['volume']) ? $item['volume'] : 'N/A' }}ml</p>
                            <div class="d-flex align-items-center mt-2">
                                <label for="quantity-{{ $id }}" class="me-2">Qty</label>
                                <input
                                        type="number"
                                        name="quantity"
                                        id="quantity-{{ $id }}"
                                        value="{{ $item['quantity'] }}"
                                        min="1"
                                        class="form-control form-control-sm w-auto me-2 cart-qty"
                                        data-id="{{ $id }}"
                                >
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center">
                        <p class="price mb-0 me-3">€{{ number_format($item['price'] * $item['quantity'], 2) }}</p>

                        <!-- Remove item -->
                        <form method="POST" action="{{ route('cart.remove', ['id' => $id]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Remove item">
                                ×
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p>Your cart is empty.</p>
            @endforelse
        </div>

        @if ($subtotal > 0)
            <div class="subtotal d-flex justify-content-between py-3">
                <h5>Subtotal</h5>
                <h5>€{{ number_format($subtotal, 2) }}</h5>
            </div>
        @endif

        <form method="POST" action="{{ route('checkout') }}">
            @csrf
            <input type="hidden" name="subtotal" value="{{ $subtotal }}">
            @foreach ($cart as $id => $item)
                <input type="hidden" name="cart[{{ $id }}][name]" value="{{ $item['name'] }}">
                <input type="hidden" name="cart[{{ $id }}][price]" value="{{ $item['price'] }}">
                <input type="hidden" name="cart[{{ $id }}][quantity]" value="{{ $item['quantity'] }}">
                <input type="hidden" name="cart[{{ $id }}][image]" value="{{ $item['image'] }}">
                <input type="hidden" name="cart[{{ $id }}][volume]" value="{{ isset($item['volume']) ? $item['volume'] : 'N/A' }}">
            @endforeach
            <div class="d-flex justify-content-between mb-5">
                <button type="submit" class="btn btn-secondary custom-btn">Proceed to Checkout</button>
            </div>
        </form>
        @csrf
        <div class="d-flex justify-content-between mb-5">
        <a href="{{ route('catalog') }}" class="btn btn-outline-secondary">Continue Shopping</a>
        <input type="hidden" name="subtotal" value="{{ number_format($subtotal, 2) }}">
{{--        <button type="submit" class="btn btn-secondary custom-btn">Checkout</button>--}}
        </div>
    </form>
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