<!-- inc/header.php -->
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<header class="bg-primary text-white text-center p-4">
    <h1>GD Hotel</h1>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/Webtechnologien/Hotelwebsite/home.php">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="/Webtechnologien/Hotelwebsite/home.php">Home</a></li>
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
