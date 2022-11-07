<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Business;

use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Business\ReturnLabelsRestApiCompanyConnectorBusinessFactory getFactory()
 */
class ReturnLabelsRestApiCompanyConnectorFacade extends AbstractFacade implements ReturnLabelsRestApiCompanyConnectorFacadeInterface
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
        return $this->getFactory()
            ->createReturnLabelRequestExpander()
            ->expand($restReturnLabelRequestTransfer, $returnLabelRequestTransfer);
    }
}
