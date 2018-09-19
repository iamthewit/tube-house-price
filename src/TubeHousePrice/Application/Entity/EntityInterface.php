<?php

namespace TubeHousePrice\Application\Entity;

interface EntityInterface
{
    /**
     * @return string
     */
    public function getId(): string;
    
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