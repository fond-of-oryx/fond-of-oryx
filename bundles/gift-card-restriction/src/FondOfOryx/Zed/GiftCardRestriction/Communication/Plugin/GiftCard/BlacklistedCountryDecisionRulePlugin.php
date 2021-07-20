<?php

namespace FondOfOryx\Zed\GiftCardRestriction\Communication\Plugin\GiftCard;

use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\GiftCardTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\GiftCard\Dependency\Plugin\GiftCardDecisionRulePluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\GiftCardRestriction\GiftCardRestrictionConfig getConfig()
 */
class BlacklistedCountryDecisionRulePlugin extends AbstractPlugin implements GiftCardDecisionRulePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\GiftCardTransfer $giftCardTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return bool
     */
    public function isApplicable(GiftCardTransfer $giftCardTransfer, QuoteTransfer $quoteTransfer): bool
    {
        if (count($this->getConfig()->getBlacklistedCountries()) === 0) {
            return true;
        }

        if (!method_exists(ItemTransfer::class, 'getShipment')) {
            return $this->isApplicableOnQuoteLevel($quoteTransfer);
        }

        return $this->isApplicableOnQuoteItemLevel($quoteTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return bool
     */
    protected function isApplicableOnQuoteLevel(QuoteTransfer $quoteTransfer): bool
    {
        $addressTransfer = $quoteTransfer->getShippingAddress();

        if ($addressTransfer === null) {
            return true;
        }

        return !$this->hasBlacklistedCountry($addressTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return bool
     */
    protected function isApplicableOnQuoteItemLevel(QuoteTransfer $quoteTransfer): bool
    {
        foreach ($quoteTransfer->getItems() as $item) {
            $shipmentTransfer = $item->getShipment();

            if ($shipmentTransfer === null) {
                continue;
            }

            $addressTransfer = $shipmentTransfer->getShippingAddress();

            if ($addressTransfer !== null && $this->hasBlacklistedCountry($addressTransfer)) {
                return false;
            }
        }

        return true;
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

        return $iso2Code !== null && in_array($iso2Code, $this->getConfig()->getBlacklistedCountries());
    }
}
