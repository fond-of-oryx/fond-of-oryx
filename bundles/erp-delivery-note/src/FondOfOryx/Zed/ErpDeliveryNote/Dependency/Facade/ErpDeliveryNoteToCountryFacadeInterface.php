<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Dependency\Facade;

use Generated\Shared\Transfer\CountryTransfer;

interface ErpDeliveryNoteToCountryFacadeInterface
{
    /**
     * @param int $idCountry
     *
     * @return \Generated\Shared\Transfer\CountryTransfer
     */
    public function getCountryByIdCountry(int $idCountry): CountryTransfer;
}
