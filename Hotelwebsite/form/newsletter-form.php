<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];

    // Eingaben holen und trimmen
    $title = trim($_POST['title'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $content = trim($_POST['content'] ?? '');

    // Validierung
    if (empty($title)) {
        $errors[] = "Der Titel darf nicht leer sein.";
    } elseif (strlen($title) > 50) {
        $errors[] = "Der Titel darf maximal 50 Zeichen lang sein.";
    }

    if (empty($subject)) {
        $errors[] = "Der Betreff darf nicht leer sein.";
    } elseif (strlen($subject) > 100) {
        $errors[] = "Der Betreff darf maximal 100 Zeichen lang sein.";
    }

    if (empty($content)) {
        $errors[] = "Der Inhalt darf nicht leer sein.";
    }

    // Wenn Fehler vorhanden sind, erneut das Formular anzeigen
    if (!empty($errors)) {
        echo '<div class="container mt-3">';
        echo '<div class="alert alert-danger" role="alert">';
        echo '<ul>';
        foreach ($errors as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo '</ul>';
        echo '</div>';
        include '../createNewsletter.php'; // Zeigt das Formular erneut an
        echo '</div>';
    } else {
        // Daten erfolgreich validiert
        header("Location: ../newsletter.php?success=1");
        exit(); // WICHTIG: Beendet das aktuelle Skript
    }
} else {
    // Wenn die Seite direkt aufgerufen wird, zeige nur das Formular
    include '../createNewsletter.php';
}
?>
