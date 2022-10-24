<?php

namespace FondOfOryx\Glue\ProductListsRestApi\Controller;

use Generated\Shared\Transfer\RestProductListsAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\Controller\AbstractController;

/**
 * @method \FondOfOryx\Glue\ProductListsRestApi\ProductListsRestApiFactory getFactory()
 */
class ProductListsResourceController extends AbstractController
{
    /**
     * @Glue({
     *     "patch": {
     *          "summary": [
     *              "Updates product list."
     *          ],
     *          "parameters": [{
     *              "ref": "acceptLanguage"
     *          }],
     *          "responses": {
     *              "422": "Unprocessable entity."
     *          }
     *     }
     * })
     *
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestProductListsAttributesTransfer $restProductListsAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function patchAction(
        RestRequestInterface $restRequest,
        RestProductListsAttributesTransfer $restProductListsAttributesTransfer
    ): RestResponseInterface {
        return $this->getFactory()
            ->createProductListUpdater()
            ->update(
                $restRequest,
                $restProductListsAttributesTransfer,
            );
    }
}
