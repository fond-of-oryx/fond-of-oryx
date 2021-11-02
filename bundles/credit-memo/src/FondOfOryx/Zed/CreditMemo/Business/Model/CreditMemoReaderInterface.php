<?php

namespace FondOfOryx\Zed\CreditMemo\Business\Model;

interface CreditMemoReaderInterface
{
    /**
     * @param array<\Orm\Zed\Sales\Persistence\SpySalesOrderItem> $spySalesOrderItems
     *
     * @throws \Exception
     *
     * @return array<\Orm\Zed\CreditMemo\Persistence\FooCreditMemo>
     */
    public function getCreditMemoBySalesOrderItems(array $spySalesOrderItems): array;
}
