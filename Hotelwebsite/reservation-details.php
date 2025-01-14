<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}



require_once('form/dbaccess.php');
$db_obj = new mysqli($host, $user, $dbpassword, $database);

if ($db_obj->connect_error) {
    echo "Connection Error: " . $db_obj -> connect_error;
    exit();
}else{
    $current_id = $_GET['id'];
    $sql = "SELECT * FROM reservation WHERE id = '$current_id'";
    $result = $db_obj -> query($sql);
    $user_found = false;

    while ($row = $result->fetch_array()) { 
        
        $check_in_date = $row['CheckInDate'];
        $check_out_date = $row['CheckOutDate'];
        $breakfast = $row['Breakfast'];
        $parking = $row['Parking'];
        $pets = $row['Pets'];
        $user_id = $row['user_id'];
        $creation_date = $row['creation_date'];
        $status = $row['status'];
        $price = $row['price'];
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
    <title>Reservation Details</title>
    <!-- Bootstrap CSS -->
    <?php include('link.php'); ?>
</head>
<body>
<?php include('header.php'); 
if ( isset($_GET['update']) && $_GET['update'] == 'success') {
    echo "<div class='alert alert-success mt-3' role='alert'>Update was successful.</div>";
}
?>


<div class="container mt-5">
    <h2>Reservation</h2>
    <p><strong><?= htmlspecialchars($current_id); ?></strong></p>

    <!-- Profile Details -->
    <form action="form/update-reservation.php?id=<?php echo htmlspecialchars($current_id); ?>" method="POST">
        
        <div class="mb-3">
            <label for="check-in-date" class="form-label">Check-In-Date</label>
            <input type="date" class="form-control" id="check-in-date" name="check-in-date"
                   value="<?php echo htmlspecialchars($check_in_date); ?>" required>
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Check-Out-Date</label>
            <input type="date" class="form-control" id="check-out-date" name="check-out-date"
                   value="<?php echo htmlspecialchars($check_out_date); ?>" required>
        </div>
        <div class="mb-3">
            <label for="breakfast" class="form-label">Breakfast</label>
            <select id="breakfast" name="breakfast" class="form-control">
                <option value="yes" <?php if ($breakfast == 'yes') echo 'selected'; ?>>yes</option>
                <option value="no" <?php if ($breakfast == 'no') echo 'selected'; ?>>no</option>
                
            </select>
        </div>
        <div class="mb-3">
            <label for="parking" class="form-label">Parking</label>
            <select id="parking" name="parking" class="form-control">
                <option value="yes" <?php if ($parking == 'yes') echo 'selected'; ?>>yes</option>
                <option value="no" <?php if ($parking == 'no') echo 'selected'; ?>>no</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="pets" class="form-label">Pets</label>
            <input type="text" class="form-control" id="pets" name="pets"
                   value="<?php echo htmlspecialchars($pets); ?>">
        </div>
        <div class="mb-3">
            <label for="user_id" class="form-label">User_ID</label>
            <input type="user_id" class="form-control" id="user_id" name="user_id"
                   value="<?php echo htmlspecialchars($user_id); ?>" required>
        </div>

        <div class="mb-3">
            <label for="creation_date" class="form-label">Creation Date</label>
            <input type="creation_date" class="form-control" id="creation_date" name="creation_date"
                   value="<?php echo htmlspecialchars($creation_date); ?>" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select id="status" name="status" class="form-control">
                <option value="new" <?php if ($status == 'new') echo 'selected'; ?>>new</option>
                <option value="confirmed" <?php if ($status == 'confirmed') echo 'selected'; ?>>confirmed</option>
                <option value="cancelled" <?php if ($status == 'cancelled') echo 'selected'; ?>>canceled</option>
                
            </select>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="price" class="form-control" id="price" name="price"
                   value="<?php echo htmlspecialchars($price).'€'; ?>" >
        </div>
        <button type="submit" class="btn btn-primary">Update reservation data</button>
    </form>
</div>

<?php include('footer.php'); ?>
</body>
</html>
