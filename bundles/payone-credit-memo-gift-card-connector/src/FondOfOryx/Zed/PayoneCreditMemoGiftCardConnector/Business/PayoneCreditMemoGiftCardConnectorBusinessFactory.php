<?php

namespace FondOfOryx\Zed\PayoneCreditMemoGiftCardConnector\Business;

use FondOfOryx\Zed\PayoneCreditMemoGiftCardConnector\Business\Refund\GiftCardRefundReCalculator;
use FondOfOryx\Zed\PayoneCreditMemoGiftCardConnector\Business\Refund\GiftCardRefundReCalculatorInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class PayoneCreditMemoGiftCardConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\PayoneCreditMemoGiftCardConnector\Business\Refund\GiftCardRefundReCalculatorInterface
     */
    public function createGiftCardRefundReCalculator(): GiftCardRefundReCalculatorInterface
    {
        return new GiftCardRefundReCalculator();
    }
}
