<?php

namespace FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Business\Validator;

use FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Business\Reader\BlacklistedCountryReaderInterface;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\MessageTransfer;
use Generated\Shared\Transfer\QuoteErrorTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\QuoteValidationResponseTransfer;

class QuoteValidator implements QuoteValidatorInterface
{
    /**
     * @var string
     */
    protected const MESSAGE_ERROR_ITEM_IS_RESTRICTED = 'product_country_restriction_checkout_connector.error.item_is_restricted';

    /**
     * @var string
     */
    protected const MESSAGE_PARAM_SKU = '%sku%';

    /**
     * @var string
     */
    protected const MESSAGE_PARAM_BLACKLISTED_COUNTRY_CODES = '%blacklisted_country_codes%';

    /**
     * @var \Generated\Shared\Transfer\AddressTransfer
     */
    protected $cachedBillingAddressTransfer;

    /**
     * @var \FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Business\Reader\BlacklistedCountryReaderInterface
     */
    private $countryReader;

    /**
     * @param \FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Business\Reader\BlacklistedCountryReaderInterface $countryReader
     */
    public function __construct(BlacklistedCountryReaderInterface $countryReader)
    {
        $this->countryReader = $countryReader;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteValidationResponseTransfer
     */
    public function validate(QuoteTransfer $quoteTransfer): QuoteValidationResponseTransfer
    {
        $quoteValidationResponseTransfer = (new QuoteValidationResponseTransfer())
            ->setIsSuccessful(true);

        $blackListedCountries = $this->countryReader->getGroupedByQuote($quoteTransfer);

        if (!$blackListedCountries) {
            return $quoteValidationResponseTransfer;
        }

        $this->cachedBillingAddressTransfer = $quoteTransfer->getBillingAddress();

        foreach ($quoteTransfer->getItems() as $itemTransfer) {
            if (!$this->isItemRestricted($itemTransfer, $blackListedCountries)) {
                continue;
            }

            $quoteValidationResponseTransfer->setIsSuccessful(false)
                ->addMessage($this->createErrorMessage($itemTransfer, $blackListedCountries))
                ->addErrors($this->createQuoteError($itemTransfer, $blackListedCountries));
        }

        return $quoteValidationResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     * @param array $blacklistedCountries
     *
     * @return bool
     */
    protected function isItemRestricted(ItemTransfer $itemTransfer, array $blacklistedCountries): bool
    {
        $sku = $itemTransfer->getSku();

        if (!isset($blacklistedCountries[$sku]) || !is_array($blacklistedCountries[$sku])) {
            return false;
        }

        if (
            $this->cachedBillingAddressTransfer !== null
            && $this->hasAddressBlacklistedCountry($this->cachedBillingAddressTransfer, $blacklistedCountries[$sku])
        ) {
            return true;
        }

        $shippingAddressTransfer = $this->getShippingAddressByItem($itemTransfer);

        return $shippingAddressTransfer !== null
            && $this->hasAddressBlacklistedCountry($shippingAddressTransfer, $blacklistedCountries[$sku]);
    }

    /**
     * @param \Generated\Shared\Transfer\AddressTransfer $addressTransfer
     * @param array<string> $blacklistedCountries
     *
     * @return bool
     */
    protected function hasAddressBlacklistedCountry(
        AddressTransfer $addressTransfer,
        array $blacklistedCountries
    ): bool {
        if ($addressTransfer->getIso2Code() === null) {
            return false;
        }

        return in_array($addressTransfer->getIso2Code(), $blacklistedCountries, true);
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return \Generated\Shared\Transfer\AddressTransfer|null
     */
    protected function getShippingAddressByItem(ItemTransfer $itemTransfer): ?AddressTransfer
    {
        $shipmentTransfer = $itemTransfer->getShipment();

        if ($shipmentTransfer === null) {
            return null;
        }

        return $shipmentTransfer->getShippingAddress();
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     * @param array $blacklistedCountries
     *
     * @return \Generated\Shared\Transfer\MessageTransfer
     */
    protected function createErrorMessage(ItemTransfer $itemTransfer, array $blacklistedCountries): MessageTransfer
    {
        return (new MessageTransfer())
            ->setType('error')
            ->setValue(static::MESSAGE_ERROR_ITEM_IS_RESTRICTED)
            ->setParameters($this->createParameters($itemTransfer, $blacklistedCountries));
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     * @param array $blacklistedCountries
     *
     * @return \Generated\Shared\Transfer\QuoteErrorTransfer
     */
    protected function createQuoteError(ItemTransfer $itemTransfer, array $blacklistedCountries): QuoteErrorTransfer
    {
        return (new QuoteErrorTransfer())
            ->setMessage(static::MESSAGE_ERROR_ITEM_IS_RESTRICTED)
            ->setParameters($this->createParameters($itemTransfer, $blacklistedCountries));
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     * @param array $blacklistedCountries
     *
     * @return array
     */
    protected function createParameters(ItemTransfer $itemTransfer, array $blacklistedCountries): array
    {
        $sku = $itemTransfer->getSku();
        $blacklistedCountryCodeList = [];

        if (!empty($blacklistedCountries[$sku]) && is_array($blacklistedCountries[$sku])) {
            $blacklistedCountryCodeList = $blacklistedCountries[$sku];
        }

        $blacklistedCountryCodes = array_pop($blacklistedCountryCodeList);

        if ($blacklistedCountryCodeList) {
            $blacklistedCountryCodes = sprintf(
                '%s & %s',
                implode(', ', $blacklistedCountryCodeList),
                $blacklistedCountryCodes,
            );
        }

        return [
            static::MESSAGE_PARAM_SKU => $sku,
            static::MESSAGE_PARAM_BLACKLISTED_COUNTRY_CODES => $blacklistedCountryCodes ?? '',
        ];
    }
}
