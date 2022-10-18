<?php

namespace FondOfOryx\Zed\ProductListSearchRestApi\Business;

use Generated\Shared\Transfer\ProductListCollectionTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\ProductListSearchRestApi\Business\ProductListSearchRestApiBusinessFactory getFactory()
 */
class ProductListSearchRestApiFacade extends AbstractFacade implements ProductListSearchRestApiFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductListCollectionTransfer $productListCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListCollectionTransfer
     */
    public function findProductList(
        ProductListCollectionTransfer $productListCollectionTransfer
    ): ProductListCollectionTransfer {
        return $this->getFactory()
            ->createProductListReader()
            ->findProductList($productListCollectionTransfer);
    }
}
