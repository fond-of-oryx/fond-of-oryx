<?php

namespace FondOfOryx\Zed\GiftCardProportionalValueNoPaymentConnector\Business;

use ArrayObject;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

interface GiftCardProportionalValueNoPaymentConnectorFacadeInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $orderEntity
     * @param \ArrayObject<\Generated\Shared\Transfer\ProportionalGiftCardValueTransfer> $proportionalGiftCardValues
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\ProportionalGiftCardValueTransfer>
     */
    public function calculateProportionalGiftCardValues(SpySalesOrder $orderEntity, ArrayObject $proportionalGiftCardValues): ArrayObject;

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $orderEntity
     *
     * @return bool
     */
    public function isOnlyGiftCardPaymentMethod(SpySalesOrder $orderEntity): bool;
}
