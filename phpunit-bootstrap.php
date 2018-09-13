<?php
require_once __DIR__.'/index.php';

$rootPath = getenv('PROJECT_ROOT_PATH');
$dbPath = $rootPath.'/resources/sqlite/database/'.getenv('SQLITE_DATABASE_FILENAME');

// delete existing test DB
if (file_exists($dbPath)) {
    unlink($dbPath);
}

// touch new test DB
touch($dbPath);

// migrate DB
$conn = new \TubeHousePrice\Application\DatabaseConnection\SqliteConnection($dbPath);
$conn->exec(file_get_contents($rootPath.'/resources/sqlite/migrations/migrations.sql'));
