<?php

namespace FondOfOryx\Zed\ShipmentTableRate\Dependency\Facade;

use Generated\Shared\Transfer\CountryTransfer;

interface ShipmentTableRateToCountryFacadeInterface
{
    /**
     * @param string $iso2Code
     *
     * @return \Generated\Shared\Transfer\CountryTransfer
     */
    public function getCountryByIso2Code(string $iso2Code): CountryTransfer;
}
