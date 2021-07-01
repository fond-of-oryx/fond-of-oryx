<?php

namespace FondOfOryx\Service\PaymentEpcQrCode;

use FondOfOryx\Service\PaymentEpcQrCode\Dependency\Service\PaymentEpcQrCodeToQrCodeGeneratorServiceInterface;
use FondOfOryx\Service\PaymentEpcQrCode\Model\Builder\EpcDataBuilder;
use FondOfOryx\Service\PaymentEpcQrCode\Model\Builder\EpcDataBuilderInterface;
use FondOfOryx\Service\PaymentEpcQrCode\Model\EpcQrCodeGenerator;
use FondOfOryx\Service\PaymentEpcQrCode\Model\EpcQrCodeGeneratorInterface;
use Spryker\Service\Kernel\AbstractServiceFactory;

/**
 * @method \FondOfOryx\Service\PaymentEpcQrCode\PaymentEpcQrCodeConfig getConfig()
 */
class PaymentEpcQrCodeServiceFactory extends AbstractServiceFactory
{
    /**
     * @return \FondOfOryx\Service\PaymentEpcQrCode\Model\EpcQrCodeGeneratorInterface
     */
    public function createEpcQrCodeGenerator(): EpcQrCodeGeneratorInterface
    {
        return new EpcQrCodeGenerator($this->createEpcDataBuilder(), $this->getQrCodeService(), $this->getConfig());
    }

    /**
     * @return \FondOfOryx\Service\PaymentEpcQrCode\Model\Builder\EpcDataBuilderInterface
     */
    protected function createEpcDataBuilder(): EpcDataBuilderInterface
    {
        return new EpcDataBuilder();
    }

    /**
     * @return \FondOfOryx\Service\PaymentEpcQrCode\Dependency\Service\PaymentEpcQrCodeToQrCodeGeneratorServiceInterface
     */
    protected function getQrCodeService(): PaymentEpcQrCodeToQrCodeGeneratorServiceInterface
    {
        return $this->getProvidedDependency(PaymentEpcQrCodeDependencyProvider::SERVICE_QR_CODE_GENERATOR);
    }
}
