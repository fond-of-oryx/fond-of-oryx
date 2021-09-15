<?php

namespace FondOfOryx\Glue\OneTimePasswordRestApi\Controller;

use Generated\Shared\Transfer\RestOneTimePasswordLoginLinkRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\Controller\AbstractController;

/**
 * @method \FondOfOryx\Glue\OneTimePasswordRestApi\OneTimePasswordRestApiFactory getFactory()
 */
class OneTimePasswordLoginLinkResourceController extends AbstractController
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestOneTimePasswordLoginLinkRequestAttributesTransfer $oneTimePasswordRequestLoginLinkTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function postAction(
        RestRequestInterface $restRequest,
        RestOneTimePasswordLoginLinkRequestAttributesTransfer $oneTimePasswordRequestLoginLinkTransfer
    ): RestResponseInterface {
        return $this->getFactory()
            ->createOneTimePasswordLoginLinkProcessor()
            ->requestOneTimePasswordEmail($restRequest, $oneTimePasswordRequestLoginLinkTransfer);
    }
}
