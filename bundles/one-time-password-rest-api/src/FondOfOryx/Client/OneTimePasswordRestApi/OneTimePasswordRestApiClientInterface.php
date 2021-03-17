<?php

namespace FondOfOryx\Client\OneTimePasswordRestApi;

use Generated\Shared\Transfer\RestOneTimePasswordResponseTransfer;
use Generated\Shared\Transfer\RestOneTimePasswordRequestAttributesTransfer;

interface OneTimePasswordRestApiClientInterface
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
