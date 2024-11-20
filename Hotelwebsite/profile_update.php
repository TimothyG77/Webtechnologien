<?php
session_start();

// Zugriffsschutz: Nur eingeloggte Benutzer können Änderungen vornehmen
if (!isset($_SESSION['username'])) {
    header("Location: login.php?error=not_logged_in");
    exit();
}

// Eingaben aus dem Formular validieren
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_SESSION['username']; // Benutzername aus der Session
    $email = trim($_POST['email']);
    $current_password = trim($_POST['current_password']);
    $new_password = trim($_POST['new_password']);

    // Datei mit Benutzerdaten
    $user_file = 'user.csv';
    $updated_data = [];
    $update_success = false;

    if (file_exists($user_file)) {
        $file_handle = fopen($user_file, 'r');

        // Header einlesen
        $header = fgetcsv($file_handle);
        $updated_data[] = $header; // Header zur aktualisierten Datei hinzufügen

        // Benutzerdateien durchlaufen
        while (($data = fgetcsv($file_handle)) !== false) {
            $stored_username = trim($data[0]);
            $stored_password = trim($data[1]);
            $stored_salutation = trim($data[2]);
            $stored_name = trim($data[3]);
            $stored_surname = trim($data[4]);
            $stored_email = trim($data[5]);

            if ($stored_username === $username) {
                // Aktuelles Passwort überprüfen
                if ($stored_password !== $current_password) {
                    fclose($file_handle);
                    header("Location: profile.php?error=wrong_password");
                    exit();
                }

                // Daten aktualisieren
                $new_password = empty($new_password) ? $stored_password : $new_password; // Neues Passwort nur setzen, wenn es angegeben wurde
                $updated_data[] = [
                    $stored_username,
                    $new_password,
                    $stored_salutation, // Anrede bleibt unverändert
                    $stored_name,       // Name bleibt unverändert
                    $stored_surname,    // Nachname bleibt unverändert
                    $email              // Aktualisierte E-Mail
                ];
                $update_success = true;
            } else {
                // Andere Benutzer unverändert übernehmen
                $updated_data[] = $data;
            }
        }

        fclose($file_handle);
    }

    // Aktualisierte Daten in die Datei zurückschreiben
    if ($update_success) {
        $file_handle = fopen($user_file, 'w');
        foreach ($updated_data as $row) {
            fputcsv($file_handle, $row);
        }
        fclose($file_handle);

        // Weiterleitung mit Erfolgsmeldung
        header("Location: profile.php?update=success");
        exit();
    } else {
        // Fehler: Benutzer nicht gefunden
        header("Location: profile.php?error=user_not_found");
        exit();
    }
} else {
    // Direkter Zugriff auf die Seite ist nicht erlaubt
    header("Location: profile.php");
    exit();
}
?>
