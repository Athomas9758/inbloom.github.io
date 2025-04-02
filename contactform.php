<?php
// Database connection
$host = 'localhost'; // Adjust if needed
$username = 'root';  // Your DB username
$password = '';      // Your DB password
$database = 'inbloomflowershop'; // Your database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize inputs
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Insert data into the database
    $sql = "INSERT INTO contact (fullname, phoneNumber, email, message, submitDate) 
            VALUES ('$name', '$phone', '$email', '$message', NOW())";

    if ($conn->query($sql) === TRUE) {
        // Redirect to success page
        header("Location: success.php");
        exit(); // Don't forget to call exit() after redirect
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
