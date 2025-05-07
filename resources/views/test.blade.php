<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Aroma UA - Fragrance Quiz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Imperial+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/test-styles.css') }}">
    <style>
        .test-container { max-width: 800px; margin: 0 auto; padding: 20px; }
        .question-section { margin-bottom: 40px; }
        .question-section h2 { margin-bottom: 20px; }
        .options { display: flex; flex-direction: column; gap: 10px; }
        .option-label { display: block; padding: 10px; border: 1px solid #ddd; border-radius: 5px; cursor: pointer; }
        .option-label:hover { background-color: #f8f8f8; }
        .option-label input[type="radio"] { margin-right: 10px; }
        .option-label input[type="radio"]:checked + span { color: #d3a3a3; font-weight: bold; }
        .navigation { margin-top: 20px; display: flex; justify-content: center; }
        .progress-container { width: 5px; background: #f1f1f1; position: fixed; top: 0; bottom: 0; left: 0; }
        .progress-bar { background: #d3a3a3; width: 100%; height: 0; transition: height 0.3s; }
        .error-message { color: red; font-size: 0.9em; margin-top: 5px; }
    </style>
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
    <form id="quizForm" action="{{ route('quiz.submit') }}" method="POST">
        @csrf
        <input type="hidden" name="answers" id="answersInput">

        <div class="question-section" id="question1">
            <h2>What type of scent do you prefer?</h2>
            <div class="options">
                <label class="option-label">
                    <input type="radio" name="question1" value="ATLANTIC COAST" required>
                    <span>Atlantic Coast</span>
                </label>
                <label class="option-label">
                    <input type="radio" name="question1" value="LOST GARDEN">
                    <span>Lost Garden</span>
                </label>
                <label class="option-label">
                    <input type="radio" name="question1" value="GRASSLAND">
                    <span>Grassland</span>
                </label>
                <label class="option-label">
                    <input type="radio" name="question1" value="WOODLAND">
                    <span>Woodland</span>
                </label>
                <label class="option-label">
                    <input type="radio" name="question1" value="HERB GARDEN">
                    <span>Herb Garden</span>
                </label>
            </div>
            @error('question1')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="question-section" id="question2">
            <h2>How would you describe your personality?</h2>
            <div class="options">
                <label class="option-label">
                    <input type="radio" name="question2" value="Elegant and sophisticated" required>
                    <span>Elegant and sophisticated</span>
                </label>
                <label class="option-label">
                    <input type="radio" name="question2" value="Playful and energetic">
                    <span>Playful and energetic</span>
                </label>
                <label class="option-label">
                    <input type="radio" name="question2" value="Calm and grounded">
                    <span>Calm and grounded</span>
                </label>
                <label class="option-label">
                    <input type="radio" name="question2" value="Confident and bold">
                    <span>Confident and bold</span>
                </label>
                <label class="option-label">
                    <input type="radio" name="question2" value="Fresh and herbal">
                    <span>Fresh and herbal</span>
                </label>
            </div>
            @error('question2')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="question-section" id="question3">
            <h2>What’s your favorite time of day?</h2>
            <div class="options">
                <label class="option-label">
                    <input type="radio" name="question3" value="Morning" required>
                    <span>Morning</span>
                </label>
                <label class="option-label">
                    <input type="radio" name="question3" value="Afternoon">
                    <span>Afternoon</span>
                </label>
                <label class="option-label">
                    <input type="radio" name="question3" value="Evening">
                    <span>Evening</span>
                </label>
                <label class="option-label">
                    <input type="radio" name="question3" value="Night">
                    <span>Night</span>
                </label>
                <label class="option-label">
                    <input type="radio" name="question3" value="Anytime">
                    <span>Anytime</span>
                </label>
            </div>
            @error('question3')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="question-section" id="question4">
            <h2>Which of these settings do you feel most comfortable in?</h2>
            <div class="options">
                <label class="option-label">
                    <input type="radio" name="question4" value="A formal dinner or event" required>
                    <span>A formal dinner or event</span>
                </label>
                <label class="option-label">
                    <input type="radio" name="question4" value="A day out with friends">
                    <span>A day out with friends</span>
                </label>
                <label class="option-label">
                    <input type="radio" name="question4" value="A cozy evening at home">
                    <span>A cozy evening at home</span>
                </label>
                <label class="option-label">
                    <input type="radio" name="question4" value="A night out on the town">
                    <span>A night out on the town</span>
                </label>
                <label class="option-label">
                    <input type="radio" name="question4" value="A quiet garden retreat">
                    <span>A quiet garden retreat</span>
                </label>
            </div>
            @error('question4')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="question-section" id="question5">
            <h2>How do you like to express yourself?</h2>
            <div class="options">
                <label class="option-label">
                    <input type="radio" name="question5" value="Through classic style" required>
                    <span>Through classic style</span>
                </label>
                <label class="option-label">
                    <input type="radio" name="question5" value="Through vibrant colors and fun accessories">
                    <span>Through vibrant colors and fun accessories</span>
                </label>
                <label class="option-label">
                    <input type="radio" name="question5" value="Through simplicity and nature-inspired looks">
                    <span>Through simplicity and nature-inspired looks</span>
                </label>
                <label class="option-label">
                    <input type="radio" name="question5" value="Through daring fashion choices and unique statements">
                    <span>Through daring fashion choices and unique statements</span>
                </label>
                <label class="option-label">
                    <input type="radio" name="question5" value="Through fresh and natural scents">
                    <span>Through fresh and natural scents</span>
                </label>
            </div>
            @error('question5')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="navigation">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
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
    const quizForm = document.getElementById('quizForm');
    const answersInput = document.getElementById('answersInput');

    // Update progress bar on scroll
    window.addEventListener('scroll', () => {
        const winScroll = document.documentElement.scrollTop || document.body.scrollTop;
        const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrolled = (winScroll / height) * 100;
        document.getElementById('progressBar').style.height = scrolled + '%';
    });

    // Handle form submission
    quizForm.addEventListener('submit', (e) => {
        e.preventDefault();

        // Collect answers
        const answers = {};
        const questions = ['question1', 'question2', 'question3', 'question4', 'question5'];
        let allAnswered = true;

        questions.forEach(q => {
            const selected = quizForm.querySelector(`input[name="${q}"]:checked`);
            if (selected) {
                answers[q] = selected.value;
            } else {
                allAnswered = false;
            }
        });

        // Validate all questions are answered
        if (!allAnswered) {
            alert('Please answer all questions before submitting.');
            return;
        }

        // Serialize answers to JSON
        answersInput.value = JSON.stringify(answers);

        // Submit the form
        quizForm.submit();
    });
</script>
</body>
</html>