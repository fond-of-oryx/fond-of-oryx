<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business;

use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairResponseTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\RepresentativeCompanyUserTradeFairRestApiBusinessFactory getFactory()
 */
class RepresentativeCompanyUserTradeFairRestApiFacade extends AbstractFacade implements RepresentativeCompanyUserTradeFairRestApiFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairResponseTransfer
     */
    public function addTradeFairRepresentation(
        RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransfer
    ): RestRepresentativeCompanyUserTradeFairResponseTransfer {
        return $this->getFactory()
            ->createTradeFairRepresentationManager()
            ->addTradeFairRepresentation($restRepresentativeCompanyUserTradeFairRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairResponseTransfer
     */
    public function getTradeFairRepresentation(
        RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransfer
    ): RestRepresentativeCompanyUserTradeFairResponseTransfer {
        return $this->getFactory()
            ->createTradeFairRepresentationManager()
            ->getTradeFairRepresentation($restRepresentativeCompanyUserTradeFairRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairResponseTransfer
     */
    public function updateTradeFairRepresentation(
        RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransfer
    ): RestRepresentativeCompanyUserTradeFairResponseTransfer {
        return $this->getFactory()
            ->createTradeFairRepresentationManager()
            ->updateTradeFairRepresentation($restRepresentativeCompanyUserTradeFairRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairResponseTransfer
     */
    public function deleteTradeFairRepresentation(
        RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransfer
    ): RestRepresentativeCompanyUserTradeFairResponseTransfer {
        return $this->getFactory()
            ->createTradeFairRepresentationManager()
            ->deleteTradeFairRepresentation($restRepresentativeCompanyUserTradeFairRequestTransfer);
    }
}
