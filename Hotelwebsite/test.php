<?php
require_once('../database/db_mphotel.php');
require_once('../includations/isAdmin.php');

$successMessage = '';
$errorMessage = '';

// Thumbnail erstellen
function createThumbnail($source, $destination, $width, $height) {
    $imageInfo = getimagesize($source);
    $imageType = $imageInfo[2];

    if ($imageType === IMAGETYPE_JPEG) {
        $image = imagecreatefromjpeg($source);
    } elseif ($imageType === IMAGETYPE_PNG) {
        $image = imagecreatefrompng($source);
    } elseif ($imageType === IMAGETYPE_GIF) {
        $image = imagecreatefromgif($source);
    } else {
        return false;
    }

    $thumb = imagecreatetruecolor($width, $height);
    imagecopyresampled($thumb, $image, 0, 0, 0, 0, $width, $height, imagesx($image), imagesy($image));

    if ($imageType === IMAGETYPE_JPEG) {
        imagejpeg($thumb, $destination, 90); // Qualität 90%
    } elseif ($imageType === IMAGETYPE_PNG) {
        imagepng($thumb, $destination);
    } elseif ($imageType === IMAGETYPE_GIF) {
        imagegif($thumb, $destination);
    }

    imagedestroy($thumb);
    imagedestroy($image);
    return true;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_news'])) {
    $title = trim($_POST['title']);
    $summary = trim($_POST['summary']);
    $fullArticle = trim($_POST['full_article']);
    $date = trim($_POST['date']);
    $image = $_FILES['image'];

    if (empty($title) || empty($summary) || empty($fullArticle) || empty($date)) {
        $errorMessage = 'Bitte füllen Sie alle Felder aus.';
    } elseif (!DateTime::createFromFormat('Y-m-d', $date)) {
        $errorMessage = 'Ungültiges Datum.';
    } elseif ($image['error'] !== UPLOAD_ERR_OK) {
        $errorMessage = 'Fehler beim Hochladen des Bildes.';
    } else {
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $fileExtension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));

        if (!in_array($fileExtension, $allowedExtensions)) {
            $errorMessage = 'Nur Bildformate (jpg, jpeg, png, gif) sind erlaubt.';
        } else {
            $uploadDir = '../uploads/news_images/';
            $thumbnailDir = '../uploads/news_thumbnails/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
            if (!is_dir($thumbnailDir)) mkdir($thumbnailDir, 0777, true);

            // Ersetze Sonderzeichen und Leerzeichen im Dateinamen
            $originalName = pathinfo($image['name'], PATHINFO_FILENAME);
            $safeName = preg_replace('/[^a-zA-Z0-9_-]/', '_', $originalName);
            $newFileName = $safeName . '_' . uniqid() . '.' . $fileExtension;

            $destPath = $uploadDir . $newFileName;
            $thumbPath = $thumbnailDir . $newFileName;

            if (move_uploaded_file($image['tmp_name'], $destPath)) {
                if (createThumbnail($destPath, $thumbPath, 400, 200)) {
                    $query = "INSERT INTO news_posts (title, summary, full_article, image, date) VALUES (?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param('sssss', $title, $summary, $fullArticle, $newFileName, $date);

                    if ($stmt->execute()) {
                        $successMessage = 'News erfolgreich erstellt.';
                    } else {
                        $errorMessage = 'Fehler beim Speichern des Beitrags.';
                    }
                } else {
                    $errorMessage = 'Fehler beim Erstellen des Thumbnails.';
                }
            } else {
                $errorMessage = 'Fehler beim Hochladen des Bildes.';
            }
        }
    }
}
?>


//..........................................

<?php
require_once('../validation/newsletter_validation.php');
$query = "SELECT * FROM news_posts ORDER BY date DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsletter</title>
    <?php include('../includations/head.php'); ?>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="body_newsletter">
<header>
    <h1>Newsletter</h1>
</header>

<main>
    <div class="newsletter_container">
        <h3 class="text-center">Aktuelle News</h3>

        <div class="news_wrapper">
            <?php while ($news = mysqli_fetch_assoc($result)): ?>
                <div class="news_box">
                    <div class="news_image">
                        <img src="../uploads/news_thumbnails/<?php echo '../uploads/news_thumbnails'.htmlspecialchars($news['image']); ?>" alt="News Image">
                    </div>
                    <div class="news_content">
                        <h2 class="news_title"><?php echo htmlspecialchars($news['title']); ?></h2>
                        <div class="news_date"><?php echo htmlspecialchars($news['date']); ?></div>
                        <p class="news_summary"><?php echo htmlspecialchars(mb_substr($news['summary'], 0, 150)) . '...'; ?></p>
                        <a href="news_detail.php?id=<?php echo $news['id']; ?>">Mehr lesen</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</main>

<?php include('../includations/bottom.php'); ?>
</body>
</html>