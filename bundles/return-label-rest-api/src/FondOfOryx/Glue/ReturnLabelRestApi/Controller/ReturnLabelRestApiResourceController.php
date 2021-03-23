<?php

namespace FondOfOryx\Glue\ReturnLabelRestApi\Controller;

use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\Controller\AbstractController;

/**
 * @package FondOfOryx\Glue\ReturnLabelRestApi\Controller
 */
class ReturnLabelRestApiResourceController extends AbstractController
{
    /**
     * @param RestRequestInterface $restRequest
     *
     * @return RestResponseInterface
     */
    public function postAction(RestRequestInterface $restRequest): RestResponseInterface
    {
        var_dump($restRequest);

        die();
    }
}
