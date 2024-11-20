<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Reservations</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include('header.php'); ?>

<div class="container mt-5">
    <h2>Room Reservations</h2>

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

    <!-- Liste der bestehenden Reservierungen -->
    <div class="card">
        <div class="card-header">
            <h5>Your Reservations</h5>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Reservation ID</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Breakfast</th>
                        <th>Parking</th>
                        <th>Pets</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Statische Daten -->
                    <tr>
                        <td>1</td>
                        <td>2024-11-20</td>
                        <td>2024-11-25</td>
                        <td>Yes</td>
                        <td>No</td>
                        <td>Dog</td>
                        <td>Confirmed</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>2024-12-01</td>
                        <td>2024-12-05</td>
                        <td>No</td>
                        <td>Yes</td>
                        <td>None</td>
                        <td>New</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
