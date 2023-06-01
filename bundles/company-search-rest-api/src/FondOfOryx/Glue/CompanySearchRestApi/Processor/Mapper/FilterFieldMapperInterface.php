<?php

namespace FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\FilterFieldTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface FilterFieldMapperInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\FilterFieldTransfer|null
     */
    public function fromRestRequest(RestRequestInterface $restRequest): ?FilterFieldTransfer;
}
