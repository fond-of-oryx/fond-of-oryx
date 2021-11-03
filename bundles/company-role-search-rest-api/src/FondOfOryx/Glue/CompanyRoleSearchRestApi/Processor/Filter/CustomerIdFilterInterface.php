<?php

namespace FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Filter;

use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface CustomerIdFilterInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return int|null
     */
    public function filterFromRestRequest(RestRequestInterface $restRequest): ?int;
}
