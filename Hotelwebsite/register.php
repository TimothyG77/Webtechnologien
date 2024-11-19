<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css-stylesheet-bootstrap.css">
</head>
<body class="register-background">
<?php include('header.php'); ?>
<div class="container mt-5">

    <!-- Erfolgsmeldung anzeigen -->
    <?php 
    if (isset($_GET['success']) && $_GET['success'] == 1) {
        echo '<div class="alert alert-success" role="alert">';
        echo 'Registration was successful!';
        echo '</div>';
    }
    ?>

    <form action="/Webtechnologien/Hotelwebsite/form/register-form.php" method="POST" class="p-4 border rounded bg-light">
        <!-- Anrede -->
         <h2 class="form-title">Register</h2>
        <div class="mb-3">
            <label for="salutation" class="form-label">Salutation</label>
            <select class="form-select" id="salutation" name="salutation" required>
                <option value="">Please choose...</option>
                <option value="Herr" <?php echo (isset($form_data['salutation']) && $form_data['salutation'] === 'Herr') ? 'selected' : ''; ?>>Herr</option>
                <option value="Frau" <?php echo (isset($form_data['salutation']) && $form_data['salutation'] === 'Frau') ? 'selected' : ''; ?>>Frau</option>
                <option value="Divers" <?php echo (isset($form_data['salutation']) && $form_data['salutation'] === 'Divers') ? 'selected' : ''; ?>>Divers</option>
            </select>
        </div>

        <!-- Vorname -->
        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo htmlspecialchars($form_data['first_name'] ?? ''); ?>" required>
        </div>

        <!-- Nachname -->
        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo htmlspecialchars($form_data['last_name'] ?? ''); ?>" required>
        </div>

        <!-- E-Mail-Adresse -->
        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($form_data['email'] ?? ''); ?>" required>
        </div>

        <!-- Username -->
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($form_data['username'] ?? ''); ?>" required>
        </div>

        <!-- Passwort -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <!-- Passwort bestätigen -->
        <div class="mb-3">
            <label for="confirm_password" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>

        <!-- Abschicken -->
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>
<?php include('footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
