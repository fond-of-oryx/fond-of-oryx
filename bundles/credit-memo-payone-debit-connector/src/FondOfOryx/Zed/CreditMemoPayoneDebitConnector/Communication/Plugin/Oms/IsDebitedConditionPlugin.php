<?php

namespace FondOfOryx\Zed\CreditMemoPayoneDebitConnector\Communication\Plugin\Oms;

use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Oms\Dependency\Plugin\Condition\ConditionInterface;

/**
 * @method \FondOfOryx\Zed\CreditMemoPayoneDebitConnector\Business\CreditMemoPayoneDebitConnectorFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\CreditMemoPayoneDebitConnector\Communication\CreditMemoPayoneDebitConnectorCommunicationFactory getFactory()
 */
class IsDebitedConditionPlugin extends AbstractPlugin implements ConditionInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $orderItem
     *
     * @return bool
     */
    public function check(SpySalesOrderItem $orderItem): bool
    {
        $idSalesOrderItem = $orderItem->getIdSalesOrderItem();
        $itemTransfer = $this->getFactory()->getCreditMemoFacade()->findCreditMemoItemByIdSalesOrderItem($idSalesOrderItem);

        return $itemTransfer !== null
            && $itemTransfer->getIdCreditMemoItem() !== null
            && $itemTransfer->getFkCreditMemo() !== null
            && $itemTransfer->getIsDebit() === true;
    }
}
