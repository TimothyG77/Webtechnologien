<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Start the session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];

    // Retrieve and trim inputs
    $title = trim($_POST['title'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $content = trim($_POST['content'] ?? '');

    // Store form data in session
    $_SESSION['newsletter_form_data'] = [
        'title' => $title,
        'subject' => $subject,
        'content' => $content,
    ];

    // Validation
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

    // If errors exist, display the form again with the error messages
    if (!empty($errors)) {
        echo '<div class="container mt-3">';
        echo '<div class="alert alert-danger" role="alert">';
        echo '<ul>';
        foreach ($errors as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo '</ul>';
        echo '</div>';
        include '../createNewsletter.php'; // Show the form again
        echo '</div>';
    } else {
        // Data validated successfully, clear session data and redirect
        unset($_SESSION['newsletter_form_data']);
        header("Location: ../newsletter.php?success=1");
        exit(); // IMPORTANT: Terminate the current script
    }
} else {
    // If the page is accessed directly, show only the form
    include '../createNewsletter.php';
}
?>
