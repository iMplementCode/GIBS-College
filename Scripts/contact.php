<?php
/**
 * Secure Contact Form Handler
 * Protects against: SQL Injection, XSS, CSRF, Email Header Injection, Spam
 */

// Security Configuration
define('ALLOWED_ORIGIN', 'https://gibscollege.co.ke');
define('ADMIN_EMAIL', 'admin@gibscollege.co.ke');
define('SITE_NAME', 'Graphic Design Academy');
define('MAX_MESSAGE_LENGTH', 1000);
define('RATE_LIMIT_MINUTES', 5);

// Response array for AJAX
$response = ['success' => false, 'message' => ''];

// ============================================
// 1. SECURITY VALIDATIONS
// ============================================

// Check if request is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    $response['message'] = 'Method not allowed';
    sendResponse($response);
}

// Check origin (CORS protection)
$origin = $_SERVER['HTTP_ORIGIN'] ?? $_SERVER['HTTP_REFERER'] ?? '';
if (!empty($origin) && strpos($origin, parse_url(ALLOWED_ORIGIN, PHP_URL_HOST)) === false) {
    http_response_code(403);
    $response['message'] = 'Invalid origin';
    sendResponse($response);
}

// CSRF Token Validation
session_start();
if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
    http_response_code(403);
    $response['message'] = 'Security token validation failed. Please refresh the page.';
    sendResponse($response);
}

// Rate Limiting (prevent spam)
$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$rateFile = sys_get_temp_dir() . '/contact_rate_' . md5($ip) . '.txt';
$now = time();

if (file_exists($rateFile)) {
    $lastSubmit = (int)file_get_contents($rateFile);
    if (($now - $lastSubmit) < (RATE_LIMIT_MINUTES * 60)) {
        http_response_code(429);
        $response['message'] = 'Please wait ' . RATE_LIMIT_MINUTES . ' minutes before submitting again.';
        sendResponse($response);
    }
}

// ============================================
// 2. INPUT VALIDATION & SANITIZATION
// ============================================

// Required fields
$required = ['name', 'phone', 'course'];
foreach ($required as $field) {
    if (empty($_POST[$field])) {
        $response['message'] = ucfirst($field) . ' is required';
        sendResponse($response);
    }
}

// Sanitize inputs
$name = sanitizeName($_POST['name'] ?? '');
$phone = sanitizePhone($_POST['phone'] ?? '');
$course = sanitizeString($_POST['course'] ?? '');
$message = sanitizeMessage($_POST['message'] ?? '');

// Validate name (2-50 chars, letters and spaces only)
if (!preg_match('/^[a-zA-Z\s\.\-]{2,50}$/', $name)) {
    $response['message'] = 'Please enter a valid name (2-50 characters, letters only)';
    sendResponse($response);
}

// Validate phone (international format)
$phone = preg_replace('/[^\d\+]/', '', $phone);
if (!preg_match('/^\+?[\d\s\-\(\)]{10,20}$/', $phone)) {
    $response['message'] = 'Please enter a valid phone number';
    sendResponse($response);
}

// Validate course against whitelist
$validCourses = [
    'diploma' => 'Diploma in Graphic Design (2 Years)',
    'certificate' => 'Certificate in Graphic Design (1 Year)',
    'coreldraw' => 'CorelDraw (3 Months)',
    'photoshop' => 'Adobe Photoshop (3 Months)',
    'illustrator' => 'Adobe Illustrator (3 Months)',
    'indesign' => 'Adobe InDesign (3 Months)',
    'packages' => 'Computer Packages (1-3 Months)'
];

if (!array_key_exists($course, $validCourses)) {
    $response['message'] = 'Invalid course selection';
    sendResponse($response);
}
$courseName = $validCourses[$course];

// ============================================
// 3. HONEYPOT SPAM CHECK (Hidden field)
// ============================================

if (!empty($_POST['website'])) { // Honeypot field should be empty
    http_response_code(400);
    $response['message'] = 'Spam detected';
    sendResponse($response);
}

