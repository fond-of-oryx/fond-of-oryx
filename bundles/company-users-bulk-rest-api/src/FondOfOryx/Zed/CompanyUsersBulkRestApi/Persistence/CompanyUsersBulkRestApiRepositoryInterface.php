<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApi\Persistence;

use Generated\Shared\Transfer\CompanyCollectionTransfer;
use Generated\Shared\Transfer\CompanyUserCollectionTransfer;
use Generated\Shared\Transfer\CompanyUsersBulkCompanyCollectionTransfer;
use Generated\Shared\Transfer\CompanyUsersBulkCustomerCollectionTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\CustomerCollectionTransfer;

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
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     * @return bool
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function isCompanyUserAlreadyAvailable(CompanyUserTransfer $companyUserTransfer): bool;

    /**
     * @param array $emailAddresses
     *
     * @return \Generated\Shared\Transfer\CompanyUsersBulkCustomerCollectionTransfer
     */
    public function findCustomerByEmail(array $emailAddresses): CompanyUsersBulkCustomerCollectionTransfer;

    /**
     * @param int $idCompany
     * @param int $idCustomer
     *
     * @return \Generated\Shared\Transfer\CompanyUserCollectionTransfer
     */
    public function findCompanyUsersByFkCompanyAndFkCustomer(int $idCompany, int $idCustomer): CompanyUserCollectionTransfer;

    /**
     * @param array $customerReferences
     * @return \Generated\Shared\Transfer\CompanyUsersBulkCustomerCollectionTransfer
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function findCustomerByReferences(array $customerReferences): CompanyUsersBulkCustomerCollectionTransfer;

    /**
     * @param array $companyUuids
     * @return \Generated\Shared\Transfer\CompanyUsersBulkCompanyCollectionTransfer
     */
    public function findCompaniesByUuids(array $companyUuids): CompanyUsersBulkCompanyCollectionTransfer;

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
