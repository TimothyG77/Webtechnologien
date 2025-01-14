<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}
$current_id;
$profile_salutation;
$profile_firstname;
$profile_lastname;
$profile_email;
$profile_username;
$current_password;
$role;
$status;

require_once('form/dbaccess.php');
$db_obj = new mysqli($host, $user, $dbpassword, $database);

if ($db_obj->connect_error) {
    echo "Connection Error: " . $db_obj -> connect_error;
    exit();
}else{
    $current_id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id = '$current_id'";
    $result = $db_obj -> query($sql);
    $user_found = false;

    while ($row = $result->fetch_array()) { 
        
        $profile_salutation = $row['salutation'];
        $profile_firstname = $row['firstname'];
        $profile_lastname = $row['lastname'];
        $profile_email = $row['useremail'];
        $profile_username = $row['username'];
        $current_password = $row['password'];
        $role = $row['role'];
        $status = $row['status'];
        break;
    
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
    <title>Edit User</title>
</head>
<body>
<?php include('header.php'); 
if ( isset($_GET['update']) && $_GET['update'] == 'success') {
    echo "<div class='alert alert-success mt-3' role='alert'>Update was successful.</div>";
}
?>


<div class="container mt-5">
    <h2>User</h2>
    <p><strong><?= htmlspecialchars($current_id); ?></strong></p>

    <!-- Display error messages -->
    <?php
    if (isset($_GET['error'])) {
        $error_message = '';
        switch ($_GET['error']) {
            case 'invalid_password':
                $error_message = 'New password must be at least 8 characters long, include at least one number, and one special character.';
                break;
            case 'invalid_email':
                $error_message = 'Please enter a valid email address.';
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

    <!-- Profile Details -->
    <form action="form/edit-user-form.php?id=<?php echo htmlspecialchars($current_id); ?>" method="POST">
        
    <!-- Username -->
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username"
                   value="<?php echo htmlspecialchars($profile_username); ?>" required>
        </div>
        <!-- Mr, Mrs, Divers -->
        <div class="mb-3">
            <label for="salutation" class="form-label">Salutation</label>
            <select id="salutation" name="salutation" class="form-control">
                <option value="Mr" <?php if ($profile_salutation == 'Mr') echo 'selected'; ?>>Mr</option>
                <option value="Mrs" <?php if ($profile_salutation == 'Mrs') echo 'selected'; ?>>Mrs</option>
                <option value="Divers" <?php if ($profile_salutation == 'Divers') echo 'selected'; ?>>Divers</option>
            </select>
        </div>
        <!-- First name -->
        <div class="mb-3">
            <label for="name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="name" name="name"
                   value="<?php echo htmlspecialchars($profile_firstname); ?>" required>
        </div>
        <!-- Last name -->
        <div class="mb-3">
            <label for="surname" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="surname" name="surname"
                   value="<?php echo htmlspecialchars($profile_lastname); ?>" required>
        </div>
        <!-- email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email"
                   value="<?php echo htmlspecialchars($profile_email); ?>" required>
        </div>
        <!-- role -->
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <input type="role" class="form-control" id="role" name="role"
                   value="<?php echo htmlspecialchars($role); ?>" required>
        </div>
        <!-- status -->
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select id="status" name="status" class="form-control">
                <option value="active"<?php if ($status == 'active') echo 'selected'; ?> >active</option>
                <option value="inactive" <?php if ($status == 'inactive') echo 'selected'; ?> >inactive</option>
                
            </select>
            
        </div>
        <!-- new password (if necessary)-->
        <div class="mb-3">
            <label for="new_password" class="form-label">New Password (if necessary)</label>
            <input type="password" class="form-control" id="new_password" name="new_password">
        </div>
        <button type="submit" class="btn btn-primary">Update user data</button>
    </form>
</div>

<?php include('footer.php'); ?>
</body>
</html>