// ============================================
// 4. SEND EMAIL
// ============================================

// Build email content
$emailSubject = 'New Course Inquiry: ' . $courseName;
$emailBody = formatEmailBody($name, $phone, $courseName, $message);
$headers = buildSecureHeaders();

// Send email
if (mail(ADMIN_EMAIL, $emailSubject, $emailBody, $headers)) {
    // Update rate limit
    file_put_contents($rateFile, $now);
    
    // Optional: Log to database (create table first)
    // logToDatabase($name, $phone, $course, $message, $ip);
    
    $response['success'] = true;
    $response['message'] = 'Thank you! Your message has been sent. We will contact you soon.';
} else {
    http_response_code(500);
    $response['message'] = 'Failed to send message. Please try again later or contact us directly.';
}

sendResponse($response);

// ============================================
// HELPER FUNCTIONS
// ============================================

function sanitizeName($str) {
    return htmlspecialchars(trim(preg_replace('/[^a-zA-Z\s\.\-]/', '', $str)), ENT_QUOTES, 'UTF-8');
}

function sanitizePhone($str) {
    return htmlspecialchars(trim(preg_replace('/[^\d\+\-\(\)\s]/', '', $str)), ENT_QUOTES, 'UTF-8');
}

function sanitizeString($str) {
    return htmlspecialchars(trim($str), ENT_QUOTES, 'UTF-8');
}

function sanitizeMessage($str) {
    $str = substr(trim($str), 0, MAX_MESSAGE_LENGTH);
    return htmlspecialchars(strip_tags($str), ENT_QUOTES, 'UTF-8');
}

function buildSecureHeaders() {
    $from = 'noreply@' . parse_url(ALLOWED_ORIGIN, PHP_URL_HOST);
    $headers = "From: " . $from . "\r\n";
    $headers .= "Reply-To: " . ADMIN_EMAIL . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    
    // Prevent header injection
    $headers = str_replace(["\r\n\r\n", "\n\n"], "\r\n", $headers);
    
    return $headers;
}

function formatEmailBody($name, $phone, $course, $message) {
    $date = date('F j, Y, g:i a');
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    
    return <<<HTML
    <!DOCTYPE html>
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            h2 { color: #2c3e50; border-bottom: 2px solid #3498db; padding-bottom: 10px; }
            .field { margin-bottom: 15px; }
            .label { font-weight: bold; color: #555; }
            .value { background: #f4f4f4; padding: 8px; border-radius: 4px; margin-top: 5px; }
            .meta { font-size: 12px; color: #777; margin-top: 20px; border-top: 1px solid #ddd; padding-top: 10px; }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>📚 New Course Inquiry Received</h2>
            
            <div class="field">
                <div class="label">Full Name:</div>
                <div class="value">{$name}</div>
            </div>
            
            <div class="field">
                <div class="label">Phone Number:</div>
                <div class="value">{$phone}</div>
            </div>
            
            <div class="field">
                <div class="label">Course of Interest:</div>
                <div class="value">{$course}</div>
            </div>
            
            <div class="field">
                <div class="label">Message:</div>
                <div class="value">{$message}</div>
            </div>
            
            <div class="meta">
                <strong>Submission Details:</strong><br>
                Date: {$date}<br>
                IP Address: {$ip}
            </div>
        </div>
    </body>
    </html>
    HTML;
}

function sendResponse($response) {
    header('Content-Type: application/json');
    header('X-Content-Type-Options: nosniff');
    echo json_encode($response);
    exit;
}

// Optional: Database logging function (uncomment to use)
/*
function logToDatabase($name, $phone, $course, $message, $ip) {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=your_db', 'username', 'password');
        $stmt = $pdo->prepare("INSERT INTO inquiries (name, phone, course, message, ip_address, created_at) 
                              VALUES (?, ?, ?, ?, ?, NOW())");
        $stmt->execute([$name, $phone, $course, $message, $ip]);
    } catch (PDOException $e) {
        error_log("Database logging failed: " . $e->getMessage());
    }
}
*/