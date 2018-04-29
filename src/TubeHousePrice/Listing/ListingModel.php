<?php

namespace TubeHousePrice\Listing;

class ListingModel
{
    private $id;

    private $price;

    private $location;

    private function __construct($id, Price $price, Location $location)
    {
        $this->id = $id;
        $this->price = $price;
        $this->location = $location;
    }

    public static function createFromPriceAndLocation(Price $price, Location $location): self
    {
        return new static(uniqid(), $price, $location);
    }

}