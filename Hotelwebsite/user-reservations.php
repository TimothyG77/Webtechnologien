<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['role']) ) {
    header("Location: index.php");
    exit();
}
require_once('form/dbaccess.php');

// Verbindung zur Datenbank herstellen
$db_obj = new mysqli($host, $user, $dbpassword, $database);

if ($db_obj->connect_error) {
    die("Connection failed: " . $db_obj->connect_error);
}
$current_user = $_SESSION['username'];


if($_SESSION['role'] === 'admin'){
    $user_id = $_GET['id'];
    $sql = "
    SELECT * 
    FROM reservation
    WHERE user_id = '$user_id';
";
}else{
    $current_user = $_SESSION['username'];
    $sql = "
    SELECT reservation.* 
    FROM reservation
    INNER JOIN users ON reservation.user_id = users.id
    WHERE users.username = '$current_user';
    "; 
}

$result = $db_obj->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservations-Overview</title>
    <!-- Bootstrap CSS -->
    <?php include('link.php'); ?>
</head>
<body>
<?php include('header.php'); ?>

<div class="container mt-5">
    <div class="p-4 border rounded bg-light mb-4">
        <h1>All Reservations</h1>
    </div>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>CheckInDate</th>
                <th>CheckOutDate</th>
                <th>Breakfast</th>
                <th>Parking</th>
                <th>Pets</th>
                <th>Creation date</th>
                <th>Status</th>
                <th>Price</th>
                

            </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_array()) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['CheckInDate']) . '</td>';
                echo '<td>' . htmlspecialchars($row['CheckOutDate']) . '</td>';
                echo '<td>' . htmlspecialchars($row['Breakfast']) . '</td>';
                echo '<td>' . htmlspecialchars($row['Parking']) . '</td>';
                echo '<td>' . htmlspecialchars($row['Pets']) . '</td>';
                echo '<td>' . htmlspecialchars($row['creation_date']) . '</td>';
                echo '<td>' . htmlspecialchars($row['status']) . '</td>';
                echo '<td>' . htmlspecialchars($row['price']) .'€'. '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="10" class="text-center">No Reservations found.</td></tr>';
        }
        ?>
        </tbody>
    </table>
</div>

<?php include('footer.php'); ?>
<?php include('script.php'); ?>
</body>
</html>
