<?php

namespace FondOfOryx\Glue\CompaniesRestApi\Processor\Permission;

use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface PermissionCheckerInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return bool
     */
    public function can(RestRequestInterface $restRequest): bool;
}
