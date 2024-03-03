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
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->isSMTP();
        $mail->Host       = 'smtp.sendgrid.net';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'thamapat'; // ใส่ SendGrid API Key หรือชื่อผู้ใช้ SMTP
        $mail->Password   = '123456'; // ใส่ SendGrid API Key หรือรหัสผ่าน SMTP
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        
        $email = 'Max@example.com'; // ตั้งค่า email ที่จะส่งไป

        // ตั้งค่าผู้รับและผู้ส่ง
        $mail->setFrom('$to', 'Max'); // ระบุอีเมลและชื่อของผู้ส่ง
        $mail->addAddress($email); // ระบุอีเมลของผู้รับ

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

?>
