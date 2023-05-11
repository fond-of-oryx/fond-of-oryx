<?php

namespace FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\OrderBudgetListTransfer;
use Generated\Shared\Transfer\RestOrderBudgetSearchAttributesTransfer;

class RestOrderBudgetSearchAttributesMapper implements RestOrderBudgetSearchAttributesMapperInterface
{
    /**
     * @var \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\RestOrderBudgetsAttributesMapperInterface
     */
    protected RestOrderBudgetsAttributesMapperInterface $restOrderBudgetsAttributesMapper;

    /**
     * @var \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\RestOrderBudgetSearchSortMapperInterface
     */
    protected RestOrderBudgetSearchSortMapperInterface $restOrderBudgetSearchSortMapper;

    /**
     * @var \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\RestOrderBudgetSearchPaginationMapperInterface
     */
    protected RestOrderBudgetSearchPaginationMapperInterface $restOrderBudgetSearchPaginationMapper;

    /**
     * @param \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\RestOrderBudgetsAttributesMapperInterface $restOrderBudgetsAttributesMapper
     * @param \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\RestOrderBudgetSearchSortMapperInterface $restOrderBudgetSearchSortMapper
     * @param \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\RestOrderBudgetSearchPaginationMapperInterface $restOrderBudgetSearchPaginationMapper
     */
    public function __construct(
        RestOrderBudgetsAttributesMapperInterface $restOrderBudgetsAttributesMapper,
        RestOrderBudgetSearchSortMapperInterface $restOrderBudgetSearchSortMapper,
        RestOrderBudgetSearchPaginationMapperInterface $restOrderBudgetSearchPaginationMapper
    ) {
        $this->restOrderBudgetSearchSortMapper = $restOrderBudgetSearchSortMapper;
        $this->restOrderBudgetSearchPaginationMapper = $restOrderBudgetSearchPaginationMapper;
        $this->restOrderBudgetsAttributesMapper = $restOrderBudgetsAttributesMapper;
    }

    /**
     * @param \Generated\Shared\Transfer\OrderBudgetListTransfer $orderBudgetListTransfer
     *
     * @return \Generated\Shared\Transfer\RestOrderBudgetSearchAttributesTransfer
     */
    public function fromOrderBudgetList(
        OrderBudgetListTransfer $orderBudgetListTransfer
    ): RestOrderBudgetSearchAttributesTransfer {
        return (new RestOrderBudgetSearchAttributesTransfer())->setOrderBudgets(
            $this->restOrderBudgetsAttributesMapper->fromOrderBudgetList($orderBudgetListTransfer),
        )->setSort(
            $this->restOrderBudgetSearchSortMapper->fromOrderBudgetList($orderBudgetListTransfer),
        )->setPagination(
            $this->restOrderBudgetSearchPaginationMapper->fromOrderBudgetList($orderBudgetListTransfer),
        );
    }
}
