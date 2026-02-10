<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require __DIR__ . '/PHPMailer/src/Exception.php';
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';


$mail = new PHPMailer(true);

try {
    // Enable verbose debug output
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    
    // CONFIGURATION 1: Try this first
    $mail->Host       = 'mail.gibscollege.co.ke';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'noreply@gibscollege.co.ke';
    $mail->Password   = '7^!]L)Y+}6}*';  // ← Add your password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;
    
    // Recipients
    $mail->setFrom('noreply@gibscollege.co.ke', 'GIBS Test');
    $mail->addAddress('info@gibscollege.co.ke');  // Your receiving email
    
    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Test Email from GIBS College';
    $mail->Body    = '<h1>This is a test email</h1><p>If you receive this, email is working!</p>';
    
    $mail->send();
    echo '<br><br><strong style="color: green;">SUCCESS! Email sent successfully!</strong>';
    
} catch (Exception $e) {
    echo "<br><br><strong style='color: red;'>FAILED!</strong><br>";
    echo "Error: {$mail->ErrorInfo}";
}
?>