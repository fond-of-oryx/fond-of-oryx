<?php

namespace FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Controller;

use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\Controller\AbstractController;

/**
 * @method \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\ErpDeliveryNotePageSearchRestApiFactory getFactory()
 */
class ErpDeliveryNotePageSearchResourceController extends AbstractController
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function getAction(RestRequestInterface $restRequest): RestResponseInterface
    {
        return $this->getFactory()
            ->createErpDeliveryNoteReader()
            ->findErpDeliveryNotesByFilterTransfer($restRequest);
    }
}
