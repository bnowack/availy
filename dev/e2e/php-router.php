<?php

/**
 * Router script for developing and testing Polymorph applications
 */

// don't allow access to the router script during production
if (php_sapi_name() !== 'cli-server') {
    die('The router script is only available during development');
}

// Ensure time() is E_STRICT-compliant
date_default_timezone_set(@date_default_timezone_get());

// Define polymorph app path constant (root is 2 hops up from `dev/e2e/php-router.php`)
define("POLYMORPH_APP_DIR", dirname(dirname(__DIR__)) . '/');

// Define polymorph source path constant
define("POLYMORPH_SRC_DIR", POLYMORPH_APP_DIR . 'vendor/bnowack/polymorph/src/');

// Include autoloader
require_once POLYMORPH_APP_DIR . 'vendor/autoload.php';

$asset = POLYMORPH_APP_DIR . ltrim(preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']), '/');

if (strpos($asset, 'bower_components/font-roboto/roboto.html') !== false) {
    return;// don't load roboto font
}
else if (is_file($asset)) {// Serve static assets
    return false;
} else {// Serve dynamic contents
    $app = new Polymorph\Application\Application();
    $app['debug'] = true;
    $app['config.files'] = [
        POLYMORPH_SRC_DIR . 'Polymorph/Application/config/base-config.json',// base config
        POLYMORPH_APP_DIR . 'config/app-config.json'// app config
    ];
    $app->run();
}
