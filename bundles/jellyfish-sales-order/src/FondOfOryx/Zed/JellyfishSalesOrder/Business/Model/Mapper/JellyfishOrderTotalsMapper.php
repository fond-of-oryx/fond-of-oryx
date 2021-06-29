<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper;

use Generated\Shared\Transfer\JellyfishOrderTotalsTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

class JellyfishOrderTotalsMapper implements JellyfishOrderTotalsMapperInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrder
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderTotalsTransfer
     */
    public function fromSalesOrder(SpySalesOrder $salesOrder): JellyfishOrderTotalsTransfer
    {
        $jellyfishOrderTotals = new JellyfishOrderTotalsTransfer();

        if (!method_exists($salesOrder, 'getLastOrderTotals')) {
            return $jellyfishOrderTotals;
        }

        $lastOrderTotals = $salesOrder->getLastOrderTotals();

        if (!$lastOrderTotals) {
            return $jellyfishOrderTotals;
        }

        return $jellyfishOrderTotals->setExpenseTotal($lastOrderTotals->getOrderExpenseTotal())
            ->setDiscountTotal($lastOrderTotals->getDiscountTotal())
            ->setTaxTotal($lastOrderTotals->getTaxTotal())
            ->setSubTotal($lastOrderTotals->getSubtotal())
            ->setGrandTotal($lastOrderTotals->getGrandTotal());
    }
}
