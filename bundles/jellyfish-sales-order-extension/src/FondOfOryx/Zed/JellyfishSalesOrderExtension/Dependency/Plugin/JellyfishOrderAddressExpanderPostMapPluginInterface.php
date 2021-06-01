<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderExtension\Dependency\Plugin;

use Generated\Shared\Transfer\JellyfishOrderAddressTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrderAddress;

interface JellyfishOrderAddressExpanderPostMapPluginInterface
{
    /**
     * Specification:
     *  - Allows to manipulate JellyfishOrderAddressTransfer object after mapping.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\JellyfishOrderAddressTransfer $jellyfishOrderAddressTransfer
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderAddress $salesOrderAddress
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderAddressTransfer
     */
    public function expand(
        JellyfishOrderAddressTransfer $jellyfishOrderAddressTransfer,
        SpySalesOrderAddress $salesOrderAddress
    ): JellyfishOrderAddressTransfer;
}
