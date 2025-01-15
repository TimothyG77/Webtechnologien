<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Access restriction: Only logged-in users can view this page
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
$profile_salutation;
$profile_firstname;
$profile_lastname;
$profile_email;
$profile_username;
$current_password;

require_once'form/dbaccess.php';
$db_obj = new mysqli($host, $user, $dbpassword, $database);

if ($db_obj->connect_error) {
    echo "Connection Error: " . $db_obj -> connect_error;
    exit();
}else{
    $sql = "SELECT * FROM users";
    $result = $db_obj -> query($sql);
    $user_found = false;

    while ($row = $result->fetch_array()) { 

        if ($row['username'] === $_SESSION['username']) {
            $profile_salutation = $row['salutation'];
            $profile_firstname = $row['firstname'];
            $profile_lastname = $row['lastname'];
            $profile_email = $row['useremail'];
            $profile_username = $row['username'];
            $current_password = $row['password'];
            break;
        }
    }
}



// Retrieve form data from session if available
$profile_form_data = $_SESSION['profile_form_data'] ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
<?php include('header.php'); 
if ( isset($_GET['update']) && $_GET['update'] == 'success') {
    echo "<div class='alert alert-success mt-3' role='alert'>Registration was successful.</div>";
    unset($_SESSION['registration_success']);
}
?>


<div class="container mt-5">
    <h2>Profile</h2>
    <p>Welcome, <strong><?= htmlspecialchars($profile_username); ?></strong>!</p>

    <!-- error messages -->
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
            case 'user_exists':
                $error_message = 'Username already exists.';
                break;
        }
        if (!empty($error_message)) {
            echo '<div class="alert alert-danger">' . htmlspecialchars($error_message) . '</div>';
        }
    }
    ?>

    
    <form action="profile_update.php" method="POST">
        <!-- Username -->
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username"
                   value="<?php echo htmlspecialchars($profile_username); ?>" required>
        </div>
        <!-- Salutation -->
        <div class="mb-3">
            <label for="salutation" class="form-label">Salutation</label>
            <select id="salutation" name="salutation" class="form-control">
                <option value="Mr" <?php if ($profile_salutation == 'Mr') echo 'selected'; ?>>Mr</option>
                <option value="Mrs" <?php if ($profile_salutation == 'Mrs') echo 'selected'; ?>>Mrs</option>
                <option value="Divers" <?php if ($profile_salutation == 'Divers') echo 'selected'; ?>>Divers</option>
            </select>
        </div>
        <!-- First Name -->
        <div class="mb-3">
            <label for="name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="name" name="name"
                   value="<?php echo htmlspecialchars($profile_firstname); ?>" required>
        </div>
        <!-- Last Name -->
        <div class="mb-3">
            <label for="surname" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="surname" name="surname"
                   value="<?php echo htmlspecialchars($profile_lastname); ?>" required>
        </div>
        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email"
                   value="<?php echo htmlspecialchars($profile_email); ?>" required>
        </div>
        <!-- current password -->
        <div class="mb-3">
            <label for="current_password" class="form-label">Current Password</label>
            <input type="password" class="form-control" id="current_password" name="current_password" required>
        </div>
        <!-- new password -->
        <div class="mb-3">
            <label for="new_password" class="form-label">New Password (optional)</label>
            <input type="password" class="form-control" id="new_password" name="new_password">
        </div>
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>

<?php include('footer.php'); ?>
</body>
</html>
