<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderCompanyBusinessUnit\Business;

use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\JellyfishSalesOrderCompanyBusinessUnit\Business\JellyfishSalesOrderCompanyBusinessUnitBusinessFactory getFactory()
 */
class JellyfishSalesOrderCompanyBusinessUnitFacade extends AbstractFacade implements JellyfishSalesOrderCompanyBusinessUnitFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrder
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderTransfer
     */
    public function expandJellyfishOrder(
        JellyfishOrderTransfer $jellyfishOrderTransfer,
        SpySalesOrder $salesOrder
    ): JellyfishOrderTransfer {
        return $this->getFactory()->createJellyfishOrderExpander()->expand(
            $jellyfishOrderTransfer,
            $salesOrder,
        );
    }
}
