<?php

use TubeHousePrice\Application\DatabaseConnection\SqliteConnection;
use TubeHousePrice\Application\Controller\ListingController;
use TubeHousePrice\Application\Repository\SqliteListingRepository;
use TubeHousePrice\Application\Service\ListingService;

$container = new League\Container\Container;

$container->add('sqlite_database_connection', function () {
    $pathToDatabaseFile = getenv('PROJECT_ROOT_PATH')
        .'/resources/sqlite/database/'
        .getenv('SQLITE_DATABASE_FILENAME');
    return new SqliteConnection($pathToDatabaseFile);
});

$container->add('sqlite_listing_repository', function () use ($container) {
    return new SqliteListingRepository($container->get('sqlite_database_connection'));
});

$container->add('listing_controller', function () use ($container) {
    $listingService = $container->get('listing_service');
    return new ListingController($listingService);
});

$container->add('listing_service', function () use ($container) {
    $listingRepository = $container->get('sqlite_listing_repository');
    return new ListingService($listingRepository);
});

return $container;
