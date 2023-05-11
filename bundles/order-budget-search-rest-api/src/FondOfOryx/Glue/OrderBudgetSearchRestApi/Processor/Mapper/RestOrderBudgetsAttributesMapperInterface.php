<?php

namespace FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper;

use ArrayObject;
use Generated\Shared\Transfer\OrderBudgetListTransfer;
use Generated\Shared\Transfer\OrderBudgetTransfer;
use Generated\Shared\Transfer\RestOrderBudgetsAttributesTransfer;

interface RestOrderBudgetsAttributesMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\OrderBudgetTransfer $orderBudgetTransfer
     *
     * @return \Generated\Shared\Transfer\RestOrderBudgetsAttributesTransfer
     */
    public function fromOrderBudget(OrderBudgetTransfer $orderBudgetTransfer): RestOrderBudgetsAttributesTransfer;

    /**
     * @param \Generated\Shared\Transfer\OrderBudgetListTransfer $orderBudgetListTransfer
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\RestOrderBudgetsAttributesTransfer>
     */
    public function fromOrderBudgetList(OrderBudgetListTransfer $orderBudgetListTransfer): ArrayObject;
}
