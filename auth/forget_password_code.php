<?php
include 'smtp/Autoload.php';
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    
    // Check if email exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        echo "No account found with this email.";
        exit();
    }

    $user = $result->fetch_assoc();
    $user_id = $user['id'];
    $reset_token = bin2hex(random_bytes(16)); // Generate a unique token
    date_default_timezone_set('Asia/Kolkata'); // Set timezone to UTC+5:30 (Indian Standard Time)
    $expiry_time = date('Y-m-d H:i:s', strtotime('+1 hour')); // Token expires in 1 hour


    // Save token and expiry to database
    $stmt = $conn->prepare("INSERT INTO password_resets (user_id, token, expires_at) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE token = ?, expires_at = ?");
    $stmt->bind_param("issss", $user_id, $reset_token, $expiry_time, $reset_token, $expiry_time);
    if ($stmt->execute()) {
        // Send reset link
        $reset_link = "http://localhost:3000/petnology/pages/reset_password.php?token=$reset_token";
        $subject = "Password Reset Request";
        $message = "Click the link below to reset your password:\n\n$reset_link\n\nThis link will expire in 1 hour.";

        if (smtp_mailer($email, $subject, $message)) {

            header("Location: ../pages/login.php?message=mail");
            // echo "Reset link sent to your email.";
        } else {
            echo "Failed to send reset link.";
        }
    } else {
        echo "Failed to process request.";
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