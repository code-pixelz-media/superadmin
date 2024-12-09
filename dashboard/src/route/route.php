<?php
require_once __DIR__ . '/../core/index.php'; // Define allowed routes
$allowed_routes = [
    'login'    => 'views/login.php',
    'register' => 'views/register.php',
    'about' => 'views/about.php',
    'verify' => 'views/otp_verification.php',
    'reset' => 'views/reset-password.php',
    'forgot' => 'views/forget-password.php',
    'update-password' => 'views/update-password.php',
    '/dashboard' => 'views/dashboard/dashboard.php'
];

// Get the current page from the URL
$request_path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

// Check if the requested page is in the allowed routes
if (isset($allowed_routes[$request_path])) {
    // Include the page content based on the route
    include $allowed_routes[$request_path];
} else {


    // If the page is not allowed, redirect to a 404 page or show an error
    header('HTTP/1.0 404 Not Found');
    include 'views/home.php';  // Or any other action (redirect, error page, etc.)
    exit;
}

