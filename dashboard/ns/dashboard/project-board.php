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

        <div class="dzn-content-wrapper pt-4 pb-4">
          <div class="container dzn-content-wrapper-container d-flex">
            <?php include_once('components/project-details-title.php'); ?>
            <div class="row align-items-center dzn-page-title">
              <div class="col-lg-12">
                <?php include_once('components/project-tabs.php'); ?>
              </div>
            </div>
            <div class="row dzn-project-overview-wrapper pt-0">
              <?php require_once('components/pagination.php'); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php include_once('templates/footer.php'); ?>