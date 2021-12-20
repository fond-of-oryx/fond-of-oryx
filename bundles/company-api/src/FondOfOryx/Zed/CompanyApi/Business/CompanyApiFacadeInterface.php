<?php

namespace FondOfOryx\Zed\CompanyApi\Business;

use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

interface CompanyApiFacadeInterface
{
    /**
     * Specification:
     *  - Adds new company.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function addCompany(ApiDataTransfer $apiDataTransfer): ApiItemTransfer;

    /**
     * Specification:
     *  - Finds company by company ID.
     *  - Throws CompanyNotFoundException if not found.
     *
     * @api
     *
     * @param int $idCompany
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function getCompany(int $idCompany): ApiItemTransfer;

    /**
     * Specification:
     *  - Finds company by company ID.
     *  - Throws CompanyNotFoundException if not found.
     *  - Entity is modified with data from CompanyTransfer and saved.
     *
     * @api
     *
     * @param int $idCompany
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function updateCompany(int $idCompany, ApiDataTransfer $apiDataTransfer): ApiItemTransfer;

    /**
     * Specification:
     *  - Finds company by company ID.
     *  - Throws CompanyNotFoundException if not found.
     *  - Deletes company.
     *
     * @api
     *
     * @param int $idCompany
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function removeCompany(int $idCompany): ApiItemTransfer;

    /**
     * Specification:
     *  - Finds companies by filter transfer, including sort, conditions and pagination.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function findCompanies(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer;

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
