<?php

namespace FondOfOryx\Glue\DocumentsRestApi\Processor\Mapper;

use Generated\Shared\Transfer\DocumentRestRequestTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface DocumentRestRequestMapperInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\DocumentRestRequestTransfer
     */
    public function fromRestRequest(RestRequestInterface $restRequest): DocumentRestRequestTransfer;
}
