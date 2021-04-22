<?php

namespace FondOfOryx\Zed\SplittableTotals\Dependency\Facade;

use Generated\Shared\Transfer\QuoteResponseTransfer;
use Spryker\Zed\Quote\Business\QuoteFacadeInterface;

class SplittableTotalsToQuoteFacadeBridge implements SplittableTotalsToQuoteFacadeInterface
{
    /**
     * @var \Spryker\Zed\Quote\Business\QuoteFacadeInterface
     */
    protected $quoteFacade;

    /**
     * @param \Spryker\Zed\Quote\Business\QuoteFacadeInterface $quoteFacade
     */
    public function __construct(QuoteFacadeInterface $quoteFacade)
    {
        $this->quoteFacade = $quoteFacade;
    }

    /**
     * @param int $idQuote
     *
     * @return \Generated\Shared\Transfer\QuoteResponseTransfer
     */
    public function findQuoteById(int $idQuote): QuoteResponseTransfer
    {
        return $this->quoteFacade->findQuoteById($idQuote);
    }
}
