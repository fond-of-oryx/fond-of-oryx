<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Business\Model;

use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;

interface CompanyUnitAddressReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressTransfer|null
     */
    public function getCompanyUnitAddressByRestReturnLabel(
        RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
    ): ?CompanyUnitAddressTransfer;
}
