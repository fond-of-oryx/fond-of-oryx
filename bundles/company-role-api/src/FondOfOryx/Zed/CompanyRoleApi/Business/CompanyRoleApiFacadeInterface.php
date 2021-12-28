<?php

namespace FondOfOryx\Zed\CompanyRoleApi\Business;

use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

interface CompanyRoleApiFacadeInterface
{
    /**
     * Specification:
     *  - Finds company role by company role ID.
     *  - Throws CompanyRoleNotFoundException if not found.
     *
     * @api
     *
     * @param int $idCompanyRole
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function getCompanyRole(int $idCompanyRole): ApiItemTransfer;

    /**
     * Specification:
     *  - Finds company roles by filter transfer, including sort, conditions and pagination.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function findCompanyRoles(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer;
}
