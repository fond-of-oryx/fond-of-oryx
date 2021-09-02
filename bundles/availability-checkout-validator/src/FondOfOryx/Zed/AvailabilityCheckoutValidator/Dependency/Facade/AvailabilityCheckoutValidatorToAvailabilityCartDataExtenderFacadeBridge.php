<?php

namespace FondOfOryx\Zed\AvailabilityCheckoutValidator\Dependency\Facade;

use FondOfOryx\Zed\AvailabilityCartDataExtender\Business\AvailabilityCartDataExtenderFacadeInterface;
use Generated\Shared\Transfer\QuoteTransfer;

class AvailabilityCheckoutValidatorToAvailabilityCartDataExtenderFacadeBridge implements AvailabilityCheckoutValidatorToAvailabilityCartDataExtenderFacadeInterface
{
    /**
     * @var \FondOfOryx\Zed\AvailabilityCartDataExtender\Business\AvailabilityCartDataExtenderFacadeInterface
     */
    protected $facade;

    /**
     * @param \FondOfOryx\Zed\AvailabilityCartDataExtender\Business\AvailabilityCartDataExtenderFacadeInterface $availabilityCartConnectorFacade
     */
    public function __construct(AvailabilityCartDataExtenderFacadeInterface $availabilityCartConnectorFacade)
    {
        $this->facade = $availabilityCartConnectorFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function addAvailabilityInformationOnQuoteItems(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        return $this->facade->addAvailabilityInformationOnQuoteItems($quoteTransfer);
    }
}
