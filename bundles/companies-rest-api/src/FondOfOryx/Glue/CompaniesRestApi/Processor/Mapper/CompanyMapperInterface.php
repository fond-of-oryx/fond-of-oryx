<?php

namespace FondOfOryx\Glue\CompaniesRestApi\Processor\Mapper;

use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface CompanyMapperInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer
     */
    public function fromRestRequest(RestRequestInterface $restRequest): CompanyTransfer;
}
