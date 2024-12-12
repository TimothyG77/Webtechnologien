<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $current_password = trim($_POST['current_password']);
    $new_password = trim($_POST['new_password']);
    $salutation = trim($_POST['salutation']);
    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $email = trim($_POST['email']);
    
    // Store form data in session to retain values in case of an error
    $_SESSION['profile_form_data'] = [
        'username' => $username,
        'salutation' => $salutation,
        'name' => $name,
        'surname' => $surname,
        'email' => $email,
    ];

    require_once('form/dbaccess.php');

    $db_obj = new mysqli($host, $user, $dbpassword, $database);
    
    if ($db_obj->connect_error) {
        echo "Connection Error: " . $db_obj->connect_error;
        exit();
    }else{
        $sql = "SELECT * FROM users";
        $result = $db_obj -> query($sql);
        $user_found = false;

        while ($row = $result->fetch_array()) { 

            if (password_verify($current_password, $row['password']) && $row['username'] === $_SESSION['username']) {

                $user_found = true;
                //check, if password is correct
                if(!empty($new_password)){
                    if (strlen($new_password) < 8 ||
                        !preg_match('/[0-9]/', $new_password) ||
                        !preg_match('/[\W]/', $new_password)) {
                        header("Location: profile.php?error=invalid_password");
                        exit();
                    }
                }
            

                // Validate email format
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    header("Location: profile.php?error=invalid_email");
                    exit();
                }

                if(!empty($new_password)){
                    $u_password = password_hash($new_password, PASSWORD_DEFAULT) ;
                }else{
                    $u_password = $row['password'];
                }
                $sql= "
                UPDATE users SET
                salutation='".$salutation."',
                firstname='".$name."',
                lastname='".$surname."', 
                useremail='".$email."',
                username='".$username."', 
                password='".$u_password."'
                WHERE username = '".$_SESSION["username"]."'
                ";
                $result = $db_obj -> query($sql);
            

                echo 'execute hat funktioniert';
                //header("Location: profile.php?update=success");
                
                //exit();
            }
        }
        echo $user_found;
        if(!$user_found){
            //header("Location: profile.php?error=wrong_password");
                //exit();
        }
    }

    
} else {
    // Direct access is not allowed
    header("Location: profile.php");
    exit();
}
?>
