<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderCompany\Communication\Plugin\JellyfishSalesOrderExtension;

use FondOfOryx\Zed\JellyfishSalesOrderExtension\Dependency\Plugin\JellyfishOrderExpanderPostMapPluginInterface;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\JellyfishSalesOrderCompany\Business\JellyfishSalesOrderCompanyFacadeInterface getFacade()
 */
class CompanyJellyfishOrderExpanderPostMapPlugin extends AbstractPlugin implements JellyfishOrderExpanderPostMapPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrder
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderTransfer
     */
    public function expand(
        JellyfishOrderTransfer $jellyfishOrderTransfer,
        SpySalesOrder $salesOrder
    ): JellyfishOrderTransfer {
        return $this->getFacade()->expandJellyfishOrder($jellyfishOrderTransfer, $salesOrder);
    }
}
