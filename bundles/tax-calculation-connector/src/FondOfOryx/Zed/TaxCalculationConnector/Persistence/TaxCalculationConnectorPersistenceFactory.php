<?php


namespace FondOfOryx\Zed\TaxCalculationConnector\Persistence;

use FondOfOryx\Zed\TaxCalculationConnector\Dependency\QueryContainer\TaxProductConnectorQueryContainerBridgeInterface;
use FondOfOryx\Zed\TaxCalculationConnector\TaxCalculationConnectorDependencyProvider;
use FondOfOryx\Zed\TaxCalculationConnector\Persistence\Mapper\TaxCalculationTaxSetMapper;
use Orm\Zed\Tax\Persistence\SpyTaxSetQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

class TaxCalculationConnectorPersistenceFactory extends AbstractPersistenceFactory
{

    public function getProductTaxQueryContainer(): TaxProductConnectorQueryContainerBridgeInterface
    {
        return $this->getProvidedDependency(TaxCalculationConnectorDependencyProvider::QUERY_CONTAINER_PRODUCT_TAX);
    }

    /**
     * @return \FondOfOryx\Zed\TaxCalculationConnector\Persistence\Mapper\TaxCalculationTaxSetMapper
     */
    public function getTaxRateMapper(): TaxCalculationTaxSetMapper
    {
        return new TaxCalculationTaxSetMapper();
    }

    /**
     * @return \Orm\Zed\Tax\Persistence\SpyTaxSetQuery
     */
    public function createTaxSetQuery()
    {
        return SpyTaxSetQuery::create();
    }
}
