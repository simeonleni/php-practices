<?php
require_once 'db_connection.php';

$query = 'SELECT * FROM user';
$stmt = $pdo->query($query);

if ($stmt) {
    $users = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $user = array(
            'ID' => $row['id'],
            'Username' => $row['username'],
            'Email' => $row['email'],
            'Password' => $row['password']
        );

        $users[] = $user;
    }

    header('Content-Type: application/json');
    echo json_encode($users);
} else {
    echo json_encode(['error' => 'Error executing the query.']);
}

$pdo = null;

?>
