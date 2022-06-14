<?php

namespace FondOfOryx\Zed\GiftCardProportionalValueNoPaymentConnector\Business\Validator;

use FondOfOryx\Zed\GiftCardProportionalValueNoPaymentConnector\GiftCardProportionalValueNoPaymentConnectorConfig;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

class OnlyGiftCardPaymentValidator implements OnlyGiftCardPaymentValidatorInterface
{
    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValueNoPaymentConnector\GiftCardProportionalValueNoPaymentConnectorConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Zed\GiftCardProportionalValueNoPaymentConnector\GiftCardProportionalValueNoPaymentConnectorConfig $config
     */
    public function __construct(GiftCardProportionalValueNoPaymentConnectorConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $spySalesOrder
     *
     * @return bool
     */
    public function validate(SpySalesOrder $spySalesOrder): bool
    {
        $payments = $spySalesOrder->getOrdersJoinSalesPaymentMethodType();
        if (count($payments) === 0) {
            return false;
        }

        foreach ($payments as $payment) {
            if (in_array($payment->getSalesPaymentMethodType()->getPaymentMethod(), $this->config->getNoPaymentMethods(), true)) {
                return true;
            }
        }

        return false;
    }
}
