<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Communication\Controller;

use FondOfOryx\Zed\ReturnLabelsRestApi\Facade\ReturnLabelsRestApiFacadeInterface;
use Generated\Shared\Transfer\ReturnLabelsRestApiTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method ReturnLabelsRestApiFacadeInterface getFacade()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param ReturnLabelRestApiResponseTransfer $returnLabelRestApiResponseTransfer
     */
    public function findCompanyUnitAddressAction(ReturnLabelsRestApiTransfer $returnLabelsRestApiTransfer)
    {
        $this->getFacade()->findCompanyUnitAddress($returnLabelsRestApiTransfer);
    }
}
