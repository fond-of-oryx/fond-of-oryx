<?php

namespace FondOfOryx\Zed\CompanyDeleterErpInvoiceConnector\Persistence;

use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfOryx\Zed\CompanyDeleterErpInvoiceConnector\Persistence\CompanyDeleterErpInvoiceConnectorPersistenceFactory getFactory()
 */
class CompanyDeleterErpInvoiceConnectorEntityManager extends AbstractEntityManager implements CompanyDeleterErpInvoiceConnectorEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteErpInvoiceByIdCompany(CompanyTransfer $companyTransfer): void
    {
        $companyBusinessUnits = $this->getFactory()->createSpyCompanyBusinessUnitQuery()->findByFkCompany($companyTransfer->getIdCompany());

        foreach ($companyBusinessUnits as $companyBusinessUnit) {
            foreach ($companyBusinessUnit->getFooErpInvoices() as $erpInvoice) {
                $totals = $erpInvoice->getFooErpInvoiceAmountToal();
                $billing = $erpInvoice->getFooErpInvoiceBillingAddress();
                $shipping = $erpInvoice->getFooErpInvoiceShippingAddress();
                $erpInvoice->getFooErpInvoiceExpenses()->delete();
                foreach ($erpInvoice->getFooErpInvoiceItems() as $item) {
                    $item->delete();
                }
                $erpInvoice->delete();
                $totals->delete();
                $billing->delete();
                $shipping->delete();
            }
        }
    }
}
