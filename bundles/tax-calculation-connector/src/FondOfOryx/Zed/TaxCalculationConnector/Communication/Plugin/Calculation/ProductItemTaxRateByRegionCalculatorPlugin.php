<?php

namespace FondOfOryx\Zed\TaxCalculationConnector\Communication\Plugin\Calculation;

use Generated\Shared\Transfer\CalculableObjectTransfer;
use Spryker\Zed\CalculationExtension\Dependency\Plugin\CalculationPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\TaxCalculationConnector\Business\TaxCalculationConnectorFacadeInterface getFacade()
 */
class ProductItemTaxRateByRegionCalculatorPlugin extends AbstractPlugin implements CalculationPluginInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CalculableObjectTransfer $calculableObjectTransfer
     *
     * @return void
     */
    public function recalculate(CalculableObjectTransfer $calculableObjectTransfer)
    {
        $this->getFacade()->calculateProductItemTaxRateForCalculableObjectTransfer($calculableObjectTransfer);
    }
}
