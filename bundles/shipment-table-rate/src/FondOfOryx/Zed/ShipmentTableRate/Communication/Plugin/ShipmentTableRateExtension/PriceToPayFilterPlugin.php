<?php

namespace FondOfOryx\Zed\ShipmentTableRate\Communication\Plugin\ShipmentTableRateExtension;

use FondOfOryx\Zed\ShipmentTableRateExtension\Dependency\Plugin\PriceToPayFilterPluginInterface;
use Generated\Shared\Transfer\ItemTransfer;
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
        if ($quoteTransfer->getTotals() === null) {
            return null;
        }

        $totalsTransfer = $quoteTransfer->getTotals();
        $shipmentPrice = 0;

        foreach ($quoteTransfer->getItems() as $itemTransfer) {
            if ($this->isItemGiftCard($itemTransfer) === false) {
                continue;
            }

            $shipmentPrice += $itemTransfer->getSumPrice();
        }

        $total = ($totalsTransfer->getSubtotal() - $totalsTransfer->getDiscountTotal()) - $shipmentPrice;

        return ($total > 0) ? $total : 0;
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return bool
     */
    protected function isItemGiftCard(ItemTransfer $itemTransfer): bool
    {
        if ($itemTransfer->getGiftCardMetadata() === null) {
            return false;
        }

        $isGiftCard = $itemTransfer->getGiftCardMetadata()->getIsGiftCard();

        if ($isGiftCard === false || $isGiftCard === null) {
            return false;
        }

        return true;
    }
}
