<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Communication\Controller;

use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelRestApiResponseTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \FondOfOryx\Zed\ReturnLabelsRestApi\Business\ReturnLabelsRestApiFacadeInterface getFacade()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\RestReturnLabelTransfer $restReturnLabelTransfer
     *
     * @return \Generated\Shared\Transfer\ReturnLabelRestApiResponseTransfer
     */
    public function generateReturnLabelAction(
        RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
    ): ReturnLabelRestApiResponseTransfer {
        return $this->getFacade()
            ->generateReturnLabel($restReturnLabelRequestTransfer);
    }
}
