<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file = $_FILES['picture'];

    if (!is_dir('uploads')) {
        mkdir('uploads');
    }
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
    if($fileExtension != "png"){
        echo "Sorry, only pn-files can be accepted!";
        exit();
        
    }

    $fileName = $file['name'];

    

    move_uploaded_file(
        $file['tmp_name'], 
        'uploads/'.$fileName
    );

}

?>
