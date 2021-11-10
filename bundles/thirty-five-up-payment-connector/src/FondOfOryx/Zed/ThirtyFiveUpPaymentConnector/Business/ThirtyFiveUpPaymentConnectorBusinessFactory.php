<?php

namespace FondOfOryx\Zed\ThirtyFiveUpPaymentConnector\Business;

use FondOfOryx\Zed\ThirtyFiveUpPaymentConnector\Business\PaymentMethodFilter\ThirtyFiveUpPaymentMethodFilter;
use FondOfOryx\Zed\ThirtyFiveUpPaymentConnector\Business\PaymentMethodFilter\ThirtyFiveUpPaymentMethodFilterInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\ThirtyFiveUpPaymentConnector\ThirtyFiveUpPaymentConnectorConfig getConfig()
 */
class ThirtyFiveUpPaymentConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\ThirtyFiveUpPaymentConnector\Business\PaymentMethodFilter\ThirtyFiveUpPaymentMethodFilterInterface
     */
    public function createThirtyFiveUpPaymentMethodFilter(): ThirtyFiveUpPaymentMethodFilterInterface
    {
        return new ThirtyFiveUpPaymentMethodFilter($this->getConfig());
    }
}
