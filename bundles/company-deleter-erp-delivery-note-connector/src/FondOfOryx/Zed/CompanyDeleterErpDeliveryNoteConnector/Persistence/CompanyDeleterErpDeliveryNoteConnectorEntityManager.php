<?php

namespace FondOfOryx\Zed\CompanyDeleterErpDeliveryNoteConnector\Persistence;

use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfOryx\Zed\CompanyDeleterErpDeliveryNoteConnector\Persistence\CompanyDeleterErpDeliveryNoteConnectorPersistenceFactory getFactory()
 */
class CompanyDeleterErpDeliveryNoteConnectorEntityManager extends AbstractEntityManager implements CompanyDeleterErpDeliveryNoteConnectorEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteErpDeliveryNoteByIdCompany(CompanyTransfer $companyTransfer): void
    {
        $companyBusinessUnits = $this->getFactory()->createSpyCompanyBusinessUnitQuery()->findByFkCompany($companyTransfer->getIdCompany());

        foreach ($companyBusinessUnits as $companyBusinessUnit) {
            foreach ($companyBusinessUnit->getFooErpDeliveryNotes() as $erpDeliveryNote) {
                $billing = $erpDeliveryNote->getFooErpDeliveryNoteBillingAddress();
                $shipping = $erpDeliveryNote->getFooErpDeliveryNoteShippingAddress();
                $erpDeliveryNote->getFooErpDeliveryNoteExpenses()->delete();

                foreach ($erpDeliveryNote->getFooErpDeliveryNoteTrackings() as $tracking) {
                    foreach ($tracking->getFooErpDeliveryNoteTrackingToItems() as $relation) {
                        $relation->delete();
                    }
                    $tracking->delete();
                }

                foreach ($erpDeliveryNote->getFooErpDeliveryNoteItems() as $item) {
                    $item->delete();
                }
                $erpDeliveryNote->delete();
                $billing->delete();
                $shipping->delete();
            }
        }
    }
}
