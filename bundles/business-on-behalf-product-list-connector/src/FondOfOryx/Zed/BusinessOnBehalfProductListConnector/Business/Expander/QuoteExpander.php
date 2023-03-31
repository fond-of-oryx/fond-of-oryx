<?php

namespace FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Expander;

use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Reader\CustomerReaderInterface;
use Generated\Shared\Transfer\QuoteTransfer;

class QuoteExpander implements QuoteExpanderInterface
{
    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Reader\CustomerReaderInterface
     */
    protected CustomerReaderInterface $customerReader;

    /**
     * @param \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Reader\CustomerReaderInterface $customerReader
     */
    public function __construct(CustomerReaderInterface $customerReader)
    {
        $this->customerReader = $customerReader;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expand(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        $customerTransfer = $this->customerReader->getByQuote($quoteTransfer);

        if ($customerTransfer === null) {
            return $quoteTransfer;
        }

        return $quoteTransfer->setCustomer($customerTransfer)
            ->setCompanyUser($customerTransfer->getCompanyUserTransfer());
    }
}
