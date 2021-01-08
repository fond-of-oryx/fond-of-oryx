<?php

namespace FondOfOryx\Zed\TaxCalculationConnector\Dependency\QueryContainer;

use Spryker\Zed\TaxProductConnector\Persistence\TaxProductConnectorQueryContainerInterface;
use \Orm\Zed\Tax\Persistence\SpyTaxSetQuery;

class TaxProductConnectorQueryContainerBridge implements TaxProductConnectorQueryContainerBridgeInterface
{
    /**
     * @var \Spryker\Zed\TaxProductConnector\Persistence\TaxProductConnectorQueryContainerInterface
     */
    private $queryContainer;

    public function __construct(TaxProductConnectorQueryContainerInterface $queryContainer)
    {
        $this->queryContainer = $queryContainer;
    }

    /**
     * @param array $allIdProductAbstracts
     * @param array $countryIso2Codes
     *
     * @return \Orm\Zed\Tax\Persistence\SpyTaxSetQuery
     */
    public function queryTaxSetByIdProductAbstractAndCountryIso2Codes(array $allIdProductAbstracts, array $countryIso2Codes): SpyTaxSetQuery
    {
        $this->queryContainer->queryTaxSetByIdProductAbstractAndCountryIso2Codes($allIdProductAbstracts, $countryIso2Codes);
    }
}
