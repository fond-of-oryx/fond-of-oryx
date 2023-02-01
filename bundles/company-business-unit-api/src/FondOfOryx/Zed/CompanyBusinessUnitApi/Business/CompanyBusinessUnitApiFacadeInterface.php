<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitApi\Business;

use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

interface CompanyBusinessUnitApiFacadeInterface
{
    /**
     * Specification:
     *  - Adds new company business unit.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function addCompanyBusinessUnit(ApiDataTransfer $apiDataTransfer): ApiItemTransfer;

    /**
     * Specification:
     *  - Finds company business unit by company business unit ID.
     *  - Throws CompanyBusinessUnitNotFoundException if not found.
     *
     * @api
     *
     * @param int $idCompanyBusinessUnit
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function getCompanyBusinessUnit(int $idCompanyBusinessUnit): ApiItemTransfer;

    /**
     * Specification:
     *  - Finds company business unit by company business unit ID.
     *  - Throws CompanyBusinessUnitNotFoundException if not found.
     *  - Entity is modified with data from CompanyBusinessUnitTransfer and saved.
     *
     * @api
     *
     * @param int $idCompanyBusinessUnit
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function updateCompanyBusinessUnit(
        int $idCompanyBusinessUnit,
        ApiDataTransfer $apiDataTransfer
    ): ApiItemTransfer;

    /**
     * Specification:
     *  - Finds company business unit by company business unit ID.
     *  - Throws CompanyBusinessUnitNotFoundException if not found.
     *  - Deletes company business unit.
     *
     * @api
     *
     * @param int $idCompanyBusinessUnit
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function removeCompanyBusinessUnit(int $idCompanyBusinessUnit): ApiItemTransfer;

    /**
     * Specification:
     *  - Finds company business units by filter transfer, including sort, conditions and pagination.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function findCompanyBusinessUnits(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer;

    /**
     * Specification:
     * - Validates the given API data and returns an array of errors if necessary.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
     */
    public function validate(ApiRequestTransfer $apiRequestTransfer): array;
}
