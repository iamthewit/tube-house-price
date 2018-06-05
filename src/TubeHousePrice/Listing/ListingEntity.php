<?php

namespace TubeHousePrice\Listing;

class ListingEntity
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
     * @return ListingEntity
     */
    public function setId($id): ListingEntity
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
     * @return ListingEntity
     */
    public function setCurrencyCode($currencyCode): ListingEntity
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
     * @return ListingEntity
     */
    public function setCurrencyMinorUnitValue($currencyMinorUnitValue): ListingEntity
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
     * @return ListingEntity
     */
    public function setLatitude($latitude): ListingEntity
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
     * @return ListingEntity
     */
    public function setLongitude($longitude): ListingEntity
    {
        // TODO: validation
        $this->longitude = $longitude;
        return $this;
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
     * @param array $fields
     *
     * @return ListingEntity
     */
    public static function fromArray(array $fields) {
        // TODO: validate $fields has all keys and values we need
        
        $listingEntity = new static();
        return $listingEntity->setId($fields['id'])
            ->setCurrencyCode($fields['currency_code'])
            ->setCurrencyMinorUnitValue($fields['currency_minor_unit_value'])
            ->setLatitude($fields['latitude'])
            ->setLongitude($fields['longitude']);
    }
}