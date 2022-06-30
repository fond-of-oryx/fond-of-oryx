<?php

namespace FondOfOryx\Zed\CustomerAddressSalesConnector\Persistence;

use Generated\Shared\Transfer\SpySalesOrderAddressEntityTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\CustomerAddressSalesConnector\Persistence\CustomerAddressSalesConnectorPersistenceFactory getFactory()
 */
class CustomerAddressSalesConnectorEntityManager extends AbstractEntityManager implements CustomerAddressSalesConnectorEntityManagerInterface
{
    /**
     * @param int $idSalesOrder
     * @param int $idCustomerAddress
     *
     * @return void
     */
    public function updateFkResourceCustomerAddressForSalesOrderAddress(
        int $idSalesOrder,
        int $idCustomerAddress
    ): void {
        $this->getFactory()->getSalesOrderAddressQuery()
            ->clear()
            ->filterByIdSalesOrderAddress($idSalesOrder)
            ->update(
                [
                    ucfirst(SpySalesOrderAddressEntityTransfer::FK_RESOURCE_CUSTOMER_ADDRESS) => $idCustomerAddress,
                ],
            );
    }
}
