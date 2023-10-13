<?php
require_once ('db_connection.php');

$queryPosts = 'SELECT * FROM POST';
$dataPosts = $pdo->query($queryPosts);
$posts = array();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Posts</title>
</head>
<body>
    <?php
        while ($rowPost = $dataPosts->fetch(PDO::FETCH_ASSOC)) {
            $post = array(
                'ID' => $rowPost['ID'],
                'Title' => $rowPost['Title'],
            );
            $posts[] = $post;

            echo '<div style="border: 1px solid #ccc; padding: 10px; margin: 10px;">';
            echo '<p>ID: ' . $post['ID'] . '</p>';
            echo '<p>Title: ' . $post['Title'] . '</p>';

            // Fetch comments associated with this post
            $queryComments = 'SELECT * FROM COMMENT WHERE PostID = :PostID';
            $stmt = $pdo->prepare($queryComments);
            $stmt->bindParam(':PostID', $post['ID']);
            $stmt->execute();
            $dataComments = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Display comments for this post
            if (!empty($dataComments)) {
                echo '<div style="border: 1px solid #ccc; padding: 10px; margin: 10px;">';
                echo '<p><strong>Comments:</strong></p>';
                foreach ($dataComments as $rowComment) {
                    $comment = array(
                        'ID' => $rowComment['ID'],
                        'PostID' => $rowComment['PostID'],
                        'UserID' => $rowComment['UserID'],
                        'Content' => $rowComment['Content'],
                    );
                    $comments[] = $comment;
                    echo '<p>ID: ' . $comment['ID'] . '</p>';
                    echo '<p>Content: ' . $comment['Content'] . '</p>';
                }
                echo '</div>';
            }

            // Comment form
            echo '<form method="POST" action="process_form.php">';
            echo '<input type="hidden" name="PostID" value="' . $post['ID'] . '">';
            echo '<input type="text" name="Content" placeholder="Add a comment">';
            echo '<input type="submit" value="Submit Comment">';
            echo '</form>';
            echo '</div>';
        }
    ?>
</body>
</html>
