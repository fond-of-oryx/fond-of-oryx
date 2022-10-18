<?php

namespace FondOfOryx\Zed\ProductListSearchRestApi\Communication\Controller;

use Generated\Shared\Transfer\ProductListCollectionTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \FondOfOryx\Zed\ProductListSearchRestApi\Business\ProductListSearchRestApiFacadeInterface getFacade()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\ProductListCollectionTransfer $productListCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListCollectionTransfer
     */
    public function searchProductListAction(
        ProductListCollectionTransfer $productListCollectionTransfer
    ): ProductListCollectionTransfer {
        return $this->getFacade()->findProductLists($productListCollectionTransfer);
    }
}
