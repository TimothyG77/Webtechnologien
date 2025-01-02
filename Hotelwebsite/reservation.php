<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session only if it hasn't been started already
}

$reservation_form_data = $_SESSION['reservation_form_data'] ?? []; // Retrieve the stored form data if available
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Reservations</title>
    <!-- Bootstrap CSS -->
    <?php include('link.php'); ?>
</head>
<body class="reservation-background">
<?php include('header.php'); ?>

<div class="container mt-5">
    <div class="title-box">
        <h2 class="impressum-text-center">Room Reservations</h2>
    </div>

    <!-- Display error message if the error parameter is set -->
    <?php
    if (isset($_GET['error']) && $_GET['error'] == 'checkin_checkout') {
        echo '<div class="alert alert-danger" role="alert">';
        echo 'Check-out date must be later than check-in date.';
        echo '</div>';
    }
    if (isset($_GET['error']) && $_GET['error'] == 'availability') {
        echo '<div class="alert alert-danger" role="alert">';
        echo 'No Room available in selected time period';
        echo '</div>';
    }
    ?>

    <!-- Form for new reservations -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>New Reservation</h5>
        </div>
        <div class="card-body">
            <form action="/Webtechnologien/Hotelwebsite/form/reservation-form.php" method="POST">
                <!-- Check-in and Check-out dates -->
                <div class="mb-3">
                    <label for="check_in" class="form-label">Check-in Date</label>
                    <input type="date" class="form-control" id="check_in" name="check_in" 
                           value="<?php echo htmlspecialchars($reservation_form_data['check_in'] ?? ''); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="check_out" class="form-label">Check-out Date</label>
                    <input type="date" class="form-control" id="check_out" name="check_out" 
                           value="<?php echo htmlspecialchars($reservation_form_data['check_out'] ?? ''); ?>" required>
                </div>

                <!-- Breakfast and Parking options -->
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="breakfast" name="breakfast" value="yes"
                           <?php echo isset($reservation_form_data['breakfast']) && $reservation_form_data['breakfast'] === 'yes' ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="breakfast">Breakfast</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="parking" name="parking" value="yes"
                           <?php echo isset($reservation_form_data['parking']) && $reservation_form_data['parking'] === 'yes' ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="parking">Parking</label>
                </div>

                <!-- Pets -->
                <div class="mb-3">
                    <label for="pets" class="form-label">Pets</label>
                    <input type="text" class="form-control" id="pets" name="pets" 
                           value="<?php echo htmlspecialchars($reservation_form_data['pets'] ?? ''); ?>" placeholder="Specify pets (if any)">
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary">Submit Reservation</button>
            </form>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
<?php include('script.php'); ?>
</body>
</html>
