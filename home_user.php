<?php
require_once('session_functions.php');

// Check if the user is logged in and has the user role
if (!isLoggedIn() || $_SESSION['user_role'] !== 'user') {
    header('Location: login.php'); // Redirect to the login page if not logged in or not a user
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome, User</title>
</head>
<body>
    <h2>Welcome, User</h2>
    <p>This is the user's home page. You have user privileges here.</p>

    <!-- You can add user-specific content and functionality here -->

    <a href="logout.php">Logout</a>
</body>
</html>
