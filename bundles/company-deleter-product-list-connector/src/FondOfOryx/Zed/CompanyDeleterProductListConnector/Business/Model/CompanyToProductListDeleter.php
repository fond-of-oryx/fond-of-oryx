<?php

namespace FondOfOryx\Zed\CompanyDeleterProductListConnector\Business\Model;

use FondOfOryx\Zed\CompanyDeleterProductListConnector\Persistence\CompanyDeleterProductListConnectorEntityManagerInterface;
use Generated\Shared\Transfer\CompanyTransfer;

class CompanyToProductListDeleter implements CompanyToProductListDeleterInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyDeleterProductListConnector\Persistence\CompanyDeleterProductListConnectorEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param \FondOfOryx\Zed\CompanyDeleterProductListConnector\Persistence\CompanyDeleterProductListConnectorEntityManagerInterface $entityManager
     */
    public function __construct(CompanyDeleterProductListConnectorEntityManagerInterface $entityManager)
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
