<?php

use TubeHousePrice\Application\DatabaseConnection\SqliteConnection;
use TubeHousePrice\Application\Controller\ListingController;
use TubeHousePrice\Application\Repository\SqliteListingRepository;

$container = new League\Container\Container;

$container->add('sqlite_database_connection', function () {
    $pathToDatabaseFile = getenv('PROJECT_ROOT_PATH').getenv('SQLITE_DATABASE_PATH');
    return new SqliteConnection($pathToDatabaseFile);
});

$container->add('sqlite_listing_repository', function () use ($container) {
    return new SqliteListingRepository($container->get('sqlite_database_connection'));
});

$container->add('listing_controller', function () use ($container) {
    $listingRepository = $container->get('sqlite_listing_repository');
    return new ListingController($listingRepository);
});

return $container;