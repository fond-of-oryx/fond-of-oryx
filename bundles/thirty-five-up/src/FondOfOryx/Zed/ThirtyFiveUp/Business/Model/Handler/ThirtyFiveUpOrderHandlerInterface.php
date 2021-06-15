<?php

namespace FondOfOryx\Zed\ThirtyFiveUp\Business\Model\Handler;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SaveOrderTransfer;
use Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer;

interface ThirtyFiveUpOrderHandlerInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function handleFromQuote(QuoteTransfer $quoteTransfer): QuoteTransfer;

    /**
     * @param \Generated\Shared\Transfer\SaveOrderTransfer $saveOrderTransfer
     * @param \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer $thirtyFiveUpOrderTransfer
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer
     */
    public function handleFromSavedOrder(SaveOrderTransfer $saveOrderTransfer, ThirtyFiveUpOrderTransfer $thirtyFiveUpOrderTransfer): ThirtyFiveUpOrderTransfer;
}
