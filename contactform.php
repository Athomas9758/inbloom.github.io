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

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Function to sanitize input
function prepare_string($dbc, $string) {
    return mysqli_real_escape_string($dbc, trim($string));
}

// Validation functions
function is_fullname_valid($fullname) {
    return preg_match("/^[a-zA-Z\s]+$/", $fullname);
}

function is_email_valid($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function is_phone_valid($phone) {
    return preg_match("/^\d{3}-\d{3}-\d{4}$/", $phone);
}

function is_message_valid($message) {
    return !empty(trim($message));
}

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize inputs
    $fullname = isset($_POST['fullname']) ? prepare_string($conn, $_POST['fullname']) : '';
    $phone = isset($_POST['phone']) ? prepare_string($conn, $_POST['phone']) : '';
    $email = isset($_POST['email']) ? prepare_string($conn, $_POST['email']) : '';
    $message = isset($_POST['message']) ? prepare_string($conn, $_POST['message']) : '';

    // Validate inputs
    if (!is_fullname_valid($fullname)) {
        $errors[] = "*Please enter your full name*<br>";
    }
    if (!is_phone_valid($phone)) {
        $errors[] = "*Please enter a valid phone number (Format: 123-456-7890)*. <br>";
    }
    if (!is_email_valid($email)) {
        $errors[] = "*Please enter a valid email address* <br>";
    }
    if (!is_message_valid($message)) {
        $errors[] = "*Please write a message*<br>";
    }

    // Display errors if there are any
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<b>$error</b>";
        }
    } else {
        // Insert data into the database
        $sql = "INSERT INTO contact (fullname, phoneNumber, email, message, submitDate) 
                VALUES ('$fullname', '$phone', '$email', '$message', NOW())";

        if ($conn->query($sql) === TRUE) {
            // Redirect to success page
            header("Location: success.php");
            exit();
        } else {
            echo "<b>Please try again later.</b>";
        }
    }
}

// Close the connection
$conn->close();
?>
