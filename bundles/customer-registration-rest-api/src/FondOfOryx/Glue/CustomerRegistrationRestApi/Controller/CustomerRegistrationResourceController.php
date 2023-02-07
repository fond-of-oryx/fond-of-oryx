<?php

namespace FondOfOryx\Glue\CustomerRegistrationRestApi\Controller;

use Generated\Shared\Transfer\RestCustomerRegistrationRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\Controller\AbstractController;

/**
 * @method \FondOfOryx\Glue\CustomerRegistrationRestApi\CustomerRegistrationRestApiFactory getFactory()
 */
class CustomerRegistrationResourceController extends AbstractController
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestCustomerRegistrationRequestAttributesTransfer $restCustomerRegistrationRequestAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function postAction(
        RestRequestInterface $restRequest,
        RestCustomerRegistrationRequestAttributesTransfer $restCustomerRegistrationRequestAttributesTransfer
    ): RestResponseInterface {
        return $this->getFactory()
            ->createCustomerRegistrationProcessor()
            ->register($restRequest, $restCustomerRegistrationRequestAttributesTransfer);
    }
}
