<?php

namespace FondOfOryx\Zed\CustomerProductListsRestApi\Communication\Plugin\ProductListsRestApiExtension;

use FondOfOryx\Zed\ProductListsRestApiExtension\Dependency\Plugin\ProductListPostUpdatePluginInterface;
use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CustomerProductListsRestApi\Business\CustomerProductListsRestApiFacadeInterface getFacade()
 */
class CustomerProductListPostUpdatePlugin extends AbstractPlugin implements ProductListPostUpdatePluginInterface
{
 /**
  * @param \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
  * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
  *
  * @return \Generated\Shared\Transfer\ProductListTransfer
  */
    public function postUpdate(
        RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer,
        ProductListTransfer $productListTransfer
    ): ProductListTransfer {
        $this->getFacade()->persistCustomerProductListRelation(
            $restProductListUpdateRequestTransfer,
            $productListTransfer,
        );

        return $productListTransfer;
    }
}
