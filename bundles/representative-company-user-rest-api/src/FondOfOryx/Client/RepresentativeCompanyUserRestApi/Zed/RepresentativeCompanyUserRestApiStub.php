<?php

namespace FondOfOryx\Client\RepresentativeCompanyUserRestApi\Zed;

use FondOfOryx\Client\RepresentativeCompanyUserRestApi\Dependency\Client\RepresentativeCompanyUserRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserCollectionResponseTransfer;
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
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer|\Generated\Shared\Transfer\RestErrorMessageTransfer
     */
    public function addRepresentation(
        RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
    ): RestRepresentativeCompanyUserResponseTransfer|RestErrorMessageTransfer {
        /** @var \Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer|\Generated\Shared\Transfer\RestErrorMessageTransfer $representativeCompanyUserRestResponseTransfer */
        $representativeCompanyUserRestResponseTransfer = $this->zedRequestClient->call(static::ADD_REPRESENTATION, $restRepresentativeCompanyUserRequestTransfer);

        return $representativeCompanyUserRestResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserCollectionResponseTransfer|\Generated\Shared\Transfer\RestErrorMessageTransfer
     */
    public function getRepresentation(
        RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
    ): RestRepresentativeCompanyUserCollectionResponseTransfer|RestErrorMessageTransfer {
        /** @var \Generated\Shared\Transfer\RestRepresentativeCompanyUserCollectionResponseTransfer|\Generated\Shared\Transfer\RestErrorMessageTransfer $representativeCompanyUserRestResponseTransfer */
        $representativeCompanyUserRestResponseTransfer = $this->zedRequestClient->call(static::GET_REPRESENTATION, $restRepresentativeCompanyUserRequestTransfer);

        return $representativeCompanyUserRestResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer|\Generated\Shared\Transfer\RestErrorMessageTransfer
     */
    public function patchRepresentation(
        RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
    ): RestRepresentativeCompanyUserResponseTransfer|RestErrorMessageTransfer {
        /** @var \Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer|\Generated\Shared\Transfer\RestErrorMessageTransfer $representativeCompanyUserRestResponseTransfer */
        $representativeCompanyUserRestResponseTransfer = $this->zedRequestClient->call(static::PATCH_REPRESENTATION, $restRepresentativeCompanyUserRequestTransfer);

        return $representativeCompanyUserRestResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer|\Generated\Shared\Transfer\RestErrorMessageTransfer
     */
    public function deleteRepresentation(
        RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
    ): RestRepresentativeCompanyUserResponseTransfer|RestErrorMessageTransfer {
        /** @var \Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer|\Generated\Shared\Transfer\RestErrorMessageTransfer $representativeCompanyUserRestResponseTransfer */
        $representativeCompanyUserRestResponseTransfer = $this->zedRequestClient->call(static::DELETE_REPRESENTATION, $restRepresentativeCompanyUserRequestTransfer);

        return $representativeCompanyUserRestResponseTransfer;
    }
}
