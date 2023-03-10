<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyBusinessUnitConnector\Business\Model;

use FondOfOryx\Zed\CompanyDeleterCompanyBusinessUnitConnector\Persistence\CompanyDeleterCompanyBusinessUnitConnectorEntityManagerInterface;
use Generated\Shared\Transfer\CompanyTransfer;

class BusinessUnitDeleter implements BusinessUnitDeleterInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyBusinessUnitConnector\Persistence\CompanyDeleterCompanyBusinessUnitConnectorEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param \FondOfOryx\Zed\CompanyDeleterCompanyBusinessUnitConnector\Persistence\CompanyDeleterCompanyBusinessUnitConnectorEntityManagerInterface $entityManager
     */
    public function __construct(CompanyDeleterCompanyBusinessUnitConnectorEntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteBusinessUnitDataForCompanyByIdCompany(CompanyTransfer $companyTransfer): void
    {
        $this->entityManager->deleteCompanyBusinessUnitByIdCompany($companyTransfer);
    }
}
