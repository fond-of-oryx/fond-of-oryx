<?php

namespace FondOfOryx\Client\OneTimePasswordRestApi\Zed;

use FondOfOryx\Client\OneTimePasswordRestApi\Dependency\Client\OneTimePasswordRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\RestOneTimePasswordRequestAttributesTransfer;
use Generated\Shared\Transfer\RestOneTimePasswordResponseTransfer;

class OneTimePasswordRestApiStub implements OneTimePasswordRestApiStubInterface
{
    /**
     * @var \FondOfOryx\Client\OneTimePasswordRestApi\Dependency\Client\OneTimePasswordRestApiToZedRequestClientInterface
     */
    protected $zedStubClient;

    /**
     * @param \FondOfOryx\Client\OneTimePasswordRestApi\Dependency\Client\OneTimePasswordRestApiToZedRequestClientInterface $zedStubClient
     */
    public function __construct(OneTimePasswordRestApiToZedRequestClientInterface $zedStubClient)
    {
        $this->zedStubClient = $zedStubClient;
    }

    /**
     * @param \Generated\Shared\Transfer\RestOneTimePasswordRequestAttributesTransfer $restOneTimePasswordRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestOneTimePasswordResponseTransfer
     */
    public function requestOneTimePassword(
        RestOneTimePasswordRequestAttributesTransfer $restOneTimePasswordRequestAttributesTransfer
    ): RestOneTimePasswordResponseTransfer {
        /**
 * @var \Generated\Shared\Transfer\RestOneTimePasswordResponseTransfer $restOneTimePasswordResponseTransfer
*/
        $restOneTimePasswordResponseTransfer = $this->zedStubClient->call('/one-time-password/gateway/request-one-time-password', $restOneTimePasswordRequestAttributesTransfer);

        return $restOneTimePasswordResponseTransfer;
    }
}
