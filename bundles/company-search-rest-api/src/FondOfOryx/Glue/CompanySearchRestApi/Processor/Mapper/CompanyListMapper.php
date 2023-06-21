<?php

namespace FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper;

use FondOfOryx\Glue\CompanySearchRestApi\Processor\Filter\RequestParameterFilterInterface;
use Generated\Shared\Transfer\CompanyListTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompanyListMapper implements CompanyListMapperInterface
{
    /**
     * @var \FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\PaginationMapperInterface
     */
    protected PaginationMapperInterface $paginationMapper;

    /**
     * @var \FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\FilterFieldsMapperInterface
     */
    protected FilterFieldsMapperInterface $filterFieldsMapper;

    /**
     * @var \FondOfOryx\Glue\CompanySearchRestApi\Processor\Filter\RequestParameterFilterInterface
     */
    protected RequestParameterFilterInterface $requestParameterFilter;

    /**
     * @param \FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\PaginationMapperInterface $paginationMapper
     * @param \FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\FilterFieldsMapperInterface $filterFieldsMapper
     * @param \FondOfOryx\Glue\CompanySearchRestApi\Processor\Filter\RequestParameterFilterInterface $requestParameterFilter
     */
    public function __construct(
        PaginationMapperInterface $paginationMapper,
        FilterFieldsMapperInterface $filterFieldsMapper,
        RequestParameterFilterInterface $requestParameterFilter
    ) {
        $this->paginationMapper = $paginationMapper;
        $this->filterFieldsMapper = $filterFieldsMapper;
        $this->requestParameterFilter = $requestParameterFilter;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\CompanyListTransfer
     */
    public function fromRestRequest(RestRequestInterface $restRequest): CompanyListTransfer
    {
        return (new CompanyListTransfer())
            ->setPagination($this->paginationMapper->fromRestRequest($restRequest))
            ->setFilterFields($this->filterFieldsMapper->fromRestRequest($restRequest))
            ->setSort($this->requestParameterFilter->getRequestParameter($restRequest, 'sort'));
    }
}
