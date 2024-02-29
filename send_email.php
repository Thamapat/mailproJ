<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับข้อมูลจากฟอร์ม HTML
    $to = $_POST['to'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // สร้างอ็อบเจ็กต์ PHPMailer
    $mail = new PHPMailer(true);

    try {
        // ตั้งค่า SMTP
        $mail->isSMTP();
        $mail->Host = 'localhost'; // หรือ IP ของ MailHog ถ้าไม่ได้ใช้ localhost
        $mail->SMTPAuth = false;
        $mail->Port = 1025; // พอร์ตที่ MailHog ใช้

        // ตั้งค่าผู้รับและผู้ส่ง
        $mail->setFrom('your_email@example.com', 'Your Name');
        $mail->addAddress($to);

        // เนื้อหาอีเมลล์
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;

        // ส่งอีเมลล์
        $mail->send();
        echo 'Email has been sent successfully!';
    } catch (Exception $e) {
        echo "Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
