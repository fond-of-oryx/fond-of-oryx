<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiExtension\Dependency\Plugin;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer;

interface QuoteMapperPluginInterface
{
    /**
     * Specification:
     * - Maps rest splittable checkout request data to quote transfer.
     *
     * @api
     * 
     * @param \FondOfSpryker\Zed\SplittableCheckoutRestApiExtension\Dependency\Plugin\RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function map(
        RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer,
        QuoteTransfer $quoteTransfer
    ): QuoteTransfer;
}
