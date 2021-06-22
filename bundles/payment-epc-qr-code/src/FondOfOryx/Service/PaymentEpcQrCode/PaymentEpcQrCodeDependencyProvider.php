<?php

namespace FondOfOryx\Service\PaymentEpcQrCode;

use FondOfOryx\Service\PaymentEpcQrCode\Dependency\Service\PaymentEpcQrCodeToQrCodeGeneratorServiceBridge;
use Spryker\Service\Kernel\AbstractBundleDependencyProvider;
use Spryker\Service\Kernel\Container;

/**
 * @method \FondOfOryx\Service\PaymentEpcQrCode\PaymentEpcQrCodeConfig getConfig()
 */
class PaymentEpcQrCodeDependencyProvider extends AbstractBundleDependencyProvider
{
    public const SERVICE_QR_CODE_GENERATOR = 'SERVICE_QR_CODE_GENERATOR';

    /**
     * @param \Spryker\Service\Kernel\Container $container
     *
     * @return \Spryker\Service\Kernel\Container
     */
    public function provideServiceDependencies(Container $container)
    {
        $container = $this->addQrCodeServiceGenerator($container);

        return $container;
    }

    /**
     * @param \Spryker\Service\Kernel\Container $container
     *
     * @return \Spryker\Service\Kernel\Container
     */
    public function addQrCodeServiceGenerator(Container $container): Container
    {
        $container[static::SERVICE_QR_CODE_GENERATOR] = static function (Container $container) {
            return new PaymentEpcQrCodeToQrCodeGeneratorServiceBridge($container->getLocator()->qrCodeGenerator()->service());
        };

        return $container;
    }
}
