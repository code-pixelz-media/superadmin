<?php 
get_header();
require 'config/user.php';

if (isset($_POST['submit'])) {
    $email = trim($_POST['email']);
  // Instantiate database connection
  $dzyns_database = new Dzyns_Database();
  $dzyns_db = $dzyns_database->dzyns_getConnection();
    // Check if email exists in the database
    $stmt = $dzyns_db->prepare("SELECT * FROM dz20_yns_users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Generate a new password
        $newPassword = generateRandomPassword();

        // Send the new password to the user's email
        if (sendNewPasswordEmail($email, $newPassword)) {
            // Update the password in the database
            if (updatePassword($email, $newPassword)) {
                $successMsg = "A new password has been sent to your email.";
            } else {
                $errorMsg = "Failed to update the password in the database.";
            }
        } else {
            $errorMsg = "Failed to send the email. Please try again.";
        }
    } else {
        $errorMsg = "Email not found in our records.";
    }
}
?>

<section class="dzn-login-page-wrapper section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="dzn-form-container">
                    <div class="dzn-form-header text-center">
                        <h2>Reset Password?</h2>
                        <p>Forgot your password? Please enter your email, and we will send you a new password.</p>
                    </div>
                    <div class="dzn-form-content">
                        <?php if (isset($errorMsg)) { ?>
                            <div class="alert alert-danger"><?= $errorMsg; ?></div>
                        <?php } elseif (isset($successMsg)) { ?>
                            <div class="alert alert-success"><?= $successMsg; ?></div>
                        <?php } ?>

                        <form method="POST" action="reset">
                            <div class="form-group">
                                <label for="emailaddress">Email Address <span class="dzn-required">*</span></label>
                                <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Get New Password</button>
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
