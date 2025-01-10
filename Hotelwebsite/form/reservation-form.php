<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('dbaccess.php');
    

    // Store form data in session
    $_SESSION['reservation_form_data'] = [
        'check_in' => $_POST['check_in'],
        'check_out' => $_POST['check_out'],
        'breakfast' => $_POST['breakfast'] ?? '',
        'parking' =>  $_POST['parking'] ?? '',
        'pets' => trim($_POST['pets'] ?? ''),
    ];

    // Validation: Check-out date must be later than check-in date
    if (strtotime( $_POST['check_out']) <= strtotime($_POST['check_in'])) {
        header("Location: ../reservation.php?error=checkin_checkout");
        exit();
    }
    $db_obj = new mysqli($host, $user, $dbpassword, $database);

    
    // check Room availability
    $checkInDate = $_POST['check_in'];
    $checkOutDate = $_POST['check_out'];
    $sql_check_room_avail = "SELECT * FROM reservation WHERE NOT (CheckOutDate < ? OR ? < CheckInDate)";
    $stmt = $db_obj->prepare($sql_check_room_avail);
    $stmt->bind_param("ss", $checkInDate, $checkOutDate);
    $stmt->execute();
    $result = $stmt->get_result();

    //We assume, that our hotel has 500 rooms in total
    if ($result->num_rows > 2) {
        header("Location: ../reservation.php?error=availability");
        exit();
    }


    

    $sql = "INSERT INTO `reservation` (`CheckInDate`, `CheckOutDate`, `Breakfast`, `Parking`, `Pets`, `user_id`, `creation_date`,  `status`, `price`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?); " ;
    $stmt = $db_obj->prepare($sql);
    $stmt->bind_param("sssssissi", $checkInDate, $checkOutDate, $breakfast, $parking, $pets, $user_id, $creation_date, $status, $price);

    $checkInDate = $_POST['check_in'];
    $checkOutDate = $_POST['check_out'];
    $breakfast = isset($_POST['breakfast']) ? $_POST['breakfast'] : 'no';
    $parking = isset($_POST['parking']) ? $_POST['parking'] : 'no';
    $current_username = $_SESSION['username'];
    $sql_find_user_id = "SELECT * FROM users WHERE username = '$current_username'";
    $result = $db_obj -> query($sql_find_user_id);
    $user_id;
    while ($row = $result->fetch_array()) {
        $user_id = $row['id'];
    }
    $pets = trim($_POST['pets'] ?? '');
    $creation_date = new DateTime();
    $creation_date = $creation_date->format('Y-m-d H:i:s');
    $status = 'new';

    //calculating days
    $checkInDateObj = new DateTime($checkInDate);
    $checkOutDateObj = new DateTime($checkOutDate);

    $interval = $checkInDateObj->diff($checkOutDateObj);
    $days = $interval->days;


    //price for one room for one night is 50€
    $price = 50 * $days;
    if($breakfast === 'yes'){
        $price += 10 * $days;
    }
    if($parking === 'yes'){
        $price += 5 * $days;
    }
    if(!empty($pets)){
        $price += 2 * $days;
    }
    
    $stmt->execute();

    if ($db_obj->connect_error) {
        echo "Connection Error: " . $db_obj->connect_error;
        exit();
    }

    // Clear session form data upon success
    unset($_SESSION['reservation_form_data']);
    header("Location: ../index.php?reservation_success=1");
    exit();
}
?>
