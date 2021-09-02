<?php

namespace FondOfOryx\Zed\AvailabilityCartDataExtender\Business;

use Generated\Shared\Transfer\CartChangeTransfer;
use Generated\Shared\Transfer\CartPreCheckResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\AvailabilityCartDataExtender\Business\AvailabilityCartDataExtenderBusinessFactory getFactory()
 */
class AvailabilityCartDataExtenderFacade extends AbstractFacade implements AvailabilityCartDataExtenderFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function addAvailabilityInformationOnQuoteItems(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        return $this->getFactory()->createCartCheckAvailability()->addAvailabilityInformationOnQuoteItems($quoteTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CartChangeTransfer $cartChangeTransfer
     *
     * @return \Generated\Shared\Transfer\CartPreCheckResponseTransfer
     */
    public function checkCartAvailability(CartChangeTransfer $cartChangeTransfer): CartPreCheckResponseTransfer
    {
        return $this->getFactory()->createCartCheckAvailability()->checkCartAvailability($cartChangeTransfer);
    }
}
