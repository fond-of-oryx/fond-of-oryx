<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Business\Expander;

use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;

interface CompanyBusinessUnitExpanderInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
     * @param \Generated\Shared\Transfer\ReturnLabelRequestTransfer $returnLabelRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ReturnLabelRequestTransfer
     */
    public function expand(
        RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer,
        ReturnLabelRequestTransfer $returnLabelRequestTransfer
    ): ReturnLabelRequestTransfer;
}
