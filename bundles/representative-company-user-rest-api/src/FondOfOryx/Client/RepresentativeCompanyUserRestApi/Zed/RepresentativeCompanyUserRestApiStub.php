<?php

namespace FondOfOryx\Client\RepresentativeCompanyUserRestApi\Zed;

use FondOfOryx\Client\RepresentativeCompanyUserRestApi\Dependency\Client\RepresentativeCompanyUserRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer;

class RepresentativeCompanyUserRestApiStub implements RepresentativeCompanyUserRestApiStubInterface
{
    /**
     * @var string
     */
    public const ADD_REPRESENTATION = '/representative-company-user-rest-api/gateway/add-representation';

    /**
     * @var \FondOfOryx\Client\RepresentativeCompanyUserRestApi\Dependency\Client\RepresentativeCompanyUserRestApiToZedRequestClientInterface
     */
    protected $zedRequestClient;

    /**
     * @param \FondOfOryx\Client\RepresentativeCompanyUserRestApi\Dependency\Client\RepresentativeCompanyUserRestApiToZedRequestClientInterface $zedRequestClient
     */
    public function __construct(RepresentativeCompanyUserRestApiToZedRequestClientInterface $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer
     */
    public function addRepresentation(
        RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
    ): RestRepresentativeCompanyUserResponseTransfer {
        /** @var \Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer $representationOfSalesRestRespomseTransfer */
        $representationOfSalesRestRespomseTransfer = $this->zedRequestClient->call(static::ADD_REPRESENTATION, $restRepresentativeCompanyUserRequestTransfer);

        return $representationOfSalesRestRespomseTransfer;
    }
}
