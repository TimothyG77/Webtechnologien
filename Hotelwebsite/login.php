<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
 // Start the session
$login_username = $_SESSION['login_username'] ?? ''; // Retrieve the stored username if available
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <?php include('link.php'); ?>
</head>                       
<body class="login-background">
<?php include('header.php'); ?>
<div class="container mt-5">
    <!-- Display error message -->
    <?php
    if (isset($_GET['error']) && $_GET['error'] === 'invalid_credentials') {
        echo '<div class="alert alert-danger" role="alert">';
        echo 'Invalid username or password.';
        echo '</div>';
    }
    if (isset($_GET['error']) && $_GET['error'] === 'inactive_account') {
        echo '<div class="alert alert-danger" role="alert">';
        echo 'Your account is inactive. Please contact the administrator.';
        echo '</div>';                                            
    }
    ?>

    <form action="/Webtechnologien/Hotelwebsite/form/login-form.php" method="POST" class="p-4 border rounded bg-light">
        <h2 class="form-title-login">Login</h2>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($_SESSION['login_username']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
<?php include('footer.php'); ?>
<?php include('script.php'); ?>
</body>
</html>
