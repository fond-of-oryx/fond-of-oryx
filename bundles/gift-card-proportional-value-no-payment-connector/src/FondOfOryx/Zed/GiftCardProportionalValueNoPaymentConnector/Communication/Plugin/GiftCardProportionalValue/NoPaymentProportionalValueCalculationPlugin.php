<?php

namespace FondOfOryx\Zed\GiftCardProportionalValueNoPaymentConnector\Communication\Plugin\GiftCardProportionalValue;

use ArrayObject;
use FondOfOryx\Zed\GiftCardProportionalValueExtension\Dependency\Plugin\ProportionalValueCalculationPluginInterface;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\GiftCardProportionalValueNoPaymentConnector\Business\GiftCardProportionalValueNoPaymentConnectorFacadeInterface getFacade()
 */
class NoPaymentProportionalValueCalculationPlugin extends AbstractPlugin implements ProportionalValueCalculationPluginInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $orderEntity
     * @param \ArrayObject<\Generated\Shared\Transfer\ProportionalGiftCardValueTransfer> $proportionalGiftCardValues
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\ProportionalGiftCardValueTransfer>
     */
    public function calculate(SpySalesOrder $orderEntity, ArrayObject $proportionalGiftCardValues): ArrayObject
    {
        if ($this->getFacade()->isOnlyGiftCardPaymentMethod($orderEntity) === false) {
            return $proportionalGiftCardValues;
        }

        return $this->getFacade()->calculateProportionalGiftCardValues($orderEntity, $proportionalGiftCardValues);
    }
}
