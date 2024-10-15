<?php
session_start();

// Include Composer's autoloader
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize the email input
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    if (!$email) {
        echo "Invalid email address. Please enter a valid email.";
        exit;
    }

    // Generate random OTP (e.g., 6-digit code)
    $otp = mt_rand(100000, 999999); // Generate random 6-digit OTP

    // Store the OTP in a session or database (for verification later)
    $_SESSION['otp'] = $otp;
    $_SESSION['email'] = $email;

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true); // Set 'true' to enable exceptions

    try {
        // SMTP settings (for example, using Gmail SMTP)
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'akeelwani084@gmail.com'; // Your Gmail username
        $mail->Password = 'rnvxetetmqqehgsf'; // Your Gmail password
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption
        $mail->Port = 587; // TCP port to connect to

        // Sender and recipient
        $mail->setFrom('akeelwani084@gmail.com', 'Akeel Ahmad Wani');
        $mail->addAddress($email); // Recipient's email address

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset OTP';
        $mail->Body = 'Dear User,<br><br>'
                      . 'Your OTP for password reset is: <strong>' . $otp . '</strong><br><br>'
                      . 'Please use this OTP to reset your password.<br><br>'
                      . 'If you did not request a password reset, please ignore this email.<br><br>'
                      . 'Best regards,<br>'
                      . 'Your Website Team';

        // Send email
        if ($mail->send()) {
            // Redirect to OTP entry form
            header("Location: verify_otp.php");
            exit;
        } else {
            echo 'Failed to send OTP. Please try again.';
        }
    } catch (Exception $e) {
        echo 'Email could not be sent. Error: ', $mail->ErrorInfo;
    }
} else {
    // Redirect to the forgot password page if accessed directly
    header("Location: forgot.html");
    exit;
}
?>
