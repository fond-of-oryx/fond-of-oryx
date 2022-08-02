<?php

namespace FondOfOryx\Client\ProductCountryRestrictionCheckoutConnector;

use Generated\Shared\Transfer\BlacklistedCountryCollectionTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\QuoteValidationResponseTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfOryx\Client\ProductCountryRestrictionCheckoutConnector\ProductCountryRestrictionCheckoutConnectorFactory getFactory()
 */
class ProductCountryRestrictionCheckoutConnectorClient extends AbstractClient implements
    ProductCountryRestrictionCheckoutConnectorClientInterface
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
            ->createProductCountryRestrictionCheckoutConnectorZedStub()
            ->validateQuote($quoteTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\BlacklistedCountryCollectionTransfer
     */
    public function getBlacklistedCountryCollectionByQuote(QuoteTransfer $quoteTransfer): BlacklistedCountryCollectionTransfer
    {
        return $this->getFactory()
            ->createProductCountryRestrictionCheckoutConnectorZedStub()
            ->getBlacklistedCountryCollectionByQuote($quoteTransfer);
    }
}
