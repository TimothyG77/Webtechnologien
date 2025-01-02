<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$_SESSION['newsletter_form_data'] = [
    'title' => $_POST['title'] ?? '',
    'subject' => $_POST['subject'] ?? '',
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
        }elseif($fileExtension != "png"){
            header("Location: ../createNewsletter.php?error=png_error");
            exit();
        }else{
            if (!is_dir('uploads')) {
                mkdir('uploads');
            }
            move_uploaded_file(
                $file['tmp_name'], 
                'uploads/'.$fileName
            );
            $picture = 'form/uploads/'.$fileName;
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
