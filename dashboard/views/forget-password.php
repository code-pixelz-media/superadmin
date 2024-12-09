<?php
get_header();
require 'config/user.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];

    // Validate the email format
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Call the function to generate password reset link and send email
        $message = generate_password_link($email);
        
        // Display the message (either success or error)
        if (strpos($message, 'sent a password reset link') !== false) {
            $successMsg = $message;
        } else {
            $errorMsg = $message;
        }
    } else {
        $errorMsg = "Please enter a valid email address.";
    }
}
?>

<section class="dzn-login-page-wrapper section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="dzn-form-container">
                    <div class="dzn-form-header text-center">
                        <h2>Forget Password?</h2>
                        <p>Forgot your password? Please enter your email, and we will send you a Reset Link.</p>
                    </div>
                    <div class="dzn-form-content">
                        <?php if (isset($errorMsg)) { ?>
                            <div class="alert alert-danger"><?= $errorMsg; ?></div>
                        <?php } elseif (isset($successMsg)) { ?>
                            <div class="alert alert-success"><?= $successMsg; ?></div>
                        <?php } ?>

                        <form method="POST" action="">
                            <div class="form-group">
                                <label for="emailaddress">Email Address <span class="dzn-required">*</span></label>
                                <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Get New Link</button>
                        </form>
                    </div>
                    <div class="dzn-form-footer text-center">
                        <span class="dzn-signin-text">
                            <a href="login" class="fw-600 color-black">Back to Login</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php 
get_footer();
?>
