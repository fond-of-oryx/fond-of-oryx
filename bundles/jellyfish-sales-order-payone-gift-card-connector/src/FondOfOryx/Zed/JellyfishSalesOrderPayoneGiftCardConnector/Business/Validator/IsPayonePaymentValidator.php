<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Validator;

use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\JellyfishSalesOrderPayoneGiftCardConnectorConfig;
use Generated\Shared\Transfer\JellyfishOrderTransfer;

class IsPayonePaymentValidator implements IsPayonePaymentValidatorInterface
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\JellyfishSalesOrderPayoneGiftCardConnectorConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\JellyfishSalesOrderPayoneGiftCardConnectorConfig $config
     */
    public function __construct(JellyfishSalesOrderPayoneGiftCardConnectorConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     *
     * @return bool
     */
    public function isPayonePayment(JellyfishOrderTransfer $jellyfishOrderTransfer): bool
    {
        if (count($jellyfishOrderTransfer->getGiftCards()) === 0) {
            return false;
        }

        foreach ($jellyfishOrderTransfer->getPayments() as $payment) {
            if (in_array($payment->getMethod(), $this->config->getPayonePaymentMethods(), true)) {
                return true;
            }
        }

        return false;
    }
}
