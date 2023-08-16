<?php

namespace FondOfOryx\Zed\ShipmentTableRate\Communication\Plugin\ShipmentTableRateExtension;

use FondOfOryx\Zed\ShipmentTableRateExtension\Dependency\Plugin\PriceToPayFilterPluginInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\ShipmentTableRate\ShipmentTableRateConfig getConfig()
 * @method \FondOfOryx\Zed\ShipmentTableRate\Business\ShipmentTableRateFacadeInterface getFacade()
 */
class PriceToPayFilterPlugin extends AbstractPlugin implements PriceToPayFilterPluginInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return int|null
     */
    public function filter(QuoteTransfer $quoteTransfer): ?int
    {
        $totalsTransfer = $quoteTransfer->getTotals();
        $shipmentPrice = 0;

        foreach ($quoteTransfer->getItems() as $itemTransfer) {
            if (!isset($itemTransfer->getAbstractAttributes()['_']['model_untranslated'])) {
                continue;
            }

            if (!str_contains(strtoupper($itemTransfer->getAbstractAttributes()['_']['model_untranslated']), 'VOUCHER')) {
                continue;
            }

            $shipmentPrice += $itemTransfer->getSumPrice();
        }

        return ($shipmentPrice - $totalsTransfer->getDiscountTotal() > 0)
            ? $shipmentPrice - $totalsTransfer->getDiscountTotal() : 0;
    }
}
