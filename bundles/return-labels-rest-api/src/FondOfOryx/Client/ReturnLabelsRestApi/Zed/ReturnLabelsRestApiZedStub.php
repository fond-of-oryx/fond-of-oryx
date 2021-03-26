<?php

namespace FondOfOryx\Client\ReturnLabelsRestApi\Zed;

use FondOfOryx\Client\ReturnLabelsRestApi\Dependency\Client\ReturnLabelsRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
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
     * @param ReturnLabelsRestApiAttributesTransfer $returnLabelsRestApiAttributesTransfer
     *
     * @return CompanyUnitAddressTransfer|null
     */
    public function findCompanyUnitAddressByUuid(
        ReturnLabelsRestApiTransfer $returnLabelsRestApiTransfer
    ): ?CompanyUnitAddressTransfer {
        return $this->zedRequestClient->call(
            '/return-labels-rest-api/gateway/find-company-unit-address',
            $returnLabelsRestApiTransfer
        );
    }

    /**
     * @param CompanyUnitAddressTransfer $companyUnitAddressTransfer
     *
     * @return ReturnLabelRestApiResponseTransfer
     */
    public function getReturnLabel(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer
    ): ReturnLabelRestApiResponseTransfer {
        return $this->zedRequestClient->call(
            '/return-labels-rest-api/gateway/get-return-label',
            $companyUnitAddressTransfer
        );
    }
}
