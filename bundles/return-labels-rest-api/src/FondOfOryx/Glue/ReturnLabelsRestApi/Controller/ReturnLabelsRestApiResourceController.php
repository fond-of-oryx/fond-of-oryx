<?php

namespace FondOfOryx\Glue\ReturnLabelsRestApi\Controller;

use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\Controller\AbstractController;

/**
 * @package FondOfOryx\Glue\ReturnLabelsRestApi\Controller
 * @method \FondOfOryx\Glue\ReturnLabelsRestApi\ReturnLabelsRestApiFactory getFactory()
 */
class ReturnLabelsRestApiResourceController extends AbstractController
{
    /**
     * @Glue({
     *     "getResourceById": {
     *          "path": "/return-labels/{company-unit-address-uuid}",
     *          "summary": [
     *              "Retrieves a company business unit address by customer and company-unit-address-uuid"
     *          ],
     *          "parameters": [{
     *              "ref": "acceptLanguage"
     *          }],
     *          "responses": {
     *              "404": "Address for customer not found.",
     *.             "422": "company-unit-address country not allowed for return-label"
     *          }
     *     }
     * })
     *
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function getAction(RestRequestInterface $restRequest): RestResponseInterface
    {
        return $this->getFactory()
            ->createReturnLabelProcessor()
            ->getReturnLabel($restRequest);
    }
}
