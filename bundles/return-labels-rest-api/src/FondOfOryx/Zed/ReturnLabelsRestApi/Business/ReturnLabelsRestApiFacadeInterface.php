<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Facade;

use Generated\Shared\Transfer\ApiItemTransfer;

interface ReturnLabelsRestApiFacadeInterface
{
    /**
     * @param int $idCompanyUnitAddress
     *
     * @return ApiItemTransfer
     */
    public function requestReturnLabel(int $idCompanyUnitAddress): ApiItemTransfer;
}
