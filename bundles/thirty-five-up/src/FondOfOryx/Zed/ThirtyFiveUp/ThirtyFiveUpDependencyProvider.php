<?php

namespace FondOfOryx\Zed\ThirtyFiveUp;

use FondOfOryx\Zed\ThirtyFiveUp\Dependency\Facade\ThirtyFiveUpToLocaleFacadeBridge;
use FondOfOryx\Zed\ThirtyFiveUp\Dependency\Facade\ThirtyFiveUpToStoreFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ThirtyFiveUpDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_LOCALE = '35UP:LOCALE_FACADE';

    /**
     * @var string
     */
    public const FACADE_STORE = '35UP:STORE_FACADE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container)
    {
        $container = parent::provideBusinessLayerDependencies($container);
        $container = $this->addLocaleFacade($container);
        $container = $this->addStoreFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addLocaleFacade(Container $container): Container
    {
        $container[static::FACADE_LOCALE] = function (Container $container) {
            return new ThirtyFiveUpToLocaleFacadeBridge($container->getLocator()->locale()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addStoreFacade(Container $container): Container
    {
        $container[static::FACADE_STORE] = function (Container $container) {
            return new ThirtyFiveUpToStoreFacadeBridge($container->getLocator()->store()->facade());
        };

        return $container;
    }
}
