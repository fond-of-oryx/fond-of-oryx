<?php

namespace FondOfOryx\Client\ReturnLabelsRestApi\Zed;

use FondOfOryx\Client\ReturnLabelsRestApi\Dependency\Client\ReturnLabelsRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\RestReturnLabelResponseTransfer;
use Generated\Shared\Transfer\ReturnLabelRestApiResponseTransfer;
use Generated\Shared\Transfer\ReturnLabelsRestApiAttributesTransfer;
use Generated\Shared\Transfer\ReturnLabelsRestApiTransfer;

class ReturnLabelsRestApiZedStub implements ReturnLabelsRestApiZedStubInterface
{
    /**
     * @var ReturnLabelsRestApiToZedRequestClientInterface
     */
    protected $zedRequestClient;

    /**
     * @param ReturnLabelsRestApiToZedRequestClientInterface $zedRequestClient
     */
    public function __construct(ReturnLabelsRestApiToZedRequestClientInterface $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @param ReturnLabelsRestApiTransfer $returnLabelsRestApiTransfer
     *
     * @return ReturnLabelRestApiResponseTransfer
     */
    public function findCompanyUnitAddressByUuid(
        ReturnLabelsRestApiTransfer $returnLabelsRestApiTransfer
    ): ReturnLabelRestApiResponseTransfer {
        /** @var ReturnLabelRestApiResponseTransfer $returnLabelRestApiResponseTransfer */
        $returnLabelRestApiResponseTransfer = $this->zedRequestClient->call(
            '/return-labels-rest-api/gateaway/find-company-unit-address',
            $returnLabelsRestApiTransfer
        );

        return $restReturnLabelResponseTransfer;
    }
}
