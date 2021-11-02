<?php

namespace FondOfOryx\Client\OneTimePasswordRestApi\Zed;

use FondOfOryx\Client\OneTimePasswordRestApi\Dependency\Client\OneTimePasswordRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\RestOneTimePasswordLoginLinkRequestAttributesTransfer;
use Generated\Shared\Transfer\RestOneTimePasswordRequestAttributesTransfer;
use Generated\Shared\Transfer\RestOneTimePasswordResponseTransfer;

class OneTimePasswordRestApiStub implements OneTimePasswordRestApiStubInterface
{
    /**
     * @var \FondOfOryx\Client\OneTimePasswordRestApi\Dependency\Client\OneTimePasswordRestApiToZedRequestClientInterface
     */
    protected $zedStub;

    /**
     * @param \FondOfOryx\Client\OneTimePasswordRestApi\Dependency\Client\OneTimePasswordRestApiToZedRequestClientInterface $zedStub
     */
    public function __construct(OneTimePasswordRestApiToZedRequestClientInterface $zedStub)
    {
        $this->zedStub = $zedStub;
    }

    /**
     * @param \Generated\Shared\Transfer\RestOneTimePasswordRequestAttributesTransfer $restOneTimePasswordRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestOneTimePasswordResponseTransfer
     */
    public function requestOneTimePassword(
        RestOneTimePasswordRequestAttributesTransfer $restOneTimePasswordRequestAttributesTransfer
    ): RestOneTimePasswordResponseTransfer {
        /** @var \Generated\Shared\Transfer\RestOneTimePasswordResponseTransfer $restOneTimePasswordResponseTransfer */
        $restOneTimePasswordResponseTransfer = $this->zedStub->call(
            '/one-time-password-rest-api/gateway/request-one-time-password',
            $restOneTimePasswordRequestAttributesTransfer,
        );

        return $restOneTimePasswordResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\RestOneTimePasswordLoginLinkRequestAttributesTransfer $oneTimePasswordLoginLinkRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestOneTimePasswordResponseTransfer
     */
    public function requestOneTimePasswordLoginLink(
        RestOneTimePasswordLoginLinkRequestAttributesTransfer $oneTimePasswordLoginLinkRequestTransfer
    ): RestOneTimePasswordResponseTransfer {
        /** @var \Generated\Shared\Transfer\RestOneTimePasswordResponseTransfer $restOneTimePasswordResponseTransfer */
        $restOneTimePasswordResponseTransfer = $this->zedStub->call(
            '/one-time-password-rest-api/gateway/request-one-time-password-login-link',
            $oneTimePasswordLoginLinkRequestTransfer,
        );

        return $restOneTimePasswordResponseTransfer;
    }
}
