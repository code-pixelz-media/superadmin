<?php
include('public/variables.php');
?>
<!DOCTYPE html>
<html>

<head>
  <title><?php echo SITE_NAME; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Dezyns">
  <meta name="keywords" content="Dezyns, Project management system">
  <meta name="author" content="White label WP">
  <!-- Bootstrap -->
  <link href="public/<?php echo  ASSET_URL; ?>css/bootstrap.css" rel="stylesheet" />
  <link href="public/<?php echo  ASSET_URL; ?>css/reset.css" rel="stylesheet" />
  <link href="public/<?php echo  ASSET_URL; ?>css/layout.css" rel="stylesheet" />
  <link href="public/<?php echo  ASSET_URL; ?>css/font-awesome.css" rel="stylesheet" />
  <link href="public/<?php echo  ASSET_URL; ?>css/fancybox.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
</head>

<body class="bg-black-shade-1 bg-image-login">
  <header class="container">
    <section class="dzn-header">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 dzn-left-sidebar">
            <div class="logo pt-3 pb-3"><img src="public/<?php echo  ASSET_URL; ?>images/logo.png" alt="<?php echo SITE_NAME; ?>"></div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-end">
            <div class="dzn-header-right pt-3 pb-3">
              <a href="register.php" class="dzn-button bg-black-shade-2 dzn-btn color-white">Create account</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </header>