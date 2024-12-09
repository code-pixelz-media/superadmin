<?php 
get_admin_header();
?>
<section class="dzn-main-container">
  <div class="container">
    <div class="row">
      <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 dzn-left-sidebar">
        <div class="logo pt-3 pb-3 dzn-main-sidebar">
          <?php //include_once('templates/sidebar.php'); ?>
        </div>
      </div>
      <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 no-padding offset-lg-2 dzn-main-rght-wrapper">
        <div class="dzn-content-wrapper pt-4 pb-4 dzn-page-title-wrapper">
          <div class="container">
            <div class="row align-items-center dzn-page-title">
              <div class="col-lg-6">
                <h2>Projects</h2>
              </div>
              <div class="col-lg-6 text-end">
                <p class="smallfont text-end mb-0">Scale up or down as needed, and pause or cancel at anytime.<span class="dzn-capsule-small bg-yellow xxsmallfont ms-2">New</span></p>
              </div>
            </div>
          </div>
        </div>
        <div class="dzn-content-wrapper pt-4 pb-4">
          <div class="container">
            <div class="row align-items-center dzn-page-title">
              <div class="col-lg-6">
                <h3>All Projects <span class="capsule-subtitle bg-gray">53</span></h3>
              </div>
              <div class="col-lg-6 text-end">
                <ul class="d-flex justify-content-end gap-3 dzn-ul-sort">
                  <li><input type="text" value="Date" name="daterange" class="form-control" placeholder="Date"></li>
                  <li>
                    <select class="form-select form-control" aria-label="Default select example">
                      <option selected>Type</option>
                      <option value="1">One</option>
                      <option value="2">Two</option>
                      <option value="3">Three</option>
                    </select>
                  </li>
                  <li>
                    <select class="form-select form-control" aria-label="Default select example">
                      <option selected>Sort by</option>
                      <option value="1">One</option>
                      <option value="2">Two</option>
                      <option value="3">Three</option>
                    </select>
                  </li>
                </ul>
              </div>
            </div>
            <div class="row dzn-page-subtitle dzn-date-hr pt-4">
              <div class="col-lg-12">
                <p>
                  <span class="dzn-date-wrapper">
                    <span class="subtitle-month">August</span> <span class="subtitle-date">2024</span>
                  </span>
                </p>
              </div>
            </div>
            <div class="row dzn-project-overview-wrapper pt-4">
              <div class="col-lg-12">
                <div class="dzn-project-overview-container">
                  <?php for ($i = 0; $i < 3; $i++): ?>
                    <div class="dzn-projects-list">
                      <?php //include('components/project-overview.php'); ?>
                    </div>
                  <?php endfor; ?>
                  <div class="dzn-projects-list">
                    <?php //require_once('components/project-overview-hold.php'); ?>
                  </div>
                  <div class="dzn-projects-list">
                    <?php // require_once('components/project-overview-status.php'); ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="row dzn-project-overview-wrapper pt-4">
            <?php //require_once('components/pagination.php'); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php 

get_admin_footer(); ?>