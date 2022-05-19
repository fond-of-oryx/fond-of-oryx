<?php

namespace FondOfOryx\Zed\CompanyUserApi\Business;

use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

interface CompanyUserApiFacadeInterface
{
    /**
     * Specification:
     *  - Adds new company user.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function addCompanyUser(ApiDataTransfer $apiDataTransfer): ApiItemTransfer;

    /**
     * Specification:
     *  - Finds company user by company user ID.
     *  - Throws CompanyUserNotFoundException if not found.
     *
     * @api
     *
     * @param int $idCompanyUser
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function getCompanyUser(int $idCompanyUser): ApiItemTransfer;

    /**
     * Specification:
     *  - Finds company user by company user ID.
     *  - Throws CompanyUserNotFoundException if not found.
     *  - Entity is modified with data from CompanyUserTransfer and saved.
     *
     * @api
     *
     * @param int $idCompanyUser
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function updateCompanyUser(int $idCompanyUser, ApiDataTransfer $apiDataTransfer): ApiItemTransfer;

    /**
     * Specification:
     *  - Finds company user by company user ID.
     *  - Throws CompanyUserNotFoundException if not found.
     *  - Deletes company.
     *
     * @api
     *
     * @param int $idCompanyUser
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function removeCompanyUser(int $idCompanyUser): ApiItemTransfer;

    /**
     * Specification:
     *  - Finds company users by filter transfer, including sort, conditions and pagination.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function findCompanyUsers(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer;

    /**
     * Specification:
     * - Validates the given API data and returns an array of errors if necessary.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return array
     */
    public function validate(ApiDataTransfer $apiDataTransfer): array;
}
