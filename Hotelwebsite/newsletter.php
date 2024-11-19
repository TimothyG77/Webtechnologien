<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsletter</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include('header.php'); ?>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Unsere Newsletter</h1>
        <?php 
            if (isset($_GET['success']) && $_GET['success'] == 1) {
                echo '<div class="alert alert-success" role="alert">';
                echo 'Der Newsletter wurde erfolgreich validiert!';
                echo '</div>';
            }
        ?>

        <a href="createNewsletter.php" class="btn btn-primary">Newsletter erstellen</a>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            
            <?php
            // Start des hartcodierten Abschnitts
            $newsletters = [
                [
                    'title' => 'Newsletter 1',
                    'content' => 'Dies ist der erste Newsletter mit spannenden Themen!',
                    'date' => '01.01.2024'
                ],
                [
                    'title' => 'Newsletter 2',
                    'content' => 'Hier ist unser zweiter Newsletter, vollgepackt mit Neuigkeiten!',
                    'date' => '15.01.2024'
                ],
                [
                    'title' => 'Newsletter 3',
                    'content' => 'Der dritte Newsletter bietet einen Einblick in kommende Events.',
                    'date' => '01.02.2024'
                ]
            ];
            // Ende des hartcodierten Abschnitts
            
            foreach ($newsletters as $newsletter) {
                echo '
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">' . htmlspecialchars($newsletter['title']) . '</h5>
                            <p class="card-text">' . htmlspecialchars($newsletter['content']) . '</p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Veröffentlicht am: ' . htmlspecialchars($newsletter['date']) . '</small>
                        </div>
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>

    
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <?php include('footer.php'); ?>
</body>
</html>
