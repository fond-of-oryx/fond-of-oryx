<?php

namespace FondOfOryx\Zed\AvailabilityCartDataExtender\Communication\Plugin;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\CartExtension\Dependency\Plugin\QuoteChangeObserverPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\AvailabilityCartDataExtender\Business\AvailabilityCartDataExtenderFacadeInterface getFacade()
 */
class AddAvailabilityDataToQuoteItemQuoteChangeObserverPlugin extends AbstractPlugin implements QuoteChangeObserverPluginInterface
{
    /**
     * {@inheritDoc}
     * Specification:
     * - Checks cart changes on cart validate.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $resultQuoteTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $sourceQuoteTransfer
     *
     * @return void
     */
    public function checkChanges(QuoteTransfer $resultQuoteTransfer, QuoteTransfer $sourceQuoteTransfer): void
    {
        $this->getFacade()->addAvailabilityInformationOnQuoteItems($resultQuoteTransfer);
    }
}
