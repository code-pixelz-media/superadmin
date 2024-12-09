<?php get_header();?>
  <section class="dzn-login-page-wrapper section-padding">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="dzn-form-container">
            <div class="dzn-form-header text-center">
              <img src="<?php echo  PUBLIC_PATH; ?>images/form-header-icon.png" alt="<?php echo SITE_NAME; ?>">
              <h2>Create Your Account</h2>
              <p>Welcome! Please enter your details</p>
              
            </div>
            <div class="dzn-form-content">
            <ul class="dzn-third-party-signin d-flex justify-content-center">
                <li><a href=""><img src="<?php echo  PUBLIC_PATH; ?>images/google.png" alt="Sign in with google"> <span>Google</span></a></li>
                <li><a href=""><img src="<?php echo  PUBLIC_PATH; ?>images/meta.png" alt="Sign in with Meta"> <span>Meta</span></a></li>
                <li><a href=""><img src="<?php echo  PUBLIC_PATH; ?>images/apple.png" alt="Sign in with apple"> <span>Apple</span></a></li>
              </ul>
            <form class="d-flex" action="dashboard">
              <div class="form-group">
                  <label for="exampleInputEmail1">First Name <span class="dzn-required">*</span></label>
                  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter you name">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Last Name <span class="dzn-required">*</span></label>
                  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter you last name">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address <span class="dzn-required">*</span></label>
                  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Email/ Phone no">
                </div>
                <div class="form-group" id="show_hide_password">
                  <label for="exampleInputPassword1">Password <span class="dzn-required">*</span></label>
                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Passcode">
                  <div class="input-group-addon">
                    <a href=""><span class="password-show-hide">Show</span></a>
                  </div>
                </div>

                <div class="form-group" id="show_hide_password2">
                  <label for="exampleInputPassword1">Retype Password <span class="dzn-required">*</span></label>
                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Passcode">
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
  <?php get_footer(); ?>