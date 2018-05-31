<?php

use TubeHousePrice\Application\DatabaseConnection\SqliteConnection;
use TubeHousePrice\Application\ListingController;
use TubeHousePrice\Listing\Repository\SqliteListingRepository;

$container = new League\Container\Container;

$container->add('sqlite_database_connection', function () {
    // TODO: get this value from config
    $pathToDatabaseFile = __DIR__.'/../../resources/sqlite/database/tube_house_prices.db';
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