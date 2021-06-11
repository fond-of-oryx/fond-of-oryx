<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiCartNoteConnector\Business;

use FondOfOryx\Zed\SplittableCheckoutRestApiCartNoteConnector\Business\Expander\QuoteExpander;
use FondOfOryx\Zed\SplittableCheckoutRestApiCartNoteConnector\Business\Expander\QuoteExpanderInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class SplittableCheckoutRestApiCartNoteConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\SplittableCheckoutRestApiCartNoteConnector\Business\Expander\QuoteExpanderInterface
     */
    public function createQuoteExpander(): QuoteExpanderInterface
    {
        return new QuoteExpander();
    }
}
