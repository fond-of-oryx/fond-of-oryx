<?php

namespace FondOfOryx\Zed\CompanyUnitAddressSalesConnector\Persistence;

use Generated\Shared\Transfer\SpySalesOrderAddressEntityTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\CompanyUnitAddressSalesConnector\Persistence\CompanyUnitAddressSalesConnectorPersistenceFactory getFactory()
 */
class CompanyUnitAddressSalesConnectorEntityManager extends AbstractEntityManager implements CompanyUnitAddressSalesConnectorEntityManagerInterface
{
    /**
     * @param int $idSalesOrder
     * @param int $idCompanyUnitAddress
     *
     * @return void
     */
    public function updateFkResourceCompanyUnitAddressForSalesOrderAddress(
        int $idSalesOrder,
        int $idCompanyUnitAddress
    ): void {
        $this->getFactory()->getSalesOrderAddressQuery()
            ->clear()
            ->filterByIdSalesOrderAddress($idSalesOrder)
            ->update(
                [
                    ucfirst(SpySalesOrderAddressEntityTransfer::FK_RESOURCE_COMPANY_UNIT_ADDRESS) => $idCompanyUnitAddress,
                ],
            );
    }
}
