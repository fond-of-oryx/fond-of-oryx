<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Expander;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;

class QuoteExpander implements QuoteExpanderInterface
{
    /**
     * @var array<\FondOfOryx\Zed\SplittableCheckoutRestApiExtension\Dependency\Plugin\QuoteExpanderPluginInterface>
     */
    protected $quoteExpanderPlugins;

    /**
     * @param array<\FondOfOryx\Zed\SplittableCheckoutRestApiExtension\Dependency\Plugin\QuoteExpanderPluginInterface> $quoteExpanderPlugins
     */
    public function __construct(array $quoteExpanderPlugins)
    {
        $this->quoteExpanderPlugins = $quoteExpanderPlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expand(
        RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer,
        QuoteTransfer $quoteTransfer
    ): QuoteTransfer {
        foreach ($this->quoteExpanderPlugins as $quoteExpanderPlugin) {
            $quoteTransfer = $quoteExpanderPlugin->expand($restSplittableCheckoutRequestTransfer, $quoteTransfer);
        }

        return $quoteTransfer;
    }
}
