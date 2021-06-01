<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApiExtension\Dependency\Plugin;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer;

interface QuoteExpanderPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expand(
        RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer,
        QuoteTransfer $quoteTransfer
    ): QuoteTransfer;
}
