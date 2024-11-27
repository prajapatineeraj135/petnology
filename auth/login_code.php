<?php
session_start(); // Start the session
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to fetch user details
    $stmt = $conn->prepare("SELECT id, password, is_verified FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $hashed_password, $is_verified);

    if ($stmt->fetch()) {
        // Verify password
        if (password_verify($password, $hashed_password)) {
            if ($is_verified) {
                // Store user ID in session
                $_SESSION['id'] = $id;

                // Redirect to user panel or dashboard
                echo "Login successful. Redirecting...";
                header("Location: ../pages/my_account.php");
                exit();
            } else {
                echo "Please verify your email before logging in.";
            }
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No account found with this email.";
    }

    $stmt->close();
}
$conn->close();
?>
