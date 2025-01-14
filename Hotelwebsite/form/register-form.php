<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once('dbaccess.php');
    
    // Store the form data in the session in case of an error
    $form_data = [
        'salutation' => $_POST['salutation'],
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'email' => $_POST['email'],
        'username' => $_POST['username']
    ];
    
    $_SESSION['form_data'] = $form_data;

    $userpassword = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    



    $db_obj = new mysqli($host, $user, $dbpassword, $database);
    
    if ($db_obj->connect_error) {
        echo "Connection Error: " . $db_obj->connect_error;
        exit();
    }else{
        $sql = "SELECT * FROM users";
        $result = $db_obj -> query($sql);

        while ($row = $result->fetch_array()) { 
            
            //check, if username already exists
            if ($row['username'] === $form_data['username']) {
                
                header("Location: ../register.php?error=user_exists_error");
                    exit();
            }

        }
        //check if password is at least 8 characters long and has a number and a special char
        if (strlen($userpassword) < 8 || 
        !preg_match('/[0-9]/', $userpassword) || 
        !preg_match('/[\W]/', $userpassword)) {
        header("Location: ../register.php?error=password_symbols_error");
        exit();
        }

        // Compare if password and confirmed password are the same
        if ($userpassword !== $confirm_password) {
            header("Location: ../register.php?error=password_error");
            exit();
        }

        // Validate email
        if (!filter_var($form_data['email'], FILTER_VALIDATE_EMAIL)) {
            header("Location: ../register.php?error=email_error");
            exit();
        }
        
        $sql = "INSERT INTO `users` (`salutation`, `firstname`, `lastname`, `useremail`, `username`, `password`, `role`, `status`) VALUES (?, ?, ?, ?, ?, ?, ?, ?); " ;
        $stmt = $db_obj->prepare($sql);
        $stmt->bind_param("ssssssss", $u_salutation, $f_name, $l_name, $u_email, $u_name, $u_password, $u_role, $u_status);
        $u_salutation = $form_data['salutation'];
        $f_name = $form_data['first_name'];
        $l_name = $form_data['last_name'];
        $u_email = $form_data['email'];
        $u_name = $form_data['username'];
        $u_password = password_hash($userpassword, PASSWORD_DEFAULT) ;
        $u_role = 'user';
        $u_status = 'active';
        $stmt->execute();

        // Clear session data if successful registration
        unset($_SESSION['form_data']);

        // Redirect on success
        header("Location: ../index.php?registration_success=1");
        exit();
        }    
}
?>
