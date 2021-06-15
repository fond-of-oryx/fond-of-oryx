<?php

namespace FondOfOryx\Zed\CreditMemo\Business\Model;

interface CreditMemoReaderInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem[] $spySalesOrderItems
     *
     * @throws \Exception
     *
     * @return \Orm\Zed\CreditMemo\Persistence\FooCreditMemo[]
     */
    public function getCreditMemoBySalesOrderItems(array $spySalesOrderItems): array;
}
