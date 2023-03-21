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
        return (new CompanyTransfer())->setIdCompany($this->getIdFromRequest($restRequest));
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return int|null
     */
    protected function getIdFromRequest(RestRequestInterface $restRequest): ?int
    {
        $id = $restRequest->getResource()->getId();
        if (is_numeric($id)) {
            return (int)$id;
        }

        return null;
    }
}
