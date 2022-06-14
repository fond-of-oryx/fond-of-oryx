<?php

namespace FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Business;

use ArrayObject;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

interface GiftCardProportionalValuePayoneConnectorFacadeInterface
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
    public function isPayonePaymentMethod(SpySalesOrder $orderEntity): bool;
}
