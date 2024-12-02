<?php
// api/routes/license.php

//Routes For License
$router->addRoute('POST', '/generatetoken', [new LicenseController(), 'token']);

// /license/verify ==> endpont url
// verify ==> Function name in license controller
$router->addRoute('POST', '/license/verify', [new LicenseController(), 'verify']);
$router->addRoute('POST', '/refreshtoken', [new LicenseController(), 'refreshtoken']);



$router->addRoute('POST', '/licenses', [new LicenseController(), 'getAll']);

$router->addRoute('POST', '/license/create', [new LicenseController(), 'createLicense']);
$router->addRoute('POST', '/license/activate', [new LicenseController(), 'activate']);
$router->addRoute('POST', '/license/deactivate', [new LicenseController(), 'deactivate']);