<?php

declare(strict_types = 1);

namespace FondOfOryx\Zed\PaymentEpcQrCode\Business;

use FondOfOryx\Service\PaymentEpcQrCode\PaymentEpcQrCodeServiceInterface;
use FondOfOryx\Zed\PaymentEpcQrCode\Business\Model\Expander\ExpanderInterface;
use FondOfOryx\Zed\PaymentEpcQrCode\Business\Model\Expander\PaymentEpcQrCodeExpander;
use FondOfOryx\Zed\PaymentEpcQrCode\PaymentEpcQrCodeDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\PaymentEpcQrCode\PaymentEpcQrCodeConfig getConfig()
 */
class PaymentEpcQrCodeBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\PaymentEpcQrCode\Business\Model\Expander\ExpanderInterface
     */
    public function createPaymentEpcQrCodeExpander(): ExpanderInterface
    {
        return new PaymentEpcQrCodeExpander($this->getEpcQrCodeService(), $this->getConfig());
    }

    /**
     * @return \FondOfOryx\Service\PaymentEpcQrCode\PaymentEpcQrCodeServiceInterface
     */
    protected function getEpcQrCodeService(): PaymentEpcQrCodeServiceInterface
    {
        return $this->getProvidedDependency(PaymentEpcQrCodeDependencyProvider::SERVICE_EPC_QR_CODE);
    }
}
