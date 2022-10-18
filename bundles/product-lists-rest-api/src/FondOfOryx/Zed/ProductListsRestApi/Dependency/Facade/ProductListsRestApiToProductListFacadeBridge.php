<?php

namespace FondOfOryx\Zed\ProductListsRestApi\Dependency\Facade;

use Generated\Shared\Transfer\ProductListResponseTransfer;
use Generated\Shared\Transfer\ProductListTransfer;
use Spryker\Zed\ProductList\Business\ProductListFacadeInterface;

class ProductListsRestApiToProductListFacadeBridge implements ProductListsRestApiToProductListFacadeInterface
{
    /**
     * @var \Spryker\Zed\ProductList\Business\ProductListFacadeInterface
     */
    protected $productListFacade;

    /**
     * @param \Spryker\Zed\ProductList\Business\ProductListFacadeInterface $productListFacade
     */
    public function __construct(ProductListFacadeInterface $productListFacade)
    {
        $this->productListFacade = $productListFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListTransfer
     */
    public function getProductListById(ProductListTransfer $productListTransfer): ProductListTransfer
    {
        return $this->productListFacade->getProductListById($productListTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListResponseTransfer
     */
    public function updateProductList(ProductListTransfer $productListTransfer): ProductListResponseTransfer
    {
        return $this->productListFacade->updateProductList($productListTransfer);
    }
}
