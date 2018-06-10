<?php

namespace TubeHousePrice\Listing\Currency;

use TubeHousePrice\Listing\Currency\Exception\UnsupportedCurrencyException;

class CurrencyFactory
{
    /**
     * @param string $currencyCode
     *
     * @return PoundSterling
     * @throws UnsupportedCurrencyException
     */
    public static function build(string $currencyCode)
    {
        switch($currencyCode) {
            case "GBP":
                return new PoundSterling();
                break;
            default:
                throw new UnsupportedCurrencyException(
                    sprintf('The given currency code: "%s" is not supported.', $currencyCode)
                );
        }
    }
}