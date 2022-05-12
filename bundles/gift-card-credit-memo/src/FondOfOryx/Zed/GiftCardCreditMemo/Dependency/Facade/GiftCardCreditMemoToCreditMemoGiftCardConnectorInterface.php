<?php

namespace FondOfOryx\Zed\GiftCardCreditMemo\Dependency\Facade;

interface GiftCardCreditMemoToCreditMemoGiftCardConnectorInterface
{
    /**
     * @api
     *
     * @param int $idSalesOrderItem
     *
     * @return array
     */
    public function findCreditMemoGiftCardsByIdSalesOrderItem(int $idSalesOrderItem): array;
}
