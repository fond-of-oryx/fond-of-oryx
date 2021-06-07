<?php

namespace FondOfOryx\Client\ReturnLabelsRestApi\Zed;

use FondOfOryx\Client\ReturnLabelsRestApi\Dependency\Client\ReturnLabelsRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\RestReturnLabelResponseTransfer;

class ReturnLabelsRestApiZedStub implements ReturnLabelsRestApiZedStubInterface
{
    /**
     * @var \FondOfOryx\Client\ReturnLabelsRestApi\Dependency\Client\ReturnLabelsRestApiToZedRequestClientInterface
     */
    protected $zedRequestClient;

    /**
     * @param \FondOfOryx\Client\ReturnLabelsRestApi\Dependency\Client\ReturnLabelsRestApiToZedRequestClientInterface $zedRequestClient
     */
    public function __construct(ReturnLabelsRestApiToZedRequestClientInterface $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @param \Generated\Shared\Transfer\RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestReturnLabelResponseTransfer
     */
    public function generateReturnLabel(
        RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
    ): RestReturnLabelResponseTransfer {
        /** @var \Generated\Shared\Transfer\RestReturnLabelResponseTransfer $restReturnLabelResponseTransfer */
        $restReturnLabelResponseTransfer = $this->zedRequestClient->call(
            '/return-labels-rest-api/gateway/generate-return-label',
            $restReturnLabelRequestTransfer
        );

        return $restReturnLabelResponseTransfer;
    }
}
