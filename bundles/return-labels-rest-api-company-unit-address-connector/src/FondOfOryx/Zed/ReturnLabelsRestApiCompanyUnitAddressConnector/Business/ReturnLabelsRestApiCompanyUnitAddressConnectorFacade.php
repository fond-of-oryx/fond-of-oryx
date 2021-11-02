<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Business;

use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Business\ReturnLabelsRestApiCompanyUnitAddressConnectorBusinessFactory getFactory()
 * @method \FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Persistence\ReturnLabelsRestApiCompanyUnitAddressConnectorRepositoryInterface getRepository()
 */
class ReturnLabelsRestApiCompanyUnitAddressConnectorFacade extends AbstractFacade implements
    ReturnLabelsRestApiCompanyUnitAddressConnectorFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
     * @param \Generated\Shared\Transfer\ReturnLabelRequestTransfer $returnLabelRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ReturnLabelRequestTransfer
     */
    public function expandReturnLabelRequest(
        RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer,
        ReturnLabelRequestTransfer $returnLabelRequestTransfer
    ): ReturnLabelRequestTransfer {
        return $this->getFactory()->createReturnLabelRequestExpander()->expand(
            $restReturnLabelRequestTransfer,
            $returnLabelRequestTransfer,
        );
    }
}
