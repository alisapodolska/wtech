<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>The Aroma UA - Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Imperial+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/checkout-styles.css') }}">
    <style>
        #place-order {
            display: none; /* Initially hidden */
        }
        .error {
            color: red;
            font-size: 0.9em;
            display: block;
        }
        #confirm-info-label {
            color: #6c757d; /* Matches text-muted for consistency */
            font-style: italic;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">
            <header class="logo sectarian">
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

    <!-- Checkout Section -->
    <form method="POST" id="checkout-form">
        @csrf
        <section class="checkout-section py-5">
            <div class="container">
                <div class="row">
                    <!-- Delivery Address -->
                    <div class="col-md-6 mb-4">
                        <h3>Delivery Address</h3>
                        <p class="text-muted">Add your delivery address</p>
                        <p class="required-text">*Required fields</p>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="Full Name *" required>
                            <span class="error" id="customer_name_error"></span>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email *" required>
                            <span class="error" id="email_error"></span>
                        </div>
                        <div class="mb-3">
                            <select class="form-control" name="country" id="country" required>
                                <option value="">Select Country *</option>
                                <option value="Slovakia (EUR €)">Slovakia (EUR €)</option>
                            </select>
                            <span class="error" id="country_error"></span>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="City *" name="city" id="city" required>
                            <span class="error" id="city_error"></span>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Address *" name="address" id="address" required>
                            <span class="error" id="address_error"></span>
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <select class="form-control phone-code" name="phone_code" id="phone_code" required>
                                    <option value="+421">+421</option>
                                </select>
                                <input type="tel" class="form-control" placeholder="Phone *" name="phone" id="phone" required>
                            </div>
                            <span class="error" id="phone_error"></span>
                        </div>
                        <input type="hidden" name="payment_method" id="selected_payment_method" value="">
                    </div>

                    <!-- Summary -->
                    <div class="col-md-6">
                        <div class="summary-card p-4">
                            <h3 class="d-flex justify-content-between align-items-center">
                                <span>Summary</span>
                            </h3>
                            @foreach($cartItems as $item)
                            <div class="cart-item d-flex align-items-center border-bottom py-3">
                                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="item-image me-3">
                                <div class="flex-grow-1">
                                    <p class="mb-0">{{ $item['name'] }}</p>
                                </div>
                                <p class="mb-0">{{ $item['quantity'] }} x {{ $item['price'] }}€</p>
                            </div>
                            @endforeach

                            <div class="d-flex justify-content-between py-2" id="delivery-fee" style="display: none;">
                                <p class="mb-0">Delivery</p>
                                <p class="mb-0">12.00 €</p>
                            </div>
                            <div class="d-flex justify-content-between py-2 font-weight-bold">
                                <h5>Total</h5>
                                <h5 id="total-amount">{{ number_format($totalAmount, 2) }}€</h5>
                            </div>

                            <p id="confirm-info-label" class="mt-3">Provide and confirm your information before placing order😊.</p>
                            <button class="btn btn-primary w-100 mt-3" id="place-order" type="button">Place Order</button>
                        </div>
                    </div>
                </div>

                <!-- Delivery Method Section -->
                <div class="row mt-5">
                    <div class="col-12">
                        <h3>Delivery Method</h3>
                        <p class="text-muted">Select your delivery method</p>
                        <div class="delivery-methods d-flex flex-wrap gap-3 mb-4">
                            <button type="button" class="btn btn-outline-secondary delivery-btn" data-method="self_pickup">
                                <span class="check-box"></span>
                                Self Pickup
                            </button>
                            <button type="button" class="btn btn-outline-secondary delivery-btn" data-method="courier">
                                <span class="check-box"></span>
                                By Courier
                            </button>
                        </div>
                        <p id="courier-fee" class="text-muted" style="display: none;">+10 euro to courier</p>
                        <input type="hidden" name="delivery_method" id="selected_delivery_method" value="">
                        <span class="error" id="delivery_method_error"></span>
                    </div>
                </div>

                <!-- Payment Section -->
                <div class="row mt-5">
                    <div class="col-12">
                        <h3>Payment</h3>
                        <p class="text-muted">Select your payment method</p>
                        <div class="payment-methods d-flex flex-wrap gap-3 mb-4">
                            <button type="button" class="btn btn-outline-secondary payment-btn" data-method="paypal">
                                <span class="check-box"></span>
                                PayPal
                            </button>
                            <button type="button" class="btn btn-outline-secondary payment-btn" data-method="card">
                                <span class="check-box"></span>
                                Debit or credit card
                            </button>
                            <button type="button" class="btn btn-outline-secondary payment-btn" data-method="after_delivery">
                                <span class="check-box"></span>
                                Cash after delivery
                            </button>
                        </div>

                        <!-- Card details section (hidden by default) -->
                        <div class="card-details" style="display: none;">
                            <h4>Card Details</h4>
                            <p class="text-muted required-text">*Required fields</p>
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Cardholder name *" name="card_name" id="card_name">
                                <span class="error" id="card_name_error"></span>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Card number *" name="card_number" id="card_number">
                                    <span class="error" id="card_number_error"></span>
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control" placeholder="Expiration date * (MM/YY)" name="card_expiry" id="card_expiry">
                                    <span class="error" id="card_expiry_error"></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Security code *" name="card_cvv" id="card_cvv">
                                <span class="error" id="card_cvv_error"></span>
                            </div>
                        </div>

                        <button class="btn btn-dark w-100 mt-3" type="button" id="confirm-payment">Confirm Payment Method</button>
                    </div>
                </div>
            </div>
        </section>
    </form>

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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const paymentButtons = document.querySelectorAll('.payment-btn');
            const deliveryButtons = document.querySelectorAll('.delivery-btn');
            const cardDetails = document.querySelector('.card-details');
            const deliveryFee = document.getElementById('delivery-fee');
            const courierFee = document.getElementById('courier-fee');
            const totalAmount = document.getElementById('total-amount');
            const placeOrderBtn = document.getElementById('place-order');
            const confirmPaymentBtn = document.getElementById('confirm-payment');
            const confirmInfoLabel = document.getElementById('confirm-info-label');
            const form = document.getElementById('checkout-form');
            let selectedMethod = null;
            let selectedDelivery = null;
            let baseTotal = {{ $totalAmount }};

            // Clear error messages
            function clearErrors() {
                document.querySelectorAll('.error').forEach(error => error.textContent = '');
            }

            // Validate required fields
            function validateFields() {
                clearErrors();
                let isValid = true;

                // Required fields for all cases
                const requiredFields = [
                    { id: 'customer_name', message: 'Full Name is required' },
                    { id: 'email', message: 'Email is required' },
                    { id: 'country', message: 'Country is required' },
                    { id: 'city', message: 'City is required' },
                    { id: 'address', message: 'Address is required' },
                    { id: 'phone', message: 'Phone is required' }
                ];

                requiredFields.forEach(field => {
                    const input = document.getElementById(field.id);
                    if (!input.value.trim()) {
                        document.getElementById(`${field.id}_error`).textContent = field.message;
                        isValid = false;
                    }
                });

                // Validate delivery method
                if (!selectedDelivery) {
                    document.getElementById('delivery_method_error').textContent = 'Please select a delivery method';
                    isValid = false;
                }

                // Validate payment method
                if (!selectedMethod) {
                    alert('Please select a payment method');
                    isValid = false;
                }

                // Validate card details if payment method is 'card'
                if (selectedMethod === 'card') {
                    const cardFields = [
                        { id: 'card_name', message: 'Cardholder name is required' },
                        { id: 'card_number', message: 'Card number is required' },
                        { id: 'card_expiry', message: 'Expiration date is required' },
                        { id: 'card_cvv', message: 'Security code is required' }
                    ];

                    cardFields.forEach(field => {
                        const input = document.getElementById(field.id);
                        if (!input.value.trim()) {
                            document.getElementById(`${field.id}_error`).textContent = field.message;
                            isValid = false;
                        }
                    });
                }

                return isValid;
            }

            // Handle delivery method selection
            deliveryButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();
                    const method = button.getAttribute('data-method');
                    
                    deliveryButtons.forEach(btn => btn.classList.remove('selected'));
                    button.classList.add('selected');
                    selectedDelivery = method;
                    
                    document.getElementById('selected_delivery_method').value = method;
                    
                    deliveryFee.style.display = method === 'courier' ? 'block' : 'none';
                    courierFee.style.display = method === 'courier' ? 'block' : 'none';
                    
                    updateTotalAmount();
                });
            });

            // Function to update total amount based on delivery method
            function updateTotalAmount() {
                let finalTotal = baseTotal;
                
                if (selectedDelivery === 'courier') {
                    finalTotal += 10.00;
                }
                
                totalAmount.textContent = `${finalTotal.toFixed(2)}€`;
            }

            // Handle payment method selection
            paymentButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();
                    const method = button.getAttribute('data-method');
                    
                    paymentButtons.forEach(btn => btn.classList.remove('selected'));
                    button.classList.add('selected');
                    selectedMethod = method;
                    
                    document.getElementById('selected_payment_method').value = method;
                    
                    cardDetails.style.display = method === 'card' ? 'block' : 'none';
                    
                    // Set required attribute for card fields
                    const cardInputs = ['card_name', 'card_number', 'card_expiry', 'card_cvv'];
                    cardInputs.forEach(id => {
                        const input = document.getElementById(id);
                        input.required = method === 'card';
                    });
                    
                    updateTotalAmount();
                });
            });

            // Handle confirm payment button click
            confirmPaymentBtn.addEventListener('click', function(e) {
                e.preventDefault();
                
                if (!validateFields()) {
                    return;
                }

                // Send AJAX request to confirm payment
                const formData = new FormData(form);
                fetch('{{ route("checkout.confirm") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        placeOrderBtn.style.display = 'block';
                        confirmInfoLabel.style.display = 'none'; // Hide the label
                        alert(data.message); // Or use a better notification
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    } else {
                        // Display backend validation errors
                        if (data.errors) {
                            Object.keys(data.errors).forEach(key => {
                                const errorElement = document.getElementById(`${key}_error`);
                                if (errorElement) {
                                    errorElement.textContent = data.errors[key][0];
                                }
                            });
                        }
                        alert(data.message || 'Please correct the errors in the form');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while processing your request');
                });
            });

            // Handle place order button click
            placeOrderBtn.addEventListener('click', function(e) {
                e.preventDefault();
                
                const formData = new FormData(form);
                fetch('{{ route("checkout.place") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const successMessage = document.createElement('div');
                        successMessage.className = 'alert alert-success mt-3';
                        successMessage.textContent = 'Thank you for your order!';
                        document.querySelector('.container').prepend(successMessage);
                        
                        setTimeout(() => {
                            window.location.href = '{{ route("profile") }}';
                        }, 2000);
                    } else {
                        alert(data.message || 'An error occurred while placing your order');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while processing your request');
                });
            });
        });
    </script>
</body>
</html>