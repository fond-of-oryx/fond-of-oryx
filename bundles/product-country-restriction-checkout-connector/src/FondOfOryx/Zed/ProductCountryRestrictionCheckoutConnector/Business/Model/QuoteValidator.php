<?php

namespace FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Business\Model;

use FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Dependency\Facade\ProductCountryRestrictionCheckoutConnectorToProductCountryRestrictionFacadeInterface;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\BlacklistedCountryTransfer;
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
     * @var \FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Dependency\Facade\ProductCountryRestrictionCheckoutConnectorToProductCountryRestrictionFacadeInterface
     */
    protected $productCountryRestrictionFacade;

    /**
     * @param \FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Dependency\Facade\ProductCountryRestrictionCheckoutConnectorToProductCountryRestrictionFacadeInterface $productCountryRestrictionFacade
     */
    public function __construct(
        ProductCountryRestrictionCheckoutConnectorToProductCountryRestrictionFacadeInterface $productCountryRestrictionFacade
    ) {
        $this->productCountryRestrictionFacade = $productCountryRestrictionFacade;
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

        $blackListedCountries = $this->getBlacklistedCountriesByQuote($quoteTransfer);

        if (count($blackListedCountries) === 0) {
            return $quoteValidationResponseTransfer;
        }

        foreach ($quoteTransfer->getItems() as $itemTransfer) {
            if (!$this->isItemRestricted($itemTransfer, $blackListedCountries)) {
                continue;
            }

            $quoteValidationResponseTransfer->setIsSuccessful(false)
                ->addMessage($this->createErrorMessage($itemTransfer, $blackListedCountries))
                ->addErrors($this->createQuoteError($itemTransfer, $blackListedCountries));

            $quoteTransfer->setShippingAddress(null)
                ->setBillingAddress(null);
        }

        return $quoteValidationResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\BlacklistedCountryTransfer
     */
    public function getBlacklistedCountries(QuoteTransfer $quoteTransfer): BlacklistedCountryTransfer
    {
        $blacklistedCountriesByQuote = $this->getBlacklistedCountriesByQuote($quoteTransfer);
        $iso2Codes = [];

        foreach ($blacklistedCountriesByQuote as $blacklistedIso2CodesBySku) {
            $iso2Codes = array_unique(array_merge($blacklistedIso2CodesBySku, $iso2Codes), SORT_REGULAR);
        }

        return (new BlacklistedCountryTransfer())->setIso2codes($iso2Codes);
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

        if (empty($blacklistedCountries[$sku]) || !is_array($blacklistedCountries[$sku])) {
            return false;
        }

        $shippingAddressTransfer = $this->getShippingAddressByItem($itemTransfer);

        if ($shippingAddressTransfer === null || $shippingAddressTransfer->getIso2Code() === null) {
            return false;
        }

        return in_array($shippingAddressTransfer->getIso2Code(), $blacklistedCountries[$sku], true);
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
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return array
     */
    protected function getBlacklistedCountriesByQuote(QuoteTransfer $quoteTransfer): array
    {
        $productConcreteSkus = array_map(static function (ItemTransfer $itemTransfer) {
            return $itemTransfer->getSku();
        }, $quoteTransfer->getItems()->getArrayCopy());

        return $this->productCountryRestrictionFacade->getBlacklistedCountriesByProductConcreteSkus(
            $productConcreteSkus,
        );
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

        if (isset($blacklistedCountries[$sku]) && is_array($blacklistedCountries[$sku])) {
            $blacklistedCountryCodeList = $blacklistedCountries[$sku];
        }

        $blacklistedCountryCodes = array_pop($blacklistedCountryCodeList);

        if (is_array($blacklistedCountryCodeList) && count($blacklistedCountryCodeList) > 0) {
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
