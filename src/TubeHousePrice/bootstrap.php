<?php

$rootPath = __DIR__.'/../../';

require_once $rootPath.'vendor/autoload.php';

$dotenv = new Dotenv\Dotenv($rootPath);
$dotenv->load();

require_once __DIR__.'/container.php';

// Enable to test the FE
// TODO: use a router
//return $container->get('listing_controller');
