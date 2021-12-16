<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Processor;

use FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Reader\QuoteReaderInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToSplittableCheckoutFacadeInterface;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer;
use Generated\Shared\Transfer\SplittableCheckoutTransfer;

class PlaceOrderProcessor implements PlaceOrderProcessorInterface
{
    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Reader\QuoteReaderInterface
     */
    protected $quoteReader;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToSplittableCheckoutFacadeInterface
     */
    protected $splittabelCheckoutFacade;

    /**
     * @param \FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Reader\QuoteReaderInterface $quoteReader
     * @param \FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToSplittableCheckoutFacadeInterface $splittableCheckoutFacade
     */
    public function __construct(
        QuoteReaderInterface $quoteReader,
        SplittableCheckoutRestApiToSplittableCheckoutFacadeInterface $splittableCheckoutFacade
    ) {
        $this->quoteReader = $quoteReader;
        $this->splittabelCheckoutFacade = $splittableCheckoutFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer
     */
    public function placeOrder(
        RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer
    ): RestSplittableCheckoutResponseTransfer {
        $quoteTransfer = $this->quoteReader->getByRestSplittableCheckoutRequest($restSplittableCheckoutRequestTransfer);

        $restSplittableCheckoutResponseTransfer = (new RestSplittableCheckoutResponseTransfer())
            ->setIsSuccessful(false);

        if ($quoteTransfer === null) {
            return $restSplittableCheckoutResponseTransfer;
        }

        $splittabelCheckoutResponseTransfer = $this->splittabelCheckoutFacade->placeOrder($quoteTransfer);

        $splittedQuoteTransfers = $splittabelCheckoutResponseTransfer->getSplittedQuotes();

        if ($splittedQuoteTransfers->count() === 0 || $splittabelCheckoutResponseTransfer->getIsSuccess() === false) {
            return $restSplittableCheckoutResponseTransfer;
        }

        return $restSplittableCheckoutResponseTransfer->setIsSuccessful(true)
            ->setSplittableCheckout((new SplittableCheckoutTransfer())->setSplittedQuotes($splittedQuoteTransfers));
    }
}
