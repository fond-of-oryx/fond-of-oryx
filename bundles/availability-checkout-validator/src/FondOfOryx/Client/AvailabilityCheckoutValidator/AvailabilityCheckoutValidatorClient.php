<?php

namespace FondOfOryx\Client\AvailabilityCheckoutValidator;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\QuoteValidationResponseTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfOryx\Client\AvailabilityCheckoutValidator\AvailabilityCheckoutValidatorFactory getFactory()
 */
class AvailabilityCheckoutValidatorClient extends AbstractClient implements
    AvailabilityCheckoutValidatorClientInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteValidationResponseTransfer
     */
    public function validateQuote(QuoteTransfer $quoteTransfer): QuoteValidationResponseTransfer
    {
        return $this->getFactory()
            ->createAvailabilityCheckoutValidatorZedStub()
            ->validateQuote($quoteTransfer);
    }
}
