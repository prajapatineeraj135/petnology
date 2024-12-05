<?php
include 'connection.php';

if (isset($_GET['code'])) {
    $verification_code = $_GET['code'];

    $stmt = $conn->prepare("SELECT id FROM users WHERE verification_code = ? AND is_verified = 0");
    $stmt->bind_param("s", $verification_code);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $update_stmt = $conn->prepare("UPDATE users SET is_verified = 1 WHERE verification_code = ?");
        $update_stmt->bind_param("s", $verification_code);

        if ($update_stmt->execute()) {
            // Redirect to the login page with a success message
            header("Location: http://localhost:3000/petnology/pages/login.php?message=verified");
            exit();
        } else {
            echo "Verification failed. Please try again.";
        }
        $update_stmt->close();
    } else {
        echo "Invalid or already used verification code.";
    }

    $stmt->close();
}
$conn->close();
?>
