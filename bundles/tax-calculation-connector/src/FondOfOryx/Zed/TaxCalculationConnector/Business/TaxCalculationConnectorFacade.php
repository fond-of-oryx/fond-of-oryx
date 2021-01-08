<?php

namespace FondOfOryx\Zed\TaxCalculationConnector\Business;

use Generated\Shared\Transfer\CalculableObjectTransfer;

/**
 * @method \FondOfOryx\Zed\TaxCalculationConnector\Business\ProductTaxCalculatorBusinessFactory getFactory()
 */
class TaxCalculationConnectorFacade implements TaxCalculationConnectorFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CalculableObjectTransfer $calculableObjectTransfer
     *
     * @return \Generated\Shared\Transfer\CalculableObjectTransfer
     */
    public function calculateProductItemTaxRateForCalculableObjectTransfer(CalculableObjectTransfer $calculableObjectTransfer): CalculableObjectTransfer
    {
        return $this->getFactory()
            ->createProductItemTaxRateByRegionCalculator()
            ->recalculateWithCalculableObject($calculableObjectTransfer);
    }

}
