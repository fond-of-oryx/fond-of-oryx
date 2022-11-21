<?php

namespace FondOfOryx\Zed\CustomerRegistrationSalesConnector\Business;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SaveOrderTransfer;

interface CustomerRegistrationSalesConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\SaveOrderTransfer $saveOrderTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\SaveOrderTransfer
     */
    public function createCustomerAccount(SaveOrderTransfer $saveOrderTransfer, QuoteTransfer $quoteTransfer): SaveOrderTransfer;
}
