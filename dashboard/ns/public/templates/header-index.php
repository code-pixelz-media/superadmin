<?php
include('public/variables.php');
$url_pages = $_SERVER['REQUEST_URI'];
$ex_pages = explode("/", $url_pages);
$curr_page = $ex_pages[count($ex_pages) - 1];

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
  <link href="public/<?php echo  ASSET_URL; ?>css/responsive.css" rel="stylesheet" />
  <link href="https://unpkg.com/swiper@11.1.15/swiper-bundle.min.css" rel="stylesheet" />
  <link href="public/<?php echo  ASSET_URL; ?>css/font-awesome.css" rel="stylesheet" />
  <link href="public/<?php echo  ASSET_URL; ?>css/fancybox.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
</head>

<body class="bg-black-shade-1 home-page">
  <header class="container">
    <section class="dzn-header">
      <div class="container">
        <div class="row">
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-3 dzn-left-sidebar">
            <div class="logo pt-3 pb-3"><img src="public/<?php echo  ASSET_URL; ?>images/logo.png" alt="<?php echo SITE_NAME; ?>"></div>
          </div>
          <div class="col-lg-6 col-md-7 col-sm-12 col-xs-12 col -12 navbar-container">
            <nav class="navbar navbar-expand-lg">
              <div class="navbar-content">
                
                <div class="justify-content-center" id="navbarNavDropdown">
                  <ul class="navbar-nav">
                    <li class="nav-item active">
                      <a class="nav-link" aria-current="page" href="#">How it works</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#benefits">Benefits</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#services"><span class="bg-yellow dzn-capsule-small color-black">New</span>Services</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#pricing">Pricing</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#faqs">FAQs</a>
                    </li>
                  </ul>
                </div>
              </div>
            </nav>
          </div>
          <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12 col-9 d-flex justify-content-end align-items-center">
            <div class="dzn-header-right pt-3 pb-3">
              <ul class="d-flex gap-2">
                <li><a href="register.php" class="dzn-button dzn-border-color-header dzn-btn-border dzn-btn color-white">&#128536; &nbsp;Login</a></li>
                <li><a href="register.php" class="dzn-button bg-blue dzn-btn color-white">Start Project</a></li>
              </ul>

            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 offset-lg-3 text-center dzn-hero-section">
            <span class="smallfont dzn-capsule-frontend dzn-border-color-header dzn-btn-border color-white">&#10022; More than 200+ companies trusted us worldwide</span>
            <h1 class="color-white">Creating next level <br>
              digital products</h1>
            <span class="smallfont color-white">Design subscriptions for everyone. Pause or cancel anytime.</span>
            <div class="hero-btn-wrapper">
              <a href="#" class="dzn-button hero-button bg-blue dzn-btn color-white"><img src="public/<?php echo  ASSET_URL; ?>images/icon-dots.svg"> See Plan</a>
            </div>
            <div class="hero-reviews-wrapper d-flex gap-2 justify-content-center">
              <div class="dzn-reviewer">
                <ul class="d-flex">
                  <li><img src="public/<?php echo  ASSET_URL; ?>images/user.png"></li>
                  <li><img src="public/<?php echo  ASSET_URL; ?>images/user.png"></li>
                  <li><img src="public/<?php echo  ASSET_URL; ?>images/user.png"></li>
                </ul>
              </div>
              <div class="hero-reviews">
                <ul class="d-flex justify-content-between star-ratings color-orange">
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><span class="fw-500 color-white">5.0</span></li>
                </ul>
                <span class="smallfont color-white"> From 150+ Reviews </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </header>