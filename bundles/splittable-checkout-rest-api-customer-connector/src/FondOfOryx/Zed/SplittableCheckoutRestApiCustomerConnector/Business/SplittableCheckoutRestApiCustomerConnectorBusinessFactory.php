<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiCustomerConnector\Business;

use FondOfOryx\Zed\SplittableCheckoutRestApiCustomerConnector\Business\Expander\QuoteExpander;
use FondOfOryx\Zed\SplittableCheckoutRestApiCustomerConnector\Business\Expander\QuoteExpanderInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class SplittableCheckoutRestApiCustomerConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\SplittableCheckoutRestApiCustomerConnector\Business\Expander\QuoteExpanderInterface
     */
    public function createQuoteExpander(): QuoteExpanderInterface
    {
        return new QuoteExpander(
            $this->getRepository()
        );
    }
}
