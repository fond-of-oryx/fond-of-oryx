<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Controller;

use Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\Controller\AbstractController;

/**
 * @method \FondOfOryx\Glue\SplittableCheckoutRestApi\SplittableCheckoutRestApiFactory getFactory()
 */
class SplittableTotalsResourceController extends AbstractController
{
    /**
     * @Glue({
     *     "post": {
     *          "summary": [
     *              "Provides splittable totals data"
     *          ],
     *          "parameters": [
     *              {
     *                  "ref": "acceptLanguage"
     *              }
     *          ],
     *          "responses": {
     *              "201": "Expected response to a valid request.",
     *              "400": "Bad Request.",
     *              "422": "Unprocessable entity."
     *          },
     *          "responseAttributesClassName": "\\Generated\\Shared\\Transfer\\RestSplittableTotalsTransfer",
     *          "isIdNullable": true
     *     }
     * })
     *
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function postAction(
        RestRequestInterface $restRequest,
        RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
    ): RestResponseInterface {
        return $this->getFactory()
            ->createSplittableTotalsReader()
            ->get($restRequest, $restSplittableCheckoutRequestAttributesTransfer);
    }
}
