<?php
// Load Composer's autoloader
require 'vendor/autoload.php';

// Include PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับข้อมูลจากฟอร์ม HTML
    $name = $_POST['name'];
    $email = $_POST['email'];
    $to = $_POST['to'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // ตั้งค่า PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'mailhog';
        $mail->Port = 587;
        $mail->SMTPSecure = false;
        $mail->SMTPAuth   = false;
        $mail->SMTPSecure = false;
        

        // ตั้งค่าผู้รับและผู้ส่ง
        $mail->setFrom($email, $name); // ระบุอีเมลและชื่อของผู้ส่ง
        $mail->addAddress($to); // ระบุอีเมลของผู้รับ

        // Content
        $mail->isHTML(false); 
        $mail->Subject = $subject; // หัวเรื่อง
        $mail->Body = $message; // ข้อความที่ระบุ

        // Send the email
        $mail->send();

        echo "Message has been sent successfully!";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
