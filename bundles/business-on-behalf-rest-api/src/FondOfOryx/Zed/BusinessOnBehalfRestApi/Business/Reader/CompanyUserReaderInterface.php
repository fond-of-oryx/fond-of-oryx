<?php

namespace FondOfOryx\Zed\BusinessOnBehalfRestApi\Business\Reader;

use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\RestBusinessOnBehalfRequestTransfer;

interface CompanyUserReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestBusinessOnBehalfRequestTransfer $restBusinessOnBehalfRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserTransfer|null
     */
    public function getByRestBusinessOnBehalfRequest(
        RestBusinessOnBehalfRequestTransfer $restBusinessOnBehalfRequestTransfer
    ): ?CompanyUserTransfer;
}
