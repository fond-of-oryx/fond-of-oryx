<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderCompanyUnitAddress\Communication\Plugin\JellyfishSalesOrderExtension;

use FondOfOryx\Zed\JellyfishSalesOrderExtension\Dependency\Plugin\JellyfishOrderAddressExpanderPostMapPluginInterface;
use Generated\Shared\Transfer\JellyfishOrderAddressTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrderAddress;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class CompanyUnitAddressJellyfishOrderAddressExpanderPostMapPlugin extends AbstractPlugin implements JellyfishOrderAddressExpanderPostMapPluginInterface
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
        $fkResourceCompanyUnitAddress = $salesOrderAddress->getFkResourceCompanyUnitAddress();

        if ($fkResourceCompanyUnitAddress === null) {
            return $jellyfishOrderAddressTransfer;
        }

        return $jellyfishOrderAddressTransfer->setId($fkResourceCompanyUnitAddress);
    }
}
