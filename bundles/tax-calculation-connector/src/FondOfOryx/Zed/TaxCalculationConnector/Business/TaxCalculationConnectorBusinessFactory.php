<?php

namespace FondOfOryx\Zed\TaxCalculationConnector\Business;

use FondOfOryx\Zed\TaxCalculationConnector\Business\Calculator\ProductItemTaxRateByRegionCalculator;
use FondOfOryx\Zed\TaxCalculationConnector\TaxCalculationConnectorDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use FondOfOryx\Zed\TaxCalculationConnector\Business\Calculator\CalculatorInterface;


class TaxCalculationConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \Spryker\Zed\TaxCalculationConnector\Dependency\Facade\TaxCalculationConnectorToTaxInterface
     */
    protected function getTaxFacade()
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
