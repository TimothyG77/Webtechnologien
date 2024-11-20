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

    $user_file = 'user.csv';
    $updated_data = [];
    $update_success = false;

    if (file_exists($user_file)) {
        $file_handle = fopen($user_file, 'r');

        // Ignore header
        $header = fgetcsv($file_handle);

        // Loop through user data
        while (($data = fgetcsv($file_handle)) !== false) {
            $stored_username = trim($data[0]);
            $stored_password = trim($data[1]);

            if ($stored_username === $_SESSION['username']) {
                // Check if current password is correct
                if ($stored_password !== $current_password) {
                    fclose($file_handle);
                    header("Location: profile.php?error=wrong_password");
                    exit();
                }

                // Validate new password if provided
                if (!empty($new_password)) {
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

                // Update user data
                $new_password = empty($new_password) ? $stored_password : $new_password;
                $updated_data[] = [
                    $username,
                    $new_password,
                    $salutation,
                    $name,
                    $surname,
                    $email,
                ];
                $update_success = true;
            } else {
                // Keep other users unchanged
                $updated_data[] = $data;
            }
        }

        fclose($file_handle);
    }

    // Write updated data back to the file
    if ($update_success) {
        $file_handle = fopen($user_file, 'w');
        fputcsv($file_handle, $header); // Write header back
        foreach ($updated_data as $row) {
            fputcsv($file_handle, $row);
        }
        fclose($file_handle);

        // Clear session form data on success
        unset($_SESSION['profile_form_data']);

        // Update the session username to reflect the new username
        $_SESSION['username'] = $username;

        // Redirect with success message
        header("Location: profile.php?update=success");
        exit();
    } else {
        // Error: User not found
        header("Location: profile.php?error=user_not_found");
        exit();
    }
} else {
    // Direct access is not allowed
    header("Location: profile.php");
    exit();
}
?>
