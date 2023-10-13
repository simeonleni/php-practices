<?php
session_start();  // Start or resume the session

// Check if the user is logged in; if not, redirect to the login page
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Retrieve user-specific data from the session
$user_id = $_SESSION['user_id'];

// Include your database connection settings if needed
require_once 'db_connection.php';

// Retrieve user-specific data from the database
$query = 'SELECT * FROM USER WHERE UserID = :user_id';
$stmt = $pdo->prepare($query);
$stmt->execute(['user_id' => $user_id]);
$user = $stmt->fetch();

$username = $user['Username'];
$id = $user['UserID'];
$sessid = $user_id;

?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
</head>
<body>
    <h1>Welcome, <?php echo $username; ?>!</h1>
    <h1>DB id, <?php echo $id; ?>!</h1>
    <h1>Session ID, <?php echo $sessid; ?>!</h1>
    <ul>
        <li><a href="#">Profile</a></li>
        <li><a href="#">Messages</a></li>
        <li><a href="#">Settings</a></li>
        <li><a href="image.php">Upload image</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</body>
</html>
