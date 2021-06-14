<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiOrderCustomReferenceConnector\Business;

use FondOfOryx\Zed\SplittableCheckoutRestApiOrderCustomReferenceConnector\Business\Expander\QuoteExpander;
use FondOfOryx\Zed\SplittableCheckoutRestApiOrderCustomReferenceConnector\Business\Expander\QuoteExpanderInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class SplittableCheckoutRestApiOrderCustomReferenceConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\SplittableCheckoutRestApiOrderCustomReferenceConnector\Business\Expander\QuoteExpanderInterface
     */
    public function createQuoteExpander(): QuoteExpanderInterface
    {
        return new QuoteExpander();
    }
}
