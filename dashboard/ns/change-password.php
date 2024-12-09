<?php include('public/templates/header.php'); ?>

<section class="dzn-login-page-wrapper section-padding">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="dzn-form-container">
          <div class="dzn-form-header text-center">
            <h2>Change Password ?</h2>
            <p>Forgot you password? Please enter you email and we we will send you verification code.</p>
          </div>
          <div class="dzn-form-content">
            <form class="d-flex" action="dashboard">
              <div class="form-group text-center">
                <?php include_once('public/components/msg-error.php'); ?>
              </div>
              <div class="form-group" id="show_hide_password0">
                  <label for="Password_0">Old Password <span class="dzn-required">*</span></label>
                  <input type="password" class="form-control" id="Password_0" placeholder="Passcode" required>
                  <div class="input-group-addon">
                    <a href=""><span class="password-show-hide">Show</span></a>
                  </div>
                </div>

              <div class="form-group" id="show_hide_password">
                  <label for="Password_1">New Password <span class="dzn-required">*</span></label>
                  <input type="password" class="form-control" id="Password_1" placeholder="Passcode" required>
                  <div class="input-group-addon">
                    <a href=""><span class="password-show-hide">Show</span></a>
                  </div>
                </div>

                <div class="form-group" id="show_hide_password2">
                  <label for="Retype_Password">Verify Password <span class="dzn-required">*</span></label>
                  <input type="password" class="form-control" id="Retype_Password" placeholder="Passcode" required>
                  <div class="input-group-addon">
                    <a href=""><span class="password-show-hide">Show</span></a>
                  </div>
                </div>


              <button type="submit" class="btn btn-primary">Change Password</button>
            </form>
          </div>
          <div class="dzn-form-footer text-center">
            <span class="dzn-signin-text"> <a href="" class="fw-600 color-black">Back to login</a></span>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>
<?php include('public/templates/footer.php'); ?>