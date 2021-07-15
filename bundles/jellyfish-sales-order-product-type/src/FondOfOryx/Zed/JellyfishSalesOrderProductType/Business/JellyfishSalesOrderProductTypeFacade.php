<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderProductType\Business;

use Generated\Shared\Transfer\JellyfishOrderItemTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\JellyfishSalesOrderProductType\Business\JellyfishSalesOrderProductTypeBusinessFactory getFactory()
 */
class JellyfishSalesOrderProductTypeFacade extends AbstractFacade implements JellyfishSalesOrderProductTypeFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderItemTransfer $jellyfishOrderItemTransfer
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $salesOrderItem
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderItemTransfer
     */
    public function expand(
        JellyfishOrderItemTransfer $jellyfishOrderItemTransfer,
        SpySalesOrderItem $salesOrderItem
    ): JellyfishOrderItemTransfer {
        return $this->getFactory()
            ->createJellyfishOrderItemExpander()
            ->expand($jellyfishOrderItemTransfer, $salesOrderItem);
    }
}
