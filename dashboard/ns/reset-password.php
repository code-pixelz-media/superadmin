<?php include('public/templates/header.php'); ?>

  <section class="dzn-login-page-wrapper section-padding">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="dzn-form-container">
            <div class="dzn-form-header text-center">
              <h2>Reset Password ?</h2>
              <p>Forgot you password? Please enter you email and we we will send you verification code.</p>
            </div>
            <div class="dzn-form-content">
              <form class="d-flex" action="dashboard">
              <div class="form-group text-center">
              <?php include_once('public/components/msg-error.php'); ?>
              </div>
                <div class="form-group">
                  <label for="emailaddress">Email address <span class="dzn-required">*</span></label>
                  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Email" required>

                </div>
                
                <button type="submit" class="btn btn-primary">Get verification code</button>
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