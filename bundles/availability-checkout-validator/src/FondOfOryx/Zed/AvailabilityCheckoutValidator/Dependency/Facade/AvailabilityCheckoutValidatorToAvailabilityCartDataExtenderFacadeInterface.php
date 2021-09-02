<?php

namespace FondOfOryx\Zed\AvailabilityCheckoutValidator\Dependency\Facade;

use Generated\Shared\Transfer\QuoteTransfer;

interface AvailabilityCheckoutValidatorToAvailabilityCartDataExtenderFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function addAvailabilityInformationOnQuoteItems(QuoteTransfer $quoteTransfer): QuoteTransfer;
}
