<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
 // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $form_data = [
        'salutation' => $_POST['salutation'],
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'email' => $_POST['email'],
        'username' => $_POST['username']
    ];

    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Store the form data in the session in case of an error
    $_SESSION['form_data'] = $form_data;

    // Check if the user already exists
    $user_file = '../user.csv';
    if (file_exists($user_file)) {
        $file_handle = fopen($user_file, 'r');
        fgetcsv($file_handle); // Skip header

        while (($user_data = fgetcsv($file_handle)) !== false) {
            if (trim($user_data[0]) === $form_data['username']) { // Username column
                fclose($file_handle);
                header("Location: ../register.php?error=user_exists_error");
                exit();
            }
        }
        fclose($file_handle);
    }

    // Validate password requirements
    if (strlen($password) < 8 || 
        !preg_match('/[0-9]/', $password) || 
        !preg_match('/[\W]/', $password)) {
        header("Location: ../register.php?error=password_symbols_error");
        exit();
    }

    // Compare passwords
    if ($password !== $confirm_password) {
        header("Location: ../register.php?error=password_error");
        exit();
    }

    // Validate email
    if (!filter_var($form_data['email'], FILTER_VALIDATE_EMAIL)) {
        header("Location: ../register.php?error=email_error");
        exit();
    }

    // Save user (to the CSV file `user.csv`)
    if (!file_exists($user_file)) {
        $file_handle = fopen($user_file, 'w');
        fputcsv($file_handle, ['username', 'password', 'salutation', 'name', 'surname', 'email']);
        fclose($file_handle);
    }

    $new_user = [
        $form_data['username'], 
        $password, 
        $form_data['salutation'], 
        $form_data['first_name'], 
        $form_data['last_name'], 
        $form_data['email']
    ];
    $file_handle = fopen($user_file, 'a');
    fputcsv($file_handle, $new_user);
    fclose($file_handle);

    // Clear session data upon successful registration
    unset($_SESSION['form_data']);

    // Redirect on success
    header("Location: ../home.php?registration_success=1");
    exit();
}
?>
