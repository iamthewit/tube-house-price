<?php

namespace TubeHousePrice\Listing;


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