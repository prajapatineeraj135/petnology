<?php
// Start the session
session_start();

// Include database connection file
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
                $_SESSION['user_id'] = $id;

                // Redirect to the My Account page
                header("Location: ../pages/my_account.php");
                exit(); // Always call exit() after header to stop execution
            } else {
                // If the user has not verified their email
                $_SESSION['error'] = "Please verify your email before logging in.";
                header("Location: ../pages/login.php"); // Redirect back to login with an error
                exit();
            }
        } else {
            // If password verification fails
            $_SESSION['error'] = "Invalid password.";
            header("Location: ../pages/login.php"); // Redirect back to login with an error
            exit();
        }
    } else {
        // If no account found with the given email
        $_SESSION['error'] = "Invalid email address.";
        header("Location: ../pages/login.php"); // Redirect back to login with an error
        exit();
    }

    $stmt->close();
}
$conn->close();
?>
