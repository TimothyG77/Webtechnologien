<!-- index.php -->
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GD Hotel - Startseite</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css-stylesheet-bootstrap.css">
</head>
<body class="home-background">
    <?php include('header.php'); ?>
    <?php
    if (isset($_GET['success']) && $_GET['success'] == 1) {
        echo '<div class="alert alert-success mt-3" role="alert">';
        echo 'Die Registrierung war erfolgreich!';
        echo '</div>';
    }
    ?>


    <div class="container">
        <div class="jumbotron text-center">
            <h1 class="introduction-display">Welcome to GD Hotel</h1>
            <p class="introduction-lead-text">Your luxury stay in Vienna awaits you!</p>
        </div>
    </div>

     <!-- Bootstrap Carousel -->
     <div id="hotelCarousel" class="carousel slide mt-4" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
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
                <div class="carousel-item">
                    <img src="images/GD-Hotel_lobby.webp" class="d-block w-100" alt="GD-Hotel">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
