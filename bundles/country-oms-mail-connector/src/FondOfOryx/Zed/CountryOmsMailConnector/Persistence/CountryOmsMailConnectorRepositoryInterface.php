<?php

namespace FondOfOryx\Zed\CountryOmsMailConnector\Persistence;

use Generated\Shared\Transfer\CountryTransfer;

interface CountryOmsMailConnectorRepositoryInterface
{
    /**
     * @param int $idCountry
     *
     * @return \Generated\Shared\Transfer\CountryTransfer|null
     */
    public function getCountryByIdCountry(int $idCountry): ?CountryTransfer;
}
