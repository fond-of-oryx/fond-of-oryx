<?php

namespace FondOfOryx\Zed\OneTimePasswordRestApi\Communication\Controller;

use Generated\Shared\Transfer\RestOneTimePasswordLoginLinkRequestAttributesTransfer;
use Generated\Shared\Transfer\RestOneTimePasswordRequestAttributesTransfer;
use Generated\Shared\Transfer\RestOneTimePasswordResponseTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \FondOfOryx\Zed\OneTimePasswordRestApi\Business\OneTimePasswordRestApiFacadeInterface getFacade()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\RestOneTimePasswordRequestAttributesTransfer $oneTimePasswordRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestOneTimePasswordResponseTransfer
     */
    public function requestOneTimePasswordAction(
        RestOneTimePasswordRequestAttributesTransfer $oneTimePasswordRequestTransfer
    ): RestOneTimePasswordResponseTransfer {
        return $this->getFacade()->requestOneTimePassword($oneTimePasswordRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RestOneTimePasswordLoginLinkRequestAttributesTransfer $oneTimePasswordLoginLinkRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestOneTimePasswordResponseTransfer
     */
    public function requestOneTimePasswordLoginLinkAction(
        RestOneTimePasswordLoginLinkRequestAttributesTransfer $oneTimePasswordLoginLinkRequestTransfer
    ): RestOneTimePasswordResponseTransfer {
        return $this->getFacade()->requestLoginLink($oneTimePasswordLoginLinkRequestTransfer);
    }
}
