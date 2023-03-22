<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyUserArchiveConnector\Business\Model;

use FondOfOryx\Zed\CompanyDeleterCompanyUserArchiveConnector\Persistence\CompanyDeleterCompanyUserArchiveConnectorEntityManagerInterface;
use Generated\Shared\Transfer\CompanyTransfer;

class CompanyUserArchiveDeleter implements CompanyUserArchiveDeleterInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyUserArchiveConnector\Persistence\CompanyDeleterCompanyUserArchiveConnectorEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param \FondOfOryx\Zed\CompanyDeleterCompanyUserArchiveConnector\Persistence\CompanyDeleterCompanyUserArchiveConnectorEntityManagerInterface $entityManager
     */
    public function __construct(CompanyDeleterCompanyUserArchiveConnectorEntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteCompanyUserArchiveDataForCompanyByIdCompany(CompanyTransfer $companyTransfer): void
    {
        $this->entityManager->deleteCompanyUserArchiveByIdCompany($companyTransfer);
    }
}
