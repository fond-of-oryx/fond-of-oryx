<?php


namespace FondOfOryx\Client\ReturnLabelsRestApi\Zed;


use Generated\Shared\Transfer\ReturnLabelsRestApiAttributesTransfer;
use Generated\Shared\Transfer\ReturnLabelsRestApiTransfer;
use Generated\Shared\Transfer\ReturnLabelRestApiResponseTransfer;

interface ReturnLabelsRestApiZedStubInterface
{
    /**
     * @param ReturnLabelsRestApiAttributesTransfer $returnLabelsRestApiAttributesTransfer
     *
     * @return ReturnLabelRestApiResponseTransfer
     */
    public function findCompanyUnitAddressByUuid(
        ReturnLabelsRestApiTransfer $returnLabelsRestApiTransfer
    ): ReturnLabelRestApiResponseTransfer;
}
