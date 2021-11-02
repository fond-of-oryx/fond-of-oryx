<?php

namespace FondOfOryx\Zed\PaymentEpcQrCode;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class PaymentEpcQrCodeDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const SERVICE_EPC_QR_CODE = 'SERVICE_EPC_QR_CODE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container)
    {
        $container = parent::provideBusinessLayerDependencies($container);
        $container = $this->addQrCodeService($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addQrCodeService(Container $container): Container
    {
        $container[static::SERVICE_EPC_QR_CODE] = static function (Container $container) {
            return $container->getLocator()->paymentEpcQrCode()->service();
        };

        return $container;
    }
}
