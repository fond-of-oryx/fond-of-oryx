<?php

namespace FondOfOryx\Client\ReturnLabelsRestApi\Zed;

use FondOfOryx\Client\ReturnLabelsRestApi\Dependency\Client\ReturnLabelsRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\ReturnLabelRestApiResponseTransfer;
use Generated\Shared\Transfer\ReturnLabelsRestApiTransfer;

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
    public function getReturnLabel(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer
    ): ReturnLabelRestApiResponseTransfer {
        return $this->zedRequestClient->call(
            '/return-labels-rest-api/gateway/get-return-label',
            $companyUnitAddressTransfer
        );
    }

    /**
     * @param \Generated\Shared\Transfer\ReturnLabelsRestApiTransfer $returnLabelsRestApiTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer
     */
    public function findCompanyUnitAddressByExternalReference(
        ReturnLabelsRestApiTransfer $returnLabelsRestApiTransfer
    ): CompanyUnitAddressResponseTransfer {
        return $this->zedRequestClient->call(
            '/return-labels-rest-api/gateway/find-company-unit-address-by-external-reference',
            $returnLabelsRestApiTransfer
        );
    }
}
