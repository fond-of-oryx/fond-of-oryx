<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Business;

use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\ReturnLabelRestApiResponseTransfer;
use Generated\Shared\Transfer\ReturnLabelsRestApiTransfer;

interface ReturnLabelsRestApiFacadeInterface
{
    /**
     * @param ReturnLabelsRestApiTransfer $returnLabelsRestApiTransfer
     *
     * @return CompanyUnitAddressTransfer|null
     */
    public function findCompanyUnitAddress(
        ReturnLabelsRestApiTransfer $returnLabelsRestApiTransfer
    ): ?CompanyUnitAddressTransfer;

    /**
     * @param CompanyUnitAddressTransfer $companyUnitAddressTransfer
     *
     * @return ReturnLabelRestApiResponseTransfer
     */
    public function getReturnLabel(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer
    ): ReturnLabelRestApiResponseTransfer;
}
