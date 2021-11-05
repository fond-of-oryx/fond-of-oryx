<?php

namespace FondOfOryx\Zed\GiftCardPaymentConnector\Business;

use FondOfOryx\Zed\GiftCardPaymentConnector\Business\PaymentMethodFilter\GiftCardPaymentConnectorPaymentMethodFilter;
use FondOfOryx\Zed\GiftCardPaymentConnector\Business\PaymentMethodFilter\GiftCardPaymentConnectorPaymentMethodFilterInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\GiftCardPaymentConnector\GiftCardPaymentConnectorConfig getConfig()
 */
class GiftCardPaymentConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\GiftCardPaymentConnector\Business\PaymentMethodFilter\GiftCardPaymentConnectorPaymentMethodFilterInterface
     */
    public function createGiftCardPaymentConnectorPaymentMethod(): GiftCardPaymentConnectorPaymentMethodFilterInterface
    {
        return new GiftCardPaymentConnectorPaymentMethodFilter($this->getConfig());
    }
}
