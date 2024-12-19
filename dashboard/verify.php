<?php
session_start(); // Start the session
require_once('functions.php');
require_once 'inc/header.php';
// Check if the session email is set
if (isset($_SESSION['email_for_otp'])) {
    $email = $_SESSION['email_for_otp'];

    try {
        // Instantiate database connection
        $dzyns_database = new Dzyns_Database();
        $dzyns_db = $dzyns_database->dzyns_getConnection();


        // Handle OTP verification
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['verify_otp'])) {
            //$otp = filter_input(INPUT_POST, 'otp', FILTER_SANITIZE_NUMBER_INT);
            $otp = $_POST['otp'];
            // Fetch the OTP and expiration time from the database
            $stmt = $dzyns_db->prepare("SELECT email_code, email_code_expires_at FROM wooescrow_admin_users WHERE email = :email");
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
                        /*                         $stmt = $dzyns_db->prepare("UPDATE wooescrow_admin_users SET email_code = '', email_code_expires_at = NULL WHERE email = :email");
                        $stmt->execute(['email' => $email]); */

                        // Redirect to home.php after successful verification
                        header("Location: admin.php");

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
            $stmt = $dzyns_db->prepare("UPDATE wooescrow_admin_users SET email_code = :new_otp, email_code_expires_at = :expires_at WHERE email = :email");
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

<div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
    <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
            <div class="col-md-8 col-lg-6 col-xxl-4">
                <div class="card mb-0">
                    <div class="card-body">
                        <a href="./index.html"
                            class="text-nowrap logo-img text-center d-block py-3 w-100 d-flex justify-content-center">
                            <img
                                src="assets/images/logos/wooescrow-logo.svg"
                                class=""
                                alt="" />
                            <h1 class="wooescrow-title ms-2">Wooescrow</h1>
                        </a>

                        <form class="" action="verify.php" method="POST">
                            <div class="form-group">
                                <h2>Enter your code</h2>
                                <p>We sent a code to <span class="fw-500"><?php echo $email; ?></span></p>
                            </div>
                            <div class="form-group">
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
                            <div class="mb-3" id="otp-input">
                                <input type="text" class="otp-input form-control" id="verification_code1" name="verification_code1" maxlength="1" required="">
                                <input type="text" class="otp-input form-control" id="verification_code3" name="verification_code3" maxlength="1" required="">
                                <input type="text" class="otp-input form-control" id="verification_code2" name="verification_code2" maxlength="1" required="">
                                <input type="text" class="otp-input form-control" id="verification_code4" name="verification_code4" maxlength="1" required="">
                                <input type="text" class="otp-input form-control" id="verification_code5" name="verification_code5" maxlength="1" required="">
                                <input type="text" class="otp-input form-control" id="verification_code6" name="verification_code6" maxlength="1" required="">
                            </div>
                            <input type="hidden" name="otp" id="otp" value="">
                            <!--      <button type="submit" class="btn btn-primary">Continue</button> -->
                            <button type="submit" name="verify_otp" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Verify OTP</button>
                        </form>
                        <div class="dzn-form-footer text-center">

                            <span class="dzn-signin-text dzn-signin-text d-flex justify-content-center align-items-center"> Didn't receive the email? <form method="POST" action="verify.php"><button type="submit" name="resend_otp" class="fw-600 color-black resend_otp">Click to resend</button> </form></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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

    // Function to update the OTP value
    function updateOtpValue() {
        // Get values from each input field
        const otp1 = document.getElementById('verification_code1').value;
        const otp2 = document.getElementById('verification_code2').value;
        const otp3 = document.getElementById('verification_code3').value;
        const otp4 = document.getElementById('verification_code4').value;
        const otp5 = document.getElementById('verification_code5').value;
        const otp6 = document.getElementById('verification_code6').value;

        // Combine the values to form the complete OTP
        const otpValue = otp1 + otp2 + otp3 + otp4 + otp5 + otp6;

        // Set the combined value to the hidden input field
        document.getElementById('otp').value = otpValue;
    }

    // Add event listeners to each input field to trigger the function on input change
    document.querySelectorAll('.verification-code-wrapper input').forEach(input => {
        input.addEventListener('input', updateOtpValue);
    });
</script>


<?php require_once 'inc/footer.php'; ?>