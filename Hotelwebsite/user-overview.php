<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

require_once('form/dbaccess.php');
$db_obj = new mysqli($host, $user, $dbpassword, $database);

if ($db_obj->connect_error) {
    die("Connection failed: " . $db_obj->connect_error);
}

// Alle Benutzer abrufen
$sql = "SELECT * FROM users;
";
$result = $db_obj->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User-Overview</title>
</head>
<body>
<?php include('header.php'); ?>

<div class="container mt-5 ">
    <div class="p-4 border rounded bg-light mb-4">
        <h1>All Users</h1>
    </div>

    <div class = "d-flex justify-content-center">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Salutation</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Email</th>
                <th>Username</th>
                <th>Role</th>
                <th>Status</th>
                <th>Actions</th>
                <th>Reservations</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            //gives an overview with all users and shows all attributes + an edit button and a button to see all reservations from the user
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['id']) . '</td>';
                echo '<td>' . htmlspecialchars($row['salutation']) . '</td>';
                echo '<td>' . htmlspecialchars($row['firstname']) . '</td>';
                echo '<td>' . htmlspecialchars($row['lastname']) . '</td>';
                echo '<td>' . htmlspecialchars($row['useremail']) . '</td>';
                echo '<td>' . htmlspecialchars($row['username']) . '</td>';
                echo '<td>' . htmlspecialchars($row['role']) . '</td>';
                echo '<td>' . htmlspecialchars($row['status']) . '</td>';
                echo '<td>';
                echo '<a href="edit-user.php?id=' . $row['id'] . '" class="btn btn-primary btn-sm">Edit</a>';
                echo '</td>';
                echo '<td>';
                echo '<a href="user-reservations.php?id=' . $row['id'] . '" class="btn btn-primary btn-sm">Reservations</a>';
                echo '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="10" class="text-center">No users found.</td></tr>';
        }
        ?>
        </tbody>
    </table>
    </div>

    
</div>

<?php include('footer.php'); ?>
</body>
</html>
