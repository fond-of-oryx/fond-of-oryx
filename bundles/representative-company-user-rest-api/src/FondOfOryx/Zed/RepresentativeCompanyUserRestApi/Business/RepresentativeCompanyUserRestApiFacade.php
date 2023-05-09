<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Business;

use Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Business\RepresentativeCompanyUserRestApiBusinessFactory getFactory()
 */
class RepresentativeCompanyUserRestApiFacade extends AbstractFacade implements RepresentativeCompanyUserRestApiFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer
     */
    public function addRepresentation(
        RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
    ): RestRepresentativeCompanyUserResponseTransfer {
        return $this->getFactory()
            ->createRepresentationManager()
            ->addRepresentation($restRepresentativeCompanyUserRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer
     */
    public function getRepresentation(
        RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
    ): RestRepresentativeCompanyUserResponseTransfer {
        return $this->getFactory()
            ->createRepresentationManager()
            ->getRepresentation($restRepresentativeCompanyUserRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer
     */
    public function updateRepresentation(
        RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
    ): RestRepresentativeCompanyUserResponseTransfer {
        return $this->getFactory()
            ->createRepresentationManager()
            ->updateRepresentation($restRepresentativeCompanyUserRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer
     */
    public function deleteRepresentation(
        RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
    ): RestRepresentativeCompanyUserResponseTransfer {
        return $this->getFactory()
            ->createRepresentationManager()
            ->deleteRepresentation($restRepresentativeCompanyUserRequestTransfer);
    }
}
