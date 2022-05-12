<?php

namespace FondOfOryx\Zed\GiftCardCreditMemo\Business\Check;

use FondOfOryx\Zed\GiftCardCreditMemo\Dependency\Facade\GiftCardCreditMemoToCreditMemoGiftCardConnectorInterface;

class HasGiftCardRefundCheck implements HasGiftCardRefundCheckInterface
{
    /**
     * @var \FondOfOryx\Zed\GiftCardCreditMemo\Dependency\Facade\GiftCardCreditMemoToCreditMemoGiftCardConnectorInterface
     */
    protected $giftCardCreditMemoConnectorFacade;

    /**
     * @param \FondOfOryx\Zed\GiftCardCreditMemo\Dependency\Facade\GiftCardCreditMemoToCreditMemoGiftCardConnectorInterface $giftCardCreditMemoConnectorFacade
     */
    public function __construct(GiftCardCreditMemoToCreditMemoGiftCardConnectorInterface $giftCardCreditMemoConnectorFacade)
    {
        $this->giftCardCreditMemoConnectorFacade = $giftCardCreditMemoConnectorFacade;
    }

    /**
     * @param int $idSalesOrderItem
     *
     * @return bool
     */
    public function check(int $idSalesOrderItem): bool
    {
        return count($this->giftCardCreditMemoConnectorFacade->findCreditMemoGiftCardsByIdSalesOrderItem($idSalesOrderItem)) > 0;
    }
}
