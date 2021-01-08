<?php

namespace FondOfOryx\Zed\TaxCalculationConnector\Dependency\Facade;

class TaxCalculationConnectorToTaxBridge implements TaxCalculationConnectorToTaxInterface
{
    /**
     * @var \Spryker\Zed\Tax\Business\TaxFacadeInterface
     */
    protected $taxFacade;

    /**
     * @param \Spryker\Zed\Tax\Business\TaxFacadeInterface $taxFacade
     */
    public function __construct($taxFacade)
    {
        $this->taxFacade = $taxFacade;
    }

    /**
     * @return string
     */
    public function getDefaultTaxCountryIso2Code(): string
    {
        return $this->taxFacade->getDefaultTaxCountryIso2Code();
    }

    /**
     * @return float
     */
    public function getDefaultTaxRate(): float
    {
        return $this->taxFacade->getDefaultTaxRate();
    }
}
