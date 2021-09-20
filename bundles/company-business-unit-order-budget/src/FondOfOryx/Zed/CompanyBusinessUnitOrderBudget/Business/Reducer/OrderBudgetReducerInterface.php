<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Reducer;

use Generated\Shared\Transfer\QuoteTransfer;

interface OrderBudgetReducerInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return void
     */
    public function reduceByQuote(QuoteTransfer $quoteTransfer): void;
}
