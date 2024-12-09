<?php
//enqueue_style('bootstrap','reset','layout','responsive','font-awesome','fancybox','fileUpload','ckeditor5','daterangepicker','gijgo','font-google');
function enqueue_style() {
    // Define local CSS files with their handle (relative to root)
    $css_files = [
        'bootstrap'   => 'assets/css/bootstrap.css',
        'reset'       => 'assets/css/reset.css',
        'layout-dashboard'      => 'assets/css/layout-dashboard.css',
        'layout-public'      => 'assets/css/layout-public.css',
        'responsive-dashboard' => 'assets/css/responsive-dashboard.css',
        'responsive-public' => 'assets/css/responsive-public.css',
        'font-awesome'=> 'assets/css/font-awesome.css',
        'fancybox'    => 'assets/css/fancybox.css',
        'fileUpload' => 'assets/css/fileUpload.css',
    ];

    // Define external CSS file URLs with their handle
    $external_css_files = [
        'daterangepicker' => 'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css',
        'ckeditor5' => 'https://cdn.ckeditor.com/ckeditor5/43.3.1/ckeditor5.css',
        'font-google' => 'https://fonts.googleapis.com/css?family=Material+Icons+Outlined',
        'gijgo' => 'https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css'
        // Add more external CSS files as needed
    ];

    // Loop through each comma-separated handle passed
    $handles = func_get_args();
    
    foreach ($handles as $handle) {
        // Check if the handle exists in the local files array
        if (array_key_exists($handle, $css_files)) {
            $file_path = ASSET_URL . $css_files[$handle];
            echo '<link rel="stylesheet" id="' . $handle . '-css" href="' . $file_path . '" media="all" />' . PHP_EOL;
            echo '<!-- Loaded CSS: ' . $handle . ' -->' . PHP_EOL; // Display handle in a comment
        }
        // Check if the handle exists in the external files array
        elseif (array_key_exists($handle, $external_css_files)) {
            // Appending version query to the external CSS file for cache busting
            echo '<link rel="stylesheet" id="' . $handle . '-css" href="' . $external_css_files[$handle] . '?ver=' . time() . '" media="all" />' . PHP_EOL;
            echo '<!-- Loaded CSS: ' . $handle . ' (External URL) -->' . PHP_EOL; // Display handle for external URL
        }
        else {
            // Handle missing CSS files (optional)
            echo '<!-- CSS File Not Found: ' . $handle . ' -->' . PHP_EOL;
        }
    }
}

// Function to enqueue scripts (JS)
function enqueue_script() {
    // Define local JS files with their handle (relative to root)
    $js_files = [
        'jquery' => 'assets/js/jquery.js',
        'bootstrap' => 'assets/js/bootstrap.js',
        'fancybox' => 'assets/js/fancybox.js',
        'custom-public' => 'assets/js/custom-public.js',
        'custom-dashboard' => 'assets/js/custom-dashboard.js',
  
        // Add other local JS files as needed
    ];

    // Define external JS file URLs with their handle
    $external_js_files = [
        'daterangepicker' => 'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.js',
        'google-captcha' => 'https://www.google.com/recaptcha/api.js',
        'moment' => 'https://cdn.jsdelivr.net/momentjs/latest/moment.min.js'
        // Add more external JS files as needed
    ];

    // Loop through each comma-separated handle passed
    $handles = func_get_args();

    foreach ($handles as $handle) {
        // Check if the handle exists in the local files array
        if (array_key_exists($handle, $js_files)) {
            $file_path = ASSET_URL . $js_files[$handle];
            echo '<script src="' . $file_path . '" id="' . $handle . '-js"></script>' . PHP_EOL;
            echo '<!-- Loaded JS: ' . $handle . ' -->' . PHP_EOL; // Display handle in a comment
        }
        // Check if the handle exists in the external files array
        elseif (array_key_exists($handle, $external_js_files)) {
            // Appending version query to the external JS file for cache busting
            echo '<script src="' . $external_js_files[$handle] . '?ver=' . time() . '" id="' . $handle . '-js"></script>' . PHP_EOL;
            echo '<!-- Loaded JS: ' . $handle . ' (External URL) -->' . PHP_EOL; // Display handle for external URL
        }
        else {
            // Handle missing JS files (optional)
            echo '<!-- JS File Not Found: ' . $handle . ' -->' . PHP_EOL;
        }
    }
}






 // This gets the current directory and appends a forward slash

// Function to include the header file
// src/core/functions.php

function get_header() {
    include('views/header.php');
}

// Function to include the footer file
function get_footer() {
    include('views/footer.php');
}
function get_admin_header() {
    include('views/admin-header.php');
}

// Function to include the footer file
function get_admin_footer() {
    include('views/admin-footer.php');
}