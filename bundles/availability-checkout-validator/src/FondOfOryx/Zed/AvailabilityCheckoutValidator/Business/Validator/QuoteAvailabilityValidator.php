<?php

namespace FondOfOryx\Zed\AvailabilityCheckoutValidator\Business\Validator;

use FondOfOryx\Zed\AvailabilityCheckoutValidator\Dependency\Facade\AvailabilityCheckoutValidatorToAvailabilityCartDataExtenderFacadeInterface;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteErrorTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\QuoteValidationResponseTransfer;

class QuoteAvailabilityValidator implements ValidatorInterface
{
    public const CHECKOUT_VALIDATION_AVAILABILITY_FAILED = 'checkout.validation.availability.failed';
    public const CHECKOUT_VALIDATION_AVAILABILITY_EMPTY = 'checkout.validation.availability.failed.empty';
    public const STOCK_TRANSLATION_PARAMETER = '%stock%';
    public const SKU_TRANSLATION_PARAMETER = '%sku%';
    public const NAME_TRANSLATION_PARAMETER = '%name%';

    /**
     * @var \FondOfOryx\Zed\AvailabilityCheckoutValidator\Dependency\Facade\AvailabilityCheckoutValidatorToAvailabilityCartDataExtenderFacadeInterface
     */
    protected $availabilityCartConnectorFacade;

    /**
     * @param \FondOfOryx\Zed\AvailabilityCheckoutValidator\Dependency\Facade\AvailabilityCheckoutValidatorToAvailabilityCartDataExtenderFacadeInterface $availabilityCartConnectorFacade
     */
    public function __construct(AvailabilityCheckoutValidatorToAvailabilityCartDataExtenderFacadeInterface $availabilityCartConnectorFacade)
    {
        $this->availabilityCartConnectorFacade = $availabilityCartConnectorFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteValidationResponseTransfer
     */
    public function validate(QuoteTransfer $quoteTransfer): QuoteValidationResponseTransfer
    {
        $responseTransfer = (new QuoteValidationResponseTransfer())->setIsSuccessful(true);
        $clonedQuote = $this->availabilityCartConnectorFacade->addAvailabilityInformationOnQuoteItems(clone $quoteTransfer);
        foreach ($clonedQuote->getItems() as $itemTransfer) {
            if ($itemTransfer->getAvailability() <= 0 || $itemTransfer->getIsBuyable() === false) {
                $responseTransfer
                    ->setIsSuccessful(false);
                $responseTransfer->addErrors($this->createError($itemTransfer));
            }
        }

        return $responseTransfer;
    }

    /**
     * @param int $availability
     *
     * @return string
     */
    protected function getTranslationKey(int $availability): string
    {
        $translationKey = static::CHECKOUT_VALIDATION_AVAILABILITY_FAILED;
        if ($availability <= 0) {
            $translationKey = static::CHECKOUT_VALIDATION_AVAILABILITY_EMPTY;
        }

        return $translationKey;
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteErrorTransfer
     */
    protected function createError(ItemTransfer $itemTransfer): QuoteErrorTransfer
    {
        $error = new QuoteErrorTransfer();
        $error
            ->setMessage($this->getTranslationKey($itemTransfer->getAvailability()))
            ->setParameters([
                static::STOCK_TRANSLATION_PARAMETER => $itemTransfer->getAvailability(),
                static::SKU_TRANSLATION_PARAMETER => $itemTransfer->getSku(),
                static::NAME_TRANSLATION_PARAMETER => $itemTransfer->getName(),
            ]);

        return $error;
    }
}
