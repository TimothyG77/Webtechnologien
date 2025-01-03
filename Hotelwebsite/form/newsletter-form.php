<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$_SESSION['newsletter_form_data'] = [
    'title' => $_POST['title'] ?? '',
    'content' => $_POST['content'] ?? ''
];
require_once('dbaccess.php');

$db_obj = new mysqli($host, $user, $dbpassword, $database);
if ($db_obj->connect_error) {
    echo "Connection Error: " . $db_obj->connect_error;
    exit();
}else{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $file = $_FILES['picture'];
        $fileName = $file['name'];
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
    
        if ($file['error'] === UPLOAD_ERR_NO_FILE) {
            header("Location: ../createNewsletter.php?error=no_file_selected");
            exit;
        }elseif($fileExtension != "png" && $fileExtension != 'jpg' && $fileExtension != 'jpeg'){
            header("Location: ../createNewsletter.php?error=png_error");
            exit();
        }else{
            if (!is_dir('uploads')) {
                mkdir('uploads');
            }
            list($width, $height) = getimagesize($file['tmp_name']);
            $new_width = 1000; 
            $new_height = 800;
            $thumbnail = imagecreatetruecolor($new_width, $new_height);
            imageantialias($thumbnail, true); //erhöht die Qualität
            
            if ($fileExtension === 'jpg' || $fileExtension === 'jpeg') {
                $source_image = imagecreatefromjpeg($file['tmp_name']);
            } elseif ($fileExtension === 'png') {
                $source_image = imagecreatefrompng($file['tmp_name']);
            }
    
            // Bild resampeln (Verkleinern)
            imagecopyresampled(
                $thumbnail,
                $source_image,
                0, 0, 0, 0,
                $new_width, $new_height,
                $width, $height
            );
    
            // Thumbnail speichern (an den endgültigen Pfad)
            $thumbnail_path = 'uploads/' . $fileName;
            if ($fileExtension === 'jpg' || $fileExtension === 'jpeg') {
                imagejpeg($thumbnail, $thumbnail_path, 95); // JPEG speichern mit 80% Qualität
            } elseif ($fileExtension === 'png') {
                imagepng($thumbnail, $thumbnail_path);
            }
    
            // Speicher freigeben
            imagedestroy($thumbnail);
            imagedestroy($source_image);
    
            // Bildpfad für die Datenbank
            $picture = 'form/'.$thumbnail_path;
        }
    
    
    
        // Retrieve and trim inputs
        $title = trim($_POST['title'] ?? '');
        $content = trim($_POST['content'] ?? '');
    
        // Store form data in session
        $_SESSION['newsletter_form_data'] = [
            'title' => $title,
            'content' => $content,
        ];
    
        // Validation
        if (empty($title)) {
            header("Location: ../createNewsletter.php?error=empty_title");
            exit();
        } elseif (strlen($title) > 50) {
            header("Location: ../createNewsletter.php?error=title_too_long");
            exit();
        }
    
    
        if (empty($content)) {
            header("Location: ../createNewsletter.php?error=empty_content");
            exit();
        }
    
        
            $date = new DateTime();
            $date = $date->format('Y-m-d');
            $sql = "INSERT INTO `newsletter` (`title`, `picture`, `content`, `date`) VALUES (?, ?, ?, ?); " ;
            $stmt = $db_obj->prepare($sql);
            $stmt->bind_param("ssss", $title, $picture, $content, $date);
            
            $stmt->execute();
    
            unset($_SESSION['newsletter_form_data']);
            header("Location: ../newsletter.php?success=1");
            exit(); // IMPORTANT: Terminate the current script
        
    } else {
        // If the page is accessed directly, show only the form
        include '../createNewsletter.php';
    }
}


?>
