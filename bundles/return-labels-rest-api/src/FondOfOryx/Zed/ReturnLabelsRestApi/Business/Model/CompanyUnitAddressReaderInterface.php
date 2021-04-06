<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Business\Model;

use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;

interface CompanyUnitAddressReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
     *
     * @return int|null
     */
    public function getIdCompanyUnitAddressByRestReturnLabel(
        RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
    ): ?int;
}
