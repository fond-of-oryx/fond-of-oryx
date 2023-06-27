<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApi\Persistence;

use Generated\Shared\Transfer\CompanyCollectionTransfer;
use Generated\Shared\Transfer\CompanyUserCollectionTransfer;
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
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     *
     * @return \Generated\Shared\Transfer\CompanyUserTransfer|null
     */
    public function findCompanyUser(CompanyUserTransfer $companyUserTransfer): ?CompanyUserTransfer;

    /**
     * @param array $emailAddresses
     *
     * @return \Generated\Shared\Transfer\CustomerCollectionTransfer
     */
    public function findCustomerByEmail(array $emailAddresses): CustomerCollectionTransfer;

    /**
     * @param int $idCompany
     * @param int $idCustomer
     *
     * @return \Generated\Shared\Transfer\CompanyUserCollectionTransfer
     */
    public function findCompanyUsersByFkCompanyAndFkCustomer(int $idCompany, int $idCustomer): CompanyUserCollectionTransfer;

    /**
     * @param array $customerReferences
     *
     * @return \Generated\Shared\Transfer\CustomerCollectionTransfer
     */
    public function findCustomerByReferences(array $customerReferences): CustomerCollectionTransfer;

    /**
     * @param array $companyUuids
     *
     * @return \Generated\Shared\Transfer\CompanyCollectionTransfer|null
     */
    public function findCompaniesByUuids(array $companyUuids): ?CompanyCollectionTransfer;
}
