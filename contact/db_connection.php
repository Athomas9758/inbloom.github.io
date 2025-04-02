<?php
$host = "localhost"; // Change if necessary
$username = "root"; // Your database username
$password = ""; // Your database password
$database = "contact_db"; // Database name

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
