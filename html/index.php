<?php

require 'config.php';

try {
    // Content
    $mail->Subject = 'Hello from Docker!';
    $mail->Body    = 'This is a test email from Docker.';

    // Send the email
    $mail->send();
    echo 'Email has been sent successfully.';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}