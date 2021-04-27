<?php

namespace FondOfOryx\Glue\SplittableTotalsRestApi\Processor\Expander;

use Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface RestSplittableTotalsRequestExpanderInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer
     */
    public function expand(
        RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer,
        RestRequestInterface $restRequest
    ): RestSplittableTotalsRequestTransfer;
}
