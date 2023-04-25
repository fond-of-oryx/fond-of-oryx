<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Controller;

use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\Controller\AbstractController;

/**
 * @method \FondOfOryx\Glue\RepresentativeCompanyUserRestApi\RepresentativeCompanyUserRestApiFactory getFactory()
 */
class RepresentativeCompanyUserResourceController extends AbstractController
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function addAction(RestRequestInterface $restRequest): RestResponseInterface
    {
        return $this->getFactory()->createRepresentationManager()->add($restRequest);
    }
}
