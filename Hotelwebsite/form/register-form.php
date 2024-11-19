<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Alle Felder erfassen
    $form_data = [
        'salutation' => trim($_POST['salutation']),
        'first_name' => trim($_POST['first_name']),
        'last_name' => trim($_POST['last_name']),
        'email' => trim($_POST['email']),
        'username' => trim($_POST['username']),
    ];

    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Prüfen, ob der Benutzername bereits existiert
    $user_file = '../user.csv';
    if (file_exists($user_file)) {
        $file_handle = fopen($user_file, 'r');
        // Kopfzeile überspringen
        fgetcsv($file_handle);

        while (($user_data = fgetcsv($file_handle)) !== false) {
            if (trim($user_data[0]) === $form_data['username']) { // Benutzername-Spalte
                fclose($file_handle);
                echo '<div class="alert alert-danger" role="alert">';
                echo 'The username is already taken. Please choose a different one.';
                echo '</div>';
                include('../register.php');
                exit();
            }
        }
        fclose($file_handle);
    }

    // Passwort-Anforderungen überprüfen
    if (strlen($password) < 8 || 
        !preg_match('/[0-9]/', $password) || 
        !preg_match('/[\W]/', $password)) {
        echo '<div class="alert alert-danger" role="alert">';
        echo 'The password must be at least 8 characters long, contain at least one number, and one special character.';
        echo '</div>';
        include('../register.php');
        exit();
    }

    // Passwörter vergleichen
    if ($password !== $confirm_password) {
        echo '<div class="alert alert-danger" role="alert">';
        echo 'The passwords do not match. Please try again.';
        echo '</div>';
        include('../register.php');
        exit();
    }

    // E-Mail überprüfen
    if (!filter_var($form_data['email'], FILTER_VALIDATE_EMAIL)) {
        echo '<div class="alert alert-danger" role="alert">';
        echo 'Please enter a valid email address.';
        echo '</div>';
        include('../register.php');
        exit();
    }

    // Benutzer speichern (in der CSV-Datei `user.csv`)
    // Prüfen, ob CSV-Datei existiert, andernfalls Kopfzeile hinzufügen
    if (!file_exists($user_file)) {
        $file_handle = fopen($user_file, 'w');
        fputcsv($file_handle, ['username', 'password', 'salutation', 'name', 'surname', 'email']);
        fclose($file_handle);
    }

    // Neuen Benutzer hinzufügen
    $new_user = [
        $form_data['username'], 
        $password, 
        $form_data['salutation'], 
        $form_data['first_name'], 
        $form_data['last_name'], 
        $form_data['email']
    ];
    $file_handle = fopen($user_file, 'a');
    fputcsv($file_handle, $new_user);
    fclose($file_handle);

    // Weiterleitung bei Erfolg
    header("Location: ../home.php?success=1");
    exit();
}
?>
