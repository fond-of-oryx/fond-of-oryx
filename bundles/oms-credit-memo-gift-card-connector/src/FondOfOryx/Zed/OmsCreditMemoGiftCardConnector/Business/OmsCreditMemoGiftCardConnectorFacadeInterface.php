<?php

namespace FondOfOryx\Zed\OmsCreditMemoGiftCardConnector\Business;

use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;

interface OmsCreditMemoGiftCardConnectorFacadeInterface
{
    /**
     * @param int $idSalesOrderItem
     *
     * @return bool
     */
    public function hasGiftCardRefund(int $idSalesOrderItem): bool;

    /**
     * @param array<\Orm\Zed\Sales\Persistence\SpySalesOrderItem> $orderItems
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $orderEntity
     * @param \Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject $data
     *
     * @return array
     */
    public function executePartialGiftCardRefund(array $orderItems, SpySalesOrder $orderEntity, ReadOnlyArrayObject $data): array;
}
