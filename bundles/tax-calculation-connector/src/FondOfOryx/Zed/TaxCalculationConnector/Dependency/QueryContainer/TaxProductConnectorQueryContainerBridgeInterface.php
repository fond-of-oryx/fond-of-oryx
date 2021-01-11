<?php

namespace FondOfOryx\Zed\TaxCalculationConnector\Dependency\QueryContainer;

use Orm\Zed\Tax\Persistence\SpyTaxSetQuery;

interface TaxProductConnectorQueryContainerBridgeInterface
{
    /**
     * @api
     *
     * @module Country
     *
     * @param int[] $allIdProductAbstracts
     * @param string[] $countryIso2Codes
     *
     * @return \Orm\Zed\Tax\Persistence\SpyTaxSetQuery
     */
    public function queryTaxSetByIdProductAbstractAndCountryIso2Codes(array $allIdProductAbstracts, array $countryIso2Codes): SpyTaxSetQuery;
}
