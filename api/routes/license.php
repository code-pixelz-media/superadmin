<?php
// api/routes/license.php

$router->addRoute('POST', '/generatetoken', [new LicenseController(), 'token']);
$router->addRoute('POST', '/license/create', [new LicenseController(), 'createLicense']);
$router->addRoute('POST', '/license/verify', [new LicenseController(), 'verify']);
// $router->addRoute('POST', '/licenses', [new LicenseController(), 'getAll']);
$router->addRoute('POST', '/license/activate', [new LicenseController(), 'activate']);
$router->addRoute('POST', '/license/deactivate', [new LicenseController(), 'deactivate']);