<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Business\Reader;

use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;

interface CompanyReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer|null
     */
    public function getByRestReturnLabelRequest(
        RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
    ): ?CompanyTransfer;
}
