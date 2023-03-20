<?php

namespace FondOfOryx\Glue\CompaniesRestApi\Processor\Mapper;

use Generated\Shared\Transfer\CompanyCollectionTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompanyCollectionMapper implements CompanyCollectionMapperInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\CompanyCollectionTransfer
     */
    public function fromRestRequest(RestRequestInterface $restRequest): CompanyCollectionTransfer
    {
        $collection = new CompanyCollectionTransfer();
        $restRequest->getAttributesDataFromRequest();

        return (new QuoteListTransfer())
            ->setFilterFields($this->filterFieldsMapper->fromRestRequest($restRequest))
            ->setPagination($this->paginationMapper->fromRestRequest($restRequest));
    }
}
