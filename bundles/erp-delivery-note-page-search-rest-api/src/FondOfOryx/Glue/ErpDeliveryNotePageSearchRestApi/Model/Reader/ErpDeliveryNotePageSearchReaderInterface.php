<?php

namespace FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Reader;

use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface ErpDeliveryNotePageSearchReaderInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function findErpDeliveryNotesByFilterTransfer(RestRequestInterface $restRequest): RestResponseInterface;
}
