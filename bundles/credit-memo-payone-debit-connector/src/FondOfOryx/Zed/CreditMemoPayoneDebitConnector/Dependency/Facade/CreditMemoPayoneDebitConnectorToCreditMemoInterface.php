<?php

namespace FondOfOryx\Zed\CreditMemoPayoneDebitConnector\Dependency\Facade;

use Generated\Shared\Transfer\ItemTransfer;

interface CreditMemoPayoneDebitConnectorToCreditMemoInterface
{
    /**
     * @param int $idSalesOrderItem
     *
     * @return \Generated\Shared\Transfer\ItemTransfer|null
     */
    public function findCreditMemoItemByIdSalesOrderItem(int $idSalesOrderItem): ?ItemTransfer;
}
