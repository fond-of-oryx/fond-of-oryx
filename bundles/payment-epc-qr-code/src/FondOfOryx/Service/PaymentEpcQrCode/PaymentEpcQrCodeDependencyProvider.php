<?php

namespace FondOfOryx\Service\PaymentEpcQrCode;

use FondOfOryx\Service\PaymentEpcQrCode\Dependency\Wrapper\QrCodeWrapper;
use Spryker\Service\Kernel\AbstractBundleDependencyProvider;
use Spryker\Service\Kernel\Container;

/**
 * @method \FondOfOryx\Service\PaymentEpcQrCode\PaymentEpcQrCodeConfig getConfig()
 */
class PaymentEpcQrCodeDependencyProvider extends AbstractBundleDependencyProvider
{
    public const WRAPPER_QR_CODE = 'WRAPPER_QR_CODE';

    /**
     * @param \Spryker\Service\Kernel\Container $container
     *
     * @return \Spryker\Service\Kernel\Container
     */
    public function provideServiceDependencies(Container $container)
    {
        $container = $this->addQrCodeWrapper($container);

        return $container;
    }

    /**
     * @param \Spryker\Service\Kernel\Container $container
     *
     * @return \Spryker\Service\Kernel\Container
     */
    public function addQrCodeWrapper(Container $container): Container
    {
        $container[static::WRAPPER_QR_CODE] = function () {
            return new QrCodeWrapper($this->getConfig());
        };

        return $container;
    }
}
