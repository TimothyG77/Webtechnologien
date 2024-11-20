<?php
// PHP-Block am Anfang zur Überprüfung der Reservierungsdaten
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];

    if (strtotime($check_out) <= strtotime($check_in)) {
        // Umleitung zur aktuellen Seite mit Fehlermeldung
        header("Location: ../reservation.php?error=checkin_checkout");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Reservations</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css-stylesheet-bootstrap.css?v=<?php echo time(); ?>">
</head>
<body class="reservation-background">
<?php include('header.php'); ?>

<div class="container mt-5">
    <div class="title-box">
        <h2 class="impressum-text-center">Room Reservations</h2>
    </div>

    <!-- Fehlermeldung anzeigen, wenn der Fehler-Parameter gesetzt ist -->
    <?php
    if (isset($_GET['error']) && $_GET['error'] == 'checkin_checkout') {
        echo '<div class="alert alert-danger" role="alert">';
        echo 'Check-out date must be later than check-in date.';
        echo '</div>';
    }
    ?>
    
    <!-- Form für neue Reservierungen -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>New Reservation</h5>
        </div>
        <div class="card-body">
            <form action="/Webtechnologien/Hotelwebsite/form/reservation-form.php" method="POST">
                <!-- Anreise- und Abreisedatum -->
                <div class="mb-3">
                    <label for="check_in" class="form-label">Check-in Date</label>
                    <input type="date" class="form-control" id="check_in" name="check_in" required>
                </div>
                <div class="mb-3">
                    <label for="check_out" class="form-label">Check-out Date</label>
                    <input type="date" class="form-control" id="check_out" name="check_out" value="" required>
                </div>

                <!-- Frühstück -->
                <div class="mb-3">
                    <label for="breakfast" class="form-label">Breakfast</label>
                    <select class="form-select" id="breakfast" name="breakfast" required>
                        <option value="yes" <?php echo (isset($_POST['breakfast']) && $_POST['breakfast'] === 'yes') ? 'selected' : ''; ?>>With Breakfast</option>
                        <option value="no" <?php echo (isset($_POST['breakfast']) && $_POST['breakfast'] === 'no') ? 'selected' : ''; ?>>Without Breakfast</option>
                    </select>
                </div>

                <!-- Parkplatz -->
                <div class="mb-3">
                    <label for="parking" class="form-label">Parking</label>
                    <select class="form-select" id="parking" name="parking" required>
                        <option value="yes" <?php echo (isset($_POST['parking']) && $_POST['parking'] === 'yes') ? 'selected' : ''; ?>>With Parking</option>
                        <option value="no" <?php echo (isset($_POST['parking']) && $_POST['parking'] === 'no') ? 'selected' : ''; ?>>Without Parking</option>
                    </select>
                </div>

                <!-- Haustiere -->
                <div class="mb-3">
                    <label for="pets" class="form-label">Pets</label>
                    <input type="text" class="form-control" id="pets" name="pets" value="<?php echo isset($_POST["pets"]) ? $_POST["pets"] : ''; ?>" placeholder="Specify pets (if any)">
                </div>

                <!-- Abschicken -->
                <button type="submit" class="btn btn-primary">Submit Reservation</button>
            </form>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
