<?php

namespace FondOfOryx\Zed\GiftCardCreditMemo\Business;

use FondOfOryx\Zed\GiftCardCreditMemo\Business\Check\HasGiftCardRefundCheck;
use FondOfOryx\Zed\GiftCardCreditMemo\Business\Check\HasGiftCardRefundCheckInterface;
use FondOfOryx\Zed\GiftCardCreditMemo\Business\Refund\PartialGiftCardRefund;
use FondOfOryx\Zed\GiftCardCreditMemo\Business\Refund\PartialGiftCardRefundInterface;
use FondOfOryx\Zed\GiftCardCreditMemo\Dependency\Facade\GiftCardCreditMemoToCreditMemoGiftCardConnectorInterface;
use FondOfOryx\Zed\GiftCardCreditMemo\GiftCardCreditMemoDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\GiftCardCreditMemo\GiftCardCreditMemoConfig getConfig()
 */
class GiftCardCreditMemoBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\GiftCardCreditMemo\Business\Check\HasGiftCardRefundCheckInterface
     */
    public function createHasGiftCardRefundCheck(): HasGiftCardRefundCheckInterface
    {
        return new HasGiftCardRefundCheck(
            $this->getCreditMemoGiftCardConnectorFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\GiftCardCreditMemo\Business\Refund\PartialGiftCardRefundInterface
     */
    public function createPartialGiftCardRefund(): PartialGiftCardRefundInterface
    {
        return new PartialGiftCardRefund();
    }

    /**
     * @return \FondOfOryx\Zed\GiftCardCreditMemo\Dependency\Facade\GiftCardCreditMemoToCreditMemoGiftCardConnectorInterface
     */
    protected function getCreditMemoGiftCardConnectorFacade(): GiftCardCreditMemoToCreditMemoGiftCardConnectorInterface
    {
        return $this->getProvidedDependency(GiftCardCreditMemoDependencyProvider::FACADE_CREDIT_MEMO_GIFT_CARD_CONNECTOR);
    }
}
