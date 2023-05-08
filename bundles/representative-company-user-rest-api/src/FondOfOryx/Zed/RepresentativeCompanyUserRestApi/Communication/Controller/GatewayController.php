<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Communication\Controller;

use Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Business\RepresentativeCompanyUserRestApiFacadeInterface getFacade()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer
     */
    public function addRepresentationAction(
        RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
    ): RestRepresentativeCompanyUserResponseTransfer {
        return $this->getFacade()->addRepresentation($restRepresentativeCompanyUserRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer
     */
    public function getRepresentationAction(
        RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
    ): RestRepresentativeCompanyUserResponseTransfer {
        return $this->getFacade()->getRepresentation($restRepresentativeCompanyUserRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer
     */
    public function patchRepresentationAction(
        RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
    ): RestRepresentativeCompanyUserResponseTransfer {
        return $this->getFacade()->updateRepresentation($restRepresentativeCompanyUserRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer
     */
    public function deleteRepresentationAction(
        RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
    ): RestRepresentativeCompanyUserResponseTransfer {
        return $this->getFacade()->deleteRepresentation($restRepresentativeCompanyUserRequestTransfer);
    }
}
