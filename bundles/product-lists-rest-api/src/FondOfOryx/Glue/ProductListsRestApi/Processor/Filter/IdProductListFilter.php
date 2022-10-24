<?php

namespace FondOfOryx\Glue\ProductListsRestApi\Processor\Filter;

use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class IdProductListFilter implements IdProductListFilterInterface
{
 /**
  * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
  *
  * @return string|null
  */
    public function filterFromRestRequest(RestRequestInterface $restRequest): ?string
    {
        return $restRequest->getResource()
            ->getId();
    }
}
