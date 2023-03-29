<?php

namespace FondOfOryx\Zed\BusinessOnBehalfRestApi\Business\Writer;

use Generated\Shared\Transfer\RestBusinessOnBehalfRequestTransfer;
use Generated\Shared\Transfer\RestBusinessOnBehalfResponseTransfer;

interface CompanyUserWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestBusinessOnBehalfRequestTransfer $restBusinessOnBehalfRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestBusinessOnBehalfResponseTransfer
     */
    public function setDefaultByRestBusinessOnBehalfRequest(
        RestBusinessOnBehalfRequestTransfer $restBusinessOnBehalfRequestTransfer
    ): RestBusinessOnBehalfResponseTransfer;
}
