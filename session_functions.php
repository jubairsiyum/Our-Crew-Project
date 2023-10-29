<?php
// Start a session if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Function to check if a user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Function to log in a user
function login($user_id, $username) {
    $_SESSION['user_id'] = $user_id;
    $_SESSION['username'] = $username;
}

// Function to log out a user
function logout() {
    session_unset();
    session_destroy();
}

// Function to get the current user's ID
function getUserId() {
    return $_SESSION['user_id'];
}

// Function to get the current username
function getUsername() {
    return $_SESSION['username'];
}
?>
