<?php
// Database credentials
$servername = "localhost"; // Replace with your MySQL server address
$username = "voorivex"; // Replace with your MySQL username
$password = "voorivex123"; // Replace with your MySQL password
$database = "weblog_voorivex"; // Replace with your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // echo "Connected successfully";
    // You can perform database operations here
}

// Close connection
// $conn->close();
?>
