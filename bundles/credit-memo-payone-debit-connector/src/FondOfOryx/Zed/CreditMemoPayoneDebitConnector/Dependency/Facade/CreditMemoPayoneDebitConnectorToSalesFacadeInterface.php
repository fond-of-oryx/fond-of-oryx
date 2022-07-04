<?php

namespace FondOfOryx\Zed\CreditMemoPayoneDebitConnector\Dependency\Facade;

interface CreditMemoPayoneDebitConnectorToSalesFacadeInterface
{
    /**
     * @param int $idSalesOrder
     *
     * @return array<string>
     */
    public function getDistinctOrderStates(int $idSalesOrder): array;
}
