<?php

namespace FondOfOryx\Zed\GiftCardProportionalValue\Business\Manager;

use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;

interface ProportionalGiftCardValueManagerInterface
{
    /**
     * @param array<\Orm\Zed\Sales\Persistence\SpySalesOrderItem> $orderItems
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $orderEntity
     * @param \Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject $data
     *
     * @return array
     */
    public function createProportionalValues(array $orderItems, SpySalesOrder $orderEntity, ReadOnlyArrayObject $data): array;
}
