<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Business\Model;

use Generated\Shared\Transfer\RestReturnLabelTransfer;

interface CompanyUnitAddressReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestReturnLabelTransfer $restReturnLabelTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressTransfer|null
     */
    public function getIdCompanyUnitAddressByRestReturnLabel(
        RestReturnLabelTransfer $restReturnLabelTransfer
    ): ?int;
}
