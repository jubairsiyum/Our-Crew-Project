<?php
// Include the session functions file
require_once('session_functions.php');

// Log out the user
logout();

// Redirect the user to a login or home page
header('Location: login.php'); // Change 'login.php' to the appropriate URL
exit();
?>
