<?php
session_start();

// Connect to database
$conn = mysqli_connect('localhost', 'root', '', 'unihub2');

// Check connection
if (!$conn) {
    die("Cannot connect to database. Check if MySQL is running.");
}

// Functions
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit();
    }
}

?>
