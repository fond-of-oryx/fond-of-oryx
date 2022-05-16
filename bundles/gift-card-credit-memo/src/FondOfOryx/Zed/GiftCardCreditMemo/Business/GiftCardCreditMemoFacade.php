<?php

namespace FondOfOryx\Zed\GiftCardCreditMemo\Business;

use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Kernel\Business\AbstractFacade;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;

/**
 * @method \FondOfOryx\Zed\GiftCardCreditMemo\Business\GiftCardCreditMemoBusinessFactory getFactory()
 */
class GiftCardCreditMemoFacade extends AbstractFacade implements GiftCardCreditMemoFacadeInterface
{
    /**
     * @param int $idSalesOrderItem
     *
     * @return bool
     */
    public function hasGiftCardRefund(int $idSalesOrderItem): bool
    {
        return $this->getFactory()->createHasGiftCardRefundCheck()->check($idSalesOrderItem);
    }

    /**
     * @param array<\Orm\Zed\Sales\Persistence\SpySalesOrderItem> $orderItems
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $orderEntity
     * @param \Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject $data
     *
     * @return array
     */
    public function executePartialGiftCardRefund(array $orderItems, SpySalesOrder $orderEntity, ReadOnlyArrayObject $data): array
    {
        return $this->getFactory()->createPartialGiftCardRefund()->executePartialRefund($orderItems, $orderEntity, $data);
    }
}
