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
<html lang="en">
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
    <meta property="og:image" content="<?php echo ASSET_URL; ?>public/images/share-image.jpg"> <!-- Replace with a real image -->
    <meta property="og:url" content="http://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($title); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($description); ?>">
    <meta name="twitter:image" content="<?php echo ASSET_URL; ?>public/images/share-image.jpg"> <!-- Replace with a real image -->

    <!-- Add other SEO meta tags as needed -->
<?php 
enqueue_style('bootstrap','reset','layout-public','font-awesome','fancybox','daterangepicker');
?>

</head>

<body class="bg-black-shade-1 bg-image-login login-page">
<header>
    <section class="dzn-header">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 dzn-left-sidebar">
            <div class="logo pt-3 pb-3"><img src="<?php echo  PUBLIC_PATH; ?>images/logo-white.png" alt="<?php echo SITE_NAME; ?>"></div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-end">
            <!-- <div class="dzn-header-right pt-3 pb-3">
              <a href="register.php" class="dzn-button bg-black-shade-2 dzn-btn color-white">Create account</a>
            </div> -->
<?php


if (CURRENT_PAGE === '/login' || CURRENT_PAGE === '/login/') {


              // For all other pages
    echo '<div class="dzn-header-right pt-3 pb-3">
    <a href="/register" class="dzn-button bg-black-shade-2 dzn-btn color-white">Create account</a>
</div>';
} else {
      // If the current page is /login
      echo '<div class="dzn-header-right pt-3 pb-3">
      <a href="/login" class="dzn-button bg-black-shade-2 dzn-btn color-white dzn-smiley-wrapper"> <span class="dzn-smiley">&#x1F618; </span> <span class="dzn-smiley-login">Login</span></a>
  </div>';

}
?>

          </div>
        </div>
      </div>
    </section>
  </header>