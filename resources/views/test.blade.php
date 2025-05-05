<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Aroma UA - Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Imperial+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/test-styles.css') }}">
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


<div class="progress-container">
    <div class="progress-bar" id="progressBar"></div>
</div>


<div class="test-container">
   
<div class="question-section">
    <h2>What type of scent do you prefer?</h2>
    <div class="options">
        <button class="option-btn">Floral</button>
        <button class="option-btn">Fruity</button>
        <button class="option-btn">Woody</button>
        <button class="option-btn">Fresh</button>
    </div>
    <div class="navigation">
        <a href="#" class="nav-link">Back</a>
        <a href="#question2" class="nav-link">Next</a>
    </div>
</div>


<div class="question-section" id="question2">
    <h2>How would you describe your personality?</h2>
    <div class="options">
        <button class="option-btn">Elegant and sophisticated</button>
        <button class="option-btn">Playful and energetic</button>
        <button class="option-btn">Calm and grounded</button>
        <button class="option-btn">Confident and bold</button>
    </div>
    <div class="navigation">
        <a href="#question1" class="nav-link">Back</a>
        <a href="#question3" class="nav-link">Next</a>
    </div>
</div>


<div class="question-section" id="question3">
    <h2>What’s your favorite time of day?</h2>
    <div class="options">
        <button class="option-btn">Morning</button>
        <button class="option-btn">Afternoon</button>
        <button class="option-btn">Evening</button>
        <button class="option-btn">Night</button>
    </div>
    <div class="navigation">
        <a href="#question2" class="nav-link">Back</a>
        <a href="#question4" class="nav-link">Next</a>
    </div>
</div>


<div class="question-section" id="question4">
    <h2>Which of these settings do you feel most comfortable in?</h2>
    <div class="options">
        <button class="option-btn">A formal dinner or event</button>
        <button class="option-btn">A day out with friends</button>
        <button class="option-btn">A cozy evening at home</button>
        <button class="option-btn">A night out on the town</button>
    </div>
    <div class="navigation">
        <a href="#question3" class="nav-link">Back</a>
        <a href="#question5" class="nav-link">Next</a>
    </div>
</div>


<div class="question-section" id="question5">
    <h2>How do you like to express yourself?</h2>
    <div class="options">
        <button class="option-btn">Through classic style</button>
        <button class="option-btn">Through vibrant colors and fun accessories</button>
        <button class="option-btn">Through simplicity and nature-inspired looks</button>
        <button class="option-btn">Through daring fashion choices and unique statements</button>
    </div>
    <div class="navigation">
        <a href="#question4" class="nav-link">Back</a>
        <a href="#" class="nav-link">Submit</a>
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
    window.addEventListener('scroll', function() {
        const winScroll = document.documentElement.scrollTop || document.body.scrollTop;
        const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrolled = (winScroll / height) * 100;
        document.getElementById('progressBar').style.height = scrolled + '%';
    });
</script>

</body>
</html>