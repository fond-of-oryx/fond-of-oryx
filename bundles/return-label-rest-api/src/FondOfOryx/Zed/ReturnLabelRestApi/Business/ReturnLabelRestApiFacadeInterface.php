<?php

namespace FondOfOryx\Zed\ReturnLabelRestApi\Facade;

use Generated\Shared\Transfer\ApiItemTransfer;

interface ReturnLabelRestApiFacadeInterface
{
    /**
     * @param int $idCompanyUnitAddress
     *
     * @return ApiItemTransfer
     */
    public function requestReturnLabel(int $idCompanyUnitAddress): ApiItemTransfer;
}
