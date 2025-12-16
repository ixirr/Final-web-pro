<?php
session_start();

// Connect to database
$conn = mysqli_connect('localhost', 'root', '', 'unihub2');

// If can't connect, try to create database
if (!$conn) {
    // Try without database first
    $temp_conn = mysqli_connect('localhost', 'root', '');
    if ($temp_conn) {
        // Create database
        mysqli_query($temp_conn, "CREATE DATABASE IF NOT EXISTS unihub2");
        mysqli_select_db($temp_conn, 'unihub2');
        $conn = $temp_conn;
        
        // Create tables
        mysqli_query($conn, "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");
        
        mysqli_query($conn, "CREATE TABLE IF NOT EXISTS service_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    service_type VARCHAR(20) NOT NULL,
    topic VARCHAR(255),
    details TEXT,  
    status VARCHAR(20) DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_service_user FOREIGN KEY (user_id) REFERENCES users(id)
      ON DELETE CASCADE
      ON UPDATE CASCADE
)");
    }
}

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