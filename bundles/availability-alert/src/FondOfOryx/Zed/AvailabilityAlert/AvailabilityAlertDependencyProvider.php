<?php

namespace FondOfOryx\Zed\AvailabilityAlert;

use FondOfOryx\Zed\AvailabilityAlert\Communication\Plugin\SubscribersNotifier\SubscribersNotifierHasProductAssignedStoresPreCheckPlugin;
use FondOfOryx\Zed\AvailabilityAlert\Communication\Plugin\SubscribersNotifier\SubscribersNotifierProductAttributeReleaseDateInPastOrIsEmptyPreCheckPlugin;
use FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToLocaleBridge;
use FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToMailBridge;
use FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToProductBridge;
use FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToStoreBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class AvailabilityAlertDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_LOCALE = 'FACADE_LOCALE';
    public const FACADE_MAIL = 'FACADE_MAIL';
    public const FACADE_AVAILABILITY = 'FACADE_AVAILABILITY';
    public const FACADE_PRODUCT = 'FACADE_PRODUCT';
    public const FACADE_STORE = 'FACADE_STORE';
    public const SUBSCRIBERS_NOTIFIER_PRE_CHECK_PLUGINS = 'SUBSCRIBERS_NOTIFIER_PRE_CHECK_PLUGINS';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = $this->addMailFacade($container);
        $container = $this->addAvailabilityFacade($container);
        $container = $this->addProductFacade($container);
        $container = $this->addSubscribersNotifierPreCheckPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = $this->addLocaleFacade($container);
        $container = $this->addStoreFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductFacade(Container $container): Container
    {
        $container[static::FACADE_PRODUCT] = static function (Container $container) {
            return new AvailabilityAlertToProductBridge($container->getLocator()->product()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addMailFacade(Container $container): Container
    {
        $container[static::FACADE_MAIL] = static function (Container $container) {
            return new AvailabilityAlertToMailBridge($container->getLocator()->mail()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addLocaleFacade(Container $container): Container
    {
        $container[static::FACADE_LOCALE] = static function (Container $container) {
            return new AvailabilityAlertToLocaleBridge($container->getLocator()->locale()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addStoreFacade(Container $container): Container
    {
        $container[static::FACADE_STORE] = static function (Container $container) {
            return new AvailabilityAlertToStoreBridge($container->getLocator()->store()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addAvailabilityFacade(Container $container): Container
    {
        $container[static::FACADE_AVAILABILITY] = static function (Container $container) {
            return $container->getLocator()->availability()->facade();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSubscribersNotifierPreCheckPlugins(Container $container): Container
    {
        $container[static::SUBSCRIBERS_NOTIFIER_PRE_CHECK_PLUGINS] = function () {
            return $this->getSubscribersNotifierPreCheckPlugins();
        };

        return $container;
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier\SubscribersNotifierPreCheckPluginInterface[]
     */
    protected function getSubscribersNotifierPreCheckPlugins(): array
    {
        return [
            new SubscribersNotifierHasProductAssignedStoresPreCheckPlugin(),
            new SubscribersNotifierProductAttributeReleaseDateInPastOrIsEmptyPreCheckPlugin(),
        ];
    }
}
