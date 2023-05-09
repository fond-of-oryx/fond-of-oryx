<?php

namespace FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper;

use ArrayObject;
use Generated\Shared\Transfer\OrderBudgetListTransfer;
use Generated\Shared\Transfer\OrderBudgetTransfer;
use Generated\Shared\Transfer\RestOrderBudgetsAttributesTransfer;

class RestOrderBudgetsAttributesMapper implements RestOrderBudgetsAttributesMapperInterface
{
 /**
  * @param \Generated\Shared\Transfer\OrderBudgetTransfer $orderBudgetTransfer
  *
  * @return \Generated\Shared\Transfer\RestOrderBudgetsAttributesTransfer
  */
    public function fromOrderBudget(OrderBudgetTransfer $orderBudgetTransfer): RestOrderBudgetsAttributesTransfer
    {
        return (new RestOrderBudgetsAttributesTransfer())
            ->fromArray($orderBudgetTransfer->toArray(), true)
            ->setId($orderBudgetTransfer->getUuid());
    }

    /**
     * @param \Generated\Shared\Transfer\OrderBudgetListTransfer $orderBudgetListTransfer
     *
     * @return \ArrayObject
     */
    public function fromOrderBudgetList(OrderBudgetListTransfer $orderBudgetListTransfer): ArrayObject
    {
        $restOrderBudgetsAttributesTransfers = new ArrayObject();

        foreach ($orderBudgetListTransfer->getOrderBudgets() as $orderBudgetTransfer) {
            $restOrderBudgetsAttributesTransfers->append(
                $this->fromOrderBudget($orderBudgetTransfer),
            );
        }

        return $restOrderBudgetsAttributesTransfers;
    }
}
