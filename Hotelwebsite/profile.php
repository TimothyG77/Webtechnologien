<?php
session_start();

// Zugriffsschutz: Nur eingeloggte Benutzer können auf die Seite zugreifen
if (!isset($_SESSION['username'])) {
    header("Location: login.php?error=not_logged_in");
    exit();
}

// Benutzername aus der Session abrufen
$username = $_SESSION['username'];

// Datei mit Benutzerdaten
$user_file = 'user.csv';
$user_data = [];

if (file_exists($user_file)) {
    $file_handle = fopen($user_file, 'r');

    // Header ignorieren
    $header = fgetcsv($file_handle);

    // Benutzerdaten suchen
    while (($data = fgetcsv($file_handle)) !== false) {
        if (trim($data[0]) === $username) {
            $user_data = $data;
            break;
        }
    }

    fclose($file_handle);
}

// Felder aus der CSV-Datei zuweisen
$current_password = isset($user_data[1]) ? $user_data[1] : ''; // Passwort (Index 1)
$email = isset($user_data[5]) ? $user_data[5] : '';           // E-Mail (Index 5)
$name = isset($user_data[3]) ? $user_data[3] : '';            // Name (Index 3)
$surname = isset($user_data[4]) ? $user_data[4] : '';         // Nachname (Index 4)
$salutation = isset($user_data[2]) ? $user_data[2] : '';      // Anrede (Index 2)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include('header.php'); ?>

<div class="container mt-5">
    <h2>Profile</h2>
    <p>Welcome, <strong><?= htmlspecialchars($username); ?></strong>!</p>

    <!-- Profil-Details -->
    <form action="profile_update.php" method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($username); ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="salutation" class="form-label">Salutation</label>
            <input type="text" class="form-control" id="salutation" name="salutation" value="<?= htmlspecialchars($salutation); ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($name); ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="surname" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="surname" name="surname" value="<?= htmlspecialchars($surname); ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($email); ?>" required>
        </div>
        <div class="mb-3">
            <label for="current_password" class="form-label">Current Password</label>
            <input type="password" class="form-control" id="current_password" name="current_password" required>
        </div>
        <div class="mb-3">
            <label for="new_password" class="form-label">New Password</label>
            <input type="password" class="form-control" id="new_password" name="new_password">
        </div>
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>

<?php include('footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
