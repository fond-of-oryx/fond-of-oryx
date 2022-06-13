<?php

namespace FondOfOryx\Zed\GiftCardProportionalValue\Business\Executor;

use ArrayObject;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

interface ProportionalValueCalculatorPluginExecutorInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $orderEntity
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\ProportionalGiftCardValueTransfer>
     */
    public function execute(SpySalesOrder $orderEntity): ArrayObject;
}
