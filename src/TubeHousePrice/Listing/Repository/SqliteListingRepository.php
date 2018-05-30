<?php

namespace TubeHousePrice\Listing\Repository;

use Medoo\Medoo;

require __DIR__.'/../../../../vendor/autoload.php';

class SqliteListingRepository implements ListingRepositoryInterface
{
    private $id;
    private $currencyCode;
    private $currencyMinorUnitValue;
    private $latitude;
    private $longitude;

    private $tableName = 'listings';

    /**
     * SqliteListingRepository constructor.
     *
     * @param string $id
     * @param string $currencyCode
     * @param int    $currencyMinorUnitValue
     * @param float  $latitude
     * @param float  $longitude
     */
    public function __construct(string $id, string $currencyCode, int $currencyMinorUnitValue, float $latitude, float $longitude)
    {
        // TODO: validation

        $this->id                     = $id;
        $this->currencyCode           = $currencyCode;
        $this->currencyMinorUnitValue = $currencyMinorUnitValue;
        $this->latitude               = $latitude;
        $this->longitude              = $longitude;
    }


    /**
     * @return mixed
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return ListingRepositoryInterface
     */
    public function setId($id): ListingRepositoryInterface
    {
        // TODO: validation
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCurrencyCode(): string
    {
        return $this->currencyCode;
    }

    /**
     * @param mixed $currencyCode
     *
     * @return ListingRepositoryInterface
     */
    public function setCurrencyCode($currencyCode): ListingRepositoryInterface
    {
        // TODO: validation
        $this->currencyCode = $currencyCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCurrencyMinorUnitValue(): int
    {
        return $this->currencyMinorUnitValue;
    }

    /**
     * @param mixed $currencyMinorUnitValue
     *
     * @return ListingRepositoryInterface
     */
    public function setCurrencyMinorUnitValue($currencyMinorUnitValue): ListingRepositoryInterface
    {
        // TODO: validation
        $this->currencyMinorUnitValue = $currencyMinorUnitValue;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     *
     * @return ListingRepositoryInterface
     */
    public function setLatitude($latitude): ListingRepositoryInterface
    {
        // TODO: validation
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     *
     * @return ListingRepositoryInterface
     */
    public function setLongitude($longitude): ListingRepositoryInterface
    {
        // TODO: validation
        $this->longitude = $longitude;
        return $this;
    }

    public function find(): ListingRepositoryInterface
    {
        // TODO: Implement find() method.
    }


    public function commit(): void
    {
        $databaseConnection = $this->getDatabaseConnection();
        $where = ['id' => $this->getId()];

        // check if a row in the DB exists with this id
        if ($databaseConnection->has($this->tableName, $where)) {
            // update
            $databaseConnection->update($this->tableName, $this->asArray(), $where);
        }

        // create
        $databaseConnection->insert($this->tableName, $this->asArray());
    }

    /**
     * Return a representation of ListingRepository as an array.
     *
     * @return array
     */
    public function asArray(): array
    {
        return [
            'id'                        => $this->getId(),
            'currency_code'             => $this->getCurrencyCode(),
            'currency_minor_unit_value' => $this->getCurrencyMinorUnitValue(),
            'latitude'                  => $this->getLatitude(),
            'longitude'                 => $this->getLongitude(),
        ];
    }

    /**
     * @return Medoo
     */
    private function getDatabaseConnection(): Medoo
    {
        return new Medoo([
            'database_type' => 'sqlite',
            'database_file' => __DIR__.'/../../../../resources/sqlite/database/tube_house_prices.db',
        ]);
    }
}