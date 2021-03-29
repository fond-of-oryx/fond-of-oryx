<?php

namespace FondOfOryx\Client\ReturnLabelsRestApi\Zed;

use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\ReturnLabelsRestApiAttributesTransfer;
use Generated\Shared\Transfer\ReturnLabelsRestApiTransfer;
use Generated\Shared\Transfer\ReturnLabelRestApiResponseTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;

interface ReturnLabelsRestApiZedStubInterface
{
    /**
     * @param ReturnLabelsRestApiTransfer v
     *
     * @return CompanyUnitAddressTransfer|null
     */
    public function findCompanyUnitAddressByUuid(ReturnLabelsRestApiTransfer $returnLabelsRestApiTransfer): ?CompanyUnitAddressTransfer;

    /**
     * @param CompanyUnitAddressTransfer $companyUnitAddressTransfer
     *
     * @return ReturnLabelRestApiResponseTransfer
     */
    public function getReturnLabel(CompanyUnitAddressTransfer $companyUnitAddressTransfer): ReturnLabelRestApiResponseTransfer;
}
