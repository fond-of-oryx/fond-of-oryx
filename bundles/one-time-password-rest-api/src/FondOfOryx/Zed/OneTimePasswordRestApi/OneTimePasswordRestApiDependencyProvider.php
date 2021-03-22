<?php

namespace FondOfOryx\Zed\OneTimePasswordRestApi;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class OneTimePasswordRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_ONE_TIME_PASSWORD = 'FACADE_ONE_TIME_PASSWORD';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addOneTimePasswordFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addOneTimePasswordFacade(Container $container): Container
    {
        $container[self::FACADE_ONE_TIME_PASSWORD] = static function (Container $container) {
            return $container->getLocator()->oneTimePassword()->facade();
        };

        return $container;
    }
}
