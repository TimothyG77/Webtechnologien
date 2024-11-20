<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];
    $breakfast = $_POST['breakfast'];
    $parking = $_POST['parking'];
    $pets = trim($_POST['pets']);

    // Validierung: Abreisedatum nach Anreisedatum
    if (strtotime($check_out) <= strtotime($check_in)) {
        echo '<div class="alert alert-danger" role="alert">';
        echo 'Check-out date must be later than check-in date.';
        echo '</div>';
        include('../reservation.php');
        exit();
    }

    // Reservierungsdetails speichern (statisch oder in einer Datei/DB)
    $reservation_file = '../reservations.csv';
    if (!file_exists($reservation_file)) {
        $file_handle = fopen($reservation_file, 'w');
        fputcsv($file_handle, ['Reservation ID', 'Check-in', 'Check-out', 'Breakfast', 'Parking', 'Pets', 'Status']);
        fclose($file_handle);
    }

    // Neue Reservierung hinzufügen
    $reservation_id = uniqid(); // Einzigartige ID für die Reservierung
    $new_reservation = [$reservation_id, $check_in, $check_out, $breakfast, $parking, $pets, 'New'];
    $file_handle = fopen($reservation_file, 'a');
    fputcsv($file_handle, $new_reservation);
    fclose($file_handle);

    // Session-Variable setzen und Weiterleitung bei Erfolg
    $_SESSION['reservation_success'] = true;
    header("Location: ../home.php");
    exit();
}
?>
