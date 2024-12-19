<?php
require_once 'inc/config.php';

session_start(); // Start the session
require_once 'functions.php';
require_once 'inc/header.php';

$host_name = $_SERVER['SERVER_NAME'];

// Handle login request
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    //$password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
    $email = $_POST['email'];
    $password = $_POST['password'];
    $captchaResponse = $_POST['g-recaptcha-response'];
    // if (empty($captchaResponse) || !verifyCaptcha($captchaResponse)) {
    if (1==2) {
        $error_message = "Captcha verification failed. Please try again.";
    } else {

        $login_response = loginUser($email, $password);

        if ($login_response === true) {

            $otp = generateOTP();
            try {
                $_SESSION['email_for_otp'] = $email;
                sendOTPEmail($email, $otp);
            
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

            ;
            if ($host_name == 'localhost') {
                header("Location: " . DASHBOARD_BASE_URL . "admin.php");
                exit;
            } else {
                header("Location: " . DASHBOARD_BASE_URL . "verify.php");
                exit;
            }
        } else {
            // If the response is a string, it means account is locked or login failed
            $error_message = $login_response; // This will hold either the error or locked account message
        }
    }
}

// echo "</head>";
?>
<!--  Body Wrapper -->

<div
    class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
    <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
            <div class="col-md-8 col-lg-6 col-xxl-4">
                <div class="card mb-0">
                    <div class="card-body">
                        <a
                            href="<?=HOMEPAGE_URL;?>"
                            class="text-nowrap logo-img text-center d-block py-3 w-100 d-flex justify-content-center">
                            <img
                                src="<?=BASE_URL?>assets/images/logos/wooescrow-logo.svg"
                                class=""
                                alt="" />
                            <h1 class="wooescrow-title ms-2">Wooescrow</h1>
                        </a>

                        <?php if (isset($error_message)): ?>
                            <div class="form-group">
                                <div class="alert alert-danger bg-offred color-red" role="alert">
                                    <?php echo htmlspecialchars($error_message); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <form method="POST" action="">
                            <!-- Email Address -->
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email*</label>
                                <input
                                    type="email"
                                    class="form-control"
                                    id="exampleInputEmail1"
                                    aria-describedby="emailHelp"
                                    name="email"
                                    required />
                            </div>
                            <div class="mb-4">
                                <label for="exampleInputPassword1" class="form-label">Password*</label>
                                <input
                                    type="password"
                                    class="form-control"
                                    id="exampleInputPassword1"
                                    name="password"
                                    required />
                            </div>


                            <!-- Password -->
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="form-check">
                                    <input
                                        class="form-check-input primary"
                                        type="checkbox"
                                        value=""
                                        id="flexCheckChecked"
                                         />
                                    <label
                                        class="form-check-label text-dark"
                                        for="flexCheckChecked">
                                        Remember this Device
                                    </label>
                                </div>
                                <?php if (isset($error_message)): ?>
                                    <a class="text-primary fw-bold" href="forget.php">Forgot Password ?</a>
                                <?php endif; ?>
                            </div>

                            <div class="mb-5">
                                <div class="g-recaptcha" data-sitekey="<?php echo  SETTINGS_GOOGLEPUBLICKEY; ?>"></div>
                            </div>
                            <button class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign In</button>
                            <!-- <div class="d-flex align-items-center justify-content-center">
                                        <p class="fs-4 mb-0 fw-bold">New to Wooescrow?</p>
                                        <a
                                            class="text-primary fw-bold ms-2"
                                            href="./authentication-register.html">Request an account</a>
                                    </div> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<?php require_once 'inc/footer.php'; ?>