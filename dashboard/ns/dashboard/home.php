<?php include_once('templates/header.php'); ?>
<section class="dzn-main-container">
  <div class="container">
    <div class="row">
      <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 dzn-left-sidebar d-none d-md-block">
        <div class="logo pt-3 pb-3 dzn-main-sidebar">
          <?php include('templates/sidebar.php'); ?>
        </div>
      </div>
      <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 no-padding offset-lg-2 dzn-main-rght-wrapper">
        <div class="dzn-content-wrapper pt-4 pb-4 dzn-page-title-wrapper">
          <div class="container">
            <div class="row align-items-center dzn-page-title">
              <div class="col-lg-6">
                <h2>Hello Danial &#9995;</h2>
              </div>
              <div class="col-lg-6 text-end">
                <p class="smallfont text-end mb-0">Scale up or down as needed, and pause or cancel at anytime.<span class="dzn-capsule-small bg-yellow xxsmallfont ms-2">New</span></p>
              </div>
            </div>
          </div>
        </div>
        <div class="dzn-content-wrapper pt-4 pb-4">
          <div class="container dzn-content-wrapper-container d-flex">
            <div class="row align-items-center dzn-page-title">
              <div class="col-lg-12">
                <h3>Overview</h3>
              </div>

              <div class="col-lg-12">
                <div class="dzn-projects-card-list">
                  <?php include('components/project-card.php'); ?>
                  <?php include('components/project-card.php'); ?>
                  <?php include('components/project-card.php'); ?>
                  <?php include('components/project-card.php'); ?>
                </div>
              </div>
            </div>
            

            <div class="row dzn-project-overview-wrapper">
            <div class="row align-items-center dzn-page-title no-padding-right">
              <div class="col-lg-6 no-padding">
                <h3>Last Project</h3>
              </div>
              <div class="col-lg-6 text-end no-padding-right">
                <p class="text-end mb-0">All Projects</p>
              </div>
            </div>
              <div class="col-lg-12 no-padding">
                <div class="dzn-project-overview-container">
                <div class="dzn-projects-list">
                    <?php require_once('components/project-overview-new.php'); ?>
                  </div>
                 
                  <div class="dzn-projects-list">
                    <?php require_once('components/project-overview-hold.php'); ?>
                  </div>
                  <div class="dzn-projects-list">
                    <?php require_once('components/project-overview-status.php'); ?>
                  </div>
                  <?php for ($i = 0; $i < 3; $i++): ?>
                    <div class="dzn-projects-list">
                      <?php include('components/project-overview.php'); ?>
                    </div>
                  <?php endfor; ?>
                </div>
              </div>
            </div>
            <div class="row dzn-project-overview-wrapper no-padding-top">
              <?php require_once('components/pagination.php'); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php include_once('templates/footer.php'); ?>