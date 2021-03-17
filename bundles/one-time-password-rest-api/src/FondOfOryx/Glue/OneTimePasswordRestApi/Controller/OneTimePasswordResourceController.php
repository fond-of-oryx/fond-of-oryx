<?php

namespace FondOfOryx\Glue\OneTimePasswordRestApi\Controller;

use Generated\Shared\Transfer\RestOneTimePasswordRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\Controller\AbstractController;

/**
 * @method \FondOfOryx\Glue\OneTimePasswordRestApi\OneTimePasswordRestApiFactory getFactory()
 */
class OneTimePasswordResourceController extends AbstractController
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestOneTimePasswordRequestAttributesTransfer $restOneTimePasswordRequestAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function postAction(
        RestRequestInterface $restRequest,
        RestOneTimePasswordRequestAttributesTransfer $restOneTimePasswordRequestAttributesTransfer
    ): RestResponseInterface {
        return $this->getFactory()
            ->createOneTimePasswordProcessor()
            ->requestOneTimePasswordEmail($restRequest, $restOneTimePasswordRequestAttributesTransfer);
    }
}
