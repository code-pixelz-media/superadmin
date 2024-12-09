<?php include('public/templates/header.php'); ?>
  <section class="dzn-login-page-wrapper section-padding">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="dzn-form-container">
            <div class="dzn-form-header text-center">
              <img src="public/<?php echo  ASSET_URL; ?>images/form-header-icon.png" alt="<?php echo SITE_NAME; ?>">
              <h2>Create Your Account</h2>
              <p>Welcome! Please enter your details</p>
              
            </div>
            <div class="dzn-form-content">
            <ul class="dzn-third-party-signin d-flex justify-content-center">
                <li><a href=""><img src="public/<?php echo  ASSET_URL; ?>images/google.png" alt="Sign in with google"> <span>Google</span></a></li>
                <li><a href=""><img src="public/<?php echo  ASSET_URL; ?>images/meta.png" alt="Sign in with Meta"> <span>Meta</span></a></li>
                <li><a href=""><img src="public/<?php echo  ASSET_URL; ?>images/apple.png" alt="Sign in with apple"> <span>Apple</span></a></li>
              </ul>
            <form class="d-flex" action="dashboard">
            <div class="form-group">
              <?php include_once('public/components/msg-success.php'); ?>
              </div>
              <div class="form-group">
                  <label for="First_Name">First Name <span class="dzn-required">*</span></label>
                  <input type="email" class="form-control" id="First_Name" placeholder="Enter you name" required>
                </div>
                <div class="form-group">
                  <label for="Last_Name">Last Name <span class="dzn-required">*</span></label>
                  <input type="email" class="form-control" id="Last_Name" placeholder="Enter you last name" required>
                </div>
                <div class="form-group">
                  <label for="Email_Address">Email address <span class="dzn-required">*</span></label>
                  <input type="email" class="form-control" id="Email_Address" placeholder="Enter Email/ Phone no" required>
                </div>
                <div class="form-group" id="show_hide_password">
                  <label for="Password_1">Password <span class="dzn-required">*</span></label>
                  <input type="password" class="form-control" id="Password_1" placeholder="Passcode" required>
                  <div class="input-group-addon">
                    <a href=""><span class="password-show-hide">Show</span></a>
                  </div>
                </div>

                <div class="form-group" id="show_hide_password2">
                  <label for="Retype_Password">Retype Password <span class="dzn-required">*</span></label>
                  <input type="password" class="form-control" id="Retype_Password" placeholder="Passcode" required>
                  <div class="input-group-addon">
                    <a href=""><span class="password-show-hide">Show</span></a>
                  </div>
                </div>

                <button type="submit" class="btn btn-primary">Sign in</button>
              </form>
            </div>
            <div class="dzn-form-footer text-center">
              <span class="dzn-signin-text">Alredy Have an account? <a href="" class="fw-600 color-black">Sign in</a></span>

              <span class="dzn-signin-text">Don’t have an account? <a href="" class="fw-600 color-black">Request Now</a></span>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>
  <?php include('public/templates/footer.php'); ?>