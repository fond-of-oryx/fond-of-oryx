<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApi\Business;

use Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\SplittableTotalsRestApi\Business\SplittableTotalsRestApiBusinessFactory getFactory()
 */
class SplittableTotalsRestApiFacade extends AbstractFacade implements SplittableTotalsRestApiFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer
     */
    public function getSplittableTotals(
        RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer
    ): RestSplittableTotalsResponseTransfer {
        return $this->getFactory()
            ->createSplittableTotalsReader()
            ->getByRestSplittableTotalsRequest($restSplittableTotalsRequestTransfer);
    }
}
