<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApi\Persistence;

use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CompanyUserCollectionTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
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
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function findCustomer(RestCompanyUsersBulkItemCustomerTransfer $restCompanyUsersBulkItemCustomerTransfer): CustomerTransfer;

    /**
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     *
     * @return \Generated\Shared\Transfer\CompanyUserTransfer|null
     */
    public function findCompanyUser(CompanyUserTransfer $companyUserTransfer): ?CompanyUserTransfer;

    /**
     * @param int $idCompany
     * @param int $idCustomer
     *
     * @return \Generated\Shared\Transfer\CompanyUserCollectionTransfer
     */
    public function findCompanyUsersByFkCompanyAndFkCustomer(int $idCompany, int $idCustomer): CompanyUserCollectionTransfer;

    /**
     * @param \Generated\Shared\Transfer\RestCompanyUsersBulkItemCompanyTransfer $restCompanyUsersBulkItemCompanyTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer
     */
    public function findCompany(RestCompanyUsersBulkItemCompanyTransfer $restCompanyUsersBulkItemCompanyTransfer): CompanyTransfer;
}
