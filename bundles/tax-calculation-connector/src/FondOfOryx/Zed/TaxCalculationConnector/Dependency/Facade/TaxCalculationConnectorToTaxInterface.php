<?php

namespace FondOfOryx\Zed\TaxCalculationConnector\Dependency\Facade;

interface TaxCalculationConnectorToTaxInterface
{
    /**
     * @return string
     */
    public function getDefaultTaxCountryIso2Code(): string;

    /**
     * @return float
     */
    public function getDefaultTaxRate(): float;
}
