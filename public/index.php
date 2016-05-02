<?php
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $file = __DIR__ . $_SERVER['REQUEST_URI'];
    if (is_file($file)) {
        return false;
    }
}

define('DEVENV', true); // You must remove this line in production

define('PUBDIR', __DIR__);
define('SYSDIR', __DIR__ . '/../');
define('APPDIR', SYSDIR . '/app');

require SYSDIR . '/vendor/autoload.php';

session_start();

// Instantiate the app
$config = require APPDIR . '/core/config.php';
$app = new \Slim\App($config);

// Set up dependencies
require APPDIR . '/core/dependencies.php';

// Register middleware
require APPDIR . '/core/middleware.php';

// Register routes
require APPDIR . '/routes.php';

// Run app
$app->run();
