<?php

namespace FondOfOryx\Zed\SplittableCheckoutExtension\Dependency\Plugin;

use Generated\Shared\Transfer\QuoteTransfer;

interface IdentifierExtractorPluginInterface
{
    /**
     * Specification:
     * - Extract identifier from quote transfer for permission check
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return string|int|null
     */
    public function extract(QuoteTransfer $quoteTransfer);
}
