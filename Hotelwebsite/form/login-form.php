<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get input values from the form
    $login_username = trim($_POST['username']);
    $login_password = trim($_POST['password']);


    // Store the username in the session in case of an error
    $_SESSION['login_username'] = $username;

    require_once'dbaccess.php';
    $db_obj = new mysqli($host, $user, $dbpassword, $database);
    
    if ($db_obj->connect_error) {
        echo "Connection Error: " . $db_obj -> connect_error;
        exit();
    }else{
        $sql = "SELECT * FROM users";
        $result = $db_obj -> query($sql);
        $user_found = false;

        while ($row = $result->fetch_array()) { 

            if (password_verify($login_password, $row['password']) && $row['username'] === $login_username) {
               if($row['status'] === 'inactive'){
                header("Location: ../login.php?error=inactive_account");
                exit();
               } 
               $user_found = true;
               $_SESSION['username'] = $row['username'];
               $_SESSION['role'] = $row['role'];
               break;
            }
        }
            // Check the result of the verification
        if ($user_found) {
            unset($_SESSION['login_username']);
            header("Location: ../home.php?login_success=1");
            exit();
        } else {
            // Error, invalid login credentials
            header("Location: ../login.php?error=invalid_credentials");
            exit();
        }
    }

    
    
} else {
    // If the page is accessed directly, redirect to the login form
    header("Location: ../login.php");
    exit();
}
?>
