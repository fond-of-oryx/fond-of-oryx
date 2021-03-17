<?php

namespace FondOfOryx\Client\OneTimePasswordRestApi\Zed;

use Generated\Shared\Transfer\RestOneTimePasswordResponseTransfer;
use Generated\Shared\Transfer\RestOneTimePasswordRequestAttributesTransfer;

interface OneTimePasswordRestApiStubInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestOneTimePasswordRequestAttributesTransfer $restOneTimePasswordRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestOneTimePasswordResponseTransfer
     */
    public function requestOneTimePassword(
        RestOneTimePasswordRequestAttributesTransfer $restOneTimePasswordRequestAttributesTransfer
    ): RestOneTimePasswordResponseTransfer;
}
