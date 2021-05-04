<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApi\Communication\Controller;

use Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \FondOfOryx\Zed\SplittableTotalsRestApi\Business\SplittableTotalsRestApiFacadeInterface getFacade()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer
     */
    public function getSplittableTotalsAction(
        RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer
    ): RestSplittableTotalsResponseTransfer {
        return $this->getFacade()->getSplittableTotals($restSplittableTotalsRequestTransfer);
    }
}
