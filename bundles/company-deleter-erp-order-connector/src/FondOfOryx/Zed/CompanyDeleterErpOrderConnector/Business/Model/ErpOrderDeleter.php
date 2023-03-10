<?php

namespace FondOfOryx\Zed\CompanyDeleterErpOrderConnector\Business\Model;

use FondOfOryx\Zed\CompanyDeleterErpOrderConnector\Persistence\CompanyDeleterErpOrderConnectorEntityManagerInterface;
use Generated\Shared\Transfer\CompanyTransfer;

class ErpOrderDeleter implements ErpOrderDeleterInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyDeleterErpOrderConnector\Persistence\CompanyDeleterErpOrderConnectorEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param \FondOfOryx\Zed\CompanyDeleterErpOrderConnector\Persistence\CompanyDeleterErpOrderConnectorEntityManagerInterface $entityManager
     */
    public function __construct(CompanyDeleterErpOrderConnectorEntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteErpOrderDataForCompanyByIdCompany(CompanyTransfer $companyTransfer): void
    {
        $this->entityManager->deleteErpOrderByIdCompany($companyTransfer);
    }
}