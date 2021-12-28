<?php

namespace FondOfOryx\Zed\CompanyRoleApi\Business\Model;

use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

interface CompanyRoleApiInterface
{
    /**
     * @param int $idCompanyRole
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function get(int $idCompanyRole): ApiItemTransfer;

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function find(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer;
}
