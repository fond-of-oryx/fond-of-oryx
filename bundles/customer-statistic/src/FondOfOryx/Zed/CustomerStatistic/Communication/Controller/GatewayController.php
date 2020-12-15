<?php

namespace FondOfOryx\Zed\CustomerStatistic\Communication\Controller;

use Generated\Shared\Transfer\CustomerStatisticResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \FondOfOryx\Zed\CustomerStatistic\Business\CustomerStatisticFacadeInterface getFacade()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerStatisticResponseTransfer
     */
    public function incrementLoginCountAction(CustomerTransfer $customerTransfer): CustomerStatisticResponseTransfer
    {
        return $this->getFacade()
            ->incrementLoginCount($customerTransfer);
    }
}
