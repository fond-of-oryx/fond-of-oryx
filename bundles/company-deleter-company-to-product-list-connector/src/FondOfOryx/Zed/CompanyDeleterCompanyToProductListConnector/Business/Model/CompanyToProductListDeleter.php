<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyToProductListConnector\Business\Model;

use FondOfOryx\Zed\CompanyDeleterCompanyToProductListConnector\Persistence\CompanyDeleterCompanyToProductListConnectorEntityManagerInterface;
use Generated\Shared\Transfer\CompanyTransfer;

class CompanyToProductListDeleter implements CompanyToProductListDeleterInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyToProductListConnector\Persistence\CompanyDeleterCompanyToProductListConnectorEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param \FondOfOryx\Zed\CompanyDeleterCompanyToProductListConnector\Persistence\CompanyDeleterCompanyToProductListConnectorEntityManagerInterface $entityManager
     */
    public function __construct(CompanyDeleterCompanyToProductListConnectorEntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteProductListDataForCompanyByIdCompany(CompanyTransfer $companyTransfer): void
    {
        $this->entityManager->deleteCompanyProductListRelationsByIdCompany($companyTransfer);
    }
}
