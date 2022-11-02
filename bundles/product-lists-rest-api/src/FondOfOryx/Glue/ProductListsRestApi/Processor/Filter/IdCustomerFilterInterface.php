<?php

namespace FondOfOryx\Glue\ProductListsRestApi\Processor\Filter;

use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface IdCustomerFilterInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return int|null
     */
    public function filterFromRestRequest(RestRequestInterface $restRequest): ?int;
}
