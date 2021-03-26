<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Facade;

use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ReturnLabelsRestApiAttributesTransfer;

interface ReturnLabelsRestApiFacadeInterface
{
    /**
     * @param int $idCompanyUnitAddress
     *
     * @return ApiItemTransfer
     */
    public function requestReturnLabel(int $idCompanyUnitAddress): ApiItemTransfer;

    /**
     * @param ReturnLabelRestApiResponseTransfer $returnLabelRestApiResponseTransfer
     *
     * @return mixed
     */
    public function findCompanyUnitAddress(
        ReturnLabelsRestApiAttributesTransfer $returnLabelsRestApiAttributesTransfer
    );
}
