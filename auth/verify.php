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
            echo "Your email has been verified. You can now log in.";
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
