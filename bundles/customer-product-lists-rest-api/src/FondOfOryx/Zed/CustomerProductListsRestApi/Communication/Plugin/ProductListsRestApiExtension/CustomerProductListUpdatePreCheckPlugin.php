<?php

namespace FondOfOryx\Zed\CustomerProductListsRestApi\Communication\Plugin\ProductListsRestApiExtension;

use FondOfOryx\Zed\ProductListsRestApiExtension\Dependency\Plugin\ProductListUpdatePreCheckPluginInterface;
use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CustomerProductListsRestApi\Persistence\CustomerProductListsRestApiRepositoryInterface getRepository()
 */
class CustomerProductListUpdatePreCheckPlugin extends AbstractPlugin implements ProductListUpdatePreCheckPluginInterface
{
     /**
      * @param \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
      * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
      *
      * @return bool
      */
    public function preCheck(
        RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer,
        ProductListTransfer $productListTransfer
    ): bool {
        $idProductList = $productListTransfer->getIdProductList();
        $idCustomer = $restProductListUpdateRequestTransfer->getIdCustomer();

        if ($idProductList === null || $idCustomer === null) {
            return false;
        }

        return $this->getRepository()->hasProductListByIdProductListAndIdCustomer($idProductList, $idCustomer);
    }
}
