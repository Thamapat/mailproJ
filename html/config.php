<?php

// ตรวจสอบว่าคลาส PHPMailer ถูกโหลดเข้ามาหรือไม่
if (!class_exists(PHPMailer\PHPMailer\PHPMailer::class)) {
    echo 'Error: PHPMailer class not found. Make sure to run composer install.';
    exit;
}

// ตรวจสอบว่าไฟล์ autoload.php ถูกโหลดเข้ามาหรือไม่
if (!file_exists('vendor/autoload.php')) {
    echo 'Error: autoload.php not found. Make sure to run composer install.';
    exit;
}

// Include PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// ตั้งค่า PHPMailer
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;  // Enable verbose debug output
    $mail->isSMTP();  // Send using SMTP
    $mail->Host       = 'smtp.sendgrid.net';  // Set the SMTP server to send through (SendGrid)
    $mail->SMTPAuth   = true;  // Enable SMTP authentication
    $mail->Username   = 'thamapat';  // SMTP username (SendGrid API Key)
    $mail->Password   = '123456';  // SMTP password (SendGrid API Key)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` discouraged
    $mail->Port       = 587;  // TCP port to connect to

    // Recipients
    $mail->setFrom('your_email@example.com', 'Your Name');
    $mail->addAddress('recipient@example.com', 'Recipient Name');

    // Content
    $mail->isHTML(true);  // Set email format to HTML

    // Subject
    $mail->Subject = 'Subject of the Email';

    // Body
    $mail->Body = 'This is the HTML message body <b>in bold!</b>';

    // AltBody
    $mail->AltBody = 'This is the plain text version of the email content';

    // Send the email
    $mail->send();

    echo "Message has been sent successfully!";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

