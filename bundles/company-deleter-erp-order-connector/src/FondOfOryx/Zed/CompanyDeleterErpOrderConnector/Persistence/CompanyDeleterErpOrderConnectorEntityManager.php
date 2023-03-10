<?php

namespace FondOfOryx\Zed\CompanyDeleterErpOrderConnector\Persistence;

use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfOryx\Zed\CompanyDeleterErpOrderConnector\Persistence\CompanyDeleterErpOrderConnectorPersistenceFactory getFactory()
 */
class CompanyDeleterErpOrderConnectorEntityManager extends AbstractEntityManager implements CompanyDeleterErpOrderConnectorEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteErpOrderByIdCompany(CompanyTransfer $companyTransfer): void
    {
        $companyBusinessUnits = $this->getFactory()->createSpyCompanyBusinessUnitQuery()->findByFkCompany($companyTransfer->getIdCompany());

        foreach ($companyBusinessUnits as $companyBusinessUnit) {
            foreach ($companyBusinessUnit->getErpOrders() as $erpOrder) {
                $totals = $erpOrder->getErpOrderTotals();
                $billing = $erpOrder->getErpOrderBillingAddress();
                $shipping = $erpOrder->getErpOrderShippingAddress();
                foreach ($erpOrder->getErpOrderItems() as $item) {
                    $item->delete();
                }
                $erpOrder->delete();
                $totals->delete();
                $billing->delete();
                $shipping->delete();
            }
        }
    }
}
