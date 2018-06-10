<?php

namespace TubeHousePrice\Listing\Repository;

use TubeHousePrice\Application\DatabaseConnection\SqliteConnection;
use TubeHousePrice\Listing\Exception\ListingNotFoundInRepositoryException;
use TubeHousePrice\Listing\ListingEntity;
use TubeHousePrice\Listing\ListingEntityCollection;

class SqliteListingRepository implements ListingRepositoryInterface
{
    private $databaseConnection;
    private $tableName = 'listings';
    private $columns = ['id', 'currency_code', 'currency_minor_unit_value', 'latitude', 'longitude'];
    
    /**
     * SqliteListingRepository constructor.
     *
     * @param SqliteConnection $databaseConnection
     */
    public function __construct(SqliteConnection $databaseConnection)
    {
        $this->databaseConnection = $databaseConnection;
    }
    
    /**
     * @param $id
     *
     * @return ListingEntity
     * @throws ListingNotFoundInRepositoryException
     */
    public function find($id): ListingEntity
    {
        $where = ['id' => $id];
        
        $result = $this->databaseConnection->select($this->tableName, $this->columns, $where);
        
        if(!$result || count($result) === 0) {
            throw new ListingNotFoundInRepositoryException();
        }
        
        return ListingEntity::fromArray($result[0]);
    }
    
    /**
     * @param array $where
     *
     * @return ListingEntityCollection
     * @throws ListingNotFoundInRepositoryException
     */
    public function findWhere(array $where): ListingEntityCollection
    {
        $results = $this->databaseConnection->select($this->tableName, $this->columns, $where);
    
        if(!$results || count($results) === 0) {
            throw new ListingNotFoundInRepositoryException();
        }
        
        $collection = new ListingEntityCollection();
        
        foreach ($results as $result) {
            $listingEntity = ListingEntity::fromArray($result);
            $collection->add($listingEntity);
        }
        
        return $collection;
    }
    
    
    /**
     * @param ListingEntity $entity
     */
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