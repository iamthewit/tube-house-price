<?php

namespace TubeHousePrice\Listing\Repository;

use TubeHousePrice\Application\DatabaseConnection\SqliteConnection;
use TubeHousePrice\Listing\ListingEntity;

require __DIR__.'/../../../../vendor/autoload.php';

class SqliteListingRepository implements ListingRepositoryInterface
{
    private $databaseConnection;
    private $tableName = 'listings';

    
    public function __construct(SqliteConnection $databaseConnection)
    {
        $this->databaseConnection = $databaseConnection;
    }

    public function find(): ListingRepositoryInterface
    {
        // TODO: Implement find() method.
    }


    public function commit(ListingEntity $entity): void
    {
        $where = ['id' => $entity->getId()];

        // check if a row in the DB exists with this id
        if ($this->databaseConnection->has($this->tableName, $where)) {
            // update
            $this->databaseConnection->update($this->tableName, $entity->asArray(), $where);
        }

        // create
        $this->databaseConnection->insert($this->tableName, $entity->asArray());
    }
}