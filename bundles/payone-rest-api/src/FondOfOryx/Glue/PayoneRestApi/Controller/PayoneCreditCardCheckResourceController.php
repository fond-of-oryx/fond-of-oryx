<?php

namespace FondOfOryx\Glue\PayoneRestApi\Controller;

use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\Controller\AbstractController;

/**
 * @method \FondOfOryx\Glue\PayoneRestApi\PayoneRestApiFactory getFactory()
 */
class PayoneCreditCardCheckResourceController extends AbstractController
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function getAction(
        RestRequestInterface $restRequest
    ): RestResponseInterface
    {
        return $this->getFactory()
            ->createCreditCardCheckProcessor()
            ->getCheckCreditCardData($restRequest);
    }

}
