<?php

namespace FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper;

use FondOfOryx\Glue\ProductListSearchRestApi\Processor\Filter\RequestParameterFilterInterface;
use Generated\Shared\Transfer\ProductListCollectionTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class ProductListCollectionMapper implements ProductListCollectionMapperInterface
{
    /**
     * @var \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\PaginationMapperInterface
     */
    protected $paginationMapper;

    /**
     * @var \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Filter\RequestParameterFilterInterface
     */
    protected $requestParameterFilter;

    /**
     * @param \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\PaginationMapperInterface $paginationMapper
     * @param \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Filter\RequestParameterFilterInterface $requestParameterFilter
     */
    public function __construct(
        PaginationMapperInterface $paginationMapper,
        RequestParameterFilterInterface $requestParameterFilter
    ) {
        $this->paginationMapper = $paginationMapper;
        $this->requestParameterFilter = $requestParameterFilter;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\ProductListCollectionTransfer
     */
    public function fromRestRequest(RestRequestInterface $restRequest): ProductListCollectionTransfer
    {
        return (new ProductListCollectionTransfer())
            ->setPagination($this->paginationMapper->fromRestRequest($restRequest))
            ->setQuery($this->requestParameterFilter->getRequestParameter($restRequest, 'q'))
            ->setShowAll($this->requestParameterFilter->getRequestParameter($restRequest, 'show-all') === 'true')
            ->setSort($this->requestParameterFilter->getRequestParameter($restRequest, 'sort'));
    }
}
