<?php

namespace FondOfOryx\Zed\GiftCardProportionalValueNoPaymentConnector\Business;

use ArrayObject;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\GiftCardProportionalValueNoPaymentConnector\Business\GiftCardProportionalValueNoPaymentConnectorBusinessFactory getFactory()
 */
class GiftCardProportionalValueNoPaymentConnectorFacade extends AbstractFacade implements GiftCardProportionalValueNoPaymentConnectorFacadeInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $orderEntity
     * @param \ArrayObject<\Generated\Shared\Transfer\ProportionalGiftCardValueTransfer> $proportionalGiftCardValues
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\ProportionalGiftCardValueTransfer>
     */
    public function calculateProportionalGiftCardValues(SpySalesOrder $orderEntity, ArrayObject $proportionalGiftCardValues): ArrayObject
    {
        return $this->getFactory()->createProportionalGiftCardCalculator()->calculate($orderEntity, $proportionalGiftCardValues);
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $orderEntity
     *
     * @return bool
     */
    public function isOnlyGiftCardPaymentMethod(SpySalesOrder $orderEntity): bool
    {
        return $this->getFactory()->createOnlyGiftCardPaymentValidator()->validate($orderEntity);
    }
}
