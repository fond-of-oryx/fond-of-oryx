<?php

namespace FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\ProductListCollectionTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface ProductListCollectionMapperInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\ProductListCollectionTransfer
     */
    public function fromRestRequest(RestRequestInterface $restRequest): ProductListCollectionTransfer;
}
