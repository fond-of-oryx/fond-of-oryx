<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApi\Business\Expander;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer;

class QuoteExpander implements QuoteExpanderInterface
{
    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApiExtension\Dependency\Plugin\QuoteExpanderPluginInterface[]
     */
    protected $quoteExpanderPlugins;

    /**
     * @param \FondOfOryx\Zed\SplittableTotalsRestApiExtension\Dependency\Plugin\QuoteExpanderPluginInterface[] $quoteExpanderPlugins
     */
    public function __construct(array $quoteExpanderPlugins)
    {
        $this->quoteExpanderPlugins = $quoteExpanderPlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expand(
        RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer,
        QuoteTransfer $quoteTransfer
    ): QuoteTransfer {
        foreach ($this->quoteExpanderPlugins as $quoteExpanderPlugin) {
            $quoteTransfer = $quoteExpanderPlugin->expandQuote($restSplittableTotalsRequestTransfer, $quoteTransfer);
        }

        return $quoteTransfer;
    }
}
