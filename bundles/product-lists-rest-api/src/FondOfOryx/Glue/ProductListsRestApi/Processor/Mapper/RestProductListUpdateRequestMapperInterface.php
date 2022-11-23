<?php

namespace FondOfOryx\Glue\ProductListsRestApi\Processor\Mapper;

use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface RestProductListUpdateRequestMapperInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer
     */
    public function fromRestRequest(
        RestRequestInterface $restRequest
    ): RestProductListUpdateRequestTransfer;
}
