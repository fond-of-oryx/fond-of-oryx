<?php

namespace FondOfOryx\Zed\TaxCalculationConnector\Persistence;

use FondOfOryx\Zed\TaxCalculationConnector\Dependency\QueryContainer\TaxProductConnectorQueryContainerBridgeInterface;
use FondOfOryx\Zed\TaxCalculationConnector\Persistence\Mapper\TaxCalculationTaxSetMapper;
use FondOfOryx\Zed\TaxCalculationConnector\TaxCalculationConnectorDependencyProvider;
use Orm\Zed\Tax\Persistence\SpyTaxSetQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\TaxCalculationConnector\Persistence\TaxCalculationConnectorRepositoryInterface getRepository()
 */
class TaxCalculationConnectorPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \FondOfOryx\Zed\TaxCalculationConnector\Dependency\QueryContainer\TaxProductConnectorQueryContainerBridgeInterface
     */
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
    public function createTaxSetQuery(): SpyTaxSetQuery
    {
        return SpyTaxSetQuery::create();
    }
}
