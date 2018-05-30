<?php

namespace TubeHousePrice\Listing\Repository;

interface ListingRepositoryInterface
{
    public function getId(): string;
    public function getCurrencyCode(): string;
    public function getCurrencyMinorUnitValue(): int;
    public function getLatitude(): float;
    public function getLongitude(): float;

    /** Fluent Setters */
    public function setId($id): ListingRepositoryInterface;
    public function setCurrencyCode($currencyCode): ListingRepositoryInterface;
    public function setCurrencyMinorUnitValue($currencyMinorUnitValue): ListingRepositoryInterface;
    public function setLatitude($latitude): ListingRepositoryInterface;
    public function setLongitude($longitude): ListingRepositoryInterface;

    public function find(): ListingRepositoryInterface;

    /**
     * Commit the listing to storage.
     * Method can be used for creating or updating a resource.
     */
    public function commit(): void;
}