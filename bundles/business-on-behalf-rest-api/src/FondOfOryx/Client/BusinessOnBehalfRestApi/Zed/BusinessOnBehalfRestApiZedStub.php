<?php

namespace FondOfOryx\Client\BusinessOnBehalfRestApi\Zed;

use FondOfOryx\Client\BusinessOnBehalfRestApi\Dependency\Client\BusinessOnBehalfRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\RestBusinessOnBehalfRequestTransfer;
use Generated\Shared\Transfer\RestBusinessOnBehalfResponseTransfer;

class BusinessOnBehalfRestApiZedStub implements BusinessOnBehalfRestApiZedStubInterface
{
    /**
     * @var \FondOfOryx\Client\BusinessOnBehalfRestApi\Dependency\Client\BusinessOnBehalfRestApiToZedRequestClientInterface
     */
    protected BusinessOnBehalfRestApiToZedRequestClientInterface $zedRequestClient;

    /**
     * @param \FondOfOryx\Client\BusinessOnBehalfRestApi\Dependency\Client\BusinessOnBehalfRestApiToZedRequestClientInterface $zedRequestClient
     */
    public function __construct(BusinessOnBehalfRestApiToZedRequestClientInterface $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @param \Generated\Shared\Transfer\RestBusinessOnBehalfRequestTransfer $restBusinessOnBehalfRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestBusinessOnBehalfResponseTransfer
     */
    public function setDefaultCompanyUserByRestBusinessOnBehalfRequest(
        RestBusinessOnBehalfRequestTransfer $restBusinessOnBehalfRequestTransfer
    ): RestBusinessOnBehalfResponseTransfer {
        /** @var \Generated\Shared\Transfer\RestBusinessOnBehalfResponseTransfer $restBusinessOnBehalfResponseTransfer */
        $restBusinessOnBehalfResponseTransfer = $this->zedRequestClient->call(
            '/business-on-behalf-rest-api/gateway/set-default-company-user-by-rest-business-on-behalf-request',
            $restBusinessOnBehalfRequestTransfer,
        );

        return $restBusinessOnBehalfResponseTransfer;
    }
}
