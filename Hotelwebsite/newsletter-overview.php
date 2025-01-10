<?php
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}
require_once('form/dbaccess.php');

// Verbindung zur Datenbank herstellen
$db_obj = new mysqli($host, $user, $dbpassword, $database);

if ($db_obj->connect_error) {
    die("Connection failed: " . $db_obj->connect_error);
}

// Falls ein Newsletter gelöscht werden soll
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_newsletter'])) {
    $news_id = intval($_POST['delete_newsletter']);

    $delete_sql = "DELETE FROM newsletter WHERE news_id = ?";
    $stmt = $db_obj->prepare($delete_sql);
    $stmt->bind_param("i", $news_id);

    if ($stmt->execute()) {
        $success_message = "Newsletter erfolgreich gelöscht.";
    } else {
        $error_message = "Fehler beim Löschen des Newsletters.";
    }
}

// Alle Newsletter abrufen
$sql = "SELECT * FROM newsletter";
$result = $db_obj->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsletter-Overview</title>
    <!-- Bootstrap CSS -->
    <?php include('link.php'); ?>
</head>
<body class="newsletter-background">
<?php include('header.php'); ?>

<div class="container mt-5">
    <div class="p-4 border rounded bg-light mb-4">
        <h1 class="form-title-newsletter text-center">All Newsletters</h1>
    </div>

    <?php if (isset($success_message)): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $success_message; ?>
        </div>
    <?php endif; ?>

    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Picture</th>
                <th>Content</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['news_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['title']); ?></td>
                        <td>
                            <img src="<?php echo htmlspecialchars($row['picture']); ?>" alt="Newsletter Image" style="width: 100px; height: auto;">
                        </td>
                        <td><?php echo htmlspecialchars($row['content']); ?></td>
                        <td><?php echo htmlspecialchars($row['date']); ?></td>
                        <td>
                            <form method="POST" action="">
                                <button type="submit" name="delete_newsletter" value="<?php echo $row['news_id']; ?>" class="btn btn-danger btn-sm">Löschen</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">Keine Newsletter verfügbar.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include('footer.php'); ?>
<?php include('script.php'); ?>
</body>
</html>
