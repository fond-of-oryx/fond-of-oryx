<?php

namespace FondOfOryx\Zed\ShipmentTableRate\Communication\Plugin\ShipmentTableRateExtension;

use FondOfOryx\Zed\ShipmentTableRateExtension\Dependency\Plugin\PriceToPayFilterPluginInterface;
use Generated\Shared\Transfer\TotalsTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\ShipmentTableRate\ShipmentTableRateConfig getConfig()
 * @method \FondOfOryx\Zed\ShipmentTableRate\Business\ShipmentTableRateFacadeInterface getFacade()
 */
class SubtotalPriceToPayFilterPlugin extends AbstractPlugin implements PriceToPayFilterPluginInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\TotalsTransfer $totalsTransfer
     *
     * @return int|null
     */
    public function filter(TotalsTransfer $totalsTransfer): ?int
    {
        return $totalsTransfer->getSubtotal();
    }
}
