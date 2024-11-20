<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
 // Start the session
$form_data = $_SESSION['form_data'] ?? []; // Retrieve the stored form data if available
?>
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

    <!-- Display success or error messages -->
    <?php 
    if (isset($_GET['success']) && $_GET['success'] == 1) {
        echo '<div class="alert alert-success" role="alert">';
        echo 'Registration was successful!';
        echo '</div>';
    }

    if (isset($_GET['error'])) {
        $error_message = '';
        switch ($_GET['error']) {
            case 'password_error':
                $error_message = 'Password is incorrect. Try again.';
                break;
            case 'email_error':
                $error_message = 'Please enter a valid email address.';
                break;
            case 'password_symbols_error':
                $error_message = 'The password must be at least 8 characters long, contain at least one number, and one special character.';
                break;
            case 'user_exists_error':
                $error_message = 'The username is already taken. Please choose a different one.';
                break;
        }
        echo '<div class="alert alert-danger" role="alert">' . $error_message . '</div>';
    }
    ?>

    <form action="/Webtechnologien/Hotelwebsite/form/register-form.php" method="POST" class="p-4 border rounded bg-light">
        <!-- Salutation -->
        <div class="mb-3">
            <label for="salutation" class="form-label">Salutation</label>
            <select id="salutation" name="salutation" class="form-control">
                <option value="Mr" <?php if (($form_data['salutation'] ?? '') == 'Mr') echo 'selected'; ?>>Mr</option>
                <option value="Mrs" <?php if (($form_data['salutation'] ?? '') == 'Mrs') echo 'selected'; ?>>Mrs</option>
                <option value="Ms" <?php if (($form_data['salutation'] ?? '') == 'Ms') echo 'selected'; ?>>Ms</option>
            </select>
        </div>
        <!-- First Name -->
        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo htmlspecialchars($form_data['first_name'] ?? ''); ?>" required>
        </div>
        <!-- Last Name -->
        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo htmlspecialchars($form_data['last_name'] ?? ''); ?>" required>
        </div>
        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($form_data['email'] ?? ''); ?>" required>
        </div>
        <!-- Username -->
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($form_data['username'] ?? ''); ?>" required>
        </div>
        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <!-- Confirm Password -->
        <div class="mb-3">
            <label for="confirm_password" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>
</body>
</html>
