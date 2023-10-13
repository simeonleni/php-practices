<?php
require_once 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($username) || empty($email) || empty($password)) {
        echo 'Please fill out all fields.';
    } else {
        $query = 'INSERT INTO user (username, email, password) VALUES (:username, :email, :password)';
        $stmt = $pdo->prepare($query);

        if ($stmt->execute(['username' => $username, 'email' => $email, 'password' => $password])) {
            header('Location: login.php');
            exit;
        } else {
            echo 'Error inserting user data.';
        }
    }
}
?>