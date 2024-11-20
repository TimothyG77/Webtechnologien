<?php
session_start();

if (isset($_SESSION['registration_success']) && $_SESSION['registration_success']) {
    echo "<div class='alert alert-success mt-3' role='alert'>Die Registrierung war erfolgreich.</div>";
    unset($_SESSION['registration_success']);
}

if (isset($_SESSION['reservation_success']) && $_SESSION['reservation_success']) {
    echo "<div class='alert alert-success mt-3' role='alert'>Die Reservierung war erfolgreich.</div>";
    unset($_SESSION['reservation_success']);
}
?>

<!-- Restlicher Inhalt von home.php -->
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GD Hotel - Startseite</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include('header.php'); ?>

    <div class="container">
        <div class="jumbotron text-center">
            <h1>Welcome to GD Hotel</h1>
            <p>Your luxury stay in Vienna awaits you!</p>
        </div>
    </div>

    <?php include('footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
