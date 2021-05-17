<?php

namespace FondOfOryx\Client\SplittableTotalsRestApi\Zed;

use FondOfOryx\Client\SplittableTotalsRestApi\Dependency\Client\SplittableTotalsRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer;

class SplittableTotalsRestApiZedStub implements SplittableTotalsRestApiZedStubInterface
{
    /**
     * @var \FondOfOryx\Client\SplittableTotalsRestApi\Dependency\Client\SplittableTotalsRestApiToZedRequestClientInterface
     */
    protected $zedRequestClient;

    /**
     * @param \FondOfOryx\Client\SplittableTotalsRestApi\Dependency\Client\SplittableTotalsRestApiToZedRequestClientInterface $zedRequestClient
     */
    public function __construct(SplittableTotalsRestApiToZedRequestClientInterface $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @param \Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer
     */
    public function getSplittableTotals(
        RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer
    ): RestSplittableTotalsResponseTransfer {
        /** @var \Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer $restSplittableTotalsResponseTransfer */
        $restSplittableTotalsResponseTransfer = $this->zedRequestClient->call(
            '/splittable-totals-rest-api/gateway/get-splittable-totals',
            $restSplittableTotalsRequestTransfer
        );

        return $restSplittableTotalsResponseTransfer;
    }
}
