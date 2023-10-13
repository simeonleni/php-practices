<?php
require_once 'db_connection.php';

if (isset($_GET['id'])) {
    $imageId = $_GET['id'];
    $sql = 'SELECT image_data FROM images WHERE id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$imageId]);
    $image = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($image) {
        header('Content-type: image/jpeg');  // Adjust the content type based on your image type (e.g., image/jpeg, image/png)
        echo $image['image_data'];
    }
}
