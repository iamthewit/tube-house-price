<?php

$rootPath = __DIR__.'/../../';

require_once $rootPath.'vendor/autoload.php';

$dotenv = new Dotenv\Dotenv($rootPath);
$dotenv->load();

require_once __DIR__.'/container.php';

require_once __DIR__.'/routes.php';
