<?php
include 'smtp/Autoload.php'; // Ensure the path is correct
include 'connection.php'; // Ensure the path is correct and connection works

// Signup logic
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Secure password
    $verification_code = bin2hex(random_bytes(16)); // Generate a unique verification code

    // Check if email already exists
    $email_check = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $email_check->bind_param("s", $email);
    $email_check->execute();
    $email_check->store_result();

    if ($email_check->num_rows > 0) {
        echo "Email already registered. Please login.";
        $email_check->close();
        exit();
    }

    // Insert user into database
    $stmt = $conn->prepare("INSERT INTO users (name, contact, email, password, verification_code) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $contact, $email, $password, $verification_code);

    if ($stmt->execute()) {
        // Send verification email
        $verification_link = "http://localhost:3000/petnology/auth/verify.php?code=$verification_code";
        $subject = "Email Verification";
        $message = "Click the link below to verify your email:\n\n$verification_link";

        if (smtp_mailer($email, $subject, $message)) {
            echo "Signup successful! Please check your email to verify your account.";
        } else {
            echo "Failed to send verification email.";
        }
    } else {
        echo "Signup failed. Please try again.";
    }

    $stmt->close();
    $email_check->close();
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
