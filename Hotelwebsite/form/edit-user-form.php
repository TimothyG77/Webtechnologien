<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current_id = $_GET['id'];
    $username = trim($_POST['username']);
    $new_password = trim($_POST['new_password']);
    $salutation = trim($_POST['salutation']);
    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $email = trim($_POST['email']);
    $role = trim($_POST['role']);
    $status = trim($_POST['status']);
    $hashed_password;
    
    // Store form data in session to retain values in case of an error
    $_SESSION['profile_form_data'] = [
        'username' => $username,
        'salutation' => $salutation,
        'name' => $name,
        'surname' => $surname,
        'email' => $email,
        'role' => $role,
        'status' => $status
    ];

    require_once('dbaccess.php');

    $db_obj = new mysqli($host, $user, $dbpassword, $database);
    
    if ($db_obj->connect_error) {
        echo "Connection Error: " . $db_obj->connect_error;
        exit();
    }else{
        $sql = "SELECT * FROM users WHERE id != '$current_id'";
        $result = $db_obj -> query($sql);
        

        while ($row = $result->fetch_array()) { 
            if ($row['username'] === $username) {
                
                
                header("Location: ../edit-user.php?id=$current_id&error=user_exists");
                exit();
            }
        }

        if(!empty($new_password)){
            if (strlen($new_password) < 8 ||
                !preg_match('/[0-9]/', $new_password) ||
                !preg_match('/[\W]/', $new_password)) {
                header("Location: edit-user.php?id=$current_id &error=invalid_password");
                exit();
            }else{
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            }
        }else{
            $sql_find_current_pw = "SELECT * FROM users WHERE id = '$current_id'";
            $result = $db_obj -> query($sql_find_current_pw);
            while($row = $result->fetch_array()){
                $hashed_password = $row['password'];
            }
            
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: edit-user.php?id=$current_id&error=invalid_email");
            exit();
        }

        

        $sql= "
        UPDATE users SET
        salutation= ?,
        firstname= ?,
        lastname=?, 
        useremail=?,
        username=?, 
        password=?,
        role=?,
        status=?
        WHERE id = '$current_id'
        ";

        $stmt = $db_obj->prepare($sql);
        $stmt->bind_param('ssssssss', $salutation, $name, $surname, $email, $username, $hashed_password, $role, $status);
        $stmt->execute();
    
        header("Location: ../edit-user.php?id=$current_id&update=success");
        
        exit();
            
        }
        
    }else{
        // Direct access is not allowed
        header("Location: index.php");
        exit();
    }

    

    

?>
