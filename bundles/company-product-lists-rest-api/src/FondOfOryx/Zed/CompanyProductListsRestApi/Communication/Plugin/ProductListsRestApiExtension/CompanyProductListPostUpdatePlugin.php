<?php

namespace FondOfOryx\Zed\CompanyProductListsRestApi\Communication\Plugin\ProductListsRestApiExtension;

use FondOfOryx\Zed\ProductListsRestApiExtension\Dependency\Plugin\ProductListPostUpdatePluginInterface;
use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CompanyProductListsRestApi\Business\CompanyProductListsRestApiFacadeInterface getFacade()
 */
class CompanyProductListPostUpdatePlugin extends AbstractPlugin implements ProductListPostUpdatePluginInterface
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
        $this->getFacade()->persistCompanyProductListRelation(
            $restProductListUpdateRequestTransfer,
            $productListTransfer,
        );

        return $productListTransfer;
    }
}
