<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Business\Reader;

use Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer;
use Generated\Shared\Transfer\ReturnLabelsRestApiTransfer;

interface CompanyUnitAddressReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\ReturnLabelsRestApiTransfer $returnLabelsRestApiTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer
     */
    public function findCompanyUnitAddressByExternalReference(
        ReturnLabelsRestApiTransfer $returnLabelsRestApiTransfer
    ): CompanyUnitAddressResponseTransfer;
}
