<?php

namespace FondOfOryx\Zed\AvailabilityAlertMigrator;

use FondOfOryx\Zed\AvailabilityAlertMigrator\Dependency\Facade\AvailabilityAlertMigratorToAvailabilityAlertFacadeBridge;
use FondOfOryx\Zed\AvailabilityAlertMigrator\Dependency\Facade\AvailabilityAlertMigratorToStoreFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class AvailabilityAlertMigratorDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_AVAILABILITY_ALERT = 'FACADE_AVAILABILITY_ALERT';
    public const FACADE_STORE = 'FACADE_STORE';
    public const PLUGINS_AVAILABILITY_ALERT_MIGRATOR_EXPANDER = 'PLUGINS_AVAILABILITY_ALERT_MIGRATOR_EXPANDER';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);
        $container = $this->addAvailabilityAlertFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);
        $container = $this->addAvailabilityAlertMigratorExpanderPlugins($container);
        $container = $this->addStoreFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addAvailabilityAlertFacade(Container $container): Container
    {
        $container[static::FACADE_AVAILABILITY_ALERT] = static function (Container $container) {
            return new AvailabilityAlertMigratorToAvailabilityAlertFacadeBridge($container->getLocator()->availabilityAlert()->facade());
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
            return new AvailabilityAlertMigratorToStoreFacadeBridge($container->getLocator()->store()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addAvailabilityAlertMigratorExpanderPlugins(Container $container): Container
    {
        $self = $this;
        $container[static::PLUGINS_AVAILABILITY_ALERT_MIGRATOR_EXPANDER] = static function () use ($self) {
            return $self->getExpanderPlugins();
        };

        return $container;
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlertMigrator\Dependency\Plugin\AvailabilityAlertMigratorExpanderPluginInterface[]
     */
    protected function getExpanderPlugins(): array
    {
        return [];
    }
}
