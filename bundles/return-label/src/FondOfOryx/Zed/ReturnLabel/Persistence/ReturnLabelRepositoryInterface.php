<?php

namespace FondOfOryx\Zed\ReturnLabel\Persistence;

use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;

interface ReturnLabelRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\ReturnLabelRequestTransfer $returnLabelRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressTransfer|null
     */
    public function getCompanyUnitAddressByReturnLabelRequest(
        ReturnLabelRequestTransfer $returnLabelRequestTransfer
    ): ?CompanyUnitAddressTransfer;
}
