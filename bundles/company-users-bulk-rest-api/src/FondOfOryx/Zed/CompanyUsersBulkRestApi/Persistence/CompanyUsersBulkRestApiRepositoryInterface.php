<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApi\Persistence;

use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\RestCompanyUsersBulkItemCompanyTransfer;
use Generated\Shared\Transfer\RestCompanyUsersBulkItemCustomerTransfer;

interface CompanyUsersBulkRestApiRepositoryInterface
{
    /**
     * @param string $permissionKey
     * @param string $customerReference
     *
     * @return bool
     */
    public function hasPermission(
        string $permissionKey,
        string $customerReference
    ): bool;

    /**
     * @param \Generated\Shared\Transfer\RestCompanyUsersBulkItemCustomerTransfer $restCompanyUsersBulkItemCustomerTransfer
     * @return \Generated\Shared\Transfer\CustomerTransfer
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function findCustomer(RestCompanyUsersBulkItemCustomerTransfer $restCompanyUsersBulkItemCustomerTransfer): CustomerTransfer;

    /**
     * @param \Generated\Shared\Transfer\RestCompanyUsersBulkItemCompanyTransfer $restCompanyUsersBulkItemCompanyTransfer
     * @return \Generated\Shared\Transfer\CompanyTransfer
     */
    public function findCompany(RestCompanyUsersBulkItemCompanyTransfer $restCompanyUsersBulkItemCompanyTransfer): CompanyTransfer;
}
