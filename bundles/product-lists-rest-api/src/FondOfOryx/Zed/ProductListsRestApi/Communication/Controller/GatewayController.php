<?php

namespace FondOfOryx\Zed\ProductListsRestApi\Communication\Controller;

use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;
use Generated\Shared\Transfer\RestProductListUpdateResponseTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \FondOfOryx\Zed\ProductListsRestApi\Business\ProductListsRestApiFacadeInterface getFacade()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestProductListUpdateResponseTransfer
     */
    public function updateProductListByRestProductListUpdateRequestAction(
        RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
    ): RestProductListUpdateResponseTransfer {
        return $this->getFacade()->updateProductListByRestProductListUpdateRequest(
            $restProductListUpdateRequestTransfer,
        );
    }
}
