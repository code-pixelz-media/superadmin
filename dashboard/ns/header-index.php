<?php


// Set the default title and description
$title = "My Dynamic Site"; // Default title
$description = "Welcome to the official website of My Dynamic Site."; // Default description
$keywords = "Dynamic Site, PHP, SEO, Web Development"; // Default keywords

// Get the current URL to determine the dynamic title
$current_url = $_SERVER['REQUEST_URI'];

// Customize title and meta tags based on the current URL
if ($current_url == "/") {
    // For the homepage
    $title = SITE_NAME;
    $description = "The best place to learn about our services and offers.";
    $keywords = "home, dynamic site, services";
} elseif ($current_url == "/register") {
    // For the contact page
    $title = "Create An Account - ".SITE_NAME;
    $description = "";
    $keywords = "contact, get in touch, customer support";
} elseif ($current_url == "/dashboard") {
    // For the about page
    $title = "About Us - My Dynamic Site";
    $description = "Learn more about the mission and vision of My Dynamic Site.";
    $keywords = "about us, company, mission, vision";
}

// Optional: Use more sophisticated logic based on the URL or query parameters
// For example, you can parse specific parameters in the URL to dynamically adjust the meta tags
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Dynamic Title -->
    <title><?php echo htmlspecialchars($title); ?></title>

    <!-- Meta Description -->
    <meta name="description" content="<?php echo htmlspecialchars($description); ?>">

    <!-- Meta Keywords -->
    <meta name="keywords" content="<?php echo htmlspecialchars($keywords); ?>">

    <!-- Open Graph Meta Tags for better sharing on social media -->
    <meta property="og:title" content="<?php echo htmlspecialchars($title); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($description); ?>">
    <meta property="og:image" content="<?php echo ASSET_URL; ?>assets/images/share-image.jpg"> <!-- Replace with a real image -->
    <meta property="og:url" content="http://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($title); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($description); ?>">
    <meta name="twitter:image" content="<?php echo ASSET_URL; ?>assets/images/share-image.jpg"> <!-- Replace with a real image -->

    <!-- Add other SEO meta tags as needed -->
<?php 

enqueue_style('bootstrap','reset','layout-public','responsive-public','font-awesome','fancybox','font-google' ,'swiper');
?>
</head>

<body class="bg-black-shade-1 home-page">
  <header class="container">
    <section class="dzn-header">
      <div class="container">
        <div class="row">
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-3 dzn-left-sidebar">
            <div class="logo pt-3 pb-3"><img src="<?php echo  ASSET_URL; ?>assets/images/logo.png" alt="<?php echo SITE_NAME; ?>"></div>
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
                <li><img src="<?php echo  ASSET_URL; ?>assets/images/user.png"></li>
                  <li><img src="<?php echo  ASSET_URL; ?>assets/images/user.png"></li>
                  <li><img src="<?php echo  ASSET_URL; ?>assets/images/user.png"></li>
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