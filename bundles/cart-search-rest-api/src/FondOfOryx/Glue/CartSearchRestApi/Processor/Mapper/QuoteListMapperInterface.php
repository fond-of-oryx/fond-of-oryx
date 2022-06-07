<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\QuoteListTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface QuoteListMapperInterface
{
     /**
      * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
      *
      * @return \Generated\Shared\Transfer\QuoteListTransfer
      */
    public function fromRestRequest(RestRequestInterface $restRequest): QuoteListTransfer;
}
