<?php
// Start the session
session_start();
include 'smtp/Autoload.php'; // Ensure the path is correct
include 'connection.php'; // Ensure the path is correct and connection works


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Check if the email exists in the database
    $stmt = $conn->prepare("SELECT id, is_verified FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $is_verified);

    if ($stmt->fetch()) {
        if ($is_verified) {
            // Generate a random 6-digit OTP
            $otp = rand(1000, 9999);

            // Store the OTP in the session for later verification
            $_SESSION['otp'] = $otp;
            $_SESSION['user_id'] = $id;

            // Send OTP via email (use a mailer library like PHPMailer or the built-in mail function)
            $to = $email;
            $subject = "Shipet Login OTP Code";
            $message = "Your OTP code is: $otp";

            if (smtp_mailer($to, $subject, $message)) {
                // Redirect to the OTP verification page
                header("Location: verify_otp.php");
                exit();
            } else {
                $_SESSION['error'] = "Failed to send OTP. Please try again.";
                header("Location: ../pages/otp_login.php");
                exit();
            }
        } else {
            // If the user has not verified their email
            $_SESSION['error'] = "Please verify your email before logging in.";
            header("Location: ../pages/otp_login.php");
            exit();
        }
    } else {
        // If no account is found with the given email
        $_SESSION['error'] = "Account Not Found With This Email Please SignUp.";
        header("Location: ../pages/otp_login.php");
        exit();
    }

    $stmt->close();
}
$conn->close();


// SMTP mailer function
function smtp_mailer($to, $subject, $message) {
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Host = "mail.petshala.in";
    $mail->Port = 587;
    $mail->IsHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->SMTPDebug = 0; // Change to 2 for detailed debugging
    $mail->Username = "nmtc@petshala.in"; // Update with the correct SMTP username
    $mail->Password = "Nmtc@135";        // Update with the correct SMTP password
    $mail->SetFrom("nmtc@petshala.in", "Petnology Team");
    $mail->Subject = $subject;
    $mail->Body = nl2br($message); // Convert newlines to HTML line breaks
    $mail->AddAddress($to);

    // SSL options to prevent potential issues
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    if (!$mail->Send()) {
        return $mail->ErrorInfo;
    } else {
        return true;
    }
}

?>
