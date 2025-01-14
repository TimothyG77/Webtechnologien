<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


// remove session data
session_unset();
session_destroy();


header("Location: login.php");
exit();
?>
