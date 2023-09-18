<?php

namespace FondOfOryx\Client\RepresentativeCompanyUserRestApi;

use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserCollectionResponseTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfOryx\Client\RepresentativeCompanyUserRestApi\RepresentativeCompanyUserRestApiFactory getFactory()
 */
class RepresentativeCompanyUserRestApiClient extends AbstractClient implements RepresentativeCompanyUserRestApiClientInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer|RestErrorMessageTransfer
     */
    public function addRepresentation(
        RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
    ): RestRepresentativeCompanyUserResponseTransfer|RestErrorMessageTransfer {
        return $this->getFactory()->createZedRepresentativeCompanyUserRestApiStub()->addRepresentation($restRepresentativeCompanyUserRequestTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserCollectionResponseTransfer|RestErrorMessageTransfer
     */
    public function getRepresentation(
        RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
    ): RestRepresentativeCompanyUserCollectionResponseTransfer|RestErrorMessageTransfer {
        return $this->getFactory()->createZedRepresentativeCompanyUserRestApiStub()->getRepresentation($restRepresentativeCompanyUserRequestTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer|RestErrorMessageTransfer
     */
    public function patchRepresentation(
        RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
    ): RestRepresentativeCompanyUserResponseTransfer|RestErrorMessageTransfer {
        return $this->getFactory()->createZedRepresentativeCompanyUserRestApiStub()->patchRepresentation($restRepresentativeCompanyUserRequestTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer|RestErrorMessageTransfer
     */
    public function deleteRepresentation(
        RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
    ): RestRepresentativeCompanyUserResponseTransfer|RestErrorMessageTransfer {
        return $this->getFactory()->createZedRepresentativeCompanyUserRestApiStub()->deleteRepresentation($restRepresentativeCompanyUserRequestTransfer);
    }
}
