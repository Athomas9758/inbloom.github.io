<?php
session_start();

// Sanitize input data
function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Retrieve form data
$name = sanitizeInput($_POST['name'] ?? '');
$email = sanitizeInput($_POST['email'] ?? '');
$message = sanitizeInput($_POST['message'] ?? '');

// Validation
$errors = [];

if (empty($name)) {
    $errors[] = "Name is required.";
}

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "A valid email is required.";
}

if (empty($message)) {
    $errors[] = "Message cannot be empty.";
}

// If there are errors, send back to form
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: contact.html");
    exit();
}

// Database connection settings
$host = 'localhost'; // Change if needed
$dbname = 'your_database'; // Change this
$username = 'your_username'; // Change this
$password = 'your_password'; // Change this

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Insert into database
    $stmt = $pdo->prepare("INSERT INTO contact_messages (name, email, message) VALUES (:name, :email, :message)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':message', $message);
    $stmt->execute();

} catch (PDOException $e) {
    $_SESSION['errors'][] = "Database error: " . $e->getMessage();
    header("Location: contact.html");
    exit();
}

// Email details
$to = "hello@inbloom.com";
$subject = "New Contact Form Submission";
$headers = "From: $email\r\nReply-To: $email\r\nContent-Type: text/plain; charset=UTF-8";

$emailBody = "You have received a new message from your website contact form.\n\n";
$emailBody .= "Name: $name\n";
$emailBody .= "Email: $email\n";
$emailBody .= "Message:\n$message\n";

// Send email
if (mail($to, $subject, $emailBody, $headers)) {
    $_SESSION['success'] = "Message sent successfully!";
} else {
    $_SESSION['errors'][] = "Message saved, but there was an error sending the email.";
}

header("Location: contact.html");
exit();
?>


