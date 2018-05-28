<?php

namespace TubeHousePrice\Listing;

use TubeHousePrice\Listing\Coordinate\Latitude;
use TubeHousePrice\Listing\Coordinate\Longitude;

class Location
{
    private $longitude;

    private $latitude;

    private function __construct(Longitude $longitude, Latitude $latitude)
    {
        $this->longitude = $longitude;
        $this->latitude = $latitude;
    }

    public static function createFromLongitudeAndLatitude(Longitude $longitude, Latitude $latitude): self
    {
        return new static($longitude, $latitude);
    }

}