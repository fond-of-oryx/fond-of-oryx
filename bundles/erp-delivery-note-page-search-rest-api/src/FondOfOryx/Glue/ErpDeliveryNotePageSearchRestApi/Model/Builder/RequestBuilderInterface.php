<?php

namespace FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Builder;

use Generated\Shared\Transfer\ErpDeliveryNotePageSearchRequestTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface RequestBuilderInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNotePageSearchRequestTransfer
     */
    public function create(RestRequestInterface $restRequest): ErpDeliveryNotePageSearchRequestTransfer;
}
