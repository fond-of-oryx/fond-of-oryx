<?php

namespace FondOfOryx\Zed\GiftCardProportionalValueNoPaymentConnector\Business\Calculator;

use ArrayObject;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

interface ProportionalGiftCardCalculatorInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $orderEntity
     * @param \ArrayObject<\Generated\Shared\Transfer\ProportionalGiftCardValueTransfer> $proportionalGiftCardValues
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\ProportionalGiftCardValueTransfer>
     */
    public function calculate(SpySalesOrder $orderEntity, ArrayObject $proportionalGiftCardValues): ArrayObject;
}
