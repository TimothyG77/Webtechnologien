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
            //if a username matches and the password matches aswell, it checks if a potential new username is still unique
            if (password_verify($current_password, $row['password']) && $row['username'] === $_SESSION['username']) {
                $sql_users = "SELECT * FROM users";
                $result_users = $db_obj -> query($sql_users);

                while ($row_users = $result_users->fetch_array()) { 

                    if ($row_users['username'] ===$_SESSION['username']) {
                
                    header("Location: ../profile.php?error=user_exists");
                    exit();
            }

        }

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
                salutation= ?,
                firstname= ?,
                lastname=?, 
                useremail=?,
                username=?, 
                password=?
                WHERE username = ?
                ";

                $stmt = $db_obj->prepare($sql);
                $stmt->bind_param('sssssss', $salutation, $name, $surname, $email, $username, $u_password, $_SESSION["username"]);
                $stmt->execute();
            
                header("Location: profile.php?update=success");
                $_SESSION["username"] = $username;
                
                exit();
            }
        }
        echo $user_found;
        if(!$user_found){
            header("Location: profile.php?error=wrong_password");
                exit();
        }
    }

    
} else {
    // direct access
    header("Location: index.php");
    exit();
}
?>
