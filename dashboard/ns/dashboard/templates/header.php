<?php include('variables.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo SITE_NAME; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Dezyns">
  <meta name="keywords" content="Dezyns, Project management system">
  <meta name="author" content="White label WP">
  <!-- Bootstrap -->
  <link href="<?php echo  ASSET_URL; ?>/css/bootstrap.css" rel="stylesheet" />
  <link href="<?php echo  ASSET_URL; ?>/css/reset.css" rel="stylesheet" />
  <link href="<?php echo  ASSET_URL; ?>/css/layout.css" rel="stylesheet" />
  <link href="<?php echo  ASSET_URL; ?>/css/responsive.css" rel="stylesheet" />
  <link href="<?php echo  ASSET_URL; ?>/css/font-awesome.css" rel="stylesheet" />
  <link href="<?php echo  ASSET_URL; ?>/css/fancybox.css" rel="stylesheet" />
  <link href="<?php echo  ASSET_URL; ?>/css/fileUpload.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.3.1/ckeditor5.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <link rel="stylesheet" type="text/css" href=" https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined">
</head>
<body>
  <header>
    <section class="dzn-header d-none d-md-block">
      <div class="container">
        <div class="row">
          <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 dzn-left-sidebar">
            <div class="logo pt-3 pb-3"><a href="index.php"><img src="<?php echo  ASSET_URL; ?>/images/logo-black.svg" alt="<?php echo SITE_NAME; ?>"></a></div>
          </div>
          <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 dzn-header-right-wrapper">
            <div class="dzn-header-right pt-3 pb-3">
              <div class="container">
                <div class="row d-flex justify-content-between align-items-center">
                  <div class="col-md-3">
                    <div class="dzn-search">
                      <div class="form-group has-search d-flex">
                        <input type="text" class="form-control" placeholder="Search">
                        <img src="<?php echo  ASSET_URL; ?>/images/search-normal.svg" alt="<?php echo SITE_NAME; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <ul class="d-flex justify-content-end dzn-header-right-buttons header-icons-right">
                      <li><a href="create-project.php"><img src="<?php echo  ASSET_URL; ?>/images/icon-plus.svg" /> New Project</a></li>
                      <li><a href="#offcanvas_Notification" data-bs-toggle="offcanvas" role="button" aria-controls="offcanvas_Notification"><img src="<?php echo  ASSET_URL; ?>/images/notification.svg" /> <span class="bg-red color-white">12</span></a></li>
                      <li><a href=""><img src="<?php echo  ASSET_URL; ?>/images/user.png" alt="User Name" /></a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="dzn-header border-none d-block d-sm-none header-small-screen">
      <div class="container">
        <div class="row">
          <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 col-4 dzn-left-sidebar">
            <div class="logo pt-3 pb-3"><a href="index.php"><img src="<?php echo  ASSET_URL; ?>/images/logo.png" alt="<?php echo SITE_NAME; ?>"></a></div>
          </div>
          <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8 col-8 dzn-header-right-wrapper border-none">
            <div class="dzn-header-right pt-3 pb-3">
              <div class="container">
                <div class="row d-flex justify-content-between align-items-center">
                  <div class="col-md-6">
                    <ul class="d-flex justify-content-end dzn-header-right-buttons header-icons-right">
                      <li><a href="create-project.php"><img src="<?php echo  ASSET_URL; ?>/images/icon-plus.svg" /> </a></li>
                      <li><a href="#offcanvas_Notification" data-bs-toggle="offcanvas" role="button" aria-controls="offcanvas_Notification"><img src="<?php echo  ASSET_URL; ?>/images/notification.svg" /> <span class="bg-red color-white">12</span></a></li>
                      <li><a href=""><img src="<?php echo  ASSET_URL; ?>/images/user.png" alt="User Name" /></a></li>
                      <li class="menuli">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
                          <nav class="navbar navbar-expand-lg navbar-light">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                              <span class="navbar-toggler-icon"></span>
                            </button>
                          </nav>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="dzn-search">
              <div class="form-group has-search d-flex">
                <input type="text" class="form-control" placeholder="Search">
                <img src="<?php echo  ASSET_URL; ?>/images/search-normal.svg" alt="<?php echo SITE_NAME; ?>">
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </header>
  <div class="offcanvas offcanvas-end dzn-offcanvas" tabindex="-1" id="offcanvas_Notification" aria labelledby="offcanvasNotificationLabel">
    <?php include('components/offcanvas-notification.php'); ?>
  </div>
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <a href="index.php"><img src="<?php echo  ASSET_URL; ?>/images/logo.png" alt="<?php echo SITE_NAME; ?>"></a>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <?php include_once('templates/sidebar.php'); ?>
      </div>
      
    </div>
  </div>
</div>