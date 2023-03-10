<?php

namespace FondOfOryx\Zed\CompanyDeleterErpDeliveryNoteConnector\Business\Model;

use FondOfOryx\Zed\CompanyDeleterErpDeliveryNoteConnector\Persistence\CompanyDeleterErpDeliveryNoteConnectorEntityManagerInterface;
use Generated\Shared\Transfer\CompanyTransfer;

class ErpDeliveryNoteDeleter implements ErpDeliveryNoteDeleterInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyDeleterErpDeliveryNoteConnector\Persistence\CompanyDeleterErpDeliveryNoteConnectorEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param \FondOfOryx\Zed\CompanyDeleterErpDeliveryNoteConnector\Persistence\CompanyDeleterErpDeliveryNoteConnectorEntityManagerInterface $entityManager
     */
    public function __construct(CompanyDeleterErpDeliveryNoteConnectorEntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteErpDeliveryNoteDataForCompanyByIdCompany(CompanyTransfer $companyTransfer): void
    {
        $this->entityManager->deleteErpDeliveryNoteByIdCompany($companyTransfer);
    }
}
