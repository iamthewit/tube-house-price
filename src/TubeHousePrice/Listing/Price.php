<?php

namespace TubeHousePrice\Listing;

class Price
{
    private $currency;

    private $minorUnitValue;

    private function __construct(CurrencyInterface $currency, int $minorUnitValue)
    {
        $this->currency = $currency;
        $this->minorUnitValue = $minorUnitValue;
    }

    public static function createFromCurrencyAndMinorUnitValue(CurrencyInterface $currency, int $minorUnitValue): self
    {
        return new static($currency, $minorUnitValue);
    }

    public function currency(): CurrencyInterface
    {
        return $this->currency;
    }

    public function minorUnitValue(): int
    {
        return $this->minorUnitValue;
    }
}