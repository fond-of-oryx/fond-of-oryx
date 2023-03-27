<?php

namespace FondOfOryx\Glue\CompaniesRestApi\Processor\Mapper;

use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompanyMapper implements CompanyMapperInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer
     */
    public function fromRestRequest(RestRequestInterface $restRequest): CompanyTransfer
    {
        return (new CompanyTransfer())->setUuid($this->getIdFromRequest($restRequest));
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return string|null
     */
    protected function getIdFromRequest(RestRequestInterface $restRequest): ?string
    {
        return $restRequest->getResource()->getId();
    }
}
