<section class="dzn-login-page-wrapper section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="dzn-form-container">
                    <div class="dzn-form-content">
                        <form class="d-flex" method="POST" action="">

                            <?php if (isset($error_message)): ?>
                                <div class="form-group">
                                    <div class="alert alert-danger bg-offred color-red" role="alert">
                                        <?php echo htmlspecialchars($error_message); ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="form-group">
                                <label for="emailaddress">Email address <span class="dzn-required">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter Email/ Phone no" required>

                            </div>
                            <div class="form-group" id="show_hide_password">
                                <label for="exampleInputPassword1">Password <span class="dzn-required">*</span></label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Passcode" required>
                                <div class="input-group-addon">
                                    <a href=""><span class="password-show-hide">Show</span></a>
                                </div>
                            </div>
                            <div class="g-recaptcha" data-sitekey="<?php echo SETTINGS_GOOGLEPUBLICKEY; ?>"></div>
                            <button type="submit" class="btn btn-primary">Sign in</button>
                        </form>
                    </div>
                    <!-- <div class="dzn-form-footer text-center">
                <span class="dzn-signin-text">Or Sign in with</span>
                <ul class="dzn-third-party-signin d-flex justify-content-center">
                  <li><a href=""><img src="<?php //echo  PUBLIC_PATH; 
                                            ?>images/google.png" alt="Sign in with google"> <span>Google</span></a></li>
                  <li><a href=""><img src="<?php //echo  PUBLIC_PATH; 
                                            ?>images/meta.png" alt="Sign in with Meta"> <span>Meta</span></a></li>
                  <li><a href=""><img src="<?php // echo  PUBLIC_PATH; 
                                            ?>images/apple.png" alt="Sign in with apple"> <span>Apple</span></a></li>
                </ul>
                <span class="dzn-signin-text">Don’t have an account? <a href="/register" class="fw-600 color-black">Request Now</a></span>
              </div> -->
                </div>
            </div>
        </div>
    </div>

</section>