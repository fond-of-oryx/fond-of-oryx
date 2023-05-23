<?php

namespace FondOfOryx\Glue\NotionProxyRestApi\Controller;

use Generated\Shared\Transfer\RestNotionProxyRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\Controller\AbstractController;

/**
 * @method \FondOfOryx\Glue\NotionProxyRestApi\NotionProxyRestApiFactory getFactory()
 */
class NotionProxyResourceController extends AbstractController
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestNotionProxyRequestAttributesTransfer $restNotionProxyRequestAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function postAction(
        RestRequestInterface $restRequest,
        RestNotionProxyRequestAttributesTransfer $restNotionProxyRequestAttributesTransfer
    ): RestResponseInterface {
        return $this->getFactory()
            ->createNotionProxyRequestCreator()
            ->create($restNotionProxyRequestAttributesTransfer, $restRequest);
    }
}
