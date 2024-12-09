<?php

require 'config/user.php'; // Include the user.php file
get_header();

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $dzyns_database = new Dzyns_Database();
    $dzyns_db = $dzyns_database->dzyns_getConnection();

    // Check if the token exists in the database and is not expired
    $stmt = $dzyns_db->prepare("SELECT * FROM dz20_yns_users WHERE reset_token = :token AND reset_token_expires_at > NOW()");
    $stmt->bindParam(':token', $token);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (isset($_POST['submit'])) {
            // Get the new password and confirm password
            $newPassword = $_POST['new_password'];
            $confirmPassword = $_POST['confirm_password'];

            // Check if the new password and confirm password match
            if ($newPassword === $confirmPassword) {
                // Hash the password using sha1
                $hashedPassword = sha1($newPassword);

                // Update the password in the database
                $stmt = $dzyns_db->prepare("UPDATE dz20_yns_users SET password = :password, reset_token = NULL, reset_token_expires_at = NULL WHERE reset_token = :token");
                $stmt->bindParam(':password', $hashedPassword);
                $stmt->bindParam(':token', $token);
                $stmt->execute();

                // Set success message and redirect to login page
                $successMsg = "Your password has been reset successfully. You will be redirected to the login page shortly.";
                header("refresh:3;url=/login"); // Redirect after 3 seconds
            } else {
                $errorMsg = "Passwords do not match. Please try again.";
            }
        }
    } else {
        $errorMsg = "Invalid or expired token.";
    }
}
?>


    <section class="dzn-login-page-wrapper section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="dzn-form-container">
                        <div class="dzn-form-header text-center">
                            <h2>Reset Your Password</h2>
                            <p>Enter your new password below.</p>
                        </div>
                        <div class="dzn-form-content">
                            <?php if (isset($errorMsg)) { ?>
                                <div class="alert alert-danger"><?= $errorMsg; ?></div>
                            <?php } elseif (isset($successMsg)) { ?>
                                <div class="alert alert-success"><?= $successMsg; ?></div>
                            <?php } ?>

                            <form method="POST" action="">
                                <div class="form-group" id="show_hide_password1">
                                    <label for="new_password">New Password <span class="dzn-required">*</span></label>
                                    <input type="password" name="new_password" class="form-control" id="Password_1" placeholder="Passcode" required>
                                    <div class="input-group-addon">
                    <a href=""><span class="password-show-hide">Show</span></a>
                  </div>
                                </div>
                                <div class="form-group" id="show_hide_password2">
                                    <label for="confirm_password">Verify Password <span class="dzn-required">*</span></label>
                                    <input type="password" name="confirm_password" placeholder="Passcode"  id="Password_2" class="form-control" required>
                                    <div class="input-group-addon">
                    <a href=""><span class="password-show-hide passwordhide">Show</span></a>
                  </div>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary">Reset Password</button>
                            </form>
                        </div>
                        <div class="dzn-form-footer text-center">
                            <span class="dzn-signin-text">
                                <a href="/login" class="fw-600 color-black">Back to Login</a>
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
