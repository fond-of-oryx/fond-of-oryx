<?php

namespace FondOfOryx\Client\ProductListsRestApi;

use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;
use Generated\Shared\Transfer\RestProductListUpdateResponseTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfOryx\Client\ProductListsRestApi\ProductListsRestApiFactory getFactory()
 */
class ProductListsRestApiClient extends AbstractClient implements ProductListsRestApiClientInterface
{
 /**
  * @param \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
  *
  * @return \Generated\Shared\Transfer\RestProductListUpdateResponseTransfer
  */
    public function updateProductListByRestProductListUpdateRequest(
        RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
    ): RestProductListUpdateResponseTransfer {
        return $this->getFactory()
            ->createProductListsRestApiStub()
            ->updateProductListByRestProductListUpdateRequest(
                $restProductListUpdateRequestTransfer,
            );
    }
}
