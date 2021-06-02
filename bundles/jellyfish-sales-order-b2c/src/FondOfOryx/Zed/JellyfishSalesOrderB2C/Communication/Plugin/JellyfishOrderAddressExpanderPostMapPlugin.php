<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderB2C\Communication\Plugin;

use FondOfOryx\Zed\JellyfishSalesOrderExtension\Dependency\Plugin\JellyfishOrderAddressExpanderPostMapPluginInterface;
use Generated\Shared\Transfer\JellyfishOrderAddressTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrderAddress;

class JellyfishOrderAddressExpanderPostMapPlugin implements JellyfishOrderAddressExpanderPostMapPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderAddressTransfer $jellyfishOrderAddressTransfer
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderAddress $salesOrderAddress
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderAddressTransfer
     */
    public function expand(
        JellyfishOrderAddressTransfer $jellyfishOrderAddressTransfer,
        SpySalesOrderAddress $salesOrderAddress
    ): JellyfishOrderAddressTransfer {
        $jellyfishOrderAddressTransfer
            ->setFirstName($salesOrderAddress->getFirstName())
            ->setLastName($salesOrderAddress->getLastName())
            ->setName1(null)
            ->setName2(null);

        return $jellyfishOrderAddressTransfer;
    }
}
