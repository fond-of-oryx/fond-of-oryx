<?php

namespace FondOfOryx\Zed\ReturnLabel\Business\Model;

use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;

interface CompanyUnitAddressReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\ReturnLabelRequestTransfer $returnLabelRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressTransfer|null
     */
    public function getByReturnLabelRequest(
        ReturnLabelRequestTransfer $returnLabelRequestTransfer
    ): ?CompanyUnitAddressTransfer;
}
