<?php

namespace FondOfOryx\Zed\SplittableTotals\Business;

use Generated\Shared\Transfer\SplittableTotalsRequestTransfer;
use Generated\Shared\Transfer\SplittableTotalsResponseTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\SplittableTotals\Business\SplittableTotalsBusinessFactory getFactory()
 */
class SplittableTotalsFacade extends AbstractFacade implements SplittableTotalsFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\SplittableTotalsRequestTransfer $splittableTotalsRequestTransfer
     *
     * @return \Generated\Shared\Transfer\SplittableTotalsResponseTransfer
     */
    public function getSplittableTotalsBySplittableTotalsRequest(
        SplittableTotalsRequestTransfer $splittableTotalsRequestTransfer
    ): SplittableTotalsResponseTransfer {
        return $this->getFactory()->createSplittableTotalsReader()
            ->getBySplittableTotalsRequest($splittableTotalsRequestTransfer);
    }
}
