<?php

declare(strict_types = 1);

namespace FondOfOryx\Zed\PaymentEpcQrCode\Business;

use FondOfOryx\Zed\PaymentEpcQrCode\Business\Model\Expander\ExpanderInterface;
use FondOfOryx\Zed\PaymentEpcQrCode\Business\Model\Expander\PaymentEpcQrCodeExpander;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class PaymentEpcQrCodeBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\PaymentEpcQrCode\Business\Model\Expander\ExpanderInterface
     */
    public function createPaymentEpcQrCodeExpander(): ExpanderInterface
    {
        return new PaymentEpcQrCodeExpander();
    }
}
