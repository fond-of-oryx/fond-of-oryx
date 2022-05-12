<?php

namespace FondOfOryx\Zed\PayoneCreditMemoGiftCardConnector\Business;

use FondOfOryx\Zed\PayoneCreditMemoGiftCardConnector\Business\Refund\GiftCardRefundRecalculator;
use FondOfOryx\Zed\PayoneCreditMemoGiftCardConnector\Business\Refund\GiftCardRefundRecalculatorInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class PayoneCreditMemoGiftCardConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\PayoneCreditMemoGiftCardConnector\Business\Refund\GiftCardRefundRecalculatorInterface
     */
    public function createGiftCardRefundReCalculator(): GiftCardRefundRecalculatorInterface
    {
        return new GiftCardRefundRecalculator();
    }
}
