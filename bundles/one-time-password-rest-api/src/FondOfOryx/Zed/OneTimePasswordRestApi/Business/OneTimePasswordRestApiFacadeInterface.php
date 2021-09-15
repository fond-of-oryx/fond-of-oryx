<?php

namespace FondOfOryx\Zed\OneTimePasswordRestApi\Business;

use Generated\Shared\Transfer\RestOneTimePasswordLoginLinkRequestAttributesTransfer;
use Generated\Shared\Transfer\RestOneTimePasswordRequestAttributesTransfer;
use Generated\Shared\Transfer\RestOneTimePasswordResponseTransfer;

interface OneTimePasswordRestApiFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestOneTimePasswordRequestAttributesTransfer $restOneTimePasswordRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestOneTimePasswordResponseTransfer
     */
    public function requestOneTimePassword(
        RestOneTimePasswordRequestAttributesTransfer $restOneTimePasswordRequestAttributesTransfer
    ): RestOneTimePasswordResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\RestOneTimePasswordLoginLinkRequestAttributesTransfer $oneTimePasswordLoginLinkRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestOneTimePasswordResponseTransfer
     */
    public function requestLoginLink(
        RestOneTimePasswordLoginLinkRequestAttributesTransfer $oneTimePasswordLoginLinkRequestTransfer
    ): RestOneTimePasswordResponseTransfer;
}
