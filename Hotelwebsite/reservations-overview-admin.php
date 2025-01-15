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
    echo "Connection Error: " . $db_obj->connect_error;
    exit();
}

// filter-logic
$status_filter = isset($_GET['status']) ? $_GET['status'] : 'all';

//standard is all as a filter
if ($status_filter === 'all') {
    $sql = "SELECT * FROM reservation ORDER BY status";
    $result = $db_obj->query($sql);
} else {
    //if filter is selected, it only filters the reservations with this filter in this sql-statement
    $sql = "SELECT * FROM reservation WHERE status = ?";
    $stmt = $db_obj->prepare($sql);
    $stmt->bind_param("s", $status_filter);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservations-Overview</title>
</head>
<body>
<?php include('header.php'); ?>

<div class="container mt-5">
    <div class="p-4 border rounded bg-light mb-4">
        <h1>Reservations Overview</h1>
        <form method="GET" action="">
            <div class="row">
                <div class="col-md-4">
                    <select name="status" class="form-select">
                        <option value="all" <?php echo $status_filter === 'all' ? 'selected' : ''; ?>>All</option>
                        <option value="new" <?php echo $status_filter === 'new' ? 'selected' : ''; ?>>New</option>
                        <option value="confirmed" <?php echo $status_filter === 'confirmed' ? 'selected' : ''; ?>>Confirmed</option>
                        <option value="cancelled" <?php echo $status_filter === 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
    </div>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Status</th>
                <th>Reservation Details</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            //this gives an overview with id, creation date, status and a button, if admin wants to see all details
            while ($row = $result->fetch_array()) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['id']) . '</td>';
                echo '<td>' . htmlspecialchars($row['creation_date']) . '</td>';
                echo '<td>' . htmlspecialchars($row['status']) . '</td>';
                echo '<td>';
                echo '<a href="reservation-details.php?id=' . $row['id'] . '" class="btn btn-primary btn-sm">Reservation Details</a>';
                echo '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="4" class="text-center">No reservations found.</td></tr>';
        }
        ?>
        </tbody>
    </table>
</div>

<?php include('footer.php'); ?>
</body>
</html>
