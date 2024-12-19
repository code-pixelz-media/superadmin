<?php 

define('PREFIX', 'wooescrow_admin_');  
define('SITE_NAME', 'Superadmin');
define('BASE_PATH', rtrim(dirname(__DIR__), '/') . '/'); 
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

$host = $_SERVER['HTTP_HOST'];

$homepageUrl = $protocol . $host . '/';

define('HOST',$_SERVER['SERVER_NAME']);



if(HOST == 'localhost'){
    define('HOMEPAGE_URL', rtrim($homepageUrl, '/') . '/superadmin/');
    define('ASSET_URL', HOMEPAGE_URL . 'dashboard/assets'); 
}else{
    define('HOMEPAGE_URL', rtrim($homepageUrl, '/') . '/');
    define('ASSET_URL', HOMEPAGE_URL . 'dashboard/assets'); 
}


define('PUBLIC_PATH', BASE_PATH . 'assets/');

define('SETTINGS_GOOGLEPUBLICKEY', '6Le0ZZcqAAAAAPlpNGHnN6ajgUSk4jN9YA1ZC0Jl'); 
define('SETTINGS_GOOGLESECRETKEY', '6Le0ZZcqAAAAAPRLuXUTsFc4Y8fkcuv0vnwA_oZX'); 

$scriptDir = dirname($_SERVER['SCRIPT_NAME']);
$baseUrl = rtrim($protocol . $host . $scriptDir, '/') . '/';

define('BASE_URL', $baseUrl);
define('DASHBOARD_BASE_URL', $baseUrl . 'dashboard/'); 


?>