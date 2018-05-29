<?php

namespace TubeHousePrice\Listing\Repository;

use Medoo\Medoo;

require '../../../../vendor/autoload.php';

class SqliteListingRepository implements ListingRepositoryInterface
{
    private $id;
    private $currencyCode;
    private $currencyMinorUnitValue;
    private $latitude;
    private $longitude;

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
        $this->longitude = $longitude;
        return $this;
    }

    public function commit(): void
    {
        $database = new Medoo([
            'database_type' => 'sqlite',
            'database_file' => '../../../../resources/sqlite/database/tube_house_prices.db',
        ]);

        // check if a row in the DB exists with this id

        // if so update

        // otherwise create
    }


}