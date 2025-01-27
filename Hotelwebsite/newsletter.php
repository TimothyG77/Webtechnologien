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
            echo '<div class="col-md-4 mb-4">'; // every box takes 1/3 of the remaining website
            echo '<div class="card h-100 shadow">'; // Bootstrap Card with shadow
            echo '<img src="' . htmlspecialchars($row["picture"]) . '" class="img-thumbnail" alt="Tumbnail" >'; // link to the picture
            echo '<div class="card-body">'; // card context
            echo '<h5 class="card-title">' . htmlspecialchars($row["title"]) . '</h5>'; // title
            echo '<p class="card-text">' . htmlspecialchars($row["content"]) . '</p>'; // context
            echo '</div>';
            echo '<div class="card-footer text-muted">'; // date
            echo 'Veröffentlicht am: ' . htmlspecialchars($row["date"]);
            echo '</div>';
            echo '</div>'; 
            echo '</div>'; 
        }
    } else {
        echo '<p>No newsletters available.</p>';
    }
    
    ?>
</div>

        
        <?php
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'){
            echo '<div class="mb-2"> <a href="createNewsletter.php" class="btn btn-primary">Newsletter erstellen</a> </div>';
            echo '<div class="mb-2"> <a href="newsletter-overview.php" class="btn btn-primary">Newsletter-Overview</a> </div>';
        }
        ?>
        
        
    </div>

    
    
    <?php include('footer.php'); ?>
</body>
</html>
