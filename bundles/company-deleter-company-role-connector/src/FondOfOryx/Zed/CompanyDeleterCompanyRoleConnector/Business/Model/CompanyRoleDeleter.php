<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyRoleConnector\Business\Model;

use FondOfOryx\Zed\CompanyDeleterCompanyRoleConnector\Persistence\CompanyDeleterCompanyRoleConnectorEntityManagerInterface;
use Generated\Shared\Transfer\CompanyTransfer;

class CompanyRoleDeleter implements CompanyRoleDeleterInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyRoleConnector\Persistence\CompanyDeleterCompanyRoleConnectorEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param \FondOfOryx\Zed\CompanyDeleterCompanyRoleConnector\Persistence\CompanyDeleterCompanyRoleConnectorEntityManagerInterface $entityManager
     */
    public function __construct(CompanyDeleterCompanyRoleConnectorEntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteCompanyRoleDataForCompanyByIdCompany(CompanyTransfer $companyTransfer): void
    {
        $this->entityManager->deleteCompanyRolesByIdCompany($companyTransfer);
    }
}
