<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Controller;

use Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\Controller\AbstractController;

/**
 * @method \FondOfOryx\Glue\SplittableCheckoutRestApi\SplittableCheckoutRestApiFactory getFactory()
 */
class SplittableCheckoutResourceController extends AbstractController
{
    /**
     * @Glue({
     *     "post": {
     *          "summary": [
     *              "Places orders and split by delivery date."
     *          ],
     *          "parameters": [
     *              {
     *                  "name": "Accept-Language",
     *                  "in": "header"
     *              },
     *              {
     *                  "name": "X-Anonymous-Customer-Unique-Id",
     *                  "in": "header",
     *                  "required": false,
     *                  "description": "Guest customer unique ID"
     *              }
     *          ],
     *          "responses": {
     *              "400": "Bad Response.",
     *              "422": "Unprocessable entity."
     *          },
     *          "responseAttributesClassName": "\\Generated\\Shared\\Transfer\\RestCheckoutResponseAttributesTransfer",
     *          "isIdNullable": true
     *     }
     * })
     *
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer $restCheckoutRequestAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function postAction(
        RestRequestInterface $restRequest,
        RestSplittableCheckoutRequestAttributesTransfer $restCheckoutRequestAttributesTransfer
    ): RestResponseInterface {

        return $this->getFactory()
            ->createSplittableCheckoutProcessor()
            ->placeOrder($restRequest, $restCheckoutRequestAttributesTransfer);
    }
}
