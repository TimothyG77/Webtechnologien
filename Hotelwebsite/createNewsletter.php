
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
    <h1 class="text-center mb-4">Newsletter erstellen</h1>
    <form action="form/newsletter-form.php" method="post">
        <!-- Titel des Newsletters -->
        <div class="mb-3">
            <label for="title" class="form-label">Titel</label>
            <input type="text" 
                   class="form-control" 
                   id="title" 
                   name="title" 
                   placeholder="Titel des Newsletters" 
                   value="<?php echo htmlspecialchars($_POST['title'] ?? '', ENT_QUOTES); ?>" 
                   required>
        </div>

        <!-- Betreff -->
        <div class="mb-3">
            <label for="subject" class="form-label">Betreff</label>
            <input type="text" 
                   class="form-control" 
                   id="subject" 
                   name="subject" 
                   placeholder="Betreff des Newsletters" 
                   value="<?php echo htmlspecialchars($_POST['subject'] ?? '', ENT_QUOTES); ?>" 
                   required>
        </div>

        <!-- Inhalt -->
        <div class="mb-3">
            <label for="content" class="form-label">Inhalt</label>
            <textarea class="form-control" 
                      id="content" 
                      name="content" 
                      rows="8" 
                      placeholder="Inhalt des Newsletters" 
                      required><?php echo htmlspecialchars($_POST['content'] ?? '', ENT_QUOTES); ?></textarea>
        </div>

        <!-- Abschicken Button -->
        <button type="submit" class="btn btn-primary">Newsletter erstellen</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
