<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>



<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GD Hotel - Startseite</title>
</head>
<body class="home-background">
    <?php include('header.php');
    //success messages for registration, reservation, login
    if (isset($_GET['registration_success']) && $_GET['registration_success']) {
        echo "<div class='alert alert-success mt-3' role='alert'>Registration was successful.</div>";
        unset($_SESSION['registration_success']);
    }
    if (isset($_GET['reservation_success']) && $_GET['reservation_success'] == '1') {
        echo "<div class='alert alert-success mt-3' role='alert'>Reservation was successful.</div>";
    }
    
    
    if (isset($_GET['login_success'])) {
        echo "<div class='alert alert-success mt-3' role='alert'>Login was successful.</div>";
    }
    ?>

    <div class="container">
        <div class="jumbotron text-center">
            <h1 class="introduction-display">Welcome to GD Hotel<?php if(isset($_SESSION['username'])){echo ', '.$_SESSION['username'];} ?></h1> <!-- displays current user -->
            <p class="introduction-lead-text">Your luxury stay in Vienna awaits you!</p>
        </div>
    </div>

     <!-- Bootstrap Carousel -->
     <div id="hotelCarousel" class="carousel slide mt-4" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/GD-Hotel_lobby.webp" class="d-block w-100" alt="GD-Hotel">
                </div>
                <div class="carousel-item">
                    <img src="images/GD-Hotel-Lobby.webp" class="d-block w-100" alt="Hotel Lobby">
                </div>
                <div class="carousel-item">
                    <img src="images/GD-Hotel-Lounge.webp" class="d-block w-100" alt="Hotel Lounge">
                </div>
                <div class="carousel-item">
                    <img src="images/GD-Hotel-Hotelsuite.webp" class="d-block w-100" alt="Hotelsuite">
                </div>
                <div class="carousel-item">
                    <img src="images/GD-Hotel-Restaurant.webp" class="d-block w-100" alt="Hotel Restaurant">
                </div>
                <div class="carousel-item">
                    <img src="images/GD-Hotel-Spa.webp" class="d-block w-100" alt="Hotel Spa">
                </div>
                <div class="carousel-item">
                    <img src="images/GD-Hotel-Pool.webp" class="d-block w-100" alt="Hotel Pool">
                </div>
                <div class="carousel-item">
                    <img src="images/GD-Hotel-Fitnesscenter.webp" class="d-block w-100" alt="Hotel Fitnesscenter">
                </div>
                <div class="carousel-item">
                    <img src="images/GD-Hotel-Stairs.webp" class="d-block w-100" alt="Hotel Stairs">
                </div>
                <div class="carousel-item">
                    <img src="images/GD-Hotel-Bar.webp" class="d-block w-100" alt="Hotel Bar">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#hotelCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#hotelCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

    <?php include('footer.php'); ?>

   
</body>
</html>
