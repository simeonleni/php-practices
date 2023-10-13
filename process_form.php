<?php
require_once 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['PostID']) && isset($_POST['Content'])) {
        $postID = $_POST['PostID'];
        $content = $_POST['Content'];
        $UserID = 1;
        echo $postID;
        echo $content;
        echo $UserID;

        $query = 'INSERT INTO COMMENT (PostID, UserID, Content) VALUES (?, ?, ?)';
        $stmt = $pdo->prepare($query);

        if ($stmt->execute([$postID, $UserID, $content])) {
            header('Location: posts.php');
            exit;
        } else {
            echo 'Error inserting user data.';
        }
    } else {
        echo 'One or more form fields are missing in the POST data.';
    }
}
?>
