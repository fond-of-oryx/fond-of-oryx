<?php

namespace FondOfOryx\Zed\OmsCreditMemoGiftCardConnector\Dependency\Facade;

interface OmsCreditMemoGiftCardConnectorToCreditMemoGiftCardConnectorInterface
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
