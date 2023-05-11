<?php

namespace FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\OrderBudgetListTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class OrderBudgetListMapper implements OrderBudgetListMapperInterface
{
    /**
     * @var \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\FilterFieldsMapperInterface
     */
    protected FilterFieldsMapperInterface $filterFieldsMapper;

    /**
     * @var \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\PaginationMapperInterface
     */
    protected PaginationMapperInterface $paginationMapper;

    /**
     * @param \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\FilterFieldsMapperInterface $filterFieldsMapper
     * @param \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\PaginationMapperInterface $paginationMapper
     */
    public function __construct(
        FilterFieldsMapperInterface $filterFieldsMapper,
        PaginationMapperInterface $paginationMapper
    ) {
        $this->filterFieldsMapper = $filterFieldsMapper;
        $this->paginationMapper = $paginationMapper;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\OrderBudgetListTransfer
     */
    public function fromRestRequest(RestRequestInterface $restRequest): OrderBudgetListTransfer
    {
        return (new OrderBudgetListTransfer())
            ->setFilterFields($this->filterFieldsMapper->fromRestRequest($restRequest))
            ->setPagination($this->paginationMapper->fromRestRequest($restRequest));
    }
}
