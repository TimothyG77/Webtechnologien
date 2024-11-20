
<header class="bg-primary text-white text-center p-4">
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <a href="/Webtechnologien/Hotelwebsite/home.php" class="icon-link" title="GD Hotel Home">
                <img src="images/Home-Button-Icon.jpg" alt="GD Logo" class="icon-img">
            </a>
            <h1 class="mb-0">GD Hotel</h1>
        </div>
        <div class="icon-container d-flex justify-content-center mb-2">
            <a href="https://www.instagram.com/accounts/login/" target="_blank" class="icon-link mx-3" title="Instagram">
                <img src="images/Instagram Icon.webp" alt="Instagram" class="icon-img">
            </a>
            <a href="https://www.instagram.com/accounts/login/" target="_blank" class="icon-link mx-3" title="Facebook">
                <img src="images/Facebook-Logo.png" alt="Facebook" class="icon-img">
            </a>
            <a href="/Webtechnologien/Hotelwebsite/impressum.php" class="icon-link mx-3" title="Impressum">
                <img src="images/Email Icon.png" alt="Mail" class="icon-img">
            </a>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/Webtechnologien/Hotelwebsite/home.php">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    
                    <?php if (isset($_SESSION['username'])): ?>
                        <!-- Eingeloggter Benutzer -->
                        <li class="nav-item"><a class="nav-link" href="/Webtechnologien/Hotelwebsite/profile.php">Profile</a></li>
                        <li class="nav-item"><a class="nav-link" href="/Webtechnologien/Hotelwebsite/logout.php">Logout</a></li>
                    <?php else: ?>
                        <!-- Nicht eingeloggt -->
                        <li class="nav-item"><a class="nav-link" href="/Webtechnologien/Hotelwebsite/register.php">Register</a></li>
                        <li class="nav-item"><a class="nav-link" href="/Webtechnologien/Hotelwebsite/login.php">Login</a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a class="nav-link" href="/Webtechnologien/Hotelwebsite/hilfe.php">Help/FAQ</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Webtechnologien/Hotelwebsite/newsletter.php">Newsletter</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Webtechnologien/Hotelwebsite/impressum.php">Impressum</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Webtechnologien/Hotelwebsite/reservation.php">Reservation</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

