<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Newsletter-Daten aus der Session laden
$newsletter_form_data = $_SESSION['newsletter_form_data'] ?? [];

// Datei-Upload verarbeiten
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['picture'])) {
    // Speichere Newsletter-Daten aus POST in die Session
    $_SESSION['newsletter_form_data'] = [
        'title' => $_POST['title'] ?? '',
        'subject' => $_POST['subject'] ?? '',
        'content' => $_POST['content'] ?? ''
    ];
    $newsletter_form_data = $_SESSION['newsletter_form_data']; // Aktualisiere lokale Daten

    if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['picture'];
        $fileName = $file['name'];

        // Überprüfen, ob das Upload-Verzeichnis existiert
        if (!is_dir('uploads')) {
            mkdir('uploads', 0777, true); // Erstelle das Verzeichnis mit Schreibrechten
        }

        // Dateiendung überprüfen
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        if ($fileExtension !== 'png') {
            echo "<div class='alert alert-danger'>Sorry, only PNG files can be accepted!</div>";
        } else {
            // Datei verschieben
            move_uploaded_file(
                $file['tmp_name'],
                'uploads/' . uniqid() . '_' . $fileName
            );
            echo "<div class='alert alert-success'>Die Datei wurde erfolgreich hochgeladen!</div>";
        }
    }
}

// Newsletter-Daten speichern (falls das Newsletter-Formular abgeschickt wurde)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_FILES['picture'])) {
    $_SESSION['newsletter_form_data'] = [
        'title' => $_POST['title'] ?? '',
        'subject' => $_POST['subject'] ?? '',
        'content' => $_POST['content'] ?? ''
    ];
    header("Location: /Webtechnologien/Hotelwebsite/form/newsletter-form.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsletter erstellen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Create newsletter</h1>

    <!-- Newsletter-Formular -->
    <form action="/Webtechnologien/Hotelwebsite/form/newsletter-form.php" method="post">
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

        <!-- Betreff -->
        <div class="mb-3">
            <label for="subject" class="form-label">Subject</label>
            <input type="text" 
                   class="form-control" 
                   id="subject" 
                   name="subject" 
                   value="<?php echo htmlspecialchars($newsletter_form_data['subject'] ?? '', ENT_QUOTES); ?>"   
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

        <!-- Abschicken Button -->
        <button type="submit" class="btn btn-primary">create newsletter</button>
    </form>

    <!-- Datei-Upload -->
    <form enctype="multipart/form-data" method="post" class="mt-4">
        <input type="hidden" name="title" value="<?php echo htmlspecialchars($newsletter_form_data['title'] ?? '', ENT_QUOTES); ?>">
        <input type="hidden" name="subject" value="<?php echo htmlspecialchars($newsletter_form_data['subject'] ?? '', ENT_QUOTES); ?>">
        <input type="hidden" name="content" value="<?php echo htmlspecialchars($newsletter_form_data['content'] ?? '', ENT_QUOTES); ?>">
        
        <div class="mb-3">
            <label for="picture" class="form-label">Upload picture</label>
            <input type="file" class="form-control" id="picture" name="picture">
        </div>
        <button type="submit" class="btn btn-secondary">Upload</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
