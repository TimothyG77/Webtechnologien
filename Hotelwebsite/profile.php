<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Access restriction: Only logged-in users can view this page
if (!isset($_SESSION['username'])) {
    header("Location: login.php?error=not_logged_in");
    exit();
}

// Fetch user data
$username = $_SESSION['username'];
$user_file = 'user.csv';
$user_data = [];

if (file_exists($user_file)) {
    $file_handle = fopen($user_file, 'r');
    $header = fgetcsv($file_handle); // Skip header

    while (($data = fgetcsv($file_handle)) !== false) {
        if (trim($data[0]) === $username) {
            $user_data = $data;
            break;
        }
    }
    fclose($file_handle);
}

// Assign fields from CSV data
$current_password = isset($user_data[1]) ? $user_data[1] : '';
$email = isset($user_data[5]) ? $user_data[5] : '';
$name = isset($user_data[3]) ? $user_data[3] : '';
$surname = isset($user_data[4]) ? $user_data[4] : '';
$salutation = isset($user_data[2]) ? $user_data[2] : '';

// Retrieve form data from session if available
$profile_form_data = $_SESSION['profile_form_data'] ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css-stylesheet-bootstrap.css">
</head>
<body>
<?php include('header.php'); ?>

<div class="container mt-5">
    <h2>Profile</h2>
    <p>Welcome, <strong><?= htmlspecialchars($username); ?></strong>!</p>

    <!-- Display error messages -->
    <?php
    if (isset($_GET['error'])) {
        $error_message = '';
        switch ($_GET['error']) {
            case 'wrong_password':
                $error_message = 'Incorrect current password. Please try again.';
                break;
            case 'invalid_password':
                $error_message = 'New password must be at least 8 characters long, include at least one number, and one special character.';
                break;
            case 'invalid_email':
                $error_message = 'Please enter a valid email address.';
                break;
            case 'user_not_found':
                $error_message = 'User not found.';
                break;
        }
        if (!empty($error_message)) {
            echo '<div class="alert alert-danger">' . htmlspecialchars($error_message) . '</div>';
        }
    }
    ?>

    <!-- Profile Details -->
    <form action="profile_update.php" method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username"
                   value="<?php echo htmlspecialchars($profile_form_data['username'] ?? $username); ?>" required>
        </div>
        <div class="mb-3">
            <label for="salutation" class="form-label">Salutation</label>
            <select id="salutation" name="salutation" class="form-control">
                <option value="Mr" <?php if (($profile_form_data['salutation'] ?? $salutation) == 'Mr') echo 'selected'; ?>>Mr</option>
                <option value="Mrs" <?php if (($profile_form_data['salutation'] ?? $salutation) == 'Mrs') echo 'selected'; ?>>Mrs</option>
                <option value="Ms" <?php if (($profile_form_data['salutation'] ?? $salutation) == 'Ms') echo 'selected'; ?>>Ms</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="name" name="name"
                   value="<?php echo htmlspecialchars($profile_form_data['name'] ?? $name); ?>" required>
        </div>
        <div class="mb-3">
            <label for="surname" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="surname" name="surname"
                   value="<?php echo htmlspecialchars($profile_form_data['surname'] ?? $surname); ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email"
                   value="<?php echo htmlspecialchars($profile_form_data['email'] ?? $email); ?>" required>
        </div>
        <div class="mb-3">
            <label for="current_password" class="form-label">Current Password</label>
            <input type="password" class="form-control" id="current_password" name="current_password" required>
        </div>
        <div class="mb-3">
            <label for="new_password" class="form-label">New Password (optional)</label>
            <input type="password" class="form-control" id="new_password" name="new_password">
        </div>
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>

<?php include('footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
