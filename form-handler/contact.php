<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require __DIR__ . '/../PHPMailer/src/Exception.php';
require __DIR__ . '/../PHPMailer/src/PHPMailer.php';
require __DIR__ . '/../PHPMailer/src/SMTP.php';

// CSRF Token Generation (should be in your main index.php before the form)
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Check if Request Method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Debugging: check for empty POST data (common issue with redirects)
    if (empty($_POST)) {
        // Try reading raw input in case JSON was sent or Content-Type mismatch
        $rawInput = file_get_contents("php://input");
        if (!empty($rawInput)) {
            // Attempt to decode JSON if applicable
            $json = json_decode($rawInput, true);
            if (is_array($json)) {
                $_POST = $json;
            } else {
                // Log raw input for debugging
                error_log("Raw input received in contact.php: " . substr($rawInput, 0, 100) . "...");
            }
        } else {
            // Both are empty - likely a redirect issue (HTTP -> HTTPS) or max_post_size exceeded
            error_log("Empty POST data received in contact.php. Possible redirect or size limit issue.");
            $_SESSION['status'] = "Error: No data received. Please ensure you are not being redirected (e.g. check your URL bar for https).";
            header("Location: " . ($_SERVER['HTTP_REFERER'] ?? '../index.php'));
            exit();
        }
    }

    // 2. CSRF TOKEN VALIDATION
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        // Allow a grace period or check if session expired, but for now strict check
        // Check if token was even sent
        if (!isset($_POST['csrf_token'])) {
             error_log("CSRF token missing in POST request.");
        } else {
             error_log("CSRF token mismatch.");
        }
        die('Invalid CSRF token. Please refresh the page and try again.');
    }
    
    // 3. HONEYPOT CHECK (spam bot detection)
    if (!empty($_POST['website'])) {
        // Bot detected - silently fail
        $_SESSION['status'] = "Message has been sent successfully.";
        header("Location: " . ($_SERVER['HTTP_REFERER'] ?? '../index.php'));
        exit();
    }
    
    // 4. SANITIZE AND VALIDATE INPUTS
    $fullname = htmlspecialchars(trim($_POST['name'] ?? ''), ENT_QUOTES, 'UTF-8');
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(trim($_POST['phone'] ?? ''), ENT_QUOTES, 'UTF-8');
    $course = htmlspecialchars(trim($_POST['course'] ?? ''), ENT_QUOTES, 'UTF-8');
    $message = htmlspecialchars(trim($_POST['message'] ?? ''), ENT_QUOTES, 'UTF-8');
    
    // 5. ERROR HANDLING - Empty fields
    if (empty($fullname) || empty($email) || empty($phone) || empty($course) || empty($message)) {
        $_SESSION['status'] = "All fields are required.";
        header("Location: " . ($_SERVER['HTTP_REFERER'] ?? '../index.php'));
        exit();
    }
    
    // 6. VALIDATE EMAIL
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['status'] = "Invalid email format.";
        header("Location: " . ($_SERVER['HTTP_REFERER'] ?? '../index.php'));
        exit();
    }
    
    // 7. VALIDATE PHONE NUMBER
    if (!preg_match('/^\+?[0-9]{7,15}$/', $phone)) {
        $_SESSION['status'] = "Invalid phone number format.";
        header("Location: " . ($_SERVER['HTTP_REFERER'] ?? '../index.php'));
        exit();
    }
    
    // 8. VALIDATE COURSE SELECTION
    $valid_courses = [
        'diploma' => 'Diploma in Graphic Design (2 Years)',
        'certificate' => 'Certificate in Graphic Design (1 Year)',
        'coreldraw' => 'CorelDraw (3 Months)',
        'photoshop' => 'Adobe Photoshop (3 Months)',
        'illustrator' => 'Adobe Illustrator (3 Months)',
        'indesign' => 'Adobe InDesign (3 Months)',
        'packages' => 'Computer Packages (1-3 Months)'
    ];
    
    if (!array_key_exists($course, $valid_courses)) {
        $_SESSION['status'] = "Invalid course selection.";
        header("Location: " . ($_SERVER['HTTP_REFERER'] ?? '../index.php'));
        exit();
    }
    
    // Get full course name
    $courseName = $valid_courses[$course];
    
    // 9. VALIDATE MESSAGE LENGTH
    if (strlen($message) > 1000) {
        $_SESSION['status'] = "Message is too long. Please limit to 1000 characters.";
        header("Location: " . ($_SERVER['HTTP_REFERER'] ?? '../index.php'));
        exit();
    }
    
    // 10. RATE LIMITING (prevent spam)
    $rate_limit_key = 'last_submission_time';
    $min_interval = 60; // seconds between submissions
    
    if (isset($_SESSION[$rate_limit_key])) {
        $time_since_last = time() - $_SESSION[$rate_limit_key];
        if ($time_since_last < $min_interval) {
            $_SESSION['status'] = "Please wait " . ($min_interval - $time_since_last) . " seconds before submitting again.";
            header("Location: " . ($_SERVER['HTTP_REFERER'] ?? '../index.php'));
            exit();
        }
    }
    
    // 11. SEND EMAIL USING PHPMAILER
    // Create PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF; 
        $mail->isSMTP();
        $mail->Host       = 'mail.gibscollege.co.ke'; 
        $mail->SMTPAuth   = true;
        $mail->Username   = 'noreply@gibscollege.co.ke';
        $mail->Password   = '7^!]L)Y+}6}*';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        $mail->CharSet    = 'UTF-8';
        
        // Recipients
        $mail->setFrom('noreply@gibscollege.co.ke', 'GIBS College Website');
        $mail->addAddress('info@gibscollege.co.ke', 'GIBS College Info');
      
        
        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Inquiry from GIBS College Website';
        
        // Email body
        $mail->Body = '
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background-color: #4CAF50; color: white; padding: 20px; text-align: center; }
                .content { background-color: #f9f9f9; padding: 20px; border: 1px solid #ddd; }
                .field { margin-bottom: 15px; }
                .label { font-weight: bold; color: #555; }
                .value { color: #000; margin-left: 10px; }
                .footer { text-align: center; padding: 10px; font-size: 12px; color: #777; }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <h2>New Inquiry from GIBS College Website</h2>
                </div>
                <div class="content">
                    <div class="field">
                        <span class="label">Full Name:</span>
                        <span class="value">' . $fullname . '</span>
                    </div>
                    <div class="field">
                        <span class="label">Email Address:</span>
                        <span class="value">' . $email . '</span>
                    </div>
                    <div class="field">
                        <span class="label">Phone Number:</span>
                        <span class="value">' . $phone . '</span>
                    </div>
                    <div class="field">
                        <span class="label">Course of Interest:</span>
                        <span class="value">' . $courseName . '</span>
                    </div>
                    <div class="field">
                        <span class="label">Message:</span>
                        <div class="value" style="white-space: pre-wrap;">' . nl2br($message) . '</div>
                    </div>
                    <div class="field">
                        <span class="label">Submitted:</span>
                        <span class="value">' . date('F j, Y, g:i a') . '</span>
                    </div>
                </div>
                <div class="footer">
                    <p>This message was sent from the GIBS College website contact form.</p>
                </div>
            </div>
        </body>
        </html>';
        
        // Plain text version for email clients that don't support HTML
        $mail->AltBody = "New Inquiry from GIBS College Website\n\n" .
                         "Full Name: $fullname\n" .
                         "Email: $email\n" .
                         "Phone: $phone\n" .
                         "Course: $courseName\n" .
                         "Message: $message\n\n" .
                         "Submitted: " . date('F j, Y, g:i a');
        
        // Send email
        $mail->send();
        
        // Update rate limiting timestamp
        $_SESSION[$rate_limit_key] = time();
        
        // Regenerate CSRF token after successful submission
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        
        $_SESSION['status'] = "Thank you for contacting us! We will get back to you soon.";
        header("Location: " . ($_SERVER['HTTP_REFERER'] ?? '../index.php'));
        exit();
        
    } catch (Exception $e) {
        // Log error (in production, use proper error logging)
        error_log("PHPMailer Error: {$mail->ErrorInfo}");
        
        $_SESSION['status'] = "Mailer Error: " . $mail->ErrorInfo;
        header("Location: " . ($_SERVER['HTTP_REFERER'] ?? '../index.php'));
        exit();
    }
    
} else {
    // Direct access without form submission
    header("Location: ../index.php");
    exit();
}
?>