<?php
require 'vendor/autoload.php'; // นำเข้าไฟล์ PHPMailer
require_once 'config.php'; // ให้แน่ใจว่าไฟล์ config.php ถูกเรียกใช้แล้ว

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
        // รับข้อมูลจากฟอร์ม HTML
        $to = $_POST['to'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        // สร้างอ็อบเจ็กต์ PHPMailer
        $mail = new PHPMailer(true);

        try {
            // ตั้งค่า SMTP
            $mail->isSMTP();
            $mail->Host = 'mailhog'; // แก้เป็นชื่อคอนเทนเนอร์ของ MailHog
            $mail->SMTPAuth = false;
            $mail->Port = 1025; // พอร์ตที่ MailHog ใช้


            // ตั้งค่าผู้รับและผู้ส่ง
            $mail->setFrom('max@example.com', 'Max');
            $mail->addAddress($to);

            // เนื้อหาอีเมลล์
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $message;

            // ส่งอีเมลล์
            $mail->send();
            echo json_encode(['message' => 'Email has been sent successfully!']);
        } catch (Exception $e) {
            echo json_encode(['error' => "Mailer Error: {$e->getMessage()}"]);
        }
    } else {
        // กระทำเมื่อไม่ได้รับ request แบบ POST
        echo json_encode(['error' => "Invalid request method"]);
    }
?>
