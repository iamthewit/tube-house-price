<?php declare(strict_types=1);

$rootPath = __DIR__.'/../../';

require_once $rootPath.'vendor/autoload.php';

$dotenv = new Dotenv\Dotenv($rootPath);
$dotenv->load();

require_once __DIR__.'/container.php';
