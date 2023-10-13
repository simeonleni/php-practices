<?php
require_once 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $imageData = file_get_contents($_FILES['fileToUpload']['tmp_name']);
    $imageName = $_FILES['fileToUpload']['name'];

    if (empty($imageData) || empty($imageName)) {
        echo 'Please add a new image';
    } else {
        $sql = 'INSERT INTO images (image_data, image_name) VALUES (?, ?)';
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute([$imageData, $imageName])) {
            header('Location: displayimages.php');
        } else {
            echo 'Failed to submit image';
        }
    }
}
?>
