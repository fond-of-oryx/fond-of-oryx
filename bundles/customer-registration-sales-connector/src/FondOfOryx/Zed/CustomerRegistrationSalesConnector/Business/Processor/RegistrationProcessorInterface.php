<?php

namespace FondOfOryx\Zed\CustomerRegistrationSalesConnector\Business\Processor;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SaveOrderTransfer;

interface RegistrationProcessorInterface
{
    /**
     * @param \Generated\Shared\Transfer\SaveOrderTransfer $saveOrderTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\SaveOrderTransfer
     */
    public function processRegistration(SaveOrderTransfer $saveOrderTransfer, QuoteTransfer $quoteTransfer): SaveOrderTransfer;
}
