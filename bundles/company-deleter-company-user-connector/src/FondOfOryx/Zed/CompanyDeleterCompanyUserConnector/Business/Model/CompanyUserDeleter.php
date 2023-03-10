<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyUserConnector\Business\Model;

use FondOfOryx\Zed\CompanyDeleterCompanyUserConnector\Persistence\CompanyDeleterCompanyUserConnectorEntityManagerInterface;
use Generated\Shared\Transfer\CompanyTransfer;

class CompanyUserDeleter implements CompanyUserDeleterInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyUserConnector\Persistence\CompanyDeleterCompanyUserConnectorEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param \FondOfOryx\Zed\CompanyDeleterCompanyUserConnector\Persistence\CompanyDeleterCompanyUserConnectorEntityManagerInterface $entityManager
     */
    public function __construct(CompanyDeleterCompanyUserConnectorEntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteCompanyUserDataForCompanyByIdCompany(CompanyTransfer $companyTransfer): void
    {
        $this->entityManager->deleteCompanyUserByIdCompany($companyTransfer);
    }
}
