<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Aroma UA - Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Imperial+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/checkout-styles.css') }}">
</head>
<body>
    <!-- Header (unchanged) -->
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

    <!-- Checkout Section -->
    <section class="checkout-section py-5">
        <div class="container">
            <div class="row">
                <!-- Delivery Address -->
                <div class="col-md-6 mb-4">
                    <h3>Delivery Address</h3>
                    <p class="text-muted">Add your delivery address</p>
                    <p class="required-text">*Required fields</p>
                    <form>
                        <div class="row mb-3">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="First name *" required>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Last name *" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <select class="form-control" required>
                                <option value="Slovakia (EUR €)">Slovakia (EUR €)</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Address *" required>
                        </div>
        
                        <div class="row mb-3">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="City *" required>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="State">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Postal or zip code *" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <select class="form-control phone-code" required>
                                    <option value="+421">+421</option>
                                    <!-- Add more country codes as needed -->
                                </select>
                                <input type="tel" class="form-control" placeholder="Phone *" required>
                            </div>
                        </div>
                        <p class="text-muted small">Just in case we need to contact you about your order</p>
                    </form>
                </div>

                <!-- Summary -->
                <div class="col-md-6">
                    <div class="summary-card p-4">
                        <h3 class="d-flex justify-content-between align-items-center">
                            <span>Summary</span>
                            <a href="#" class="cancel-link">Cancel</a>
                        </h3>
                        <div class="cart-item d-flex align-items-center border-bottom py-3">
                            <img src="https://via.placeholder.com/50" alt="Miu Miu" class="item-image me-3">
                            <div class="flex-grow-1">
                                <p class="mb-0">Miu Miu</p>
                            </div>
                            <p class="mb-0">3,800.00 €</p>
                        </div>
                        <div class="d-flex justify-content-between py-2">
                            <p class="mb-0">Delivery</p>
                            <p class="mb-0">12.00 €</p>
                        </div>
                        <div class="d-flex justify-content-between py-2 font-weight-bold">
                            <h5>Total</h5>
                            <h5 id="total-amount">EUR 3,812.00 €</h5>
                        </div>
                       
                       
                        <button class="btn btn-primary w-100 mt-3" id="place-order">Place Order</button>

                    </div>
                </div>
            </div>

            <!-- Payment Section -->
            <div class="row mt-5">
                <div class="col-12">
                    <h3>Payment</h3>
                    <p class="text-muted">Select your payment method</p>
                    <div class="payment-methods d-flex flex-wrap gap-3 mb-4">
                        <button class="btn btn-outline-secondary payment-btn" data-method="paypal">
                            <span class="check-box"></span>
                            PayPal
                        </button>
                        <button class="btn btn-outline-secondary payment-btn" data-method="card">
                            <span class="check-box"></span>
                            Debit or credit card
                        </button>
                        <button class="btn btn-outline-secondary payment-btn" data-method="crypto">
                            <span class="check-box"></span>
                            Cash after delivery
                        </button>
                    </div>
                    <div class="card-details" style="display: none;">
                        <h4>Card Details</h4>
                        <p class="text-muted required-text">*Required fields</p>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Cardholder name *" required>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Card number *" required>
                            </div>
                            <div class="col-4">
                                <input type="text" class="form-control" placeholder="Expiration date * (MM/YY)" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Security code *" required>
                        </div>
                    </div>
                    <p id="crypto-fee" class="text-muted" style="display: none;">+5 euro to curier</p>
                    <button class="btn btn-dark w-100 mt-3" id="confirm-payment">Confirm Payment Method</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer (unchanged) -->
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
        // Handle payment method selection with toggle functionality
        const paymentButtons = document.querySelectorAll('.payment-btn');
        const cardDetails = document.querySelector('.card-details');
        const cryptoFee = document.getElementById('crypto-fee');
        const totalAmount = document.getElementById('total-amount');
        const placeOrderBtn = document.getElementById('place-order');
        const successMessage = document.getElementById('success-message');
        let selectedMethod = null;
        let baseTotal = 3812.00; // Base total from the summary

        paymentButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault(); // Prevent any default button behavior
                const method = button.getAttribute('data-method');

                if (button.classList.contains('selected')) {
                    // If the button is already selected, deselect it
                    button.classList.remove('selected');
                    selectedMethod = null;
                    cardDetails.style.display = 'none';
                    cryptoFee.style.display = 'none';
                    totalAmount.textContent = `EUR ${baseTotal.toFixed(2)} €`;
                } else {
                    // Deselect all buttons
                    paymentButtons.forEach(btn => btn.classList.remove('selected'));
                    // Select the clicked button
                    button.classList.add('selected');
                    selectedMethod = method;
                    // Show card details only for "card" method
                    if (method === 'card') {
                        cardDetails.style.display = 'block';
                        cryptoFee.style.display = 'none';
                        totalAmount.textContent = `EUR ${baseTotal.toFixed(2)} €`;
                    } else if (method === 'crypto') {
                        cardDetails.style.display = 'none';
                        cryptoFee.style.display = 'block';
                        totalAmount.textContent = `EUR ${(baseTotal + 5).toFixed(2)} €`;
                    } else {
                        cardDetails.style.display = 'none';
                        cryptoFee.style.display = 'none';
                        totalAmount.textContent = `EUR ${baseTotal.toFixed(2)} €`;
                    }
                }
            });
        });

        // Handle place order button click
        placeOrderBtn.addEventListener('click', () => {
            if (selectedMethod) {
                successMessage.style.display = 'block';
                setTimeout(() => {
                    successMessage.style.display = 'none';
                }, 3000); // Hide after 3 seconds
            } else {
                alert('Please select a payment method before placing the order.');
            }
        });

        // Handle confirm payment button click
        document.getElementById('confirm-payment').addEventListener('click', () => {
            if (selectedMethod === 'paypal') {
                // Redirect to PayPal if PayPal is selected
                window.location.href = 'https://www.paypal.com/webscr?cmd=_express-checkout&useraction=commit&token=EC-75P67595JC219753E';
            } else if (selectedMethod === 'card') {
                // For now, just alert (future implementation could process card details)
                alert('Card payment processing is not implemented yet.');
            } else if (selectedMethod === 'crypto') {
                alert('Cryptocurrency payment is not implemented yet.');
            } else {
                // Alert if no payment method is selected
                alert('Please select a payment method.');
            }
        });
    </script>
</body>
</html>