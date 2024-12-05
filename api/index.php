<?php

// Header Output Types
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');


// Configuration files for database and constants
require_once __DIR__ . '/config/config.php';


//Models Database Management 
require_once __DIR__ . '/models/DatabaseInstaller.php';
require_once __DIR__ . '/models/Database.php';
require_once __DIR__ . '/models/License.php';

// Controllers
require_once __DIR__ .'/controllers/RestController.php';
require_once __DIR__ . '/controllers/LicenseController.php';
require_once __DIR__ . '/routes/index.php';


// Sometimes not working when database credentials doesnot provide prvilieges to create database
$installer = new DatabaseInstaller();
if (!$installer->isInstalled()) {
    if ($installer->install()) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Database installed successfully',
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Database installation failed',
        ]);
        exit;
    }
} 



// Getting Paths From URL
$scriptName = dirname($_SERVER['SCRIPT_NAME']);
$basePath = rtrim($scriptName, '/');
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestUri = str_replace($basePath, '', $requestUri);
$requestUri = rtrim($requestUri, '/');
$requestMethod = $_SERVER['REQUEST_METHOD'];


if ($requestMethod === 'OPTIONS') {
    http_response_code(200);
    exit;
}


// All Routes appearing after /api/ will be handled by this dispatch method from /routes/
$router->dispatch($requestMethod, $requestUri);
