<?php
session_start(); // Session starten

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Eingaben aus dem Formular holen
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Datei mit Benutzerdaten
    $user_file = '../user.csv';
    $user_found = false;

    if (file_exists($user_file)) {
        $file_handle = fopen($user_file, 'r');

        // Header ignorieren
        $header = fgetcsv($file_handle);

        // Zeilen durchlaufen und Benutzerdaten vergleichen
        while (($user_data = fgetcsv($file_handle)) !== false) {
            // Trimme Benutzerdaten, um Leerzeichen/Zeilenumbrüche zu entfernen
            $stored_username = trim($user_data[0]);
            $stored_password = trim($user_data[1]);

            if ($stored_username === $username && $stored_password === $password) {
                $user_found = true;

                // Benutzerdaten in der Session speichern
                $_SESSION['username'] = $stored_username;
                break;
            }
        }

        fclose($file_handle);
    }

    // Überprüfungsergebnis
    if ($user_found) {
        // Erfolgreicher Login, Weiterleitung zur Startseite
        header("Location: ../home.php?login=success");
        exit();
    } else {
        // Fehler, ungültige Anmeldedaten
        header("Location: ../login.php?error=invalid_credentials");
        exit();
    }
} else {
    // Wenn die Seite direkt aufgerufen wird, leite zum Login-Formular weiter
    header("Location: ../login.php");
    exit();
}
?>
