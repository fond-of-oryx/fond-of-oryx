<?php

namespace FondOfOryx\Zed\TaxCalculationConnector\Business;

use Generated\Shared\Transfer\CalculableObjectTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\TaxCalculationConnector\Business\TaxCalculationConnectorBusinessFactory getFactory()
 * @method \FondOfOryx\Zed\TaxCalculationConnector\Persistence\TaxCalculationConnectorRepositoryInterface getRepository()
 */
class TaxCalculationConnectorFacade extends AbstractFacade implements TaxCalculationConnectorFacadeInterface
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
