<?php

namespace FondOfOryx\Client\AvailabilityCheckoutValidator\Zed;

use FondOfOryx\Client\AvailabilityCheckoutValidator\Dependency\Client\AvailabilityCheckoutValidatorToZedRequestClientInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\QuoteValidationResponseTransfer;

class AvailabilityCheckoutValidatorStub implements AvailabilityCheckoutValidatorStubInterface
{
    /**
     * @var \FondOfOryx\Client\AvailabilityCheckoutValidator\Dependency\Client\AvailabilityCheckoutValidatorToZedRequestClientInterface
     */
    protected $zedRequestClient;

    /**
     * @param \FondOfOryx\Client\AvailabilityCheckoutValidator\Dependency\Client\AvailabilityCheckoutValidatorToZedRequestClientInterface $zedRequestClient
     */
    public function __construct(AvailabilityCheckoutValidatorToZedRequestClientInterface $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteValidationResponseTransfer
     */
    public function validateQuote(QuoteTransfer $quoteTransfer): QuoteValidationResponseTransfer
    {
        /** @var \Generated\Shared\Transfer\QuoteValidationResponseTransfer $quoteValidationResponseTransfer */
        $quoteValidationResponseTransfer = $this->zedRequestClient->call(
            '/availability-checkout-validator/gateway/validate-quote',
            $quoteTransfer,
        );

        return $quoteValidationResponseTransfer;
    }
}
