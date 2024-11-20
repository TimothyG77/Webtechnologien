<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get input values from the form
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // File containing user data
    $user_file = '../user.csv';
    $user_found = false;

    // Store the username in the session in case of an error
    $_SESSION['login_username'] = $username;

    if (file_exists($user_file)) {
        $file_handle = fopen($user_file, 'r');

        // Ignore header
        $header = fgetcsv($file_handle);

        // Loop through rows and compare user data
        while (($user_data = fgetcsv($file_handle)) !== false) {
            // Trim stored data to remove spaces/newlines
            $stored_username = trim($user_data[0]);
            $stored_password = trim($user_data[1]);

            if ($stored_username === $username && $stored_password === $password) {
                $user_found = true;

                // Store user data in the session
                $_SESSION['username'] = $stored_username;
                break;
            }
        }

        fclose($file_handle);
    }

    // Check the result of the verification
    if ($user_found) {
        // Successful login, clear stored username and redirect to the homepage
        unset($_SESSION['login_username']);
        header("Location: ../home.php?login=success");
        exit();
    } else {
        // Error, invalid login credentials
        header("Location: ../login.php?error=invalid_credentials");
        exit();
    }
} else {
    // If the page is accessed directly, redirect to the login form
    header("Location: ../login.php");
    exit();
}
?>
