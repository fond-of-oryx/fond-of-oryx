<?php

namespace FondOfOryx\Client\SplittableTotalsRestApi;

use Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfOryx\Client\SplittableTotalsRestApi\SplittableTotalsRestApiFactory getFactory()
 */
class SplittableTotalsRestApiClient extends AbstractClient implements SplittableTotalsRestApiClientInterface
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
            ->createSplittableTotalsRestApiZedStub()
            ->getSplittableTotals($restSplittableTotalsRequestTransfer);
    }
}
