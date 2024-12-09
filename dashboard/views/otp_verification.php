<?php 
require_once 'config/user.php'; // Include the user functions
session_start();
get_header();
// Include PHPMailer files
require_once __DIR__ . '/../vendor/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../vendor/PHPMailer/src/SMTP.php';
require_once __DIR__ . '/../vendor/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
function generate_otp($length = 6) {
    return rand(pow(10, $length-1), pow(10, $length)-1);
}

// Check if the session email is set
if (isset($_SESSION['email_for_otp'])) {
    $email = $_SESSION['email_for_otp'];

    try {
        // Instantiate database connection
        $dzyns_database = new Dzyns_Database();
        $dzyns_db = $dzyns_database->dzyns_getConnection();

        function sendOTPEmailOld($email, $otp) {
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
                $success_otp_resend ='';
                // Now update the OTP in the database after email is sent
                if (storeOTP($email, $otp)) {
                    $success_otp_resend = 'OTP has been sent to your email!';
                } else {
                    $success_otp_resend= 'Failed to update OTP in the database!';
                }
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }

        // Handle OTP verification
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['verify_otp'])) {
            $otp = filter_input(INPUT_POST, 'otp', FILTER_SANITIZE_NUMBER_INT);

            // Fetch the OTP and expiration time from the database
            $stmt = $dzyns_db->prepare("SELECT email_code, email_code_expires_at FROM dz20_yns_users WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Check if the entered OTP matches and is not expired
                if ($user['email_code'] == $otp) {
                    $current_time = new DateTime();
                    $otp_expiration_time = new DateTime($user['email_code_expires_at']);

                    if ($otp_expiration_time > $current_time) {
                        // OTP is valid and not expired
                        // Clear the OTP fields in the database
/*                         $stmt = $dzyns_db->prepare("UPDATE dz20_yns_users SET email_code = '', email_code_expires_at = NULL WHERE email = :email");
                        $stmt->execute(['email' => $email]); */

                        // Redirect to home.php after successful verification
                        header("Location: home.php");
                        exit;
                    } else {
                        $error_message = "OTP has expired. Please request a new one.";
                    }
                } else {
                    $error_message = "Invalid OTP. Please try again.";
                }
            } else {
                $error_message = "No OTP found for this email.";
            }
        }

        // Handle Resend OTP
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['resend_otp'])) {
            $new_otp = generateOTP();
            $expiration_time = (new DateTime())->modify('+5 minutes')->format('Y-m-d H:i:s');

            // Update the new OTP and expiration time in the database
            $stmt = $dzyns_db->prepare("UPDATE dz20_yns_users SET email_code = :new_otp, email_code_expires_at = :expires_at WHERE email = :email");
            $stmt->execute([
                'new_otp' => $new_otp,
                'expires_at' => $expiration_time,
                'email' => $email
            ]);
            sendOTPEmail($email, $new_otp);
         
        }

    } catch (Exception $e) {
        $error_message = "An error occurred while processing your request.";
        error_log("OTP Verification Error: " . $e->getMessage());
    }
} else {
    $error_message = "Session expired. Please login again.";
    // Clear session and redirect to login page
    session_destroy();
    header("Location: login.php");
    exit;
}
?>




<?php if (isset($success_otp_resend) && $success_otp_resend !== ''): ?>
    <div class="alert alert-success">
        <?php echo htmlspecialchars($success_otp_resend); ?>
    </div>
<?php endif; ?>


<section class="dzn-login-page-wrapper section-padding">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="dzn-form-container">
            <div class="dzn-form-header text-center">
              <h2>Enter your code</h2>
              <p>We sent a code to <span class="fw-500"><?php echo $email; ?></span></p>
            </div>
            <div class="dzn-form-content">
              <form class="d-flex" action="verify" method="POST">
              <div class="form-group">
              <?php //include_once('public/components/msg-error.php'); ?>
              <?php if (isset($error_message)): ?>
    <div class="alert alert-danger">
        <?php echo htmlspecialchars($error_message); ?>
    </div>
<?php endif; 
if (isset($_SESSION['success_otp_resend'])) {
    echo '<div class="alert alert-success">';
    echo htmlspecialchars($_SESSION['success_otp_resend']);
    echo '</div>';

    // After displaying, clear the session message so it won't display again
    unset($_SESSION['success_otp_resend']);
} ?>



              </div>
              <div class="form-group verification-code-wrapper d-flex gap-2">
                <input type="text" class="form-control" id="verification_code1" name="verification_code1" maxlength="1" required="">
                <input type="text" class="form-control" id="verification_code2" name="verification_code2" maxlength="1" required="">
                <input type="text" class="form-control" id="verification_code3" name="verification_code3" maxlength="1" required="">
                <input type="text" class="form-control" id="verification_code4" name="verification_code4" maxlength="1" required="">
                <input type="text" class="form-control" id="verification_code5" name="verification_code5" maxlength="1" required="">
                <input type="text" class="form-control" id="verification_code6" name="verification_code6" maxlength="1" required="">
              </div>
                <input type="hidden" name="otp" id="otp">
           <!--      <button type="submit" class="btn btn-primary">Continue</button> -->
                <button type="submit" name="verify_otp" class="btn btn-primary">Verify OTP</button>
              </form>
            </div>
            <div class="dzn-form-footer text-center">
           
              <span class="dzn-signin-text dzn-signin-text d-flex justify-content-center align-items-center"> Didn't receive the email? <form method="POST" action="verify" ><button type="submit" name="resend_otp" class="fw-600 color-black resend_otp">Click to resend</button> </form></span> 
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>



    <script>
        const otpInputs = document.querySelectorAll('.otp-input');
        const hiddenOtpInput = document.getElementById('otp');

        otpInputs.forEach((input, index) => {
            input.addEventListener('input', () => {
                if (input.value.length === 1 && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }
                if (index === otpInputs.length - 1) {
                    input.blur(); // Lose focus on the last input
                }
                collectOtp();
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && input.value === '' && index > 0) {
                    otpInputs[index - 1].focus();
                }
            });
        });

        function collectOtp() {
            let otpValue = '';
            otpInputs.forEach(input => otpValue += input.value);
            hiddenOtpInput.value = otpValue;
        }
    </script>

<?php get_footer(); ?>
