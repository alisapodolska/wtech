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
    <!-- Header -->
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
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link" style="color: inherit; text-decoration: none;">Logout</button>
                        </form>
                    </li>
                <li class="nav-item"><a class="nav-link" href="{{ route('cart') }}">Bag</a></li>
            </ul>
        </div>
    </div>
</nav>

    <!-- Profile Content -->
    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
        </div>
        @endif

        <!-- User Name Section -->
        <div class="text-center mb-5">
            <h1 class="display-4" style="font-family: 'Imperial Script', cursive; color: #333;">{{ auth()->user()->name }}</h1>
            <p class="text-muted">Welcome to your profile</p>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-4">Order History</h2>
                @if(isset($orders) && $orders->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Total Price</th>
                                    <th>Payment Method</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->date->format('Y-m-d') }}</td>
                                        <td>
                                            <span class="badge bg-{{ $order->status === 'pending' ? 'warning' : 'success' }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td>{{ number_format($order->total_price, 2) }}€</td>
                                        <td>{{ ucfirst($order->orderInfo->payment_method) }}</td>
                                        <td>
                                            <button class="btn btn-link p-0 text-decoration-underline text-secondary" data-bs-toggle="modal" 
                                                    data-bs-target="#orderDetailsModal{{ $order->id }}">
                                                View Details
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Order Details Modal -->
                                    <div class="modal fade" id="orderDetailsModal{{ $order->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Order Details #{{ $order->id }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <h6>Customer Information</h6>
                                                        <p><strong>Name:</strong> {{ $order->orderInfo->customer_name }}</p>
                                                        <p><strong>Email:</strong> {{ $order->orderInfo->email }}</p>
                                                        <p><strong>Phone:</strong> {{ $order->orderInfo->phone }}</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6>Delivery Address</h6>
                                                        <p><strong>Country:</strong> {{ $order->orderInfo->country }}</p>
                                                        <p><strong>City:</strong> {{ $order->orderInfo->city }}</p>
                                                        <p><strong>Address:</strong> {{ $order->orderInfo->address }}</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6>Order Summary</h6>
                                                        <p><strong>Total Price:</strong> {{ number_format($order->total_price, 2) }}€</p>
                                                        <p><strong>Number of Items:</strong> {{ $order->total_amount }}</p>
                                                        <p><strong>Payment Method:</strong> {{ ucfirst($order->orderInfo->payment_method) }}</p>
                                                    </div>
                    </div>
                </div>
                </div>
            </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info">
                        You don't have any orders yet.
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Footer -->
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