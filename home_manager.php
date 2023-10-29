<?php
require_once('session_functions.php');

// Check if the user is logged in and has the manager role
if (!isLoggedIn() || $_SESSION['user_role'] !== 'manager') {
    header('Location: login.php'); // Redirect to the login page if not logged in or not a manager
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome, Manager</title>
</head>
<body>
    <h2>Welcome, Manager</h2>
    <p>This is the manager's home page. You have manager privileges here.</p>

    <!-- You can add manager-specific content and functionality here -->

    <a href="logout.php">Logout</a>
</body>
</html>
