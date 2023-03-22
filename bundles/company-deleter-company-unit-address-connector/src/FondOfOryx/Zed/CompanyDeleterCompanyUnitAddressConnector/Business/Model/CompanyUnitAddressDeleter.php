<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyUnitAddressConnector\Business\Model;

use FondOfOryx\Zed\CompanyDeleterCompanyUnitAddressConnector\Persistence\CompanyDeleterCompanyUnitAddressConnectorEntityManagerInterface;
use Generated\Shared\Transfer\CompanyTransfer;

class CompanyUnitAddressDeleter implements CompanyUnitAddressDeleterInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyUnitAddressConnector\Persistence\CompanyDeleterCompanyUnitAddressConnectorEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param \FondOfOryx\Zed\CompanyDeleterCompanyUnitAddressConnector\Persistence\CompanyDeleterCompanyUnitAddressConnectorEntityManagerInterface $entityManager
     */
    public function __construct(CompanyDeleterCompanyUnitAddressConnectorEntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteCompanyUnitAddressDataForCompanyByIdCompany(CompanyTransfer $companyTransfer): void
    {
        $this->entityManager->deleteCompanyUnitAddressByIdCompany($companyTransfer);
    }
}
