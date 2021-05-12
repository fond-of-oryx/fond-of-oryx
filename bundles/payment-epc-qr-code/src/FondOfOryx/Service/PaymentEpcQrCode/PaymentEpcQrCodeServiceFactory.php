<?php

namespace FondOfOryx\Service\PaymentEpcQrCode;

use FondOfOryx\Service\PaymentEpcQrCode\Dependency\Wrapper\QrCodeWrapperInterface;
use FondOfOryx\Service\PaymentEpcQrCode\Model\QrCode;
use FondOfOryx\Service\PaymentEpcQrCode\Model\QrCodeInterface;
use FondOfOryx\Service\PaymentEpcQrCode\Model\QrCodeWriter;
use FondOfOryx\Service\PaymentEpcQrCode\Model\QrCodeWriterInterface;
use Spryker\Service\Kernel\AbstractServiceFactory;

/**
 * @method \FondOfOryx\Service\PaymentEpcQrCode\PaymentEpcQrCodeConfig getConfig()
 */
class PaymentEpcQrCodeServiceFactory extends AbstractServiceFactory
{
    /**
     * @return \FondOfOryx\Service\PaymentEpcQrCode\Model\QrCodeWriterInterface
     */
    public function createQrCodeWriter(): QrCodeWriterInterface
    {
        return new QrCodeWriter($this->getQrCodeWrapper(), $this->createQrCode());
    }

    /**
     * @return \FondOfOryx\Service\PaymentEpcQrCode\Model\QrCodeInterface
     */
    protected function createQrCode(): QrCodeInterface
    {
        return new QrCode();
    }

    /**
     * @return \FondOfOryx\Service\PaymentEpcQrCode\Dependency\Wrapper\QrCodeWrapperInterface
     */
    protected function getQrCodeWrapper(): QrCodeWrapperInterface
    {
        return $this->getProvidedDependency(PaymentEpcQrCodeDependencyProvider::WRAPPER_QR_CODE);
    }
}
