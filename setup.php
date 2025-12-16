<?php /*
// setup.php Run this once to create database and tables



// Connect to MySQL
$conn = mysqli_connect('localhost', 'root', '');

if (!$conn) {
    die("❌ Failed to connect to MySQL: " . mysqli_connect_error());
}


// Create database
if (mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS unihub2")) {
    echo "Database 'unihub2' created<br>";
} else {
    echo "Error creating database: " . mysqli_error($conn) . "<br>";
}

// Select database
mysqli_select_db($conn, 'unihub2');

// Create users table
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (mysqli_query($conn, $sql)) {
    echo " Users table created<br>";
} else {
    echo " Error creating users table: " . mysqli_error($conn) . "<br>";
}

// Create service_requests table
$sql = "CREATE TABLE IF NOT EXISTS service_requests (
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
)";

if (mysqli_query($conn, $sql)) {
    echo " Service requests table created<br>";
} else {
    echo " Error creating service_requests table: " . mysqli_error($conn) . "<br>";
}

mysqli_close($conn);

*/?>