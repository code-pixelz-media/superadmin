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
    <meta property="og:image" content="<?php echo ASSET_URL; ?>assets/images/share-image.jpg"> <!-- Replace with a real image -->
    <meta property="og:url" content="http://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($title); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($description); ?>">
    <meta name="twitter:image" content="<?php echo ASSET_URL; ?>assets/images/share-image.jpg"> <!-- Replace with a real image -->

    <!-- Add other SEO meta tags as needed -->
<?php 
enqueue_style('bootstrap','reset','layout-dashboard','responsive-dashboard','font-awesome','fancybox','fileUpload','ckeditor5','daterangepicker','gijgo','font-google');
?>
</head>
<body>
  <header>
    <section class="dzn-header">
      <div class="container">
        <div class="row">
          <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 dzn-left-sidebar">
            <div class="logo pt-3 pb-3"><a href="index.php"><img src="<?php echo  ASSET_URL; ?>assets/images/logo-black.png" alt="<?php echo SITE_NAME; ?>"></a></div>
          </div>
          <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 dzn-header-right-wrapper">
            <div class="dzn-header-right pt-3 pb-3">
              <div class="container">
                <div class="row d-flex justify-content-between align-items-center">
                  <div class="col-md-3">
                    <div class="dzn-search">
                      <div class="form-group has-search d-flex">
                        <input type="text" class="form-control" placeholder="Search">
                        <img src="<?php echo  ASSET_URL; ?>assets/images/search-normal.svg" alt="<?php echo SITE_NAME; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <ul class="d-flex justify-content-end dzn-header-right-buttons header-icons-right">
                      <li><a href="create-project.php"><img src="<?php echo  ASSET_URL; ?>assets/images/icon-plus.svg" /> New Project</a></li>
                      <li><a href="#offcanvas_Notification" data-bs-toggle="offcanvas" role="button" aria-controls="offcanvas_Notification"><img src="<?php echo  ASSET_URL; ?>assets/images/notification.svg" /> <span class="bg-red color-white">12</span></a></li>
                      <li><a href=""><img src="<?php echo  ASSET_URL; ?>assets/images/user.png" alt="User Name" /></a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </header>
  <div class="offcanvas offcanvas-end dzn-offcanvas" tabindex="-1" id="offcanvas_Notification" aria labelledby="offcanvasNotificationLabel">
    <?php //include('components/offcanvas-notification.php'); ?>
  </div>

