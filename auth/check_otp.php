<?php
// Start the session
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $otp = $_POST['otp'];

    // Check if the OTP is correct
    if ($otp == $_SESSION['otp']) {
        // OTP is correct, log the user in
        $_SESSION['user_id'] = $_SESSION['user_id'];

        // Clear OTP session data
        unset($_SESSION['otp']);

        // Redirect to the My Account page
        header("Location: ../pages/my_account.php");
        exit();
    } else {
        // If the OTP is incorrect
        $_SESSION['error'] = "Invalid OTP. Please try again.";
        header("Location: verify_otp.php");
        exit();
    }
}
?>
