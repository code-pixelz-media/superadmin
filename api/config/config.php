<?php
$baseDir = __DIR__ . '/../';


define('DISPLAY_ERRORS', true);

// Database Configuration
if ($_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['SERVER_NAME'] == '127.0.0.1') {
    // Local development settings
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'license_verification');   
    define('DB_USER', 'root');
    define('DB_PASS', 'root');
} else {
    // Live server settings
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'wooescrow_superadmin');   
    define('DB_USER', 'wooescrow_superadmin');
    define('DB_PASS', 'root');
}


define('JWT_SECRET_KEY', 'your-secret-key'); 
define('JWT_REFRESH_SECRET_KEY', 'your-refresh-secret-key'); 
define('JWT_ACCESS_TOKEN_EXPIRY', 86400); 
define('JWT_REFRESH_TOKEN_EXPIRY', 604800); 
define('JWT_KEYS_PATH', $baseDir . 'config/jwt_keys.php');

// API Configuration
define('API_VERSION', '1.0');
	
/*Data Type*/
define('BOOLEAN', 	'1');
define('INTEGER', 	'2');
define('STRING', 	'3');

/*Error Codes*/
define('REQUEST_METHOD_NOT_VALID',		        100);
define('REQUEST_CONTENTTYPE_NOT_VALID',	        101);
define('REQUEST_NOT_VALID', 			        102);
define('VALIDATE_PARAMETER_REQUIRED', 			103);
define('VALIDATE_PARAMETER_DATATYPE', 			104);
define('API_NAME_REQUIRED', 					105);
define('API_PARAM_REQUIRED', 					106);
define('API_DOST_NOT_EXIST', 					107);
define('INVALID_USER_PASS', 					108);
define('USER_NOT_ACTIVE', 						109);
define('SUCCESS_RESPONSE', 						200);

/*Server Errors*/
define('JWT_PROCESSING_ERROR',					300);
define('ATHORIZATION_HEADER_NOT_FOUND',			301);
define('ACCESS_TOKEN_ERRORS',					302);	


// Enable Error Display
if(defined('DISPLAY_ERROR') && DISPLAY_ERRORS){

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

}
