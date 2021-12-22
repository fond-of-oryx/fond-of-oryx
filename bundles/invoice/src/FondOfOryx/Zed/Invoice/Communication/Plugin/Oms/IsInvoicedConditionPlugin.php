<?php

namespace FondOfOryx\Zed\Invoice\Communication\Plugin\Oms;

use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Oms\Dependency\Plugin\Condition\ConditionInterface;

/**
 * @method \FondOfOryx\Zed\Invoice\Business\InvoiceFacade getFacade()
 * @method \FondOfOryx\Zed\Invoice\InvoiceConfig getConfig()
 * @method \FondOfOryx\Zed\Invoice\Persistence\InvoiceRepository getRepository()
 */
class IsInvoicedConditionPlugin extends AbstractPlugin implements ConditionInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $orderItem
     *
     * @return bool
     */
    public function check(SpySalesOrderItem $orderItem): bool
    {
        $idSalesOrderItem = $orderItem->getIdSalesOrderItem();
        $itemTransfer = $this->getRepository()->findInvoiceItemByIdSalesOrderItem($idSalesOrderItem);

        return $itemTransfer !== null
            && $itemTransfer->getIdInvoiceItem() !== null
            && $itemTransfer->getFkInvoice() !== null;
    }
}
