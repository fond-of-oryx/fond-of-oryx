<?php

namespace FondOfOryx\Zed\GiftCardRestriction\Business\DecisionRule;

use FondOfOryx\Zed\GiftCardRestriction\GiftCardRestrictionConfig;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\GiftCardTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class BlacklistedCountryDecisionRule implements DecisionRuleInterface
{
    /**
     * @var \FondOfOryx\Zed\GiftCardRestriction\GiftCardRestrictionConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Zed\GiftCardRestriction\GiftCardRestrictionConfig $config
     */
    public function __construct(GiftCardRestrictionConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\GiftCardTransfer $giftCardTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return bool
     */
    public function isSatisfiedBy(GiftCardTransfer $giftCardTransfer, QuoteTransfer $quoteTransfer): bool
    {
        if (count($this->config->getBlacklistedCountries()) === 0) {
            return true;
        }

        if (!method_exists(ItemTransfer::class, 'getShipment')) {
            return !$this->hasBlacklistedCountryOnQuoteLevel($quoteTransfer);
        }

        return !$this->hasBlacklistedCountryOnQuoteItemLevel($quoteTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return bool
     */
    protected function hasBlacklistedCountryOnQuoteLevel(QuoteTransfer $quoteTransfer): bool
    {
        $addressTransfer = $quoteTransfer->getShippingAddress();

        if ($addressTransfer === null) {
            return false;
        }

        return $this->hasBlacklistedCountry($addressTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return bool
     */
    protected function hasBlacklistedCountryOnQuoteItemLevel(QuoteTransfer $quoteTransfer): bool
    {
        foreach ($quoteTransfer->getItems() as $item) {
            $shipmentTransfer = $item->getShipment();

            if ($shipmentTransfer === null) {
                continue;
            }

            $addressTransfer = $shipmentTransfer->getShippingAddress();

            if ($addressTransfer !== null && $this->hasBlacklistedCountry($addressTransfer)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param \Generated\Shared\Transfer\AddressTransfer $addressTransfer
     *
     * @return bool
     */
    protected function hasBlacklistedCountry(AddressTransfer $addressTransfer): bool
    {
        $iso2Code = $addressTransfer->getIso2Code();
        $countryTransfer = $addressTransfer->getCountry();

        if ($countryTransfer !== null && $countryTransfer->getIso2Code() !== null) {
            $iso2Code = $countryTransfer->getIso2Code();
        }

        return $iso2Code !== null && in_array($iso2Code, $this->config->getBlacklistedCountries(), true);
    }
}
