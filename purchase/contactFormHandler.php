<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    function sanitizeInput($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    // Retrieve form data
    $name    = sanitizeInput($_POST['name']);
    $email   = sanitizeInput($_POST['email']);
    $message = sanitizeInput($_POST['message']);

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

    // If there are errors, display them and stop execution
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
        echo "<a href='contact.html'>Go Back</a>";
        exit();
    }

    // Database connection settings
    $host     = 'localhost';    // or your host
    $dbname   = 'your_database'; // change to your database name
    $username = 'your_username'; // change to your username
    $password = 'your_password'; // change to your password

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insert the message into the database using a prepared statement
        $stmt = $pdo->prepare("INSERT INTO contact_messages (name, email, message) VALUES (:name, :email, :message)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':message', $message);

        $stmt->execute();

    } catch (PDOException $e) {
        echo "<p style='color: red;'>Database error: " . $e->getMessage() . "</p>";
        exit();
    }

    // Email details (update to your actual email)
    $to      = "hello@inbloom.com";
    $subject = "New Contact Form Submission";
    $headers = "From: $email\r\nReply-To: $email\r\nContent-Type: text/plain; charset=UTF-8";

    $emailBody = "You have received a new message from your website contact form.\n\n";
    $emailBody .= "Name: $name\n";
    $emailBody .= "Email: $email\n";
    $emailBody .= "Message:\n$message\n";

    // Send email (ensure your server is configured to send email)
    if (mail($to, $subject, $emailBody, $headers)) {
        echo "<p style='color: green;'>Message sent and saved successfully!</p>";
    } else {
        echo "<p style='color: red;'>Message saved, but there was an error sending the email.</p>";
    }

    echo "<a href='contact.html'>Go Back</a>";
}
?>

