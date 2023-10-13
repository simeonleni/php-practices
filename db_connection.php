<?php
$host = 'webdev.cg4vktva35w7.eu-north-1.rds.amazonaws.com';
$port = 3306;  // MySQL port
$dbname = 'data';  // Replace with your actual database name
$username = 'webdev';  // Replace with your MySQL username
$password = 'webdev01';  // Replace with your MySQL password

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die ('Connection failed: ' . $e->getMessage());
}
?>