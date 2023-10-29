<?php
require_once('session_functions.php');

// Check if the user is logged in and has the admin role
if (!isLoggedIn() || $_SESSION['user_role'] !== 'admin') {
    header('Location: login.php'); // Redirect to the login page if not logged in or not an admin
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome, Admin</title>
</head>
<body>
    <h2>Welcome, Admin</h2>
    <p>This is the admin's home page. You have administrative privileges here.</p>

    <!-- You can add admin-specific content and functionality here -->

    <a href="logout.php">Logout</a>
</body>
</html>
