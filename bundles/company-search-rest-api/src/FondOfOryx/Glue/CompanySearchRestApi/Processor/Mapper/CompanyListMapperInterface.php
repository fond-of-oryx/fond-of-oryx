<?php

namespace FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\CompanyListTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface CompanyListMapperInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\CompanyListTransfer
     */
    public function fromRestRequest(RestRequestInterface $restRequest): CompanyListTransfer;
}
