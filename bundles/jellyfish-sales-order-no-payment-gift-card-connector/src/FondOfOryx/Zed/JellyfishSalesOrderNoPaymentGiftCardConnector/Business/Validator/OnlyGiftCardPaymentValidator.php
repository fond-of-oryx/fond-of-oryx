<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderNoPaymentGiftCardConnector\Business\Validator;

use FondOfOryx\Zed\JellyfishSalesOrderNoPaymentGiftCardConnector\JellyfishSalesOrderNoPaymentGiftCardConnectorConfig;
use Generated\Shared\Transfer\JellyfishOrderTransfer;

class OnlyGiftCardPaymentValidator implements OnlyGiftCardPaymentValidatorInterface
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderNoPaymentGiftCardConnector\JellyfishSalesOrderNoPaymentGiftCardConnectorConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Zed\JellyfishSalesOrderNoPaymentGiftCardConnector\JellyfishSalesOrderNoPaymentGiftCardConnectorConfig $config
     */
    public function __construct(JellyfishSalesOrderNoPaymentGiftCardConnectorConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     *
     * @return bool
     */
    public function isOnlyGiftCardPayment(JellyfishOrderTransfer $jellyfishOrderTransfer): bool
    {
        if (count($jellyfishOrderTransfer->getGiftCards()) === 0) {
            return false;
        }

        foreach ($jellyfishOrderTransfer->getPayments() as $payment) {
            if (in_array($payment->getMethod(), $this->config->getNoPaymentMethods(), true)) {
                return true;
            }
        }

        return false;
    }
}
