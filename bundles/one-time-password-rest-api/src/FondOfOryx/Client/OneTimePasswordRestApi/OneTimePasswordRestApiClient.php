<?php

namespace FondOfOryx\Client\OneTimePasswordRestApi;

use Generated\Shared\Transfer\RestOneTimePasswordRequestAttributesTransfer;
use Generated\Shared\Transfer\RestOneTimePasswordResponseTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfOryx\Client\OneTimePasswordRestApi\OneTimePasswordRestApiFactory getFactory()
 */
class OneTimePasswordRestApiClient extends AbstractClient implements OneTimePasswordRestApiClientInterface
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
            ->createOneTimePasswordZedStub()
            ->requestOneTimePassword($restOneTimePasswordRequestAttributesTransfer);
    }
}
