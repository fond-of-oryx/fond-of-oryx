<?php

namespace FondOfOryx\Zed\CompanyDeleterErpInvoiceConnector\Business\Model;

use FondOfOryx\Zed\CompanyDeleterErpInvoiceConnector\Persistence\CompanyDeleterErpInvoiceConnectorEntityManagerInterface;
use Generated\Shared\Transfer\CompanyTransfer;

class ErpInvoiceDeleter implements ErpInvoiceDeleterInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyDeleterErpInvoiceConnector\Persistence\CompanyDeleterErpInvoiceConnectorEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param \FondOfOryx\Zed\CompanyDeleterErpInvoiceConnector\Persistence\CompanyDeleterErpInvoiceConnectorEntityManagerInterface $entityManager
     */
    public function __construct(CompanyDeleterErpInvoiceConnectorEntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteErpInvoiceDataForCompanyByIdCompany(CompanyTransfer $companyTransfer): void
    {
        $this->entityManager->deleteErpInvoiceByIdCompany($companyTransfer);
    }
}
