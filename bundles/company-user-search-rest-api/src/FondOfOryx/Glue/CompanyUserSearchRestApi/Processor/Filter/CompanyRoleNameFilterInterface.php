<?php

namespace FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter;

use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface CompanyRoleNameFilterInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return array<string>
     */
    public function filterFromRestRequest(RestRequestInterface $restRequest): array;
}
