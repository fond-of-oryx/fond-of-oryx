<?php

namespace FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Business\Reader;

use FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Dependency\Facade\ProductCountryRestrictionCheckoutConnectorToProductCountryRestrictionFacadeInterface;
use Generated\Shared\Transfer\BlacklistedCountryCollectionTransfer;
use Generated\Shared\Transfer\BlacklistedCountryTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class BlacklistedCountryReader implements BlacklistedCountryReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Dependency\Facade\ProductCountryRestrictionCheckoutConnectorToProductCountryRestrictionFacadeInterface
     */
    private $productCountryRestrictionFacade;

    /**
     * @param \FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Dependency\Facade\ProductCountryRestrictionCheckoutConnectorToProductCountryRestrictionFacadeInterface $productCountryRestrictionFacade
     */
    public function __construct(ProductCountryRestrictionCheckoutConnectorToProductCountryRestrictionFacadeInterface $productCountryRestrictionFacade)
    {
        $this->productCountryRestrictionFacade = $productCountryRestrictionFacade;
    }

    /**
     * {@inheritDoc}
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\BlacklistedCountryCollectionTransfer
     */
    public function getByQuote(QuoteTransfer $quoteTransfer): BlacklistedCountryCollectionTransfer
    {
        $blacklistedCountryCollectionTransfer = new BlacklistedCountryCollectionTransfer();
        $iso2Codes = [];
        $blacklistedCountriesByQuote = $this->getGroupedByQuote($quoteTransfer);

        foreach ($blacklistedCountriesByQuote as $blacklistedIso2CodesBySku) {
            $iso2Codes = array_unique(array_merge($blacklistedIso2CodesBySku, $iso2Codes), SORT_REGULAR);
        }

        foreach ($iso2Codes as $iso2Code) {
            $blacklistedCountryTransfer = (new BlacklistedCountryTransfer())
                ->setIso2code($iso2Code);

            $blacklistedCountryCollectionTransfer->addBlacklistedCountry($blacklistedCountryTransfer);
        }

        return $blacklistedCountryCollectionTransfer;
    }

    /**
     * {@inheritDoc}
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return array
     */
    public function getGroupedByQuote(QuoteTransfer $quoteTransfer): array
    {
        $productConcreteSkus = array_map(static function (ItemTransfer $itemTransfer) {
            return $itemTransfer->getSku();
        }, $quoteTransfer->getItems()->getArrayCopy());

        return $this->productCountryRestrictionFacade->getBlacklistedCountriesByProductConcreteSkus(
            $productConcreteSkus,
        );
    }
}
