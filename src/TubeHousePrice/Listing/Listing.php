<?php

namespace TubeHousePrice\Listing;

class Listing
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

    public static function createFromIdAndPriceAndLocation($id, Price $price, Location $location): self
    {
        return new static($id, $price, $location);
    }
    
    public function price()
    {
        return $this->price;
    }

    public function location()
    {
        return $this->location;
    }

}