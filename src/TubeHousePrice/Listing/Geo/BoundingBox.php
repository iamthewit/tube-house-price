<?php

namespace TubeHousePrice\Listing\Geo;

use TubeHousePrice\Listing\Geo\Exception\BoundingBoxException;

class BoundingBox
{
    private $minLongitude;
    private $maxLongitude;
    private $minLatitude;
    private $maxLatitude;
    
    /**
     * BoundingBox constructor.
     *
     * @param Longitude $minLongitude
     * @param Longitude $maxLongitude
     * @param Latitude  $minLatitude
     * @param Latitude  $maxLatitude
     *
     * @throws BoundingBoxException
     */
    public function __construct(
        Longitude $minLongitude,
        Longitude $maxLongitude,
        Latitude $minLatitude,
        Latitude $maxLatitude
    ) {
        if ($minLongitude > $maxLatitude) {
            $message = sprintf(
                'The minimum latitude value (%f) must be less than the maximum latitude value (%f)',
                $minLongitude,
                $maxLatitude
            );
            throw new BoundingBoxException($message);
        }
    
        if ($minLatitude > $maxLongitude) {
            $message = sprintf(
                'The minimum longitude value (%f) must be less than the maximum longitude value (%f)',
                $minLongitude,
                $maxLongitude
            );
            throw new BoundingBoxException($message);
        }
        
        $this->minLongitude = $minLongitude;
        $this->maxLongitude = $maxLongitude;
        $this->minLatitude = $minLatitude;
        $this->maxLatitude = $maxLatitude;
    }
    
    /**
     * @return Longitude
     */
    public function minLongitude(): Longitude
    {
        return $this->minLongitude;
    }
    
    /**
     * @return Longitude
     */
    public function maxLongitude(): Longitude
    {
        return $this->maxLongitude;
    }
    
    /**
     * @return Latitude
     */
    public function minLatitude(): Latitude
    {
        return $this->minLatitude;
    }
    
    /**
     * @return Latitude
     */
    public function maxLatitude(): Latitude
    {
        return $this->maxLatitude;
    }
    
    
    // TODO:
//    public static function createFromLongitudeAndLatitudeAndDistanceSquared(
//        Longitude $minLongitude,
//        Latitude $minLatitude,
//        Distance $distance
//    ) {
        // create a bounding box with minLong and minLat set to the params past in
        // work out the maxLong and maxLat from the min + distance
//
//        return new self();
//    }
    
    

    // Method ideas
    // - calculate area within box
    // - calculate distance across box
    // - calculate where the centre of the box is
    // - distances can be converted (miles, metres)
    // - box can be reduced / increased by percentage about the centre (increase box size by 10%)
    
}