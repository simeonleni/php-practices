<?php
require_once 'db_connection.php';

// Retrieve all images from the database
$sql = 'SELECT * FROM images';
$stmt = $pdo->query($sql);
$images = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Image Gallery</title>
</head>
<body>
    <h1>Image Gallery</h1>

    <?php
        foreach ($images as $image) {
            $imageId = $image['id'];
            $imageName = $image['image_name'];

            echo '<div>';
            echo "<img src='display_image.php?id=$imageId' alt='$imageName' width=20%>";
            echo "<p>$imageName</p>";
            echo '</div>';
        }
    ?>
</body>
</html>
