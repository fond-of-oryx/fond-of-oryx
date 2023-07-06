<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApi\Business;

use Generated\Shared\Transfer\CompanyUsersBulkPreparationCollectionTransfer;
use Generated\Shared\Transfer\RestCompanyUsersBulkItemCollectionTransfer;
use Generated\Shared\Transfer\RestCompanyUsersBulkRequestTransfer;
use Generated\Shared\Transfer\RestCompanyUsersBulkResponseTransfer;

interface CompanyUsersBulkRestApiFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestCompanyUsersBulkRequestTransfer $restCompanyUsersBulkRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyUsersBulkResponseTransfer
     */
    public function bulkProcess(
        RestCompanyUsersBulkRequestTransfer $restCompanyUsersBulkRequestTransfer
    ): RestCompanyUsersBulkResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\RestCompanyUsersBulkItemCollectionTransfer $restCompanyUsersBulkItemCollectionTransfer
     *
     * @return void
     */
    public function createCompanyUserBulkMode(
        RestCompanyUsersBulkItemCollectionTransfer $restCompanyUsersBulkItemCollectionTransfer
    ): void;

    /**
     * @param \Generated\Shared\Transfer\RestCompanyUsersBulkItemCollectionTransfer $restCompanyUsersBulkItemCollectionTransfer
     *
     * @return void
     */
    public function deleteCompanyUserBulkMode(
        RestCompanyUsersBulkItemCollectionTransfer $restCompanyUsersBulkItemCollectionTransfer
    ): void;

    /**
     * @param \Generated\Shared\Transfer\CompanyUsersBulkPreparationCollectionTransfer $companyUsersBulkPreparationCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUsersBulkPreparationCollectionTransfer
     */
    public function expandWithCompany(
        CompanyUsersBulkPreparationCollectionTransfer $companyUsersBulkPreparationCollectionTransfer
    ): CompanyUsersBulkPreparationCollectionTransfer;

    /**
     * @param \Generated\Shared\Transfer\CompanyUsersBulkPreparationCollectionTransfer $companyUsersBulkPreparationCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUsersBulkPreparationCollectionTransfer
     */
    public function expandWithCustomerByReference(
        CompanyUsersBulkPreparationCollectionTransfer $companyUsersBulkPreparationCollectionTransfer
    ): CompanyUsersBulkPreparationCollectionTransfer;

    /**
     * @param \Generated\Shared\Transfer\CompanyUsersBulkPreparationCollectionTransfer $companyUsersBulkPreparationCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUsersBulkPreparationCollectionTransfer
     */
    public function expandWithCustomerByMail(
        CompanyUsersBulkPreparationCollectionTransfer $companyUsersBulkPreparationCollectionTransfer
    ): CompanyUsersBulkPreparationCollectionTransfer;

    /**
     * @param array<int, \Generated\Shared\Transfer\CompanyUsersBulkCompanyTransfer> $companyUsersBulkCompanyTransfers
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return array<int, \Generated\Shared\Transfer\CompanyUsersBulkCompanyTransfer>
     */
    public function appendCompanyBusinessUnitsToCompanyTransfers(array $companyUsersBulkCompanyTransfers): array;

    /**
     * @param array<int, \Generated\Shared\Transfer\CompanyUsersBulkCompanyTransfer> $companyUsersBulkCompanyTransfers
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return array<int, \Generated\Shared\Transfer\CompanyUsersBulkCompanyTransfer>
     */
    public function appendCompanyRolesToCompanyTransfers(array $companyUsersBulkCompanyTransfers): array;
}
