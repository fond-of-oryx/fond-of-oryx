<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApiBusinessCentralConnector\Dependency\Facade;

use FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\CompanyUsersBulkRestApiFacadeInterface;

class CompanyUsersBulkRestApiBusinessCentralConnectorToCompanyUsersBulkRestApiFacadeBridge implements CompanyUsersBulkRestApiBusinessCentralConnectorToCompanyUsersBulkRestApiFacadeInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\CompanyUsersBulkRestApiFacadeInterface
     */
    protected CompanyUsersBulkRestApiFacadeInterface $facade;

    /**
     * @param \FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\CompanyUsersBulkRestApiFacadeInterface $facade
     */
    public function __construct(CompanyUsersBulkRestApiFacadeInterface $facade)
    {
        $this->facade = $facade;
    }

    /**
     * @param array<int, \Generated\Shared\Transfer\CompanyUsersBulkCompanyTransfer> $companyUsersBulkCompanyTransfers
     *
     * @return array<int, \Generated\Shared\Transfer\CompanyUsersBulkCompanyTransfer>
     */
    public function appendCompanyBusinessUnitsToCompanyTransfers(array $companyUsersBulkCompanyTransfers): array
    {
        return $this->facade->appendCompanyBusinessUnitsToCompanyTransfers($companyUsersBulkCompanyTransfers);
    }

    /**
     * @param array<int, \Generated\Shared\Transfer\CompanyUsersBulkCompanyTransfer> $companyUsersBulkCompanyTransfers
     *
     * @return array<int, \Generated\Shared\Transfer\CompanyUsersBulkCompanyTransfer>
     */
    public function appendCompanyRolesToCompanyTransfers(array $companyUsersBulkCompanyTransfers): array
    {
        return $this->facade->appendCompanyRolesToCompanyTransfers($companyUsersBulkCompanyTransfers);
    }
}
