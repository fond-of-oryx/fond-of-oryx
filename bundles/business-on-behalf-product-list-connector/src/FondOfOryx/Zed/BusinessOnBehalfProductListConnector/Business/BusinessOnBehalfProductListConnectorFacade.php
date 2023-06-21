<?php

namespace FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business;

use Generated\Shared\Transfer\CartChangeTransfer;
use Generated\Shared\Transfer\CartPreCheckResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\BusinessOnBehalfProductListConnectorBusinessFactory getFactory()
 */
class BusinessOnBehalfProductListConnectorFacade extends AbstractFacade implements BusinessOnBehalfProductListConnectorFacadeInterface
{
 /**
  * @param \Generated\Shared\Transfer\CartChangeTransfer $cartChangeTransfer
  *
  * @return \Generated\Shared\Transfer\CartPreCheckResponseTransfer
  */
    public function validateItemAddProductListRestrictions(CartChangeTransfer $cartChangeTransfer): CartPreCheckResponseTransfer
    {
        return $this->getFactory()
            ->createProductListRestrictionValidator()
            ->validate($cartChangeTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function filterRestrictedItems(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        return $this->getFactory()
            ->createRestrictedItemsFilter()
            ->filter($quoteTransfer);
    }
}
