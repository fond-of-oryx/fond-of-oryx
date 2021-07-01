<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper;

use Generated\Shared\Transfer\JellyfishOrderExpenseTransfer;
use Orm\Zed\Sales\Persistence\SpySalesExpense;

class JellyfishOrderExpenseMapper implements JellyfishOrderExpenseMapperInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesExpense $salesExpense
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderExpenseTransfer
     */
    public function fromSalesExpense(SpySalesExpense $salesExpense): JellyfishOrderExpenseTransfer
    {
        return (new JellyfishOrderExpenseTransfer())->setType($salesExpense->getType())
            ->setName($salesExpense->getName())
            ->setTaxRate((float)$salesExpense->getTaxRate())
            ->setUnitPrice($salesExpense->getPrice())
            ->setUnitTaxAmount($salesExpense->getTaxAmount())
            ->setSumTaxAmount($salesExpense->getTaxAmount())
            ->setSumPrice($salesExpense->getPrice());
    }
}
