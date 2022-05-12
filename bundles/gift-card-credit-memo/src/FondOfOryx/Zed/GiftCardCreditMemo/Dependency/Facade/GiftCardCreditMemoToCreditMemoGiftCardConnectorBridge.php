<?php

namespace FondOfOryx\Zed\GiftCardCreditMemo\Dependency\Facade;

use FondOfOryx\Zed\CreditMemoGiftCardConnector\Business\CreditMemoGiftCardConnectorFacadeInterface;

class GiftCardCreditMemoToCreditMemoGiftCardConnectorBridge implements GiftCardCreditMemoToCreditMemoGiftCardConnectorInterface
{
    /**
     * @var \FondOfOryx\Zed\CreditMemoGiftCardConnector\Business\CreditMemoGiftCardConnectorFacadeInterface
     */
    protected $facade;

    /**
     * @param \FondOfOryx\Zed\CreditMemoGiftCardConnector\Business\CreditMemoGiftCardConnectorFacadeInterface $facade
     */
    public function __construct(CreditMemoGiftCardConnectorFacadeInterface $facade)
    {
        $this->facade = $facade;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idSalesOrderItem
     *
     * @return array
     */
    public function findCreditMemoGiftCardsByIdSalesOrderItem(int $idSalesOrderItem): array
    {
        return $this->facade->findCreditMemoGiftCardsByIdSalesOrderItem($idSalesOrderItem);
    }
}
