<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
 // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once('dbaccess.php');
    $form_data = [
        'salutation' => $_POST['salutation'],
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'email' => $_POST['email'],
        'username' => $_POST['username']
    ];

    $userpassword = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Store the form data in the session in case of an error
    $_SESSION['form_data'] = $form_data;



    $db_obj = new mysqli($host, $user, $dbpassword, $database);
    
    if ($db_obj->connect_error) {
        echo "Connection Error: " . $db_obj->connect_error;
        exit();
    }else{
        $sql = "SELECT * FROM users";
        $result = $db_obj -> query($sql);

        while ($row = $result->fetch_array()) { 

            if ($row['username'] === $form_data['username']) {
                
                header("Location: ../register.php?error=user_exists_error");
                    exit();
            }

        }
        if (strlen($userpassword) < 8 || 
        !preg_match('/[0-9]/', $userpassword) || 
        !preg_match('/[\W]/', $userpassword)) {
        header("Location: ../register.php?error=password_symbols_error");
        exit();
        }

        // Compare passwords
        if ($userpassword !== $confirm_password) {
            header("Location: ../register.php?error=password_error");
            exit();
        }

        // Validate email
        if (!filter_var($form_data['email'], FILTER_VALIDATE_EMAIL)) {
            header("Location: ../register.php?error=email_error");
            exit();
        }

        $new_user = [
            $form_data['username'], 
            $password, 
            $form_data['salutation'], 
            $form_data['first_name'], 
            $form_data['last_name'], 
            $form_data['email']
        ];

        $sql = "INSERT INTO `users` (`salutation`, `firstname`, `lastname`, `useremail`, `username`, `password`) VALUES (?, ?, ?, ?, ?, ?); " ;
        $stmt = $db_obj->prepare($sql);
        $stmt->bind_param("ssssss", $u_salutation, $f_name, $l_name, $u_email, $u_name, $u_password);
        $u_salutation = $form_data['salutation'];
        $f_name = $form_data['first_name'];
        $l_name = $form_data['last_name'];
        $u_email = $form_data['email'];
        $u_name = $form_data['username'];
        $u_password = password_hash($userpassword, PASSWORD_DEFAULT) ;
        $stmt->execute();

        // Clear session data upon successful registration
        unset($_SESSION['form_data']);

        // Redirect on success
        header("Location: ../home.php?registration_success=1");
        exit();
        }    
}
?>
