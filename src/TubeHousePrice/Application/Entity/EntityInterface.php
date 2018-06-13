<?php

namespace TubeHousePrice\Application\Entity;

interface EntityInterface
{
    /**
     * Return a representation of Entity as an array.
     *
     * @return array
     */
    public function asArray(): array;
    
    /**
     * @param array $fields
     *
     * @return EntityInterface
     */
    public static function fromArray(array $fields);
}