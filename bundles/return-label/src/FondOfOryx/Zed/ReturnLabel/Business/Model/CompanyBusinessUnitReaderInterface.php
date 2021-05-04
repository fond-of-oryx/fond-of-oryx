<?php

namespace FondOfOryx\Zed\ReturnLabel\Business\Model;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;

interface CompanyBusinessUnitReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\ReturnLabelRequestTransfer $returnLabelRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitTransfer
     */
    public function getByReturnLabelRequest(
        ReturnLabelRequestTransfer $returnLabelRequestTransfer
    ): CompanyBusinessUnitTransfer;
}
