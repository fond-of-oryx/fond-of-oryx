<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Communication\Controller;

use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairResponseTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\RepresentativeCompanyUserTradeFairRestApiFacadeInterface getFacade()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairResponseTransfer
     */
    public function addTradeFairRepresentationAction(
        RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransfer
    ): RestRepresentativeCompanyUserTradeFairResponseTransfer {
        return $this->getFacade()->addTradeFairRepresentation($restRepresentativeCompanyUserTradeFairRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairResponseTransfer
     */
    public function getTradeFairRepresentationAction(
        RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransfer
    ): RestRepresentativeCompanyUserTradeFairResponseTransfer {
        return $this->getFacade()->getTradeFairRepresentation($restRepresentativeCompanyUserTradeFairRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairResponseTransfer
     */
    public function patchTradeFairRepresentationAction(
        RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransfer
    ): RestRepresentativeCompanyUserTradeFairResponseTransfer {
        return $this->getFacade()->updateTradeFairRepresentation($restRepresentativeCompanyUserTradeFairRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairResponseTransfer
     */
    public function deleteTradeFairRepresentationAction(
        RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransfer
    ): RestRepresentativeCompanyUserTradeFairResponseTransfer {
        return $this->getFacade()->deleteTradeFairRepresentation($restRepresentativeCompanyUserTradeFairRequestTransfer);
    }
}
