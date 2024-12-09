<?php 
get_header();
  
session_start(); // Start the session


require_once 'config/user.php'; // Include the user functions

// Include PHPMailer files
/* require_once __DIR__ . '/../vendor/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../vendor/PHPMailer/src/SMTP.php';
require_once __DIR__ . '/../vendor/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception; */

// Generate a random OTP (6 digits)




// Handle login request
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  //$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  //$password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
  $email = $_POST['email'];
  $password= $_POST['password'];
  $captchaResponse = $_POST['g-recaptcha-response'];

  // Validate reCAPTCHA
  if (empty($captchaResponse) || !verifyCaptcha($captchaResponse)) {
      $error_message = "Captcha verification failed. Please try again.";
  } else {
      // Attempt to login user
      $login_response = loginUser($email, $password);
print_r($login_response);
      if ($login_response === true) {
    
          // Redirect on successful login
      /*     header("Location: user_dashboard/index.php");
          exit;
 */


    // Generate OTP and store it in the database
    $otp = generateOTP();
   // $email= $_SESSION['email_for_otp'];
   
    
    // Send OTP email
 /*    sendOTPEmail($email, $otp); */
 
 $subject = "Your 2FA Code";
 $body = "Your one-time password (OTP) for logging into your account is: <strong>$otp</strong><br><br>This code will expire in 10 minutes.";
 
 //$mail = new PHPMailer(true);
 
 try {
  sendOTPEmail($email, $otp); 
 } catch (Exception $e) {
     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
 }

     // Redirect to OTP verification page
     $_SESSION['email_for_otp'] = $email;
     header("Location: verify");
     exit;
      } else {
          // If the response is a string, it means account is locked or login failed
          $error_message = $login_response; // This will hold either the error or locked account message
      }
  }
}
 // echo "</head>";
?>

  <section class="dzn-login-page-wrapper section-padding">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="dzn-form-container">
            <div class="dzn-form-header text-center">
              <img src="<?php echo  PUBLIC_PATH; ?>images/form-header-icon.png" alt="<?php echo SITE_NAME; ?>">
              <h2>Welcome to Dzyns</h2>
              <p>Hey, Enter your details to get sign in to your account</p>
            </div>
            <div class="dzn-form-content">
              <form class="d-flex" method="POST" action="">
           
              <?php if (isset($error_message)): ?>
              <div class="form-group">
            <div class="alert alert-danger bg-offred color-red" role="alert">
                <?php echo htmlspecialchars($error_message); ?>
            </div>
            </div>
        <?php endif; ?>

                <div class="form-group">
                  <label for="emailaddress">Email address <span class="dzn-required">*</span></label>
                  <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter Email/ Phone no" required>

                </div>
                <div class="form-group" id="show_hide_password">
                  <label for="exampleInputPassword1">Password <span class="dzn-required">*</span></label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Passcode" required>
                  <div class="input-group-addon">
                    <a href=""><span class="password-show-hide">Show</span></a>
                  </div>
                </div>
                <div class="g-recaptcha" data-sitekey="<?php echo SETTINGS_GOOGLEPUBLICKEY; ?>"></div>
                <button type="submit" class="btn btn-primary">Sign in</button>
              </form>
            </div>
            <div class="dzn-form-footer text-center">
              <span class="dzn-signin-text">Or Sign in with</span>
              <ul class="dzn-third-party-signin d-flex justify-content-center">
                <li><a href=""><img src="<?php echo  PUBLIC_PATH; ?>images/google.png" alt="Sign in with google"> <span>Google</span></a></li>
                <li><a href=""><img src="<?php echo  PUBLIC_PATH; ?>images/meta.png" alt="Sign in with Meta"> <span>Meta</span></a></li>
                <li><a href=""><img src="<?php echo  PUBLIC_PATH; ?>images/apple.png" alt="Sign in with apple"> <span>Apple</span></a></li>
              </ul>
              <span class="dzn-signin-text">Don’t have an account? <a href="/register" class="fw-600 color-black">Request Now</a></span>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>
<?php 
get_footer();