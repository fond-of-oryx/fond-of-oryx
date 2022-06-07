<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Controller;

use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\Controller\AbstractController;

/**
 * @method \FondOfOryx\Glue\CartSearchRestApi\CartSearchRestApiFactory getFactory()
 */
class CartSearchResourceController extends AbstractController
{
    /**
     * @Glue({
     *     "getCollection": {
     *          "summary": [
     *              "Cart search."
     *          ],
     *          "parameters": [
     *              {
     *                  "ref": "acceptLanguage"
     *              },
     *              {
     *                  "name": "q",
     *                  "in": "query",
     *                  "description": "Search query string.",
     *                  "required": true
     *              }
     *          ],
     *          "isIdNullable": true
     *     }
     * })
     *
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function getAction(RestRequestInterface $restRequest): RestResponseInterface
    {
        return $this->getFactory()->createCartReader()->find($restRequest);
    }
}
