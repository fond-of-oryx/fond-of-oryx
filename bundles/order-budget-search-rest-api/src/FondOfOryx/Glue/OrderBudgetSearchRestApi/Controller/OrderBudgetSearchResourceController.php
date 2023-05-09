<?php

namespace FondOfOryx\Glue\OrderBudgetSearchRestApi\Controller;

use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\Controller\AbstractController;

/**
 * @method \FondOfOryx\Glue\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiFactory getFactory()
 */
class OrderBudgetSearchResourceController extends AbstractController
{
    /**
     * @Glue({
     *     "getCollection": {
     *          "summary": [
     *              "Order budget search."
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
        return $this->getFactory()->createOrderBudgetReader()->find($restRequest);
    }
}
