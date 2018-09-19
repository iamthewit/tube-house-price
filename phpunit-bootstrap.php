<?php

require_once __DIR__.'/src/TubeHousePrice/bootstrap.php';

$rootPath = getenv('PROJECT_ROOT_PATH');

$dbPath = \TubeHousePrice\Application\Config::get('paths.sqlite_database');
$dbPath = $dbPath.'/'.getenv('SQLITE_DATABASE_FILENAME');

// delete existing test DB
if (file_exists($dbPath)) {
    unlink($dbPath);
}

// touch new test DB
touch($dbPath);

// migrate DB
$migrationsPath = \TubeHousePrice\Application\Config::get('paths.sqlite_migrations');

$conn = new \TubeHousePrice\Application\DatabaseConnection\SqliteConnection($dbPath);
$conn->exec(file_get_contents($migrationsPath.'/migrations.sql'));
