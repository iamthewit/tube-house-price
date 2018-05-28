<?php

namespace TubeHousePrice\Listing\Coordinate;

class Latitude implements CoordinateInterface
{
    private $value;

    public function __construct(float $value)
    {
        // validate value...

        $this->value = $value;
    }

    public function value(): float
    {
        return $this->value;
    }
}