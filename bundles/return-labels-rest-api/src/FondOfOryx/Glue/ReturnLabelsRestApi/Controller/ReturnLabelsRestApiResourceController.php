<?php

namespace FondOfOryx\Glue\ReturnLabelsRestApi\Controller;

use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\Controller\AbstractController;

/**
 * @package FondOfOryx\Glue\ReturnLabelsRestApi\Controller
 */
class ReturnLabelsRestApiResourceController extends AbstractController
{
    /**
     * @param RestRequestInterface $restRequest
     *
     * @return RestResponseInterface
     */
    public function postAction(RestRequestInterface $restRequest): RestResponseInterface
    {
        var_dump($restRequest->getRestUser()->getIdCompany());
        var_dump($restRequest->getRestUser()->getUuidCompanyUser());

        die();
    }
}
