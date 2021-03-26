<?php

namespace FondOfOryx\Zed\OneTimePasswordRestApi\Business;

use Generated\Shared\Transfer\RestOneTimePasswordRequestAttributesTransfer;
use Generated\Shared\Transfer\RestOneTimePasswordResponseTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\OneTimePasswordRestApi\Business\OneTimePasswordRestApiBusinessFactory getFactory()
 */
class OneTimePasswordRestApiFacade extends AbstractFacade implements OneTimePasswordRestApiFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestOneTimePasswordRequestAttributesTransfer $restOneTimePasswordRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestOneTimePasswordResponseTransfer
     */
    public function requestOneTimePassword(
        RestOneTimePasswordRequestAttributesTransfer $restOneTimePasswordRequestAttributesTransfer
    ): RestOneTimePasswordResponseTransfer {
        return $this->getFactory()
            ->createOneTimePasswordRestApiSender()
            ->requestOneTimePassword($restOneTimePasswordRequestAttributesTransfer);
    }
}
