<?php

namespace FondOfOryx\Zed\ProductListsRestApi\Business;

use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;
use Generated\Shared\Transfer\RestProductListUpdateResponseTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\ProductListsRestApi\Business\ProductListsRestApiBusinessFactory getFactory()
 */
class ProductListsRestApiFacade extends AbstractFacade implements ProductListsRestApiFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestProductListUpdateResponseTransfer
     */
    public function updateProductListByRestProductListUpdateRequest(
        RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
    ): RestProductListUpdateResponseTransfer {
        return $this->getFactory()->createProductListUpdater()->update($restProductListUpdateRequestTransfer);
    }
}
