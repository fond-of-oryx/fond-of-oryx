<?php

namespace FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper;

use FondOfOryx\Glue\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiConfig;
use FondOfOryx\Shared\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiConstants;
use Generated\Shared\Transfer\OrderBudgetListTransfer;
use Generated\Shared\Transfer\RestOrderBudgetSearchSortTransfer;

class RestOrderBudgetSearchSortMapper implements RestOrderBudgetSearchSortMapperInterface
{
    /**
     * @var string
     */
    protected const PATTERN_ORDER_BY = '/^([a-z_]+)::(asc|desc)/';

    /**
     * @var \FondOfOryx\Glue\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiConfig
     */
    protected OrderBudgetSearchRestApiConfig $config;

    /**
     * @param \FondOfOryx\Glue\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiConfig $config
     */
    public function __construct(OrderBudgetSearchRestApiConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\OrderBudgetListTransfer $orderBudgetListTransfer
     *
     * @return \Generated\Shared\Transfer\RestOrderBudgetSearchSortTransfer
     */
    public function fromOrderBudgetList(
        OrderBudgetListTransfer $orderBudgetListTransfer
    ): RestOrderBudgetSearchSortTransfer {
        $restOrderBudgetSearchSortTransfer = (new RestOrderBudgetSearchSortTransfer())
            ->setSortParamNames($this->config->getSortParamNames())
            ->setSortParamLocalizedNames($this->config->getSortParamLocalizedNames());

        $sort = null;

        foreach ($orderBudgetListTransfer->getFilterFields() as $filterFieldTransfer) {
            if ($filterFieldTransfer->getType() !== 'orderBy') {
                continue;
            }

            $sort = $filterFieldTransfer->getValue();
        }

        if ($sort === null) {
            return $restOrderBudgetSearchSortTransfer;
        }

        $sortFields = $this->config->getSortFields();
        $sortField = preg_replace(static::PATTERN_ORDER_BY, '$1', $sort);

        if (!in_array($sortField, $sortFields, true)) {
            return $restOrderBudgetSearchSortTransfer;
        }

        $sortDirection = preg_replace(static::PATTERN_ORDER_BY, '$2', $sort);

        return $restOrderBudgetSearchSortTransfer->setCurrentSortParam(
            sprintf(
                '%s%s%s',
                $sortField,
                OrderBudgetSearchRestApiConstants::DELIMITER_SORT,
                $sortDirection,
            ),
        )->setCurrentSortOrder($sortDirection);
    }
}
