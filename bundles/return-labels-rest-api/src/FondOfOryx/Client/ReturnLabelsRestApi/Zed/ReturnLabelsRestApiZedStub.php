<?php

namespace FondOfOryx\Client\ReturnLabelsRestApi\Zed;

use FondOfOryx\Client\ReturnLabelsRestApi\Dependency\Client\ReturnLabelsRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelRestApiResponseTransfer;

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
     * @param \Generated\Shared\Transfer\CompanyUnitAddressTransfer $companyUnitAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ReturnLabelRestApiResponseTransfer
     */
    public function generateReturnLabel(
        RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
    ): ReturnLabelRestApiResponseTransfer {
        return $this->zedRequestClient->call(
            '/return-labels-rest-api/gateway/generate-return-label',
            $restReturnLabelRequestTransfer
        );
    }
}
