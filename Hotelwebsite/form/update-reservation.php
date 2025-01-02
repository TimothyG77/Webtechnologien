<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current_id = $_GET['id'];
    $check_in_date = trim($_POST['check-in-date']);
    $check_out_date = trim($_POST['check-out-date']);
    $breakfast = trim($_POST['breakfast']);
    $parking = trim($_POST['parking']);
    $pets = trim($_POST['pets']);
    $user_id = trim($_POST['user_id']);
    $creation_date = trim($_POST['creation_date']);
    $status = trim($_POST['status']);
    
    // Store form data in session to retain values in case of an error
    $_SESSION['profile_form_data'] = [
        'check_in_date' => $check_in_date,
        'check_out_date' => $check_out_date,
        'breakfast' => $breakfast,
        'parking' => $parking,
        'pets' => $pets,
        'user_id' => $user_id,
        'creation_date' => $creation_date,
        'status' => $status
    ];

    require_once('dbaccess.php');

    $db_obj = new mysqli($host, $user, $dbpassword, $database);
    
    if ($db_obj->connect_error) {
        echo "Connection Error: " . $db_obj->connect_error;
        exit();
    }else{
         $sql= "
        UPDATE reservation SET
        CheckInDate= ?,
        CheckOutDate= ?,
        Breakfast=?, 
        Parking=?,
        Pets=?, 
        user_id=?,
        creation_date=?,
        status=?
        WHERE id = '$current_id'
        ";

        $stmt = $db_obj->prepare($sql);
        $stmt->bind_param('sssssiss', $check_in_date, $check_out_date, $breakfast, $parking, $pets, $user_id, $creation_date, $status);
        $stmt->execute();
    
        header("Location: ../reservation-details.php?id=$current_id&update=success");
        
        exit();
            
        }
        
    }else{
        // Direct access is not allowed
        header("Location: home.php");
        exit();
    }

    

    

?>
