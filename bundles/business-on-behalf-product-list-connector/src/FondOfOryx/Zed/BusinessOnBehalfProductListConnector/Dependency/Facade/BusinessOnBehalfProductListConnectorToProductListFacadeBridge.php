<?php

namespace FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Dependency\Facade;

use Generated\Shared\Transfer\CartChangeTransfer;
use Generated\Shared\Transfer\CartPreCheckResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\ProductList\Business\ProductListFacadeInterface;

class BusinessOnBehalfProductListConnectorToProductListFacadeBridge implements BusinessOnBehalfProductListConnectorToProductListFacadeInterface
{
    /**
     * @var \Spryker\Zed\ProductList\Business\ProductListFacadeInterface
     */
    protected ProductListFacadeInterface $productListFacade;

    /**
     * @param \Spryker\Zed\ProductList\Business\ProductListFacadeInterface $productListFacade
     */
    public function __construct(ProductListFacadeInterface $productListFacade)
    {
        $this->productListFacade = $productListFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CartChangeTransfer $cartChangeTransfer
     *
     * @return \Generated\Shared\Transfer\CartPreCheckResponseTransfer
     */
    public function validateItemAddProductListRestrictions(
        CartChangeTransfer $cartChangeTransfer
    ): CartPreCheckResponseTransfer {
        return $this->productListFacade->validateItemAddProductListRestrictions($cartChangeTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function filterRestrictedItems(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        return $this->productListFacade->filterRestrictedItems($quoteTransfer);
    }
}
