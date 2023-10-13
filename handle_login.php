<?php
require_once 'db_connection.php';  // Include your database connection settings

// Start or resume a session
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if username is provided
    if (empty($username)) {
        echo 'Username is required.';
    } else {
        $query = `SELECT * FROM USER WHERE Username = $username`;
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user) {
            $hashedPassword = $user['Password'];
            if ($password == $hashedPassword) {
                // Start a session and store user data
                $_SESSION['user_id'] = $user['UserID'];
                $_SESSION['username'] = $user['Username'];

                header('Location: dashboard.php');
                exit;
            } else {
                echo 'Invalid password. Please try again.';
            }
        } else {
            echo 'User does not exist. Please check your username or register.';
        }
    }
}
?>
