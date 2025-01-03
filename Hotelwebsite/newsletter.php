<?php
require_once('form/dbaccess.php');
$db_obj = new mysqli($host, $user, $dbpassword, $database);

    
$sql = "SELECT news_id, title, picture, content, date FROM newsletter";
$result = $db_obj -> query($sql);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsletter</title>
    <!-- Bootstrap CSS -->
    <?php include('link.php'); ?>
</head>
<body class="newsletter-background">
<?php include('header.php'); ?>
    <div class="container mt-5">
        <div class="p-4 border rounded bg-light mb-4">
            <h1 class="form-title-newsletter text-center">Our Newsletter</h1>
        </div>
        <?php 
            if (isset($_GET['success']) && $_GET['success'] == 1) {
                echo '<div class="alert alert-success" role="alert">';
                echo 'Newsletter successfully created!';
                echo '</div>';
            }
        ?>
        <div class="row">
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_array()) {
            echo '<div class="col-md-4 mb-4">'; // Jede Box nimmt 1/3 der Breite in großen Viewports ein
            echo '<div class="card h-100 shadow">'; // Bootstrap Card mit Schatten
            echo '<img src="' . htmlspecialchars($row["picture"]) . '" class="img-thumbnail"  >'; // Bild mit Thumbnail-Größe
            echo '<div class="card-body">'; // Card-Inhalt
            echo '<h5 class="card-title">' . htmlspecialchars($row["title"]) . '</h5>'; // Titel
            echo '<p class="card-text">' . htmlspecialchars($row["content"]) . '</p>'; // Inhalt
            echo '</div>';
            echo '<div class="card-footer text-muted">'; // Veröffentlichungsdatum im Footer
            echo 'Veröffentlicht am: ' . htmlspecialchars($row["date"]);
            echo '</div>';
            echo '</div>'; // Card schließen
            echo '</div>'; // Spalte schließen
        }
    } else {
        echo '<p>No newsletters available.</p>';
    }
    
    ?>
</div>

        
        <?php
        if (isset($_SESSION['username'])){
            $sql_select_role = 'SELECT role FROM users WHERE username = "'.$_SESSION['username'].'"';
        $result_role = $db_obj->query($sql_select_role);
        
        while($row = $result_role -> fetch_array()){
            if ($row['role'] === 'admin'){
                echo '<div class="mb-2"> <a href="createNewsletter.php" class="btn btn-primary">Newsletter erstellen</a> </div>';
                echo '<div class="mb-2"> <a href="newsletter-overview.php" class="btn btn-primary">Newsletter-Overview</a> </div>';
            }
        }
        }
        
        

        
        ?>
        
        
    </div>

    
    
    <?php include('footer.php'); ?>
    <?php include('script.php'); ?>
</body>
</html>
