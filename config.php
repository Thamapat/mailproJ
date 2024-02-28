<?php

// Include PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// PHPMailer configuration
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;  // Enable verbose debug output
    $mail->isSMTP();  // Send using SMTP
    $mail->Host       = 'smtp.sendgrid.net';  // Set the SMTP server to send through (SendGrid)
    $mail->SMTPAuth   = true;  // Enable SMTP authentication
    $mail->Username   = 'your_sendgrid_username';  // SMTP username (SendGrid API Key)
    $mail->Password   = 'your_sendgrid_password';  // SMTP password (SendGrid API Key)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` discouraged
    $mail->Port       = 587;  // TCP port to connect to

    // Recipients
    $mail->setFrom('your_email@example.com', 'Your Name');
    $mail->addAddress('recipient@example.com', 'Recipient Name');

    // Content
    $mail->isHTML(true);  // Set email format to HTML

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
