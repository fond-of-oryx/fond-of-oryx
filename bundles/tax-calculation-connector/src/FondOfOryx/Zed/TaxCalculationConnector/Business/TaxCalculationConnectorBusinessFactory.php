<?php

namespace FondOfOryx\Zed\TaxCalculationConnector\Business;

use FondOfOryx\Zed\TaxCalculationConnector\Business\Calculator\CalculatorInterface;
use FondOfOryx\Zed\TaxCalculationConnector\Business\Calculator\ProductItemTaxRateByRegionCalculator;
use FondOfOryx\Zed\TaxCalculationConnector\Dependency\Facade\TaxCalculationConnectorToTaxInterface;
use FondOfOryx\Zed\TaxCalculationConnector\TaxCalculationConnectorDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\TaxCalculationConnector\Persistence\TaxCalculationConnectorRepositoryInterface getRepository()
 */
class TaxCalculationConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\TaxCalculationConnector\Dependency\Facade\TaxCalculationConnectorToTaxInterface
     */
    protected function getTaxFacade(): TaxCalculationConnectorToTaxInterface
    {
        return $this->getProvidedDependency(TaxCalculationConnectorDependencyProvider::FACADE_TAX);
    }

    /**
     * @return \FondOfOryx\Zed\TaxCalculationConnector\Business\Calculator\CalculatorInterface
     */
    public function createProductItemTaxRateByRegionCalculator(): CalculatorInterface
    {
        return new ProductItemTaxRateByRegionCalculator(
            $this->getRepository(),
            $this->getTaxFacade()
        );
    }
}
