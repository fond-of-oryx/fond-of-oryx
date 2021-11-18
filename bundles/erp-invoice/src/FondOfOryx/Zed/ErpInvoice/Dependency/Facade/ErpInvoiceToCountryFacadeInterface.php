<?php

namespace FondOfOryx\Zed\ErpInvoice\Dependency\Facade;

use Generated\Shared\Transfer\CountryTransfer;

interface ErpInvoiceToCountryFacadeInterface
{
    /**
     * @param int $idCountry
     *
     * @return \Generated\Shared\Transfer\CountryTransfer
     */
    public function getCountryByIdCountry(int $idCountry): CountryTransfer;
}
