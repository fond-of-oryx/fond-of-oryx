<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApi\Business\Reader;

use FondOfOryx\Zed\SplittableTotalsRestApi\Dependency\Facade\SplittableTotalsRestApiToSplittableTotalsFacadeInterface;
use Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer;

class SplittableTotalsReader implements SplittableTotalsReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApi\Business\Reader\QuoteReaderInterface
     */
    protected $quoteReader;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApi\Dependency\Facade\SplittableTotalsRestApiToSplittableTotalsFacadeInterface
     */
    protected $splittableTotalsFacade;

    /**
     * @param \FondOfOryx\Zed\SplittableTotalsRestApi\Business\Reader\QuoteReaderInterface $quoteReader
     * @param \FondOfOryx\Zed\SplittableTotalsRestApi\Dependency\Facade\SplittableTotalsRestApiToSplittableTotalsFacadeInterface $splittableTotalsFacade
     */
    public function __construct(
        QuoteReaderInterface $quoteReader,
        SplittableTotalsRestApiToSplittableTotalsFacadeInterface $splittableTotalsFacade
    ) {
        $this->quoteReader = $quoteReader;
        $this->splittableTotalsFacade = $splittableTotalsFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer
     */
    public function getByRestSplittableTotalsRequest(
        RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer
    ): RestSplittableTotalsResponseTransfer {
        $quoteTransfer = $this->quoteReader->getByRestSplittableTotalsRequest($restSplittableTotalsRequestTransfer);
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
