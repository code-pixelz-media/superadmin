<?php include('public/templates/header.php'); ?>

  <section class="dzn-login-page-wrapper section-padding">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="dzn-form-container">
            <div class="dzn-form-header text-center">
              <img src="public/<?php echo  ASSET_URL; ?>images/form-header-icon.png" alt="<?php echo SITE_NAME; ?>">
              <h2>Welcome to Dzyns</h2>
              <p>Hey, Enter your details to get sign in to your account</p>
            </div>
            <div class="dzn-form-content">
              <form class="d-flex" action="dashboard">
              <div class="form-group">
              <?php include_once('public/components/msg-error.php'); ?>
              </div>
                <div class="form-group">
                  <label for="emailaddress">Email address <span class="dzn-required">*</span></label>
                  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Email/ Phone no" required>

                </div>
                <div class="form-group" id="show_hide_password">
                  <label for="exampleInputPassword1">Password <span class="dzn-required">*</span></label>
                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Passcode" required>
                  <div class="input-group-addon">
                    <a href=""><span class="password-show-hide">Show</span></a>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary">Sign in</button>
              </form>
            </div>
            <div class="dzn-form-footer text-center">
              <span class="dzn-signin-text">Or Sign in with</span>
              <ul class="dzn-third-party-signin d-flex justify-content-center">
                <li><a href=""><img src="public/<?php echo  ASSET_URL; ?>images/google.png" alt="Sign in with google"> <span>Google</span></a></li>
                <li><a href=""><img src="public/<?php echo  ASSET_URL; ?>images/meta.png" alt="Sign in with Meta"> <span>Meta</span></a></li>
                <li><a href=""><img src="public/<?php echo  ASSET_URL; ?>images/apple.png" alt="Sign in with apple"> <span>Apple</span></a></li>
              </ul>
              <span class="dzn-signin-text">Don’t have an account? <a href="" class="fw-600 color-black">Request Now</a></span>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>
  <?php include('public/templates/footer.php'); ?>