<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business;

use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\ReturnLabelsRestApiCustomerConnectorBusinessFactory getFactory()
 */
class ReturnLabelsRestApiCustomerConnectorFacade extends AbstractFacade implements ReturnLabelsRestApiCustomerConnectorFacadeInterface
{
    /**
     * Specifications:
     * - Expands return label request with customer
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
        return $this->getFactory()->createCustomerExpander()->expand(
            $restReturnLabelRequestTransfer,
            $returnLabelRequestTransfer
        );
    }
}
