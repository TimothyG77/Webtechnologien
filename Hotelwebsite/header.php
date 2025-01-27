<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); 
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="css-stylesheet-bootstrap.css">


<header class="bg-primary text-white text-center p-4">
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <a href="/Webtechnologien/Hotelwebsite/index.php" class="icon-link" title="GD Hotel Home">
                <img src="images/Home-Button-Icon.jpg" alt="GD Logo" class="icon-img">
            </a>
            <h1 class="mb-0">GD Hotel</h1>
        </div>
        <div class="icon-container d-flex justify-content-center mb-2">
            <a href="https://www.instagram.com/accounts/login/" target="_blank" class="icon-link mx-3" title="Instagram">
                <img src="images/Instagram Icon.webp" alt="Instagram" class="icon-img">
            </a>
            <a href="https://www.facebook.com" target="_blank" class="icon-link mx-3" title="Facebook">
                <img src="images/Facebook-Logo.png" alt="Facebook" class="icon-img">
            </a>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/Webtechnologien/Hotelwebsite/index.php">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    
                    <?php if (isset($_SESSION['username'])): ?>
                        <!-- logged in user -->
                        <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                        <li class="nav-item"><a class="nav-link" href="reservation.php">Reservation</a></li>
                        <?php if (isset($_SESSION['username']) && $_SESSION['role'] === 'admin'): ?>
                            <!-- logged in admin -->
                            <li class="nav-item"><a class="nav-link" href="user-overview.php">User-Overview</a></li>
                            <li class="nav-item"><a class="nav-link" href="reservations-overview-admin.php">Reservation-Overview</a></li>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['username']) && $_SESSION['role'] === 'user'): ?>
                            <li class="nav-item"><a class="nav-link" href="user-reservations.php">My Reservations</a></li>
                        <?php endif; ?>
                        
                    <?php else: ?>
                        <!-- not logged in -->
                        <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
                        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a class="nav-link" href="hilfe.php">Help/FAQ</a></li>
                    <li class="nav-item"><a class="nav-link" href="newsletter.php">Newsletter</a></li>
                    <li class="nav-item"><a class="nav-link" href="impressum.php">Imprint</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

