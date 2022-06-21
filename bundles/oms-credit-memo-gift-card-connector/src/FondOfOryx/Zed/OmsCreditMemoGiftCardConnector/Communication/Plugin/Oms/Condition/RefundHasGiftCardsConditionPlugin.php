<?php

namespace FondOfOryx\Zed\OmsCreditMemoGiftCardConnector\Communication\Plugin\Oms\Condition;

use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Oms\Dependency\Plugin\Condition\ConditionInterface;

/**
 * @method \FondOfOryx\Zed\OmsCreditMemoGiftCardConnector\Business\OmsCreditMemoGiftCardConnectorFacadeInterface getFacade()
 */
class RefundHasGiftCardsConditionPlugin extends AbstractPlugin implements ConditionInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $orderItem
     *
     * @return bool
     */
    public function check(SpySalesOrderItem $orderItem)
    {
        return $this->getFacade()->hasGiftCardRefund($orderItem->getIdSalesOrderItem());
    }
}
