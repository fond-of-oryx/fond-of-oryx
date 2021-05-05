<?php

namespace FondOfOryx\Glue\SplittableTotalsRestApi\Controller;

use Generated\Shared\Transfer\RestSplittableTotalsRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\Controller\AbstractController;

/**
 * @method \FondOfOryx\Glue\SplittableTotalsRestApi\SplittableTotalsRestApiFactory getFactory()
 */
class SplittableTotalsResourceController extends AbstractController
{
    /**
     * @Glue({
     *     "post": {
     *          "summary": [
     *              "Provides splittable totals data",
     *              " - available addresses",
     *              " - shipment methods",
     *              " - payment methods"
     *          ],
     *          "parameters": [
     *              {
     *                  "ref": "acceptLanguage"
     *              }
     *          ],
     *          "responses": {
     *              "200": "Expected response to a valid request.",
     *              "404": "Not Found.",
     *          },
     *          "responseAttributesClassName": "\\Generated\\Shared\\Transfer\\RestSplittableTotalsTransfer",
     *          "isIdNullable": true
     *     }
     * })
     *
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestSplittableTotalsRequestAttributesTransfer $restSplittableTotalsRequestAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function postAction(
        RestRequestInterface $restRequest,
        RestSplittableTotalsRequestAttributesTransfer $restSplittableTotalsRequestAttributesTransfer
    ): RestResponseInterface {
        return $this->getFactory()
            ->createRestSplittableTotalsReader()
            ->get($restRequest, $restSplittableTotalsRequestAttributesTransfer);
    }
}
