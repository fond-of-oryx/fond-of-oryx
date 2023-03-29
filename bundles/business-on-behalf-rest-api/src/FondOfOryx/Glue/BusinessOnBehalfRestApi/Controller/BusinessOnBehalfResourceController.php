<?php

namespace FondOfOryx\Glue\BusinessOnBehalfRestApi\Controller;

use Generated\Shared\Transfer\RestBusinessOnBehalfRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\Controller\AbstractController;

/**
 * @method \FondOfOryx\Glue\BusinessOnBehalfRestApi\BusinessOnBehalfRestApiFactory getFactory()
 */
class BusinessOnBehalfResourceController extends AbstractController
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestBusinessOnBehalfRequestAttributesTransfer $restBusinessOnBehalfRequestAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function postAction(
        RestRequestInterface $restRequest,
        RestBusinessOnBehalfRequestAttributesTransfer $restBusinessOnBehalfRequestAttributesTransfer
    ): RestResponseInterface {
        return $this->getFactory()
            ->createBusinessOnBehalfProcessor()
            ->setDefaultCompanyUser(
                $restRequest,
                $restBusinessOnBehalfRequestAttributesTransfer,
            );
    }
}
