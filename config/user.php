<?php
if (!defined('ABSPATH')) {
    require_once 'config.php'; 
    header("Location: " . HOMEPAGE_URL); // Redirect to the homepage
    exit; // Stop further execution
}

require_once 'config/config.php'; // Include your config file
require_once 'models/Database.php'; // Include the Database model

require_once __DIR__ . '/../vendor/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../vendor/PHPMailer/src/SMTP.php';
require_once __DIR__ . '/../vendor/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function loginUser($email, $password) {
    // Initialize database connection
    $dzyns_database = new Dzyns_Database();
    $dzyns_db = $dzyns_database->dzyns_getConnection();

    // Prepare SQL statement to prevent SQL injection
    $stmt = $dzyns_db->prepare("SELECT * FROM " . PREFIX . "users WHERE email = :email");
    $stmt->execute(['email' => $email]);

    // Fetch user record
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if user exists
    if ($user) {
        // Check if user_activation_time is set and if it's in the future
        if (!is_null($user['user_activation_time'])) {
            $current_time = new DateTime();
            $activation_time = new DateTime($user['user_activation_time']);
            $interval = $current_time->diff($activation_time);

            // If current time is less than user_activation_time, deny login
            if ($current_time < $activation_time) {
                $minutes_left = $interval->i; // Get minutes
                $seconds_left = $interval->s; // Get seconds
            
                return "Your account is locked. Please try again after {$minutes_left} minutes and {$seconds_left} seconds.";     
            }
        }

        // Verify password
        if (hash('sha1', $password) === $user['password']) {
            // Successful login
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];

            // Update last login details
            $update_stmt = $dzyns_db->prepare("
                UPDATE " . PREFIX . "users 
                SET last_login = NOW(), 
                    last_login_ip = :last_login_ip, 
                    last_login_browser = :last_login_browser, 
                    failed_login_attempt = 0,
                    user_activation_time = NULL -- Reset activation time on successful login
                WHERE id = :id
            ");
            $update_stmt->execute([
                'last_login_ip' => $_SERVER['REMOTE_ADDR'],
                'last_login_browser' => $_SERVER['HTTP_USER_AGENT'],
                'id' => $user['id']
            ]);

            return true; // Login successful
        } else {
            // Failed login attempt
            incrementFailedLoginAttempts($dzyns_db, $email); // Pass email to increment failed attempts
            return "Invalid email or password"; // Invalid password
        }
    } else {
        return "Invalid email or password"; // User not found
    }
}


