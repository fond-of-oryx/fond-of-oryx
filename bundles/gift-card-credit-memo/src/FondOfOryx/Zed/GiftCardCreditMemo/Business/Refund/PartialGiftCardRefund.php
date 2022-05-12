<?php

namespace FondOfOryx\Zed\GiftCardCreditMemo\Business\Refund;

use Exception;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;

class PartialGiftCardRefund implements PartialGiftCardRefundInterface
{
    /**
     * @param array $orderItems
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $orderEntity
     * @param \Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject $data
     *
     * @throws \Exception
     *
     * @return array
     */
    public function executePartialRefund(array $orderItems, SpySalesOrder $orderEntity, ReadOnlyArrayObject $data): array
    {
        if (count($orderItems) > 0) {
            throw new Exception('impement this');
        }

        return [];
    }
}
