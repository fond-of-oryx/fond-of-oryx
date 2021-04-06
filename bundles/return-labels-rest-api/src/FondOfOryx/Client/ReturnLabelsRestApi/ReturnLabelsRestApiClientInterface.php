<?php

namespace FondOfOryx\Client\ReturnLabelsRestApi;

use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelRestApiResponseTransfer;

interface ReturnLabelsRestApiClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUnitAddressTransfer $companyUnitAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ReturnLabelRestApiResponseTransfer
     */
    public function generateReturnLabel(
        RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
    ): ReturnLabelRestApiResponseTransfer;
}
