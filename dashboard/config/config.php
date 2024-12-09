

<?php 
// Get the current protocol (http or https)
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';

// Get the host (domain or localhost)
$host = $_SERVER['HTTP_HOST']; // This gives you 'dzyns.ravi.np:8888' or 'example.com'

// Get the full URL
$site_url = $protocol . '://' . $host;
define('ABSPATH', dirname(__FILE__) .$site_url.'/'); //'http://dzyns.ravi.np:8888/'
define('HOMEPAGE_URL', 'https://dzyns.codepixelz.tech/'); // Set your homepage URL
define('DB_HOST', 'localhost'); // Your database host
define('DB_NAME', 'license_verification'); // Your database name
define('DB_USER', 'root'); // Your data
define('DB_PASS', 'root'); // Your database password
define('PREFIX', 'wall');  // Your table prefix
define ('SITE_NAME', 'WooEscrowSuperAdmin');
define('CURRENT_PAGE', $_SERVER['REQUEST_URI']);
//define('ASSET_URL', 'public/');
// Define the base URL for your assets (adjust the path accordingly)
//define('ASSET_URL', rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/');
define('ASSET_URL',HOMEPAGE_URL.'/public/'); //http://dzyns.ravi.np:8888/public/
define('PUBLIC_PATH', '/public/assets/');
define('SETTINGS_GOOGLEPUBLICKEY', '6Ld8NHsqAAAAAN2vbpCanP1lRbGFvOHH7UUBAZp5'); 
define('SETTINGS_GOOGLESECRETKEY', '6Ld8NHsqAAAAALKsWnOjU1c_Kd93Oj-xNQEUOKqt'); 
//
define('ROOT_URL', '/');
//define('ROOT_PATH', 'http://dzyns.ravi.np:8888/');
define('ROOT_PATH', __DIR__ . '/');  // Absolute path to the 'config' folder

define('HOME_URL', './');
define ('MOBILE_NUMBER','015919874');
define ('EMAIL','info@superadmin.com');
define('GMAP_LINK','');
define('ADDRESS','Dezyns, Ekantakuna');

