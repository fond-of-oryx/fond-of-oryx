<?php

namespace FondOfOryx\Zed\BusinessOnBehalfRestApi\Business;

use Generated\Shared\Transfer\RestBusinessOnBehalfRequestTransfer;
use Generated\Shared\Transfer\RestBusinessOnBehalfResponseTransfer;

interface BusinessOnBehalfRestApiFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestBusinessOnBehalfRequestTransfer $restBusinessOnBehalfRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestBusinessOnBehalfResponseTransfer
     */
    public function setDefaultCompanyUserByRestBusinessOnBehalfRequest(
        RestBusinessOnBehalfRequestTransfer $restBusinessOnBehalfRequestTransfer
    ): RestBusinessOnBehalfResponseTransfer;
}
