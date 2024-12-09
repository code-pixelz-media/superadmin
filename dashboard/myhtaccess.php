<?php
// Check if the server software is Apache
if (strpos($_SERVER['SERVER_SOFTWARE'], 'Apache') !== false) {
    
    // Define the .htaccess file path
    $htaccessFile = __DIR__ . '/.htaccess';

    // Check if the .htaccess file exists
    if (!file_exists($htaccessFile)) {
        
        // Define the rewrite rules to be added to .htaccess
        $htaccessContent = <<<EOT
RewriteEngine On
RewriteBase /

# Redirect any URL ending with .php to the URL without .php
RewriteCond %{THE_REQUEST} \\s/([^.]+)\\.php[\\s?] [NC]
RewriteRule ^ %1 [R=301,L]

# Rewrite URLs without .php to access the .php files
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME}.php -f
RewriteRule ^(.*)$ $1.php [L,QSA]

# If the URL does not match any file or directory, load the home page
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^ /index.php [L]
EOT;

        // Attempt to create the .htaccess file and write the content
        if (file_put_contents($htaccessFile, $htaccessContent) !== false) {
            echo ".htaccess file created successfully with rewrite rules.";
        } else {
            echo "Failed to create the .htaccess file. Check permissions.";
        }
    } else {
        echo ".htaccess file already exists. No changes were made.";
    }

} else {
    echo "This server is not running Apache. .htaccess rules are only applicable for Apache servers.";
}
?>
