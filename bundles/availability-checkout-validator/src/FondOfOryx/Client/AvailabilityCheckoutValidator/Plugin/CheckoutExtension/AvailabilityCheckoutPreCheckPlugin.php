<?php

namespace FondOfOryx\Client\AvailabilityCheckoutValidator\Plugin\CheckoutExtension;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\QuoteValidationResponseTransfer;
use Spryker\Client\CheckoutExtension\Dependency\Plugin\CheckoutPreCheckPluginInterface;
use Spryker\Client\Kernel\AbstractPlugin;

/**
 * @method \FondOfOryx\Client\AvailabilityCheckoutValidator\AvailabilityCheckoutValidatorClientInterface getClient()
 */
class AvailabilityCheckoutPreCheckPlugin extends AbstractPlugin implements CheckoutPreCheckPluginInterface
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
    public function isValid(QuoteTransfer $quoteTransfer): QuoteValidationResponseTransfer
    {
        return $this->getClient()->validateQuote($quoteTransfer);
    }
}
