<?php

namespace FondOfOryx\Glue\CompaniesRestApi\Processor\Mapper;

use Generated\Shared\Transfer\CompaniesRestApiPermissionRequestTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface PermissionRequestMapperInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\CompaniesRestApiPermissionRequestTransfer
     */
    public function fromRestRequest(RestRequestInterface $restRequest): CompaniesRestApiPermissionRequestTransfer;
}
