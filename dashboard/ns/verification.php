<?php include('public/templates/header.php'); ?>

<section class="dzn-login-page-wrapper section-padding">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="dzn-form-container">
          <div class="dzn-form-header text-center">
            <h2>Enter you code</h2>
            <p>We sent a code to <span class="fw-500">youemail@domain.com</span></p>
          </div>
          <div class="dzn-form-content">
            <form class="d-flex" action="dashboard">
              <div class="form-group text-center">
                <?php include_once('public/components/msg-error.php'); ?>
              </div>
              <div class="form-group verification-code-wrapper d-flex gap-2">
                <input type="text" class="form-control" id="verification_code1" name="verification_code1" maxlength="1" required="">
                <input type="text" class="form-control" id="verification_code2" name="verification_code2" maxlength="1" required="">
                <input type="text" class="form-control" id="verification_code3" name="verification_code3" maxlength="1" required="">
                <input type="text" class="form-control" id="verification_code4" name="verification_code4" maxlength="1" required="">
                <input type="text" class="form-control" id="verification_code5" name="verification_code5" maxlength="1" required="">
                <input type="text" class="form-control" id="verification_code6" name="verification_code6" maxlength="1" required="">
              </div>

              <button type="submit" class="btn btn-primary">Continue</button>
            </form>
          </div>
          <div class="dzn-form-footer text-center">
            <span class="dzn-signin-text dzn-signin-text d-flex justify-content-center align-items-center"> Didn't receive the email?
              <form method="POST" action="verify"><button type="submit" name="resend_otp" class="fw-600 color-black resend_otp">Click to resend</button> </form>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>
<?php include('public/templates/footer.php'); ?>