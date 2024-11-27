<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];
    $breakfast = $_POST['breakfast'] ?? '';
    $parking = $_POST['parking'] ?? '';
    $pets = trim($_POST['pets'] ?? '');

    // Store form data in session
    $_SESSION['reservation_form_data'] = [
        'check_in' => $check_in,
        'check_out' => $check_out,
        'breakfast' => $breakfast,
        'parking' => $parking,
        'pets' => $pets,
    ];

    // Validation: Check-out date must be later than check-in date
    if (strtotime($check_out) <= strtotime($check_in)) {
        header("Location: ../reservation.php?error=checkin_checkout");
        exit();
    }

    // Save reservation details (statically or in a file/DB)
    $reservation_file = '../reservations.csv';
    if (!file_exists($reservation_file)) {
        $file_handle = fopen($reservation_file, 'w');
        fputcsv($file_handle, ['Reservation ID', 'Check-in', 'Check-out', 'Breakfast', 'Parking', 'Pets', 'Status']);
        fclose($file_handle);
    }

    // Add new reservation
    $reservation_id = uniqid(); // Unique ID for the reservation
    $new_reservation = [$reservation_id, $check_in, $check_out, $breakfast, $parking, $pets, 'New'];
    $file_handle = fopen($reservation_file, 'a');
    fputcsv($file_handle, $new_reservation);
    fclose($file_handle);

    // Clear session form data upon success
    unset($_SESSION['reservation_form_data']);
    header("Location: ../home.php?reservation_success=1");
    exit();
}
?>
