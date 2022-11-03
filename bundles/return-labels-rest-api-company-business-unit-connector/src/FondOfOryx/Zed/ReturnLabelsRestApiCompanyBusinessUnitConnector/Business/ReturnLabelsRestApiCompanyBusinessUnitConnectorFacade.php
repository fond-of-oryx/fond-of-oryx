<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Business;

use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Business\ReturnLabelsRestApiCompanyBusinessUnitConnectorBusinessFactory getFactory()
 */
class ReturnLabelsRestApiCompanyBusinessUnitConnectorFacade extends AbstractFacade implements ReturnLabelsRestApiCompanyBusinessUnitConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
     * @param \Generated\Shared\Transfer\ReturnLabelRequestTransfer $returnLabelRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ReturnLabelRequestTransfer
     */
    public function expandReturnLabelRequest(
        RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer,
        ReturnLabelRequestTransfer $returnLabelRequestTransfer
    ): ReturnLabelRequestTransfer {
        return $this->getFactory()->createCompanyBusinessUnitExpander()->expand(
            $restReturnLabelRequestTransfer,
            $returnLabelRequestTransfer,
        );
    }
}
