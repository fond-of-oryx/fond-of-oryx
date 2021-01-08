<?php

namespace FondOfOryx\Zed\TaxCalculationConnector\Persistence;

use Generated\Shared\Transfer\TaxCalculationConnectorTransfer;

interface TaxCalculationConnectorRepositoryInterface
{
    /**
     * @param array $idProductAbstracts
     * @param array $countryIso2Code
     * @param array $idRegions
     *
     * @return \Generated\Shared\Transfer\TaxCalculationConnectorTransfer
     */
    public function getTaxSetByIdProductAbstractAndCountryIso2CodesAndIdRegions(array $idProductAbstracts, array $countryIso2Code, array $idRegions): TaxCalculationConnectorTransfer;

    /**
     * @param array $idProductAbstracts
     * @param array $countryIso2Code
     *
     * @return \Generated\Shared\Transfer\TaxCalculationConnectorTransfer
     */
    public function getTaxSetByIdProductAbstractAndCountryIso2Codes(array $idProductAbstracts, array $countryIso2Code): TaxCalculationConnectorTransfer;
}
