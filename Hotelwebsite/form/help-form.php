<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData = $_POST;

    $formError = [];

    // name has to be not empty
    if (empty($formData['name'])) {
        $formError['name'] = 'Name has to be not empty';
    }

    // more validation

    if (count($formError) === 0) {
        // sent to database
    }
}

?>

