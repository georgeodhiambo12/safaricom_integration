<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "Verification script is accessible!";

if (isset($_GET['code'])) {
    $verification_code = $_GET['code'];
    echo "<br>Verification code: $verification_code<br>";

    // Connect to the database
    $conn = new mysqli('localhost', 'tenderso_users', '@TenderSoko2024', 'tenderso_MINI_APP');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    echo "Database connection successful!<br>";

    // Prepare and bind
    $stmt = $conn->prepare('UPDATE users SET verified = 1 WHERE verification_code = ?');
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    echo "Statement prepared successfully!<br>";

    $stmt->bind_param('s', $verification_code);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo 'Email verified successfully. You can now login.';
        } else {
            echo 'Invalid verification link or email already verified.';
        }
    } else {
        echo 'Error executing query: ' . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo 'No verification code provided.';
}
?>
