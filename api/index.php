<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

require_once __DIR__ . '/config/config.php';

require_once __DIR__ . '/models/DatabaseInstaller.php';
require_once __DIR__ . '/models/Database.php';
require_once __DIR__ . '/models/license.php';
require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/helpers/JwtHelper.php';


require_once __DIR__ .'/controllers/RestController.php';
require_once __DIR__ . '/controllers/LicenseController.php';
require_once __DIR__ . '/routes/index.php';

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




$basePath = '/api';

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestUri = str_replace($basePath, '', $requestUri);
$requestUri = rtrim($requestUri, '/');

var_dump($requestUri);

$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestMethod === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$router->dispatch($requestMethod, $requestUri);
