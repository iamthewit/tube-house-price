<?php

namespace TubeHousePrice\Listing;

use TubeHousePrice\Listing\Geo\Latitude;
use TubeHousePrice\Listing\Geo\Longitude;

class Location
{
    /**
     * @var Longitude $longitude
     */
    private $longitude;
    
    /**
     * @var Latitude $latitude
     */
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
    
    public function longitude()
    {
        return $this->longitude;
    }
    
    public function latitude()
    {
        return $this->latitude;
    }

}