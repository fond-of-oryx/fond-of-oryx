<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper;

use Generated\Shared\Transfer\RestSplittableTotalsTransfer;
use Generated\Shared\Transfer\SplittableTotalsTransfer;

interface RestSplittableTotalsMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\SplittableTotalsTransfer $splittableTotalsTransfer
     *
     * @return \Generated\Shared\Transfer\RestSplittableTotalsTransfer
     */
    public function fromSplittableTotals(
        SplittableTotalsTransfer $splittableTotalsTransfer
    ): RestSplittableTotalsTransfer;
}
