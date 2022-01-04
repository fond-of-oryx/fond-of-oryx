<?php

namespace FondOfOryx\Zed\AvailabilityAlert;

use FondOfOryx\Zed\AvailabilityAlert\Communication\Plugin\SubscribersNotifier\SubscribersNotifierHasProductAssignedStoresPreCheckPlugin;
use FondOfOryx\Zed\AvailabilityAlert\Communication\Plugin\SubscribersNotifier\SubscribersNotifierProductAttributeReleaseDateInPastOrIsEmptyPreCheckPlugin;
use FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToAvailabilityFacadeBridge;
use FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToLocaleBridge;
use FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToMailBridge;
use FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToProductBridge;
use FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToStoreBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class AvailabilityAlertDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_LOCALE = 'FACADE_LOCALE';

    /**
     * @var string
     */
    public const FACADE_MAIL = 'FACADE_MAIL';

    /**
     * @var string
     */
    public const FACADE_AVAILABILITY = 'FACADE_AVAILABILITY';

    /**
     * @var string
     */
    public const FACADE_PRODUCT = 'FACADE_PRODUCT';

    /**
     * @var string
     */
    public const FACADE_STORE = 'FACADE_STORE';

    /**
     * @var string
     */
    public const SUBSCRIBERS_NOTIFIER_PRE_CHECK_PLUGINS = 'SUBSCRIBERS_NOTIFIER_PRE_CHECK_PLUGINS';

    /**
     * @var string
     */
    public const PLUGINS_SUBSCRIBER_PRE_SAVE = 'PLUGINS_SUBSCRIBER_PRE_SAVE';

    /**
     * @var string
     */
    public const PLUGINS_SUBSCRIBER_POST_SAVE = 'PLUGINS_SUBSCRIBER_POST_SAVE';

    /**
     * @var string
     */
    public const PLUGINS_SUBSCRIPTION_PRE_SAVE = 'PLUGINS_SUBSCRIPTION_PRE_SAVE';

    /**
     * @var string
     */
    public const PLUGINS_SUBSCRIPTION_POST_SAVE = 'PLUGINS_SUBSCRIPTION_POST_SAVE';

    /**
     * @var string
     */
    public const PLUGINS_AVAILABILITY_ALERT_SUBSCRIPTION_TRANSFER_EXPANDER = 'PLUGINS_AVAILABILITY_ALERT_SUBSCRIPTION_TRANSFER_EXPANDER';

    /**
     * @var string
     */
    public const PLUGINS_AVAILABILITY_ALERT_NOTIFICATION = 'PLUGINS_AVAILABILITY_ALERT_NOTIFICATION';

    /**
     * @var string
     */
    public const PLUGINS_AVAILABILITY_ALERT_VALIDATION = 'PLUGINS_AVAILABILITY_ALERT_VALIDATION';

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
        $container = $this->addStoreFacade($container);
        $container = $this->addSubscribersNotifierPreCheckPlugins($container);
        $container = $this->addSubscriberPreSavePlugins($container);
        $container = $this->addSubscriberPostSavePlugins($container);
        $container = $this->addSubscriptionPreSavePlugins($container);
        $container = $this->addSubscriptionPostSavePlugins($container);
        $container = $this->addAvailabilityAlertNotificationPlugins($container);
        $container = $this->addAvailabilityAlertValidationPlugins($container);

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
        $container = $this->addAvailabilityAlertSubscriptionTransferExpanderPlugins($container);

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
            return new AvailabilityAlertToAvailabilityFacadeBridge($container->getLocator()->availability()->facade());
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
     * @return array<\FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier\SubscribersNotifierPreCheckPluginInterface>
     */
    protected function getSubscribersNotifierPreCheckPlugins(): array
    {
        return [
            new SubscribersNotifierHasProductAssignedStoresPreCheckPlugin(),
            new SubscribersNotifierProductAttributeReleaseDateInPastOrIsEmptyPreCheckPlugin(),
        ];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSubscriberPreSavePlugins(Container $container): Container
    {
        $container[static::PLUGINS_SUBSCRIBER_PRE_SAVE] = function () {
            return $this->getAvailabilityAlertSubscriberPreSavePlugins();
        };

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Zed\AvailabilityAlertExtension\Dependency\Plugin\PreSave\AvailabilityAlertSubscriberPreSavePluginInterface>
     */
    protected function getAvailabilityAlertSubscriberPreSavePlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSubscriptionPreSavePlugins(Container $container): Container
    {
        $container[static::PLUGINS_SUBSCRIPTION_PRE_SAVE] = function () {
            return $this->getAvailabilityAlertSubscriptionPreSavePlugins();
        };

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Zed\AvailabilityAlertExtension\Dependency\Plugin\PreSave\AvailabilityAlertSubscriptionPreSavePluginInterface>
     */
    protected function getAvailabilityAlertSubscriptionPreSavePlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSubscriptionPostSavePlugins(Container $container): Container
    {
        $container[static::PLUGINS_SUBSCRIPTION_POST_SAVE] = function () {
            return $this->getAvailabilityAlertSubscriptionPostSavePlugins();
        };

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Zed\AvailabilityAlertExtension\Dependency\Plugin\PostSave\AvailabilityAlertSubscriptionPostSavePluginInterface>
     */
    protected function getAvailabilityAlertSubscriptionPostSavePlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSubscriberPostSavePlugins(Container $container): Container
    {
        $container[static::PLUGINS_SUBSCRIBER_POST_SAVE] = function () {
            return $this->getAvailabilityAlertSubscriberPostSavePlugins();
        };

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Zed\AvailabilityAlertExtension\Dependency\Plugin\PostSave\AvailabilityAlertSubscriberPostSavePluginInterface>
     */
    protected function getAvailabilityAlertSubscriberPostSavePlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addAvailabilityAlertSubscriptionTransferExpanderPlugins(Container $container): Container
    {
        $container[static::PLUGINS_AVAILABILITY_ALERT_SUBSCRIPTION_TRANSFER_EXPANDER] = function () {
            return $this->getAvailabilityAlertSubscriptionTransferExpanderPlugins();
        };

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Zed\AvailabilityAlertExtension\Dependency\Plugin\PostSave\AvailabilityAlertSubscriberPostSavePluginInterface>
     */
    protected function getAvailabilityAlertSubscriptionTransferExpanderPlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addAvailabilityAlertNotificationPlugins(Container $container): Container
    {
        $container[static::PLUGINS_AVAILABILITY_ALERT_NOTIFICATION] = function () {
            return $this->getAvailabilityAlertNotificationPlugins();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addAvailabilityAlertValidationPlugins(Container $container): Container
    {
        $container[static::PLUGINS_AVAILABILITY_ALERT_VALIDATION] = function () {
            return $this->getAvailabilityAlertValidationPlugins();
        };

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Zed\AvailabilityAlertExtension\Dependency\Plugin\Notification\NotificationPluginInterface>
     */
    protected function getAvailabilityAlertNotificationPlugins(): array
    {
        return [];
    }

    /**
     * @return array<\FondOfOryx\Zed\AvailabilityAlertExtension\Dependency\Plugin\Validation\ValidationPluginInterface>
     */
    protected function getAvailabilityAlertValidationPlugins(): array
    {
        return [];
    }
}
