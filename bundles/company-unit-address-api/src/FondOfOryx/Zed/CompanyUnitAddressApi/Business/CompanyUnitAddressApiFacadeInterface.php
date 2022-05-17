<?php

namespace FondOfOryx\Zed\CompanyUnitAddressApi\Business;

use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

interface CompanyUnitAddressApiFacadeInterface
{
    /**
     * Specification:
     *  - Adds new company unit address.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function addCompanyUnitAddress(ApiDataTransfer $apiDataTransfer): ApiItemTransfer;

    /**
     * Specification:
     *  - Finds company unit address by company unit address ID.
     *  - Throws CompanyUnitAddressNotFoundException if not found.
     *
     * @api
     *
     * @param int $idCompanyUnitAddress
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function getCompanyUnitAddress(int $idCompanyUnitAddress): ApiItemTransfer;

    /**
     * Specification:
     *  - Finds company unit address by company unit address ID.
     *  - Throws CompanyUnitAddressNotFoundException if not found.
     *  - Entity is modified with data from CompanyTransfer and saved.
     *
     * @api
     *
     * @param int $idCompanyUnitAddress
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function updateCompanyUnitAddress(int $idCompanyUnitAddress, ApiDataTransfer $apiDataTransfer): ApiItemTransfer;

    /**
     * Specification:
     *  - Finds company unit address by company unit address ID.
     *  - Throws CompanyUnitAddressNotFoundException if not found.
     *  - Deletes company unit address.
     *
     * @api
     *
     * @param int $idCompanyUnitAddress
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function removeCompanyUnitAddress(int $idCompanyUnitAddress): ApiItemTransfer;

    /**
     * Specification:
     *  - Finds company unit addresses by filter transfer, including sort, conditions and pagination.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function findCompanyUnitAddresses(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer;

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
