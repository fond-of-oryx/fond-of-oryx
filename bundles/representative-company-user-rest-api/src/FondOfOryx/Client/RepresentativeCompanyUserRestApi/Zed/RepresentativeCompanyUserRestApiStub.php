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
     * @var string
     */
    public const GET_REPRESENTATION = '/representative-company-user-rest-api/gateway/get-representation';

    /**
     * @var string
     */
    public const PATCH_REPRESENTATION = '/representative-company-user-rest-api/gateway/patch-representation';

    /**
     * @var string
     */
    public const DELETE_REPRESENTATION = '/representative-company-user-rest-api/gateway/delete-representation';

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
        /** @var \Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer $representativeCompanyUserRestResponseTransfer */
        $representativeCompanyUserRestResponseTransfer = $this->zedRequestClient->call(static::ADD_REPRESENTATION, $restRepresentativeCompanyUserRequestTransfer);

        return $representativeCompanyUserRestResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer
     */
    public function getRepresentation(
        RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
    ): RestRepresentativeCompanyUserResponseTransfer {
        /** @var \Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer $representativeCompanyUserRestResponseTransfer */
        $representativeCompanyUserRestResponseTransfer = $this->zedRequestClient->call(static::GET_REPRESENTATION, $restRepresentativeCompanyUserRequestTransfer);

        return $representativeCompanyUserRestResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer
     */
    public function patchRepresentation(
        RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
    ): RestRepresentativeCompanyUserResponseTransfer {
        /** @var \Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer $representativeCompanyUserRestResponseTransfer */
        $representativeCompanyUserRestResponseTransfer = $this->zedRequestClient->call(static::PATCH_REPRESENTATION, $restRepresentativeCompanyUserRequestTransfer);

        return $representativeCompanyUserRestResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer
     */
    public function deleteRepresentation(
        RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
    ): RestRepresentativeCompanyUserResponseTransfer {
        /** @var \Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer $representativeCompanyUserRestResponseTransfer */
        $representativeCompanyUserRestResponseTransfer = $this->zedRequestClient->call(static::DELETE_REPRESENTATION, $restRepresentativeCompanyUserRequestTransfer);

        return $representativeCompanyUserRestResponseTransfer;
    }
}