function incrementFailedLoginAttempts($dzyns_db, $email) {
    // Step 1: Prepare SQL statement to fetch the user by email
    $stmt = $dzyns_db->prepare("SELECT * FROM " . PREFIX . "users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Debug: Output user data if fetched
    if (!$user) {
        echo "User not found.";
        return;
    }

    print_r($user);

    // Step 2: Initialize variables from the user data
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $failed_login_attempt = (int)$user['failed_login_attempt'];
    $failed_attempts_count = (int)$user['failed_attempts_count'];

    // By default, set activation time to NULL
    $user_activation_time = null;

    // Step 3: Check if failed attempts have reached 5 or more
    if ($failed_login_attempt >= 5) {
        // Reset failed_login_attempt to 0 and increment failed_attempts_count by +1
        $failed_login_attempt = 0;
        $failed_attempts_count++;
        
        // Step 4: Set user_activation_time to current time + 15 minutes
        $user_activation_time = date('Y-m-d H:i:s', strtotime('+15 minutes'));
    } else {
        // Otherwise, increment failed_login_attempt by +1
        $failed_login_attempt++;
    }

    // Step 5: Prepare SQL statement to update the user record
    $update_failed_stmt = $dzyns_db->prepare("
        UPDATE " . PREFIX . "users 
        SET failed_login_attempt = :failed_login_attempt,
            failed_attempts_count = :failed_attempts_count, 
            failed_login_attempt_ip = :failed_login_attempt_ip, 
            failed_login_attempt_time = NOW(),
            user_activation_time = :user_activation_time
        WHERE id = :id
    ");

    // Step 6: Bind parameters based on whether `user_activation_time` is set or not
    $params = [
        'failed_login_attempt' => $failed_login_attempt,
        'failed_attempts_count' => $failed_attempts_count,
        'failed_login_attempt_ip' => $ip_address,
        'id' => $user['id']
    ];

    // Include user_activation_time in params only if it's not null
    if ($user_activation_time !== null) {
        $params['user_activation_time'] = $user_activation_time;
    } else {
        // If activation time is null, set it explicitly
        $params['user_activation_time'] = null;
    }

    // Step 7: Execute the update statement with correct parameters
    $update_success = $update_failed_stmt->execute($params);

    // Debug: Check if the update was successful
    if ($update_success) {
        echo "Record updated successfully.";
    } else {
        echo "Failed to update record.";
    }
}



function verifyCaptcha($captchaResponse) {
    $secretKey = SETTINGS_GOOGLESECRETKEY; // Replace with your reCAPTCHA secret key
    $verifyUrl = "https://www.google.com/recaptcha/api/siteverify";
    
    // Prepare the request
    $response = file_get_contents($verifyUrl . '?secret=' . $secretKey . '&response=' . $captchaResponse);
    $responseData = json_decode($response);
    
    return $responseData->success;
}



////
function generateOTP() {
    return rand(100000, 999999); // 6 digit OTP
}

// Store OTP in the database for the user (only if not set already)
function storeOTP($email, $otp) {
    try {
        // Instantiate database connection
        $dzyns_database = new Dzyns_Database();
        $dzyns_db = $dzyns_database->dzyns_getConnection();

        // Set an expiration time for the OTP (e.g., 10 minutes)
        $expiration_time = (new DateTime())->add(new DateInterval('PT10M'))->format('Y-m-d H:i:s');

        // Prepare the SQL query to update OTP and expiration time
        $stmt = $dzyns_db->prepare("UPDATE dz20_yns_users SET email_code = :otp, email_code_expires_at = :otp_expiration WHERE email = :email");

        // Execute the query
        $stmt->execute([
            'otp' => $otp,
            'otp_expiration' => $expiration_time,
            'email' => $email
        ]);

        // Check if the query affected any rows (meaning update was successful)
        if ($stmt->rowCount() > 0) {
            return true; // OTP stored successfully
        } else {
            throw new Exception("Failed to update OTP in the database or user not found.");
        }
    } catch (Exception $e) {
        // Log the error and return false
        error_log("Error in storeOTP: " . $e->getMessage());
        return false;
    }
}

// Send OTP email using PHPMailer
function sendOTPEmail($email, $otp) {
    $subject = "Your 2FA Code";
    $body = "Your one-time password (OTP) for logging into your account is: <strong>$otp</strong><br><br>This code will expire in 10 minutes.";
    
    $mail = new PHPMailer(true);

    try {
        // Server settings
       // $mail->isSMTP();
        $mail->Host = 'mail.codepixelz.tech'; // SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'utsav@codepixelz.tech'; // SMTP username
        $mail->Password = 'Lq10427@'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('utsav@codepixelz.tech', 'Utsav');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AltBody = "Your one-time password (OTP) for logging into your account is: $otp. This code will expire in 10 minutes.";

        // Send the email
        $mail->send();

        // Now update the OTP in the database after email is sent
        if (storeOTP($email, $otp)) {
            $_SESSION['success_otp_resend'] = 'OTP has been resent to your email!';
        } else {
            $_SESSION['success_otp_resend'] = 'Failed to update OTP in the database!';
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}



//// forget password

// Function to generate a random password
function generateRandomPassword($length = 10) {
    // Define the characters to be used in the password
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+-=';
    
    // Shuffle and generate the password
    return substr(str_shuffle(str_repeat($characters, ceil($length / strlen($characters)))), 0, $length);
}
// Function to send a new password to the user's email
function sendNewPasswordEmail($email, $newPassword) {
    $mail = new PHPMailer(true);
    try {
        // SMTP server configuration
        //$mail->isSMTP();
        $mail->Host = 'mail.codepixelz.tech';
        $mail->SMTPAuth = true;
        $mail->Username = 'utsav@codepixelz.tech';
        $mail->Password = 'Lq10427@'; // Use a secure password or environment variable
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email settings
        $mail->setFrom('utsav@codepixelz.tech', 'Utsav');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Your New Password';
        $mail->Body = "Your new password is: <strong>$newPassword</strong><br>Please change it after logging in.";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

// Function to update the user's password in the database
function updatePassword($email, $newPassword) {
    global $dzyns_db;
    // Hash the password using SHA-1
    $hashedPassword = sha1($newPassword);

    // Prepare the SQL statement to update the password
    $stmt = $dzyns_db->prepare("UPDATE dz20_yns_users SET password = :password WHERE email = :email");
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->bindParam(':email', $email);

    return $stmt->execute();
}


// Function to generate a password reset link and send it via email
function generate_password_link($email) {
   // global $dzyns_db;

    // Check if the email exists in the database
    $dzyns_database = new Dzyns_Database();
    $dzyns_db = $dzyns_database->dzyns_getConnection();
    $stmt = $dzyns_db->prepare("SELECT * FROM dz20_yns_users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Generate a unique token
        $token = bin2hex(random_bytes(16)); // 32 character token
        
        // Set token expiration (e.g., 1 hour from now)
        $expiryTime = date("Y-m-d H:i:s", strtotime("+1 hour"));

        // Save the token and expiry time to the database
        $stmt = $dzyns_db->prepare("UPDATE dz20_yns_users SET reset_token = :token, reset_token_expires_at = :expiry WHERE email = :email");
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':expiry', $expiryTime);
        $stmt->bindParam(':email', $email);

        if ($stmt->execute()) {
            // Generate the password reset link
            $resetLink = HOMEPAGE_URL."update-password?token=$token";

            // Use PHPMailer to send the reset link via email
            try {
                $mail = new PHPMailer(true);
                
                // SMTP configuration (Replace with your SMTP server details)
               // $mail->isSMTP();
                $mail->Host = 'mail.codepixelz.tech'; // Your SMTP server
                $mail->SMTPAuth = true;
                $mail->Username = 'utsav@codepixelz.tech'; // SMTP username
                $mail->Password = 'Lq10427@'; // SMTP password (use secure method in production)
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Set the sender and recipient
                $mail->setFrom('utsav@codepixelz.tech', 'Utsav');
                $mail->addAddress($email);

                // Set the email content
                $mail->isHTML(true);
                $mail->Subject = 'Password Reset Request';
                $mail->Body = "Hello, <br><br>To reset your password, please click the link below: <br><a href='$resetLink'>$resetLink</a><br><br>If you did not request a password reset, please ignore this email.";

                // Send the email
                $mail->send();
                
                return "We have sent a password reset link to your email.";
            } catch (Exception $e) {
                return "Failed to send the reset email. Please try again later.";
            }
        } else {
            return "Email not found in our database.";
        }
    } else {
        return "No user found with that email address.";
    }
}