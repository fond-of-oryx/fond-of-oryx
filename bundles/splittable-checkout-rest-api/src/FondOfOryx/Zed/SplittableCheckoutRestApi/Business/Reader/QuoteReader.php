<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Reader;

use FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Expander\QuoteExpanderInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToQuoteFacadeInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;

class QuoteReader implements QuoteReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Expander\QuoteExpanderInterface
     */
    protected $quoteExpander;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToQuoteFacadeInterface
     */
    protected $quoteFacade;

    /**
     * @param \FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Expander\QuoteExpanderInterface $quoteExpander
     * @param \FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToQuoteFacadeInterface $quoteFacade
     */
    public function __construct(
        QuoteExpanderInterface $quoteExpander,
        SplittableCheckoutRestApiToQuoteFacadeInterface $quoteFacade
    ) {
        $this->quoteExpander = $quoteExpander;
        $this->quoteFacade = $quoteFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer|null
     */
    public function getByRestSplittableCheckoutRequest(
        RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer
    ): ?QuoteTransfer {
        $uuid = $restSplittableCheckoutRequestTransfer->getIdCart();
        $customerReference = $restSplittableCheckoutRequestTransfer->getCustomerReference();

        if ($uuid === null || $customerReference === null) {
            return null;
        }

        $quoteResponseTransfer = $this->quoteFacade->findQuoteByUuid((new QuoteTransfer())->setUuid($uuid));
        $quoteTransfer = $quoteResponseTransfer->getQuoteTransfer();

        if ($quoteTransfer === null || !$quoteResponseTransfer->getIsSuccessful()) {
            return null;
        }

        if ($quoteTransfer->getCustomerReference() !== $customerReference) {
            return null;
        }

        return $this->quoteExpander->expand($restSplittableCheckoutRequestTransfer, $quoteTransfer);
    }
}
