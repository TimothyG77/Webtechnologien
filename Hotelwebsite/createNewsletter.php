<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// Newsletter-Daten aus der Session laden
$newsletter_form_data = $_SESSION['newsletter_form_data'] ?? [];


?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsletter erstellen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css-stylesheet-bootstrap.css">
</head>
<body>
<?php include('header.php');?>
<?php
if(isset($_GET['error'])){
    $error_message = '';
    switch($_GET['error']){
        case 'no_file_selected':
            $error_message = 'Please select a file';
            break;
        case 'png_error':
            $error_message = 'Only png-files are allowed!';
            break;
        case 'empty_title':
            $error_message = 'Please enter a title';
            break;
        case 'title_too_long':
            $error_message = 'Title should have less than 50 characters';
            break;
        case 'empty_content':
            $error_message = 'Please enter a content';
            break;    
    }
    echo '<div class="alert alert-danger" role="alert">' . $error_message . '</div>';
}
?>
<div class="container mt-5">
    <h1 class="text-center mb-4">Create newsletter</h1>

    <!-- Newsletter-Formular -->
    <form action="/Webtechnologien/Hotelwebsite/form/newsletter-form.php" method="post" enctype="multipart/form-data" class="mt-4">
        <!-- Titel des Newsletters -->
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" 
                   class="form-control" 
                   id="title" 
                   name="title" 
                   value="<?php echo htmlspecialchars($newsletter_form_data['title'] ?? '', ENT_QUOTES); ?>" 
                   required>
        </div>

    

        <!-- Inhalt -->
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" 
                      id="content" 
                      name="content" 
                      rows="8" 
                      required><?php echo htmlspecialchars($newsletter_form_data['content'] ?? '', ENT_QUOTES); ?></textarea>
        </div>
        
        
        <div class="mb-3">
            <label for="picture" class="form-label">Upload picture</label>
            <input type="file" class="form-control" id="picture" name="picture">
        </div>

        <!-- Abschicken Button -->
        <button type="submit" class="btn btn-primary">create newsletter</button>

        
    </form>
</div>
<?php include('footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
