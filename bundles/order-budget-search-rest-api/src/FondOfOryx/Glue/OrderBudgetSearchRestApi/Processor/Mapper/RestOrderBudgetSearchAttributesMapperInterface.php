<?php

namespace FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\OrderBudgetListTransfer;
use Generated\Shared\Transfer\RestOrderBudgetSearchAttributesTransfer;

interface RestOrderBudgetSearchAttributesMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\OrderBudgetListTransfer $orderBudgetListTransfer
     *
     * @return \Generated\Shared\Transfer\RestOrderBudgetSearchAttributesTransfer
     */
    public function fromOrderBudgetList(
        OrderBudgetListTransfer $orderBudgetListTransfer
    ): RestOrderBudgetSearchAttributesTransfer;
}
