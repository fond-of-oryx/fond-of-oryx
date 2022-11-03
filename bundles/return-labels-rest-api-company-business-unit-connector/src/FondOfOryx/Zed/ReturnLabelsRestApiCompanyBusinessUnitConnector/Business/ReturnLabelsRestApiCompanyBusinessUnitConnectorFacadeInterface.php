<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Business;

use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;

interface ReturnLabelsRestApiCompanyBusinessUnitConnectorFacadeInterface
{
    /**
     * Specifications:
     * - Expands return label request with company unit addresses
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
     * @param \Generated\Shared\Transfer\ReturnLabelRequestTransfer $returnLabelRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ReturnLabelRequestTransfer
     */
    public function expandReturnLabelRequest(
        RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer,
        ReturnLabelRequestTransfer $returnLabelRequestTransfer
    ): ReturnLabelRequestTransfer;
}
