<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApiBusinessCentralConnector\Dependency\Facade;

use FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\CompanyUsersBulkRestApiFacadeInterface;

interface CompanyUsersBulkRestApiBusinessCentralConnectorToCompanyUsersBulkRestApiFacadeInterface
{
    /**
     * @param array<int, \Generated\Shared\Transfer\CompanyUsersBulkCompanyTransfer> $companyUsersBulkCompanyTransfers
     * @return array<int, \Generated\Shared\Transfer\CompanyUsersBulkCompanyTransfer>
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function appendCompanyBusinessUnitsToCompanyTransfers(array $companyUsersBulkCompanyTransfers): array;

    /**
     * @param array<int, \Generated\Shared\Transfer\CompanyUsersBulkCompanyTransfer> $companyUsersBulkCompanyTransfers
     * @return array<int, \Generated\Shared\Transfer\CompanyUsersBulkCompanyTransfer>
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function appendCompanyRolesToCompanyTransfers(array $companyUsersBulkCompanyTransfers): array;
}
