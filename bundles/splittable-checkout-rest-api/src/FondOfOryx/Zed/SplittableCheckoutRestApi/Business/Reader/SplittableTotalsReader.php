<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Reader;

use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToSplittableTotalsFacadeInterface;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer;

class SplittableTotalsReader implements SplittableTotalsReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Reader\QuoteReaderInterface
     */
    protected $quoteReader;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToSplittableTotalsFacadeInterface
     */
    protected $splittableTotalsFacade;

    /**
     * @param \FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Reader\QuoteReaderInterface $quoteReader
     * @param \FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToSplittableTotalsFacadeInterface $splittableTotalsFacade
     */
    public function __construct(
        QuoteReaderInterface $quoteReader,
        SplittableCheckoutRestApiToSplittableTotalsFacadeInterface $splittableTotalsFacade
    ) {
        $this->quoteReader = $quoteReader;
        $this->splittableTotalsFacade = $splittableTotalsFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer
     */
    public function getByRestSplittableCheckoutRequest(
        RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer
    ): RestSplittableTotalsResponseTransfer {
        $quoteTransfer = $this->quoteReader->getByRestSplittableCheckoutRequest($restSplittableCheckoutRequestTransfer);
        $restSplittableTotalsResponseTransfer = (new RestSplittableTotalsResponseTransfer())
            ->setIsSuccessful(false);

        if ($quoteTransfer === null) {
            return $restSplittableTotalsResponseTransfer;
        }

        $splittableTotalsTransfer = $this->splittableTotalsFacade->getSplittableTotalsByQuote($quoteTransfer);

        if ($splittableTotalsTransfer->getTotalsList()->count() === 0) {
            return $restSplittableTotalsResponseTransfer;
        }

        return $restSplittableTotalsResponseTransfer->setIsSuccessful(true)
            ->setSplittableTotals($splittableTotalsTransfer);
    }
}
