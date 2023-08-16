<?php

namespace FondOfOryx\Zed\ShipmentTableRate\Communication\Plugin\PriceCalculator;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\ShipmentTableRate\Business\ShipmentTableRateFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\ShipmentTableRate\ShipmentTableRateConfig getConfig()
 */
class NoShipmentPriceCalculatorPlugin extends AbstractPlugin implements PriceCalculatorPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function calculate(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        $noShipmentPrice = 0;

        foreach ($quoteTransfer->getItems() as $itemTransfer) {
            if (!isset($itemTransfer->getAbstractAttributes()['_']['model_untranslated'])) {
                continue;
            }

            if (!str_contains(strtoupper($itemTransfer->getAbstractAttributes()['_']['model_untranslated']), 'VOUCHER')) {
                continue;
            }

            $noShipmentPrice += $itemTransfer->getSumPrice();
        }

        $quoteTransfer->getTotals()->setNoShipmentPrice($noShipmentPrice);

        return $quoteTransfer;
    }
}
