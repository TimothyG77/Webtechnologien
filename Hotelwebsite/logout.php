<?php
session_start();

// Alle Session-Daten löschen
session_unset();
session_destroy();

// Zur Login-Seite weiterleiten
header("Location: login.php?logout=success");
exit();
?>
