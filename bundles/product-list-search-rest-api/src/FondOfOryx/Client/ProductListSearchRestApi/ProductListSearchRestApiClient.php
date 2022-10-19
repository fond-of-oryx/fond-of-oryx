<?php

namespace FondOfOryx\Client\ProductListSearchRestApi;

use Generated\Shared\Transfer\ProductListCollectionTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfOryx\Client\ProductListSearchRestApi\ProductListSearchRestApiFactory getFactory()
 */
class ProductListSearchRestApiClient extends AbstractClient implements ProductListSearchRestApiClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductListCollectionTransfer $productListCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListCollectionTransfer
     */
    public function searchProductList(
        ProductListCollectionTransfer $productListCollectionTransfer
    ): ProductListCollectionTransfer {
        return $this->getFactory()
            ->createZedProductListSearchRestApiStub()
            ->searchProductList($productListCollectionTransfer);
    }
}
