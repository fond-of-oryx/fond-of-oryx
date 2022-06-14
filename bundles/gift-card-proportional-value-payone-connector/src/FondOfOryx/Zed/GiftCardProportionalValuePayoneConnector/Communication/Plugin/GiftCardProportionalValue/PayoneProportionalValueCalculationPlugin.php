<?php

namespace FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Communication\Plugin\GiftCardProportionalValue;

use ArrayObject;
use FondOfOryx\Zed\GiftCardProportionalValueExtension\Dependency\Plugin\ProportionalValueCalculationPluginInterface;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Business\GiftCardProportionalValuePayoneConnectorFacadeInterface getFacade()
 */
class PayoneProportionalValueCalculationPlugin extends AbstractPlugin implements ProportionalValueCalculationPluginInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $orderEntity
     * @param \ArrayObject<\Generated\Shared\Transfer\ProportionalGiftCardValueTransfer> $proportionalGiftCardValues
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\ProportionalGiftCardValueTransfer>
     */
    public function calculate(SpySalesOrder $orderEntity, ArrayObject $proportionalGiftCardValues): ArrayObject
    {
        if ($this->getFacade()->isPayonePaymentMethod($orderEntity) === false) {
            return $proportionalGiftCardValues;
        }

        return $this->getFacade()->calculateProportionalGiftCardValues($orderEntity, $proportionalGiftCardValues);
    }
}
