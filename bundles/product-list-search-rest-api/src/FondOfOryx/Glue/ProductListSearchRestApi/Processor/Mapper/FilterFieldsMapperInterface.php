<?php

namespace FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper;

use ArrayObject;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface FilterFieldsMapperInterface
{
     /**
      * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
      *
      * @return \ArrayObject<\Generated\Shared\Transfer\FilterFieldTransfer>
      */
    public function fromRestRequest(RestRequestInterface $restRequest): ArrayObject;
}
